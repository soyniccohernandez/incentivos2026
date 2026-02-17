<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class Etapa extends Model
{
    protected $table = 'etapas';

    protected $fillable = [
        'convocatoria_id',
        'nombre',
        'fecha_inicio',
        'fecha_fin',
        'orden',
        'es_subsanable',
    ];

    protected $casts = [
        'es_subsanable' => 'boolean',
        'fecha_inicio' => 'datetime',
        'fecha_fin' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Etapa pertenece a una convocatoria
     */
    public function convocatoria(): BelongsTo
    {
        return $this->belongsTo(Convocatoria::class);
    }

    /**
     * Etapa puede tener muchos proyectos asignados
     */
    public function proyectos(): HasMany
    {
        return $this->hasMany(Proyecto::class, 'etapa_id');
    }

    /**
     * Tipos de documentos requeridos en esta etapa
     */
    public function tiposDocumentos(): HasMany
    {
        return $this->hasMany(TipoDocumento::class);
    }

    /**
     * Helper para saber si la etapa está activa hoy
     */
    public function estaActiva()
    {
        // Forzamos a Carbon a usar la hora actual real del sistema configurado
        $ahora = Carbon::now();

        // Verificamos si 'ahora' es mayor o igual al inicio Y menor o igual al fin
        return $ahora->greaterThanOrEqualTo($this->fecha_inicio) &&
            $ahora->lessThanOrEqualTo($this->fecha_fin);
    }

    /**
     * Indica si la etapa aún no ha comenzado
     */
    public function esFutura(): bool
    {
        return now()->lt($this->fecha_inicio);
    }

    /**
     * Indica si el plazo de la etapa ya venció
     */
    public function haVencido(): bool
    {
        return now()->gt($this->fecha_fin);
    }
}
