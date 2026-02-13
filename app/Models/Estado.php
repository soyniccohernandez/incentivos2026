<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Estado extends Model
{
    protected $table = 'estados';

    protected $fillable = [
        'nombre',
        'descripcion',
        'es_final',
    ];

    protected $casts = [
        'es_final' => 'boolean',
    ];

    /**
     * Un estado puede estar asociado a muchos proyectos
     */
    public function proyectos(): HasMany
    {
        // Relación estándar: un estado tiene muchos proyectos
        return $this->hasMany(Proyecto::class, 'estado_id');
    }
}
