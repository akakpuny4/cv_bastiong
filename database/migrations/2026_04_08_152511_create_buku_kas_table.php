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
    Schema::create('buku_kas', function (Blueprint $table) {
        $table->id();
        $table->date('tanggal');
        $table->string('uraian');
        $table->foreignId('rekening_id')->constrained('rekenings')->onDelete('cascade');
        $table->enum('kategori_pengeluaran', ['Operasional', 'Kantor', 'Proyek', 'Lain-lain'])->nullable();
        $table->decimal('debet', 15, 2)->default(0);
        $table->decimal('kredit', 15, 2)->default(0);
        $table->decimal('saldo_berjalan', 15, 2)->default(0);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buku_kas');
    }
};
