<!DOCTYPE html>
<html>
<head>
    <title>Struk Pembayaran</title>

    <style>
        body{
            font-family: Arial, sans-serif;
            background:#f5f5f5;
            padding:40px;
        }

        .struk{
            width:420px;
            background:white;
            padding:25px;
            border-radius:12px;
            box-shadow:0 0 15px rgba(0,0,0,0.1);
            margin:auto;
        }

        h2{
            text-align:center;
            color:#6f42c1;
            margin-bottom:5px;
        }

        .subtitle{
            text-align:center;
            margin-bottom:20px;
            font-size:14px;
            color:#555;
        }

        .line{
            border-top:1px dashed #999;
            margin:15px 0;
        }

        .row{
            display:flex;
            justify-content:space-between;
            margin-bottom:10px;
            font-size:15px;
        }

        .label{
            color:#555;
        }

        .value{
            font-weight:bold;
            text-align:right;
        }

        .qr{
            text-align:center;
            margin-top:20px;
        }

        .btn{
            padding:12px 18px;
            color:white;
            border:none;
            border-radius:8px;
            cursor:pointer;
            font-size:15px;
            text-decoration:none;
            display:inline-block;
            margin:8px 4px 0 4px;
        }

        .download{
            background:green;
        }

        .print{
            background:orange;
        }

        .kembali{
            background:#6f42c1;
        }

        .btn-area{
            text-align:center;
            margin-top:20px;
        }

        @media print {
            body{
                background:white;
                padding:0;
            }

            .struk{
                box-shadow:none;
                border-radius:0;
            }

            .btn-area{
                display:none;
            }
        }
    </style>
</head>
<body>

<div class="struk" id="struk">
    <h2>Struk Pembayaran</h2>
    <div class="subtitle">Kantin Online</div>

    <div class="line"></div>

    @if($pesanan)
        <div class="row">
            <span class="label">ID Pesanan</span>
            <span class="value">{{ $pesanan->kode_pesanan }}</span>
        </div>

        <div class="row">
            <span class="label">Customer</span>
            <span class="value">{{ $pesanan->nama_customer }}</span>
        </div>

        <div class="row">
            <span class="label">Metode Bayar</span>
            <span class="value">{{ $pesanan->metode_bayar }}</span>
        </div>

        <div class="row">
            <span class="label">Status Bayar</span>
            <span class="value">{{ $pesanan->status_bayar }}</span>
        </div>

        <div class="row">
            <span class="label">Status Pesanan</span>
            <span class="value">{{ $pesanan->status_pesanan }}</span>
        </div>

        <div class="row">
            <span class="label">Waktu Bayar</span>
            <span class="value">
                {{ $pesanan->waktu_bayar ?? '-' }}
            </span>
        </div>

        <div class="line"></div>

        <div class="row">
            <span class="label">Total Bayar</span>
            <span class="value">
                Rp {{ number_format($pesanan->total, 0, ',', '.') }}
            </span>
        </div>

        <div class="line"></div>

        <div class="qr" id="qrBox">
            {!! QrCode::size(180)->generate($pesanan->kode_pesanan) !!}
            <p style="font-size:13px;">Scan QR untuk melihat ID pesanan</p>
        </div>
    @else
        <p style="text-align:center;color:red;">
            Data pesanan tidak ditemukan.
        </p>
    @endif

    <div class="btn-area">
        @if($pesanan)
            <button onclick="downloadQR()" class="btn download">Download QR</button>
            <button onclick="window.print()" class="btn print">Download Struk</button>
        @endif

        <a href="{{ route('landing') }}" class="btn kembali">Selesai</a>
    </div>
</div>

<script>
function downloadQR() {
    const svg = document.querySelector("#qrBox svg");

    if (!svg) {
        alert("QR tidak ditemukan.");
        return;
    }

    const serializer = new XMLSerializer();
    const svgString = serializer.serializeToString(svg);
    const blob = new Blob([svgString], { type: "image/svg+xml;charset=utf-8" });

    const url = URL.createObjectURL(blob);
    const link = document.createElement("a");

    link.href = url;
    link.download = "qr-pesanan-{{ $order_id }}.svg";
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);

    URL.revokeObjectURL(url);
}
</script>

</body>
</html>