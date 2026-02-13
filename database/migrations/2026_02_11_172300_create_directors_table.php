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
        Schema::create('directores', function (Blueprint $table) {
            $table->id();

            // Relación con proyecto
            $table->foreignId('proyecto_id')->constrained('proyectos')->onDelete('cascade');

            // Es proponente o no
            $table->boolean('es_proponente')->default(false)
                ->comment('Si es el mismo socio que diligencia el formulario');

            // Datos del director (solo si no es proponente)
            $table->string('identificacion')->nullable();
            $table->string('nombre')->nullable();
            $table->string('celular', 20)->nullable();
            $table->string('correo')->nullable();

            // Auditoría
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('directores');
    }
};
