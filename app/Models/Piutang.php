<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Piutang extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pelanggan', 'tanggal_ambil', 'jumlah_pengambilan', 
        'bunga', 'jumlah_pembayaran', 'saldo_piutang'
    ];
}