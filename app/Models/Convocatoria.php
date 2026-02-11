<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Convocatoria extends Model
{
    // Tabla asociada
    protected $table = 'convocatorias';

    // Campos asignables
    protected $fillable = [
        'nombre',
        'descripcion',
        'fecha_inicio',
        'fecha_fin',
        'estado',
        'bases_path',
    ];

    // Casting de fechas
    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Una convocatoria puede tener muchos proyectos.
     */
    public function proyectos(): HasMany
    {
        return $this->hasMany(Proyecto::class);
    }

    /**
     * Una convocatoria puede tener muchas etapas.
     */
    public function etapas(): HasMany
    {
        return $this->hasMany(Etapa::class);
    }

    /**
     * Proyectos abiertos de esta convocatoria.
     */
    public function proyectosAbiertos(): HasMany
    {
        return $this->hasMany(Proyecto::class)
                    ->whereHas('estadoActual', function ($query) {
                        $query->where('nombre', '!=', 'finalizado');
                    });
    }
}
