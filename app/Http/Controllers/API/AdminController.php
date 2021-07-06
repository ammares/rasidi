<?php

namespace App\Http\Controllers\API;

use App\Events\ClientCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\EnergyConsumptionRequest;
use App\Http\Requests\LocationRequest;
use App\Http\Requests\SolarEnergyRequest;
use App\Http\Resources\UserResource;
use App\Models\TransferOperation;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Helpers\Helper;

class AdminController extends Controller
{

  public function transferOperations()
  {
      try {
          $transfer_operations = TransferOperation::where('status',0)->get();
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

    public function show()
    {
        return UserResource::make(auth()->user());
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();

        return response()->json(['message' => 'Logged Out Successfully'], 200);
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $user = auth()->user();
        if (Hash::check($request->input('password'), $user->password)) {
            return response()->json([
                'message' => 'New password can not be the current password!',
            ], 400);
        }
        $user->password = bcrypt($request->input('password'));
        $user->save();

        return response()->json([
                'message' => 'Password Changed Successfully',
            ], 200);
    }

    public function saveLocation(LocationRequest $request)
    {
        $post_data = $request->validated();

        $country_and_city = Helper::getCountryAndCityByGeoCordinate($post_data["latitude"], $post_data["longitude"], App()->getLocale());
        if ($country_and_city['status'] != 200) {
            return response()->json([
                    'message' => $country_and_city['message'],
                ], $country_and_city['status']);
        }

        $post_data['city_id'] = $country_and_city['city_id'];
        $post_data['country_id'] = $country_and_city['country_id'];

        auth()->user()->update($post_data);

        return response()->json([
                'message' => __('global.saved_successfully'),
            ], 200);
    }

    public function saveEnergyConsumption(EnergyConsumptionRequest $request)
    {
        $post_data = $request->validated();

        if (isset($post_data['provider_name'])) {
            $provider_data['country_id'] = auth()->user()->country_id;
            $provider_data['verified'] = 0;
            foreach (config('translatable.locales') as $locale) {
                $provider_data[$locale] = ['name' => $post_data['provider_name']];
            }
            $id = Provider::create($provider_data)->id;
        }

        auth()->user()->update([
            'provider_id' => $id ?? $post_data['provider_id'],
        ]);

        $devices = [];
        $now = now();
        foreach ($post_data['devices'] as $device) {
            $devices[] = [
                'device_id' => $device['id'],
                'client_id' => auth()->id(),
                'label' => $device['label'],
                'power' => $device['power'] ?? null,
                'temperature' => $device['temperature'] ?? null,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }
        ClientDevice::insert($devices);

        return response()->json([
                'message' => __('global.saved_successfully'),
            ], 200);
    }

    public function saveSolarEnergy(SolarEnergyRequest $request)
    {
        auth()->user()->update($request->validated());

        // send new client notification to admin completing registration
        if ('1' == auth()->user()->email_verified && auth()->user()->location && auth()->user()->provider_id) {
            ClientCreated::dispatch(auth()->user());
        }

        return response()->json([
                'message' => __('global.saved_successfully'),
            ], 200);
    }
}
