@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Data Barang</h3>

    <a href="{{ route('barang.create') }}" class="btn btn-primary mb-3">Tambah Barang</a>

    <form method="POST" action="{{ route('barang.cetak') }}">
        @csrf

        <table id="tableBarang" class="table table-bordered">
            <thead>
                <tr>
                    <th>Pilih</th>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($barang as $b)
                <tr>
                    <td>
                        <input type="checkbox" name="barang_id[]" value="{{ $b->id_barang }}">
                    </td>
                    <td>{{ $b->id_barang }}</td>
                    <td>{{ $b->nama }}</td>
                    <td>Rp {{ number_format($b->harga) }}</td>
                    <td>
                        <a href="{{ route('barang.edit', $b->id_barang) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('barang.destroy', $b->id_barang) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <hr>

        <h5>Posisi Cetak Label</h5>

        <label>X </label>
        <input type="number" name="x" min="1" max="8" required>

        <label>Y </label>
        <input type="number" name="y" min="1" max="5" required>

        <button type="submit" class="btn btn-success">Cetak Label</button>
    </form>
</div>

<script>
$(document).ready(function() {
    $('#tableBarang').DataTable();
});
</script>
@endsection