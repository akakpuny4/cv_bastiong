<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = ['nama_barang', 'satuan', 'harga_beli_rata_rata', 'harga_jual_default'];

    // Relasi: 1 Barang memiliki banyak histori pergerakan stok
    public function stoks()
    {
        return $this->hasMany(Stok::class);
    }
}