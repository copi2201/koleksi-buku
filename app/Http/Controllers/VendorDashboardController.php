<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Menu;

class VendorDashboardController extends Controller
{
    public function index()
    {
        $vendor = Auth::user();

        $menus = Menu::where('user_id', $vendor->id)->get();
        $totalMenu = $menus->count();

        return view('vendor.dashboard', compact('vendor', 'menus', 'totalMenu'));
    }
}