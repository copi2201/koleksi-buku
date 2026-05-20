@extends('layouts.app')

@section('content')

<div class="page-header mb-4">
    <h3 class="page-title">QR Code Vendor</h3>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body text-center">

        <h5 class="mb-1">{{ $vendor->nama_vendor }}</h5>
        <p class="text-muted mb-4">{{ $vendor->email }}</p>

        <div class="mb-4">
            {!! $qrcode !!}
        </div>

        <p class="text-muted small">Scan QR Code ini untuk melihat informasi vendor</p>

        <a href="{{ url('/modul6/vendor') }}" class="btn btn-secondary mt-2">
            Kembali
        </a>

    </div>
</div>

@endsection