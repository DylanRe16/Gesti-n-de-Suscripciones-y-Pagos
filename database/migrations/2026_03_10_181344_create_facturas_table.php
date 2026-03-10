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
        Schema::create('facturas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('suscripcion_id')->constrained('suscripciones')->onDelete('cascade');
            $table->string('nro_factura')->unique();
            $table->decimal('monto', 10, 2);
            $table->date('fecha_emision');
            $table->date('fecha_limite');
            $table->enum('estado_pago', ['pagada', 'pendiente', 'mora'])->default('pendiente');
            $table->timestamp('pagado_el')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facturas');
    }
};
