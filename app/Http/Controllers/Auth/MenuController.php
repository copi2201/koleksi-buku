<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            $menus = DB::table('modul6_menus')
                ->join('modul6_vendors', 'modul6_menus.vendor_id', '=', 'modul6_vendors.id')
                ->select('modul6_menus.*', 'modul6_vendors.nama_vendor')
                ->get();
        } else {
            $vendor = DB::table('modul6_vendors')->where('email', $user->email)->first();

            if (!$vendor) {
                return redirect('/vendor/dashboard')->with('error', 'Data vendor tidak ditemukan.');
            }

            $menus = DB::table('modul6_menus')
                ->join('modul6_vendors', 'modul6_menus.vendor_id', '=', 'modul6_vendors.id')
                ->where('modul6_menus.vendor_id', $vendor->id)
                ->select('modul6_menus.*', 'modul6_vendors.nama_vendor')
                ->get();
        }

        return view('modul6.menu.index', compact('menus'));
    }

    public function create()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            $vendors = DB::table('modul6_vendors')->get();
        } else {
            $vendor = DB::table('modul6_vendors')->where('email', $user->email)->first();

            if (!$vendor) {
                return redirect('/vendor/dashboard')->with('error', 'Data vendor tidak ditemukan.');
            }

            $vendors = collect([$vendor]);
        }

        return view('modul6.menu.create', compact('vendors'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            $request->validate([
                'vendor_id' => 'required',
                'nama_menu' => 'required',
                'harga' => 'required|numeric',
            ]);

            $vendorId = $request->vendor_id;
        } else {
            $vendor = DB::table('modul6_vendors')->where('email', $user->email)->first();

            if (!$vendor) {
                return redirect('/vendor/dashboard')->with('error', 'Data vendor tidak ditemukan.');
            }

            $request->validate([
                'nama_menu' => 'required',
                'harga' => 'required|numeric',
            ]);

            $vendorId = $vendor->id;
        }

        DB::table('modul6_menus')->insert([
            'vendor_id' => $vendorId,
            'nama_menu' => $request->nama_menu,
            'harga' => $request->harga,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect($user->role === 'admin' ? '/modul6/menu' : '/vendor/menu')
            ->with('success', 'Menu berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $user = auth()->user();

        $menu = DB::table('modul6_menus')->where('id', $id)->first();

        if (!$menu) {
            return back()->with('error', 'Menu tidak ditemukan.');
        }

        if ($user->role === 'admin') {
            $vendors = DB::table('modul6_vendors')->get();
        } else {
            $vendor = DB::table('modul6_vendors')->where('email', $user->email)->first();

            if (!$vendor || $menu->vendor_id != $vendor->id) {
                return back()->with('error', 'Anda tidak boleh mengedit menu vendor lain.');
            }

            $vendors = collect([$vendor]);
        }

        return view('modul6.menu.edit', compact('menu', 'vendors'));
    }

    public function update(Request $request, $id)
    {
        $user = auth()->user();

        $menu = DB::table('modul6_menus')->where('id', $id)->first();

        if (!$menu) {
            return back()->with('error', 'Menu tidak ditemukan.');
        }

        if ($user->role === 'admin') {
            $vendorId = $request->vendor_id;
        } else {
            $vendor = DB::table('modul6_vendors')->where('email', $user->email)->first();

            if (!$vendor || $menu->vendor_id != $vendor->id) {
                return back()->with('error', 'Anda tidak boleh mengubah menu vendor lain.');
            }

            $vendorId = $vendor->id;
        }

        DB::table('modul6_menus')->where('id', $id)->update([
            'vendor_id' => $vendorId,
            'nama_menu' => $request->nama_menu,
            'harga' => $request->harga,
            'updated_at' => now(),
        ]);

        return redirect($user->role === 'admin' ? '/modul6/menu' : '/vendor/menu')
            ->with('success', 'Menu berhasil diperbarui.');
    }

    public function delete($id)
    {
        $user = auth()->user();

        $menu = DB::table('modul6_menus')->where('id', $id)->first();

        if (!$menu) {
            return back()->with('error', 'Menu tidak ditemukan.');
        }

        if ($user->role !== 'admin') {
            $vendor = DB::table('modul6_vendors')->where('email', $user->email)->first();

            if (!$vendor || $menu->vendor_id != $vendor->id) {
                return back()->with('error', 'Anda tidak boleh menghapus menu vendor lain.');
            }
        }

        DB::table('modul6_menus')->where('id', $id)->delete();

        return redirect($user->role === 'admin' ? '/modul6/menu' : '/vendor/menu')
            ->with('success', 'Menu berhasil dihapus.');
    }
}