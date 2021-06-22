<?php

namespace Modules\Admin\Http\Controllers;

use App\Models\UserPreferences;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class UserPreferencesController extends Controller
{
    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'key' => 'required',
            'value' => $request->has('is_email') ? 'required|email' : 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 400);
        }

        $post_data = $validator->validated();
        if (is_array($post_data['key']) && is_array($post_data['value'])) {
            foreach ($post_data['key'] as $key => $key) {
                UserPreferences::updateOrCreate([
                    'user_id' => $request->user()->id,
                    'key' => $key, ], [
                    'value' => $post_data['value'][$key],
                ]);
            }

            return response()->json(['message' => __('global.saved_successfully')], 201);
        }

        UserPreferences::updateOrCreate([
            'user_id' => $request->user()->id,
            'key' => $request->input('key'), ], [
            'value' => $request->input('value'),
        ]);

        return response()->json(['message' => __('global.saved_successfully')], 201);
    }
}
