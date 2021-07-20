<?php

namespace Modules\Admin\Http\Controllers;

use App\Helpers\Helper;
use App\Models\ChargeOperation;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Modules\Admin\Http\Requests\InroductionReorderRequest;
use Modules\Admin\Http\Requests\IntroductionRequest;
use Illuminate\Support\Facades\DB;

class ChargeOperationsController extends Controller
{
    public function index()
    {
        if (\Request::ajax()) {
            return response()->json([
                'data' => ChargeOperation::loadAll()
            ], 200);
        }
        $breadcrumbs = [
            ['link' => "admin/settings", 'name' => "Settings"],
            ['name' => __('global.charge_operations')]
        ];

        $clients=Client::select('id','first_name','last_name','mobile')->get()->toArray();
        return view('admin::pages/settings/charge_operations/index', [
            'breadcrumbs' => $breadcrumbs,
            'clients' => $clients,
        ]);
    }


    public function store(Request $request)
    {
        //$input = $request->validated();
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




}
