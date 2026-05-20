@extends('layouts.app')

@section('content')

<div class="content-wrapper">

    <div class="page-header">
        <h3 class="page-title">
            Dashboard Vendor
        </h3>
    </div>

    <div class="row">

        <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4>Nama Vendor</h4>
                    <h2 class="text-primary fw-bold">
                        {{ $vendor->name }}
                    </h2>
                </div>
            </div>
        </div>

        <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4>Role</h4>
                    <h2 class="fw-bold">
                        {{ ucfirst($vendor->role) }}
                    </h2>
                </div>
            </div>
        </div>

        <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4>Email</h4>
                    <h6 class="text-secondary fw-bold">
                        {{ $vendor->email }}
                    </h6>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection