<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HistorialEtapa extends Model
{
    protected $table = 'historial_etapas';

    protected $fillable = [
        'proyecto_id',
        'etapa_id',
        'fecha_inicio',
        'fecha_fin',
        'observacion',
    ];

    protected $casts = [
        'fecha_inicio' => 'datetime',
        'fecha_fin' => 'datetime',
    ];

    /**
     * Historial pertenece a un proyecto
     */
    public function proyecto(): BelongsTo
    {
        return $this->belongsTo(Proyecto::class);
    }

    /**
     * Historial pertenece a una etapa
     */
    public function etapa(): BelongsTo
    {
        return $this->belongsTo(Etapa::class);
    }
}
