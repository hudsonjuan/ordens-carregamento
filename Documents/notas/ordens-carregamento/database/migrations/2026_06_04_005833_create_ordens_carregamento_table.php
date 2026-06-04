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
        Schema::create('ordens_carregamento', function (Blueprint $table) {
            $table->id();
            $table->string('numero_oc')->unique();
            $table->foreignId('motorista_id')->constrained()->onDelete('cascade');
            $table->foreignId('frota_id')->constrained()->onDelete('cascade');
            $table->foreignId('destino_id')->constrained()->onDelete('cascade');
            $table->decimal('volume', 8, 2);
            $table->decimal('peso_bruto', 8, 2);
            $table->json('placas_utilizadas');
            $table->string('pdf_path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordens_carregamento');
    }
};
