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
        Schema::create('socios', function (Blueprint $table) {
            $table->id();

            // Identificación (Sigue siendo única para evitar duplicados de persona)
            $table->string('identificacion')->unique()->comment('Documento de identidad del socio');

            // Información personal
            $table->string('nombre');
            $table->string('genero', 20)->nullable();
            $table->string('tipo_socio', 50)->nullable(); // Pleno, Adherente, etc.
            $table->date('fecha_nacimiento')->nullable();

            // Ubicación y Contacto
            $table->string('direccion')->nullable();
            $table->string('telefono', 20)->nullable();
            $table->string('correo')->nullable(); // Se quitó el ->unique()

            // Estado centralizado para validaciones (moroso, bloqueado_cargo, etc.)
            $table->string('estado', 30)->default('activo');

            // Auditoría
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('socios');
    }
};
