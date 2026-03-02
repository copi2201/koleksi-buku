@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Tambah Barang</h3>

    <form method="POST" action="{{ route('barang.store') }}">
        @csrf

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control" required>
        </div>

        <button class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection