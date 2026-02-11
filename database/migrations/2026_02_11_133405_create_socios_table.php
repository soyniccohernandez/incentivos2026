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

            // Identificación
            $table->string('identificacion')->unique()->comment('Documento de identidad del socio');

            // Información personal
            $table->string('nombre');
            $table->string('genero', 20)->nullable()->comment('Género del socio');
            $table->date('fecha_nacimiento')->nullable()->comment('Fecha de nacimiento');

            // Relación con la sociedad
            $table->string('tipo_socio', 50)->nullable()->comment('Tipo de socio según estatutos');
            $table->string('estado', 30)->default('activo')->comment('Estado del socio: activo, suspendido, inactivo');

            // Contacto
            $table->string('telefono', 20)->nullable();
            $table->string('correo')->unique()->comment('Correo electrónico principal');

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
