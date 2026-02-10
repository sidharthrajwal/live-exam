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
        Schema::table('examroom', function (Blueprint $table) {
          $table->enum('examlivestatus', ['pending', 'running', 'ended'])
                  ->default('pending')
                  ->after('exam_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
     Schema::table('examroom', function (Blueprint $table) {
            $table->dropColumn('examlivestatus');
        });
    }
};
