<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\ClientsBill;
use App\Http\Controllers\Controller;
use App\Http\Requests\SignUpRequest;
use App\Models\Category;
use App\Models\TransferOperation;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserController extends Controller
{

    public function beforeRegister(Request $request)
    {
        try {
            $mobile=$request['mobile'];
            $mobile_exists = Client::where('mobile', $mobile)->pluck('mobile')->first();
            if ($mobile==$mobile_exists)
            {
              return response()->json([
                  'code' => '400',
                  'message' => 'Mobile Number is Already Taken',
              ]);
            }else{
              return response()->json([
                  'code' => '200',
                  'message' => 'Mobile Number is Valid',
              ]);
            }
        } catch (\Exception $exception) {
            return response()->json([
                'code' => '400',
                'message' => $exception->getMessage(),//@todo check error message from mobile
            ]);
        }
    }

    public function register(Request $request)
    {
        try {
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
            $mobile=$request['mobile'];
            $client = Client::where('mobile', $mobile)->first();
            if (!$client)
            {
              return response()->json([
                  'code' => '400',
                  'message' => 'Mobile number is not exist!',
              ]);
            }else
            {
              if(!($client->verified)){
                $client->delete();
                return response()->json([
                    'code' => '200',
                    'message' => 'Your Account is Not Verified, Please Sign Up Again',
                ]);
              }else if(Hash::check($request['password'], $client->password)){
                return response()->json([
                    'code' => '200',
                    'message' => 'Logged In Successfully',
                    'data' => $client
                ]);
              }else{
                return response()->json([
                    'code' => '400',
                    'message' => 'Password is not correct!',
                ]);
              }
            }
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
            $client = Client::findOrFail($request['id']);
            $operations = TransferOperation::where('client_id',$client->id)->get();
            foreach($operations as $operation){
                $operation->category_id=(string)Category::where('id',$operation->category_id)->pluck('amount')->first();
            }
            $verify_on_register=$request['verify'];
            if($verify_on_register=='true'){
              $client->update(['verified'=>1]);
              return response()->json([
                  'code' => '200',
                  'message' => 'Verified Successfully',
                  'data' => $operations
              ]);
            }else{
              return response()->json([
                  'code' => '200',
                  'message' => 'Get Operations Successfully',
                  'data' => $operations
              ]);
            }
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

    public function beforeTransfer(Request $request)
    {
        try
        {
          $client = Client::findOrFail($request['user_id']);
          if (Hash::check($request['password'], $client->password)){
            return response()->json([
                'code' => '200',
            ]);
          }else{
            return response()->json([
                'code' => '400',
                'message' => 'Password is Not Correct',
            ]);
          }
        } catch (\Exception $exception) {
            return response()->json([
                'code' => '400',
                'message' => $exception->getMessage(),
            ]);
        }
    }

    public function transfer(Request $request)
    {
        try
        {
          $client=Client::findOrFail($request['user_id']);
          if($client->balance<$request['category_amount'] ){
            return response()->json([
                'code' => '400',
                'message' => 'You Do Not Have Enough Balance!',
            ]);
          }
          $array = [
            'client_id' => $request['user_id'],
            'category_id' => Category::where('amount',$request['category_amount'])->pluck('id')->first(),
            'mobile' => $request['mobile'],
            'sim_type' => $request['sim_type'],
            '$status' => 0
          ];
          TransferOperation::create($array);
          return response()->json([
              'code' => '200',
              'message' => 'Operation Send Successfully, You Will Get Your Units Soon',
          ]);
        } catch (\Exception $exception) {
            return response()->json([
                'code' => '400',
                'message' => $exception->getMessage(),
            ]);
        }
    }

    public function bills(Request $request)
    {
        try
        {
          $client_id = $request['user_id'];
          $bills = ClientsBill::where('client_id',$client_id)->get();
          return response()->json([
              'code' => '200',
              'message' => 'Get Bills Successfully',
              'data' => $bills
          ]);
        } catch (\Exception $exception) {
            return response()->json([
                'code' => '400',
                'message' => $exception->getMessage(),
            ]);
        }
    }

    public function payBill(Request $request)
    {
        try
        {
          $bill= ClientsBill::findOrFail($request['id']);
          $client = Client::findOrFail($bill->client_id);
          if ($client->balance >= $bill->value){
            $bill->update([
                'paid' => 1,
                'payment_at' => Carbon::now()
            ]);
            $client->update([
              'balance' => ($client->balance)-($bill->value)
            ]);
            return response()->json([
                'code' => '200',
                'message' => 'Bill Payed Successfully',
                'data' => $client->balance
            ]);
          }else {
            return response()->json([
                'code' => '400',
                'message' => 'Bill Value Is More Than Your Balance!',
            ]);
          }

        } catch (\Exception $exception) {
            return response()->json([
                'code' => '400',
                'message' => $exception->getMessage(),
            ]);
        }
    }

    public function getBalance(Request $request)
    {
      try{
        $client = Client::findOrFail($request['id']);
        return response()->json([
            'code' => '200',
            'message' => 'Balance Updated Successfully',
            'data' => $client->balance
        ]);
      } catch (\Exception $exception) {
          return response()->json([
              'code' => '400',
              'message' => $exception->getMessage(),
          ]);
      }
    }

}
