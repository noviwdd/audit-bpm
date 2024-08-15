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
        Schema::create('performance_units', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unit_id')->constrained('units')->onDelete('cascade');
            $table->integer('parent_id')->nullable();
            $table->integer('index_position')->nullable();
            $table->string('work_planning')->nullable();
            $table->year('year');
            $table->integer('target')->nullable();
            $table->integer('achieve')->nullable();
            $table->date('time_target')->nullable();
            $table->date('time_realize')->nullable();
            $table->string('document')->nullable();
            $table->enum('evaluation_type', ['not_fulfilled', 'fulfilled', 'exceeded'])->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('performance_units');
    }
};
