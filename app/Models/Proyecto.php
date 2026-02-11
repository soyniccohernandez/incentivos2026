<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Proyecto extends Model
{
    protected $table = 'proyectos';

    protected $fillable = [
        'socio_id',
        'convocatoria_id',
        'titulo',
        'estado_actual',
        'etapa_actual',
        'fecha_postulacion',
        'observacion_general',
    ];

    protected $casts = [
        'fecha_postulacion' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Un proyecto pertenece a un socio (proponente)
     */
    public function socio(): BelongsTo
    {
        return $this->belongsTo(Socio::class);
    }

    /**
     * Un proyecto pertenece a una convocatoria
     */
    public function convocatoria(): BelongsTo
    {
        return $this->belongsTo(Convocatoria::class);
    }

    /**
     * Un proyecto puede tener muchos documentos
     */
    public function documentos(): HasMany
    {
        return $this->hasMany(Documento::class);
    }

    /**
     * Un proyecto puede tener muchas observaciones
     */
    public function observaciones(): HasMany
    {
        return $this->hasMany(Observacion::class);
    }

    /**
     * Un proyecto puede tener historial de etapas
     */
    public function historialEtapas(): HasMany
    {
        return $this->hasMany(HistorialEtapa::class);
    }

    /**
     * Director asociado (si no es el proponente)
     */
    public function director(): HasMany
    {
        return $this->hasMany(Director::class);
    }

    /**
     * Aceptaciones legales
     */
    public function aceptaciones(): HasMany
    {
        return $this->hasMany(Aceptacion::class);
    }
}
