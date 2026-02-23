<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
{
    try {
        $userGoogle = Socialite::driver('google')->user();

        $user = User::updateOrCreate(
            ['email' => $userGoogle->getEmail()],
            [
                'name'      => $userGoogle->getName(),
                'id_google' => $userGoogle->getId(),
                'password'  => bcrypt(Str::random(16)),
            ]
        );

        $otp = strtoupper(Str::random(6));
        $user->update(['otp' => $otp]);

        Mail::raw("Kode OTP verifikasi Anda adalah: $otp", function ($message) use ($user) {
            $message->to($user->email)
                    ->subject('Kode Verifikasi OTP Login');
        });

        session()->put('otp_email', $user->email);

        return redirect()->route('otp.view');

    } catch (\Exception $e) {
        Log::error('Google Login Error: ' . $e->getMessage());
        return redirect()->route('login');
    }
}
}