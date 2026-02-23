<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Los atributos que se pueden asignar masivamente.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'identificacion',
        'genero',
        'tipo_socio',
        'fecha_nacimiento',
        'direccion',
        'telefono',
        'estado',
    ];

    /**
     * Atributos ocultos para la serialización.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Conversión de tipos.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'fecha_nacimiento' => 'date',
        ];
    }

    // --- ACCESORES (Lógica de negocio traída de Socio) ---

    /**
     * Obtener la URL de la foto física en el storage basada en la cédula.
     */
    public function getFotoUrlAttribute(): ?string
    {
        $directory = 'socios/';
        
        if (!Storage::disk('public')->exists($directory)) {
            return null;
        }

        $files = Storage::disk('public')->files($directory);
        
        $foto = collect($files)->first(fn($p) => str_starts_with(basename($p), $this->identificacion . '.'));
        
        return $foto ? asset('storage/' . $foto) . '?v=' . time() : null;
    }

    /**
     * Obtener las iniciales del usuario.
     */
    public function getInicialesAttribute(): string
    {
        $nombres = explode(' ', str_replace(',', '', $this->name));
        $primera = mb_substr($nombres[0] ?? '', 0, 1);
        $segunda = mb_substr($nombres[1] ?? '', 0, 1);
        return mb_strtoupper($primera . $segunda);
    }

    /**
     * Atributo dinámico para la edad: $user->edad
     */
    public function getEdadAttribute(): int
    {
        return $this->fecha_nacimiento ? $this->fecha_nacimiento->age : 0;
    }

    // --- RELACIONES ---

    /**
     * Proyectos creados por este usuario (como proponente)
     */
    public function proyectos(): HasMany
    {
        return $this->hasMany(Proyecto::class, 'user_id');
    }

    /**
     * Proyectos donde participa como parte del elenco (tabla pivot)
     */
    public function participaciones(): BelongsToMany
    {
        return $this->belongsToMany(Proyecto::class, 'proyecto_socio', 'user_id', 'proyecto_id')
            ->withPivot('archivo_autorizacion_path')
            ->withTimestamps();
    }
}