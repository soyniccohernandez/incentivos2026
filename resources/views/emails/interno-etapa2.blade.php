<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@400;700;900&display=swap');
        body { margin: 0; padding: 0; background-color: #000000; font-family: 'Inter', sans-serif; color: #ffffff; }
        .wrapper { width: 100%; background-color: #000000; padding-bottom: 60px; }
        .main-card { max-width: 700px; margin: 40px auto; background-color: #080808; border: 1px solid #1a1a1a; }
        .top-bar { height: 6px; background: linear-gradient(90deg, #ff6600, #cc5200); }
        .header { padding: 40px; background-color: #000; border-bottom: 1px solid #1a1a1a; }
        .content { padding: 40px; }
        
        .title-tag { color: #ff6600; font-weight: 900; font-size: 10px; letter-spacing: 3px; text-transform: uppercase; margin-bottom: 10px; }
        .title-main { font-family: 'Bebas Neue', sans-serif; font-size: 40px; line-height: 0.9; color: #ffffff; margin: 0; text-transform: uppercase; }
        
        .section-header { font-family: 'Bebas Neue', sans-serif; font-size: 20px; color: #ff6600; border-bottom: 1px solid #333; margin: 35px 0 20px 0; padding-bottom: 5px; letter-spacing: 2px; }

        /* Tarjetas de Documentos */
        .doc-card { background-color: #000; border: 1px solid #222; padding: 20px; margin-bottom: 15px; border-left: 4px solid #ff6600; }
        .doc-type { font-size: 10px; font-weight: 900; color: #ff6600; letter-spacing: 2px; text-transform: uppercase; margin-bottom: 8px; }
        .doc-name { font-family: monospace; font-size: 13px; color: #999; margin-bottom: 15px; word-break: break-all; }
        
        .btn-action { display: inline-block; background-color: #ffffff; color: #000000 !important; padding: 8px 20px; text-decoration: none; font-family: 'Bebas Neue', sans-serif; font-size: 16px; letter-spacing: 1px; text-transform: uppercase; font-weight: bold; }

        /* Tabla de Información */
        table { width: 100%; border-collapse: collapse; }
        td { padding: 12px 0; border-bottom: 1px solid #1a1a1a; font-size: 14px; color: #eee; }
        .label { color: #666; font-weight: 700; text-transform: uppercase; font-size: 10px; width: 30%; }

        .footer { padding: 40px; text-align: center; background-color: #000; border-top: 1px solid #1a1a1a; color: #444; font-size: 10px; letter-spacing: 2px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="main-card">
            <div class="top-bar"></div>
            <div class="header">
                <div class="title-tag">SISTEMA INTERNO DE AUDITORÍA</div>
                <h1 class="title-main">REPORTE TÉCNICO - ETAPA 2</h1>
                <div style="background: #ff6600; color: #000; display: inline-block; padding: 5px 15px; font-family: 'Bebas Neue'; font-size: 22px; margin-top: 15px;">
                    RADICADO: {{ $proyecto->codigo_radicado }}
                </div>
            </div>

            <div class="content">
                <div class="section-header">01. DATOS DEL PROYECTO</div>
                <table>
                    <tr>
                        <td class="label">Obra:</td>
                        <td style="color: #fff; font-weight: bold;">"{{ mb_strtoupper($proyecto->titulo) }}"</td>
                    </tr>
                    <tr>
                        <td class="label">Proponente:</td>
                        <td>{{ mb_strtoupper($proyecto->socio->name) }}</td>
                    </tr>
                    <tr>
                        <td class="label">Fecha Carga:</td>
                        <td>{{ now()->format('d/m/Y H:i:s') }}</td>
                    </tr>
                </table>

                <div class="section-header">02. EXPEDIENTE TÉCNICO (ETAPA 2)</div>
                @foreach($proyecto->documentos->whereIn('tipo_documento_id', [8, 9, 10, 11, 12]) as $doc)
                    <div class="doc-card">
                        <div class="doc-type">
                            {{ match((int)$doc->tipo_documento_id) { 
                                8 => 'GUION FINAL', 
                                9 => 'RADICADO DNDA', 
                                10 => 'PROPUESTA CREATIVA', 
                                11 => 'PRESUPUESTO', 
                                12 => 'CRONOGRAMA', 
                                default => 'DOCUMENTO TÉCNICO' 
                            } }}
                        </div>
                        <div class="doc-name">{{ basename($doc->ruta_archivo) }}</div>
                        <a href="{{ url('storage/' . $doc->ruta_archivo) }}" target="_blank" class="btn-action">DESCARGAR PARA REVISIÓN</a>
                    </div>
                @endforeach

                <div class="section-header">03. ELENCO Y CARTAS DE INTENCIÓN</div>
                @foreach($proyecto->elenco as $actor)
                    <div class="doc-card" style="border-left-color: #ffffff;">
                        <div class="doc-type" style="color: #ffffff;">ACTOR / ACTRIZ</div>
                        <div style="color: #fff; font-size: 16px; font-weight: bold; margin-bottom: 5px;">{{ mb_strtoupper($actor->name) }}</div>
                        <div class="doc-name">CC: {{ $actor->identificacion }} | ARCHIVO: {{ basename($actor->pivot->archivo_autorizacion_path) }}</div>
                        <a href="{{ url('storage/' . $actor->pivot->archivo_autorizacion_path) }}" target="_blank" class="btn-action" style="background-color: #ff6600; color: #000 !important;">VER CARTA INTENCIÓN</a>
                    </div>
                @endforeach
            </div>

            <div class="footer">
                ACTORES S.C.G. | SOCIEDAD COLOMBIANA DE GESTIÓN<br>
                ESTE REPORTE CONTIENE INFORMACIÓN PRIVADA Y TÉCNICA
            </div>
        </div>
    </div>
</body>
</html>