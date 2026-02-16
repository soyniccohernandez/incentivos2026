<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage; // <--- IMPORTANTE: Añadir esta línea
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
     * Obtener la URL de la foto física en el storage basada en la cédula.
     * Uso: $socio->foto_url
     */
    public function getFotoUrlAttribute(): ?string
    {
        $directory = 'socios/';
        
        // Verificamos si el disco público existe y listamos archivos
        if (!Storage::disk('public')->exists($directory)) {
            return null;
        }

        $files = Storage::disk('public')->files($directory);
        
        // Buscamos el archivo que empiece por la identificación del socio (ej: 12345.jpg)
        $foto = collect($files)->first(fn($p) => str_starts_with(basename($p), $this->identificacion . '.'));
        
        // Retornamos la URL con timestamp para evitar cache del navegador al actualizar fotos
        return $foto ? asset('storage/' . $foto) . '?v=' . time() : null;
    }

    /**
     * Obtener las iniciales del socio.
     * Uso: $socio->iniciales
     */
    public function getInicialesAttribute(): string
    {
        $nombres = explode(' ', str_replace(',', '', $this->nombre));
        $primera = mb_substr($nombres[0] ?? '', 0, 1);
        $segunda = mb_substr($nombres[1] ?? '', 0, 1);
        return mb_strtoupper($primera . $segunda);
    }

    public function getEdadAttribute(): int
    {
        return $this->fecha_nacimiento ? $this->fecha_nacimiento->age : 0;
    }

    /*
    |--------------------------------------------------------------------------
    | Relaciones
    |--------------------------------------------------------------------------
    */

    public function proyectos(): HasMany
    {
        return $this->hasMany(Proyecto::class);
    }

    public function proyectosEnProceso(): HasMany
    {
        return $this->hasMany(Proyecto::class)->whereHas('estado', function ($q) {
            $q->where('nombre', '!=', 'Seleccionado (Ganador)'); 
        });
    }
}