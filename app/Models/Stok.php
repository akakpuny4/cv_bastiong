<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal', 'barang_id', 'nama_pembeli_faktur_kapal', 
        'aspal_masuk', 'stok_keluar_jual', 'stok_keluar_gudang', 'saldo_akhir'
    ];

    // Relasi: Catatan stok ini milik 1 Barang
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}