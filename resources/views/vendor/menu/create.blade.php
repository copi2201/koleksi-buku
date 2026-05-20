<!DOCTYPE html>
<html>
<head>
    <title>Tambah Vendor</title>

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

        .form-box{
            background:white;
            width:400px;
            padding:25px;
            border-radius:8px;
            box-shadow:0 2px 8px rgba(0,0,0,0.08);
        }

        input{
            width:100%;
            padding:10px;
            margin-bottom:15px;
            border:1px solid #ccc;
            border-radius:6px;
        }

        .btn{
            padding:10px 15px;
            text-decoration:none;
            border:none;
            border-radius:6px;
            color:white;
            cursor:pointer;
            font-size:14px;
        }

        .simpan{
            background:green;
        }

        .kembali{
            background:#6f42c1;
            display:inline-block;
        }
    </style>
</head>
<body>

<h1>Tambah Vendor</h1>

<div class="form-box">
    <form action="{{ route('modul6.vendor.store') }}" method="POST">
        @csrf

        <label>Nama Vendor</label>
        <input type="text" name="nama_vendor" required>

        <label>Email</label>
        <input type="email" name="email">

        <label>Password</label>
        <input type="text" name="password">

        <button type="submit" class="btn simpan">Simpan</button>
        <a href="{{ route('modul6.vendor.index') }}" class="btn kembali">Kembali</a>
    </form>
</div>

</body>
</html>