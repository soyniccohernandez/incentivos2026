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
        Schema::create('proyecto_socio', function (Blueprint $table) {
            $table->id();
            // Relación con el proyecto
            $table->foreignId('proyecto_id')->constrained('proyectos')->onDelete('cascade');

            // Relación con el socio (actor del elenco)
            $table->foreignId('socio_id')->constrained('socios')->onDelete('cascade');

            // ESTE ES EL CAMPO NUEVO QUE AGREGAMOS
            $table->string('archivo_autorizacion_path')->nullable()
                ->comment('Ruta del PDF de autorización firmado por el actor');

            $table->timestamps();

            // Regla: Un socio no puede estar repetido en el mismo proyecto
            $table->unique(['proyecto_id', 'socio_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyecto_socio');
    }
};
