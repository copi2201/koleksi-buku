<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class PdfController extends Controller
{
    // 1. PDF Landscape untuk Sertifikat 
    public function generateSertifikat()
    {
        $data = [
            'nama' => Auth::user()->name,
            'nomor' => '3353/B/UN3.FIKKIA/S.KM/PM.03/2025'
        ];
        
        $pdf = Pdf::loadView('pdf.sertifikat', $data)
                  ->setPaper('a4', 'landscape'); // Mengatur ke Landscape 
                  
        return $pdf->stream('sertifikat.pdf');
    }

    // 2. PDF Portrait untuk Undangan dengan Header 
    public function generateUndangan()
    {
        $pdf = Pdf::loadView('pdf.undangan')
                  ->setPaper('a4', 'portrait'); // Mengatur ke Portrait 
                  
        return $pdf->stream('undangan.pdf');
    }
}