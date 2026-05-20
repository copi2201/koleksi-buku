@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Tambah Barang</h3>

    <form id="formTambah" method="POST" action="{{ route('barang.store') }}">
        @csrf

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama_barang" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control" required>
        </div>

        <button id="btnSimpan" class="btn btn-primary">Simpan</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>

$(document).ready(function(){

    $('#formTambah').submit(function(){

        if(!this.checkValidity()){
            this.reportValidity();
            return false;
        }

        $('#btnSimpan').html(
        '<span class="spinner-border spinner-border-sm"></span> Menyimpan...'
        );

        $('#btnSimpan').prop('disabled',true);

    });

});

</script>

@endsection