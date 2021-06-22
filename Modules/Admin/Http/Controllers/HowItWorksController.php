<?php

namespace Modules\Admin\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Introduction;
use App\Models\IntroductionTranslation;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Modules\Admin\Http\Requests\InroductionReorderRequest;
use Modules\Admin\Http\Requests\HowItWorksKeyFeaturesRequest;
use Illuminate\Support\Facades\DB;

class HowItWorksController extends Controller
{
    public function index()
    {
        $breadcrumbs = [
            ['link' => "admin/settings", 'name' => "Settings"],
            ['name' => __('global.how_it_works')]
        ];
        return view('admin::pages/settings/howitworks/index', [
            'howitworks' => Introduction::loadAllHowItWorks(),
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    public function create()
    {
        $breadcrumbs = [
            ['link' => "admin/settings", 'name' => __('global.settings')],
            ['link' => "admin/settings/howitworks", 'name' => __('global.how_it_works')],
            ['name' => __('global.new')]
        ];
        return view('admin::pages/settings/howitworks/create', [
            'type' => 'how_it_works',
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    public function store(HowItWorksKeyFeaturesRequest $request)
    {
        $input = $request->validated();
        try {
            DB::beginTransaction();
            if ($request->hasFile('image')) {
                $input['image'] = Helper::storeImage($request->file('image'), storage_path('app/public/howitworks/'), [
                    'optimize' => false,
                ]);
            }
            $input['order'] = Introduction::where('type', 'how_it_works')->max('order') + 1;
            $input['type'] = 'how_it_works';
            Introduction::create($input);
            DB::commit();
            toastr()->success(__('global.saved_successfully'));
        } catch (\Exception $exception) {
            DB::rollback();
            toastr()->error($exception->getMessage());
        }

        return redirect()->route('settings.howitworks');
    }

    public function edit($id)
    {
        $howitwork = Introduction::findOrFail($id);
        $breadcrumbs = [
            ['link' => "admin/settings", 'name' => __('global.settings')],
            ['link' => "admin/settings/howitworks", 'name' => __('global.how_it_works')],
            ['name' => __('global.edit')]
        ];
        return view('admin::pages/settings/howitworks/edit', [
            'howitwork' => $howitwork,
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    public function update(HowItWorksKeyFeaturesRequest $request, $id)
    {
        $input = $request->validated();
        $img_to_delete = '';
        try {
            $introduction = Introduction::findOrFail($id);
            DB::beginTransaction();
            if ($request->hasFile('image')) {
                $input['image'] = Helper::storeImage($request->file('image'), storage_path('app/public/howitworks/'), [
                    'optimize' => false,
                ]);
                $img_to_delete = $introduction->image;
            }
            $introduction->update($input);
            if ($img_to_delete) {
                Storage::delete('howitworks/' . $introduction->image);
            }
            DB::commit();
            toastr()->success(__('global.updated_successfully'));
        } catch (\Exception $exception) {
            if ($request->hasFile('image')) {
                Storage::delete('howitworks/' . $request->file('image'));
            }
            DB::rollback();
            toastr()->error($exception->getMessage());
        }

        return redirect()->route('settings.howitworks');
    }

    public function destroy($id)
    {
        if (\Request::ajax()) {
            try {
                $howitwork = Introduction::findOrFail($id);
                DB::beginTransaction();
                $howitworks_to_resort = Introduction::where([['type', 'how_it_works'], ['order', '>', $howitwork->order]])->orderBy('order')->get();
                IntroductionTranslation::where('introduction_id', $howitwork->id)->delete();
                $howitwork->delete();
                if ($howitwork->image) {
                    Storage::delete('howitworks/' . $howitwork->image);
                }
                if ($howitworks_to_resort->count() > 0) {
                    foreach ($howitworks_to_resort as $howitwork_to_resort) {
                        $howitwork_to_resort->decrement('order', 1);
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

    public function sort(InroductionReorderRequest $request)
    {
        if ($request->ajax()) {
            try {
                foreach ($request->validated()['data'] as $value) {
                    Introduction::where('id', $value['id'])->update(['order' => $value['order']]);
                }
                return response()->json([
                    'message' => __('global.sorted_successfully')
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
