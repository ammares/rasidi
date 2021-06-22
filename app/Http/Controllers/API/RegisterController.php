<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignUpRequest;
use App\Http\Resources\UserResource;
use App\Models\Client;
use App\Traits\SendEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    use SendEmail;

    public function register(SignUpRequest $request)
    {
        $client = Client::create($request->validated());

        $token = $client->createToken($request->input('device_name', Str::random(8)));

        $this->sendEmail($client, 'send_email_verification_code', [
            'verification_code' => $client->email_verification_code,
            'expired_at' => $client->email_expired_at,
            'user_name' => $client->full_name,
        ]);

        return response()->json([
            'message' => __('Signed Up Successfully'),
            'data' => [
                'token_type' => 'Bearer',
                'expires_in' => config('sanctum.expiration')
                    ? now()->addMinutes(config('sanctum.expiration'))->diffInSeconds($token->accessToken->created_at)
                    : null,
                'access_token' => $token->plainTextToken,
                'user' => UserResource::make($client),
            ]
        ], 201);
    }
}
