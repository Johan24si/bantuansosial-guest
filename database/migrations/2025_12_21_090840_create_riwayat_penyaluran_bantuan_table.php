<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('riwayat_penyaluran_bantuan', function (Blueprint $table) {
            $table->id('penyaluran_id');
            $table->unsignedBigInteger('program_id');
            $table->unsignedBigInteger('penerima_id');
            $table->integer('tahap_ke');
            $table->date('tanggal');
            $table->decimal('nilai', 15, 2);
            $table->timestamps();

            // FK (sesuaikan nama tabel jika beda)
            $table->foreign('program_id')->references('program_id')->on('program_bantuan')->cascadeOnDelete();
            $table->foreign('penerima_id')->references('penerima_id')->on('penerima_bantuan')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('riwayat_penyaluran_bantuan');
    }
};
