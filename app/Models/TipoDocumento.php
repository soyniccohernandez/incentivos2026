<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TipoDocumento extends Model
{
    protected $table = 'tipos_documento';

    protected $fillable = [
        'nombre',
        'descripcion',
        'obligatorio',
        'etapa_id',
        'permite_subsanacion',
    ];

    protected $casts = [
        'obligatorio' => 'boolean',
        'permite_subsanacion' => 'boolean',
    ];

    /**
     * Relación con la etapa a la que pertenece este tipo de documento
     */
    public function etapa(): BelongsTo
    {
        return $this->belongsTo(Etapa::class);
    }

    /**
     * Relación con los documentos cargados de este tipo
     */
    public function documentos(): HasMany
    {
        return $this->hasMany(Documento::class, 'tipo_documento_id');
    }
}
