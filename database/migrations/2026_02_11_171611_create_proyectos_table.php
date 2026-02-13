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

            // Relaciones principales
            $table->foreignId('socio_id')->constrained('socios')->onDelete('cascade');
            $table->foreignId('convocatoria_id')->constrained('convocatorias')->onDelete('cascade');

            // Información básica
            $table->string('titulo');

            // CAMBIO CLAVE: Ya no son strings, ahora son llaves foráneas
            // El default(1) asume que el ID 1 en tu tabla 'estados' es "Recibido"
            $table->foreignId('estado_id')->default(1)->constrained('estados');

            // El default(1) asume que el ID 1 en tu tabla 'etapas' es "Inscripción"
            $table->foreignId('etapa_id')->default(1)->constrained('etapas');

            // Fecha de postulación
            $table->dateTime('fecha_postulacion')->useCurrent();

            // Observaciones del administrador
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
