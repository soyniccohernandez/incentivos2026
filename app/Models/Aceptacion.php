<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Aceptacion extends Model
{
    protected $table = 'aceptaciones';

    protected $fillable = [
        'proyecto_id',
        'tipo',
        'aceptado',
        'fecha_aceptacion',
        'ip',
    ];

    protected $casts = [
        'aceptado' => 'boolean',
        'fecha_aceptacion' => 'datetime',
    ];

    /**
     * Relación con el proyecto
     */
    public function proyecto(): BelongsTo
    {
        return $this->belongsTo(Proyecto::class);
    }

    /**
     * Marcar la aceptación con fecha e IP
     */
    public function aceptar(string $ip = null): void
    {
        $this->aceptado = true;
        $this->fecha_aceptacion = now();
        $this->ip = $ip;
        $this->save();
    }
}
