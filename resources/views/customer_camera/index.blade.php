@extends('layouts.app')

@section('content')

<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-camera"></i>
        </span>
        Data Customer
    </h3>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">

        <div class="d-flex gap-2 mb-4">
            <a href="{{ url('/customer-camera/create-blob') }}"
               class="btn btn-gradient-primary btn-icon-text">
                <i class="mdi mdi-database btn-icon-prepend"></i>
                Tambah Customer (BLOB)
            </a>

            <a href="{{ url('/customer-camera/create-file') }}"
               class="btn btn-gradient-success btn-icon-text">
                <i class="mdi mdi-file-image btn-icon-prepend"></i>
                Tambah Customer (FILE)
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">

                <thead class="table-light">
                    <tr>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th class="text-center">Foto Blob</th>
                        <th class="text-center">Foto File</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($customers as $c)
                    <tr>

                        <td class="fw-bold">{{ $c->nama }}</td>

                        <td>{{ $c->alamat }}</td>

                        <td class="text-center">
                            @if($c->foto_blob)
                                <img src="{{ $c->foto_blob }}"
                                     width="90"
                                     height="90"
                                     style="object-fit: cover; border-radius: 12px;"
                                     class="shadow-sm border">
                            @endif
                        </td>

                        <td class="text-center">
                            @if($c->foto_path)
                                <img src="{{ asset($c->foto_path) }}"
                                     width="90"
                                     height="90"
                                     style="object-fit: cover; border-radius: 12px;"
                                     class="shadow-sm border">
                            @endif
                        </td>

                        <td class="text-center">

                            <a href="{{ route('customer.edit', $c->id) }}"
                               class="btn btn-sm btn-warning">
                                <i class="mdi mdi-pencil"></i>
                            </a>

                            <form action="{{ route('customer.destroy', $c->id) }}"
                                  method="POST"
                                  style="display:inline-block;">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-sm btn-danger"
                                        onclick="return confirm('Yakin ingin menghapus data ini?')">
                                    <i class="mdi mdi-delete"></i>
                                </button>
                            </form>

                        </td>

                    </tr>

                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">
                            Belum ada data customer
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

    </div>
</div>

@endsection