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

    // --- CONSTANTES DE ESTADOS (IDs de tu BD) ---
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
        'socio_id',
        'convocatoria_id',
        'titulo',
        'guion_propio', // <--- AGREGA ESTA LÍNEA
        'estado_id',
        'publicado',
        'etapa_id',
        'fecha_postulacion',
        'observacion_general',
    ];

    protected $casts = [
        'publicado' => 'boolean',
        'guion_propio' => 'boolean', // <--- TAMBIÉN AGREGA ESTA LÍNEA
        'fecha_postulacion' => 'datetime',
    ];

    /**
     * GENERACIÓN AUTOMÁTICA DEL RADICADO Y FECHA
     */
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

    /*
    |--------------------------------------------------------------------------
    | LÓGICA DE MÁSCARA PÚBLICA (Embargo de Información)
    |--------------------------------------------------------------------------
    */

    /**
     * Define qué ve el socio en la tabla pública.
     * Uso: $proyecto->estado_publico
     */
    public function getEstadoPublicoAttribute(): array
    {
        // 1. SI NO ESTÁ PUBLICADO: Muro total de privacidad
        if (!$this->publicado) {
            return [
                'nombre' => 'En Revisión',
                'color' => 'indigo',
                'requiere_accion' => false,
                'mensaje' => 'Tu propuesta está siendo validada por el equipo técnico.'
            ];
        }

        // 2. SI ESTÁ PUBLICADO: Realidad según el estado
        return match ($this->estado_id) {
            self::SUBSANACION_E1 => [
                'nombre' => 'Subsanación Requerida',
                'color' => 'amber',
                'requiere_accion' => true,
                'mensaje' => 'Debes corregir algunos documentos para continuar.'
            ],
            self::EN_ETAPA_2 => [
                'nombre' => 'Aprobado - Fase Técnica',
                'color' => 'emerald',
                'requiere_accion' => true,
                'mensaje' => '¡Pasa a Etapa 2! Diligencia el formulario técnico.'
            ],
            self::AVANZA_E3 => [
                'nombre' => 'Evaluación de Jurados',
                'color' => 'blue',
                'requiere_accion' => false,
                'mensaje' => 'Tu proyecto está en manos de los jurados calificadores.'
            ],
            self::ELIMINADO => [
                'nombre' => 'No Continúa',
                'color' => 'rose',
                'requiere_accion' => false,
                'mensaje' => 'El proyecto no superó la fase actual del proceso.'
            ],
            self::GANADOR => [
                'nombre' => '¡Seleccionado Ganador!',
                'color' => 'emerald',
                'requiere_accion' => false,
                'mensaje' => 'Felicitaciones, proyecto seleccionado.'
            ],
            default => [
                'nombre' => $this->estado->nombre,
                'color' => 'gray',
                'requiere_accion' => false,
                'mensaje' => ''
            ],
        };
    }

    /*
    |--------------------------------------------------------------------------
    | RELACIONES
    |--------------------------------------------------------------------------
    */

    public function director(): HasOne
    {
        return $this->hasOne(Director::class);
    }

    public function aceptaciones(): HasMany
    {
        return $this->hasMany(Aceptacion::class);
    }

    public function documentos(): HasMany
    {
        return $this->hasMany(Documento::class);
    }

    public function observaciones(): HasMany
    {
        return $this->hasMany(Observacion::class);
    }

    public function estado(): BelongsTo
    {
        return $this->belongsTo(Estado::class, 'estado_id');
    }

    public function etapa(): BelongsTo
    {
        return $this->belongsTo(Etapa::class, 'etapa_id');
    }

    public function socio(): BelongsTo
    {
        return $this->belongsTo(Socio::class);
    }

    public function convocatoria(): BelongsTo
    {
        return $this->belongsTo(Convocatoria::class);
    }

    public function elenco(): BelongsToMany
    {
        return $this->belongsToMany(Socio::class, 'proyecto_socio');
    }
}
