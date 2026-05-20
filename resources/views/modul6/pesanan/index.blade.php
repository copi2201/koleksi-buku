@extends('layouts.app')

@section('content')
<div class="page-header">
    <h3 class="page-title">Data Pesanan Lunas</h3>
</div>

<div class="card">
    <div class="card-body">
        <h4 class="card-title">Pesanan dengan Status Pembayaran Lunas</h4>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Pesanan</th>
                        <th>Nama Customer</th>
                        <th>Total</th>
                        <th>Metode Bayar</th>
                        <th>Status Bayar</th>
                        <th>Status Pesanan</th>
                        <th>Waktu Bayar</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pesanan as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->kode_pesanan }}</td>
                            <td>{{ $item->nama_customer }}</td>
                            <td>Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                            <td>{{ $item->metode_bayar }}</td>
                            <td>
                                <label class="badge badge-success">
                                    {{ $item->status_bayar }}
                                </label>
                            </td>
                            <td>{{ $item->status_pesanan }}</td>
                            <td>{{ $item->waktu_bayar }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">
                                Belum ada pesanan lunas.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <a href="{{ route('modul6.admin.index') }}" class="btn btn-gradient-primary btn-sm mt-3">
            Kembali
        </a>
    </div>
</div>
@endsection