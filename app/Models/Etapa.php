<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
    public function estaActiva(): bool
    {
        $hoy = now();
        return $hoy->between($this->fecha_inicio, $this->fecha_fin);
    }
}