<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekening extends Model
{
    use HasFactory;

    protected $fillable = ['nama_akun', 'saldo_akhir'];

    // Relasi: 1 Rekening memiliki banyak catatan Buku Kas
    public function bukuKas()
    {
        return $this->hasMany(BukuKas::class);
    }
}