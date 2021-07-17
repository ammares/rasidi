<?php

namespace App\Http\Controllers\API;

use App\Events\ClientCreated;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\TransferOperation;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Helpers\Helper;

class AdminController extends Controller
{

  public function transferOperations()
  {
      try {
          $transfer_operations = TransferOperation::where('status',0)->orderBy('id', 'DESC')->get();
          foreach ($transfer_operations as $transfer_operation) {
            $transfer_operation->category_id=(string)Category::where('id',$transfer_operation->category_id)->pluck('amount')->first();
          }
          if (count($transfer_operations)>0 ){
            return response()->json([
                'code' => '200',
                'message' => 'Get Transfer Operations Successfully',
                'data' => $transfer_operations
            ]);
          }else {
            return response()->json([
                'code' => '400',
                'message' => 'No New Transfer Operations',
                'data' => $transfer_operations
            ]);
          }

      } catch (\Exception $exception) {
          return response()->json([
              'code' =>'400',
              'message' => $exception->getMessage(),
          ]);
      }
  }

  public function transferOperationsDone(Request $request)
  {
      try {
          $transfer_operation = TransferOperation::findOrFail($request['id']);
          $transfer_operation->update(['status'=>1]);
          return response()->json([
              'code' => '200',
              'message' => 'Transfer Operation Completed Successfully',
          ]);
      } catch (\Exception $exception) {
          return response()->json([
              'code' =>'400',
              'message' => $exception->getMessage(),
          ]);
      }
  }
}
