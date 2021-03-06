<?php

namespace Modules\Admin\Http\Controllers;

use App\Helpers\Helper;
use App\Models\ClientsBill;
use App\Models\Introduction;
use App\Models\IntroductionTranslation;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Modules\Admin\Http\Requests\InroductionReorderRequest;
use Modules\Admin\Http\Requests\IntroductionRequest;
use Illuminate\Support\Facades\DB;

class ClientsBillsController extends Controller
{
    public function index()
    {
        if (\Request::ajax()) {
            return response()->json([
                'data' => ClientsBill::loadAll()
            ], 200);
        }
        $breadcrumbs = [
            ['link' => "admin/settings", 'name' => "Settings"],
            ['name' => __('global.clients_bills')]
        ];

        return view('admin::pages/settings/clients_bills/index', [
            'breadcrumbs' => $breadcrumbs,
        ]);
    }


    public function store(IntroductionRequest $request)
    {
        $input = $request->validated();
        try {
            DB::beginTransaction();
            if ($request->hasFile('image')) {
                $input['image'] = Helper::storeImage($request->file('image'), storage_path('app/public/introductions/'), [
                    'thumbnail_path' => storage_path('app/public/introductions/thumbnail/'),
                    'thumbnail_width' => 200,
                    'image_width' => 1080,
                    'image_quality' => 100,
                ]);
            }
            $input['order'] = Introduction::where('type', 'introductions')->max('order') + 1;
            Introduction::create($input);
            DB::commit();
            toastr()->success(__('global.saved_successfully'));
        } catch (\Exception $exception) {
            DB::rollback();
            toastr()->error($exception->getMessage());
        }

        return redirect()->route('settings.introductions');
    }


    public function update(IntroductionRequest $request, $id)
    {
        $input = $request->except('_token', 'image');
        $img_to_delete = '';
        try {
            $introduction = Introduction::findOrFail($id);
            DB::beginTransaction();
            if ($request->hasFile('image')) {
                $input['image'] = Helper::storeImage(
                    $request->file('image'),
                    storage_path('app/public/introductions/'),
                    [
                        'thumbnail_path' => storage_path('app/public/introductions/thumbnail/'),
                        'thumbnail_width' => 200,
                        'image_width' => 1080,
                        'image_quality' => 100,
                    ]
                );
                $img_to_delete = $introduction->image;
            }
            $introduction->update($input);
            if ($img_to_delete) {
                Storage::delete('introductions/' . $introduction->image);
                Storage::delete('introductions/thumbnail/' . $introduction->image);
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

        return redirect()->route('settings.introductions');
    }

    public function destroy($id)
    {
        if (\Request::ajax()) {
            try {
                $introduction = Introduction::findOrFail($id);
                DB::beginTransaction();
                $introductions_to_resort = Introduction::where([['type', 'introductions'], ['order', '>', $introduction->order]])->orderBy('order')->get();
                IntroductionTranslation::where('introduction_id', $introduction->id)->delete();
                $introduction->delete();
                if ($introduction->image && 'introduction_silhouette.png' != $introduction->image) {
                    Storage::delete('introductions/' . $introduction->image);
                    Storage::delete('introductions/thumbnail/' . $introduction->image);
                }
                if ($introductions_to_resort->count() > 0) {
                    foreach ($introductions_to_resort as $introduction_to_resort) {
                        $introduction_to_resort->decrement('order', 1);
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

}
