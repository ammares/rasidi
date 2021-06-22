<?php

namespace Modules\Admin\Http\Controllers;

use App\Models\Faq;
use App\Models\FaqTranslation;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Http\Requests\FaqRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class FaqController extends Controller
{
    public function index()
    {
        $breadcrumbs = [
            ['link' => "admin/settings", 'name' =>  __('global.settings')],
            ['name' => __('global.faq')]
        ];

        return view('admin::pages/settings/faq/index', [
            'faqs' => Faq::orderBy('order')->get(),
            'breadcrumbs' => $breadcrumbs
        ]);
    }
    public function create()
    {
        $breadcrumbs = [
            ['link' => "admin/settings", 'name' => __('global.settings')],
            ['link' => "admin/settings/faq", 'name' => __('global.faq')],
            ['name' => __('global.new')]
        ];

        return view('admin::pages/settings/faq/create', ['breadcrumbs' => $breadcrumbs]);
    }

    public function store(FaqRequest $request)
    {
        $input = $request->validated();
        $input['order'] = Faq::max('order') + 1;
        Faq::create($input);

        toastr()->success(__('global.saved_successfully'));

        return redirect()->route('settings.faq');
    }

    public function edit($id)
    {
        $faq = Faq::findOrFail($id);
        $breadcrumbs = [
            ['link' => "admin/settings", 'name' => __('global.settings')],
            ['link' => "admin/settings/faq", 'name' => __('global.faq')],
            ['name' => __('global.edit')]
        ];

        return view('admin::pages/settings/faq/edit', [
            'faq' =>  $faq,
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    public function update(FaqRequest $request, $id)
    {
        try {
            $faq = Faq::findOrFail($id);
            $faq->update($request->validated());
            toastr()->success(__('global.updated_successfully'));
        } catch (\Exception $exception) {
            toastr()->error($exception->getMessage());
        }

        return redirect()->route('settings.faq');
    }

    public function destroy($id)
    {
        if (\Request::ajax()) {
            try {
                $faq = Faq::findOrFail($id);
                DB::beginTransaction();
                $faqs_to_resort = Faq::where('order', '>', $faq->order)->orderBy('order')->get();
                FaqTranslation::where('faq_id', $faq->id)->delete();
                $faq->delete();
                if ($faqs_to_resort->count() > 0) {
                    foreach ($faqs_to_resort as $faq_to_resort) {
                        $faq_to_resort->decrement('order', 1);
                    }
                }
                DB::commit();
                return response()->json([
                    'message' => __('global.deleted_successfully'),
                ], 200);
            } catch (\Exception $exception) {
                DB::rollback();
                return response()->json([
                    'message' => $exception->getMessage(),
                ], 400);
            }
        }
        abort(404);
    }

    public function sort(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'data.*.id' => 'required_with:faqs.*.id',
                'data.*.order' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['message' => __('global.sorted_error')], 400);
            }
            $data = $request->all()['data'];
            try {
                foreach ($data as $value) {
                    Faq::where('id', $value['id'])->update(['order' => $value['order']]);
                }
                return response()->json([
                    'message' => __('global.sorted_successfully'),
                ], 200);
            } catch (\Exception $exception) {
                return response()->json([
                    'message' => $exception->getMessage(),
                ], 400);
            }
        }
        abort(404);
    }
}
