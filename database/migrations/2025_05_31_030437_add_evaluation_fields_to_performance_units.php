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
        Schema::table('performance_units', function (Blueprint $table) {
            if (!Schema::hasColumn('performance_units', 'criteria_id')) {
                $table->foreignId('criteria_id')->nullable()->constrained('criterias')->after('unit_id');
            }

            if (!Schema::hasColumn('performance_units', 'sub_criteria_id')) {
                $table->foreignId('sub_criteria_id')->nullable()->constrained('sub_criterias')->after('criteria_id');
            }

            if (!Schema::hasColumn('performance_units', 'evaluation_score')) {
                $table->unsignedTinyInteger('evaluation_score')->nullable()->after('achieve');
            }

            if (!Schema::hasColumn('performance_units', 'evaluation_auto')) {
                $table->boolean('evaluation_auto')->default(true)->after('evaluation_score');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('performance_units', function (Blueprint $table) {
            // $table->dropForeign(['criteria_id']);
            // $table->dropForeign(['sub_criteria_id']);
            // $table->dropColumn(['criteria_id', 'sub_criteria_id', 'evaluation_score', 'evaluation_auto']);
        });
    }
};
