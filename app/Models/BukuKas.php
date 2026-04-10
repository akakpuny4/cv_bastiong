<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BukuKas extends Model
{
    use HasFactory;

    protected $table = 'buku_kas'; // Mengatur nama tabel secara spesifik

    protected $fillable = [
        'tanggal', 'uraian', 'rekening_id', 'kategori_pengeluaran', 
        'debet', 'kredit', 'saldo_berjalan'
    ];

    // Relasi: Transaksi kas ini masuk ke 1 Rekening tertentu
    public function rekening()
    {
        return $this->belongsTo(Rekening::class);
    }
}