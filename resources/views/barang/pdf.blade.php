<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">

<style>

    @page {
        size: A4 landscape;
        margin: 0;
    }

    body {
        margin: 0;
        padding: 0;
        font-family: Helvetica, sans-serif;
    }

    table {
        border-collapse: separate;
        border-spacing: 0.2cm 0.2cm;
        table-layout: fixed;
        margin-left: 0.5cm;
        margin-top: 0.5cm;
    }

    td {
        width: 7cm;
        height: 4cm;
        padding: 10px;
        border: 1px solid #000;
        vertical-align: middle;
        text-align: center;
        overflow: hidden;
        background-color: #fff;
    }

    .container-label {
        width: 100%;
        text-align: center;
    }

    .barcode {
        width: 300px;
        height: 110px;
        margin-bottom: 8px;
    }

    .id-barang {
        font-size: 14px;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .nama {
        font-size: 14px;
        font-weight: bold;
        text-transform: uppercase;
        margin-bottom: 5px;
        display: block;
    }

    .harga {
        font-size: 15px;
        display: block;
    }

</style>

</head>

<body>

@php
    $renderer = new Picqer\Barcode\Renderers\PngRenderer();
    $barangIndex = 0;
    $currentCell = 1;
@endphp

<table>

@for ($row = 1; $row <= 8; $row++)
<tr>

    @for ($col = 1; $col <= 5; $col++)

    <td>

        @if ($currentCell >= $startPosition && isset($barang[$barangIndex]))

            <div class="container-label">

                @php
                    $barcode = (new Picqer\Barcode\Types\TypeCode39())
                        ->getBarcode($barang[$barangIndex]->id_barang);

                    $barcodePng = $renderer->render(
                        $barcode,
                        $barcode->getWidth() * 6,
                        120
                    );
                @endphp

                <img
                    class="barcode"
                    src="data:image/png;base64,{{ base64_encode($barcodePng) }}"
                >

                <div class="id-barang">
                    {{ $barang[$barangIndex]->id_barang }}
                </div>

                <div class="nama">
                    {{ $barang[$barangIndex]->nama }}
                </div>

                <div class="harga">
                    Rp {{ number_format($barang[$barangIndex]->harga, 0, ',', '.') }}
                </div>

            </div>

            @php $barangIndex++; @endphp

        @endif

    </td>

    @php $currentCell++; @endphp

    @endfor

</tr>
@endfor

</table>

</body>
</html>