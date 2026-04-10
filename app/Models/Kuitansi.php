<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kuitansi extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_kuitansi', 'tanggal', 'jenis_kuitansi', 'terima_dari', 
        'untuk_pembayaran', 'jumlah_uang', 'terbilang'
    ];
}