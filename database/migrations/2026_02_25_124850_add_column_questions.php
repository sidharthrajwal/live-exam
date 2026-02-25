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
        Schema::table('student_exam_history', function (Blueprint $table) {
            $table->string('total_mark')->nullable();
            $table->string('total_saved')->nullable();
            $table->string('exam_end_time')->nullable();
            $table->string('exam_count')->nullable();
            $table->string('total_correct_answer')->nullable();
            $table->string('total_wrong_answer')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_exam_history', function (Blueprint $table) {
            $table->dropColumn('total_mark');
            $table->dropColumn('total_saved');
            $table->dropColumn('exam_end_time');
            $table->dropColumn('exam_count');
            $table->dropColumn('total_correct_answer');
            $table->dropColumn('total_wrong_answer');
        });
    }
};
