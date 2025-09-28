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
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('team');
            $table->decimal('attendance', 5, 2)->nullable();
            $table->decimal('team_kpi', 5, 2)->nullable();
            $table->decimal('attrition', 5, 2)->nullable();
            $table->decimal('ivp')->nullable();
            $table->decimal('performance_rating', 6, 2)->nullable();

            $table->date('period'); // e.g., 2025-01-01 for January 2025

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
