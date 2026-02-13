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
        Schema::create('convocatorias', function (Blueprint $table) {
            $table->id();

            // Información básica
            $table->string('nombre');
            $table->text('descripcion')->nullable();

            // Fechas del proceso
            $table->date('fecha_inicio');
            $table->date('fecha_fin');

            // Estado de la convocatoria
            $table->enum('estado', ['borrador', 'abierta', 'cerrada'])
                ->default('borrador');

            // Documento de bases / reglamento
            $table->string('bases_path')->nullable()
                ->comment('Ruta del archivo de bases o reglamento');

            // Auditoría
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('convocatorias');
    }
};
