<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\Rekening;
use App\Models\Piutang;
use App\Models\Stok;
use App\Models\Barang;

class Neraca extends Page
{
    // Mengatur Icon di menu samping
    protected static ?string $navigationIcon = 'heroicon-o-document-chart-bar';
    
    // Mengatur nama file desain (view) yang akan dipakai
    protected static string $view = 'filament.pages.neraca';

    // Fungsi untuk menghitung dan mengirim data ke halaman desain
    protected function getViewData(): array
    {
        // 1. Hitung Total Uang Kas (Mencari rekening yang ada kata 'kas')
        $kas = Rekening::where('nama_akun', 'like', '%kas%')->sum('saldo_akhir');
        
        // 2. Hitung Total Uang di Bank (Selain Kas)
        $bank = Rekening::where('nama_akun', 'not like', '%kas%')->sum('saldo_akhir');
        
        // 3. Hitung Total Piutang Pelanggan
        $piutang = Piutang::sum('saldo_piutang');

        // 4. Hitung Nilai Persediaan Barang (Harga Beli x Saldo Terakhir Gudang)
        $persediaan = 0;
        $barangs = Barang::all();
        foreach($barangs as $b) {
            $saldo_terakhir = Stok::where('barang_id', $b->id)->orderBy('id', 'desc')->value('saldo_akhir') ?? 0;
            $persediaan += ($saldo_terakhir * $b->harga_beli_rata_rata);
        }

        // Total Aktiva
        $total_aktiva = $kas + $bank + $piutang + $persediaan;

        // Total Pasiva (Untuk sementara disamakan dengan Aktiva sebagai Kekayaan Bersih agar Balance)
        $total_pasiva = $total_aktiva;

        return [
            'kas' => $kas,
            'bank' => $bank,
            'piutang' => $piutang,
            'persediaan' => $persediaan,
            'total_aktiva' => $total_aktiva,
            'total_pasiva' => $total_pasiva,
        ];
    }
}