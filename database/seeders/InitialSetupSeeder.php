<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class InitialSetupSeeder extends Seeder
{
    public function run(): void
    {
        // Desactivar llaves foráneas para evitar errores durante el seed
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // 1. Usuario Administrador
        User::updateOrCreate(
            ['id' => 1],
            [
                'name' => 'Erick Nicolás Hernández Díaz',
                'email' => 'nhernandez@actores.org.co',
                'password' => '$2y$12$Jn85eOJ1jqwOX4m2gBMdROVPTguZYfQffx2vng1wU37eXjF.85xyi',
                'email_verified_at' => null,
                'created_at' => '2026-02-13 22:11:15',
                'updated_at' => '2026-02-13 22:11:15',
            ]
        );

        // 2. Estados
        $estados = [
            ['id' => 1, 'nombre' => 'Inscrito', 'descripcion' => 'Recién registrado', 'es_final' => 0],
            ['id' => 2, 'nombre' => 'En revisión etapa 1 (Inscripción)', 'descripcion' => 'Validando docs básicos', 'es_final' => 0],
            ['id' => 3, 'nombre' => 'Subsanación etapa 1 (Inscripción)', 'descripcion' => 'Debe corregir documentos', 'es_final' => 0],
            ['id' => 4, 'nombre' => 'En etapa 2', 'descripcion' => 'Aprobado para fase técnica', 'es_final' => 0],
            ['id' => 5, 'nombre' => 'Revisión etapa 2', 'descripcion' => 'Validando fase técnica', 'es_final' => 0],
            ['id' => 6, 'nombre' => 'Avanza etapa 3 (Revisión jurados)', 'descripcion' => 'En manos de jurados', 'es_final' => 0],
            ['id' => 7, 'nombre' => 'Revisión etapa 3', 'descripcion' => 'Jurados calificando', 'es_final' => 0],
            ['id' => 8, 'nombre' => 'Eliminado', 'descripcion' => 'No continúa en el proceso', 'es_final' => 1],
            ['id' => 9, 'nombre' => 'No seleccionado', 'descripcion' => 'Finalizó pero no ganó', 'es_final' => 1],
            ['id' => 10, 'nombre' => 'Seleccionado (Ganador)', 'descripcion' => 'Proyecto ganador', 'es_final' => 1],
        ];
        DB::table('estados')->upsert($estados, ['id'], ['nombre', 'descripcion', 'es_final']);

        // 3. Convocatoria Base
        DB::table('convocatorias')->updateOrInsert(
            ['id' => 1],
            [
                'nombre' => 'Convocatoria Incentivos de Creación Audiovisual de Actores S.C.G. 2026',
                'descripcion' => 'Fondo de incentivos para el desarrollo actoral.',
                'fecha_inicio' => '2026-01-01',
                'fecha_fin' => '2026-12-31',
                'estado' => 'abierta',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // 4. Etapas
        $etapas = [
            ['id' => 1, 'convocatoria_id' => 1, 'nombre' => 'Etapa 1: Inscripción', 'orden' => 1, 'es_subsanable' => 1],
            ['id' => 2, 'convocatoria_id' => 1, 'nombre' => 'Etapa 2: Requisitos Técnicos', 'orden' => 2, 'es_subsanable' => 0],
            ['id' => 3, 'convocatoria_id' => 1, 'nombre' => 'Etapa 3: Evaluación de Jurados', 'orden' => 3, 'es_subsanable' => 0],
        ];
        DB::table('etapas')->upsert($etapas, ['id'], ['nombre', 'orden', 'es_subsanable']);

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
                    'descripcion' => 'Proyecta una descripción',
                    'obligatorio' => $doc['obligatorio'],
                    'etapa_id' => $doc['etapa_id'],
                    'permite_subsanacion' => $doc['permite_subsanacion'],
                    'created_at' => '2026-02-13 17:10:04',
                    'updated_at' => '2026-02-13 17:10:04',
                ]
            );
        }

        // Volver a activar llaves foráneas
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}