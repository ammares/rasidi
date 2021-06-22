<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\DeviceResource;
use App\Models\Device;
use Illuminate\Http\Request;

class DevicesController extends Controller
{
    public function index()
    {
        return response()->json([
                'data' => [
                    'devices' => DeviceResource::collection(Device::enabled()->get()),
                ]
            ], 200);
    }
}
