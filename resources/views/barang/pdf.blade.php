<!DOCTYPE html>
<html>
<head>
    <style>
        .label {
            width: 12%;
            height: 90px;
            border: 1px solid black;
            float: left;
            text-align: center;
            font-size: 12px;
            padding-top: 20px;
        }
    </style>
</head>
<body>

@php
$totalSlot = 40;
$barangIndex = 0;
@endphp

@for($i = 1; $i <= $totalSlot; $i++)
    <div class="label">
        @if($i >= $startPosition && isset($barang[$barangIndex]))
            <strong>{{ $barang[$barangIndex]->nama }}</strong><br>
            Rp {{ number_format($barang[$barangIndex]->harga) }}
            @php $barangIndex++; @endphp
        @endif
    </div>
@endfor

</body>
</html>