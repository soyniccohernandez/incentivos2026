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

        #livewire-error {
            display: none !important;
        }

        html {
            scroll-behavior: smooth;
        }

        /* Opcional: Una línea debajo del activo para más estilo */
        .nav-link-scroll.text-brand-orange {
            position: relative;
        }

        .nav-link-scroll.text-brand-orange::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: #ff6600;
        }
    </style>
</head>

<body class="bg-black text-white font-montserrat antialiased leading-relaxed">

    {{-- Modal de Éxito - Versión Sophisticated Tech --}}
    @if (session()->has('success'))
    <div id="success-modal"
        x-data="{ show: true }"
        x-show="show"
        class="fixed inset-0 z-[5000] flex items-center justify-center p-6 overflow-hidden">

        {{-- Overlay: Menos opaco para ver el fondo sutilmente --}}
        <div class="fixed inset-0 bg-black/90 backdrop-blur-xl"
            @click="show = false; document.getElementById('success-modal').style.display='none'">
        </div>

        {{-- Contenedor Principal --}}
        <div class="relative bg-white w-full max-w-xl shadow-[0_30px_100px_rgba(0,0,0,0.5)] z-[5001] rounded-2xl overflow-hidden"
            x-show="show"
            x-transition:enter="transition ease-out duration-500"
            x-transition:enter-start="opacity-0 scale-90 translate-y-10"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0">

            {{-- Cabecera con degradado sutil --}}
            <div class="h-2 w-full bg-gradient-to-r from-brand-orange via-orange-400 to-brand-orange"></div>

            <div class="p-10 md:p-14 text-center">

                {{-- Icono Check: Minimalista --}}
                <div class="mb-8 inline-flex items-center justify-center w-20 h-20 rounded-full bg-green-50 text-green-500 shadow-inner">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>

                <h2 class="font-bebas text-5xl md:text-6xl text-gray-900 leading-tight mb-4 tracking-tight">
                    REGISTRO <span class="text-brand-orange">COMPLETO</span>
                </h2>

                <p class="text-gray-500 text-sm md:text-base font-medium leading-relaxed mb-10 max-w-sm mx-auto">
                    Tu propuesta ha sido cargada correctamente en nuestro sistema. Hemos generado tu identificador oficial.
                </p>

                {{-- Visualización del Radicado: Estilo Tarjeta Digital --}}
                <div class="bg-gray-50 border border-gray-100 rounded-xl p-8 mb-10 relative overflow-hidden group">
                    {{-- Adorno lateral --}}
                    <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-brand-orange"></div>

                    <span class="text-gray-400 text-[10px] uppercase tracking-[3px] block mb-2 font-bold">Número de radicado</span>

                    <div class="flex items-center justify-center gap-3">
                        <span class="text-gray-900 font-bebas text-5xl md:text-6xl tracking-[2px] select-all">
                            {{ session('radicado') ?? 'ABC-000-2026' }}
                        </span>
                    </div>

                    <p class="mt-4 text-[9px] text-gray-400 uppercase tracking-widest font-bold">Conserva este código para futuras consultas</p>
                </div>

                {{-- Botones y acciones --}}
                <div class="flex flex-col gap-4">
                    <button onclick="document.getElementById('success-modal').style.display='none'"
                        @click="show = false"
                        class="w-full bg-gray-900 text-white font-bold py-5 rounded-xl hover:bg-brand-orange transition-all duration-300 shadow-lg shadow-gray-200 uppercase tracking-widest text-xs">
                        Entendido y Cerrar
                    </button>

                    <div class="flex items-center justify-center gap-2 mt-2">
                        <svg class="w-4 h-4 text-brand-orange" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                        </svg>
                        <span class="text-[10px] text-gray-400 uppercase font-bold tracking-widest">Confirmación enviada al correo</span>
                    </div>
                </div>
            </div>

            {{-- Footer del modal --}}
            <div class="bg-gray-50 px-10 py-4 border-t border-gray-100 flex justify-between items-center text-[9px] text-gray-400 font-bold uppercase tracking-widest">
                <span>Convocatoria 2026</span>
                <span class="text-brand-orange">Sistema de Gestión Audiovisual</span>
            </div>
        </div>
    </div>
    @endif

    {{-- Navegación Fija --}}
    <nav class="fixed top-0 left-0 w-full z-[1000] flex justify-between items-center px-6 py-5 md:px-12 bg-black/95 border-b border-brand-border backdrop-blur-sm">
        {{-- LOGO Y BRANDING --}}
        <a href="{{ url('/') }}" class="flex items-center gap-4 group no-underline">
            <div class="relative overflow-hidden">
                <img src="{{ asset('resources/imagenes/logo.png') }}" alt="Logo Actores SCG" class="h-[45px] md:h-[55px] w-auto object-contain transition-transform duration-500 group-hover:scale-110">
            </div>
            <div class="h-8 w-[1px] bg-brand-orange/40 hidden sm:block"></div>
            <div class="flex flex-col justify-center">
                <span class="font-bebas text-2xl md:text-3xl text-brand-orange tracking-[1px] leading-none">ACTORES S.C.G.</span>
                <span class="text-[8px] font-bold text-gray-500 tracking-[2px] uppercase leading-tight hidden md:block">Sociedad de Gestión</span>
            </div>
        </a>

        {{-- BOTÓN MENÚ MÓVIL --}}
        <div class="flex flex-col gap-[6px] cursor-pointer md:hidden z-[1100]" id="mobile-menu">
            <span class="w-[30px] h-[3px] bg-white transition-all duration-300"></span>
            <span class="w-[30px] h-[3px] bg-white transition-all duration-300"></span>
            <span class="w-[30px] h-[3px] bg-white transition-all duration-300"></span>
        </div>

        {{-- ENLACES --}}
        <ul class="nav-links fixed md:static top-0 -right-full md:right-0 w-full md:w-auto h-screen md:h-auto bg-brand-orange md:bg-transparent flex flex-col md:flex-row justify-center md:justify-end items-center gap-8 md:gap-[30px] transition-all duration-500 z-[1000] list-none">

            {{-- ANCLAS (Con clase nav-link-scroll para el script) --}}
            <li><a href="#inicio" class="nav-link-scroll no-underline text-white font-bebas text-[2.5rem] md:text-xl tracking-[1.5px] opacity-80 hover:md:text-brand-orange transition-all">INICIO</a></li>
            <li><a href="#requisitos" class="nav-link-scroll no-underline text-white font-bebas text-[2.5rem] md:text-xl tracking-[1.5px] opacity-80 hover:md:text-brand-orange transition-all">REQUISITOS</a></li>
            <li><a href="#convocatoria" class="nav-link-scroll no-underline text-white font-bebas text-[2.5rem] md:text-xl tracking-[1.5px] opacity-80 hover:md:text-brand-orange transition-all">SOBRE LA CONVOCATORIA</a></li>
            <li><a href="#cronograma" class="nav-link-scroll no-underline text-white font-bebas text-[2.5rem] md:text-xl tracking-[1.5px] opacity-80 hover:md:text-brand-orange transition-all">CRONOGRAMA</a></li>
            <li><a href="#anexos" class="nav-link-scroll no-underline text-white font-bebas text-[2.5rem] md:text-xl tracking-[1.5px] opacity-80 hover:md:text-brand-orange transition-all">PREPÁRATE</a></li>
            <li><a href="#pasos" class="nav-link-scroll no-underline text-white font-bebas text-[2.5rem] md:text-xl tracking-[1.5px] opacity-80 hover:md:text-brand-orange transition-all">¿CÓMO POSTULARSE?</a></li>

            {{-- RUTA FIJA (Página externa) --}}
            <li>
                <a href="{{ route('inscritos.publico') }}"
                    class="no-underline font-bebas text-[2.5rem] md:text-xl tracking-[1.5px] transition-all 
               {{ request()->routeIs('inscritos.publico') ? 'text-brand-orange opacity-100' : 'text-white opacity-80 hover:md:text-brand-orange' }}">
                    VER INSCRITOS
                </a>
            </li>

            {{-- BOTÓN DE ACCIÓN --}}
            <li class="md:ml-6 mt-4 md:mt-0">
                @auth
                <a href="{{ route('dashboard') }}" class="no-underline text-black font-bebas text-[2.5rem] md:text-lg tracking-[1.5px] relative overflow-hidden group/btn bg-brand-orange px-10 py-4 md:px-6 md:py-2.5 shadow-[0_0_20px_rgba(255,102,0,0.3)] hover:shadow-[0_0_30px_rgba(255,102,0,0.5)] transition-all duration-300 flex items-center gap-3">
                    <span class="relative z-10 uppercase">MI PANEL</span>
                </a>
                @else
                <a href="{{ route('validar-socio') }}" class="no-underline text-black font-bebas text-[2.5rem] md:text-lg tracking-[1.5px] relative overflow-hidden group/btn bg-brand-orange px-10 py-4 md:px-6 md:py-2.5 shadow-[0_0_20px_rgba(255,102,0,0.3)] hover:shadow-[0_0_30px_rgba(255,102,0,0.5)] transition-all duration-300 flex items-center gap-3">
                    <svg class="w-5 h-5 md:w-4 md:h-4 text-black animate-pulse" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 15h-2v-6h2v6zm4 0h-2v-4h2v4zm-1-9c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1z" />
                    </svg>
                    <span class="relative z-10 uppercase">Iniciar sesión</span>
                </a>
                @endauth
            </li>
        </ul>
    </nav>

    {{-- CONTENEDOR MAESTRO: IMPACTO TOTAL INCENTIVOS 2026 --}}
    <section id="inicio" class="relative min-h-screen w-full flex flex-col bg-black overflow-hidden">

        {{-- 1. BLOQUE DE PODER: CONDICIONES DE PARTICIPACIÓN (PASO OBLIGATORIO) --}}
        {{-- mt-[90px] para compensar el navbar fijo --}}
        <div id="requisitos" class="relative z-[10] bg-brand-orange mt-[90px] md:mt-[100px] pt-16 pb-16 px-6 border-b-[15px] border-black shadow-[0_15px_50px_rgba(0,0,0,0.5)]">
            {{-- Marca de agua masiva --}}
            <div class="absolute inset-0 opacity-10 pointer-events-none select-none flex items-center justify-center">
                <span class="font-bebas text-[25vw] leading-none text-black tracking-tighter uppercase">LEGAL 2026</span>
            </div>

            <div class="relative z-10 max-w-7xl mx-auto">
                <div class="flex flex-col lg:flex-row items-center justify-between gap-12">

                    <div class="text-left flex-1">
                        <div class="inline-flex items-center gap-3 bg-black text-brand-orange font-bebas text-2xl px-6 py-2 mb-6 tracking-[4px]">
                            <span class="animate-pulse">●</span> REQUISITO PRIMARIO
                        </div>
                        <h2 class="font-bebas text-[4.5rem] md:text-[7.5rem] text-black leading-[0.8] tracking-tighter mb-4">
                            CONDICIONES DE <br>
                            <span class="bg-black text-brand-orange px-4 py-2 inline-block mt-2">PARTICIPACIÓN</span>
                        </h2>
                        <p class="text-black font-black uppercase text-lg md:text-xl tracking-tighter leading-none mt-4">
                            CONVOCATORIA DE INCENTIVOS DE CREACIÓN 2026
                        </p>
                    </div>

                    <div class="w-full lg:w-1/3 flex flex-col gap-4">
                        <div class="bg-black/10 p-6 border-l-4 border-black mb-4">
                            <p class="text-black font-bold uppercase text-[11px] md:text-xs leading-tight tracking-widest">
                                Es obligatorio descargar, leer y aceptar los términos legales para habilitar su postulación a los incentivos.
                            </p>
                        </div>

                        <a href="#" class="group relative flex items-center justify-center gap-5 bg-black text-white px-10 py-7 no-underline font-bebas text-[2.2rem] tracking-[2px] transition-all duration-300 hover:bg-white hover:text-black shadow-[0_30px_60px_rgba(0,0,0,0.3)] transform hover:-translate-y-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 group-hover:animate-bounce" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            DESCARGAR BASES
                        </a>
                    </div>

                </div>
            </div>
        </div>

        {{-- 2. BLOQUE DE ACCIÓN: HERO INCENTIVOS PARA CREACIÓN AUDIOVISUAL --}}
        <div class="hero-bg relative flex-grow flex items-center justify-center text-center py-24 px-6">
            {{-- Overlay de gradiente profundo --}}
            <div class="absolute inset-0 bg-gradient-to-b from-black/80 via-black/40 to-black z-[1]"></div>

            <div class="relative z-[5] max-w-[1100px] drop-shadow-[0_10px_30px_rgba(0,0,0,1)]">

                {{-- Branding Superior --}}
                <div class="flex flex-col items-center gap-[15px] mb-10 opacity-80">
                    <img src="{{ asset('resources/imagenes/logo.png') }}" alt="Logo" class="h-[60px] md:h-[90px] w-auto invert brightness-0 mb-4">
                    <span class="text-[0.7rem] md:text-[0.8rem] font-medium tracking-[6px] text-white uppercase relative pb-3 after:content-[''] after:absolute after:bottom-0 after:left-1/4 after:w-1/2 after:h-[1px] after:bg-brand-orange">
                        SOCIEDAD COLOMBIANA DE GESTIÓN
                    </span>
                </div>

                <p class="tracking-[7px] font-bold text-brand-orange mb-6 uppercase text-sm md:text-lg">PROGRAMA NACIONAL DE ESTÍMULOS</p>

                <h1 class="font-bebas text-[clamp(4rem,12vw,8.5rem)] leading-[0.85] mb-8 text-white tracking-tighter">
                    Incentivos de Creación<br>
                    <span class="text-brand-orange drop-shadow-[0_0_30px_rgba(255,102,0,0.3)]">y Producción Audiovisual</span>
                </h1>

                <div class="bg-white/5 backdrop-blur-sm border-y border-white/10 py-8 mb-12">
                    <p class="text-[1.3rem] md:text-[1.8rem] max-w-[800px] mx-auto text-gray-200 font-light leading-snug">
                        Postula tu proyecto y accede a <br>
                        <span class="text-white font-black text-3xl md:text-5xl tracking-tighter">
                            $45.000.000 <span class="text-brand-orange text-2xl md:text-3xl">COP</span>
                        </span>
                    </p>
                </div>

                {{-- Botón de Postulación --}}
                <a href="#pasos" class="inline-block bg-brand-orange text-white px-16 py-6 no-underline font-bebas text-[2rem] tracking-[3px] transition-all duration-300 hover:bg-white hover:text-black hover:-translate-y-2 hover:shadow-[0_20px_40px_rgba(255,102,0,0.5)]">
                    POSTULAR MI PROYECTO
                </a>

                {{-- Indicador de Fecha --}}
                <div class="mt-16 text-[10px] md:text-[12px] text-white/40 font-black uppercase tracking-[5px]">
                    Convocatoria abierta • Edición 2026
                </div>
            </div>
        </div>
    </section>

    {{-- Contenido Principal --}}
    <div class="max-w-[1100px] mx-auto px-6 py-24">
        {{-- Convocatoria --}}
        <section id="convocatoria" class="mb-[120px] scroll-mt-[100px]">
            <h2 class="font-bebas text-[3.5rem] text-brand-orange mb-10 border-b border-brand-border inline-block pb-[5px]">LA CONVOCATORIA</h2>
            <div class="mb-10 max-w-[850px]">
                {{-- Badge de Urgencia: Conecta con la fecha actual (Feb 23 está cerca) --}}
                <div class="inline-flex items-center gap-2 mb-5 px-3 py-1 bg-brand-orange/10 border border-brand-orange/20">
                    <span class="w-2 h-2 bg-brand-orange rounded-full animate-pulse"></span>
                    <span class="text-brand-orange font-mono text-[10px] font-black tracking-[3px] uppercase">
                        Campaña de expectativa abierta
                    </span>
                </div>

                <p class="text-[1.2rem] md:text-[1.4rem] text-[#BBBBBB] leading-relaxed">
                    Desde este <strong class="text-white">23 de febrero</strong>, relanzamos una de las iniciativas más poderosas de Bienestar Social.
                    Prepara tu proyecto: buscamos historias con impacto que reflejen valores de
                    <span class="text-white font-bold italic">equidad, diversidad y respeto</span>.
                </p>

                {{-- Recordatorio rápido de la fecha de postulación --}}
                <p class="mt-4 text-sm font-mono tracking-widest text-gray-500 uppercase">
                    Apertura de inscripciones: <span class="text-white border-b border-brand-orange">09 de marzo</span>
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-[25px]">
                <div class="bg-brand-surface p-10 border-l-4 border-brand-orange transition-all duration-300 hover:bg-[#151515]">
                    <h3 class="font-bebas text-[2rem] mb-[15px]">EL PREMIO</h3>
                    <p>¡3 seleccionados! Cada uno recibirá <strong>$45.000.000 COP </strong> para la ejecución total de su obra.</p>
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

        {{-- Cronograma Estilo Tabla de Producción Industrial --}}
        <section id="cronograma" class="mb-[120px] scroll-mt-[100px] px-4">
            {{-- Header de Sección --}}
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6 border-b border-brand-orange/20 pb-8">
                <div>
                    <span class="text-brand-orange font-mono text-xs font-black tracking-[5px] uppercase block mb-2">// SCHEDULE_REEL_2026</span>
                    <h2 class="font-bebas text-[5rem] md:text-[7rem] text-white leading-[0.8] uppercase">
                        CRONOGRAMA <span class="text-brand-orange">CONVOCATORIA</span>
                    </h2>
                </div>
                <div class="flex flex-col items-end">
                    <div class="bg-brand-orange text-black px-6 py-2 font-bebas text-2xl skew-x-[-12deg] mb-2">
                        CRONOGRAMA DE PRODUCCIÓN
                    </div>
                    <p class="text-gray-500 font-bold tracking-[2px] uppercase text-[10px]">Actualizado: Feb 2026</p>
                </div>
            </div>

            {{-- Tabla Industrial --}}
            <div class="w-full overflow-hidden border border-white/10 bg-[#050505] shadow-2xl">
                {{-- Table Head --}}
                <div class="hidden md:grid grid-cols-12 bg-white/[0.03] border-b border-white/10 py-6 px-8">
                    <div class="col-span-2 text-brand-orange font-bebas text-xl tracking-widest">ETAPA</div>
                    <div class="col-span-6 text-brand-orange font-bebas text-xl tracking-widest">HITOS DEL PROCESO</div>
                    <div class="col-span-4 text-brand-orange font-bebas text-xl tracking-widest text-right">VENTANA TEMPORAL</div>
                </div>

                {{-- Filas de la Tabla --}}
                <div class="divide-y divide-white/10">

                    {{-- ETAPA I: ACTIVE HIGHLIGHT --}}
                    <div class="grid grid-cols-1 md:grid-cols-12 items-center py-10 px-8 bg-brand-orange/[0.03] relative overflow-hidden group">
                        <div class="absolute left-0 top-0 bottom-0 w-1 bg-brand-orange shadow-[0_0_15px_rgba(255,102,0,0.5)]"></div>
                        <div class="col-span-2 mb-4 md:mb-0">
                            <span class="text-brand-orange font-mono text-sm block mb-1">01. / LIVE</span>
                            <span class="text-brand-orange font-bebas text-4xl tracking-tighter uppercase">ETAPA I</span>
                        </div>
                        <div class="col-span-6 pr-8">
                            <div class="flex flex-col gap-2">
                                <div class="flex items-center gap-3">
                                    <h4 class="text-white font-bold text-lg uppercase">Inscripción y Subsanación</h4>
                                    <span class="animate-pulse bg-brand-orange text-black text-[9px] font-black px-2 py-0.5 rounded">EN CURSO</span>
                                </div>
                                <ul class="text-gray-400 text-[11px] uppercase tracking-wider space-y-1 list-none">
                                    <li><span class="text-brand-orange">>></span> 09-23 Mar: Inscripción de proponentes</li>
                                    <li><span class="text-brand-orange">>></span> 15 Abr: Publicación de subsanaciones</li>
                                    <li><span class="text-brand-orange">>></span> 16-24 Abr: Recepción de ajustes</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-span-4 mt-6 md:mt-0 md:text-right">
                            <span class="inline-block py-3 px-6 bg-brand-orange text-black font-mono font-black text-xl shadow-[0_0_30px_rgba(255,102,0,0.1)]">
                                09 MAR — 11 MAYO
                            </span>
                        </div>
                    </div>

                    {{-- ETAPA II --}}
                    <div class="grid grid-cols-1 md:grid-cols-12 items-center py-10 px-8 hover:bg-white/[0.02] transition-colors group">
                        <div class="col-span-2 mb-4 md:mb-0">
                            <span class="text-gray-600 font-mono text-sm block mb-1">02.</span>
                            <span class="text-white font-bebas text-3xl tracking-tighter uppercase group-hover:text-brand-orange transition-colors">ETAPA II</span>
                        </div>
                        <div class="col-span-6 pr-8">
                            <h4 class="text-white font-bold text-lg uppercase mb-2">Recepción Técnica de Guiones</h4>
                            <p class="text-gray-500 text-sm leading-relaxed max-w-md uppercase tracking-tighter italic">Carga única de documentos y guiones. Selección de clasificados a Etapa III.</p>
                        </div>
                        <div class="col-span-4 mt-6 md:mt-0 md:text-right">
                            <span class="inline-block py-2 px-6 border border-white/20 text-white font-mono font-bold text-xl group-hover:border-brand-orange transition-all">
                                13 MAY — 04 JUNIO
                            </span>
                        </div>
                    </div>

                    {{-- ETAPA III --}}
                    <div class="grid grid-cols-1 md:grid-cols-12 items-center py-10 px-8 hover:bg-white/[0.02] transition-colors group">
                        <div class="col-span-2 mb-4 md:mb-0">
                            <span class="text-gray-600 font-mono text-sm block mb-1">03.</span>
                            <span class="text-white font-bebas text-3xl tracking-tighter uppercase group-hover:text-brand-orange transition-colors">ETAPA III</span>
                        </div>
                        <div class="col-span-6 pr-8">
                            <h4 class="text-white font-bold text-lg uppercase mb-2">Evaluación de Jurados</h4>
                            <p class="text-gray-500 text-sm leading-relaxed max-w-md uppercase tracking-tighter">Revisión exhaustiva de guiones y documentación por expertos externos.</p>
                        </div>
                        <div class="col-span-4 mt-6 md:mt-0 md:text-right">
                            <span class="inline-block py-2 px-6 border border-white/10 text-gray-400 font-mono font-bold text-xl">
                                06 JUN — 24 JUNIO
                            </span>
                        </div>
                    </div>

                    {{-- ETAPA IV: PRODUCTION --}}
                    <div class="grid grid-cols-1 md:grid-cols-12 items-center py-10 px-8 hover:bg-white/[0.02] transition-colors group">
                        <div class="col-span-2 mb-4 md:mb-0">
                            <span class="text-gray-600 font-mono text-sm block mb-1">04.</span>
                            <span class="text-white font-bebas text-3xl tracking-tighter uppercase group-hover:text-brand-orange transition-colors">ETAPA IV</span>
                        </div>
                        <div class="col-span-6 pr-8">
                            <h4 class="text-white font-bold text-lg uppercase mb-2">Producción Audiovisual</h4>
                            <p class="text-gray-500 text-sm leading-relaxed max-w-md uppercase tracking-tighter">Desarrollo de contenidos y entrega final de piezas y documentación.</p>
                        </div>
                        <div class="col-span-4 mt-6 md:mt-0 md:text-right">
                            <div class="flex flex-col md:items-end">
                                <span class="text-white font-mono font-bold text-xl uppercase">30 JUN (Resultados)</span>
                                <span class="text-brand-orange font-mono text-sm">01 JUL — 30 SEPT</span>
                            </div>
                        </div>
                    </div>

                    {{-- FASE FINAL: PREMIER --}}
                    <div class="grid grid-cols-1 md:grid-cols-12 items-center py-12 px-8 bg-white text-black group">
                        <div class="col-span-2 mb-4 md:mb-0">
                            <span class="font-mono text-sm block mb-1 font-black">05. / CINEMA</span>
                            <span class="font-bebas text-4xl tracking-tighter uppercase leading-none">PREMIER</span>
                        </div>
                        <div class="col-span-6 pr-8">
                            <div class="flex items-center gap-3 mb-2">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                </svg>
                                <h4 class="font-bebas text-3xl uppercase tracking-wider leading-none">EXHIBICIÓN AL PÚBLICO</h4>
                            </div>
                            <p class="font-bold text-xs leading-relaxed max-w-md uppercase tracking-widest">Lanzamiento oficial del cortometraje y encuentro con seleccionados.</p>
                        </div>
                        <div class="col-span-4 mt-6 md:mt-0 md:text-right">
                            <div class="inline-flex flex-col items-end">
                                <span class="font-bebas text-[4.5rem] leading-none">OCTUBRE</span>
                                <span class="font-mono font-black text-xs tracking-[4px] -mt-2 uppercase">Fecha por definir</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Decorative Footer --}}
            <div class="mt-4 flex justify-between items-center px-4">
                <div class="flex gap-2">
                    <div class="w-12 h-1 bg-brand-orange"></div>
                    <div class="w-4 h-1 bg-white/20"></div>
                    <div class="w-4 h-1 bg-white/20"></div>
                </div>
                <span class="text-white/20 font-mono text-[10px] tracking-[4px]">CONVOCATORIA_CREACIÓN_PRODUCCIÓN_2026</span>
            </div>
        </section>

        {{-- Sección de Cronograma y Etapas --}}
        <section id="anexos" class="mb-[120px] scroll-mt-[100px] max-w-7xl mx-auto px-4 font-outfit">

            {{-- Encabezado Mejorado --}}
            <div class="flex flex-col lg:flex-row lg:items-end justify-between mb-16 gap-8 border-b border-white/10 pb-12">
                <div class="max-w-2xl">
                    <span class="text-brand-orange font-bold uppercase tracking-[5px] text-[0.7rem] mb-4 block opacity-90">Ruta de participación 2026</span>
                    <h2 class="font-bebas text-[4.5rem] md:text-[5.5rem] text-white leading-[0.85] mb-6">
                        ¡PREPÁRATE Y <br>
                        <span class="text-brand-orange">ADELANTA TU ÉXITO!</span>
                    </h2>
                    <p class="text-gray-300 text-lg uppercase tracking-normal font-light max-w-xl leading-relaxed">
                        No esperes al día de la apertura. Aquí tienes acceso a la <span class="text-white font-medium border-b border-brand-orange/30 pb-0.5">documentación oficial</span> para que comiences a proyectar tu propuesta hoy mismo.
                    </p>
                </div>

                {{-- Bloque Informativo con Mejor Contraste --}}
                <div class="relative bg-[#1a1a1a] border-l-4 border-brand-orange p-7 max-w-md shadow-2xl">
                    <div class="flex items-start gap-5">
                        <div class="text-brand-orange mt-1 bg-brand-orange/10 p-2 rounded-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-white font-bold text-xs uppercase tracking-[3px] mb-3">Kit de Pre-Inscripción</h4>
                            <p class="text-gray-400 text-[12px] uppercase leading-relaxed tracking-wider font-medium">
                                Descarga los <span class="text-brand-orange font-bold">anexos editables</span> de la Etapa I. Diligencia con calma y ten tu carpeta lista para el radicado oficial.
                            </p>
                        </div>
                    </div>
                    <div class="absolute -top-3 -right-2 text-brand-orange/10 font-bebas text-7xl select-none">!</div>
                </div>
            </div>

            <div class="space-y-6">
                {{-- 10.1 ETAPA I --}}
                <details class="group bg-[#0f0f0f] border-2 border-brand-orange/50 shadow-[0_0_50px_rgba(255,102,0,0.03)] overflow-hidden transition-all duration-500" open>
                    <summary class="flex items-center justify-between p-8 cursor-pointer list-none select-none hover:bg-white/[0.02] transition-colors">
                        <div class="flex items-center gap-8">
                            <div class="hidden sm:flex flex-col items-center border-r border-white/10 pr-8">
                                <span class="text-brand-orange font-bebas text-5xl leading-none">10.1</span>
                                <span class="text-gray-500 font-bold text-[9px] tracking-[3px] uppercase mt-1">Cláusula</span>
                            </div>
                            <div>
                                <div class="flex items-center gap-4 mb-2">
                                    <span class="bg-brand-orange text-black text-[10px] font-black px-2.5 py-1 uppercase tracking-widest rounded-sm">Fase Actual</span>
                                    <h3 class="font-bebas text-4xl md:text-5xl text-white tracking-[2px] uppercase">Etapa I – Inscripción</h3>
                                </div>
                                <p class="text-gray-400 text-[11px] uppercase tracking-[4px] font-semibold">Verificación de documentos administrativos</p>
                            </div>
                        </div>
                        <div class="w-12 h-12 rounded-full border-2 border-brand-orange/30 flex items-center justify-center text-brand-orange group-open:bg-brand-orange group-open:text-white transition-all duration-500 group-open:rotate-180">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </summary>

                    <div class="px-8 pb-10 pt-6 border-t border-white/5 bg-black/40">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 mt-4 text-white">

                            {{-- Anexo Estilo Card --}}
                            <a href="#" class="group/item relative p-7 bg-[#1a1a1a] border border-white/5 hover:border-brand-orange transition-all duration-300 shadow-lg">
                                <span class="text-brand-orange font-bebas text-2xl mb-2 block tracking-wider">Anexo 01</span>
                                <h4 class="font-bold text-[13px] uppercase tracking-widest leading-tight text-gray-200 group-hover/item:text-white transition-colors">Manifestación de Interés</h4>
                                <div class="mt-4 flex items-center gap-2 text-[10px] text-brand-orange font-black tracking-tighter opacity-0 group-hover/item:opacity-100 transition-all transform translate-x-[-10px] group-hover/item:translate-x-0 uppercase">
                                    Descargar Archivo <span class="text-lg">→</span>
                                </div>
                            </a>

                            <a href="#" class="group/item relative p-7 bg-[#1a1a1a] border border-white/5 hover:border-brand-orange transition-all duration-300 shadow-lg">
                                <span class="text-brand-orange font-bebas text-2xl mb-2 block tracking-wider">Anexo 02</span>
                                <h4 class="font-bold text-[13px] uppercase tracking-widest leading-tight text-gray-200 group-hover/item:text-white transition-colors">Certificación de Experiencia</h4>
                                <div class="mt-4 flex items-center gap-2 text-[10px] text-brand-orange font-black tracking-tighter opacity-0 group-hover/item:opacity-100 transition-all transform translate-x-[-10px] group-hover/item:translate-x-0 uppercase">
                                    Descargar Archivo <span class="text-lg">→</span>
                                </div>
                            </a>

                            {{-- Soportes Especiales --}}
                            <div class="p-7 bg-[#1a1a1a] border-2 border-brand-orange/30 flex flex-col justify-between group shadow-xl">
                                <div>
                                    <span class="text-brand-orange font-bebas text-2xl mb-2 block tracking-wider">Soportes</span>
                                    <h4 class="font-bold text-[13px] uppercase tracking-widest leading-tight text-white">Evidencias 1 y 2</h4>
                                    <p class="text-[10px] text-gray-500 font-bold mt-3 italic uppercase tracking-wider leading-relaxed border-t border-white/5 pt-3">
                                        * Documento base único para ambos archivos
                                    </p>
                                </div>
                                <a href="#" class="mt-6 flex items-center justify-center gap-2 bg-brand-orange text-black p-3 text-[11px] font-black uppercase tracking-[2px] hover:bg-white transition-all shadow-lg shadow-brand-orange/10">
                                    Descargar Formato
                                </a>
                            </div>

                            <a href="#" class="group/item relative p-7 bg-[#1a1a1a] border-l-4 border-l-brand-orange border-y-white/5 border-r-white/5 hover:bg-[#222] transition-all duration-300">
                                <span class="text-brand-orange font-bebas text-2xl mb-2 block tracking-wider">Anexo 03</span>
                                <h4 class="font-bold text-[13px] uppercase tracking-widest leading-tight text-gray-200">Autorización Uso de Guion</h4>
                                <span class="mt-3 block text-[10px] text-gray-500 uppercase font-black tracking-widest italic group-hover/item:text-brand-orange">Solo autoría de terceros</span>
                            </a>

                            <a href="#" class="group/item relative p-7 bg-[#1a1a1a] border border-white/5 hover:border-brand-orange transition-all duration-300 shadow-lg">
                                <span class="text-brand-orange font-bebas text-2xl mb-2 block tracking-wider">Anexo 04</span>
                                <h4 class="font-bold text-[13px] uppercase tracking-widest leading-tight text-gray-200 group-hover/item:text-white transition-colors">Declaraciones Juradas</h4>
                                <div class="mt-4 flex items-center gap-2 text-[10px] text-brand-orange font-black tracking-tighter opacity-0 group-hover/item:opacity-100 transition-all transform translate-x-[-10px] group-hover/item:translate-x-0 uppercase">
                                    Descargar Archivo <span class="text-lg">→</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </details>

                {{-- Etapas Bloqueadas con mejor contraste de texto --}}
                <details class="group bg-[#0a0a0a] border border-white/10 opacity-60 hover:opacity-100 transition-all duration-300">
                    <summary class="flex items-center justify-between p-8 cursor-pointer list-none">
                        <div class="flex items-center gap-8">
                            <span class="text-gray-700 font-bebas text-5xl leading-none">10.2</span>
                            <div>
                                <h3 class="font-bebas text-4xl leading-none uppercase tracking-[2px] text-gray-500">Etapa II – Guion y Técnicos</h3>
                                <p class="text-[10px] uppercase tracking-[4px] font-bold mt-2 text-gray-600">Habilitación según cronograma oficial</p>
                            </div>
                        </div>
                        <svg class="w-8 h-8 text-gray-700 transition-transform duration-500 group-open:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M19 9l-7 7-7-7" stroke-width="2" />
                        </svg>
                    </summary>
                    <div class="px-8 pb-10 pt-6 border-t border-white/5 text-gray-500 text-xs uppercase tracking-[2px] text-center font-medium">
                        La documentación técnica se habilitará en la fecha estipulada.
                    </div>
                </details>

                {{-- 11.2 ACEPTACIÓN - Más legible --}}
                <div class="bg-gradient-to-r from-brand-orange/10 via-brand-orange/[0.02] to-transparent border-l-4 border-brand-orange p-10 shadow-xl">
                    <div class="flex items-center gap-8">
                        <span class="text-brand-orange font-bebas text-5xl leading-none">11.2</span>
                        <div>
                            <h3 class="font-bebas text-4xl text-white leading-none uppercase tracking-[2px] mb-2">Aceptación de los Incentivos</h3>
                            <p class="text-gray-400 text-[11px] uppercase tracking-[4px] font-bold">Formalización de convenios para proyectos seleccionados</p>
                        </div>
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
                        INSCRÍBETE AHORA
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
                CONDICIONES DE PARTICIPACIÓN
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

        /** * MANEJO DE EXPLICITACIÓN DE PÁGINA (ERROR 419)
         * Captura el fallo de sesión antes de que Livewire muestre su modal por defecto.
         */
        document.addEventListener('livewire:init', () => {
            Livewire.hook('request', ({
                fail
            }) => {
                fail(({
                    status,
                    preventDefault
                }) => {
                    if (status === 419) {
                        preventDefault(); // BLOQUEA el modal de error por defecto

                        // Recarga la página para obtener un nuevo token CSRF
                        // Esto mantiene al usuario en el flujo sin mensajes técnicos extraños
                        window.location.reload();

                        return false;
                    }
                });
            });
        });

        document.addEventListener('DOMContentLoaded', () => {
            const navLinks = document.querySelectorAll('.nav-link-scroll');
            const sections = document.querySelectorAll('section[id]');
            const mobileMenuBtn = document.getElementById('mobile-menu');
            const navLinksContainer = document.querySelector('.nav-links');

            // Lógica para el menú móvil (abrir/cerrar)
            if (mobileMenuBtn) {
                mobileMenuBtn.addEventListener('click', () => {
                    navLinksContainer.classList.toggle('-right-full');
                    navLinksContainer.classList.toggle('right-0');
                });
            }

            // Lógica de resaltado (ScrollSpy)
            function changeActiveLink() {
                let current = '';

                // Si estamos arriba del todo (menos de 100px), activar 'inicio'
                if (window.scrollY < 100) {
                    current = 'inicio';
                } else {
                    sections.forEach(section => {
                        const sectionTop = section.offsetTop;
                        // Detectamos la sección activa con un margen de 150px
                        if (window.pageYOffset >= (sectionTop - 150)) {
                            current = section.getAttribute('id');
                        }
                    });
                }

                navLinks.forEach(link => {
                    // Limpiamos clases
                    link.classList.remove('text-brand-orange', 'opacity-100');
                    link.classList.add('text-white', 'opacity-80');

                    // Si el link coincide con la sección actual, pintamos de naranja
                    if (link.getAttribute('href') === `#${current}`) {
                        link.classList.add('text-brand-orange', 'opacity-100');
                        link.classList.remove('text-white', 'opacity-80');
                    }
                });
            }

            window.addEventListener('scroll', changeActiveLink);
            changeActiveLink(); // Ejecutar una vez al inicio

            // Cerrar menú móvil al hacer clic en un link
            navLinks.forEach(link => {
                link.addEventListener('click', () => {
                    navLinksContainer.classList.add('-right-full');
                    navLinksContainer.classList.remove('right-0');
                });
            });
        });
    </script>
</body>

</html>