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

        if (!Schema::hasTable('examroom')) {
        Schema::create('examroom', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exam_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('exam_id')->references('id')->on('exams');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('status');
            $table->timestamps();
        });
    }
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('examroom');
    }
};
