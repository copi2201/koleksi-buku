@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Edit Buku</h4>
        <form action="{{ route('buku.update', $buku->idbuku) }}" method="POST">
            @csrf
            @method('PUT') {{-- WAJIB ADA untuk proses Update di Laravel --}}
            
            <div class="form-group">
                <label>Kode Buku</label>
                <input type="text" name="kode" class="form-control" value="{{ $buku->kode }}" required>
            </div>
            <div class="form-group">
                <label>Judul Buku</label>
                <input type="text" name="judul" class="form-control" value="{{ $buku->judul }}" required>
            </div>
            <div class="form-group">
                <label>Pengarang</label>
                <input type="text" name="pengarang" class="form-control" value="{{ $buku->pengarang }}" required>
            </div>
            <div class="form-group">
                <label>Kategori</label>
                <select name="idkategori" class="form-control" required>
                    @foreach($kategori as $k)
                        <option value="{{ $k->idkategori }}" {{ $buku->idkategori == $k->idkategori ? 'selected' : '' }}>
                            {{ $k->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update Data</button>
            <a href="{{ route('buku.index') }}" class="btn btn-light">Batal</a>
        </form>
    </div>
</div>
@endsection