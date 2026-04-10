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
    Schema::create('piutangs', function (Blueprint $table) {
        $table->id();
        $table->string('nama_pelanggan');
        $table->date('tanggal_ambil');
        $table->decimal('jumlah_pengambilan', 15, 2)->default(0);
        $table->decimal('bunga', 15, 2)->default(0);
        $table->decimal('jumlah_pembayaran', 15, 2)->default(0);
        $table->decimal('saldo_piutang', 15, 2)->default(0);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('piutangs');
    }
};
