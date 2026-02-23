@extends('layouts.app')

@section('content')
<div class="auth-form-light text-left p-5">
    <div class="brand-logo">
        <img src="{{ asset('assets/images/logo.svg') }}">
    </div>
    <h4>Halo! Mari kita mulai</h4>
    <h6 class="font-weight-light">Masuk untuk melanjutkan.</h6>
    
    <form class="pt-3" method="POST" action="{{ route('login') }}">
        @csrf
        {{-- Email Input --}}
        <div class="form-group">
            <input type="email" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="Email Address" value="{{ old('email') }}" required autofocus>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Password Input --}}
        <div class="form-group">
            <input type="password" name="password" class="form-control form-control-lg @error('password') is-invalid @enderror" placeholder="Password" required>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Sign In Button --}}
        <div class="mt-3">
            <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
        </div>

        <div class="my-2 d-flex justify-content-between align-items-center">
            <div class="form-check">
                <label class="form-check-label text-muted">
                    <input type="checkbox" name="remember" class="form-check-input"> Ingat saya 
                </label>
            </div>
            <a href="#" class="auth-link text-black">Lupa password?</a>
        </div>

        {{-- Google Login Button - Sesuai Modul --}}
        <div class="mb-2 mt-3">
            <a href="{{ route('google.login') }}" class="btn btn-block btn-danger auth-form-btn">
                <i class="mdi mdi-google me-2"></i> Connect using Google 
            </a>
        </div>

        {{-- Register Link --}}
        <div class="text-center mt-4 font-weight-light"> 
            Belum punya akun? <a href="{{ route('register') }}" class="text-primary">Daftar</a>
        </div>
    </form>
</div>
@endsection