<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incentivos 2026 - Registro Exitoso</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@400;700;900&display=swap');

        body { margin: 0; padding: 0; background-color: #000000; font-family: 'Inter', Helvetica, Arial, sans-serif; color: #ffffff; }
        .wrapper { width: 100%; table-layout: fixed; background-color: #ffffff; padding-bottom: 60px; }
        .main-card { max-width: 600px; margin: 40px auto; background-color: #000000; border: 1px solid #1a1a1a; overflow: hidden; }

        /* HEADER INDUSTRIAL / CINEMATOGRÁFICO */
        .industrial-header {
            background-color: #ff6600; /* brand-orange */
            padding: 60px 20px;
            text-align: center;
            border-bottom: 15px solid #000000;
            position: relative;
        }
        
        .hud-tag {
            display: inline-block;
            background-color: #000000;
            color: #ffffff;
            font-family: monospace;
            font-size: 10px;
            padding: 5px 15px;
            letter-spacing: 4px;
            font-weight: bold;
            margin-bottom: 20px;
            text-transform: uppercase;
        }

        .font-bebas { font-family: 'Bebas Neue', 'Arial Black', sans-serif; }
        .main-title { 
            font-size: 70px; 
            line-height: 0.85; 
            color: #000000; 
            margin: 0; 
            text-transform: uppercase; 
            letter-spacing: -2px;
        }

        /* CONTENIDO PRINCIPAL */
        .content { padding: 50px 40px; text-align: center; }
        .welcome-tag { font-size: 12px; color: #ff6600; font-weight: 900; letter-spacing: 5px; margin-bottom: 10px; text-transform: uppercase; }
        .user-name { font-size: 42px; line-height: 0.9; color: #ffffff; margin-bottom: 30px; text-transform: uppercase; }
        .info-text { font-size: 14px; line-height: 1.8; color: #888888; margin-bottom: 35px; text-transform: uppercase; letter-spacing: 1px; }
        .project-title { color: #ffffff; font-weight: 900; border-bottom: 2px solid #ff6600; }

        /* CAJA DE RADICADO TÉCNICA */
        .radicado-box {
            background-color: #080808;
            border: 2px dashed #333;
            padding: 40px 20px;
            text-align: center;
            margin-bottom: 40px;
        }
        .radicado-label { font-size: 10px; font-weight: 900; color: #ff6600; letter-spacing: 5px; text-transform: uppercase; margin-bottom: 15px; display: block; }
        .radicado-code { font-size: 50px; color: #ffffff; letter-spacing: 4px; line-height: 1; text-transform: uppercase; }

        /* SECCIÓN DE ACCIÓN (BOTÓN ESTILO INDUSTRIAL) */
        .action-container { background-color: #ffffff; padding: 60px 30px; text-align: center; }
        .action-title { font-size: 32px; color: #000000; line-height: 1; margin-bottom: 25px; text-transform: uppercase; }
        
        .btn-industrial {
            background-color: #000000;
            color: #ffffff !important;
            padding: 20px 35px;
            text-decoration: none;
            font-size: 24px;
            letter-spacing: 3px;
            display: inline-block;
            border: 4px solid #000000;
            box-shadow: 8px 8px 0px #ff6600; /* Sombra sólida naranja */
            text-transform: uppercase;
        }

        .footer { padding: 50px 20px; text-align: center; background-color: #000000; border-top: 1px solid #1a1a1a; }
        .footer-legal { font-size: 9px; color: #ffffff; letter-spacing: 2px; text-transform: uppercase; line-height: 2; opacity: 0.5; }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="main-card">

            <div class="industrial-header">
                <div class="hud-tag">● REC_2026</div>
                <h1 class="font-bebas main-title">REGISTRO<br><span style="color: #ffffff;">COMPLETO</span></h1>
                <div style="font-size: 10px; color: #000; letter-spacing: 6px; margin-top: 20px; font-weight: 900; text-transform: uppercase; opacity: 0.7;">
                    INCENTIVOS AUDIOVISUALES 2026
                </div>
            </div>

            <div class="content">
                <div class="welcome-tag font-bebas">PROPONENTE IDENTIFICADO</div>
                <div class="font-bebas user-name">{{ mb_strtoupper($socio->name ?? 'ERICK NICOLÁS HERNÁNDEZ') }}</div>

                <p class="info-text">
                    TU PROPUESTA TITULADA <span class="project-title">"{{ mb_strtoupper($proyecto->titulo ?? 'SIN TÍTULO') }}"</span> HA SIDO CARGADA CORRECTAMENTE.
                    <br><br>
                    CONSERVA TU NÚMERO DE RADICADO:
                </p>

                <div class="radicado-box">
                    <span class="radicado-label">NÚMERO DE RADICADO</span>
                    <div class="font-bebas radicado-code">{{ $proyecto->codigo_radicado ?? '2026-INC-000' }}</div>
                </div>

                <div class="action-container">
                    <div class="font-bebas action-title">HAZ SEGUIMIENTO A TU POSTULACIÓN POR CADA ETAPA</div>
                    
                    <a href="https://incentivos.actores.tech/convocatoria/validar" class="font-bebas btn-industrial">
                        VER MI PANEL →
                    </a>

                    <div style="margin-top: 40px;">
                        <a href="https://incentivos.actores.tech/proyectos-inscritos" style="color: #000; font-size: 10px; text-transform: uppercase; font-weight: 900; letter-spacing: 2px; text-decoration: none; border-bottom: 2px solid #ff6600;">Regresar al portal principal</a>
                    </div>
                </div>
            </div>

            <div class="footer">
                <div class="footer-legal">
                    ACTORES S.C.G. | SOCIEDAD COLOMBIANA DE GESTIÓN<br>
                    SISTEMA DE POSTULACIÓN DE INCENTIVOS 2026<br>
                    <span style="color: #ff6600; display: block; margin-top: 15px; font-weight: bold;">MENSAJE DEL SISTEMA • NO RESPONDER</span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>