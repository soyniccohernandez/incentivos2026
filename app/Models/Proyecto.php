<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class Proyecto extends Model
{
    protected $table = 'proyectos';

    protected $fillable = [
        'codigo_radicado',
        'socio_id',
        'convocatoria_id',
        'titulo',
        'estado_id',
        'publicado',
        'etapa_id',
        'fecha_postulacion',
        'observacion_general',
    ];

    protected $casts = [
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
            // Generamos un número aleatorio de 5 dígitos (entre 10000 y 99999)
            $numeroAleatorio = rand(10000, 99999);
            $proyecto->codigo_radicado = "{$anio}-INC-{$numeroAleatorio}";

            if (!$proyecto->fecha_postulacion) {
                $proyecto->fecha_postulacion = now();
            }
        });
    }

    /**
     * RELACIONES
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

    public function elenco()
    {
        // Esto conecta tu proyecto con muchos socios a través de la tabla que acabamos de crear
        return $this->belongsToMany(Socio::class, 'proyecto_socio');
    }
}
