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
    const EN_ETAPA_2 = 4;        // Proponente llenando Formulario Técnico
    const REVISION_E2 = 5;       // Auditor revisando Formulario Técnico
    const AVANZA_E3 = 6;         // Pasa a Jurados
    const REVISION_E3 = 7;       // Calificación de Jurados
    const ELIMINADO = 8;         // No cumple / Rechazado
    const NO_SELECCIONADO = 9;   // No ganó pero cumplió
    const GANADOR = 10;          // Seleccionado para estímulo

    protected $fillable = [
        'codigo_radicado',
        'socio_id',
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
    | Define qué ve el socio en su panel mientras el administrador trabaja.
    */

    public function getEstadoPublicoAttribute(): array
    {
        // 1. SI NO ESTÁ PUBLICADO: Se mantiene el mensaje genérico de revisión
        if (!$this->publicado) {
            return [
                'nombre' => 'En Revisión',
                'color' => 'indigo',
                'requiere_accion' => false,
                'mensaje' => 'Tu propuesta está siendo validada por el equipo técnico.'
            ];
        }

        // 2. SI ESTÁ PUBLICADO: Mostramos la realidad del proceso
        return match ($this->estado_id) {
            self::SUBSANACION_E1 => [
                'nombre' => 'Subsanación Requerida',
                'color' => 'amber',
                'requiere_accion' => true,
                'mensaje' => 'Debes corregir documentos de la Etapa 1 para continuar.'
            ],
            self::EN_ETAPA_2 => [
                'nombre' => 'Aprobado - Fase Técnica',
                'color' => 'emerald',
                'requiere_accion' => true,
                'mensaje' => '¡Pasa a Etapa 2! Por favor completa el expediente técnico y elenco.'
            ],
            self::REVISION_E2 => [
                'nombre' => 'Expediente Técnico Enviado',
                'color' => 'blue',
                'requiere_accion' => false,
                'mensaje' => 'Tu documentación técnica está en revisión. (Etapa sin subsanación)'
            ],
            self::AVANZA_E3 => [
                'nombre' => 'Evaluación de Jurados',
                'color' => 'purple',
                'requiere_accion' => false,
                'mensaje' => 'Tu proyecto ha pasado a la fase final de calificación por jurados.'
            ],
            self::ELIMINADO => [
                'nombre' => 'No Continúa',
                'color' => 'rose',
                'requiere_accion' => false,
                'mensaje' => 'El proyecto no superó la fase de validación técnica o administrativa.'
            ],
            self::GANADOR => [
                'nombre' => '¡Seleccionado Ganador!',
                'color' => 'emerald',
                'requiere_accion' => false,
                'mensaje' => 'Felicitaciones, tu proyecto ha sido seleccionado como ganador.'
            ],
            default => [
                'nombre' => $this->estado->nombre ?? 'Inscrito',
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

    /**
     * Relación con el Elenco (Socios agregados al proyecto)
     * Se cambió 'ruta_archivo_autorizacion' por 'archivo_autorizacion_path' 
     * para coincidir con la base de datos.
     */
    public function socios(): BelongsToMany
    {
        return $this->belongsToMany(Socio::class, 'proyecto_socio')
            ->withPivot('archivo_autorizacion_path')
            ->withTimestamps();
    }

    public function director(): HasOne
    {
        return $this->hasOne(Director::class);
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
        return $this->belongsTo(Socio::class, 'socio_id');
    }

    public function convocatoria(): BelongsTo
    {
        return $this->belongsTo(Convocatoria::class);
    }
}
