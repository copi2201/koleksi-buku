@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-body">

        <h4>Tambah Customer 1 (Blob)</h4>

        <form action="{{ route('customer.storeBlob') }}"
            method="POST">

            @csrf

            <div class="form-group">
                <label>Nama</label>

                <input type="text"
                    name="nama"
                    class="form-control"
                    required>
            </div>

            <div class="form-group">
                <label>Alamat</label>

                <textarea name="alamat"
                    class="form-control"></textarea>
            </div>

            <video id="video"
                width="300"
                autoplay>
            </video>

            <canvas id="canvas"
                width="300"
                height="200"
                style="display:none;">
            </canvas>

            <input type="hidden"
                name="foto"
                id="foto">

            <br><br>

            <button type="button"
                onclick="takeSnapshot()"
                class="btn btn-warning">
                Ambil Foto
            </button>

            <button type="submit"
                class="btn btn-primary">
                Simpan
            </button>

        </form>

    </div>
</div>

<script>
navigator.mediaDevices.getUserMedia({
    video: true
})
.then(function(stream) {

    document.getElementById('video').srcObject = stream;

});

function takeSnapshot()
{
    let canvas = document.getElementById('canvas');

    let video = document.getElementById('video');

    canvas.getContext('2d')
        .drawImage(video, 0, 0, 300, 200);

    let image = canvas.toDataURL('image/png');

    document.getElementById('foto').value = image;

    alert('Foto berhasil diambil');
}
</script>

@endsection