@extends('layouts.app')

@section('content')

<div class="page-header mb-4">
    <h3 class="page-title">Scanner QR Pesanan</h3>
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

                    let p = result.data;

                    let badgeStatus = p.status_bayar == 'Lunas'
                        ? '<span style="background:#28a745;color:white;padding:3px 10px;border-radius:20px;font-size:12px;">Lunas</span>'
                        : '<span style="background:#dc3545;color:white;padding:3px 10px;border-radius:20px;font-size:12px;">' + p.status_bayar + '</span>';

                    document.getElementById('hasil').innerHTML = `
                        <div class="alert alert-success">
                            <h5>✅ Pesanan Ditemukan</h5>
                            <table style="width:100%;margin-top:10px;">
                                <tr>
                                    <td style="padding:5px;color:#555;">Kode Pesanan</td>
                                    <td style="padding:5px;"><b>${p.kode_pesanan}</b></td>
                                </tr>
                                <tr>
                                    <td style="padding:5px;color:#555;">Nama Customer</td>
                                    <td style="padding:5px;">${p.nama_customer}</td>
                                </tr>
                                <tr>
                                    <td style="padding:5px;color:#555;">Total</td>
                                    <td style="padding:5px;"><b>Rp ${Number(p.total).toLocaleString('id-ID')}</b></td>
                                </tr>
                                <tr>
                                    <td style="padding:5px;color:#555;">Metode Bayar</td>
                                    <td style="padding:5px;">${p.metode_bayar}</td>
                                </tr>
                                <tr>
                                    <td style="padding:5px;color:#555;">Status Bayar</td>
                                    <td style="padding:5px;">${badgeStatus}</td>
                                </tr>
                                <tr>
                                    <td style="padding:5px;color:#555;">Status Pesanan</td>
                                    <td style="padding:5px;">${p.status_pesanan}</td>
                                </tr>
                            </table>
                            <button onclick="location.reload()" class="btn btn-primary mt-3">
                                Scan Lagi
                            </button>
                        </div>
                    `;

                } else {

                    document.getElementById('hasil').innerHTML = `
                        <div class="alert alert-danger">
                            ❌ Pesanan tidak ditemukan
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