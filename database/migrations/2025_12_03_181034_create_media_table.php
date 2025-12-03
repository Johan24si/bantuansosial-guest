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
        Schema::create('media', function (Blueprint $table) {
            $table->bigIncrements('media_id');   // Primary Key

            $table->string('ref_table')->nullable();   // nama tabel referensi
            $table->unsignedBigInteger('ref_id')->nullable(); // id referensi
            $table->string('file_name'); // nama file yang disimpan
            $table->string('caption')->nullable(); // caption media
            $table->string('mime_type')->nullable(); // type file (image/png, video/mp4)
            $table->integer('sort_order')->default(0); // urutan media

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
