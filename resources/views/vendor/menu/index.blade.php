<!DOCTYPE html>
<html>
<head>
    <title>Data Vendor</title>

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

        .tambah{
            background:green;
        }

        .kembali{
            background:#6f42c1;
        }

        .edit{
            background:orange;
        }

        .hapus{
            background:red;
        }

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

        tr:nth-child(even){
            background:#fafafa;
        }

        tr:hover{
            background:#f0ebff;
        }
    </style>
</head>

<body>

<h1>📋 Data Vendor</h1>

<a href="{{ route('modul6.vendor.create') }}" class="btn tambah">+ Tambah Vendor</a>
<a href="{{ route('modul6.admin.index') }}" class="btn kembali">⬅ Kembali</a>

<table>
    <tr>
        <th>No</th>
        <th>Nama Vendor</th>
        <th>Email</th>
        <th>Password</th>
        <th>Aksi</th>
    </tr>

    @foreach($vendors as $key => $vendor)
    <tr>
        <td>{{ $key + 1 }}</td>
        <td>{{ $vendor->nama_vendor }}</td>
        <td>{{ $vendor->email }}</td>
        <td>{{ $vendor->password }}</td>
        <td>
            <a href="{{ route('modul6.vendor.edit', $vendor->id) }}" class="btn edit">Edit</a>
            <a href="{{ route('modul6.vendor.delete', $vendor->id) }}" class="btn hapus"
               onclick="return confirm('Yakin hapus data ini?')">Hapus</a>
        </td>
    </tr>
    @endforeach
</table>

</body>
</html>