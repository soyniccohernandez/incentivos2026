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

            // Relación ajustada: ahora apunta a 'users'
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // Campo para el PDF de autorización
            $table->string('archivo_autorizacion_path')->nullable()
                ->comment('Ruta del PDF de autorización firmado por el actor');

            $table->timestamps();

            // Regla de unicidad ajustada: un usuario no puede repetirse en el mismo proyecto
            $table->unique(['proyecto_id', 'user_id']);
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
