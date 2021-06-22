<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProviderResource;
use App\Models\Provider;
use Illuminate\Http\Request;

class ProvidersController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => [
                'providers' => ProviderResource::collection(Provider::where('verified', 1)->get()),
            ]
        ], 200);
    }
}
