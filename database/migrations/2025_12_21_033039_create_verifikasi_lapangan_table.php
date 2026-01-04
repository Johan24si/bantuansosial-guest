<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('verifikasi_lapangan', function (Blueprint $table) {
    $table->id('verifikasi_id');
    $table->unsignedBigInteger('pendaftar_id');
    $table->string('petugas');
    $table->date('tanggal');
    $table->text('catatan')->nullable();
    $table->integer('skor')->nullable();
    $table->timestamps();

    $table->foreign('pendaftar_id')
          ->references('pendaftar_id')
          ->on('pendaftar_bantuan')
          ->onDelete('cascade');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verifikasi_lapangan');
    }
};
