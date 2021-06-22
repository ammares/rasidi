<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Http\Controllers\Controller;
use App\Http\Requests\SignUpRequest;

class UserController extends Controller
{
    public function register(Request $request)
    {
        try {
            //$inputs = $request->validated();
            Client::create($request->all());
            return response()->json([
                'message' => 'Sign Up Successfully',
            ],200);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
            ],200);
        }  
    }

    public function login(Request $request)
    {
        try {
            $mobile_number = $request['mobile_number'];
            $user = User::where('mobile_number', $mobile_number)->firstOrFail();
            return response()->json([
                'message' => 'Logged In Successfully',
                'data' => $user
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
            ]);
        }  
    }


}
