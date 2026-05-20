<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function index()
    {
        $menus = DB::table('modul6_menus')
            ->join('modul6_vendors', 'modul6_menus.vendor_id', '=', 'modul6_vendors.id')
            ->select('modul6_menus.*', 'modul6_vendors.nama_vendor')
            ->get();

        return view('modul6.customer.index', compact('menus'));
    }
}