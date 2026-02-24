<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@400;700;900&display=swap');

        body {
            margin: 0;
            padding: 0;
            background-color: #000000;
            font-family: 'Inter', Helvetica, Arial, sans-serif;
            color: #ffffff;
        }

        .wrapper {
            width: 100%;
            table-layout: fixed;
            background-color: #000000;
            padding-bottom: 60px;
        }

        .main-card {
            max-width: 600px;
            margin: 40px auto;
            background-color: #080808;
            border: 1px solid #1a1a1a;
            overflow: hidden;
        }

        /* Línea de acento superior estilo Portal */
        .top-bar {
            height: 6px;
            background: linear-gradient(90deg, #ff6600, #cc5200);
        }

        .header {
            padding: 40px 20px;
            text-align: center;
            background-color: #000000;
        }

        .content {
            padding: 0 50px 50px 50px;
        }

        .welcome-text {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 24px;
            color: #ff6600;
            letter-spacing: 4px;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        .user-name {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 55px;
            line-height: 0.9;
            color: #ffffff;
            margin-bottom: 25px;
            text-transform: uppercase;
        }

        .divider {
            height: 1px;
            background: linear-gradient(90deg, rgba(255,102,0,0.5), transparent);
            margin-bottom: 30px;
        }

        .info-text {
            font-size: 15px;
            line-height: 1.6;
            color: #999999;
            margin-bottom: 35px;
        }

        /* Caja de Código Premium */
        .otp-box {
            background-color: #000000;
            border: 1px solid #ff6600;
            padding: 40px 20px;
            text-align: center;
            margin-bottom: 40px;
            position: relative;
        }

        .otp-label {
            font-size: 10px;
            font-weight: 900;
            color: #ff6600;
            letter-spacing: 5px;
            text-transform: uppercase;
            margin-bottom: 15px;
            display: block;
        }

        .otp-code {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 82px;
            color: #ffffff;
            letter-spacing: 15px;
            line-height: 1;
            margin-left: 15px;
        }

        /* Sección de Próximos Pasos - Estilo Industrial */
        .steps-container {
            background-color: rgba(255,255,255,0.03);
            padding: 25px;
            border-left: 3px solid #ff6600;
            text-align: left;
        }

        .step-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 18px;
            color: #ffffff;
            letter-spacing: 2px;
            margin-bottom: 10px;
            display: block;
        }

        .step-item {
            font-size: 12px;
            color: #666666;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 5px;
            display: block;
        }

        .footer {
            padding: 40px 20px;
            text-align: center;
            background-color: #000000;
            border-top: 1px solid #1a1a1a;
        }

        .footer-logo {
            height: 40px;
            margin-bottom: 20px;
            opacity: 0.8;
            filter: grayscale(1) brightness(2);
        }

        .footer-legal {
            font-size: 10px;
            color: #444444;
            letter-spacing: 2px;
            text-transform: uppercase;
            line-height: 1.8;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="main-card">
            <div class="top-bar"></div>
            
            <div class="header">
                <img src="{{ asset('resources/imagenes/logo.png') }}" alt="Logo" class="footer-logo">
            </div>

            <div class="content">
                <div class="welcome-text">HOLA, SOCIO(A)</div>
                <div class="user-name">{{ mb_strtoupper($user->name) }}</div>
                
                <div class="divider"></div>

                <p class="info-text">
                    Has iniciado el proceso de validación para la <strong>Convocatoria de Incentivos 2026</strong>. 
                    Para proteger tu información y asegurar tu identidad como socio activo, ingresa el siguiente código de seguridad en el portal:
                </p>

                <div class="otp-box">
                    <span class="otp-label">CÓDIGO DE ACCESO ÚNICO</span>
                    <div class="otp-code">{{ $codigo }}</div>
                </div>

                <div class="steps-container">
                    <span class="step-title">RECUERDA TENER LISTO:</span>
                    <span class="step-item">● Anexo 1: Manifestación de Interés</span>
                    <span class="step-item">● Anexo 2: Experiencia previa</span>
                    <span class="step-item">● Identificación digital (PDF)</span>
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