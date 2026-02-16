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
        Schema::create('etapas', function (Blueprint $table) {
            $table->id();

            // Relación con convocatoria
            $table->foreignId('convocatoria_id')
                ->constrained('convocatorias')
                ->onDelete('cascade');

            // Información de la etapa
            $table->string('nombre')->comment('Nombre de la etapa, ej: Recepción de documentos');
            
            // Fechas de control (La Buena Práctica)
            $table->dateTime('fecha_inicio')->nullable()->comment('Fecha y hora de inicio de la etapa');
            $table->dateTime('fecha_fin')->nullable()->comment('Fecha y hora de finalización de la etapa');
            
            $table->unsignedTinyInteger('orden')->comment('Orden secuencial de la etapa');
            $table->boolean('es_subsanable')->default(false)
                ->comment('Indica si la etapa permite subsanación');

            // Auditoría
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etapas');
    }
};