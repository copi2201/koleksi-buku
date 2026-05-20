@extends('layouts.app')

@section('content')
<div class="page-header">
    <h3 class="page-title"> Data Buku </h3>
</div>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(Auth::user()->role == 'admin')
                    <a href="{{ route('buku.create') }}" class="btn btn-gradient-primary mb-3">
                        Tambah Buku
                    </a>
                @endif
                
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Judul</th>
                            <th>Pengarang</th>
                            <th>Kategori</th>

                            @if(Auth::user()->role == 'admin')
                                <th>Aksi</th>
                            @endif
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($buku as $key => $b)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $b->kode }}</td> 
                            <td>{{ $b->judul }}</td> 
                            <td>{{ $b->pengarang }}</td> 
                            <td>{{ $b->kategori->nama_kategori ?? 'Tanpa Kategori' }}</td> 
                            
                            @if(Auth::user()->role == 'admin')
                            <td>
                                <a href="{{ route('buku.edit', $b->id) }}" class="btn btn-sm btn-warning">
                                    Edit
                                </a>
                                
                                <form action="{{ route('buku.destroy', $b->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="btn btn-sm btn-danger"
                                        onclick="return confirm('Yakin hapus?')">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                            @endif
                        </tr>
                        @empty
                        <tr>
                            <td colspan="{{ Auth::user()->role == 'admin' ? 6 : 5 }}" class="text-center">
                                Data buku belum tersedia
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
@endsection