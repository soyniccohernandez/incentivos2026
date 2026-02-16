<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class Socio extends Model
{
    protected $table = 'socios';

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

    /**
     * Casting de atributos.
     * Centralizamos todos los casts en un solo array.
     */
    protected $casts = [
        'fecha_nacimiento' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | Accessors (Atributos calculados)
    |--------------------------------------------------------------------------
    */

    /**
     * Obtener la edad actual del socio.
     * Uso: $socio->edad
     */
    public function getEdadAttribute(): int
    {
        return $this->fecha_nacimiento ? $this->fecha_nacimiento->age : 0;
    }

    /*
    |--------------------------------------------------------------------------
    | Relaciones
    |--------------------------------------------------------------------------
    */

    /**
     * Un socio puede tener muchos proyectos.
     */
    public function proyectos(): HasMany
    {
        return $this->hasMany(Proyecto::class);
    }

    /**
     * Obtener proyectos que no han finalizado el proceso (no son ganadores aún).
     */
    public function proyectosEnProceso(): HasMany
    {
        return $this->hasMany(Proyecto::class)->whereHas('estado', function ($q) {
            $q->where('nombre', '!=', 'Seleccionado (Ganador)'); 
        });
    }
}