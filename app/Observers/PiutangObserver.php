<?php

namespace App\Observers;

use App\Models\Piutang;

class PiutangObserver
{
    public function saving(Piutang $piutang): void
    {
        // Rumus: Hutang Awal + Bunga - Jumlah Pembayaran
        $piutang->saldo_piutang = $piutang->jumlah_pengambilan + $piutang->bunga - $piutang->jumlah_pembayaran;
    }
}