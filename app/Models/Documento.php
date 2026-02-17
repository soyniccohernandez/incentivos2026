<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Documento extends Model
{
    protected $table = 'documentos';

    protected $fillable = [
        'proyecto_id',
        'tipo_documento_id',
        'ruta_archivo',
        'estado',
        'version',
        'fecha_carga',
    ];

    protected $casts = [
        'version' => 'integer',
        'fecha_carga' => 'datetime',
    ];

    public function proyecto(): BelongsTo
    {
        return $this->belongsTo(Proyecto::class);
    }

    public function tipoDocumento(): BelongsTo
    {
        return $this->belongsTo(TipoDocumento::class, 'tipo_documento_id');
    }

    public function observaciones(): HasMany
    {
        return $this->hasMany(Observacion::class, 'documento_id');
    }

    /**
     * Mejor práctica: Acceso seguro a la última observación de este documento
     */
    public function getUltimaObservacion()
    {
        return $this->observaciones()->latest()->first();
    }
}