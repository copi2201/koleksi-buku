<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;     
use App\Models\Kategori;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buku = \App\Models\Buku::with('kategori')->get();
    return view('buku.index', compact('buku'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = \App\Models\Kategori::all(); 
        return view('buku.create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'kode' => 'required',
        'judul' => 'required',
        'pengarang' => 'required',
        'idkategori' => 'required'
    ]);

    \App\Models\Buku::create($request->all());
    return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $buku = Buku::findOrFail($id); 
    
    // Mengambil semua kategori untuk dropdown di halaman edit
    $kategori = Kategori::all(); 
    
    return view('buku.edit', compact('buku', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       $request->validate([
        'kode' => 'required',
        'judul' => 'required',
        'pengarang' => 'required',
        'idkategori' => 'required'
    ]);

    $buku = Buku::findOrFail($id);
    $buku->update($request->all());

    return redirect()->route('buku.index')->with('success', 'Data buku berhasil diubah'); 
    }

   
    public function destroy(string $id)
    {
        $buku = Buku::findOrFail($id);
    $buku->delete();

    return redirect()->route('buku.index')->with('success', 'Data buku berhasil dihapus');
    }
}
