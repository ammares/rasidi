<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Http\Controllers\Controller;
use App\Http\Requests\SignUpRequest;
use App\Models\TransferOperation;

class UserController extends Controller
{
    public function register(Request $request)
    {
        try {
            //$inputs = $request->validated();
            $Client= Client::create($request->all());
            return response()->json([
                'message' => 'Sign Up Successfully',
                'data' => $Client->id
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
            $mobile = $request['mobile'];
            $Client = Client::where('mobile', $mobile)->firstOrFail();
            return response()->json([
                'code' => '200',
                'message' => 'Logged In Successfully',
                'data' => $Client
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'code' =>'400',
                'message' => $exception->getMessage(),
            ]);
        }  
    }

    public function operations(Request $request)
    {
        try {
            $client_id = $request['id'];
            $operations = TransferOperation::where('client_id',$client_id)->firstOrFail();
            return response()->json([
                'code' => '200',
                'message' => 'Logged In Successfully',
                'data' => $operations
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
            ]);
        }  
    }


}
