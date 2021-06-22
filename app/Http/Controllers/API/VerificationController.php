<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResendEmailCodeRequest;
use App\Http\Requests\VerifyEmailRequest;
use App\Models\Client;
use App\Traits\SendEmail;
use Carbon\Carbon;

class VerificationController extends Controller
{
    use SendEmail;

    public function verifyEmail(VerifyEmailRequest $request)
    {
        $client = Client::where([
            ['email', $request->input('email')],
            ['email_verification_code', $request->input('verification_code')],
            ['active', '1'],
            ['email_verified', '0'],
        ])->first();

        if (!$client) {
            return response()->json(['message' => 'This email or verification code are invalid'], 400);
        }

        if (Carbon::parse($client->email_expired_at)->isPast()) {
            return response()->json(['message' => 'This activation token is expired'], 400);
        }

        $client->email_verified = 1;
        $client->email_verification_code = null;
        $client->email_expired_at = null;
        $client->save();

        $this->sendEmail($client, 'email_verified');

        return response()->json(['message' => 'Verified Successfully'], 200);
    }

    public function resendEmailCode(ResendEmailCodeRequest $request)
    {

        $email = $request->input('email');
        $client = Client::where('id', $request->user()->id)->where('email', $email)->firstOrFail();
        
        if ($client->email_verified) {
            return response()->json(['message' => 'This account is verified'], 400);
        }

        $client->email_verification_code = rand(1001, 9999);
        $client->email_expired_at = Carbon::now()->addDays(3);
        $client->save();

        $this->sendEmail($client, 'send_email_verification_code', [
            'verification_code' => $client->email_verification_code,
            'expired_at' => $client->email_expired_at,
        ]);

        return response()->json([
                'message' => 'Verification code has been sent to your email',
            ], 200);
    }
}
