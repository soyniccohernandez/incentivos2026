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
        'estado_id',      // CAMBIADO: Antes era estado_actual
        'etapa_id',       // CAMBIADO: Antes era etapa_actual
        'fecha_postulacion',
        'observacion_general',
    ];

    protected $casts = [
        'fecha_postulacion' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * RELACIONES NUEVAS (Las que conectan con tus tablas maestras)
     */

    public function estado(): BelongsTo
    {
        // Relación con la tabla 'estados'
        return $this->belongsTo(Estado::class, 'estado_id');
    }

    public function etapa(): BelongsTo
    {
        // Relación con la tabla 'etapas'
        return $this->belongsTo(Etapa::class, 'etapa_id');
    }

    /**
     * RELACIONES EXISTENTES
     */

    public function socio(): BelongsTo
    {
        return $this->belongsTo(Socio::class);
    }

    public function convocatoria(): BelongsTo
    {
        return $this->belongsTo(Convocatoria::class);
    }

    public function documentos(): HasMany
    {
        return $this->hasMany(Documento::class);
    }

}