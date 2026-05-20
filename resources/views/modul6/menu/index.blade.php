<!DOCTYPE html>
<html>
<head>
    <title>Data Menu</title>

    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
            padding:30px;
            background:#f5f5f5;
        }

        h1{
            color:#6f42c1;
            margin-bottom:20px;
        }

        .btn{
            padding:10px 15px;
            text-decoration:none;
            border-radius:6px;
            color:white;
            display:inline-block;
            margin-right:8px;
            margin-bottom:15px;
            font-size:14px;
        }

        .tambah{ background:green; }
        .kembali{ background:#6f42c1; }
        .edit{ background:orange; }
        .hapus{ background:red; }

        table{
            width:100%;
            border-collapse:collapse;
            background:white;
            margin-top:10px;
            box-shadow:0 2px 8px rgba(0,0,0,0.08);
        }

        th, td{
            padding:12px;
            border:1px solid #ddd;
            text-align:left;
        }

        th{
            background:#6f42c1;
            color:white;
        }

        tr:nth-child(even){ background:#fafafa; }
        tr:hover{ background:#f0ebff; }
    </style>
</head>

<body>

<h1>📋 Data Menu</h1>

@if(auth()->user()->role === 'admin')
    <a href="{{ route('modul6.menu.create') }}" class="btn tambah">+ Tambah Menu</a>
    <a href="{{ route('modul6.admin.index') }}" class="btn kembali">Kembali</a>
@else
    <a href="{{ route('vendor.menu.create') }}" class="btn tambah">+ Tambah Menu</a>
    <a href="{{ route('vendor.dashboard') }}" class="btn kembali">Kembali</a>
@endif

<table>
    <tr>
        <th>No</th>
        <th>Nama Menu</th>
        <th>Harga</th>
        <th>Vendor</th>
        <th>Aksi</th>
    </tr>

    @foreach($menus as $key => $menu)
    <tr>
        <td>{{ $key + 1 }}</td>
        <td>{{ $menu->nama_menu }}</td>
        <td>Rp {{ number_format($menu->harga, 0, ',', '.') }}</td>
        <td>{{ $menu->nama_vendor }}</td>

        <td>
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('modul6.menu.edit', $menu->id) }}" class="btn edit">Edit</a>
                <a href="{{ route('modul6.menu.delete', $menu->id) }}"
                   class="btn hapus"
                   onclick="return confirm('Yakin hapus data ini?')">
                    Hapus
                </a>
            @else
                <a href="{{ route('vendor.menu.edit', $menu->id) }}" class="btn edit">Edit</a>
                <a href="{{ route('vendor.menu.delete', $menu->id) }}"
                   class="btn hapus"
                   onclick="return confirm('Yakin hapus data ini?')">
                    Hapus
                </a>
            @endif
        </td>
    </tr>
    @endforeach
</table>

</body>
</html>