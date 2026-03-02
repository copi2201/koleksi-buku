<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class BarangController extends Controller
{
    // =========================
    // TAMPILKAN DATA (DATATABLES)
    // =========================
    public function index()
    {
        $barang = Barang::all();
        return view('barang.index', compact('barang'));
    }

    // =========================
    // SIMPAN DATA (ID dari trigger)
    // =========================
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'harga' => 'required|numeric'
        ]);

        Barang::create([
            'nama' => $request->nama,
            'harga' => $request->harga
        ]);

        return redirect()->route('barang.index')
                         ->with('success', 'Data berhasil ditambahkan');
    }

    // =========================
    // UPDATE DATA
    // =========================
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'harga' => 'required|numeric'
        ]);

        $barang = Barang::findOrFail($id);

        $barang->update([
            'nama' => $request->nama,
            'harga' => $request->harga
        ]);

        return redirect()->route('barang.index')
                         ->with('success', 'Data berhasil diupdate');
    }

    // =========================
    // DELETE
    // =========================
    public function destroy($id)
    {
        Barang::findOrFail($id)->delete();

        return redirect()->route('barang.index')
                         ->with('success', 'Data berhasil dihapus');
    }

    // =========================
    // FORM CETAK
    // =========================
    public function formCetak()
    {
        $barang = Barang::all();
        return view('barang.cetak', compact('barang'));
    }

    // =========================
    // GENERATE PDF LABEL 5x8
    // =========================
    public function cetak(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|array',
            'x' => 'required|integer|min:1|max:8',
            'y' => 'required|integer|min:1|max:5'
        ]);

        $barang = Barang::whereIn('id_barang', $request->barang_id)->get();

        $startPosition = (($request->y - 1) * 8) + $request->x;

        $pdf = Pdf::loadView('barang.pdf', [
            'barang' => $barang,
            'startPosition' => $startPosition
        ])->setPaper('a4');

        return $pdf->stream('label-barang.pdf');
    }
}