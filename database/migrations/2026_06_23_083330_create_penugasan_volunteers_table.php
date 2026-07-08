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
        Schema::create('penugasan_volunteers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pendaftaran_id');
            $table->text('tugas');
            $table->string('lokasi_tugas', 255);
            $table->date('tanggal_tugas');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->enum('status_tugas', [
                'belum_dimulai',
                'berlangsung',
                'selesai'
            ])->default('belum_dimulai');
            $table->timestamps();

            $table->foreign('pendaftaran_id')->references('id')->on('pendaftaran_volunteers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penugasan_volunteers');
    }
};
