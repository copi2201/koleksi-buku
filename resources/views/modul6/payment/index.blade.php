<!DOCTYPE html>
<html>
<head>
    <title>Payment Gateway</title>

    <script
        src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}">
    </script>

    <style>
        body{
            font-family: Arial, sans-serif;
            background:#f5f5f5;
            padding:50px;
        }

        .box{
            width:420px;
            background:white;
            padding:30px;
            border-radius:12px;
            box-shadow:0 0 15px rgba(0,0,0,0.1);
        }

        h1{
            color:#6f42c1;
            margin-bottom:25px;
        }

        p{
            font-size:20px;
            margin-bottom:15px;
        }

        .btn{
            padding:12px 20px;
            color:white;
            border:none;
            border-radius:8px;
            cursor:pointer;
            font-size:16px;
            margin-right:10px;
            margin-bottom:10px;
        }

        .bayar{ background:green; }

        .kembali{
            background:#6f42c1;
            text-decoration:none;
            display:inline-block;
        }

        .btn:hover{ opacity:0.9; }
    </style>
</head>
<body>

<div class="box">
    <h1>💳 Payment Gateway</h1>

    <p>Menu: <b>{{ $menu->nama_menu }}</b></p>
    <p>Vendor: <b>{{ $menu->nama_vendor ?? '-' }}</b></p>
    <p>Total Bayar: <b>Rp {{ number_format($menu->harga, 0, ',', '.') }}</b></p>

    <button type="button" id="btnBayar" class="btn bayar">Bayar Sekarang</button>
    <a href="{{ route('landing') }}" class="btn kembali">Kembali</a>
</div>

<script>
let currentOrderId = null;

function updateStatusDanRedirect() {
    fetch("{{ route('payment.updateStatus') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({
            order_id: currentOrderId
        })
    })
    .then(response => response.json())
    .then(data => {
        window.location.href = "{{ route('payment.success') }}?order_id=" + currentOrderId;
    })
    .catch(error => {
        console.log(error);
        alert("Gagal update status pembayaran.");
    });
}

document.getElementById("btnBayar").addEventListener("click", function () {
    fetch("{{ route('payment.bayar') }}?menu_id={{ $menu->id }}")
    .then(response => response.json())
    .then(data => {
        if (data.token) {
            currentOrderId = data.order_id;

            snap.pay(data.token, {
                onSuccess: function(result){
                    updateStatusDanRedirect();
                },

                onPending: function(result){
                    updateStatusDanRedirect();
                },

                onError: function(result){
                    alert("Pembayaran gagal");
                    console.log(result);
                },

                onClose: function(){
                    alert("Popup ditutup sebelum bayar selesai.");
                }
            });

        } else {
            alert(data.error || "Token Midtrans gagal dibuat");
        }
    })
    .catch(error => {
        console.log(error);
        alert("Terjadi error!");
    });
});
</script>

</body>
</html>