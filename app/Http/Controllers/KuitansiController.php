<?php

namespace App\Http\Controllers;

use App\Models\Kuitansi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class KuitansiController extends Controller
{
    public function cetakPdf($id)
    {
        // Cari data kuitansi berdasarkan ID
        $kuitansi = Kuitansi::findOrFail($id);

        // Kirim data ke file desain (view) dan ubah jadi PDF
        $pdf = Pdf::loadView('kuitansi.pdf', compact('kuitansi'));

        // Unduh (download) file PDF-nya
        return $pdf->download('Kuitansi_'.$kuitansi->no_kuitansi.'.pdf');
    }
}