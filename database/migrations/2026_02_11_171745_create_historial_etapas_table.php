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
        Schema::create('historial_etapas', function (Blueprint $table) {
            $table->id();

            // Relaciones
            $table->foreignId('proyecto_id')->constrained('proyectos')->onDelete('cascade');
            $table->foreignId('etapa_id')->constrained('etapas')->onDelete('cascade');

            // Fechas del recorrido
            $table->dateTime('fecha_inicio')->default(now());
            $table->dateTime('fecha_fin')->nullable();

            // Observaciones opcionales
            $table->text('observacion')->nullable();

            // Auditoría
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial_etapas');
    }
};
