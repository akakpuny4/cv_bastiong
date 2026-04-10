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
    Schema::create('kuitansis', function (Blueprint $table) {
        $table->id();
        $table->string('no_kuitansi');
        $table->date('tanggal');
        $table->enum('jenis_kuitansi', ['Penerimaan', 'Pengeluaran']);
        $table->string('terima_dari');
        $table->text('untuk_pembayaran');
        $table->decimal('jumlah_uang', 15, 2)->default(0);
        $table->string('terbilang');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kuitansis');
    }
};
