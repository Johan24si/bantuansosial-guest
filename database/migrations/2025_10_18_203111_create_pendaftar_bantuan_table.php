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
            $table->unsignedBigInteger('program_id'); // tanpa foreign key
            $table->unsignedBigInteger('warga_id');   // tanpa foreign key
            $table->string('status_seleksi')->nullable();
            $table->timestamps();
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
