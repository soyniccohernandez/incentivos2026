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

            // --- CAMBIO CLAVE AQUÍ ---
            // Cambiamos 'socio_id' por 'user_id' y apuntamos a la tabla 'users'
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            $table->foreignId('convocatoria_id')->constrained('convocatorias')->onDelete('cascade');

            // Información básica
            $table->string('titulo');
            $table->boolean('guion_propio')->default(true)->comment('Indica si el autor es el mismo proponente');

            // Estados y Etapas
            $table->foreignId('estado_id')->default(1)->constrained('estados');

            // Visibilidad
            $table->boolean('publicado')->default(false)->comment('Define si el estado es visible al público');

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