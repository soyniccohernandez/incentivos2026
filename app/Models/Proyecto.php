<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Proyecto extends Model
{
    protected $table = 'proyectos';

    // --- CONSTANTES DE ESTADOS ---
    const INSCRITO = 1;
    const EN_REVISION_E1 = 2;
    const SUBSANACION_E1 = 3;
    const EN_ETAPA_2 = 4;
    const REVISION_E2 = 5;
    const AVANZA_E3 = 6;
    const REVISION_E3 = 7;
    const ELIMINADO = 8;
    const NO_SELECCIONADO = 9;
    const GANADOR = 10;

    protected $fillable = [
        'codigo_radicado',
        'user_id', 
        'convocatoria_id',
        'titulo',
        'guion_propio',
        'estado_id',
        'publicado',
        'etapa_id',
        'fecha_postulacion',
        'observacion_general',
    ];

    protected $casts = [
        'publicado' => 'boolean',
        'guion_propio' => 'boolean',
        'fecha_postulacion' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($proyecto) {
            $anio = date('Y');
            $numeroAleatorio = rand(10000, 99999);
            $proyecto->codigo_radicado = "{$anio}-INC-{$numeroAleatorio}";
            if (!$proyecto->fecha_postulacion) {
                $proyecto->fecha_postulacion = now();
            }
        });
    }

    /* --- RELACIONES --- */

    /**
     * El titular o proponente del proyecto
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Miembros del elenco (Socios participantes)
     * Se usa 'user_id' como foreign key en la tabla pivote 'proyecto_socio'
     */
    public function elenco(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'proyecto_socio', 'proyecto_id', 'user_id')
            ->withPivot('archivo_autorizacion_path')
            ->withTimestamps();
    }

    public function director(): HasOne { return $this->hasOne(Director::class); }
    
    public function documentos(): HasMany { return $this->hasMany(Documento::class); }
    
    public function observaciones(): HasMany { return $this->hasMany(Observacion::class); }
    
    public function estado(): BelongsTo { return $this->belongsTo(Estado::class, 'estado_id'); }
    
    public function etapa(): BelongsTo { return $this->belongsTo(Etapa::class, 'etapa_id'); }
    
    public function convocatoria(): BelongsTo { return $this->belongsTo(Convocatoria::class); }

    /* --- ACCESSORS / LÓGICA DE NEGOCIO --- */

    /**
     * Máscara visual para el Dashboard del Socio
     */
    public function getEstadoPublicoAttribute(): array
    {
        if (!$this->publicado) {
            return [
                'nombre' => 'En Revisión',
                'color' => 'indigo',
                'requiere_accion' => false,
                'mensaje' => 'Tu propuesta está siendo validada por el equipo técnico.'
            ];
        }

        return match ($this->estado_id) {
            self::SUBSANACION_E1 => [
                'nombre' => 'Subsanación Requerida', 
                'color' => 'amber', 
                'requiere_accion' => true, 
                'mensaje' => 'Debes corregir documentos de la Etapa 1.'
            ],
            self::EN_ETAPA_2 => [
                'nombre' => 'Aprobado - Fase Técnica', 
                'color' => 'emerald', 
                'requiere_accion' => true, 
                'mensaje' => '¡Pasa a Etapa 2! Completa el formulario técnico.'
            ],
            self::REVISION_E2 => [
                'nombre' => 'Expediente Técnico Enviado', 
                'color' => 'blue', 
                'requiere_accion' => false, 
                'mensaje' => 'Documentación en revisión.'
            ],
            self::GANADOR => [
                'nombre' => '¡Seleccionado Ganador!', 
                'color' => 'emerald', 
                'requiere_accion' => false, 
                'mensaje' => '¡Felicitaciones!'
            ],
            self::ELIMINADO => [
                'nombre' => 'No Continúa', 
                'color' => 'rose', 
                'requiere_accion' => false, 
                'mensaje' => 'No superó la fase de validación.'
            ],
            default => [
                'nombre' => $this->estado->nombre ?? 'Inscrito', 
                'color' => 'gray', 
                'requiere_accion' => false, 
                'mensaje' => ''
            ],
        };
    }
}