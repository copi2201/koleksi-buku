<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class VendorController extends Controller
{
    public function index()
    {
        $vendors = DB::table('modul6_vendors')->get();
        return view('modul6.vendor.index', compact('vendors'));
    }

    public function create()
    {
        return view('modul6.vendor.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_vendor' => 'required|string|max:255',
            'email' => 'required|email|unique:modul6_vendors,email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        DB::beginTransaction();

        try {
            DB::table('modul6_vendors')->insert([
                'nama_vendor' => $request->nama_vendor,
                'email' => $request->email,
                'password' => $request->password,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            User::create([
                'name' => $request->nama_vendor,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'vendor',
            ]);

            DB::commit();

            return redirect('/modul6/vendor')->with('success', 'Vendor berhasil ditambahkan.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Gagal menambahkan vendor.');
        }
    }

    public function edit($id)
    {
        $vendor = DB::table('modul6_vendors')->where('id', $id)->first();
        return view('modul6.vendor.edit', compact('vendor'));
    }

    public function update(Request $request, $id)
    {
        $vendorLama = DB::table('modul6_vendors')->where('id', $id)->first();

        if (!$vendorLama) {
            return redirect('/modul6/vendor')->with('error', 'Vendor tidak ditemukan.');
        }

        DB::beginTransaction();

        try {
            DB::table('modul6_vendors')->where('id', $id)->update([
                'nama_vendor' => $request->nama_vendor,
                'email' => $request->email,
                'password' => $request->password,
                'updated_at' => now(),
            ]);

            $user = User::where('email', $vendorLama->email)->first();

            if ($user) {
                $user->name = $request->nama_vendor;
                $user->email = $request->email;

                if (!empty($request->password)) {
                    $user->password = Hash::make($request->password);
                }

                $user->role = 'vendor';
                $user->save();
            }

            DB::commit();

            return redirect('/modul6/vendor')->with('success', 'Vendor berhasil diupdate.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Gagal update vendor.');
        }
    }

    public function delete($id)
    {
        $vendor = DB::table('modul6_vendors')->where('id', $id)->first();

        if ($vendor) {
            DB::beginTransaction();

            try {
                User::where('email', $vendor->email)->delete();
                DB::table('modul6_menus')->where('vendor_id', $id)->delete();
                DB::table('modul6_vendors')->where('id', $id)->delete();

                DB::commit();

                return redirect('/modul6/vendor')->with('success', 'Vendor berhasil dihapus.');
            } catch (\Throwable $e) {
                DB::rollBack();
                return redirect('/modul6/vendor')->with('error', 'Gagal hapus vendor.');
            }
        }

        return redirect('/modul6/vendor')->with('error', 'Vendor tidak ditemukan.');
    }

    public function qrcode($id)
    {
        $vendor = DB::table('modul6_vendors')->where('id', $id)->first();

        if (!$vendor) {
            return redirect('/modul6/vendor')->with('error', 'Vendor tidak ditemukan.');
        }

        $qrcode = QrCode::size(300)->generate((string) $id);

        return view('modul6.vendor.qrcode', compact('vendor', 'qrcode'));
    }
}