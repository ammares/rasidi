<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\ConfirmResetCodeRequest;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\PasswordResetRequest;
use App\Models\Client;
use App\Models\ClientPasswordReset;
use App\Traits\SendEmail;
use Carbon\Carbon;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    use SendEmail;

    public function sendCode(ForgotPasswordRequest $request)
    {
        $client = Client::where('email', $request->input('email'))->firstOrFail();
        $passwordReset = ClientPasswordReset::updateOrCreate([
            'email' => $request->input('email')
        ], [
            'token' => rand(1001, 9999),
        ]);

        $this->sendEmail($client, 'password_reset_code', [
            'reset_code' => $passwordReset->token,
            'code_expires_at' => Carbon::parse($passwordReset->updated_at)->addHours(12),
        ]);

        return response()->json(['message' => 'Password reset code has been sent'], 200);
    }

    public function confirmCode(ConfirmResetCodeRequest $request)
    {
        $passwordReset = ClientPasswordReset::where([
            ['email', $request->input('email')],
            ['token', $request->input('reset_code')],
        ])->first();

        if (!$passwordReset) {
            return response()->json([
                'message' => 'This email or password reset code are invalid',
            ], 400);
        }

        if (Carbon::parse($passwordReset->updated_at)->addHours(12)->isPast()) {
            $passwordReset->delete();

            return response()->json(['message' => 'This password reset code is expired'], 400);
        }

        $userAbsent = Client::where('email', $passwordReset->email)->doesntExist();

        if ($userAbsent) {
            $passwordReset->delete();

            return response()->json([
                'message' => 'This email does not match our records',
            ], 400);
        }

        try {
            $secureToken = bin2hex(random_bytes(32));
            $passwordReset->update([
                'token' => $secureToken
            ]);

            return response()->json(['data' => ['token' => $secureToken]]);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'Something went wrong please try again',
                'details' => $exception->getMessage(),
            ], 500);
        }
    }

    public function reset(PasswordResetRequest $request)
    {
        $passwordReset = ClientPasswordReset::where([
            ['token', $request->input('token')],
        ])->first();
        if (!$passwordReset) {
            return response()->json([
                'message' => 'Password reset token is invalid',
            ], 400);
        }

        if (Carbon::parse($passwordReset->updated_at)->addMinutes(15)->isPast()) {
            $passwordReset->delete();

            return response()->json([
                'message' => 'This password reset token is expired'
            ], 400);
        }

        $client = Client::where('email', $passwordReset->email)->first();
        if (!$client) {
            $passwordReset->delete();

            return response()->json([
                'message' => 'The account does not exist',
            ], 400);
        }

        if (Hash::check($request->input('password'), $client->password)) {
            return response()->json([
                'message' => 'New password can not be current password',
            ], 400);
        }

        $client->update([
            'password' => bcrypt($request->input('password')),
            'email_verified' => '1',
        ]);

        $passwordReset->delete();

        $this->sendEmail($client, 'password_has_been_reset');

        return response()->json(['message' => 'Password has been changed successfully'], 200);
    }
}
