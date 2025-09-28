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
        Schema::create('agents', function (Blueprint $table) {
            $table->id();
            $table->string('agent_name');
            $table->string('team');
            $table->decimal('quiz', 5, 2)->nullable();
            $table->decimal('productivity', 5, 2)->nullable();
            $table->decimal('timeliness', 5, 2)->nullable();
            $table->decimal('qa', 5, 2)->nullable();
            $table->decimal('attendance', 5, 2)->nullable();
            $table->decimal('kpi_performance', 6, 2)->nullable();
            $table->decimal('behavioral', 5, 2)->nullable();
            $table->decimal('behavior', 5, 2)->nullable();
            $table->decimal('ivp')->nullable();
            $table->decimal('overall_performance_rating', 6, 2)->nullable();

            $table->date('period'); // e.g., 2025-01-01 for January 2025

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agents');
    }
};
