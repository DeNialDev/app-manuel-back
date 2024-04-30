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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false);
            $table->string('description')->nullable(false);
            $table->date('start_date')->nullable(false);
            $table->date('end_date')->nullable(false);
            $table->enum('status', ['Nueva', 'En progreso', 'Terminada'])->default('Nueva');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
