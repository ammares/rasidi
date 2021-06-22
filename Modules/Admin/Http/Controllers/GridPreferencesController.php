<?php

namespace Modules\Admin\Http\Controllers;

use App\Models\GridPreferences;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class GridPreferencesController extends Controller
{
    public function load(Request $request)
    {
        return response()->json(
            ['data' => GridPreferences::loadByKey(
                    $request->input('grid'),
                    $request->user()->id
                )
        ], 200);
    }

    public function save(Request $request)
    {
        try {
            GridPreferences::updateOrCreate(
                [
                'user_id' => $request->user()->id,
                'key_name' => $request->input('key_name'), ],
                ['key_value' => json_encode($request->input('key_value')),
                ]
            );

            return response()->json(['message' => 'Saved Successfully'], 200);
        } catch (\Illuminate\Database\QueryException $ex) {
            return response()->json(['message' => $ex->getMessage()], 400);
        }
    }
}
