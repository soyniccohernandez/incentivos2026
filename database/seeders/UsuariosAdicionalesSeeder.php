<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuariosAdicionalesSeeder extends Seeder
{
    public function run()
    {
        $usuarios = [
            ['1.020.828.419', 'Santiago Tavera Cardozo', 'Hombre', 'Adherido', '1995-10-10', 'CALLE 123', '32293569874', 'stavera@actores.org.co'],
            ['1.022.394.944', 'Steven Ramos Usaquen', 'Hombre', 'Adherido', '1995-10-10', 'CALLE 124', '32293569874', 'sramos@actores.org.co'],
            ['1.032.356.981', 'Santiago Cabrera Santos', 'Hombre', 'P. Derecho', '1995-10-10', 'CALLE 125', '32293569874', 'scabrera@actores.org.co'],
            ['1.000.687.271', 'Marisol Mayorga Romero', 'Mujer', 'Administrador', '1995-10-10', 'CALLE 126', '32293569874', 'mmayorga@actores.org.co'],
            ['1.098.751.223', 'María Camila Rangel Sarmiento', 'Mujer', 'Adherido', '1995-10-10', 'CALLE 127', '32293569874', 'crangel@actores.org.co'],
            ['1.015.475.653', 'Lina María Rodríguez Jara', 'Mujer', 'Adherido', '1995-10-10', 'CALLE 128', '32293569874', 'lrodríguez@actores.org.co'],
            ['1.016.094.569', 'Persy Yulian Cruz López', 'Hombre', 'Adherido', '1995-10-10', 'CALLE 129', '32293569874', 'pcruz@actores.org.co'],
            ['1.018.508.368', 'Laura Esmeralda Vásquez Cely', 'Mujer', 'P. Derecho', '1995-10-10', 'CALLE 130', '32293569874', 'lvasquez@actores.org.co'],
            ['1.018.438.569', 'José Idelman Calvo Rodríguez', 'Hombre', 'P. Derecho', '1995-10-10', 'CALLE 131', '32293569874', 'icalvo@actores.org.co'],
            ['1.013.619.273', 'Catalina Parra García', 'Mujer', 'P. Derecho', '1995-10-10', 'CALLE 132', '32293569874', 'cparra@actores.org.co'],
            ['1.023.019.881', 'Erick Nicolás Hernández Díaz', 'Hombre', 'P. Derecho', '1995-10-10', 'CALLE 132', '3229356936', 'ericknicolashernandezdiaz@gmail.com'],
        ];

        foreach ($usuarios as $u) {
            // Limpiamos la identificación de puntos para la contraseña y el campo ID
            $idLimpia = str_replace('.', '', $u[0]);

            DB::table('users')->updateOrInsert(
                ['email' => $u[7]], // Si el email existe, lo actualiza; si no, lo crea.
                [
                    'identificacion'   => $idLimpia,
                    'name'             => $u[1],
                    'genero'           => $u[2],
                    'tipo_socio'       => $u[3],
                    'fecha_nacimiento' => $u[4],
                    'direccion'        => $u[5],
                    'telefono'         => $u[6],
                    'estado'           => 'Activo',
                    'password'         => Hash::make($idLimpia . '*2026'),
                    'created_at'       => now(),
                    'updated_at'       => now(),
                ]
            );
        }
    }
}
