@extends('layouts.app')

@section('content')
<div class="auth-form-light text-left p-5">
    <div class="brand-logo">
        {{-- Pastikan logo mengarah ke asset yang benar --}}
        <img src="{{ asset('assets/images/logo.svg') }}" alt="logo">
    </div>
    <h4>Baru di sini?</h4>
    <h6 class="font-weight-light">Daftar sekarang untuk mulai mengelola koleksi buku Anda.</h6>
    
    <form class="pt-3" method="POST" action="{{ route('register') }}">
        @csrf

        {{-- Input Nama --}}
        <div class="form-group">
            <input id="name" type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" 
                   name="name" value="{{ old('name') }}" placeholder="Nama Lengkap" required autocomplete="name" autofocus>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Input Email --}}
        <div class="form-group">
            <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" 
                   name="email" value="{{ old('email') }}" placeholder="Alamat Email" required autocomplete="email">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Input Password --}}
        <div class="form-group">
            <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" 
                   name="password" placeholder="Password" required autocomplete="new-password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Input Konfirmasi Password --}}
        <div class="form-group">
            <input id="password-confirm" type="password" class="form-control form-control-lg" 
                   name="password_confirmation" placeholder="Konfirmasi Password" required autocomplete="new-password">
        </div>

        {{-- Tombol Daftar --}}
        <div class="mt-3">
            <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">
                DAFTAR
            </button>
        </div>

        {{-- Link Kembali ke Login --}}
        <div class="text-center mt-4 font-weight-light">
            Sudah memiliki akun? <a href="{{ route('login') }}" class="text-primary">Login sekarang</a>
        </div>
    </form>
</div>
@endsection