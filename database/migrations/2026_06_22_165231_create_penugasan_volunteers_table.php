<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penugasan_volunteer', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftaran_id')->constrained('pendaftaran_volunteer')->onDelete('cascade');
            $table->text('tugas');
            $table->string('lokasi_tugas');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penugasan_volunteer');
    }
};