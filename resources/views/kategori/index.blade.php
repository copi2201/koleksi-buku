@extends('layouts.app')

@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-format-list-bulleted"></i>
        </span> Data Kategori
    </h3>
</div>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Daftar Kategori Buku</h4>
                <div class="mb-4">
                    <a href="{{ route('kategori.create') }}" class="btn btn-gradient-primary btn-icon-text">
                        <i class="mdi mdi-plus btn-icon-prepend"></i> Tambah Kategori
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="font-weight-bold"> No </th>
                                <th class="font-weight-bold"> Nama Kategori </th>
                                <th class="font-weight-bold text-center"> Aksi </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kategori as $index => $k)
                            <tr>
                                <td> {{ $index + 1 }} </td>
                                <td> {{ $k->nama_kategori }} </td>
                                <td class="text-center">
                                    <form action="{{ route('kategori.destroy', $k->idkategori) }}" method="POST">
                                        <a href="{{ route('kategori.edit', $k->idkategori) }}" class="btn btn-sm btn-warning text-white">
                                            <i class="mdi mdi-pencil"></i> Edit
                                        </a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">
                                            <i class="mdi mdi-delete"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection