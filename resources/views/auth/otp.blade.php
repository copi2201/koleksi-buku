@extends('layouts.app')

@section('content')
<div class="auth-form-light text-left p-5">
    <div class="brand-logo">
        <img src="{{ asset('assets/images/logo.svg') }}">
    </div>
    <h4>Verifikasi OTP</h4>
    <h6 class="font-weight-light">Masukkan 6 digit kode yang dikirim ke email Anda.</h6>
    
    <form class="pt-3" method="POST" action="{{ route('otp.verify') }}">
        @csrf
        <div class="form-group">
            <input type="text" name="otp" class="form-control form-control-lg text-center" 
                   placeholder="------" maxlength="6" style="letter-spacing: 10px; font-size: 24px;" required>
            @error('otp')
                <span class="text-danger small">{{ $message }}</span>
            @enderror
        </div>
        <div class="mt-3">
            <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">VERIFIKASI</button>
        </div>
        <div class="text-center mt-4 font-weight-light">
            Tidak menerima kode? <a href="#" class="text-primary">Kirim ulang</a>
        </div>
    </form>
</div>
@endsection