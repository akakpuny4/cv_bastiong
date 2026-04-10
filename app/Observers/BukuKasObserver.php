<?php

namespace App\Observers;

use App\Models\BukuKas;

class BukuKasObserver
{
    public function creating(BukuKas $bukuKas): void
    {
        // Panggil rekening yang terkait dengan transaksi ini
        $rekening = $bukuKas->rekening;

        // Update saldo di master rekening (Saldo Lama + Masuk - Keluar)
        $rekening->saldo_akhir = $rekening->saldo_akhir + $bukuKas->debet - $bukuKas->kredit;
        $rekening->save();

        // Simpan saldo terbaru ini ke riwayat buku kas sebagai "saldo berjalan"
        $bukuKas->saldo_berjalan = $rekening->saldo_akhir;
    }
}