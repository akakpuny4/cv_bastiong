<?php

namespace App\Observers;

use App\Models\Stok;

class StokObserver
{
    public function creating(Stok $stok): void
    {
        // Cari saldo terakhir dari barang ini sebelum transaksi baru masuk
        $saldo_sebelumnya = Stok::where('barang_id', $stok->barang_id)
                                ->orderBy('id', 'desc')
                                ->value('saldo_akhir') ?? 0;

        // Rumus: Saldo Lama + Masuk - Keluar Jual - Keluar Gudang
        $stok->saldo_akhir = $saldo_sebelumnya + $stok->aspal_masuk - $stok->stok_keluar_jual - $stok->stok_keluar_gudang;
    }
}