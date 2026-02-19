<!DOCTYPE html>
<html lang="es" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incentivos 2026 | ACTORES S.C.G.</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat:wght@300;400;600;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .hero-bg {
            background-image: url('{{ asset("resources/imagenes/hero.jpg") }}');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>

<body class="bg-black text-white font-montserrat antialiased leading-relaxed">

    {{-- Modal de Éxito --}}
    @if (session()->has('success'))
    <div id="success-modal" x-data="{ show: true }"
        x-show="show"
        class="fixed inset-0 z-[3000] flex items-center justify-center p-4">

        {{-- Overlay --}}
        <div class="fixed inset-0 bg-black/95 backdrop-blur-sm" @click="show = false; document.getElementById('success-modal').style.display='none'"></div>

        {{-- Contenedor del Modal --}}
        <div class="relative bg-[#111] border-2 border-[#ff6600] max-w-2xl w-full shadow-[0_0_50px_rgba(255,102,0,0.3)] z-[3001]"
            x-show="show"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-90"
            x-transition:enter-end="opacity-100 scale-100">

            <div class="p-8 md:p-12 text-center relative">
                {{-- Icono Check --}}
                <div class="mx-auto w-20 h-20 bg-[#ff6600] flex items-center justify-center rounded-full mb-8">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>

                <h2 class="font-bebas text-5xl md:text-6xl text-white tracking-wider mb-6">
                    ¡INSCRIPCIÓN <span class="text-[#ff6600]">EXITOSA!</span>
                </h2>

                <p class="text-gray-300 text-lg mb-6 italic">
                    {{ session('success') }}
                </p>

                {{-- CAJA DE RADICADO DESTACADA --}}
                <div class="bg-[#0a0a0a] border border-[#222] p-6 mb-10 inline-block w-full max-w-sm">
                    <span class="text-gray-500 text-[10px] uppercase tracking-[3px] block mb-2 font-bold">Número de Radicado Oficial</span>
                    <span class="text-[#ff6600] font-bebas text-5xl tracking-[4px] block">
                        {{ session('radicado') }}
                    </span>
                </div>

                <div class="flex flex-col items-center gap-4">
                    <button onclick="document.getElementById('success-modal').style.display='none'"
                        @click="show = false"
                        class="w-full md:w-auto bg-[#ff6600] text-white font-bebas text-2xl px-12 py-4 hover:bg-white hover:text-black transition-all duration-300 tracking-widest">
                        ENTENDIDO Y FINALIZAR
                    </button>

                    <button onclick="document.getElementById('success-modal').style.display='none'"
                        @click="show = false"
                        class="text-gray-500 hover:text-white text-[10px] uppercase font-bold tracking-[3px] cursor-pointer mt-4">
                        [ CERRAR VENTANA ]
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- Navegación --}}
    <nav class="fixed top-0 left-0 w-full z-[1000] flex justify-between items-center px-6 py-5 md:px-12 bg-black/95 border-b border-brand-border">
        <a href="#" class="font-bebas text-3xl text-brand-orange tracking-[2px] no-underline">ACTORES S.C.G.</a>

        <div class="flex flex-col gap-[6px] cursor-pointer md:hidden z-[1100]" id="mobile-menu">
            <span class="w-[30px] h-[3px] bg-white transition-all duration-300"></span>
            <span class="w-[30px] h-[3px] bg-white transition-all duration-300"></span>
            <span class="w-[30px] h-[3px] bg-white transition-all duration-300"></span>
        </div>

        <ul class="nav-links fixed md:static top-0 -right-full md:right-0 w-full md:w-auto h-screen md:h-auto bg-brand-orange md:bg-transparent flex flex-col md:flex-row justify-center md:justify-end items-center gap-8 md:gap-[30px] transition-all duration-500 z-[1000] list-none">
            <li><a href="#" class="no-underline text-white font-bebas text-[2.5rem] md:text-xl tracking-[1.5px] opacity-100 md:opacity-80 hover:md:text-brand-orange hover:opacity-100 transition-all">INICIO</a></li>
            <li><a href="#convocatoria" class="no-underline text-white font-bebas text-[2.5rem] md:text-xl tracking-[1.5px] opacity-100 md:opacity-80 hover:md:text-brand-orange hover:opacity-100 transition-all">REQUISITOS</a></li>
            <li><a href="#cronograma" class="no-underline text-white font-bebas text-[2.5rem] md:text-xl tracking-[1.5px] opacity-100 md:opacity-80 hover:md:text-brand-orange hover:opacity-100 transition-all">CRONOGRAMA</a></li>
            <li><a href="#pasos" class="no-underline text-white font-bebas text-[2.5rem] md:text-xl tracking-[1.5px] opacity-100 md:opacity-80 hover:md:text-brand-orange hover:opacity-100 transition-all">INSCRIPCIÓN</a></li>
            <li><a href="{{ route('inscritos.publico') }}" class="no-underline text-white font-bebas text-[2.5rem] md:text-xl tracking-[1.5px] opacity-100 md:opacity-80 hover:md:text-brand-orange hover:opacity-100 transition-all">VER INSCRITOS</a></li>
        </ul>
    </nav>

    {{-- Hero Section --}}
    <div class="hero-bg relative h-[85vh] w-full flex items-center justify-center text-center overflow-hidden bg-black">
        <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/60 to-black z-[2]"></div>
        <div class="relative z-[3] max-w-[1000px] px-6 drop-shadow-[0_4px_15px_rgba(0,0,0,0.5)]">
            <div class="flex flex-col items-center gap-[15px] mb-[30px] opacity-90">
                <img src="{{ asset('resources/imagenes/logo.png') }}" alt="Logo" class="h-[80px] w-auto invert brightness-0 mb-5">
                <span class="text-[0.75rem] font-normal tracking-[5px] text-white uppercase relative pb-2.5 after:content-[''] after:absolute after:bottom-0 after:left-1/4 after:w-1/2 after:h-[1px] after:bg-gradient-to-r after:from-transparent after:via-brand-orange after:to-transparent">
                    SOCIEDAD COLOMBIANA DE GESTIÓN
                </span>
            </div>
            <p class="tracking-[5px] font-semibold text-[#BBBBBB] mb-5 uppercase">CONVOCATORIA 2026</p>
            <h1 class="font-bebas text-[clamp(3rem,10vw,6.5rem)] leading-[0.9] mb-5">
                INCENTIVOS PARA <br> <span class="text-brand-orange">CREACIÓN AUDIOVISUAL</span>
            </h1>
            <p class="text-[1.2rem] max-w-[700px] mx-auto mb-[30px] text-[#EEEEEE]">
                Transformamos tu guion en una realidad profesional. <br>
                <strong class="text-white">$40.000.000 COP</strong> para tu cortometraje.
            </p>
            {{-- EL BOTÓN SIGUIENTE AHORA APUNTA CORRECTAMENTE A #PASOS --}}
            <a href="#pasos" class="inline-block bg-brand-orange text-white px-[45px] py-[18px] no-underline font-bebas text-[1.6rem] transition-all duration-300 hover:bg-[#ff6a33] hover:-translate-y-[3px] hover:shadow-[0_10px_20px_rgba(232,82,27,0.3)]">
                POSTULAR MI PROYECTO
            </a>
        </div>
    </div>

    {{-- Términos y Condiciones - Versión Invertida Impactante --}}
    <div class="bg-brand-orange py-24 px-6 text-center relative overflow-hidden">

        {{-- Elemento decorativo sutil de fondo (Opcional) --}}
        <div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none flex items-center justify-center">
            <span class="font-bebas text-[20rem] text-black select-none">2026</span>
        </div>

        <div class="relative z-10 max-w-4xl mx-auto">
            {{-- Icono superior para dar contexto --}}
            <div class="mb-6 inline-flex items-center justify-center w-16 h-16 bg-black rounded-full shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-brand-orange" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
            </div>

            <h2 class="font-bebas text-[4rem] md:text-[5rem] text-black mb-4 leading-none tracking-tighter">
                ¿LISTO PARA POSTULARTE?
            </h2>

            <p class="mb-10 text-black/80 font-bold uppercase tracking-[2px] text-sm max-w-xl mx-auto leading-relaxed">
                Es obligatorio descargar y leer los términos de referencia. <br class="hidden md:block">
                <span class="bg-black text-brand-orange px-2 py-1 italic">El desconocimiento de las bases no exime su cumplimiento.</span>
            </p>

            <a href="#" class="inline-flex items-center gap-3 bg-black text-white px-12 py-5 no-underline font-bebas text-[1.6rem] tracking-widest transition-all duration-300 hover:bg-white hover:text-black hover:shadow-[0_10px_30px_rgba(0,0,0,0.3)] transform hover:-translate-y-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                </svg>
                DESCARGAR TÉRMINOS (PDF)
            </a>

            <div class="mt-8 text-[10px] text-black/60 font-black uppercase tracking-[4px]">
                Actualizado a Febrero 2026
            </div>
        </div>
    </div>

    {{-- Contenido Principal --}}
    <div class="max-w-[1100px] mx-auto px-6 py-24">
        {{-- Convocatoria --}}
        <section id="convocatoria" class="mb-[120px] scroll-mt-[100px]">
            <h2 class="font-bebas text-[3.5rem] text-brand-orange mb-10 border-b border-brand-border inline-block pb-[5px]">LA CONVOCATORIA</h2>
            <p class="text-[1.2rem] text-[#BBBBBB] mb-10 max-w-[850px]">
                A partir del <strong class="text-white">1 de abril</strong> regresa una de las iniciativas más exitosas del área de Bienestar Social. Buscamos historias que respeten valores como la equidad, la diversidad y el respeto.
            </p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-[25px]">
                <div class="bg-brand-surface p-10 border-l-4 border-brand-orange transition-all duration-300 hover:bg-[#151515]">
                    <h3 class="font-bebas text-[2rem] mb-[15px]">EL PREMIO</h3>
                    <p>¡3 seleccionados! Cada uno recibirá <strong>$40.000.000 COP</strong> para la ejecución total de su obra.</p>
                </div>
                <div class="bg-brand-surface p-10 border-l-4 border-brand-orange transition-all duration-300 hover:bg-[#151515]">
                    <h3 class="font-bebas text-[2rem] mb-[15px]">MODALIDAD</h3>
                    <p><strong>Cortometraje</strong> de ficción (Relatos imaginarios o basados en la vida real) de 7 a 15 min.</p>
                </div>
                <div class="bg-brand-surface p-10 border-l-4 border-brand-orange transition-all duration-300 hover:bg-[#151515]">
                    <h3 class="font-bebas text-[2rem] mb-[15px]">REQUISITOS</h3>
                    <p>Ser <strong>socio activo</strong>, mayor de edad y contar con datos actualizados en la sociedad.</p>
                </div>
            </div>
        </section>

        {{-- Cronograma Estilo Timeline Industrial --}}
        <section id="cronograma" class="mb-[120px] scroll-mt-[100px] px-4">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-4">
                <div>
                    <h2 class="font-bebas text-[4rem] text-brand-orange leading-none uppercase">Ruta de Convocatoria</h2>
                    <p class="text-gray-500 font-bold tracking-[3px] uppercase text-xs mt-2">Hitos y fechas clave 2026</p>
                </div>
                <div class="bg-brand-orange/10 border border-brand-orange/30 p-3">
                    <span class="text-brand-orange font-bebas text-2xl tracking-tighter italic">92 DÍAS DE PRODUCCIÓN FINAL</span>
                </div>
            </div>

            <div class="relative">
                {{-- Línea Central (Solo visible en Desktop) --}}
                <div class="hidden md:block absolute left-1/2 transform -translate-x-1/2 h-full w-[2px] bg-gradient-to-b from-brand-orange via-brand-border to-transparent"></div>

                {{-- Contenedor de Hitos --}}
                <div class="space-y-12">

                    {{-- HITO 1: PREPARACIÓN --}}
                    <div class="relative flex flex-col md:flex-row items-center group">
                        <div class="flex-1 md:text-right md:pr-12 w-full">
                            <div class="inline-block">
                                <span class="text-brand-orange font-bebas text-xl tracking-widest uppercase">Fase Inicial</span>
                                <h3 class="text-white font-bebas text-3xl mt-1">Expectativa y Condiciones</h3>
                                <p class="text-gray-500 text-sm max-w-[400px] md:ml-auto">Lanzamiento oficial y envío de términos de referencia por correo electrónico.</p>
                            </div>
                        </div>
                        {{-- Punto en la línea --}}
                        <div class="hidden md:flex absolute left-1/2 transform -translate-x-1/2 w-10 h-10 bg-[#0a0a0a] border-2 border-brand-border rounded-full items-center justify-center z-10 group-hover:border-brand-orange transition-colors">
                            <div class="w-2 h-2 bg-brand-orange rounded-full"></div>
                        </div>
                        <div class="flex-1 md:pl-12 w-full mt-4 md:mt-0">
                            <div class="bg-brand-surface p-4 border-l-4 border-brand-orange inline-block">
                                <span class="text-white font-mono font-bold tracking-tighter uppercase">23 Feb — 08 Mar</span>
                            </div>
                        </div>
                    </div>

                    {{-- HITO 2: INSCRIPCIONES (HIGHLIGHT) --}}
                    <div class="relative flex flex-col md:flex-row items-center group">
                        <div class="flex-1 md:text-right md:pr-12 w-full order-2 md:order-1 mt-4 md:mt-0">
                            <div class="bg-brand-orange p-6 shadow-[0_0_30px_rgba(255,102,0,0.2)]">
                                <span class="text-black font-mono font-black text-lg">09 — 23 MARZO</span>
                            </div>
                        </div>
                        <div class="hidden md:flex absolute left-1/2 transform -translate-x-1/2 w-12 h-12 bg-brand-orange rounded-full items-center justify-center z-10 animate-pulse">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor font-bold">
                                <path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" stroke-width="3" />
                            </svg>
                        </div>
                        <div class="flex-1 md:pl-12 w-full order-1 md:order-2">
                            <h3 class="text-brand-orange font-bebas text-4xl uppercase leading-none">Inscripciones Abiertas</h3>
                            <p class="text-gray-300 font-bold text-xs uppercase tracking-widest mt-2 italic">Apertura del portal de carga (Etapa 1)</p>
                        </div>
                    </div>

                    {{-- HITO 3: FORMACIÓN Y REVISIÓN --}}
                    <div class="relative flex flex-col md:flex-row items-center group">
                        <div class="flex-1 md:text-right md:pr-12 w-full">
                            <h3 class="text-white font-bebas text-3xl">Taller & Validación</h3>
                            <p class="text-gray-500 text-sm md:ml-auto">Taller de formación para proponentes y revisión documental detallada de la Etapa 1.</p>
                        </div>
                        <div class="hidden md:flex absolute left-1/2 transform -translate-x-1/2 w-10 h-10 bg-[#0a0a0a] border-2 border-brand-border rounded-full items-center justify-center z-10">
                            <div class="w-2 h-2 bg-gray-600"></div>
                        </div>
                        <div class="flex-1 md:pl-12 w-full mt-4 md:mt-0">
                            <div class="bg-brand-surface p-4 border-l-4 border-gray-600">
                                <span class="text-white font-mono font-bold uppercase">06 Abr — 14 Abr</span>
                            </div>
                        </div>
                    </div>

                    {{-- HITO 4: SUBSANACIONES --}}
                    <div class="relative flex flex-col md:flex-row items-center group">
                        <div class="flex-1 md:text-right md:pr-12 w-full order-2 md:order-1 mt-4 md:mt-0">
                            <div class="bg-[#1a1a1a] p-4 border border-white/10">
                                <span class="text-brand-orange font-mono font-bold uppercase">15 Abr — 08 Mayo</span>
                                <p class="text-[10px] text-gray-500 mt-1 uppercase font-bold tracking-widest">Incluye revisión de correcciones</p>
                            </div>
                        </div>
                        <div class="hidden md:flex absolute left-1/2 transform -translate-x-1/2 w-10 h-10 bg-[#0a0a0a] border-2 border-brand-border rounded-full items-center justify-center z-10">
                            <div class="w-2 h-2 bg-white"></div>
                        </div>
                        <div class="flex-1 md:pl-12 w-full order-1 md:order-2">
                            <h3 class="text-white font-bebas text-3xl">Subsanaciones</h3>
                            <p class="text-gray-500 text-sm italic">Plazo único para que el socio corrija documentos técnicos y legales.</p>
                        </div>
                    </div>

                    {{-- HITO 5: ETAPA 2 --}}
                    <div class="relative flex flex-col md:flex-row items-center group">
                        <div class="flex-1 md:text-right md:pr-12 w-full">
                            <h3 class="text-white font-bebas text-3xl uppercase italic">Etapa 2: Guiones</h3>
                            <p class="text-gray-500 text-sm md:ml-auto uppercase tracking-tighter font-bold">Recepción de documentos técnicos y guionización.</p>
                        </div>
                        <div class="hidden md:flex absolute left-1/2 transform -translate-x-1/2 w-10 h-10 bg-white border-2 border-brand-orange rounded-full items-center justify-center z-10 shadow-[0_0_15px_rgba(255,255,255,0.3)]">
                            <div class="w-2 h-2 bg-brand-orange"></div>
                        </div>
                        <div class="flex-1 md:pl-12 w-full mt-4 md:mt-0">
                            <div class="bg-white p-4">
                                <span class="text-black font-mono font-black uppercase text-xl italic leading-none">11 — 13 Mayo</span>
                            </div>
                        </div>
                    </div>

                    {{-- HITO 6: JURADOS --}}
                    <div class="relative flex flex-col md:flex-row items-center group">
                        <div class="flex-1 md:text-right md:pr-12 w-full order-2 md:order-1 mt-4 md:mt-0">
                            <div class="bg-brand-surface p-4 border border-brand-border">
                                <span class="text-white font-mono font-bold uppercase tracking-widest">04 Jun — 26 Jun</span>
                            </div>
                        </div>
                        <div class="hidden md:flex absolute left-1/2 transform -translate-x-1/2 w-10 h-10 bg-[#0a0a0a] border-2 border-brand-border rounded-full items-center justify-center z-10 group-hover:border-white transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2" />
                            </svg>
                        </div>
                        <div class="flex-1 md:pl-12 w-full order-1 md:order-2">
                            <h3 class="text-white font-bebas text-3xl">Evaluación Expertos</h3>
                            <p class="text-gray-500 text-sm">Cruce con jurados internacionales y selección de obras ganadoras.</p>
                        </div>
                    </div>

                    {{-- HITO FINAL: SELECCIONADOS --}}
                    <div class="relative flex flex-col md:flex-row items-center">
                        <div class="flex-1 md:text-right md:pr-12 w-full hidden md:block">
                            <p class="text-brand-orange font-bebas text-2xl animate-pulse tracking-widest uppercase">¡Éxito!</p>
                        </div>
                        <div class="hidden md:flex absolute left-1/2 transform -translate-x-1/2 w-14 h-14 bg-brand-orange rounded-full items-center justify-center z-20 ring-8 ring-brand-orange/20 shadow-[0_0_40px_rgba(255,102,0,0.4)]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-black" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                            </svg>
                        </div>
                        <div class="flex-1 md:pl-12 w-full text-center md:text-left">
                            <div class="bg-brand-orange inline-block px-8 py-4 transform hover:scale-105 transition-transform cursor-default">
                                <span class="text-black font-black uppercase text-[10px] tracking-[4px] block mb-1">Anuncio Oficial</span>
                                <h3 class="text-black font-bebas text-5xl leading-none">30 JUNIO</h3>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>


        {{-- Sección de Etapas, Anexos y Ganadores --}}
        <section id="anexos" class="mb-[120px] scroll-mt-[100px]">
            <h2 class="font-bebas text-[3.5rem] text-brand-orange mb-10 border-b border-brand-border inline-block pb-[5px]">ETAPAS Y DOCUMENTACIÓN</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

                {{-- ETAPA 1: INSCRIPCIÓN (ACTIVA / COLOR) --}}
                <div class="bg-[#111] border-2 border-brand-orange p-6 flex flex-col h-full shadow-[0_0_20px_rgba(255,102,0,0.1)] relative">
                    <div class="absolute -top-3 left-6 bg-brand-orange text-white font-bebas px-3 py-1 text-sm tracking-widest">ACTUALMENTE</div>
                    <div class="mb-6">
                        <span class="text-brand-orange font-bebas text-xl tracking-[3px]">ETAPA 01</span>
                        <h3 class="font-bebas text-4xl text-white">INSCRIPCIÓN</h3>
                        <p class="text-gray-400 text-xs mt-2 uppercase font-bold tracking-tighter italic">Habilitantes Obligatorios</p>
                    </div>

                    <div class="space-y-3 mb-8 flex-grow">
                        {{-- Anexo 1 --}}
                        <a href="#" class="p-3 bg-brand-surface border border-brand-orange/30 flex justify-between items-center group hover:bg-brand-orange transition-all">
                            <span class="text-[10px] font-bold text-white uppercase">Anexo 1. Manifestación</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-brand-orange group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" stroke-width="2.5" />
                            </svg>
                        </a>

                        {{-- Anexo 2 - DESGLOSADO POR ARCHIVOS --}}
                        <div class="bg-brand-surface border border-brand-orange/30 p-3">
                            <div class="flex justify-between items-center mb-3">
                                <span class="text-[10px] font-bold text-white uppercase">Anexo 2. Experiencia</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-brand-orange" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" stroke-width="2" />
                                </svg>
                            </div>
                            <div class="flex flex-col gap-1.5">
                                <a href="#" class="flex items-center justify-between bg-black/40 p-2 border border-white/5 hover:border-brand-orange transition-all group">
                                    <span class="text-[8px] text-gray-400 uppercase font-bold group-hover:text-white">Formato de Experiencia</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-brand-orange" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" stroke-width="2" />
                                    </svg>
                                </a>
                                <div class="grid grid-cols-2 gap-1">
                                    <a href="#" class="flex flex-col items-center justify-center bg-black/40 py-2 border border-white/5 hover:border-brand-orange transition-all group">
                                        <span class="text-[7px] text-gray-500 font-black uppercase tracking-tighter">Soporte 1</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-gray-600 group-hover:text-brand-orange mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" stroke-width="2" />
                                        </svg>
                                    </a>
                                    <a href="#" class="flex flex-col items-center justify-center bg-black/40 py-2 border border-white/5 hover:border-brand-orange transition-all group">
                                        <span class="text-[7px] text-gray-500 font-black uppercase tracking-tighter">Soporte 2</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-gray-600 group-hover:text-brand-orange mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" stroke-width="2" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>

                        {{-- Anexo 3 - Con Aviso --}}
                        <div class="relative group">
                            <a href="#" class="p-3 bg-brand-orange/10 border border-brand-orange flex justify-between items-center group-hover:bg-brand-orange transition-all">
                                <span class="text-[10px] font-bold text-brand-orange group-hover:text-white uppercase">Anexo 3. Uso Guion</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 group-hover:text-white text-brand-orange" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" stroke-width="2.5" />
                                </svg>
                            </a>
                            {{-- Toast/Tooltip --}}
                            <div class="absolute -top-12 left-0 w-full bg-white text-black p-2 text-[8px] font-bold uppercase leading-tight shadow-xl opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none border-l-4 border-brand-orange z-10">
                                Opcional: Solo si el guion es de autoría de un tercero.
                            </div>
                        </div>

                        {{-- Anexo 4 --}}
                        <a href="#" class="p-3 bg-brand-surface border border-brand-orange/30 flex justify-between items-center group hover:bg-brand-orange transition-all">
                            <span class="text-[10px] font-bold text-white uppercase">Anexo 4. Declaraciones</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-brand-orange group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" stroke-width="2.5" />
                            </svg>
                        </a>
                    </div>

                    <a href="#" class="w-full bg-brand-orange text-white font-bebas py-3 text-center tracking-widest hover:bg-white hover:text-black transition-all">
                        DESCARGAR KIT ETAPA 1
                    </a>
                </div>

                {{-- ETAPA 2: DESARROLLO (GRIS) --}}
                <div class="bg-[#0a0a0a] border border-[#222] p-6 flex flex-col h-full opacity-60 hover:opacity-100 transition-opacity">
                    <div class="mb-6 text-gray-500">
                        <span class="font-bebas text-xl tracking-[3px]">ETAPA 02</span>
                        <h3 class="font-bebas text-4xl uppercase">Desarrollo</h3>
                        <p class="text-[10px] mt-2 font-bold uppercase italic tracking-tighter">Preparación técnica</p>
                    </div>

                    <div class="space-y-2 mb-8 flex-grow">
                        <div class="p-3 border border-[#222] flex justify-between items-center group">
                            <span class="text-[10px] font-bold text-gray-600 uppercase">Anexo 6. Propuesta</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" stroke-width="2" />
                            </svg>
                        </div>
                        <div class="p-3 border border-[#222] flex justify-between items-center group">
                            <span class="text-[10px] font-bold text-gray-600 uppercase">Anexo 7. Presupuesto</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" stroke-width="2" />
                            </svg>
                        </div>
                        <div class="p-3 border border-[#222] flex justify-between items-center group">
                            <span class="text-[10px] font-bold text-gray-600 uppercase">Anexo 8. Cronograma</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" stroke-width="2" />
                            </svg>
                        </div>
                    </div>
                    <a href="#" class="w-full border border-gray-800 text-gray-600 font-bebas py-2 text-center text-sm tracking-[2px] uppercase transition-all hover:border-gray-600 hover:text-gray-400">
                        Kit Etapa 2
                    </a>
                </div>

                {{-- ETAPA 3: EVALUACIÓN --}}
                <div class="bg-[#0a0a0a] border border-[#222] p-6 flex flex-col h-full opacity-40">
                    <div class="mb-6 text-gray-700">
                        <span class="font-bebas text-xl tracking-[3px]">ETAPA 03</span>
                        <h3 class="font-bebas text-4xl uppercase">Jurados</h3>
                        <p class="text-[10px] mt-2 font-bold uppercase tracking-tighter">Evaluación técnica</p>
                    </div>
                    <div class="flex-grow flex flex-col items-center justify-center border border-dashed border-gray-900 rounded p-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-900 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        <span class="text-[9px] text-gray-800 font-bold uppercase tracking-widest text-center italic">Proceso Interno</span>
                    </div>
                </div>

                {{-- ETAPA 4: GANADORES (EXCLUSIVO) --}}
                <div class="bg-[#050505] border border-dashed border-gray-800 p-6 flex flex-col h-full opacity-60 hover:opacity-100 transition-opacity">
                    <div class="mb-6 text-gray-600">
                        <span class="font-bebas text-xl tracking-[3px]">FINAL</span>
                        <h3 class="font-bebas text-4xl uppercase">Ganadores</h3>
                        <p class="text-[10px] mt-2 font-bold uppercase italic tracking-tighter text-brand-orange/50">Formalización</p>
                    </div>

                    <div class="space-y-2 mb-8 flex-grow">
                        <div class="p-2 border border-[#111] flex justify-between items-center group">
                            <span class="text-[9px] font-bold text-gray-700 uppercase leading-tight">Anexo 9. Imagen Actores</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-gray-900" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" stroke-width="2" />
                            </svg>
                        </div>
                        <div class="p-2 border border-[#111] flex justify-between items-center group">
                            <span class="text-[9px] font-bold text-gray-700 uppercase leading-tight">Anexo 10. Uso Obra</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-gray-900" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" stroke-width="2" />
                            </svg>
                        </div>
                        <div class="p-2 border border-[#111] flex justify-between items-center group">
                            <span class="text-[9px] font-bold text-gray-700 uppercase leading-tight">Anexo 11. Uso Locación</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-gray-900" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" stroke-width="2" />
                            </svg>
                        </div>
                    </div>
                    <div class="text-[8px] text-center text-gray-800 uppercase font-black tracking-[2px] pt-2 border-t border-[#111]">
                        Solo Ganadores
                    </div>
                </div>
            </div>
        </section>

        {{-- Pasos e Inscripción Final - Versión Plataforma Digital con Logo de Fondo --}}
        <section id="pasos" class="mb-[120px] scroll-mt-[100px]">
            {{-- Encabezado --}}
            <div class="relative block mb-12">
                <h2 class="font-bebas text-[3.5rem] text-brand-orange mb-2 border-b-4 border-brand-orange inline-block pb-1">¿CÓMO POSTULARSE?</h2>
                <p class="text-gray-500 font-bold uppercase tracking-[3px] text-xs">Sigue el flujo del sistema digital para participar</p>
            </div>

            {{-- Grid de Pasos Digitales --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
                {{-- Paso 1 --}}
                <div class="bg-brand-surface p-6 border-t-4 border-brand-orange group hover:bg-[#1a1a1a] transition-colors">
                    <span class="font-bebas text-5xl text-brand-orange/30 group-hover:text-brand-orange transition-colors">01</span>
                    <h4 class="text-white font-bebas text-xl mb-2">RECOLECTA</h4>
                    <p class="text-gray-400 text-sm">Organiza tus documentos de la <strong class="text-white">Etapa 1</strong> en formatos PDF individuales y debidamente firmados.</p>
                </div>

                {{-- Paso 2 --}}
                <div class="bg-brand-surface p-6 border-t-4 border-brand-orange group hover:bg-[#1a1a1a] transition-colors">
                    <span class="font-bebas text-5xl text-brand-orange/30 group-hover:text-brand-orange transition-colors">02</span>
                    <h4 class="text-white font-bebas text-xl mb-2">VALIDA</h4>
                    <p class="text-gray-400 text-sm">Ingresa a la plataforma usando tu identificación para <strong class="text-white">validar tu calidad de socio</strong> activo.</p>
                </div>

                {{-- Paso 3 --}}
                <div class="bg-brand-surface p-6 border-t-4 border-brand-orange group hover:bg-[#1a1a1a] transition-colors">
                    <span class="font-bebas text-5xl text-brand-orange/30 group-hover:text-brand-orange transition-colors">03</span>
                    <h4 class="text-white font-bebas text-xl mb-2">CARGA</h4>
                    <p class="text-gray-400 text-sm">Sube los archivos al formulario digital. El sistema te guiará paso a paso en el proceso de carga.</p>
                </div>

                {{-- Paso 4 --}}
                <div class="bg-brand-surface p-6 border-t-4 border-brand-orange group hover:bg-[#1a1a1a] transition-colors">
                    <span class="font-bebas text-5xl text-brand-orange/30 group-hover:text-brand-orange transition-colors">04</span>
                    <h4 class="text-white font-bebas text-xl mb-2">CONFIRMA</h4>
                    <p class="text-gray-400 text-sm">Una vez finalices, recibirás un <strong class="text-brand-orange">comprobante digital</strong> con tu número de radicado oficial.</p>
                </div>
            </div>

            {{-- Bloque Final Naranja (Inscripción con Logo de Fondo) --}}
            <div class="bg-brand-orange p-10 md:p-16 text-center relative overflow-hidden">
                {{-- Decoración de fondo (Logo S.C.G. muy grande y sutil) --}}
                <div class="absolute inset-0 flex items-center justify-center opacity-10 pointer-events-none">
                    <img src="{{ asset('resources/imagenes/logo.png') }}" alt="" class="w-1/2 invert brightness-0">
                </div>

                <div class="relative z-10">
                    <h3 class="font-bebas text-[3rem] md:text-[4.5rem] text-black mb-4 leading-none uppercase">PORTAL DE INSCRIPCIÓN VIRTUAL</h3>
                    <p class="text-black font-bold mb-10 max-w-2xl mx-auto uppercase tracking-tighter text-lg italic leading-tight">
                        El sistema verificará automáticamente tus datos de socio antes de permitir la carga de documentos.
                    </p>

                    <a href="{{ route('validar-socio') }}" class="inline-flex items-center gap-6 bg-black text-white px-12 py-6 no-underline font-bebas text-[1.8rem] tracking-[4px] transition-all duration-300 hover:bg-white hover:text-black hover:shadow-2xl transform hover:-translate-y-2 group">
                        INGRESAR AL SISTEMA
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 group-hover:translate-x-2 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>

                    <div class="mt-8 flex flex-wrap justify-center gap-6">
                        <span class="flex items-center gap-2 text-[10px] text-black font-black uppercase tracking-widest">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" stroke-width="2" />
                            </svg>
                            Acceso Seguro
                        </span>
                        <span class="flex items-center gap-2 text-[10px] text-black font-black uppercase tracking-widest">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2" />
                            </svg>
                            Carga Directa
                        </span>
                    </div>
                </div>
            </div>
        </section>
    </div>

    {{-- Footer y Scripts se mantienen igual --}}
    <footer class="bg-[#050505] text-[#888] py-20 border-t border-[#1a1a1a] text-[0.9rem]">
        <div class="max-w-[1100px] mx-auto grid grid-cols-1 md:grid-cols-[2fr_1fr_1fr] gap-[50px] px-6">
            <div>
                <h3 class="font-bebas text-[1.8rem] text-white mb-[5px] tracking-[2px]">ACTORES S.C.G.</h3>
                <p class="text-brand-orange font-semibold mb-[15px] text-[0.75rem] uppercase tracking-[1px]">Sociedad Colombiana de Gestión de Actores</p>
                <p class="leading-[1.8] max-w-[350px]">
                    Protegiendo y gestionando los derechos patrimoniales de los actores y actrices de Colombia desde 1987.
                </p>
            </div>
            <div>
                <h4 class="text-white font-bebas text-[1.2rem] mb-[25px] tracking-[1px]">INSTITUCIONAL</h4>
                <ul class="list-none">
                    <li class="mb-3"><a href="#" class="text-[#888] no-underline transition-all duration-300 hover:text-brand-orange hover:pl-[5px]">Transparencia</a></li>
                    <li class="mb-3"><a href="#" class="text-[#888] no-underline transition-all duration-300 hover:text-brand-orange hover:pl-[5px]">Estatutos</a></li>
                    <li class="mb-3"><a href="#" class="text-[#888] no-underline transition-all duration-300 hover:text-brand-orange hover:pl-[5px]">Tratamiento de Datos</a></li>
                    <li class="mb-3"><a href="#" class="text-[#888] no-underline transition-all duration-300 hover:text-brand-orange hover:pl-[5px]">Contacto</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-bebas text-[1.2rem] mb-[25px] tracking-[1px]">CONTACTO</h4>
                <p class="mb-1">Bogotá, Colombia</p>
                <p class="mb-1">Calle 93A No. 13 - 24, Of. 402</p>
                <p class="mb-1">PBX: +57 (601) 743 0045</p>
                <p>Email: contacto@actores.org.co</p>
            </div>
        </div>
    </footer>

    {{-- Botones Flotantes --}}
    <div class="fixed bottom-6 right-6 flex flex-col gap-4 z-[2000]">
        <a href="#" class="flex items-center justify-center bg-brand-orange text-white w-14 h-14 rounded-full shadow-[0_4px_15px_rgba(0,0,0,0.3)] transition-all duration-300 hover:bg-[#ff6a33] hover:-translate-y-1 hover:shadow-[0_10px_20px_rgba(232,82,27,0.3)] group relative">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <span class="absolute right-16 bg-white text-black px-2 py-1 rounded text-xs font-bold opacity-0 group-hover:opacity-100 transition-opacity shadow-lg pointer-events-none uppercase tracking-wider whitespace-nowrap">
                Términos y condiciones
            </span>
        </a>

        <a href="https://wa.me/573229356936" target="_blank"
            class="flex items-center justify-center bg-[#25D366] text-white w-14 h-14 rounded-full shadow-[0_4px_15px_rgba(0,0,0,0.3)] transition-all duration-300 hover:scale-110 hover:shadow-[0_0_20px_rgba(37,211,102,0.4)] group relative">
            <svg class="w-8 h-8 fill-current" viewBox="0 0 24 24">
                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.588-5.946 0-6.556 5.332-11.888 11.888-11.888 3.176 0 6.161 1.237 8.404 3.48s3.481 5.229 3.481 8.404c0 6.556-5.332 11.888-11.888 11.888-2.01 0-3.988-.508-5.73-1.472l-6.254 1.641zm6.309-4.321c1.547.92 3.123 1.399 4.759 1.399 5.075 0 9.212-4.136 9.212-9.212 0-2.457-.957-4.767-2.693-6.503s-4.047-2.693-6.504-2.693c-5.075 0-9.212 4.136-9.212 9.212 0 1.77.51 3.5 1.476 4.997l-.999 3.648 3.765-.988zm11.458-6.191c-.078-.13-.288-.208-.603-.365-.315-.157-1.859-.918-2.148-1.023-.289-.105-.499-.157-.709.157-.21.315-.814 1.023-.997 1.233-.183.21-.367.236-.682.079-.315-.157-1.332-.49-2.537-1.565-.937-.836-1.57-1.868-1.754-2.183-.184-.315-.02-.486.137-.643.141-.141.315-.367.472-.551.157-.184.21-.315.315-.525.105-.21.052-.394-.026-.551-.079-.157-.709-1.706-.971-2.336-.255-.615-.514-.532-.709-.542-.183-.008-.393-.01-.603-.01s-.551.079-.84.394c-.289.315-1.102 1.076-1.102 2.625 0 1.549 1.129 3.045 1.286 3.255.157.21 2.221 3.391 5.38 4.754.752.324 1.339.518 1.797.663.754.24 1.441.206 1.983.125.603-.09 1.859-.761 2.121-1.469.262-.708.262-1.312.184-1.441z" />
            </svg>
            <span class="absolute right-16 bg-white text-black px-2 py-1 rounded text-xs font-bold opacity-0 group-hover:opacity-100 transition-opacity shadow-lg pointer-events-none uppercase tracking-wider">
                Escríbenos
            </span>
        </a>
    </div>

    <script>
        const menu = document.querySelector('#mobile-menu');
        const menuLinks = document.querySelector('.nav-links');
        const bars = menu.querySelectorAll('span');

        menu.addEventListener('click', () => {
            menuLinks.classList.toggle('-right-full');
            menuLinks.classList.toggle('right-0');
            bars[0].classList.toggle('translate-y-[9px]');
            bars[0].classList.toggle('rotate-45');
            bars[1].classList.toggle('opacity-0');
            bars[2].classList.toggle('-translate-y-[9px]');
            bars[2].classList.toggle('-rotate-45');
        });

        document.querySelectorAll('.nav-links a').forEach(link => {
            link.addEventListener('click', () => {
                menuLinks.classList.add('-right-full');
                menuLinks.classList.remove('right-0');
                bars[0].classList.remove('translate-y-[9px]', 'rotate-45');
                bars[1].classList.remove('opacity-0');
                bars[2].classList.remove('-translate-y-[9px]', '-rotate-45');
            });
        });

        // ESTO ES EL SEGURO DE VIDA: Si Alpine falla, JS puro cerrará el modal
        document.addEventListener('keydown', function(event) {
            if (event.key === "Escape") {
                const modal = document.getElementById('success-modal');
                if (modal) modal.style.display = 'none';
            }
        });
    </script>
</body>

</html>