<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Atributos asignables (Mass Assignment).
     * He agregado 'otp_requests' y los campos de dirección/género que estaban en tu migración.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'identificacion',
        'genero',          // Agregado según tu nueva migración
        'tipo_socio',
        'fecha_nacimiento', // Agregado según tu nueva migración
        'direccion',       // Agregado según tu nueva migración
        'telefono',
        'estado',
        'otp_code',
        'otp_expires_at',
        'otp_last_sent_at',
        'otp_requests',    // <--- CRÍTICO: Para poder guardar el contador de intentos
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'otp_code',
    ];

    /**
     * Casting de atributos.
     * Agregamos 'otp_requests' como integer para asegurar que Laravel lo trate como número.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'otp_expires_at' => 'datetime',
        'otp_last_sent_at' => 'datetime',
        'fecha_nacimiento' => 'date',
        'otp_requests' => 'integer', // <--- Asegura que siempre sea un número
    ];

    public function proyectos()
    {
        return $this->hasMany(Proyecto::class);
    }

    public function isAdmin(): bool
    {
        return $this->tipo_socio === 'Administrador';
    }
}