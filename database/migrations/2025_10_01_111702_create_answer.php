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
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
        
            // link to user (acting as student)
            $table->unsignedBigInteger('user_id');
        
            // link to exam
            $table->unsignedBigInteger('exam_id');
        
            // link to question
            $table->unsignedBigInteger('question_id');
        
            // store the student’s answer
            $table->enum('selected_option', ['option_1','option_2','option_3','option_4'])->nullable();
        
            $table->timestamps();
        
            // Foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('exam_id')->references('id')->on('exam')->onDelete('cascade');
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answer');
    }
};
