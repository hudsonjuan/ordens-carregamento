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
        Schema::table('ordens_carregamento', function (Blueprint $table) {
            $table->string('numero_nf')->nullable()->after('pdf_path');
            $table->string('status')->default('PENDENTE')->after('numero_nf');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ordens_carregamento', function (Blueprint $table) {
            $table->dropColumn(['numero_nf', 'status']);
        });
    }
};
