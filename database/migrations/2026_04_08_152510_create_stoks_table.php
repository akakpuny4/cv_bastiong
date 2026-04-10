<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('stoks', function (Blueprint $table) {
        $table->id();
        $table->date('tanggal');
        $table->foreignId('barang_id')->constrained('barangs')->onDelete('cascade');
        $table->string('nama_pembeli_faktur_kapal')->nullable();
        $table->integer('aspal_masuk')->default(0);
        $table->integer('stok_keluar_jual')->default(0);
        $table->integer('stok_keluar_gudang')->default(0);
        $table->integer('saldo_akhir')->default(0);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stoks');
    }
};
