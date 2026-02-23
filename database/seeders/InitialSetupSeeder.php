<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Carbon\Carbon;

class InitialSetupSeeder extends Seeder
{
    public function run(): void
    {
        // Desactivar llaves foráneas para evitar errores durante el seed
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // 1. Usuario Administrador (Ahora con campos de la tabla users unificada)
        User::updateOrCreate(
            ['email' => 'nhernandez@actores.org.co'],
            [
                'id' => 1,
                'name' => 'Erick Nicolás Hernández Díaz',
                'password' => '$2y$12$Jn85eOJ1jqwOX4m2gBMdROVPTguZYfQffx2vng1wU37eXjF.85xyi',
                'identificacion' => '123456789', // Añadido
                'tipo_socio' => 'Administrador', // O el valor que manejes para roles
                'estado' => 'Activo',
                'email_verified_at' => now(),
                'created_at' => '2026-02-13 22:11:15',
                'updated_at' => now(),
            ]
        );

        // 2. Estados (Mantenemos tu lógica de 9 estados para que coincida con Proyecto.php)
        $estados = [
            ['id' => 1, 'nombre' => 'Inscrito / En Revisión', 'descripcion' => 'Socio completó Etapa 1. Auditor validando.', 'es_final' => 0],
            ['id' => 2, 'nombre' => 'En Subsanación', 'descripcion' => 'Socio debe corregir documentos de Etapa 1.', 'es_final' => 0],
            ['id' => 3, 'nombre' => 'En revisión de subsanación', 'descripcion' => 'Socio envió correcciones de Etapa 1.', 'es_final' => 0],
            ['id' => 4, 'nombre' => 'En Etapa 2', 'descripcion' => 'Habilitado para subir Formulario Técnico y Elenco.', 'es_final' => 0],
            ['id' => 5, 'nombre' => 'Etapa 2 - En Revisión', 'descripcion' => 'Formulario técnico enviado. Revisión definitiva.', 'es_final' => 0],
            ['id' => 6, 'nombre' => 'Etapa 3 - Revisión Jurados', 'descripcion' => 'Proyecto en evaluación por jurados.', 'es_final' => 0],
            ['id' => 7, 'nombre' => 'Seleccionado (Ganador)', 'descripcion' => 'Proyecto premiado.', 'es_final' => 1],
            ['id' => 8, 'nombre' => 'Eliminado', 'descripcion' => 'No superó los filtros técnicos o de documentos.', 'es_final' => 1],
            ['id' => 9, 'nombre' => 'No seleccionado', 'descripcion' => 'Completó el proceso pero no alcanzó el puntaje.', 'es_final' => 1],
        ];

        DB::table('estados')->upsert($estados, ['id'], ['nombre', 'descripcion', 'es_final']);

        // 3. Convocatoria Base
        DB::table('convocatorias')->updateOrInsert(
            ['id' => 1],
            [
                'nombre' => 'Incentivos de Creación y Producción Audiovisual',
                'descripcion' => 'Fondo de incentivos para el desarrollo actoral.',
                'fecha_inicio' => '2026-01-01',
                'fecha_fin' => '2026-12-31',
                'estado' => 'abierta',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        $ahora = Carbon::now();

        // 4. Etapas
        $etapas = [
            [
                'id' => 1,
                'convocatoria_id' => 1,
                'nombre' => 'Etapa 1: Inscripción',
                'orden' => 1,
                'es_subsanable' => 1,
                'fecha_inicio' => $ahora->copy()->subDays(5),
                'fecha_fin' => $ahora->copy()->addDays(10),
            ],
            [
                'id' => 2,
                'convocatoria_id' => 1,
                'nombre' => 'Etapa 2: Requisitos Técnicos',
                'orden' => 2,
                'es_subsanable' => 0,
                'fecha_inicio' => $ahora->copy()->addDays(11),
                'fecha_fin' => $ahora->copy()->addDays(20),
            ],
            [
                'id' => 3,
                'convocatoria_id' => 1,
                'nombre' => 'Etapa 3: Evaluación de Jurados',
                'orden' => 3,
                'es_subsanable' => 0,
                'fecha_inicio' => $ahora->copy()->addDays(21),
                'fecha_fin' => $ahora->copy()->addDays(30),
            ],
        ];

        DB::table('etapas')->upsert($etapas, ['id'], ['nombre', 'orden', 'es_subsanable', 'fecha_inicio', 'fecha_fin']);

        // 5. Tipos de Documento
        $documentos = [
            ['id' => 1, 'nombre' => 'Autorización uso de guion', 'etapa_id' => 1, 'obligatorio' => 0, 'permite_subsanacion' => 1],
            ['id' => 2, 'nombre' => 'Experiencia del director', 'etapa_id' => 1, 'obligatorio' => 1, 'permite_subsanacion' => 1],
            ['id' => 3, 'nombre' => 'Compromiso de participación del director', 'etapa_id' => 1, 'obligatorio' => 1, 'permite_subsanacion' => 1],
            ['id' => 4, 'nombre' => 'Certificado y evidencias 1', 'etapa_id' => 1, 'obligatorio' => 1, 'permite_subsanacion' => 1],
            ['id' => 5, 'nombre' => 'Certificado y evidencias 2', 'etapa_id' => 1, 'obligatorio' => 1, 'permite_subsanacion' => 1],
            ['id' => 6, 'nombre' => 'Declaraciones y consideraciones', 'etapa_id' => 1, 'obligatorio' => 1, 'permite_subsanacion' => 1],
            ['id' => 7, 'nombre' => 'Carta de intención', 'etapa_id' => 2, 'obligatorio' => 1, 'permite_subsanacion' => 0],
            ['id' => 8, 'nombre' => 'Guion', 'etapa_id' => 2, 'obligatorio' => 1, 'permite_subsanacion' => 0],
            ['id' => 9, 'nombre' => 'Radicado guion DNDA', 'etapa_id' => 2, 'obligatorio' => 1, 'permite_subsanacion' => 0],
            ['id' => 10, 'nombre' => 'Propuesta creativa', 'etapa_id' => 2, 'obligatorio' => 1, 'permite_subsanacion' => 0],
            ['id' => 11, 'nombre' => 'Presupuesto', 'etapa_id' => 2, 'obligatorio' => 1, 'permite_subsanacion' => 0],
            ['id' => 12, 'nombre' => 'Cronograma', 'etapa_id' => 2, 'obligatorio' => 1, 'permite_subsanacion' => 0],
        ];

        foreach ($documentos as $doc) {
            DB::table('tipos_documento')->updateOrInsert(
                ['id' => $doc['id']],
                [
                    'nombre' => $doc['nombre'],
                    'descripcion' => 'Requisito para ' . ($doc['etapa_id'] == 1 ? 'Inscripción' : 'Evaluación Técnica'),
                    'obligatorio' => $doc['obligatorio'],
                    'etapa_id' => $doc['etapa_id'],
                    'permite_subsanacion' => $doc['permite_subsanacion'],
                    'updated_at' => now(),
                ]
            );
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}