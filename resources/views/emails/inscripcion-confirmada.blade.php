<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@400;700;900&display=swap');
        body { margin: 0; padding: 0; background-color: #000000; font-family: 'Inter', Helvetica, Arial, sans-serif; color: #ffffff; }
        .wrapper { width: 100%; table-layout: fixed; background-color: #000000; padding-bottom: 60px; }
        .main-card { max-width: 600px; margin: 40px auto; background-color: #080808; border: 1px solid #1a1a1a; overflow: hidden; }
        
        .top-bar { height: 6px; background: linear-gradient(90deg, #ff6600, #cc5200); }
        .header { padding: 40px 20px; text-align: center; background-color: #000000; }
        .content { padding: 0 50px 50px 50px; }
        
        .welcome-text { font-family: 'Bebas Neue', sans-serif; font-size: 24px; color: #ff6600; letter-spacing: 4px; margin-bottom: 10px; text-transform: uppercase; }
        .user-name { font-family: 'Bebas Neue', sans-serif; font-size: 50px; line-height: 0.9; color: #ffffff; margin-bottom: 25px; text-transform: uppercase; }
        .divider { height: 1px; background: linear-gradient(90deg, rgba(255,102,0,0.5), transparent); margin-bottom: 30px; }
        
        .info-text { font-size: 15px; line-height: 1.6; color: #999999; margin-bottom: 35px; }
        .project-title { color: #ffffff; font-weight: 700; }

        /* Caja de Radicado Premium */
        .radicado-box { background-color: #000000; border: 1px solid #ff6600; padding: 40px 20px; text-align: center; margin-bottom: 40px; }
        .radicado-label { font-size: 10px; font-weight: 900; color: #ff6600; letter-spacing: 5px; text-transform: uppercase; margin-bottom: 15px; display: block; }
        .radicado-code { font-family: 'Bebas Neue', sans-serif; font-size: 60px; color: #ffffff; letter-spacing: 8px; line-height: 1; text-transform: uppercase; }

        /* Sección de Próximos Pasos */
        .steps-container { background-color: rgba(255,255,255,0.03); padding: 25px; border-left: 3px solid #ff6600; text-align: left; }
        .step-title { font-family: 'Bebas Neue', sans-serif; font-size: 18px; color: #ffffff; letter-spacing: 2px; margin-bottom: 10px; display: block; }
        .step-item { font-size: 12px; color: #666666; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 5px; display: block; }

        .footer { padding: 40px 20px; text-align: center; background-color: #000000; border-top: 1px solid #1a1a1a; }
        .footer-logo { height: 40px; margin-bottom: 20px; opacity: 0.8; filter: grayscale(1) brightness(2); }
        .footer-legal { font-size: 10px; color: #444444; letter-spacing: 2px; text-transform: uppercase; line-height: 1.8; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="main-card">
            <div class="top-bar"></div>
            
            <div class="header">
                {{-- Nota: El asset() a veces no carga en emails, se recomienda URL absoluta si es posible --}}
                <img src="{{ asset('resources/imagenes/logo.png') }}" alt="Logo" class="footer-logo">
            </div>

            <div class="content">
                <div class="welcome-text">REGISTRO EXITOSO</div>
                <div class="user-name">{{ mb_strtoupper($socio->name) }}</div>
                
                <div class="divider"></div>
                
                <p class="info-text">
                    Tu propuesta titulada <span class="project-title">"{{ mb_strtoupper($proyecto->titulo) }}"</span> ha sido cargada correctamente en el sistema para la <strong>Convocatoria de Incentivos 2026</strong>.
                    <br><br>
                    A continuación, se detalla tu número oficial de radicado para seguimiento y soporte:
                </p>

                <div class="radicado-box">
                    <span class="radicado-label">NÚMERO DE RADICADO</span>
                    <div class="radicado-code">{{ $proyecto->codigo_radicado }}</div>
                </div>

                <div class="steps-container">
                    <span class="step-title">PRÓXIMOS PASOS:</span>
                    <span class="step-item">● Verifica el estado en "Mi Panel"</span>
                    <span class="step-item">● Mantente atento a tu correo electrónico</span>
                    <span class="step-item">● El comité técnico iniciará la revisión</span>
                </div>
            </div>

            <div class="footer">
                <div class="footer-legal">
                    ACTORES S.C.G. | SOCIEDAD COLOMBIANA DE GESTIÓN<br>
                    SISTEMA DE POSTULACIÓN DE INCENTIVOS AUDIOVISUALES 2026<br>
                    <span style="color: #222; margin-top: 10px; display: block;">POR FAVOR NO RESPONDA A ESTE CORREO</span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>