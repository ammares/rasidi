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
            return response()->json([
                'message' => __('global.saved_successfully'),
            ], 200);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
            ], 400);
        }
    }


    public function update(CategoryRequest $request, $id)
    {
        $input = $request->validated();
        try {
            $category=Category::findOrFail($id);
            $category->update($input);
            return response()->json([
                'message' => __('global.updated_successfully'),
            ], 200);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
            ], 400);
        }
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
