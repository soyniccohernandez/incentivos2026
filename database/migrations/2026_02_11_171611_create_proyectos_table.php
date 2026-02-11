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

            // Relaciones
            $table->foreignId('socio_id')->constrained('socios')->onDelete('cascade');
            $table->foreignId('convocatoria_id')->constrained('convocatorias')->onDelete('cascade');

            // Información básica del proyecto
            $table->string('titulo');
            $table->string('estado_actual')->default('pendiente')
                ->comment('Estado general del proyecto: pendiente, aprobado, subsanar, rechazado');
            $table->string('etapa_actual')->nullable()
                ->comment('Etapa actual dentro de la convocatoria');

            // Fecha de postulación
            $table->dateTime('fecha_postulacion')->default(now());

            // Observaciones generales (opcional)
            $table->text('observacion_general')->nullable();

            // Auditoría
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
