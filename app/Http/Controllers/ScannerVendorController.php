<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScannerVendorController extends Controller
{
    public function index()
    {
        return view('scanner-vendor');
    }

    public function search($kode)
    {
        $pesanan = DB::table('modul6_pesanans')
            ->where('kode_pesanan', $kode)
            ->first();

        if ($pesanan) {
            return response()->json([
                'status' => true,
                'data' => $pesanan
            ]);
        } else {
            return response()->json([
                'status' => false,
                'data' => null
            ]);
        }
    }
}