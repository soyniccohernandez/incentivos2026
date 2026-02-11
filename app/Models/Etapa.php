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
        'orden',
        'es_subsanable',
    ];

    protected $casts = [
        'es_subsanable' => 'boolean',
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
        return $this->hasMany(Proyecto::class, 'etapa_actual', 'nombre');
    }

    /**
     * Tipos de documentos requeridos en esta etapa
     */
    public function tiposDocumentos(): HasMany
    {
        return $this->hasMany(TipoDocumento::class);
    }
}
