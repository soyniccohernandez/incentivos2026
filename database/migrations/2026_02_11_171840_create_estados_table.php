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
        Schema::create('estados', function (Blueprint $table) {
            $table->id();

            // Información del estado
            $table->string('nombre')->unique()->comment('Nombre del estado, ej: en_revision, aprobado');
            $table->text('descripcion')->nullable();
            $table->boolean('es_final')->default(false)
                ->comment('Indica si es un estado final del proyecto');

            // Auditoría
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estados');
    }
};
