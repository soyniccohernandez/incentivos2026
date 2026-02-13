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
        Schema::create('aceptaciones', function (Blueprint $table) {
            $table->id();

            // Relación con proyecto
            $table->foreignId('proyecto_id')->constrained('proyectos')->onDelete('cascade');

            // Tipo de aceptación
            $table->enum('tipo', ['terminos', 'datos_personales', 'convocatoria'])
                ->comment('Tipo de aceptación legal');

            $table->boolean('aceptado')->default(false);
            $table->dateTime('fecha_aceptacion')->nullable();
            $table->string('ip', 45)->nullable()->comment('IP del usuario al aceptar');

            // Auditoría
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aceptaciones');
    }
};
