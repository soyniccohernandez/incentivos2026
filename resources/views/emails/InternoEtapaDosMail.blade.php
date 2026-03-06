<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@400;700;900&display=swap');
        
        body { margin: 0; padding: 0; background-color: #f4f4f4; font-family: 'Inter', Arial, sans-serif; color: #333333; }
        .wrapper { width: 100%; table-layout: fixed; background-color: #f4f4f4; padding-bottom: 60px; }
        .main-card { max-width: 600px; margin: 20px auto; background-color: #ffffff; border: 1px solid #dddddd; overflow: hidden; }
        
        /* Estilo Industrial Header */
        .industrial-header {
            background-color: #ff6600; 
            padding: 40px 20px;
            text-align: center;
            border-bottom: 12px solid #000000;
        }
        
        .tag-tech {
            display: inline-block;
            background-color: #000000;
            color: #ff6600;
            font-family: monospace;
            font-size: 10px;
            padding: 4px 12px;
            letter-spacing: 3px;
            font-weight: bold;
            margin-bottom: 15px;
            text-transform: uppercase;
        }
        
        .font-bebas { font-family: 'Bebas Neue', Arial, sans-serif; }
        .main-title { 
            font-size: 45px; 
            line-height: 0.85; 
            color: #000000; 
            margin: 0; 
            text-transform: uppercase; 
            letter-spacing: -1px;
        }
        
        .radicado-badge {
            background: #000000;
            color: #ffffff;
            display: inline-block;
            padding: 5px 15px;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 22px;
            margin-top: 15px;
            letter-spacing: 1px;
        }

        .content { padding: 30px 40px; }
        .section-header { 
            font-family: 'Bebas Neue', sans-serif; font-size: 22px; color: #000000; 
            border-bottom: 2px solid #000000; margin: 25px 0 15px 0; padding-bottom: 3px;
        }

        /* Tablas de Info */
        table { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
        td { padding: 10px 0; border-bottom: 1px solid #f0f0f0; font-size: 14px; }
        .label { width: 35%; color: #888888; font-weight: 700; text-transform: uppercase; font-size: 10px; letter-spacing: 1px; }
        .value { width: 65%; color: #000000; font-weight: 500; }

        /* Tarjetas de Documentos Estilo Audit */
        .doc-item { 
            background-color: #f9f9f9; 
            border: 1px solid #eeeeee; 
            padding: 15px; 
            margin-bottom: 10px; 
            border-left: 4px solid #ff6600;
        }
        .doc-type-tag { font-size: 9px; color: #ff6600; font-weight: 900; margin-bottom: 4px; text-transform: uppercase; }
        .doc-name { font-family: monospace; font-size: 12px; color: #333; font-weight: bold; margin-bottom: 10px; word-break: break-all; }
        
        .btn-download {
            display: inline-block;
            background-color: #000000;
            color: #ffffff !important;
            padding: 6px 12px;
            text-decoration: none;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Estilo para Elenco */
        .actor-item {
            border: 1px solid #000;
            padding: 12px;
            margin-bottom: 8px;
            background-color: #ffffff;
        }
        .actor-name { font-weight: 900; color: #000; font-size: 15px; text-transform: uppercase; }
        .actor-meta { font-family: monospace; font-size: 11px; color: #666; margin-top: 4px; }

        .footer { padding: 30px; text-align: center; background-color: #000000; color: #ffffff; }
        .footer-legal { font-size: 9px; color: #666; text-transform: uppercase; letter-spacing: 2px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="main-card">
            
            <div class="industrial-header">
                <div class="tag-tech">AUDIT_LOG // REPORTE_TÉCNICO</div>
                <h1 class="font-bebas main-title">
                    ETAPA 02<br>
                    <span style="color: #ffffff;">COMPLETADA</span>
                </h1>
                <div class="radicado-badge">RADICADO: {{ $proyecto->codigo_radicado }}</div>
            </div>

            <div class="content">
                <div class="section-header">01. DATOS DEL PROYECTO</div>
                <table>
                    <tr>
                        <td class="label">Obra:</td>
                        <td class="value"><strong>"{{ mb_strtoupper($proyecto->titulo) }}"</strong></td>
                    </tr>
                    <tr>
                        <td class="label">Proponente:</td>
                        <td class="value">{{ mb_strtoupper($proyecto->socio->name) }}</td>
                    </tr>
                    <tr>
                        <td class="label">Fecha Reporte:</td>
                        <td class="value" style="font-family: monospace;">{{ now()->format('d/m/Y H:i:s') }}</td>
                    </tr>
                </table>

                <div class="section-header">02. EXPEDIENTE TÉCNICO (ETAPA 2)</div>
                @foreach($proyecto->documentos->whereIn('tipo_documento_id', [8, 9, 10, 11, 12]) as $doc)
                    <div class="doc-item">
                        <div class="doc-type-tag">
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
                        <a href="{{ url('storage/' . $doc->ruta_archivo) }}" target="_blank" class="btn-download">DESCARGAR PARA REVISIÓN</a>
                    </div>
                @endforeach

                <div class="section-header">03. ELENCO Y CARTAS DE INTENCIÓN</div>
                @foreach($proyecto->elenco as $actor)
                    <div class="actor-item">
                        <div class="actor-name">{{ mb_strtoupper($actor->name) }}</div>
                        <div class="actor-meta">
                            ID: {{ $actor->identificacion }} | 
                            DOC: {{ basename($actor->pivot->archivo_autorizacion_path) }}
                        </div>
                        <div style="margin-top: 10px;">
                            <a href="{{ url('storage/' . $actor->pivot->archivo_autorizacion_path) }}" target="_blank" class="btn-download" style="background-color: #ff6600; color: #000 !important; border: none;">
                                VER CARTA INTENCIÓN
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="footer">
                <div class="footer-legal">
                    ACTORES S.C.G. • BOGOTÁ, COLOMBIA • {{ date('Y') }}<br>
                    <span style="color: #ff6600;">SISTEMA DE GESTIÓN DE INCENTIVOS</span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>