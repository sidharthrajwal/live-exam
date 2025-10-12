<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('examroom', function (Blueprint $table) {
            $table->enum('status', ['pending', 'active', 'upcoming'])->default('pending')->change();
        });
    }

    public function down(): void
    {
        // revert to previous type (example: string)
        Schema::table('examroom', function (Blueprint $table) {
            $table->string('status')->change();
        });
    }
};
