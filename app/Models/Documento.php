<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    /**
     * Relación con el proyecto al que pertenece este documento
     */
    public function proyecto(): BelongsTo
    {
        return $this->belongsTo(Proyecto::class);
    }

    /**
     * Relación con el tipo de documento
     */
    public function tipoDocumento(): BelongsTo
    {
        return $this->belongsTo(TipoDocumento::class, 'tipo_documento_id');
    }
}
