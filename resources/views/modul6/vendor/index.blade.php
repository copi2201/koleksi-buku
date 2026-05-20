<!DOCTYPE html>
<html>
<head>
    <title>Data Vendor</title>

    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            padding: 30px;
            background: #f0ebff;
        }

        h1 {
            color: #5a2d9c;
            margin-bottom: 5px;
            font-size: 26px;
        }

        .subtitle {
            color: #888;
            margin-bottom: 25px;
            font-size: 14px;
        }

        .btn {
            padding: 9px 16px;
            text-decoration: none;
            border-radius: 8px;
            color: white;
            display: inline-block;
            margin-right: 6px;
            margin-bottom: 15px;
            font-size: 13px;
            font-weight: 500;
            transition: opacity 0.2s;
        }

        .btn:hover {
            opacity: 0.85;
        }

        .btn-tambah  { background: #28a745; }
        .btn-kembali { background: #6f42c1; }
        .btn-edit    { background: #fd7e14; }
        .btn-hapus   { background: #dc3545; }
        .btn-qr      { background: #0d6efd; }

        .card {
            background: white;
            border-radius: 14px;
            box-shadow: 0 4px 16px rgba(111,66,193,0.10);
            overflow: hidden;
            margin-top: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #6f42c1;
            color: white;
            padding: 13px 15px;
            text-align: left;
            font-weight: 600;
            font-size: 13px;
            letter-spacing: 0.3px;
        }

        td {
            padding: 12px 15px;
            border-bottom: 1px solid #f0ebff;
            font-size: 14px;
            color: #333;
            vertical-align: middle;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover td {
            background: #faf7ff;
        }

        .badge-email {
            background: #f0ebff;
            color: #6f42c1;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 12px;
        }

        .no-data {
            text-align: center;
            padding: 40px;
            color: #aaa;
            font-size: 15px;
        }
    </style>
</head>

<body>

    <h1>Data Vendor</h1>
    <p class="subtitle">Kelola data vendor kantin di sini</p>

    <a href="{{ route('modul6.vendor.create') }}" class="btn btn-tambah">+ Tambah Vendor</a>
    <a href="{{ route('modul6.admin.index') }}" class="btn btn-kembali">← Kembali</a>

    <div class="card">
        <table>
            <tr>
                <th width="50">No</th>
                <th>Nama Vendor</th>
                <th>Email</th>
                <th width="220">Aksi</th>
            </tr>

            @forelse($vendors as $key => $vendor)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td><b>{{ $vendor->nama_vendor }}</b></td>
                <td><span class="badge-email">{{ $vendor->email }}</span></td>
                <td>
                    <a href="{{ route('modul6.vendor.edit', $vendor->id) }}" class="btn btn-edit">Edit</a>
                    <a href="{{ route('modul6.vendor.qr', $vendor->id) }}" class="btn btn-qr">QR Code</a>
                    <a href="{{ route('modul6.vendor.delete', $vendor->id) }}" class="btn btn-hapus"
                       onclick="return confirm('Yakin hapus vendor ini?')">Hapus</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="no-data">Belum ada data vendor</td>
            </tr>
            @endforelse
        </table>
    </div>

</body>
</html>