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
        Schema::table('suscripciones', function (Blueprint $table) {
            //
            $table->foreignId('user_id')
                ->constrained()     // Detecta automáticamente que apunta a la tabla 'users'
                ->onDelete('cascade'); // <-- Relación con usuarios | Operador que creó la suscripción

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('suscripciones', function (Blueprint $table) {
            //
        });
    }
};
