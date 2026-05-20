<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WilayahController extends Controller
{
    public function index()
    {
        return view('modul5.wilayah');
    }

    public function getProvinsi()
    {
        // Nama tabel sesuai pgAdmin kamu: reg_provinces
        $data = DB::table('reg_provinces')->get();
        return response()->json($data);
    }

    public function getKota($id)
    {
        // Nama tabel reg_regencies, kolom relasinya biasanya province_id
        $data = DB::table('reg_regencies')
                ->where('province_id', $id)
                ->get();

        return response()->json($data);
    }

    public function getKecamatan($id)
    {
        // Nama tabel reg_districts, kolom relasinya regency_id
        $data = DB::table('reg_districts')
                ->where('regency_id', $id)
                ->get();

        return response()->json($data);
    }

    public function getKelurahan($id)
    {
        // Nama tabel reg_villages, kolom relasinya district_id
        $data = DB::table('reg_villages')
                ->where('district_id', $id)
                ->get();

        return response()->json($data);
    }
    public function posIndex()
    {
        return view('modul5.pos');
    }

public function getBarang($kode)
{
    // 1. Cari di tabel 'barang' (bukan reg_provinces!)
    // 2. Gunakan 'id_barang' sebagai kuncinya
    $barang = \App\Models\Barang::where('id_barang', $kode)->first();

    if ($barang) {
        return response()->json([
            'success' => true,
            'nama_barang' => $barang->nama, // Sesuai kolom 'nama' di BarangController
            'harga' => $barang->harga
        ]);
    }

    return response()->json([
        'success' => false,
        'message' => 'Barang tidak ditemukan'
    ], 404);
}
}