<?php

namespace App\Http\Controllers\API;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\GatewayRegisterRequest;
use App\Models\ClientDevice;
use App\Models\ClientGateway;
use App\Models\Gateway;

class GatewaysController extends Controller
{
    public function register(GatewayRegisterRequest $request): \Illuminate\Http\JsonResponse
    {
        $gateway = Gateway::where('serial_number', $request->input('serial_number'))->first();

        if (!$gateway) {
            return response()->json([
                'message' => __('global.invalid_gateway_serial_number'),
            ], 400);
        }

        if ($gateway->clientGateway()->exists()) {
            return response()->json([
                'message' => __('global.this_gateway_is_already_registered'),
            ], 400);
        }

        $client = $request->user();
        if ($client->ban || !$client->active || !$client->email_verified) {
            return response()->json([
                'message' => __('global.this_client_is_not_active'),
            ], 400);
        }

        $publish_topic = Helper::randomStrings(6, false);
        $subscribe_topic = 'gateway/test';
        $gateway->clientGateway()->create([
            'client_id' => auth()->id(),
            'subscription_date' => now()->addMonths(6),
            'publish_topic' => $publish_topic,
            'subscribe_topic' => $subscribe_topic,
        ]);

        ClientDevice::where('client_id', auth()->id())->update(['gateway_id' => $gateway->id]);

        return response()->json([
            'mqtt_host' => '46.165.252.17',
            'mqtt_user' => 'cp-mqtt',
            'mqtt_password' => 'kvXVP2EQ',
            'pub_topic' => $publish_topic,
            'sub_topic' => $subscribe_topic,
        ], 200);
    }
}
