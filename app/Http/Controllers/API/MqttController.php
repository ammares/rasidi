<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\MqttRequest;
use Carbon\Carbon;

class MqttController extends Controller
{
    public function store(MqttRequest $request){
        $post_data = $request->validated();

        $request->user()->mqttRequestTemp()->create([
            'payload' => $post_data['payload'],
            'payload_at' => isset($post_data['payload_at']) ? 
                Carbon::parse($post_data['payload_at']) : Carbon::now(),
        ]);

        return response()->json([
            'message' => 'data stord successfully',
            'data' => [
                'payload' => $request->user()->id,
            ]
        ], 201);
    }
}
