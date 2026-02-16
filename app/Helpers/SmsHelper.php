<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class SmsHelper
{
    public static function send($phone, $message)
    {
        $token = config('services.sendlk.token');
        $sender = config('services.sendlk.sender');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ])->post('https://sms.send.lk/api/v3/sms/send', [
            'recipient' => $phone,
            'sender_id' => $sender,
            'message' => $message,
        ]);

        return $response->json();
    }

    public static function sendOtp($phone, $otp)
    {
        $message = "Your OTP code is: $otp";
        return self::send($phone, $message);
    }
}
