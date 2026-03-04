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
            max-width: 700px;
            margin: 40px auto;
            background-color: #080808;
            border: 1px solid #1a1a1a;
            overflow: hidden;
        }

        .top-bar {
            height: 6px;
            background: linear-gradient(90deg, #ff6600, #cc5200);
        }

        .header {
            padding: 40px 30px;
            background-color: #000000;
            border-bottom: 1px solid #1a1a1a;
        }

        .content {
            padding: 40px;
        }

        .title-tag {
            color: #ff6600;
            font-weight: 900;
            font-size: 10px;
            letter-spacing: 3px;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .title-main {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 40px;
            line-height: 0.9;
            color: #ffffff;
            margin: 0;
            text-transform: uppercase;
        }

        .radicado-badge {
            display: inline-block;
            background-color: #ff6600;
            color: #000000;
            padding: 5px 15px;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 22px;
            margin-top: 15px;
            letter-spacing: 2px;
        }

        .section-header {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 20px;
            color: #ff6600;
            border-bottom: 1px solid #333;
            margin: 35px 0 20px 0;
            padding-bottom: 5px;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        td {
            padding: 12px 0;
            border-bottom: 1px solid #1a1a1a;
            vertical-align: top;
            font-size: 14px;
        }

        .label {
            width: 35%;
            color: #666666;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 10px;
            letter-spacing: 1px;
        }

        .value {
            width: 65%;
            color: #ffffff;
            font-weight: 400;
        }

        .value-highlight {
            color: #ff6600;
            font-weight: 700;
        }

        /* Estilo para los Documentos */
        .doc-card {
            background-color: #000000;
            border: 1px solid #222;
            padding: 20px;
            margin-bottom: 15px;
            border-left: 4px solid #ff6600;
        }

        .doc-type {
            font-size: 10px;
            font-weight: 900;
            color: #ff6600;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .doc-name {
            font-family: monospace;
            font-size: 13px;
            color: #999;
            margin-bottom: 15px;
            word-break: break-all;
        }

        .btn-action {
            display: inline-block;
            background-color: #ffffff;
            color: #000000 !important;
            padding: 8px 20px;
            text-decoration: none;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 16px;
            letter-spacing: 1px;
            text-transform: uppercase;
            font-weight: bold;
        }

        .footer {
            padding: 40px;
            text-align: center;
            background-color: #000000;
            border-top: 1px solid #1a1a1a;
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
                <div class="title-tag">SISTEMA INTERNO DE GESTIÓN</div>
                <h1 class="title-main">REPORTE TÉCNICO DE POSTULACIÓN</h1>
                <div class="radicado-badge">ID: {{ $proyecto->codigo_radicado }}</div>
                <div style="color: #444; font-size: 10px; margin-top: 15px; font-weight: 700; text-transform: uppercase;">
                    REGISTRADO: {{ now()->format('d/m/Y H:i:s') }}
                </div>
            </div>

            <div class="content">
                {{-- Sección 1: Proyecto --}}
                <div class="section-header">01. DETALLES DE LA OBRA</div>
                <table>
                    <tr>
                        <td class="label">Título:</td>
                        <td class="value"><span class="value-highlight" style="font-size: 18px;">"{{ mb_strtoupper($proyecto->titulo) }}"</span></td>
                    </tr>
                    <tr>
                        <td class="label">Autoría Guion:</td>
                        <td class="value">
                            @if($config['autoria'] === 'si')
                            <span style="color: #fff; background: #333; padding: 2px 8px; font-size: 10px; font-weight: 900;">AUTORÍA PROPIA</span>
                            @else
                            <span style="color: #ff6600; border: 1px solid #ff6600; padding: 2px 8px; font-size: 10px; font-weight: 900;">CESIÓN DE DERECHOS</span>
                            @endif
                        </td>
                    </tr>
                </table>

                {{-- Sección 2: Socio --}}
                <div class="section-header">02. PROPONE (SOCIO)</div>
                <table>
                    <tr>
                        <td class="label">Nombre:</td>
                        <td class="value">{{ mb_strtoupper($socio->name) }}</td>
                    </tr>
                    <tr>
                        <td class="label">ID:</td>
                        <td class="value">{{ $socio->identificacion }}</td>
                    </tr>
                    <tr>
                        <td class="label">Email:</td>
                        <td class="value-highlight">{{ $socio->email }}</td>
                    </tr>
                </table>

                {{-- Sección 3: Director --}}
                {{-- Sección 3: Director --}}
                <div class="section-header">03. DIRECCIÓN</div>
                <table>
                    @if($config['directorPropio'] === 'si')
                    <tr>
                        <td colspan="2" class="value" style="color: #999; font-style: italic;">* El proponente actúa como Director de la obra.</td>
                    </tr>
                    @else
                    @isset($director)
                    <tr>
                        <td class="label">Nombre:</td>
                        <td class="value">{{ mb_strtoupper($director->nombre ?? 'N/A') }}</td>
                    </tr>
                    <tr>
                        <td class="label">Email:</td>
                        <td class="value">{{ $director->correo ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="label">Celular:</td>
                        <td class="value">{{ $director->celular ?? 'N/A' }}</td>
                    </tr>
                    @else
                    <tr>
                        <td colspan="2" class="value" style="color: #ff6600;">Error: Datos del director no encontrados.</td>
                    </tr>
                    @endisset
                    @endif
                </table>

                {{-- Sección 4: Documentos --}}
                <div class="section-header">04. EXPEDIENTE DIGITAL</div>
                <p style="font-size: 12px; color: #555; margin-bottom: 25px; text-transform: uppercase; letter-spacing: 1px;">
                    Los siguientes archivos han sido validados y están disponibles para revisión en el servidor:
                </p>

                @foreach($proyecto->documentos as $doc)
                @if(!($doc->tipo_documento_id == 3 && $config['autoria'] === 'si'))
                @php
                $nombreTipo = match((int)$doc->tipo_documento_id) {
                1 => 'ANEXO 1: MANIFESTACIÓN DIRECTOR',
                2 => 'ANEXO 2: EXPERIENCIA DIRECTOR',
                3 => 'ANEXO 3: AUTORIZACIÓN GUION',
                4 => 'EVIDENCIAS 1',
                5 => 'EVIDENCIAS 2',
                6 => 'ANEXO 4: DECLARACIONES GENERALES',
                7 => 'CARTA INTENCIÓN',
                8 => 'GUION',
                9 => 'RADICADO DNDA',
                10 => 'PROPUESTA CREATIVA',
                11 => 'PRESUPUESTO',
                12 => 'CRONOGRAMA',
                default => 'DOCUMENTO ADJUNTO',
                };
                @endphp
                <div class="doc-card">
                    <div class="doc-type">{{ $nombreTipo }}</div>
                    <div class="doc-name">{{ basename($doc->ruta_archivo) }}</div>
                    <a href="{{ url('storage/' . $doc->ruta_archivo) }}" target="_blank" class="btn-action">
                        ABRIR DOCUMENTO
                    </a>
                </div>
                @endif
                @endforeach
            </div>

            <div class="footer">
                <div class="footer-legal">
                    ACTORES S.C.G. | SOCIEDAD COLOMBIANA DE GESTIÓN<br>
                    UNIDAD DE AUDITORÍA Y CONTROL DE INCENTIVOS 2026<br>
                    <span style="color: #222; margin-top: 15px; display: block;">ARCHIVO DIGITAL GENERADO AUTOMÁTICAMENTE</span>
                </div>
            </div>
        </div>
    </div>
</body>

</html>