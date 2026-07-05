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
        Schema::create('pendaftaran_volunteers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id');
            $table->unsignedBigInteger('volunteer_id');
            $table->unsignedBigInteger('divisi_id');
            $table->text('motivasi')->nullable();
            $table->enum('status_pendaftaran', ['menunggu', 'diterima', 'ditolak'])->default('menunggu');
            $table->timestamps();

            $table->foreign('event_id')->references('id')->on('events')->onDelete('restrict');
            $table->foreign('volunteer_id')->references('id')->on('volunteers')->onDelete('restrict');
            $table->foreign('divisi_id')->references('id')->on('divisi_volunteers')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran_volunteers');
    }
};
