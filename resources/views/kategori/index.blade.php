@extends('layouts.app')

@section('content')
<div class="page-header">
    <h3 class="page-title"> Data Kategori </h3>
</div>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                {{-- 1. Tombol Tambah hanya untuk Admin --}}
                @if(Auth::user()->role == 'admin')
                    <a href="{{ route('kategori.create') }}" class="btn btn-gradient-primary mb-3">Tambah Kategori</a>
                @endif
                
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="50px"> No </th>
                            <th> Nama Kategori </th>
                            {{-- 2. Header kolom Aksi hanya untuk Admin --}}
                            @if(Auth::user()->role == 'admin')
                                <th width="200px"> Aksi </th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kategori as $key => $k)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $k->nama_kategori }}</td>
                            
                            {{-- 3. Isi kolom Aksi (Edit & Hapus) hanya untuk Admin --}}
                            @if(Auth::user()->role == 'admin')
                            <td>
                                <a href="{{ route('kategori.edit', $k->idkategori) }}" class="btn btn-sm btn-warning text-white">Edit</a>
                                
                                <form action="{{ route('kategori.destroy', $k->idkategori) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus kategori ini?')">Hapus</button>
                                </form>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection