<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Director extends Model
{
    protected $table = 'directores';

    protected $fillable = [
        'proyecto_id',
        'es_proponente',
        'identificacion',
        'nombre',
        'celular',
        'correo',
    ];

    protected $casts = [
        'es_proponente' => 'boolean',
    ];

    /**
     * Relación con el proyecto
     */
    public function proyecto(): BelongsTo
    {
        return $this->belongsTo(Proyecto::class);
    }

    /**
     * Indica si los datos del director deben completarse
     */
    public function necesitaDatos(): bool
    {
        return !$this->es_proponente;
    }
}
