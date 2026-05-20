<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
{
    public function index()
    {
        $pesanan = DB::table('modul6_pesanans')
            ->where('status_bayar', 'Lunas')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('modul6.pesanan.index', compact('pesanan'));
    }
}