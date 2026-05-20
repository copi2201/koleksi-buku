@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Data Barang</h3>

    <div class="mb-3">
        <a href="{{ route('barang.create') }}" class="btn btn-primary">Tambah Barang</a>
    </div>

    <form action="{{ route('barang.cetak') }}" method="POST" target="_blank">
        @csrf

        <div class="row mb-3">
            <div class="col-md-3">
                <label>Mulai Baris (X: 1-8)</label>
                <input type="number" name="x" class="form-control" min="1" max="8" value="1" required>
            </div>

            <div class="col-md-3">
                <label>Mulai Kolom (Y: 1-5)</label>
                <input type="number" name="y" class="form-control" min="1" max="5" value="1" required>
            </div>

            <div class="col-md-3 d-flex align-items-end">
                <button type="submit" id="btnCetak" class="btn btn-success">
                    Cetak Label
                </button>
            </div>
        </div>

        <table id="tableBarang" class="table table-bordered">
            <thead>
                <tr>
                    <th>Pilih</th>
                    <th>ID Barang</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($barang as $item)
                <tr>
                    <td>
                        <input type="checkbox" name="barang_id[]" value="{{ $item->id_barang }}">
                    </td>

                    <td>{{ $item->id_barang }}</td>

                    <td>{{ $item->nama_barang }}</td>

                    <td>Rp {{ number_format($item->harga,0,',','.') }}</td>

                    <td>
                        <a href="{{ route('barang.edit',$item->id_barang) }}" 
                           class="btn btn-warning btn-sm">
                           Edit
                        </a>

                        <button type="button"
                            class="btn btn-danger btn-sm"
                            onclick="if(confirm('Yakin hapus?')) document.getElementById('delete-form-{{ $item->id_barang }}').submit();">
                            Hapus
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Data belum tersedia</td>
                </tr>
                @endforelse
            </tbody>

        </table>
    </form>

    @foreach ($barang as $item)
    <form id="delete-form-{{ $item->id_barang }}"
          action="{{ route('barang.destroy',$item->id_barang) }}"
          method="POST"
          style="display:none;">
        @csrf
        @method('DELETE')
    </form>
    @endforeach

</div>


{{-- JQuery --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

{{-- DataTables --}}
<link rel="stylesheet"
href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>

$(document).ready(function(){

    // aktifkan datatable
    $('#tableBarang').DataTable();

    // hover row
    $('#tableBarang tbody tr').hover(function(){
        $(this).css("cursor","pointer");
    });

    // tombol cetak spinner
    $('#btnCetak').click(function(){

        $(this).html(
        '<span class="spinner-border spinner-border-sm"></span> Memproses...'
        );

        $(this).prop('disabled',true);

    });

});

</script>

<style>
#tableBarang tbody tr:hover{
background:#f5f5f5;
}
</style> 

@endsection