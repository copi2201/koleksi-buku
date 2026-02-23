<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class OtpController extends Controller
{
    public function showOtpForm()
    {
        // Pengecekan session sesuai alur login IdP [cite: 11]
        if (!session()->has('otp_email')) {
            return redirect()->route('login')->with('error', 'Sesi habis, silakan login ulang.');
        }
        return view('auth.otp'); 
    }

    public function verifyOtp(Request $request)
    {
        $request->validate(['otp' => 'required|string|size:6']);

        $user = User::where('email', session('otp_email'))
                    ->where('otp', $request->otp)
                    ->first();

        if ($user) {
            // LOGIKA ADMIN: Ganti dengan email Anda agar otomatis menjadi admin
            if ($user->email == 'cempreswawan@@gmail.com') {
                $user->role = 'admin';
            }

            $user->otp = null; // Sesuai instruksi: hapus OTP setelah verifikasi [cite: 13]
            $user->save(); 

            Auth::login($user); // Membuat sesi login resmi [cite: 13]
            session()->forget('otp_email'); 

            return redirect()->route('home'); // Redirect ke dashboard [cite: 13]
        }

        return back()->withErrors(['otp' => 'Kode OTP salah atau sudah kedaluwarsa.']);
    }
}