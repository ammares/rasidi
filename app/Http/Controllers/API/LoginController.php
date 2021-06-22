<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\Client;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    private $maxAttempts;
    private $decayMinutes;

    public function __construct()
    {
        $this->maxAttempts = config('app.max_attempts', 5);
        $this->decayMinutes = config('app.decay_minutes', 1);
    }

    public function login(LoginRequest $request)
    {
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return response()->json([
                'message' => __(
                    'auth.your_account_is_temporarily_locked_try_again_after_minutes',
                    ['minutes' => $this->decayMinutes]
                ),
                'code' => 423,
            ], 200);
        }

        $client = Client::where('email', $request->email)
            ->with([
                    'gateway:id,client_id,gateway_id',
                    'gateway.gateway:id,serial_number',
                    'country:id,name',
                ])
            ->withcount('devices')
            ->first();

        if (!$client || !Hash::check($request->password, $client->password)) {
            $this->incrementLoginAttempts($request);
            throw ValidationException::withMessages([
                'email' => [__('auth.failed')],
            ]);
        }

        $this->clearLoginAttempts($request);

        $token = $client->createToken($request->input('device_name') ?? Str::random(8));

        if ($client->devices_count > 0) {
            $client['register_completed'] = 1;
        } else {
            $client['register_completed'] = 0;
        }

        return response()->json([
                'message' => __('auth.logged_in_successfully'),
                'data' => [
                    'token_type' => 'Bearer',
                    'expires_in' => config('sanctum.expiration')
                    ? now()->addMinutes(config('sanctum.expiration'))->diffInSeconds($token->accessToken->created_at)
                    : null,
                    'access_token' => $token->plainTextToken,
                    'user' => $client,
                ]
            ], 200);
    }
}
