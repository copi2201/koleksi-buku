@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-body">

        <h3>Edit Customer</h3>

        <form action="{{ route('customer.update', $customer->id) }}"
            method="POST">

            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label>Nama</label>

                <input type="text"
                    name="nama"
                    class="form-control"
                    value="{{ $customer->nama }}">
            </div>

            <div class="form-group mb-3">
                <label>Alamat</label>

                <input type="text"
                    name="alamat"
                    class="form-control"
                    value="{{ $customer->alamat }}">
            </div>

            <button type="submit"
                class="btn btn-primary">
                Update
            </button>

        </form>

    </div>
</div>

@endsection