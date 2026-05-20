@extends('layouts.app')

@section('content')

<div class="page-header mb-4">
    <h3 class="page-title">Scanner QR Code Vendor</h3>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">

        <style>
            #qr-reader {
                width: 500px;
                border-radius: 15px;
                border: 3px solid #dcc8ff;
                overflow: hidden;
            }
        </style>

        <div id="qr-reader"></div>
        <div id="hasil" class="mt-3"></div>

    </div>
</div>

{{-- Suara beep --}}
<audio id="beep-sound" src="{{ asset('sounds/beep.mp3') }}" preload="auto"></audio>

<script src="https://unpkg.com/html5-qrcode"></script>

<script>
    let scanned = false;

    const html5QrCode = new Html5Qrcode("qr-reader");

    html5QrCode.start(
        { facingMode: "environment" },
        {
            fps: 10,
            qrbox: { width: 250, height: 250 }
        },
        function (decodedText) {

            if (scanned) return;
            scanned = true;

            // Bunyikan beep
            document.getElementById('beep-sound').play();

            fetch('/scanner-vendor/search/' + decodedText)
            .then(response => response.json())
            .then(result => {

                if (result.status) {

                    html5QrCode.stop();

                    document.getElementById('hasil').innerHTML = `
                        <div class="alert alert-success">
                            <h5>Vendor Ditemukan</h5>
                            <p>
                                <b>ID:</b> ${result.data.id}<br>
                                <b>Nama:</b> ${result.data.nama_vendor}<br>
                                <b>Email:</b> ${result.data.email}
                            </p>
                            <button onclick="location.reload()" class="btn btn-primary mt-2">
                                Scan Lagi
                            </button>
                        </div>
                    `;

                } else {

                    document.getElementById('hasil').innerHTML = `
                        <div class="alert alert-danger">
                            Vendor tidak ditemukan
                        </div>
                    `;

                    scanned = false;
                }

            });

        },
        function (errorMessage) {
            // abaikan error scan
        }
    );
</script>

@endsection