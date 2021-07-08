<?php

namespace Modules\Admin\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Category;
use App\Models\Introduction;
use App\Models\IntroductionTranslation;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Modules\Admin\Http\Requests\InroductionReorderRequest;
use Modules\Admin\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
    public function index()
    {
        if (\Request::ajax()) {
            return response()->json([
                'data' => Category::loadAll(),

            ], 200);
        }
        $breadcrumbs = [
            ['link' => "admin/settings", 'name' => "Settings"],
            ['name' => __('global.recharge_categories')]
        ];

        return view('admin::pages/settings/categories/index', [
            'breadcrumbs' => $breadcrumbs,
        ]);
    }


    public function store(CategoryRequest $request)
    {
        $input = $request->validated();
        try {
            Category::create($input);
            toastr()->success(__('global.saved_successfully'));
        } catch (\Exception $exception) {
            toastr()->error($exception->getMessage());
        }

        return redirect()->route('settings.categories');
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
                $category = Category::findOrFail($id);
                $category->delete();
                return response()->json([
                    'message' => __('global.deleted_successfully'),
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
