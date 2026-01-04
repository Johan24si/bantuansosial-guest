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
        Schema::create('pendaftar_bantuan', function (Blueprint $table) {
            $table->id('pendaftar_id');
            $table->unsignedBigInteger('program_id');
            $table->unsignedBigInteger('warga_id');
            $table->string('status_seleksi')->nullable();
            $table->timestamps();

            // Relasi ke tabel program_bantuan
            $table->foreign('program_id')
                ->references('program_id')
                ->on('program_bantuan')
                ->onDelete('cascade');

            //  Relasi ke tabel warga
            $table->foreign('warga_id')
                ->references('warga_id')
                ->on('warga')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftar_bantuan');
    }
};
