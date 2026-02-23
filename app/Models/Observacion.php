<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Observacion extends Model
{
    protected $table = 'observaciones';

    protected $fillable = [
        'proyecto_id',
        'documento_id',
        'etapa_id',
        'usuario_revisor_id',
        'mensaje',
        'archivo_error_path',
        'visible_para_proponente',
    ];

    protected $casts = [
        'visible_para_proponente' => 'boolean',
    ];

    /**
     * Relación con el proyecto
     */
    public function proyecto(): BelongsTo
    {
        return $this->belongsTo(Proyecto::class);
    }

    /**
     * Relación con el documento (nullable)
     */
    public function documento(): BelongsTo
    {
        return $this->belongsTo(Documento::class);
    }

    /**
     * Relación con la etapa (nullable)
     */
    public function etapa(): BelongsTo
    {
        return $this->belongsTo(Etapa::class);
    }

    /**
     * Relación con el usuario revisor
     * AJUSTE: Debe apuntar a User::class tras la unificación.
     */
    public function usuarioRevisor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario_revisor_id');
    }
}