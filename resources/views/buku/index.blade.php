@extends('layouts.app')

@section('content')
<div class="page-header">
    <h3 class="page-title"> Data Buku </h3>
</div>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                {{-- Tombol Tambah hanya untuk Admin --}}
                @if(Auth::user()->role == 'admin')
                    <a href="{{ route('buku.create') }}" class="btn btn-gradient-primary mb-3">Tambah Buku</a>
                @endif
                
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th> No </th>
                            <th> Kode </th>
                            <th> Judul </th>
                            <th> Pengarang </th>
                            <th> Kategori </th>
                            {{-- Kolom Aksi hanya muncul untuk Admin --}}
                            @if(Auth::user()->role == 'admin')
                                <th> Aksi </th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($buku as $key => $b)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $b->kode }}</td> 
                            <td>{{ $b->judul }}</td> 
                            <td>{{ $b->pengarang }}</td> 
                            <td>{{ $b->kategori->nama_kategori ?? 'Tanpa Kategori' }}</td> 
                            
                            {{-- Logika Tombol Aksi --}}
                            @if(Auth::user()->role == 'admin')
                            <td>
                                {{-- Tombol Edit --}}
                                <a href="{{ route('buku.edit', $b->idbuku) }}" class="btn btn-sm btn-warning">Edit</a>
                                
                                {{-- Form Hapus --}}
                                <form action="{{ route('buku.destroy', $b->idbuku) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
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