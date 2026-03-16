<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class InitialSetupSeeder extends Seeder
{
    public function run(): void
    {
        // Desactivar llaves foráneas para evitar errores durante el seed
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

       
        $estados = [
            ['id' => 1, 'nombre' => 'Inscrito / En Revisión', 'descripcion' => 'Socio completó Etapa 1. Auditor validando.', 'es_final' => 0],
            ['id' => 2, 'nombre' => 'Debe subsanar', 'descripcion' => 'Socio debe corregir documentos de Etapa 1.', 'es_final' => 0],
            ['id' => 3, 'nombre' => 'En revisión de subsanación', 'descripcion' => 'Socio envió correcciones de Etapa 1.', 'es_final' => 0],
            ['id' => 4, 'nombre' => 'Pasa a etapa 2', 'descripcion' => 'Habilitado para subir Formulario Técnico y Elenco.', 'es_final' => 0],
            ['id' => 5, 'nombre' => 'Etapa 2 - En Revisión', 'descripcion' => 'Formulario técnico enviado. Revisión definitiva.', 'es_final' => 0],
            ['id' => 6, 'nombre' => 'Pasa a etapa 3 - Revisión Jurados', 'descripcion' => 'Proyecto en evaluación por jurados.', 'es_final' => 0],
            ['id' => 7, 'nombre' => 'Seleccionado', 'descripcion' => 'Proyecto premiado.', 'es_final' => 1],
            ['id' => 8, 'nombre' => 'Eliminado', 'descripcion' => 'No superó los filtros técnicos o de documentos.', 'es_final' => 1],
            ['id' => 9, 'nombre' => 'No seleccionado', 'descripcion' => 'Completó el proceso pero no alcanzó el puntaje.', 'es_final' => 1],
        ];

        DB::table('estados')->upsert($estados, ['id'], ['nombre', 'descripcion', 'es_final']);

        // 3. Convocatoria Base
        DB::table('convocatorias')->updateOrInsert(
            ['id' => 1],
            [
                'nombre' => 'Incentivos Audiovisuales',
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
                'nombre' => 'ETAPA 1', // Agrupamos todo lo inicial
                'orden' => 1,
                'es_subsanable' => 1,
                'fecha_inicio' => '2026-03-09 00:00:00',
                'fecha_fin' => '2026-04-24 23:59:59',
            ],
            [
                'id' => 2,
                'convocatoria_id' => 1,
                'nombre' => 'SUBSANACIÓN',
                'orden' => 2,
                'es_subsanable' => 0,
                'fecha_inicio' => '2026-04-25 00:00:00',
                'fecha_fin' => '2026-05-13 23:59:59',
            ],
            [
                'id' => 3,
                'convocatoria_id' => 1,
                'nombre' => 'ETAPA 2',
                'orden' => 3,
                'es_subsanable' => 0,
                'fecha_inicio' => '2026-05-14 00:00:00',
                'fecha_fin' => '2026-06-24 23:59:59',
            ],
            [
                'id' => 4,
                'convocatoria_id' => 1,
                'nombre' => 'ETAPA 3', // El hito final
                'orden' => 4,
                'es_subsanable' => 0,
                'fecha_inicio' => '2026-06-25 00:00:00',
                'fecha_fin' => '2026-10-31 23:59:59',
            ],
             [
                'id' => 5,
                'convocatoria_id' => 1,
                'nombre' => 'ETAPA 4', // El hito final
                'orden' => 5,
                'es_subsanable' => 0,
                'fecha_inicio' => '2026-06-25 00:00:00',
                'fecha_fin' => '2026-10-31 23:59:59',
            ]
        ];

        DB::table('etapas')->upsert($etapas, ['id'], ['nombre', 'orden', 'es_subsanable', 'fecha_inicio', 'fecha_fin']);

        // 5. Tipos de Documento
        $documentos = [
            // ETAPA 1
            ['id' => 1, 'nombre' => 'ANEXO 1: MANIFESTACIÓN DEL DIRECTOR', 'etapa_id' => 1, 'obligatorio' => 1, 'permite_subsanacion' => 1],
            ['id' => 2, 'nombre' => 'ANEXO 2: EXPERIENCIA COMO DIRECTOR GENERAL', 'etapa_id' => 1, 'obligatorio' => 1, 'permite_subsanacion' => 1],
            ['id' => 3, 'nombre' => 'ANEXO 3: AUTORIZACIÓN USO DEL GUION', 'etapa_id' => 1, 'obligatorio' => 0, 'permite_subsanacion' => 1],
            ['id' => 4, 'nombre' => 'CERTIFICADO Y EVIDENCIAS 1', 'etapa_id' => 1, 'obligatorio' => 1, 'permite_subsanacion' => 1],
            ['id' => 5, 'nombre' => 'CERTIFICADO Y EVIDENCIAS 2', 'etapa_id' => 1, 'obligatorio' => 1, 'permite_subsanacion' => 1],
            ['id' => 6, 'nombre' => 'ANEXO 4: CONSIDERACIONES Y DECLARACIONES GENERALES', 'etapa_id' => 1, 'obligatorio' => 1, 'permite_subsanacion' => 1],

            // ETAPA 2 (Ajustados a mayúsculas)
            ['id' => 7, 'nombre' => 'CARTA DE INTENCIÓN', 'etapa_id' => 2, 'obligatorio' => 1, 'permite_subsanacion' => 0],
            ['id' => 8, 'nombre' => 'GUION', 'etapa_id' => 2, 'obligatorio' => 1, 'permite_subsanacion' => 0],
            ['id' => 9, 'nombre' => 'RADICADO GUION DNDA', 'etapa_id' => 2, 'obligatorio' => 1, 'permite_subsanacion' => 0],
            ['id' => 10, 'nombre' => 'PROPUESTA CREATIVA', 'etapa_id' => 2, 'obligatorio' => 1, 'permite_subsanacion' => 0],
            ['id' => 11, 'nombre' => 'PRESUPUESTO', 'etapa_id' => 2, 'obligatorio' => 1, 'permite_subsanacion' => 0],
            ['id' => 12, 'nombre' => 'CRONOGRAMA', 'etapa_id' => 2, 'obligatorio' => 1, 'permite_subsanacion' => 0],
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
