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
        Schema::create('observaciones', function (Blueprint $table) {
            $table->id();

            // Relaciones con el proyecto y sus detalles
            $table->foreignId('proyecto_id')->constrained('proyectos')->onDelete('cascade');
            $table->foreignId('documento_id')->nullable()->constrained('documentos')->onDelete('cascade');
            $table->foreignId('etapa_id')->nullable()->constrained('etapas')->onDelete('cascade');

            // Referencia al usuario que revisa (apunta a la tabla users fusionada)
            $table->foreignId('usuario_revisor_id')->constrained('users')->onDelete('cascade');

            // Información de la observación
            $table->text('mensaje')->comment('Mensaje de la observación');

            // Registro del archivo con error (para comparación de versiones)
            $table->string('archivo_error_path')->nullable()->comment('Ruta del archivo que se rechazó');

            // Control de visibilidad
            $table->boolean('visible_para_proponente')->default(false)
                ->comment('Indica si el proponente puede ver esta observación');

            // Auditoría
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('observaciones');
    }
};
