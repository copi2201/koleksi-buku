@extends('layouts.app')

@section('content')

<div class="page-header mb-4">
    <h3 class="page-title">Scanner Barcode Barang</h3>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">

        <style>
            #scanner-container { width: 500px; }
            #scanner video {
                width: 100% !important;
                height: 350px !important;
                object-fit: cover;
                border-radius: 15px;
                border: 3px solid #dcc8ff;
            }
            canvas.drawingBuffer, canvas { display: none !important; }
        </style>

        <div id="scanner-container">
            <div id="scanner"></div>
        </div>

        <div id="hasil" class="mt-3"></div>

    </div>
</div>

{{-- Suara beep --}}
<audio id="beep-sound" src="{{ asset('sounds/beep.mp3') }}" preload="auto"></audio>

<script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    Quagga.init({
        inputStream: {
            name: "Live",
            type: "LiveStream",
            target: document.querySelector('#scanner'),
            constraints: {
                facingMode: "environment",
                width: 640,
                height: 480
            }
        },
        locator: { patchSize: "medium", halfSample: true },
        numOfWorkers: 2,
        decoder: {
            readers: ["code_128_reader", "code_39_reader"]
        },
        locate: true

    }, function(err) {
        if (err) {
            document.getElementById('hasil').innerHTML = `
                <div class="alert alert-danger">Kamera gagal dibuka</div>
            `;
            return;
        }
        Quagga.start();
    });

    let scanned = false;

    Quagga.onDetected(function(result) {

        if (scanned) return;
        scanned = true;

        // Bunyikan beep
        document.getElementById('beep-sound').play();

        let kode = result.codeResult.code;

        fetch('/scanner-barang/search/' + kode)
        .then(response => response.json())
        .then(result => {

            if (result.status) {

                Quagga.stop();

                document.getElementById('hasil').innerHTML = `
                    <div class="alert alert-success">
                        <h5>Barang Ditemukan</h5>
                        <p>
                            <b>ID:</b> ${result.data.id_barang}<br>
                            <b>Nama:</b> ${result.data.nama_barang}<br>
                            <b>Harga:</b> Rp ${result.data.harga}
                        </p>
                        <button onclick="location.reload()" class="btn btn-primary mt-2">
                            Scan Lagi
                        </button>
                    </div>
                `;

            } else {

                document.getElementById('hasil').innerHTML = `
                    <div class="alert alert-danger">Barang tidak ditemukan</div>
                `;

                scanned = false;
            }

        });

    });

});
</script>

@endsection