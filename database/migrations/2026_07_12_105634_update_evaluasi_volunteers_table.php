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
        Schema::table('evaluasi_volunteers', function (Blueprint $table) {
            $table->dropForeign(['volunteer_id']);
            $table->dropForeign(['event_id']);
            $table->dropColumn(['volunteer_id','event_id']);
            $table->foreignId('penugasan_id')->unique()->constrained('penugasan_volunteers')->cascadeOnDelete();
            $table->tinyInteger('nilai')->nullable(false)->change();
        });
    }

    public function down(): void
    {
        Schema::table('evaluasi_volunteers', function (Blueprint $table) {
            $table->dropForeign(['penugasan_id']);
            $table->dropColumn('penugasan_id');
            $table->unsignedBigInteger('volunteer_id');
            $table->unsignedBigInteger('event_id');
            $table->foreign('volunteer_id')->references('id')->on('volunteers')->onDelete('restrict');
            $table->foreign('event_id')->references('id')->on('events')->onDelete('restrict');
            $table->integer('nilai')->nullable()->change();
        });
    }
};
