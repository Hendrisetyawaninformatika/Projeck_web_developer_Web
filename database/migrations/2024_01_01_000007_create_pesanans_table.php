<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pesanan')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('paket_id')->constrained()->onDelete('cascade');
            $table->string('nama_proyek');
            $table->text('deskripsi_proyek');
            $table->string('logo_url')->nullable();
            $table->string('file_url')->nullable();
            $table->date('deadline');
            $table->decimal('harga', 15, 2);
            $table->enum('status', ['pending', 'diproses', 'revisi', 'selesai', 'dibatalkan'])->default('pending');
            $table->text('catatan_admin')->nullable();
            $table->timestamp('tanggal_diproses')->nullable();
            $table->timestamp('tanggal_selesai')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};