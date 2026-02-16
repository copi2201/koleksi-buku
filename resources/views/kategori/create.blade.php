@extends('layouts.app')

@section('content')
<h3>Tambah Kategori</h3>

<form action="{{ route('kategori.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label class="form-label">Nama Kategori</label>
        <input type="text" name="nama_kategori" class="form-control">
    </div>

    <button type="submit" class="btn btn-success">Simpan</button>
</form>
@endsection
