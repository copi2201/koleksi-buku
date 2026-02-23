<!DOCTYPE html>
<html>
<head>
    <style>
        /* Paksa ukuran A4 Landscape sesuai modul */
        @page { 
            size: A4 landscape; 
            margin: 0; 
        }
        body { 
            margin: 0; 
            padding: 0;
        }

        .bg-canva {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }
        /* Atur posisi teks nama */
        .nama-user {
            position: absolute;
            width: 100%;
            top: 48%; /* Atur angka ini (naik/turun) sampai pas di garis nama */
            text-align: center;
            font-family: 'Helvetica', sans-serif;
            font-size: 40pt;
            font-weight: bold;
            color: #000;
        }
    </style>
</head>
<body>
    <img src="{{ public_path('assets/images/sertifikat.png') }}" class="bg-canva">

    <div class="nama-user">
    </div>
</body>
</html>