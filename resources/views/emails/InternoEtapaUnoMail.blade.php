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
        
        .industrial-header {
            background-color: #ff6600; 
            padding: 40px 20px;
            text-align: center;
            border-bottom: 12px solid #000000;
            position: relative;
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
        
        .subtitle-mono {
            font-family: monospace;
            font-size: 10px;
            color: rgba(0,0,0,0.6);
            letter-spacing: 2px;
            margin-top: 10px;
            font-weight: bold;
        }

        .content { padding: 30px 40px; }
        .section-header { 
            font-family: 'Bebas Neue', sans-serif; font-size: 22px; color: #000000; 
            border-bottom: 2px solid #000000; margin: 25px 0 15px 0; padding-bottom: 3px;
        }

        table { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
        td { padding: 10px 0; border-bottom: 1px solid #f0f0f0; font-size: 14px; }
        .label { width: 35%; color: #888888; font-weight: 700; text-transform: uppercase; font-size: 10px; letter-spacing: 1px; }
        .value { width: 65%; color: #000000; font-weight: 500; }
        .value-highlight { color: #000000; font-weight: 900; font-size: 16px; }

        .doc-item { 
            background-color: #f9f9f9; 
            border: 1px solid #eeeeee; 
            padding: 12px; 
            margin-bottom: 8px; 
            border-left: 4px solid #ff6600;
        }
        .doc-name { font-family: monospace; font-size: 11px; color: #333; font-weight: bold; }

        .footer { padding: 30px; text-align: center; background-color: #000000; color: #ffffff; }
        .footer-legal { font-size: 9px; color: #666; text-transform: uppercase; letter-spacing: 2px; }
        
        .badge {
            padding: 2px 8px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .badge-black { background: #000; color: #ff6600; }
        .badge-outline { border: 1px solid #000; color: #000; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="main-card">
            
            <div class="industrial-header">
                <div class="tag-tech">AUDIT_LOG // REPORTE_SISTEMA</div>
                <h1 class="font-bebas main-title">
                    NUEVA<br>
                    <span style="color: #ffffff;">INSCRIPCIÓN</span>
                </h1>
                <div class="subtitle-mono">ID_PROYECTO: {{ $proyecto->codigo_radicado }}</div>
            </div>

            <div class="content">
                <div class="section-header">01. DATOS DE LA OBRA</div>
                <table>
                    <tr>
                        <td class="label">Título:</td>
                        <td class="value"><span class="value-highlight">"{{ mb_strtoupper($proyecto->titulo) }}"</span></td>
                    </tr>
                    <tr>
                        <td class="label">Radicado:</td>
                        <td class="value"><strong>{{ $proyecto->codigo_radicado }}</strong></td>
                    </tr>
                    <tr>
                        <td class="label">Modalidad Postulación:</td>
                        <td class="value">
                            @if(($config['autoria'] ?? '') === 'si')
                                <span class="badge badge-black">AUTORÍA PROPIA</span>
                            @else
                                <span class="badge badge-outline">CESIÓN DE DERECHOS</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="label">Origen del Guion (A3):</td>
                        <td class="value">
                            @if(($config['autoria'] ?? '') === 'si')
                                <strong style="color: #ff6600;">GUION PROPIO (DEL SOCIO)</strong>
                            @else
                                <strong style="color: #000;">GUION DE TERCERO (CONTRATO)</strong>
                            @endif
                        </td>
                    </tr>
                </table>

                <div class="section-header">02. PROPONE (SOCIO)</div>
                <table>
                    <tr>
                        <td class="label">Socio:</td>
                        <td class="value">{{ mb_strtoupper($socio->name ?? 'N/A') }}</td>
                    </tr>
                    <tr>
                        <td class="label">ID:</td>
                        <td class="value">{{ $socio->identificacion ?? 'N/A' }}</td>
                    </tr>
                </table>

                <div class="section-header">03. EQUIPO DIRECCIÓN</div>
                <table>
                    @if(($config['directorPropio'] ?? '') === 'si')
                        <tr>
                            <td colspan="2" class="value" style="color: #999; font-size: 12px; padding: 15px 0;">
                                <span style="color: #ff6600; font-weight: bold;">●</span> El socio proponente actúa como Director de la obra.
                            </td>
                        </tr>
                    @else
                        @if($director)
                            <tr>
                                <td class="label">Director Externo:</td>
                                <td class="value"><strong>{{ mb_strtoupper($director->nombre ?? $director->name ?? 'N/A') }}</strong></td>
                            </tr>
                            <tr>
                                <td class="label">ID Director:</td>
                                <td class="value">{{ $director->identificacion ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td class="label">Email Contacto:</td>
                                <td class="value" style="font-size: 12px; font-family: monospace;">{{ $director->correo ?? $director->email ?? 'N/A' }}</td>
                            </tr>
                        @else
                            <tr>
                                <td colspan="2" class="value" style="color: red; font-size: 11px; padding: 15px 0;">
                                    ⚠️ ATENCIÓN: No se detectaron datos de director externo en el registro.
                                </td>
                            </tr>
                        @endif
                    @endif
                </table>

                <div class="section-header">04. EXPEDIENTE DIGITAL</div>
                <div style="margin-top: 10px;">
                    @php $hasDocs = false; @endphp
                    @foreach($proyecto->documentos as $doc)
                        @if(!($doc->tipo_documento_id == 3 && ($config['autoria'] ?? '') === 'si'))
                            @php $hasDocs = true; @endphp
                            <div class="doc-item">
                                <div style="font-size: 9px; color: #ff6600; font-weight: 900; margin-bottom: 2px;">FILE_ATTACHED</div>
                                <div class="doc-name">{{ basename($doc->ruta_archivo) }}</div>
                            </div>
                        @endif
                    @endforeach
                    
                    @if(!$hasDocs)
                        <div style="font-size: 12px; color: #999;">No hay archivos adjuntos para mostrar.</div>
                    @endif

                    @if(($config['autoria'] ?? '') === 'si')
                         <div style="font-size: 10px; color: #999; font-style: italic; margin-top: 10px;">
                            * El Anexo 3 no se adjunta ni se visualiza por ser modalidad de Autoría Propia.
                         </div>
                    @endif
                </div>
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