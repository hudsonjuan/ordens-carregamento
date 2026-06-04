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
        Schema::create('placas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('frota_id')->constrained()->onDelete('cascade');
            $table->enum('tipo_placa', ['cavalo', 'carreta', 'dolly', 'carreta1', 'carreta2']);
            $table->string('placa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('placas');
    }
};
