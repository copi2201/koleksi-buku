@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Edit Barang</h3>

    <form method="POST" action="{{ route('barang.update', $barang->id_barang) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" value="{{ $barang->nama }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" value="{{ $barang->harga }}" class="form-control" required>
        </div>

        <button class="btn btn-warning">Update</button>
    </form>
</div>
@endsection