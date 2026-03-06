<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@400;700;900&display=swap');
        body { margin: 0; padding: 0; background-color: #000000; font-family: 'Inter', sans-serif; color: #ffffff; }
        .wrapper { width: 100%; background-color: #000000; padding-bottom: 60px; }
        .main-card { max-width: 600px; margin: 40px auto; background-color: #080808; border: 1px solid #1a1a1a; overflow: hidden; }
        .top-bar { height: 6px; background: linear-gradient(90deg, #ff6600, #cc5200); }
        .content { padding: 50px; text-align: center; }
        .welcome-text { font-family: 'Bebas Neue', sans-serif; font-size: 24px; color: #ff6600; letter-spacing: 4px; text-transform: uppercase; }
        .user-name { font-family: 'Bebas Neue', sans-serif; font-size: 50px; line-height: 0.9; color: #ffffff; margin: 15px 0 25px; text-transform: uppercase; }
        .divider { height: 1px; background: linear-gradient(90deg, rgba(255,102,0,0.5), transparent); margin-bottom: 30px; }
        .info-text { font-size: 15px; line-height: 1.6; color: #999; margin-bottom: 35px; }
        .radicado-box { background-color: #000; border: 1px solid #ff6600; padding: 30px; margin-bottom: 30px; }
        .status-label { font-size: 10px; font-weight: 900; color: #ff6600; letter-spacing: 3px; text-transform: uppercase; }
        .status-value { font-family: 'Bebas Neue', sans-serif; font-size: 35px; color: #fff; letter-spacing: 2px; }
        .footer-legal { font-size: 10px; color: #444; letter-spacing: 2px; text-transform: uppercase; padding: 20px; text-align: center; border-top: 1px solid #1a1a1a; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="main-card">
            <div class="top-bar"></div>
            <div class="content">
                <div class="welcome-text">ETAPA TÉCNICA RECIBIDA</div>
                <div class="user-name">{{ mb_strtoupper($proyecto->socio->name) }}</div>
                <div class="divider"></div>
                <p class="info-text">
                    Tu proyecto <span style="color: #fff; font-weight: bold;">"{{ mb_strtoupper($proyecto->titulo) }}"</span> ha ingresado exitosamente a la <strong>Fase de Revisión Técnica</strong>. 
                    <br><br>
                    Hemos recibido correctamente tu cronograma, presupuesto y la conformación del elenco.
                </p>
                <div class="radicado-box">
                    <div class="status-label">ESTADO ACTUAL DEL PROYECTO</div>
                    <div class="status-value">REVISIÓN DE COMITÉ</div>
                </div>
                <p style="font-size: 12px; color: #555;">Recibirás una notificación una vez el comité técnico emita su concepto.</p>
            </div>
            <div class="footer-legal">
                ACTORES S.C.G. | INCENTIVOS AUDIOVISUALES 2026
            </div>
        </div>
    </div>
</body>
</html>