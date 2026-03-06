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
            ['1000034462', 'David Alejandro Abaunza Melo', 'Masculino', 'Adherido', '2001-11-17', '24', 'Calle 68a #79-31 - Barrio: San Marcos', '3116493198', 'dabaunza@actores.org.co', 'activo'],
            ['52735844', 'Julie Pauline Alvarado Alvarado', 'Femenino', 'Adherido', '1983-08-16', '42', 'Calle 32 B Sur No. 4B-16', '3107840363', 'Jalvarado@actores.org.co', 'activo'],
            ['1014260424', 'Paula Andrea Arce Reina', 'Femenino', 'P. Derecho', '1994-11-20', '31', 'Cra 119#80-22 El cortijo, Engativá', '3022360987', 'Parce@actores.org.co', 'activo'],
            ['1010002981', 'Laura Viviana Ávila Morales', 'Femenino', 'P. Derecho', '2000-12-27', '25', 'Cra 53 # 128 B 13 Prado Veraniego, Bogotá', '3207500715', 'vavila@actores.org.co', 'activo'],
            ['52883642', 'Carol Aza Enciso', 'Femenino', 'Adherido', '1981-07-08', '44', 'Carrera 4 #16-74 apto 908', '3132393076', 'cenciso@actores.org.co', 'activo'],
            ['1014289331', 'Omar Julian Bonilla Triana', 'Masculino', 'Adherido', '1997-06-10', '28', 'CALLE 88 NO. 95-76 - CIUDAD BACHUE, ENGATIVA', '3223012124', 'jbonilla@actores.org.co', 'activo'],
            ['1032356981', 'Santiago Cabrera Santos', 'Masculino', 'Adherido', '1986-02-24', '40', 'Calle 138 no 10a-97 apto 1112', '3102923680', 'scabrera@actores.org.co', 'activo'],
            ['1018438569', 'José Idelman Calvo Rodríguez', 'Masculino', 'P. Derecho', '1990-10-20', '35', 'Carrera 70 D N°48A-77, Normandía', '3219918690', 'jcalvo@actores.org.co', 'activo'],
            ['1143449988', 'Angie Loraine Castillo Perez', 'Femenino', 'P. Derecho', '1994-11-29', '31', 'KM 3 VÍA CHÍA CAJICA, FINCA VILLA CLELIA', '3194580203', 'acastillo@actores.org.co', 'activo'],
            ['52271367', 'Carmen Alicia Cordoba Romaña', 'Femenino', 'P. Derecho', '1969-10-16', '56', 'Calle 48 p sur 2 12 barrio molinos', '3133639159', 'aliciiacordoba45@gmail.com', 'activo'],
            ['1000018323', 'Juan Sebastian Correa Martinez', 'Masculino', 'P. Derecho', '2001-12-03', '24', 'Cra 34 #3-39 - Veraguas, Puente Aranda', '3023524730', 'scorrea@actores.org.co', 'activo'],
            ['1016094569', 'Persy Yulian Cruz Lopez', 'Masculino', 'P. Derecho', '1997-05-09', '28', 'Calle11#88a-61 nueva Castilla Kennedy', '3023054108', 'Pcruz@actores.org.co', 'activo'],
            ['1014659341', 'Vivian Julieth Galvan Rodríguez', 'Femenino', 'Adherido', '2005-03-29', '20', 'Cra90a #4-40 Primavera - Kennedy', '3173884786', 'jgalvan@actores.org.co', 'activo'],
            ['1015395925', 'Johana Caterine Gómez Narvaez', 'Femenino', 'Adherido', '1986-09-04', '39', 'Calle 70 69 i - 25', '3133640104', 'jgomez@actores.org.co', 'activo'],
            ['1023019881', 'Erick Nicolás Hernández Díaz', 'Masculino', 'P. Derecho', '1997-03-16', '28', 'Dig 77 BIS sur No. 14P – 75 Barrio Miravalle', '3229356936', 'nhernandez@actores.org.co', 'activo'],
            ['1007540351', 'Laura Margarita León Contreras', 'Femenino', 'P. Derecho', '2000-09-28', '25', 'Carrera 21 #145-50 - El cedrito, Usaquen', '3224461850', 'Maleon@actores.org.co', 'activo'],
            ['52357816', 'Elva Lucero Mariño Parra', 'Femenino', 'Adherido', '1972-11-10', '53', 'Calle 128b# 93 a 43 Casa 41', '3166905085', 'eluparra@hotmail.com', 'activo'],
            ['1000687271', 'Marisol Mayorga Romero', 'Femenino', 'Administrador', '1999-04-17', '26', 'Cl 40a #13-24', '3204610316', 'mmayorga@actores.org.co', 'activo'],
            ['1022436183', 'Angie Susana Orozco Castellar', 'Femenino', 'Adherido', '1998-05-06', '27', 'Calle 12a #71b-61 - Villa Alsacia', '3229029625', 'sorozco@actores.org.co', 'activo'],
            ['1013619273', 'Catalina Parra García', 'Femenino', 'P. Derecho', '1991-02-12', '35', 'Cra 80 N 8 - 11 Castilla, Kennedy', '3208146155', 'cparra@actores.org.co', 'activo'],
            ['52793890', 'Eunise Pedreros López', 'Femenino', 'P. Derecho', '1981-07-28', '44', 'Calle 66 #103-37', '3115103355', 'epedreros@actores.org.co', 'activo'],
            ['1030594986', 'Johana Andrea Perea Ospina', 'Femenino', 'P. Derecho', '1991-07-10', '34', 'Cra 118 #86-35 Ciudadela Colsubsidio', '3192154095', 'aperea@actores.org.co', 'activo'],
            ['1022999371', 'Heidy Daniela Quintero Chimbi', 'Femenino', 'P. Derecho', '1994-09-26', '31', 'Calle 48 bis sur # 22a - 21', '3195434475', 'hquintero@actores.org.co', 'activo'],
            ['1022394944', 'Steven Ramos Usaquen', 'Masculino', 'P. Derecho', '1994-07-21', '31', 'Cra 4 # 17 sur - 64 Soacha', '3015156310', 'sramos@actores.org.co', 'activo'],
            ['1098751223', 'Maria Camila Rangel Sarmiento', 'Femenino', 'Adherido', '1994-03-06', '31', 'Carrera 54 # 153 - 75', '3016169100', 'crangel@actores.org.co', 'activo'],
            ['80725456', 'Edisson Andrés Reina Díaz', 'Masculino', 'Adherido', '1982-08-20', '43', 'Calle 163B # 50-64 apto 419 Britalia Norte', '3143045184', 'areina@actores.org.co', 'activo'],
            ['1015475653', 'Lina María Rodríguez Jara', 'Femenino', 'P. Derecho', '1998-07-10', '27', 'Calle 44 # 67 a 13, barrio El Greco', '3104591120', 'lrodriguez@actores.org.co', 'activo'],
            ['1000372983', 'Paula Alejandra Rodríguez Rey', 'Femenino', 'P. Derecho', '2001-06-22', '24', 'Carrera 92 #75-91', '3106082215', 'Prodriguez@actores.org.co', 'activo'],
            ['1019042477', 'María Alejandra Rojas Matabajoy', 'Femenino', 'Adherido', '1990-01-24', '36', 'Carrera 27 #45A 75 apartamento 301', '3203010744', 'arojas@actores.org.co', 'activo'],
            ['1016942104', 'Cindy Rubio Rubio Castelblanco', 'Femenino', 'Adherido', '2003-11-29', '22', 'Calle 67 #81 B - 13 - San Marcos', '3133413976', 'crubio@actores.org.co', 'activo'],
            ['1000688005', 'María Camila Rueda Alfonso', 'Femenino', 'Adherido', '2003-01-17', '23', 'Carrera 112 bis # 81-20', '3143459003', 'crueda@actores.org.co', 'activo'],
            ['1030662964', 'Angie Lorena Sanchez Paez', 'Femenino', 'P. Derecho', '1996-02-06', '30', 'Banderas', '3209585782', 'lsanchez@actores.org.co', 'activo'],
            ['80176492', 'Diego Armando Simijaca Arias', 'Masculino', 'P. Derecho', '1984-07-18', '41', 'Calle 6c # 82a-57 Ap 1001 T 2', '3162487421', 'dsimijaca@actores.org.co', 'activo'],
            ['1020828419', 'Santiago Tavera Cardozo', 'Masculino', 'P. Derecho', '1997-09-22', '28', 'Cra 19a # 122 - 74', '3115383094', 'stavera@actores.org.co', 'activo'],
            ['1018508368', 'Laura Esmeralda Vasquez Cely', 'Femenino', 'P. Derecho', '1999-01-11', '27', 'CRR 18 # 67 - 23 SUR, LUCERO MEDIO', '3058273561', 'lvasquez@actores.org.co', 'activo'],
            ['1007159100', 'Jonathan Steven Vega Yepes', 'Masculino', 'P. Derecho', '2002-12-20', '23', 'Ciudad Verde, Soacha', '3125447699', 'Jvega@actores.org.co', 'activo'],
            ['1018440741', 'Leidy Lised Zambrano Arévalo', 'Femenino', 'P. Derecho', '1991-01-06', '35', 'Cra 8 B # 107 - 41 Santa Ana occidental', '3108824912', 'lzambrano@actores.org.co', 'activo'],
            ['1023033067', 'Anguie Guiowanna Rivera Carrero', 'Femenino', 'P. Derecho', '1999-01-23', '27', 'Cra 8 B # 107 - 41 Santa Ana occidental', '3134150631', 'angierivera23@gmail.com', 'activo'],
        ];

        foreach ($usuarios as $u) {
            // Limpiamos la identificación
            $idLimpia = str_replace('.', '', $u[0]);

            DB::table('users')->updateOrInsert(
                ['email' => $u[8]], // El email es el índice 8
                [
                    'identificacion'   => $idLimpia,
                    'name'             => $u[1],
                    'genero'           => $u[2],
                    'tipo_socio'       => $u[3],
                    'fecha_nacimiento' => $u[4],
                    // Saltamos el $u[5] porque es la edad y no está en tu esquema
                    'direccion'        => $u[6], // La dirección es el índice 6
                    'telefono'         => $u[7], // El teléfono es el índice 7
                    'estado'           => 'Activo',
                    'password'         => Hash::make($idLimpia . '*2026'),
                    'created_at'       => now(),
                    'updated_at'       => now(),
                ]
            );
        }
    }
}
