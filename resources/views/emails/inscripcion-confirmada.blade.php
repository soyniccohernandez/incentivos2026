<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Importar fuentes (Nota: Muchos clientes de correo no las cargan, por eso se usan fallbacks) */
        @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@400;700;900&display=swap');
        
        body { margin: 0; padding: 0; background-color: #000000; font-family: 'Inter', Helvetica, Arial, sans-serif; color: #ffffff; }
        .wrapper { width: 100%; table-layout: fixed; background-color: #000000; padding-bottom: 60px; }
        .main-card { max-width: 600px; margin: 40px auto; background-color: #080808; border: 1px solid #1a1a1a; overflow: hidden; }
        
        .top-bar { height: 6px; background: linear-gradient(90deg, #ff6600, #cc5200); }
        .header { padding: 40px 20px; text-align: center; background-color: #000000; }
        .content { padding: 0 50px 50px 50px; }
        
        .welcome-text { font-family: 'Bebas Neue', 'Arial Black', sans-serif; font-size: 24px; color: #ff6600; letter-spacing: 4px; margin-bottom: 10px; text-transform: uppercase; }
        .user-name { font-family: 'Bebas Neue', 'Arial Black', sans-serif; font-size: 50px; line-height: 0.9; color: #ffffff; margin-bottom: 25px; text-transform: uppercase; }
        .divider { height: 1px; background: linear-gradient(90deg, rgba(255,102,0,0.5), transparent); margin-bottom: 30px; }
        
        .info-text { font-size: 15px; line-height: 1.6; color: #999999; margin-bottom: 35px; }
        .project-title { color: #ffffff; font-weight: 700; }

        /* Caja de Radicado */
        .radicado-box { background-color: #000000; border: 1px solid #ff6600; padding: 40px 20px; text-align: center; margin-bottom: 40px; }
        .radicado-label { font-size: 10px; font-weight: 900; color: #ff6600; letter-spacing: 5px; text-transform: uppercase; margin-bottom: 15px; display: block; }
        .radicado-code { font-family: 'Bebas Neue', 'Arial Black', sans-serif; font-size: 60px; color: #ffffff; letter-spacing: 8px; line-height: 1; text-transform: uppercase; }

        /* Estilo Cinematográfico de Acción / Próximos Pasos */
        .action-container { background-color: #ff6600; padding: 40px 30px; position: relative; text-align: center; }
        .action-tag { background: #000; color: #ff6600; font-weight: 900; font-size: 10px; padding: 5px 15px; letter-spacing: 3px; display: inline-block; margin-bottom: 20px; text-transform: uppercase; }
        .action-title { font-family: 'Bebas Neue', 'Arial Black', sans-serif; font-size: 32px; color: #000000; line-height: 1; margin-bottom: 15px; text-transform: uppercase; }
        .action-desc { color: #000000; font-weight: 700; font-size: 14px; margin-bottom: 25px; text-transform: uppercase; letter-spacing: 1px; }
        
        .btn-black { background-color: #000000; color: #ff6600 !important; padding: 15px 30px; text-decoration: none; font-family: 'Bebas Neue', sans-serif; font-size: 20px; letter-spacing: 2px; display: inline-block; border: 2px solid #000; transition: all 0.3s; }

        .footer { padding: 40px 20px; text-align: center; background-color: #000000; border-top: 1px solid #1a1a1a; }
        .footer-logo { height: 50px; margin-bottom: 20px; }
        .footer-legal { font-size: 10px; color: #444444; letter-spacing: 2px; text-transform: uppercase; line-height: 1.8; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="main-card">
            <div class="top-bar"></div>
            
            <div class="header">
                {{-- Logo con URL Absoluta de Producción para garantizar carga --}}
                <img src="https://incentivos.actores.tech/resources/imagenes/logo.png" alt="Actores SCG" class="footer-logo">
            </div>

            <div class="content">
                <div class="welcome-text">REGISTRO EXITOSO</div>
                <div class="user-name">{{ mb_strtoupper($socio->name) }}</div>
                
                <div class="divider"></div>
                
                <p class="info-text">
                    Tu propuesta titulada <span class="project-title">"{{ mb_strtoupper($proyecto->titulo) }}"</span> ha sido cargada correctamente en el sistema para la <strong>Convocatoria de Incentivos 2026</strong>.
                    <br><br>
                    A continuación, se detalla tu número oficial de radicado para seguimiento:
                </p>

                <div class="radicado-box">
                    <span class="radicado-label">NÚMERO DE RADICADO</span>
                    <div class="radicado-code">{{ $proyecto->codigo_radicado }}</div>
                </div>

                {{-- Bloque Cinematográfico de Acción --}}
                <div class="action-container">
                    <div class="action-tag">FASE: RECEPCIÓN DIGITAL</div>
                    <div class="action-title">HAZ SEGUIMIENTO A TU OBRA</div>
                    <p class="action-desc">
                        REVISA EL CALENDARIO Y EL ESTADO DE TU PROYECTO <br> EN TIEMPO REAL DESDE NUESTRO PORTAL.
                    </p>
                    <a href="https://incentivos.actores.tech/proyectos-inscritos" class="btn-black">VER MI PANEL</a>
                    
                    <div style="margin-top: 20px;">
                        <a href="https://incentivos.actores.tech" style="color: #000; font-size: 11px; text-transform: uppercase; font-weight: 900; letter-spacing: 1px;">Ir a incentivos.actores.tech</a>
                    </div>
                </div>
            </div>

            <div class="footer">
                <div class="footer-legal">
                    ACTORES S.C.G. | SOCIEDAD COLOMBIANA DE GESTIÓN<br>
                    SISTEMA DE POSTULACIÓN DE INCENTIVOS AUDIOVISUALES 2026<br>
                    <span style="color: #333; margin-top: 15px; display: block;">ESTE ES UN MENSAJE AUTOMÁTICO, POR FAVOR NO RESPONDA</span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>