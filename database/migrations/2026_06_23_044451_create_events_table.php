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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('panitia_id');
            $table->unsignedBigInteger('kategori_id');
            $table->string('nama_event', 255);
            $table->text('deskripsi')->nullable();
            $table->string('lokasi', 255);
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('poster');
            $table->enum('status_verifikasi', ['menunggu', 'disetujui', 'ditolak'])->default('menunggu');
            $table->enum('status_event', ['persiapan', 'open', 'seleksi', 'berlangsung', 'selesai'])->default('persiapan');
            $table->timestamps();

            $table->foreign('panitia_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('kategori_id')->references('id')->on('kategori_events')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
