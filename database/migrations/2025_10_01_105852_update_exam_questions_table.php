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
        Schema::table('questions', function (Blueprint $table) {
            // Add option columns if they don't exist
            if (!Schema::hasColumn('questions', 'option_1')) {
                $table->string('option_1')->after('question');
            }
            if (!Schema::hasColumn('questions', 'option_2')) {
                $table->string('option_2')->after('option_1');
            }
            if (!Schema::hasColumn('questions', 'option_3')) {
                $table->string('option_3')->after('option_2');
            }
            if (!Schema::hasColumn('questions', 'option_4')) {
                $table->string('option_4')->after('option_3');
            }

            // Add or update correct_option column
            if (!Schema::hasColumn('questions', 'correct_option')) {
                $table->enum('correct_option', ['option_1', 'option_2', 'option_3', 'option_4'])
                      ->after('option_4');
            } else {
                $table->enum('correct_option', ['option_1', 'option_2', 'option_3', 'option_4'])
                      ->change();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('exam_questions', function (Blueprint $table) {
            //
        });
    }
};
