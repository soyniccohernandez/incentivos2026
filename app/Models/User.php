<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** * Traits incorporados:
     * HasApiTokens: Para autenticación segura.
     * HasFactory: Para crear datos de prueba.
     * Notifiable: Para enviar correos y alertas.
     */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Atributos asignables (Mass Assignment).
     * Todos estos campos podrán ser guardados desde el formulario.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'identificacion',
        'telefono',
        'tipo_socio',
        'otp_code',
        'otp_expires_at',
        'otp_last_sent_at',
    ];

    /**
     * Atributos ocultos.
     * No se mostrarán al convertir el modelo a un array o JSON.
     */
    protected $hidden = [
        'password',
        'remember_token',
        'otp_code',
    ];

    /**
     * Casting de atributos.
     * IMPORTANTE: 'datetime' convierte los strings de la BD en objetos Carbon.
     * Esto soluciona el error: "Call to a member function format() on string"
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'otp_expires_at' => 'datetime',
        'otp_last_sent_at' => 'datetime',
    ];

    /**
     * Relación: Un usuario puede tener muchos proyectos.
     */
    public function proyectos()
    {
        return $this->hasMany(Proyecto::class);
    }

    /**
     * Accesor opcional para verificar si es Admin.
     */
    public function isAdmin(): bool
    {
        return $this->tipo_socio === 'Administrador';
    }
}