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

class KeyFeaturesController extends Controller
{
    public function index()
    {
        $breadcrumbs = [
            ['link' => "admin/settings", 'name' => "Settings"],
            ['name' => __('global.key_features')]
        ];
        return view('admin::pages/settings/keyfeatures/index', [
            'keyfeatures' => Introduction::loadAllKeyFeatures(),
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    public function create()
    {
        $breadcrumbs = [
            ['link' => "admin/settings", 'name' => __('global.settings')],
            ['link' => "admin/settings/keyfeatures", 'name' => __('global.key_features')],
            ['name' => __('global.new')]
        ];
        return view('admin::pages/settings/keyfeatures/create', [
            'type' => 'key_features',
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    public function store(HowItWorksKeyFeaturesRequest $request)
    {
        $input = $request->validated();
        try {
            DB::beginTransaction();
            $input['order'] = Introduction::where('type', 'key_features')->max('order') + 1;
            $input['type'] = 'key_features';
            Introduction::create($input);
            DB::commit();
            toastr()->success(__('global.saved_successfully'));
        } catch (\Exception $exception) {
            DB::rollback();
            toastr()->error($exception->getMessage());
        }
        
        return redirect()->route('settings.keyfeatures');
    }

    public function edit($id)
    {
        $keyfeature = Introduction::findOrFail($id);
        $breadcrumbs = [
            ['link' => "admin/settings", 'name' => __('global.settings')],
            ['link' => "admin/settings/keyfeatures", 'name' => __('global.key_features')],
            ['name' => __('global.edit')]
        ];
        return view('admin::pages/settings/keyfeatures/edit', [
            'keyfeature' => $keyfeature,
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    public function update(HowItWorksKeyFeaturesRequest $request, $id)
    {
        $input = $request->validated();
        try {
            $introduction = Introduction::findOrFail($id);
            $introduction->update($input);
            toastr()->success(__('global.updated_successfully'));
        } catch (\Exception $exception) {
            toastr()->error($exception->getMessage());
        }

        return redirect()->route('settings.keyfeatures');
    }

    public function destroy($id)
    {
        if (\Request::ajax()) {
            try {
                $keyfeature = Introduction::findOrFail($id);
                DB::beginTransaction();
                $keyfeatures_to_resort = Introduction::where([['type', 'key_features'], ['order', '>', $keyfeature->order]])->orderBy('order')->get();
                IntroductionTranslation::where('introduction_id', $keyfeature->id)->delete();
                $keyfeature->delete();
                if ($keyfeatures_to_resort->count() > 0) {
                    foreach ($keyfeatures_to_resort as $keyfeature_to_resort) {
                        $keyfeature_to_resort->decrement('order', 1);
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
