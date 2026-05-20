<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /*
    |--------------------------------------------------------------------------
    | TAMBAHAN BARU (TIDAK MENGUBAH LOGIN LAMA)
    |--------------------------------------------------------------------------
    | Setelah login berhasil:
    | - admin ke /home
    | - vendor ke /vendor/dashboard
    | - selain itu tetap /home
    */

    protected function authenticated(Request $request, $user)
    {
        if ($user->role == 'vendor') {
            return redirect('/vendor/dashboard');
        }

        if ($user->role == 'admin') {
            return redirect('/home');
        }

        return redirect('/home');
    }

    /*
    |--------------------------------------------------------------------------
    | TAMBAHAN OPSIONAL
    |--------------------------------------------------------------------------
    | Tetap login menggunakan email
    */

    public function username()
    {
        return 'email';
    }
}