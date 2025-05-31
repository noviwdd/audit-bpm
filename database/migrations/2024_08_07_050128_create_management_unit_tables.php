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
        Schema::create('management_units', function (Blueprint $table) {
            $table->id();
            $table->string('target');
            $table->string('realisasi');
            $table->dateTime('target_waktu_pelaksanaan');
            $table->dateTime('realisasi_waktu_pelaksanaan');
            $table->string('dokumen');
            $table->string('evaluasi_tidak_terpenuhi');
            $table->string('evaluasi_terpenuhi');
            $table->string('evaluasi_terlampaui');
            $table->text('catatan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('management_units');
    }
};
