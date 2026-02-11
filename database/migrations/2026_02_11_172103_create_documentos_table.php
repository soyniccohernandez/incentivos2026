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
        Schema::create('documentos', function (Blueprint $table) {
            $table->id();

            // Relaciones
            $table->foreignId('proyecto_id')->constrained('proyectos')->onDelete('cascade');
            $table->foreignId('tipo_documento_id')->constrained('tipos_documento')->onDelete('cascade');

            // Información del archivo
            $table->string('ruta_archivo')->comment('Ruta del archivo cargado por el usuario');
            $table->string('estado')->default('pendiente')
                ->comment('Estado del documento: pendiente, aprobado, rechazado');
            $table->unsignedTinyInteger('version')->default(1)
                ->comment('Versión del documento, para subsanaciones');
            $table->dateTime('fecha_carga')->default(now());

            // Auditoría
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentos');
    }
};
