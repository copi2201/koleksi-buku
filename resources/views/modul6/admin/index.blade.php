@extends('layouts.app')

@section('content')
<div class="page-header">
    <h3 class="page-title">Modul 6 - Kantin Online</h3>
</div>

<div class="row">
    <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data Vendor</h4>
                <p class="card-description">
                    Kelola data vendor kantin yang terdaftar dalam sistem.
                </p>
                <a href="{{ route('modul6.vendor.index') }}" class="btn btn-gradient-primary btn-sm">
                    Lihat Vendor
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data Menu</h4>
                <p class="card-description">
                    Kelola menu makanan dan minuman dari setiap vendor.
                </p>
                <a href="{{ route('modul6.menu.index') }}" class="btn btn-gradient-info btn-sm">
                    Lihat Menu
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-4 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Data Pesanan</h4>
            <p class="card-description">
                Melihat pesanan dengan status pembayaran “Lunas”.
            </p>
            <a href="{{ route('modul6.pesanan.index') }}" class="btn btn-gradient-success btn-sm">
                Lihat Pesanan
            </a>
        </div>
    </div>
</div>
@endsection