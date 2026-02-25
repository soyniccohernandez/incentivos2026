<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@400;700&display=swap');
        body { background-color: #f4f4f4; color: #1a1a1a; font-family: 'Inter', Helvetica, Arial, sans-serif; margin: 0; padding: 20px; }
        .report-container { max-width: 800px; margin: auto; background: #ffffff; border: 1px solid #dddddd; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        .top-accent { height: 8px; background: #ff6600; }
        .header { padding: 30px; border-bottom: 2px solid #f0f0f0; background-color: #fafafa; }
        .title-main { font-family: 'Bebas Neue', sans-serif; font-size: 32px; color: #1a1a1a; margin: 0; letter-spacing: 1px; }
        .radicado-badge { display: inline-block; background-color: #ff6600; color: #ffffff; padding: 5px 15px; font-family: 'Bebas Neue', sans-serif; font-size: 20px; margin-top: 10px; }
        .content { padding: 30px; }
        .section-header { font-family: 'Bebas Neue', sans-serif; font-size: 18px; color: #ff6600; border-bottom: 1px solid #eeeeee; margin: 25px 0 15px 0; padding-bottom: 5px; letter-spacing: 1px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        td { padding: 12px; border-bottom: 1px solid #f9f9f9; vertical-align: top; font-size: 14px; }
        .label { width: 35%; color: #666666; font-weight: 700; text-transform: uppercase; font-size: 11px; }
        .value { width: 65%; color: #1a1a1a; }
        .status-pill { display: inline-block; padding: 2px 8px; border-radius: 4px; font-size: 10px; font-weight: bold; text-transform: uppercase; }
        .pill-orange { background: #fff5ed; color: #ff6600; border: 1px solid #ff6600; }
        .pill-dark { background: #1a1a1a; color: #ffffff; }
        .footer { background: #1a1a1a; color: #ffffff; padding: 20px; text-align: center; font-size: 10px; text-transform: uppercase; letter-spacing: 2px; }
    </style>
</head>
<body>
    <div class="report-container">
        <div class="top-accent"></div>
        <div class="header">
            <table style="border:none; margin:0;">
                <tr>
                    <td style="border:none; padding:0;">
                        <h1 class="title-main">REPORTE TÉCNICO DE POSTULACIÓN</h1>
                        <div class="radicado-badge">{{ $proyecto->codigo_radicado }}</div>
                    </td>
                    <td style="border:none; padding:0; text-align:right; color:#999; font-size:11px;">
                        FECHA DE REGISTRO:<br>
                        <strong>{{ now()->format('d/m/Y H:i:s') }}</strong>
                    </td>
                </tr>
            </table>
        </div>

        <div class="content">
            <div class="section-header">1. INFORMACIÓN DEL PROYECTO</div>
            <table>
                <tr>
                    <td class="label">Título de la Obra:</td>
                    <td class="value"><strong style="font-size: 16px;">{{ mb_strtoupper($proyecto->titulo) }}</strong></td>
                </tr>
                <tr>
                    <td class="label">Autoría del Guion:</td>
                    <td class="value">
                        @if($proyecto->guion_propio)
                            <span class="status-pill pill-dark">GUION DE AUTORÍA PROPIA</span>
                        @else
                            <span class="status-pill pill-orange">CESIÓN DE DERECHOS (ANEXO 3 ADJUNTO)</span>
                        @endif
                    </td>
                </tr>
            </table>

            <div class="section-header">2. PERFIL DEL PROPONENTE (SOCIO)</div>
            <table>
                <tr><td class="label">Nombre Completo:</td><td class="value">{{ mb_strtoupper($socio->name) }}</td></tr>
                <tr><td class="label">Identificación:</td><td class="value">{{ $socio->identificacion }}</td></tr>
                <tr><td class="label">Correo Electrónico:</td><td class="value" style="color:#ff6600;">{{ $socio->email }}</td></tr>
            </table>

            <div class="section-header">3. PERFIL DEL DIRECTOR</div>
            <table>
                <tr>
                    <td class="label">¿Es el mismo socio?</td>
                    <td class="value">
                        @if($director->es_proponente) 
                            <span class="status-pill pill-dark">SÍ, EL SOCIO ES EL DIRECTOR</span>
                        @else 
                            <span class="status-pill pill-orange">NO, DIRECTOR EXTERNO</span>
                        @endif
                    </td>
                </tr>
                {{-- Solo mostrar datos si el director es un tercero --}}
                @if(!$director->es_proponente)
                    <tr><td class="label">Nombre del Director:</td><td class="value">{{ mb_strtoupper($director->nombre) }}</td></tr>
                    <tr><td class="label">Identificación:</td><td class="value">{{ $director->identificacion }}</td></tr>
                    <tr><td class="label">Celular/Teléfono:</td><td class="value">{{ $director->celular }}</td></tr>
                    <tr><td class="label">Correo:</td><td class="value">{{ $director->correo }}</td></tr>
                @endif
            </table>

            <div class="section-header">4. LISTADO DE ARCHIVOS RECIBIDOS</div>
            <p style="font-size: 11px; color: #888; margin-bottom: 10px;">Los siguientes archivos han sido adjuntados físicamente a este correo:</p>
            <table>
                @foreach($documentos as $doc)
                <tr>
                    <td class="label" style="font-size: 9px;">ARCHIVO:</td>
                    <td class="value" style="font-family: monospace; font-size: 12px;">● {{ basename($doc->ruta_archivo) }}</td>
                </tr>
                @endforeach
            </table>
        </div>

        <div class="footer">
            ACTORES S.C.G. | SISTEMA INTERNO DE GESTIÓN DE INCENTIVOS 2026<br>
            <span style="font-size: 8px; opacity: 0.6;">ESTE CORREO ES UNA NOTIFICACIÓN AUTOMÁTICA DEL SISTEMA</span>
        </div>
    </div>
</body>
</html>