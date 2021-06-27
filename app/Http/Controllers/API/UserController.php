<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Http\Controllers\Controller;
use App\Http\Requests\SignUpRequest;
use App\Models\Category;
use App\Models\TransferOperation;

class UserController extends Controller
{
    public function register(Request $request)
    {
        try {
            //@todo $inputs = $request->validated();
            $Client= Client::create($request->all());
            return response()->json([
                'code' => '200',
                'message' => 'Sign Up Successfully',
                'data' => $Client->id
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'code' => '400',
                'message' => $exception->getMessage(),//@todo check error message from mobile
            ]);
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
            $operations = TransferOperation::where('client_id',$client_id)->get();
            foreach($operations as $operation){
                $operation->category_id=(string)Category::where('id',$operation->category_id)->pluck('amount')->first();
            }
            return response()->json([
                'code' => '200',
                'message' => 'Get Operations Successfully',
                'data' => $operations
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'code' =>'400',
                'message' => $exception->getMessage(),
            ]);
        }  
    }

    public function categories()
    {
        try {
            $categories = Category::all();
            return response()->json([
                'code' => '200',
                'message' => 'Get Categories Successfully',
                'data' => $categories
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'code' =>'400',
                'message' => $exception->getMessage(),
            ]);
        }  
    }

    


}
