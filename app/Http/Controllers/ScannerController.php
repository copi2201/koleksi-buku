<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;

class ScannerController extends Controller
{
    // Menampilkan halaman scanner
    public function index()
    {
        return view('scanner');
    }

    // Mencari barang berdasarkan kode barcode
    public function search($kode)
{
    $barang = Barang::where('id_barang', $kode)->first();

    if ($barang) {
        return response()->json([
            'status' => true,
            'data' => $barang
        ]);
    } else {
        return response()->json([
            'status' => false,
            'data' => null
        ]);
    }
}
}