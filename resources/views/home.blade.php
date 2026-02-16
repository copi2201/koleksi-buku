@extends('layouts.app')

@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span> Dashboard
    </h3>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active">
                Status: <span class="badge {{ Auth::user()->role == 'admin' ? 'badge-danger' : 'badge-info' }}">
                    {{ strtoupper(Auth::user()->role) }}
                </span>
            </li>
        </ul>
    </nav>
</div>

<div class="row">
    {{-- TAMPILAN KHUSUS ADMIN --}}
    @if(Auth::user()->role == 'admin')
    <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-danger card-img-holder text-white">
            <div class="card-body">
                <h4 class="font-weight-normal mb-3">Total Kategori <i class="mdi mdi-buffer mdi-24px float-right"></i></h4>
                <h2 class="mb-5">{{ \App\Models\Kategori::count() }}</h2>
                <h6 class="card-text">Kelola kategori buku</h6>
            </div>
        </div>
    </div>
    <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-info card-img-holder text-white">
            <div class="card-body">
                <h4 class="font-weight-normal mb-3">Total Buku <i class="mdi mdi-book-open-variant mdi-24px float-right"></i></h4>
                <h2 class="mb-5">{{ \App\Models\Buku::count() }}</h2>
                <h6 class="card-text">Kelola semua judul buku</h6>
            </div>
        </div>
    </div>
    <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-success card-img-holder text-white">
            <div class="card-body">
                <h4 class="font-weight-normal mb-3">Data User <i class="mdi mdi-account mdi-24px float-right"></i></h4>
                <h2 class="mb-5">{{ \App\Models\User::count() }}</h2>
                <h6 class="card-text">User terdaftar di sistem</h6>
            </div>
        </div>
    </div>

    {{-- TAMPILAN KHUSUS USER BIASA --}}
    @else
    <div class="col-12 grid-margin stretch-card">
        <div class="card bg-gradient-info text-white">
            <div class="card-body">
                <h4 class="mb-4">Selamat Datang, {{ Auth::user()->name }}!</h4>
                <p>Anda login sebagai <strong>User</strong>. Anda dapat melihat daftar buku yang tersedia.</p>
                <a href="{{ url('/buku') }}" class="btn btn-light btn-fw text-dark">Mulai Lihat Buku</a>
            </div>
        </div>
    </div>
    @endif
</div>

{{-- Tombol Logout --}}
<div class="row">
    <div class="col-12 text-center mt-4">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-gradient-primary btn-icon-text">
                <i class="mdi mdi-logout btn-icon-prepend"></i> Logout Dari Sistem
            </button>
        </form>
    </div>
</div>
@endsection