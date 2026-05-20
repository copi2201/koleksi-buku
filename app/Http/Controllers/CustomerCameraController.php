<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerCameraController extends Controller
{
    public function index()
    {
        $customers = DB::table('customers')->latest()->get();

        return view('customer_camera.index', compact('customers'));
    }

    public function createBlob()
    {
        return view('customer_camera.create_blob');
    }

    public function storeBlob(Request $request)
    {
        DB::table('customers')->insert([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'provinsi' => $request->provinsi,
            'kota' => $request->kota,
            'kecamatan' => $request->kecamatan,
            'kodepos_kelurahan' => $request->kodepos_kelurahan,
            'foto_blob' => $request->foto,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/customer-camera')
            ->with('success', 'Data customer berhasil ditambahkan');
    }

    public function createFile()
    {
        return view('customer_camera.create_file');
    }

    public function storeFile(Request $request)
    {
        $fotoBase64 = $request->foto;

        $fotoBase64 = str_replace('data:image/png;base64,', '', $fotoBase64);
        $fotoBase64 = str_replace(' ', '+', $fotoBase64);

        $namaFile = 'customer_' . time() . '.png';
        $folder = public_path('uploads/customer');

        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }

        file_put_contents($folder . '/' . $namaFile, base64_decode($fotoBase64));

        DB::table('customers')->insert([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'provinsi' => $request->provinsi,
            'kota' => $request->kota,
            'kecamatan' => $request->kecamatan,
            'kodepos_kelurahan' => $request->kodepos_kelurahan,
            'foto_path' => 'uploads/customer/' . $namaFile,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/customer-camera')
            ->with('success', 'Data customer berhasil ditambahkan');
    }

    public function edit($id)
    {
        $customer = Customer::findOrFail($id);

        return view('customer_camera.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);

        $customer->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'provinsi' => $request->provinsi,
            'kota' => $request->kota,
            'kecamatan' => $request->kecamatan,
            'kodepos_kelurahan' => $request->kodepos_kelurahan,
        ]);

        return redirect('/customer-camera')
            ->with('success', 'Data customer berhasil diupdate');
    }

    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);

        if ($customer->foto_path) {
            $path = public_path($customer->foto_path);

            if (file_exists($path)) {
                unlink($path);
            }
        }

        $customer->delete();

        return redirect('/customer-camera')
            ->with('success', 'Data customer berhasil dihapus');
    }
}