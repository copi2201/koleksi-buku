<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class BarangController extends Controller
{
    // ===============================
    // TAMPILKAN DATA
    // ===============================
    public function index()
    {
        $barang = Barang::all();

        return view('barang.index', compact('barang'));
    }

    // ===============================
    // FORM TAMBAH DATA
    // ===============================
    public function create()
    {
        return view('barang.create');
    }

    // ===============================
    // SIMPAN DATA
    // ===============================
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'harga' => 'required|numeric'
        ]);

        // AUTO GENERATE ID BARANG
        $lastBarang = Barang::orderBy('id_barang', 'desc')->first();

        if ($lastBarang) {
            $lastNumber = (int) substr($lastBarang->id_barang, 2);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        $id_barang = 'BR' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        Barang::create([
            'id_barang' => $id_barang,
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga
        ]);

        return redirect()->route('barang.index')
            ->with('success', 'Data berhasil ditambahkan');
    }

    // ===============================
    // FORM EDIT
    // ===============================
    public function edit($id)
    {
        $barang = Barang::findOrFail($id);

        return view('barang.edit', compact('barang'));
    }

    // ===============================
    // UPDATE DATA
    // ===============================
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required',
            'harga' => 'required|numeric'
        ]);

        $barang = Barang::findOrFail($id);

        $barang->update([
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga
        ]);

        return redirect()->route('barang.index')
            ->with('success', 'Data berhasil diupdate');
    }

    // ===============================
    // HAPUS DATA
    // ===============================
    public function destroy($id)
    {
        Barang::findOrFail($id)->delete();

        return redirect()->route('barang.index')
            ->with('success', 'Data berhasil dihapus');
    }

    // ===============================
    // FORM CETAK LABEL
    // ===============================
    public function formCetak()
    {
        $barang = Barang::all();

        return view('barang.cetak', compact('barang'));
    }

    // ===============================
    // CETAK PDF LABEL
    // ===============================
    public function cetak(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|array',
            'x' => 'required|integer|min:1|max:8',
            'y' => 'required|integer|min:1|max:5'
        ]);

        $barang = Barang::whereIn('id_barang', $request->barang_id)->get();

        $startPosition = (($request->x - 1) * 5) + $request->y;

        $pdf = Pdf::loadView(
            'barang.pdf',
            compact('barang', 'startPosition')
        )->setPaper('a4', 'landscape');

        return $pdf->stream('label-barang.pdf');
    }

    public function searchBarcode($kode)
{
    $barang = Barang::where('kode', $kode)->first();

    if (!$barang) {
        return response()->json([
            'status' => false,
            'message' => 'Barang tidak ditemukan'
        ]);
    }

    return response()->json([
        'status' => true,
        'data' => $barang
    ]);
}
}