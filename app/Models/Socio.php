<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Socio extends Model
{
    // Tabla asociada (opcional si el nombre coincide con el modelo)
    protected $table = 'socios';

    // Campos asignables en masa
    protected $fillable = [
        'identificacion',
        'nombre',
        'genero',
        'fecha_nacimiento',
        'tipo_socio',
        'estado',
        'telefono',
        'correo',
    ];

    // Casting de fechas
    protected $casts = [
        'fecha_nacimiento' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Un socio puede tener muchos proyectos.
     */
    public function proyectos(): HasMany
    {
        return $this->hasMany(Proyecto::class);
    }

    /**
     * Obtener proyectos activos por estado
     */
    public function proyectosActivos(): HasMany
    {
        return $this->hasMany(Proyecto::class)->whereHas('estado', function ($q) {
            $q->where('nombre', '!=', 'Seleccionado (Ganador)'); // O el nombre que uses
        });
    }
}
