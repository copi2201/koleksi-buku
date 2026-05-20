@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Customer (FILE)</title>

    <style>
        body{ font-family:Arial; padding:30px; background:#f5f5f5; }
        .box{ background:white; padding:20px; border-radius:10px; width:400px; }
        video, canvas{ width:100%; margin-top:10px; }
        button{ margin-top:10px; padding:10px; }
    </style>
</head>
<body>

<div class="box">
    <h3>Tambah Customer (FILE)</h3>

    <form method="POST" action="{{ route('camera.customer.storeFile') }}">
        @csrf

        <input type="text" name="nama" placeholder="Nama" required><br><br>
        <input type="text" name="alamat" placeholder="Alamat"><br><br>

        <video id="video" autoplay></video>
        <canvas id="canvas" style="display:none;"></canvas>

        <button type="button" onclick="capture()">Ambil Foto</button>

        <input type="hidden" name="foto" id="foto">

        <br>
        <button type="submit">Simpan</button>
    </form>
</div>

<script>
navigator.mediaDevices.getUserMedia({ video: true })
.then(stream => {
    document.getElementById('video').srcObject = stream;
});

function capture(){
    const canvas = document.getElementById('canvas');
    const video = document.getElementById('video');

    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;

    canvas.getContext('2d').drawImage(video, 0, 0);

    const data = canvas.toDataURL('image/png');

    document.getElementById('foto').value = data;

    alert("Foto berhasil diambil");
}
</script>

</body>
</html>

@endsection