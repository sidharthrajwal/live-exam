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
       if (!Schema::hasTable('questions')) {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();

            // Match exam.id type
            $table->unsignedBigInteger('exam_id');

            $table->string('question');

            // Option columns
            $table->string('option_1');
            $table->string('option_2');
            $table->string('option_3');
            $table->string('option_4');

            // Correct option
            $table->enum('correct_option', ['option_1', 'option_2', 'option_3', 'option_4']);

            $table->timestamps();

            // Foreign key
            $table->foreign('exam_id')->references('id')->on('exam')->onDelete('cascade');
        });
    }
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
