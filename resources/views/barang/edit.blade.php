@extends('layouts.app')

@section('content')

<div class="container">
    <h3>Edit Barang</h3>

    <form id="formEdit" method="POST" action="{{ route('barang.update', $barang->id_barang) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" value="{{ $barang->nama_barang }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" value="{{ $barang->harga }}" class="form-control" required>
        </div>

        <button id="btnUpdate" class="btn btn-warning">Update</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>

$(document).ready(function(){

    $('#formEdit').submit(function(){

        if(!this.checkValidity()){
            this.reportValidity();
            return false;
        }

        $('#btnUpdate').html(
        '<span class="spinner-border spinner-border-sm"></span> Mengupdate...'
        );

        $('#btnUpdate').prop('disabled',true);

    });

});

</script>

@endsection