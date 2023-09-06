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
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('driver_id')->nullable()->constrained();
            $table->string('circuit_name')->nullable();
            $table->decimal('sector_1', 5, 3);
            $table->decimal('sector_2', 5,3);
            $table->decimal('sector_3', 5, 3);
            $table->string('lap_total')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
