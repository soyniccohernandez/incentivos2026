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
        Schema::create('tipos_documento', function (Blueprint $table) {
            $table->id();

            // Información del tipo de documento
            $table->string('nombre')->comment('Nombre del documento, ej: Guion');
            $table->text('descripcion')->nullable();
            $table->boolean('obligatorio')->default(true)
                ->comment('Indica si el documento es obligatorio');

            // Relación con etapa
            $table->foreignId('etapa_id')->constrained('etapas')->onDelete('cascade');

            // Subsanación
            $table->boolean('permite_subsanacion')->default(false)
                ->comment('Indica si el documento permite subsanación');

            // Auditoría
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipos_documento');
    }
};
