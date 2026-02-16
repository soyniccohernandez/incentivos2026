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
        Schema::create('proyectos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_radicado')->unique()->comment('Número oficial de seguimiento del proyecto');

            // Relaciones principales
            $table->foreignId('socio_id')->constrained('socios')->onDelete('cascade');
            $table->foreignId('convocatoria_id')->constrained('convocatorias')->onDelete('cascade');

            // Información básica
            $table->string('titulo');

            // Estados y Etapas
            $table->foreignId('estado_id')->default(1)->constrained('estados');

            // --- AÑADE ESTA LÍNEA AQUÍ ---
            $table->boolean('publicado')->default(false)->comment('Define si el estado es visible al público');
            // ----------------------------

            $table->foreignId('etapa_id')->default(1)->constrained('etapas');

            // Fecha de postulación
            $table->dateTime('fecha_postulacion')->useCurrent();

            // Observaciones
            $table->text('observacion_general')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyectos');
    }
};
