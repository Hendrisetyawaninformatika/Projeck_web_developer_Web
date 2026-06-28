<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('testimonis', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email');
            $table->string('perusahaan')->nullable();
            $table->string('jabatan')->nullable();
            $table->text('isi');
            $table->integer('rating')->default(5);
            $table->string('foto_url')->nullable();
            $table->boolean('is_active')->default(false); // Perlu approval admin
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('testimonis');
    }
};