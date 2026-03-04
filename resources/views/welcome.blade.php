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
    {{-- TOOLBAR LATERAL: SINGLE COMMS LINK // INTERFAZ DE CONTACTO UNIFICADA --}}
    <div class="fixed right-6 top-1/2 -translate-y-1/2 z-[100] flex flex-col items-center gap-6">

        {{-- Etiqueta de señal vertical --}}
        <div class="flex flex-col items-center gap-2 mb-4">
            <span class="font-mono text-[8px] text-brand-orange tracking-[4px] uppercase rotate-180 [writing-mode:vertical-lr] font-bold animate-pulse">
                Signal_Stable
            </span>
            <div class="w-[2px] h-12 bg-gradient-to-t from-brand-orange to-transparent"></div>
        </div>

        {{-- BOTÓN: WHATSAPP & LLAMADA (UNIFICADO) --}}
        <div class="group relative flex flex-col items-center">
            <a href="https://wa.me/573156896774" target="_blank"
                class="relative flex items-center justify-center w-14 h-14 bg-black/90 backdrop-blur-xl border-2 border-white/10 text-white hover:text-brand-orange hover:border-brand-orange hover:scale-110 transition-all duration-500 shadow-[0_0_30px_rgba(0,0,0,0.8)]">

                {{-- Tooltip técnico --}}
                <span class="absolute right-16 bg-black border border-brand-orange/40 text-white font-mono text-[10px] px-4 py-2 whitespace-nowrap opacity-0 group-hover:opacity-100 transition-all duration-300 translate-x-4 group-hover:translate-x-0 tracking-[2px]">
                    [ LINK_WA: +57 315 689 6774 ]
                </span>

                <i class="fa-brands fa-whatsapp text-2xl"></i>
            </a>
            <span class="font-mono text-[8px] text-white/30 uppercase mt-2 tracking-[2px]">Comms</span>
        </div>

        {{-- BOTÓN: CORREO ELECTRÓNICO --}}
        <div class="group relative flex flex-col items-center">
            <a href="mailto:incentivos@actores.org.co"
                class="relative flex items-center justify-center w-14 h-14 bg-black/90 backdrop-blur-xl border-2 border-white/10 text-white hover:text-brand-orange hover:border-brand-orange hover:scale-110 transition-all duration-500 shadow-[0_0_30px_rgba(0,0,0,0.8)]">

                {{-- Tooltip técnico --}}
                <span class="absolute right-16 bg-black border border-brand-orange/40 text-white font-mono text-[10px] px-4 py-2 whitespace-nowrap opacity-0 group-hover:opacity-100 transition-all duration-300 translate-x-4 group-hover:translate-x-0 tracking-[2px]">
                    [ MAIL: INCENTIVOS@ACTORES ]
                </span>

                <i class="fa-regular fa-envelope text-2xl"></i>
            </a>
            <span class="font-mono text-[8px] text-white/30 uppercase mt-2 tracking-[2px]">Email</span>
        </div>

        {{-- Decoración inferior: Pulso de datos --}}
        <div class="mt-4 flex flex-col items-center gap-1">
            <div class="w-1 h-1 bg-brand-orange rounded-full animate-ping"></div>
            <div class="w-1 h-1 bg-brand-orange/40 rounded-full"></div>
            <div class="w-1 h-1 bg-brand-orange/10 rounded-full"></div>
        </div>
    </div>

    {{-- FontAwesome para los iconos (si no lo tienes ya) --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    {{-- BANNER DE PRIVACIDAD Y CONFIANZA: SEGURIDAD DE DATOS --}}
    <div id="legal-banner" class="fixed bottom-0 left-0 w-full z-[100] transform translate-y-full transition-transform duration-700 ease-out">

        {{-- Contenedor Principal --}}
        <div class="bg-black/95 backdrop-blur-xl border-t-4 border-brand-orange px-6 py-6 md:py-4 shadow-[0_-20px_50px_rgba(0,0,0,0.5)]">

            <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-6">

                {{-- Lado Izquierdo: Icono y Texto --}}
                <div class="flex items-center gap-5">
                    <div class="hidden md:flex items-center justify-center w-12 h-12 border border-brand-orange/30 rounded-full animate-pulse">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-brand-orange" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>

                    <div class="text-center md:text-left">
                        <span class="block font-mono text-[10px] text-brand-orange tracking-[3px] uppercase font-black mb-1">
                            Protocolo de Protección de Datos // Ley 1581
                        </span>
                        <p class="text-white/70 font-mono text-[9px] md:text-[11px] leading-tight uppercase tracking-wider">
                            Este sitio utiliza cookies técnicas para garantizar la integridad de su postulación.
                            Al continuar, acepta nuestro <a href="https://actores.org.co/storage/app/media/documentos/socios/politica_proteccion_datos.pdf" target="_blank class="text-white underline hover:text-brand-orange transition-colors">Tratamiento de Datos Personales</a>.
                        </p>
                    </div>
                </div>

                {{-- Lado Derecho: Botones de Acción --}}
                <div class="flex items-center gap-4 w-full md:w-auto">
                    <button onclick="acceptLegal()" class="flex-1 md:flex-none bg-white text-black font-bebas text-xl px-8 py-2 border-2 border-white hover:bg-brand-orange hover:border-brand-orange transition-all duration-300 tracking-widest">
                        ACEPTAR_CONTINUAR
                    </button>
                    <button onclick="acceptLegal()" class="hidden md:block text-white/40 hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

            </div>
        </div>

        {{-- Decoración: Código de barras sutil --}}
        <div class="absolute top-0 right-10 h-full w-20 bg-[repeating-linear-gradient(90deg,transparent,transparent_2px,rgba(255,255,255,0.05)_2px,rgba(255,255,255,0.05)_4px)] pointer-events-none"></div>
    </div>

    <script>
        // Mostrar el banner con un pequeño delay después de que cargue la página
        window.addEventListener('load', () => {
            setTimeout(() => {
                const banner = document.getElementById('legal-banner');
                banner.style.transform = 'translateY(0)';
            }, 2000);
        });

        function acceptLegal() {
            const banner = document.getElementById('legal-banner');
            banner.style.transform = 'translateY(100%)';
            // Aquí podrías guardar en localStorage para que no vuelva a aparecer
            localStorage.setItem('legal_accepted', 'true');
        }
    </script>

    <style>
        .font-bebas {
            font-family: 'Bebas Neue', sans-serif;
        }
    </style>

    {{-- NAVEGACIÓN CINEMATOGRÁFICA: THE MASTER CUT --}}
    <nav class="fixed top-0 left-0 w-full z-[1000] flex justify-between items-center px-6 py-6 md:px-16 bg-black/90 border-b-2 border-white/5 backdrop-blur-xl transition-all duration-500">

        {{-- MARCAS DE ENCUADRE DECORATIVAS (ESQUINAS) --}}
        <div class="absolute top-2 left-2 w-4 h-4 border-t border-l border-brand-orange/20 opacity-0 md:opacity-100"></div>
        <div class="absolute top-2 right-2 w-4 h-4 border-t border-r border-brand-orange/20 opacity-0 md:opacity-100"></div>

        {{-- LOGO Y BRANDING: IMPACTO VISUAL --}}
        <a href="{{ url('/') }}" class="flex items-center gap-4 md:gap-6 group no-underline shrink-0">
            <div class="relative py-1">
                <img src="{{ asset('resources/imagenes/logo.png') }}" alt="Logo Actores SCG" class="h-[50px] md:h-[70px] w-auto object-contain transition-all duration-700 group-hover:rotate-[-5deg] group-hover:scale-110">
                {{-- Indicador de señal activa --}}
                <div class="absolute -top-1 -right-1 w-2 h-2 bg-brand-orange rounded-full animate-ping opacity-75"></div>
            </div>

            <div class="h-12 w-[2px] bg-gradient-to-b from-transparent via-brand-orange/40 to-transparent hidden sm:block"></div>

            <div class="flex flex-col justify-center">
                <span class="font-bebas text-2xl md:text-4xl text-brand-orange tracking-[2px] leading-none transition-colors group-hover:text-white">
                    ACTORES S.C.G.
                </span>
                <span class="text-[9px] md:text-[10px] font-black text-gray-500 tracking-[4px] uppercase leading-tight hidden sm:block">
                    Sociedad de Gestión
                </span>
            </div>
        </a>

        {{-- BOTÓN MENÚ MÓVIL: ESTILO OSD --}}
        <div class="flex flex-col gap-[8px] cursor-pointer lg:hidden z-[1100] group" id="mobile-menu">
            <span class="w-[35px] h-[3px] bg-brand-orange transition-all duration-300"></span>
            <span class="w-[25px] h-[3px] bg-white ml-auto transition-all duration-300 group-hover:w-[35px]"></span>
            <span class="w-[35px] h-[3px] bg-brand-orange transition-all duration-300"></span>
        </div>

        {{-- ENLACES: CRÉDITOS DE CABECERA --}}
        <ul class="nav-links fixed lg:static top-0 -right-full lg:right-0 w-full lg:w-auto h-screen lg:h-auto bg-black/98 lg:bg-transparent flex flex-col lg:flex-row justify-center lg:justify-end items-center gap-10 lg:gap-8 xl:gap-12 transition-all duration-700 z-[1000] list-none px-10">

            {{-- LINKS CON EFECTO DE LENTE --}}
            @php
            $navItems = [
            ['url' => '#inicio', 'label' => 'INICIO'],
            ['url' => '#convocatoria', 'label' => 'CONVOCATORIA'],
            ['url' => '#cronograma', 'label' => 'CRONOGRAMA'],
            ['url' => '#anexos', 'label' => 'PREPÁRATE'],
            ['url' => '#pasos', 'label' => 'POSTULACIÓN']
            ];
            @endphp

            @foreach($navItems as $item)
            <li class="relative overflow-hidden group">
                <a href="{{ $item['url'] }}" class="nav-link-scroll no-underline text-white font-bebas text-[2.5rem] lg:text-xl xl:text-2xl tracking-[2px] hover:text-brand-orange transition-all duration-300 block">
                    {{ $item['label'] }}
                </a>
                <span class="absolute bottom-0 left-0 w-full h-[2px] bg-brand-orange -translate-x-full group-hover:translate-x-0 transition-transform duration-500"></span>
            </li>
            @endforeach

            {{-- RUTA FIJA: VER INSCRITOS --}}
            <li class="lg:border-l lg:border-white/10 lg:pl-8">
                <a href="{{ route('inscritos.publico') }}"
                    class="no-underline font-bebas text-[2.5rem] lg:text-xl xl:text-2xl tracking-[2px] transition-all duration-300 
                {{ request()->routeIs('inscritos.publico') ? 'text-brand-orange underline underline-offset-8 decoration-2' : 'text-white hover:text-brand-orange' }}">
                    VER INSCRITOS
                </a>
            </li>

            {{-- BOTÓN DE ACCIÓN: THE CALL TO ACTION --}}
            <li class="lg:ml-6 mt-10 lg:mt-0">
                @auth
                <a href="{{ route('dashboard') }}" class="no-underline text-black font-bebas text-[2.2rem] lg:text-lg xl:text-xl tracking-[2px] bg-white lg:bg-brand-orange px-10 py-4 lg:px-6 lg:py-2.5 transition-all duration-500 flex items-center gap-4 shadow-[0_0_20px_rgba(255,255,255,0.1)] hover:bg-white group">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="w-10 h-10 lg:w-5 lg:h-5 transition-transform group-hover:scale-125">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M6 21l12 -9" />
                        <path d="M6 12l12 9" />
                        <path d="M5 12h14" />
                        <path d="M6 3v9" />
                        <path d="M18 3v9" />
                        <path d="M6 8h12" />
                        <path d="M6 5h12" />
                    </svg>
                    <span class="uppercase">VER MI ESTADO</span>
                </a>
                @else
                <a href="{{ route('validar-socio') }}" class="no-underline text-black font-bebas text-[2.2rem] lg:text-lg xl:text-xl tracking-[2px] bg-white lg:bg-brand-orange px-10 py-4 lg:px-6 lg:py-2.5 transition-all duration-500 flex items-center gap-4 shadow-[0_0_20px_rgba(255,100,0,0.3)] hover:bg-white group">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="w-10 h-10 lg:w-5 lg:h-5 transition-transform group-hover:rotate-12">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M6 21l12 -9" />
                        <path d="M6 12l12 9" />
                        <path d="M5 12h14" />
                        <path d="M6 3v9" />
                        <path d="M18 3v9" />
                        <path d="M6 8h12" />
                        <path d="M6 5h12" />
                    </svg>
                    <span class="uppercase">POSTÚLATE AQUÍ</span>
                </a>
                @endauth
            </li>
        </ul>

        {{-- ELEMENTO DECORATIVO: ESCALA DE NIVELES (DERECHA) --}}
        <div class="hidden xl:flex absolute right-4 top-1/2 -translate-y-1/2 flex-col gap-1 opacity-20">
            @for ($i = 0; $i < 5; $i++)
                <div class="w-4 h-[2px] bg-white">
        </div>
        @endfor
        <div class="w-4 h-[2px] bg-brand-orange"></div>
        </div>
    </nav>



    {{-- HERO: CINEMATIC ENGINE // 100VH // INFOGRAFÍA TÉCNICA --}}
    <section id="hero-cine-master" class="relative h-screen w-full flex items-center justify-center bg-[#000] overflow-hidden border-b-8 border-black">

        {{-- 1. FONDO CON MOVIMIENTO (SLOW ZOOM) --}}
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1478720568477-152d9b164e26?auto=format&fit=crop&q=80&w=2400"
                class="w-full h-full object-cover opacity-40 grayscale contrast-125 brightness-50 animate-[slowzoom_20s_linear_infinite]" alt="Cine Set">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,transparent_0%,#000_100%)] opacity-90"></div>
        </div>

        {{-- 2. HUD DE CÁMARA --}}
        <div class="absolute inset-0 z-10 pointer-events-none p-6 md:p-10">
            <div class="absolute top-8 left-1/2 -translate-x-1/2 flex items-center gap-4 bg-black/60 backdrop-blur-sm px-4 py-1.5 border border-white/10">
                <span class="w-2.5 h-2.5 bg-red-600 rounded-full animate-pulse shadow-[0_0_10px_red]"></span>
                <span class="font-mono text-[10px] text-white tracking-[4px] font-bold uppercase">REC_MASTER_2026</span>
            </div>
            <div class="absolute bottom-8 left-1/2 -translate-x-1/2">
                <span class="font-mono text-xs text-brand-orange tracking-[6px] font-bold animate-[blink_2s_infinite]">TC: 00:20:26:03</span>
            </div>
        </div>

        {{-- 3. CONTENIDO CENTRAL --}}
        <div class="relative z-20 w-full max-w-7xl mx-auto px-6 h-full flex flex-col items-center justify-center">

            {{-- TÍTULO: BLANCO Y NARANJA --}}
            <div class="mb-10 text-center">
                <span class="font-mono text-[10px] text-brand-orange tracking-[10px] uppercase block mb-3 opacity-80 italic">// Fomento a la Creación //</span>
                <h1 class="font-bebas text-[5.5rem] md:text-[8rem] lg:text-[10rem] leading-[0.85] tracking-tighter uppercase select-none">
                    <span class="text-white">INCEN</span><span class="text-brand-orange">TIVOS</span><br>
                    <span class="text-brand-orange">AUDIO</span><span class="text-white">VISUALES</span>
                </h1>
            </div>

            {{-- BLOQUE DE DATOS CLAROS (ESTILO DOCUMENTACIÓN) --}}
            <div class="w-full grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-4 mb-12">

                {{-- Tarjeta 1: Cupos --}}
                <div class="bg-white/5 backdrop-blur-md border-l-4 border-white p-6 md:p-8 transform transition-transform hover:scale-105">
                    <span class="text-brand-orange text-[10px] font-black uppercase tracking-[4px] mb-4 block italic">Capacidad_Máxima</span>
                    <h4 class="font-bebas text-7xl text-white mb-2 leading-none uppercase">03 <span class="text-2xl">Cupos</span></h4>
                    <p class="text-white/60 text-[10px] font-bold leading-tight uppercase tracking-[2px]">
                        Seleccionados mediante <span class="bg-white text-black px-1 italic">comité evaluador</span> externo especializado.
                    </p>
                </div>

                {{-- Tarjeta 2: Bolsa (Destacada) --}}
                <div class="bg-brand-orange/10 backdrop-blur-md border-l-4 border-brand-orange p-6 md:p-8 transform scale-105 shadow-2xl">
                    <span class="text-brand-orange text-[10px] font-black uppercase tracking-[4px] mb-4 block italic">Bolsa_Global_COP</span>
                    <h4 class="font-bebas text-7xl text-white mb-2 leading-none uppercase">$135<span class="text-brand-orange italic">M</span></h4>
                    <p class="text-white/80 text-[10px] font-bold leading-tight uppercase tracking-[2px]">
                        Recurso total destinado para <span class="bg-brand-orange text-black px-1">fomento audiovisual</span> en la edición 2026.
                    </p>
                </div>

                {{-- Tarjeta 3: Asignación --}}
                <div class="bg-white/5 backdrop-blur-md border-l-4 border-white p-6 md:p-8 transform transition-transform hover:scale-105">
                    <span class="text-brand-orange text-[10px] font-black uppercase tracking-[4px] mb-4 block italic">Asignación_X_Obra</span>
                    <h4 class="font-bebas text-7xl text-white mb-2 leading-none uppercase">$45<span class="text-2xl">Millones</span></h4>
                    <p class="text-white/60 text-[10px] font-bold leading-tight uppercase tracking-[2px]">
                        Monto fijo entregado a cada <span class="bg-white text-black px-1 italic">ganador</span> para el desarrollo de su obra.
                    </p>
                </div>

            </div>

            {{-- 4. BOTÓN DE ACCIÓN --}}
            <div class="relative inline-block group">
                <div class="absolute inset-0 bg-brand-orange translate-x-3 translate-y-3 transition-transform group-hover:translate-x-0 group-hover:translate-y-0 shadow-[0_0_40px_rgba(255,102,0,0.4)]"></div>
                <a href="#pasos" class="relative flex items-center gap-10 bg-white text-black px-14 py-7 no-underline font-bebas text-[2.5rem] md:text-[3.2rem] tracking-[8px] border-[4px] border-black transition-all">
                    POSTÚLATE AQUÍ
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 transition-transform group-hover:rotate-45" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            </div>
        </div>

        {{-- TEXTURAS --}}
        <div class="absolute inset-0 pointer-events-none z-30 opacity-[0.04] bg-[url('https://www.transparenttextures.com/patterns/stardust.png')] animate-[filmgrain_10s_linear_infinite]"></div>
    </section>
    {{-- 2. BLOQUE DE PODER: ESPECIFICACIONES TÉCNICAS (CONDICIONES) --}}
    <section id="requisitos" class="relative z-[10] bg-brand-orange pt-24 pb-24 px-6 border-y-[15px] border-black overflow-hidden">

        {{-- MARCA DE AGUA: ESTILO CLAQUETA --}}
        <div class="absolute inset-0 opacity-[0.07] pointer-events-none select-none flex items-center justify-center overflow-hidden">
            <span class="font-bebas text-[25vw] leading-none text-black tracking-[ -0.05em] uppercase whitespace-nowrap">
                INCENTIVOS
            </span>
        </div>

        {{-- ELEMENTOS DE SET (SVG DE APOYO) --}}
        <div class="hidden xl:block absolute left-[-50px] top-1/2 -translate-y-1/2 opacity-20 transform -rotate-12 transition-transform hover:rotate-0 duration-700">
            <img src="{{ asset('resources/imagenes/claqueta.svg') }}" class="w-[30rem]" alt="Claqueta">
        </div>
        <div class="hidden xl:block absolute right-[-50px] top-1/2 -translate-y-1/2 opacity-20 transform rotate-12 transition-transform hover:rotate-0 duration-700">
            <img src="{{ asset('resources/imagenes/camara.svg') }}" class="w-[30rem]" alt="Cámara">
        </div>

        <div class="relative z-10 max-w-6xl mx-auto text-center">

            {{-- ETIQUETA DE CATEGORÍA --}}
            <div class="inline-block bg-black text-brand-orange px-4 py-1 font-mono text-xs tracking-[5px] uppercase mb-6 font-bold shadow-xl">
                Technical_Specifications // Vol_01
            </div>

            {{-- TÍTULO PRINCIPAL: IMPACTO TOTAL --}}
            <h2 class="font-bebas text-[5rem] md:text-[8rem] lg:text-[10rem] text-black leading-[0.8] tracking-tighter uppercase mb-8">
                CONDICIONES DE <br>
                <span class="relative">
                    PARTICIPACIÓN
                    {{-- Subrayado tipo marcador --}}
                    <div class="absolute -bottom-2 left-0 w-full h-4 bg-black/10 -z-10"></div>
                </span>
            </h2>

            {{-- DESCRIPCIÓN TÉCNICA --}}
            <div class="max-w-2xl mx-auto border-t-4 border-black pt-8 mb-16">
                <p class="text-black font-black uppercase text-xl md:text-2xl tracking-tighter leading-tight">
                    Lee detenidamente los lineamientos legales <br class="hidden md:block">
                    y técnicos para la postulación de tu obra.
                </p>
                <p class="font-mono text-[10px] text-black/60 tracking-[4px] mt-4 uppercase font-bold">
                    Actualizado: Marzo 2026 // Bogotá, Col
                </p>
            </div>

            {{-- BOTÓN DE DESCARGA: ESTILO INDUSTRIAL --}}
            <div class="w-full max-w-lg mx-auto relative group">
                {{-- Sombra de profundidad --}}
                <div class="absolute inset-0 bg-black translate-x-4 translate-y-4 transition-transform group-hover:translate-x-0 group-hover:translate-y-0"></div>

                <a href="{{ asset('storage/formatos/condiciones-de-participacion.pdf') }}"
                    target="_blank"
                    class="relative flex items-center justify-center gap-6 bg-white text-black px-8 py-10 no-underline border-[5px] border-black transition-all duration-300">

                    {{-- Icono animado --}}
                    <div class="bg-black p-4 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-white animate-bounce" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                    </div>

                    <div class="text-left">
                        <span class="block font-bebas text-[2.5rem] leading-none tracking-[2px]">DESCARGAR PDF</span>
                        <span class="block font-mono text-[10px] font-bold tracking-[2px] opacity-60">LINEAMIENTOS_OFICIALES.EXE</span>
                    </div>
                </a>
            </div>

            {{-- NOTA AL PIE TIPO SCRIPT --}}
            <div class="mt-20 flex justify-center gap-12 opacity-40 grayscale">
                <div class="flex flex-col items-center">
                    <span class="font-mono text-[9px] font-bold tracking-[3px]">FORMATO</span>
                    <span class="font-bebas text-2xl uppercase">Digital_PDF</span>
                </div>
                <div class="w-px h-12 bg-black/20"></div>
                <div class="flex flex-col items-center">
                    <span class="font-mono text-[9px] font-bold tracking-[3px]">PESO</span>
                    <span class="font-bebas text-2xl uppercase">2.4_MB</span>
                </div>
                <div class="w-px h-12 bg-black/20"></div>
                <div class="flex flex-col items-center">
                    <span class="font-mono text-[9px] font-bold tracking-[3px]">ACCESO</span>
                    <span class="font-bebas text-2xl uppercase">Public_Doc</span>
                </div>
            </div>
        </div>
    </section>

    <style>
        /* Efecto de grano sutil también en la sección naranja para coherencia */
        #requisitos::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image: url('https://www.transparenttextures.com/patterns/stardust.png');
            opacity: 0.15;
            pointer-events: none;
        }
    </style>
    <style>
        #hero-cine-master {
            height: 100vh;
        }

        @keyframes slowzoom {
            0% {
                transform: scale(1);
            }

            100% {
                transform: scale(1.15);
            }
        }

        @keyframes blink {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.3;
            }
        }

        @keyframes filmgrain {

            0%,
            100% {
                transform: translate(0, 0);
            }

            10% {
                transform: translate(-2%, -1%);
            }

            30% {
                transform: translate(1%, 2%);
            }

            50% {
                transform: translate(-1%, -2%);
            }
        }

        .font-bebas {
            font-family: 'Bebas Neue', sans-serif;
        }
    </style>


    {{-- Contenido Principal --}}
    <div class="max-w-[1100px] mx-auto px-6 py-24">
        {{-- Convocatoria --}}
        <section id="convocatoria" class="mb-[150px] scroll-mt-[100px] px-4 relative">

            {{-- Elemento Decorativo: Crop Marks (Esquinas de encuadre) --}}
            <div class="absolute top-0 left-0 w-8 h-8 border-t-2 border-l-2 border-brand-orange/30"></div>
            <div class="absolute top-0 right-0 w-8 h-8 border-t-2 border-r-2 border-brand-orange/30"></div>

            {{-- Header con Código de Tiempo --}}
            <div class="mb-24 flex flex-col md:flex-row justify-between items-end gap-6 border-b border-white/10 pb-10">
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <span class="w-3 h-3 bg-red-600 rounded-full animate-pulse"></span>
                        <span class="font-mono text-xs text-red-600 tracking-[4px] uppercase font-bold">Recording_Live</span>
                    </div>
                    <h2 class="font-bebas text-[4.5rem] md:text-[7rem] text-white leading-[0.8] uppercase tracking-tighter">
                        SINOPSIS <br>
                        <span class="text-brand-orange italic">CONVOCATORIA</span>
                    </h2>
                </div>
                <div class="text-right font-mono">
                    <p class="text-brand-orange text-xl md:text-2xl tracking-[5px]">00:20:26:03</p>
                    <p class="text-gray-500 text-[10px] uppercase tracking-widest">Global_System_Status</p>
                </div>
            </div>

            {{-- Grid de Datos Rápidos (Estilo Monitor de Referencia) --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-24">
                {{-- Tarjeta: Bolsa Económica --}}
                <div class="bg-[#111] border border-white/10 p-8 relative overflow-hidden group">
                    <svg class="absolute -right-2 -bottom-2 w-24 h-24 text-white/5 rotate-12" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1.41 16.09V20h-2.82v-1.91c-1.84-.42-3.32-1.57-3.41-3.41h2.18c.08.76.61 1.48 1.46 1.48.89 0 1.46-.51 1.46-1.15 0-1.74-4.27-1.32-4.27-4.14 0-1.19.89-2.22 2.22-2.61V7h2.82v1.94c1.55.31 2.58 1.34 2.76 2.81h-2.2c-.11-.59-.51-1.07-1.35-1.07-.76 0-1.38.37-1.38 1.05 0 1.55 4.27 1.13 4.27 4.09 0 1.1-.87 2.01-2.18 2.22z" />
                    </svg>
                    <span class="font-mono text-[10px] text-brand-orange tracking-widest uppercase mb-4 block underline decoration-brand-orange/40 underline-offset-4">Financiamiento</span>
                    <h3 class="font-bebas text-4xl text-white mb-2 leading-none">BOLSA TOTAL</h3>
                    <p class="font-bebas text-5xl text-brand-orange">$135M</p>
                    <p class="text-[10px] text-gray-500 mt-2 font-bold tracking-widest">3 INCENTIVOS DE $45M COP</p>
                </div>

                {{-- Tarjeta: Requisitos --}}
                <div class="bg-[#111] border border-white/10 p-8 relative overflow-hidden">
                    <span class="font-mono text-[10px] text-brand-orange tracking-widest uppercase mb-4 block underline decoration-brand-orange/40 underline-offset-4">Casting</span>
                    <h3 class="font-bebas text-4xl text-white mb-2 leading-none">REQUISITOS</h3>
                    <p class="text-gray-300 font-bold italic leading-snug">Socio Activo ACTORES S.C.G. + Datos Actualizados.</p>
                    <div class="mt-4 flex gap-1">
                        <div class="w-4 h-1 bg-brand-orange"></div>
                        <div class="w-4 h-1 bg-white/20"></div>
                        <div class="w-4 h-1 bg-white/20"></div>
                    </div>
                </div>

                {{-- Tarjeta: Formato --}}
                <div class="bg-[#111] border border-white/10 p-8 relative overflow-hidden">
                    <span class="font-mono text-[10px] text-brand-orange tracking-widest uppercase mb-4 block underline decoration-brand-orange/40 underline-offset-4">Especificaciones</span>
                    <h3 class="font-bebas text-4xl text-white mb-2 leading-none">GÉNERO Y DURACIÓN</h3>
                    <p class="text-gray-300 font-bold italic leading-snug">Ficción Narrativa <br>7 a 15 Minutos.</p>
                    <span class="absolute top-4 right-4 font-mono text-[10px] text-white/20">4K_RAW_LOG</span>
                </div>
            </div>

            {{-- Contenido Principal con Estética de Guion --}}
            <div class="max-w-5xl mx-auto relative px-6 md:px-0">

                {{-- Línea de Tira de Película Lateral --}}
                <div class="absolute -left-12 top-0 bottom-0 w-8 hidden xl:flex flex-col justify-between py-4 opacity-10">
                    @for ($i = 0; $i < 12; $i++)
                        <div class="w-6 h-4 border-2 border-white rounded-sm">
                </div>
                @endfor
            </div>

            <div class="space-y-16">
                {{-- Párrafo 1 --}}
                <div class="relative group">
                    <p class="text-[1.4rem] md:text-2xl lg:text-3xl text-gray-300 leading-relaxed font-light">
                        La <strong class="text-white">Convocatoria de Incentivos para Creación y Producción Audiovisual 2026</strong> tiene como finalidad otorgar <strong class="text-brand-orange">tres (3) incentivos económicos</strong> destinados a la creación y producción de cortometrajes de ficción liderados por socios activos de <span class="text-white font-bold border-b-2 border-brand-orange">ACTORES S.C.G.</span>
                    </p>
                </div>

                {{-- Bloque Cita: Estética de Claqueta --}}
                <div class="relative bg-white/5 p-10 border-y-2 border-brand-orange group">
                    {{-- SVG Claqueta decorativo --}}
                    <svg class="absolute -top-6 left-1/2 -translate-x-1/2 w-12 h-12 text-brand-orange" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M18 4l2 4h-3l-2-4h-2l2 4h-3l-2-4H8l2 4H7L5 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V4h-4z" />
                    </svg>

                    <p class="text-[1.2rem] md:text-2xl text-center text-white italic font-medium leading-relaxed max-w-3xl mx-auto">
                        "El incentivo constituye un <span class="text-brand-orange">apoyo económico exclusivo</span> para la ejecución del proyecto seleccionado y no genera vínculo laboral, contractual o asociativo."
                    </p>
                </div>

                {{-- Párrafo 3 con Sello de Calidad --}}
                <div class="flex flex-col md:flex-row items-center gap-12">
                    <p class="text-[1.2rem] md:text-xl lg:text-2xl text-gray-400 leading-relaxed flex-grow">
                        La propuesta seleccionada deberá recorrer todas las etapas, garantizando calidad narrativa y viabilidad técnica bajo los estándares de <strong class="text-brand-orange font-bebas text-4xl tracking-widest">ACTORES S.C.G.</strong> desde la inscripción hasta la gran Premier.
                    </p>

                    {{-- Sello SVG de Actores --}}
                    <div class="flex-shrink-0 w-32 h-32 md:w-40 md:h-40 border-4 border-brand-orange/20 rounded-full flex items-center justify-center relative rotate-12 group-hover:rotate-0 transition-transform">
                        <div class="text-center">
                            <span class="font-bebas text-brand-orange text-xl block leading-none tracking-widest">CALIDAD</span>
                            <span class="font-bebas text-white text-3xl block leading-none">A.S.C.G</span>
                            <span class="font-mono text-[8px] text-gray-500 uppercase">Estándar_2026</span>
                        </div>
                        <svg class="absolute inset-0 w-full h-full text-brand-orange/10 animate-[spin_10s_linear_infinite]" viewBox="0 0 100 100">
                            <path id="circlePath" d="M 50, 50 m -37, 0 a 37,37 0 1,1 74,0 a 37,37 0 1,1 -74,0" fill="transparent" />
                            <text class="text-[10px] uppercase tracking-[2px] fill-brand-orange">
                                <textPath xlink:href="#circlePath">
                                    • Incentivos Audiovisuales • Actores SCG • 2026
                                </textPath>
                            </text>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Footer de sección: La fecha con estética de "End Card" --}}
            <div class="mt-24 pt-12 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-[2px] bg-brand-orange"></div>
                    <span class="font-mono text-[10px] tracking-[5px] text-gray-500 uppercase">Ready_to_upload</span>
                </div>
                <p class="font-bebas text-3xl md:text-5xl text-white tracking-widest">
                    APERTURA: <span class="text-brand-orange">09 MARZO</span>
                </p>
                <div class="font-mono text-[10px] text-right opacity-30">
                    SCENE: 01 <br>
                    DATE: FEB_2026
                </div>
            </div>
    </div>

    {{-- Elementos Decorativos: Esquinas inferiores --}}
    <div class="absolute bottom-0 left-0 w-8 h-8 border-b-2 border-l-2 border-brand-orange/30"></div>
    <div class="absolute bottom-0 right-0 w-8 h-8 border-b-2 border-r-2 border-brand-orange/30"></div>
    </section>

    {{-- Cronograma Estilo Tabla de Producción Industrial --}}
    <section id="cronograma" class="mb-[120px] scroll-mt-[100px] px-4">
        {{-- Header de Sección: Estética de Claqueta --}}
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6 border-b-2 border-brand-orange pb-8 relative">
            {{-- Elemento decorativo: Código de tiempo --}}
            <div class="absolute top-0 right-0 font-mono text-brand-orange/20 text-4xl hidden md:block select-none">
                00:20:26:00
            </div>

            <div>
                <span class="text-brand-orange font-mono text-xs font-black tracking-[5px] uppercase block mb-2 animate-pulse">
                    // CRONOGRAMA_DE_PRODUCCIÓN_MASTER
                </span>
                <h2 class="font-bebas text-[5rem] md:text-[8rem] text-white leading-[0.8] uppercase tracking-tighter">
                    CALENDARIO <br class="md:hidden"> <span class="text-brand-orange">INCENTIVOS 2026</span>
                </h2>
            </div>
            <div class="flex flex-col items-end">
                <div class="bg-brand-orange text-black px-8 py-3 font-bebas text-3xl skew-x-[-12deg] mb-2 shadow-[4px_4px_0px_rgba(255,255,255,0.2)]">
                    FECHAS DE RODAJE
                </div>
                <p class="text-gray-500 font-mono tracking-[2px] uppercase text-[10px]">VERSIÓN: 2.0_MARZO_2026</p>
            </div>
        </div>

        {{-- Contenedor Principal: Estética de Monitor de Edición --}}
        <div class="w-full bg-[#050505] text-white font-sans border-x border-t border-white/10 overflow-hidden shadow-2xl">

            {{-- Encabezado de la Tabla --}}
            <div class="bg-white/5 border-b border-white/20 py-8 text-center relative">
                <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')]"></div>
                <h2 class="text-brand-orange font-bebas uppercase tracking-[0.3em] text-3xl md:text-4xl px-4 relative z-10">
                    LÍNEA DE TIEMPO: PROYECTOS SELECCIONADOS
                </h2>
            </div>

            {{-- Cabecera Desktop --}}
            <div class="hidden md:grid grid-cols-12 bg-white/10 border-b-2 border-brand-orange/50">
                <div class="col-span-8 py-4 px-8 border-r border-white/10">
                    <span class="text-brand-orange font-black uppercase tracking-widest text-[11px] flex items-center gap-2">
                        <span class="w-2 h-2 bg-brand-orange rounded-full"></span> DESARROLLO DEL PROCESO
                    </span>
                </div>
                <div class="col-span-4 py-4 px-8 text-right">
                    <span class="text-brand-orange font-black uppercase tracking-widest text-[11px]">VENTANA DE TIEMPO</span>
                </div>
            </div>

            <div class="divide-y divide-white/10">

                {{-- ETAPA I --}}
                <div class="grid grid-cols-1 md:grid-cols-12 group">
                    <div class="md:col-span-2 flex flex-col items-center justify-center border-b md:border-b-0 md:border-r border-white/10 bg-white/[0.01] py-8 group-hover:bg-brand-orange/5 transition-colors">
                        <span class="font-bebas text-5xl text-brand-orange tracking-tighter leading-none">ETAPA I</span>
                        <span class="text-[9px] font-black text-gray-500 uppercase tracking-widest mt-2">Inscripción</span>
                    </div>
                    <div class="md:col-span-10 divide-y divide-white/5">
                        <div class="grid grid-cols-1 md:grid-cols-10 items-center py-8 px-8 hover:bg-white/[0.03] transition-colors gap-4">
                            <div class="md:col-span-6 text-xl md:text-2xl font-bold uppercase tracking-tight text-gray-200">Inscripción de los proponentes</div>
                            <div class="md:col-span-4 md:text-right text-3xl md:text-4xl font-bebas text-white tracking-wider italic">9 al 23 de marzo</div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-10 items-center py-6 px-8 hover:bg-white/[0.03] transition-colors gap-2 opacity-70">
                            <div class="md:col-span-6 text-lg text-gray-400 italic">Publicación proponentes que deben subsanar Etapa I</div>
                            <div class="md:col-span-4 md:text-right text-2xl font-mono font-bold text-gray-300">15 de abril</div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-10 items-center py-6 px-8 hover:bg-white/[0.03] transition-colors gap-2">
                            <div class="md:col-span-6 text-lg text-gray-300">Recepción de subsanaciones Etapa I</div>
                            <div class="md:col-span-4 md:text-right text-2xl font-mono font-bold text-brand-orange/80">16 al 24 de abril</div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-10 items-center py-6 px-8 hover:bg-white/[0.03] transition-colors gap-2">
                            <div class="md:col-span-6 text-lg text-gray-300">Publicación de proponentes que pasan a la Etapa II</div>
                            <div class="md:col-span-4 md:text-right text-2xl font-mono font-bold text-white border-b border-brand-orange/30 w-fit md:ml-auto">11 de mayo</div>
                        </div>
                    </div>
                </div>

                {{-- ETAPA II --}}
                <div class="grid grid-cols-1 md:grid-cols-12 group">
                    <div class="md:col-span-2 flex flex-col items-center justify-center border-b md:border-b-0 md:border-r border-white/10 bg-white/[0.01] py-8 group-hover:bg-brand-orange/5 transition-colors">
                        <span class="font-bebas text-5xl text-brand-orange tracking-tighter leading-none">ETAPA II</span>
                        <span class="text-[9px] font-black text-gray-500 uppercase tracking-widest mt-2">Técnica</span>
                    </div>
                    <div class="md:col-span-10 divide-y divide-white/5">
                        <div class="grid grid-cols-1 md:grid-cols-10 items-center py-10 px-8 hover:bg-white/[0.03] transition-colors gap-4">
                            <div class="md:col-span-6 text-xl md:text-2xl font-bold uppercase tracking-tight text-gray-200">Recepciones de guiones y documentos de la Etapa II</div>
                            <div class="md:col-span-4 md:text-right text-3xl md:text-4xl font-bebas text-white tracking-wider italic leading-none">
                                13 de mayo <br> <span class="text-xs text-brand-orange tracking-[4px] uppercase font-mono">(único día)</span>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-10 items-center py-8 px-8 hover:bg-white/[0.03] transition-colors gap-2">
                            <div class="md:col-span-6 text-lg text-gray-400 italic">Publicación de proponentes que pasan a la Etapa III</div>
                            <div class="md:col-span-4 md:text-right text-2xl font-mono font-bold text-white">4 de junio</div>
                        </div>
                    </div>
                </div>

                {{-- ETAPA III --}}
                <div class="grid grid-cols-1 md:grid-cols-12 items-center py-12 px-8 hover:bg-white/[0.03] transition-colors gap-4">
                    <div class="md:col-span-2 md:border-r border-white/10 md:pr-4 flex flex-col items-center md:items-start">
                        <span class="font-bebas text-5xl text-brand-orange tracking-tighter leading-none">ETAPA III</span>
                        <span class="text-[9px] font-black text-gray-500 uppercase tracking-widest mt-1">Jurados</span>
                    </div>
                    <div class="md:col-span-6 md:px-6 text-xl md:text-2xl font-bold uppercase tracking-tight text-center md:text-left text-gray-200">Revisión de guiones y documentación por jurados externos</div>
                    <div class="md:col-span-4 md:text-right text-center text-3xl md:text-4xl font-bebas text-white tracking-wider italic">6 al 24 de junio</div>
                </div>

                {{-- ETAPA IV --}}
                <div class="grid grid-cols-1 md:grid-cols-12 items-center py-12 px-8 hover:bg-white/[0.03] transition-colors gap-4">
                    <div class="md:col-span-2 md:border-r border-white/10 md:pr-4 flex flex-col items-center md:items-start">
                        <span class="font-bebas text-5xl text-brand-orange tracking-tighter leading-none">ETAPA IV</span>
                        <span class="text-[9px] font-black text-gray-500 uppercase tracking-widest mt-1">Selección</span>
                    </div>
                    <div class="md:col-span-6 md:px-6 text-xl md:text-2xl font-bold uppercase tracking-tight text-center md:text-left text-gray-200">Publicación de proponentes seleccionados</div>
                    <div class="md:col-span-4 md:text-right text-center text-4xl md:text-5xl font-bebas text-brand-orange tracking-widest border-b-2 border-brand-orange w-fit md:ml-auto">30 de junio</div>
                </div>

                {{-- PRODUCCIÓN --}}
                <div class="grid grid-cols-1 md:grid-cols-12 items-center py-14 px-8 bg-brand-orange/5 border-y border-brand-orange/20 hover:bg-brand-orange/10 transition-colors gap-4">
                    <div class="md:col-span-8 md:px-6 text-2xl md:text-4xl font-bebas uppercase tracking-[2px] text-center md:text-left text-brand-orange">Producción del contenido audiovisual</div>
                    <div class="md:col-span-4 md:text-right text-center text-3xl md:text-4xl font-bebas text-white tracking-widest italic">1 de julio al 29 de septiembre</div>
                </div>

                {{-- ENTREGA --}}
                <div class="grid grid-cols-1 md:grid-cols-12 items-center py-14 px-8 hover:bg-white/[0.03] transition-colors gap-4">
                    <div class="md:col-span-8 md:px-6 text-xl md:text-2xl font-bold uppercase tracking-tight text-center md:text-left text-gray-300">Entrega del contenido audiovisual y documentación adicional</div>
                    <div class="md:col-span-4 md:text-right text-center text-3xl md:text-4xl font-bebas text-white tracking-wider italic leading-none">
                        30 de septiembre <br> <span class="text-[10px] text-brand-orange tracking-[4px] uppercase font-mono">(único día)</span>
                    </div>
                </div>


                {{-- PREMIER: PROPUESTA "POSTER DE CIERRE" - ANTI-COLISIÓN TOTAL --}}
                <div class="w-full bg-white text-black p-8 md:p-16 relative overflow-hidden shadow-2xl border-t-8 border-black">

                    {{-- Marca de Agua Superior (Estilo Cinta de Película) --}}
                    <div class="absolute top-0 left-0 w-full h-12 bg-black flex items-center justify-around opacity-[0.03] pointer-events-none select-none">
                        @for ($i = 0; $i < 10; $i++)
                            <span class="font-bebas text-2xl italic tracking-widest">ACTORES SCG // INCENTIVOS 2026</span>
                            @endfor
                    </div>

                    <div class="relative z-10 flex flex-col items-center text-center">

                        {{-- 1. Encabezado Técnico --}}
                        <div class="mb-6">
                            <span class="inline-block border-2 border-black px-4 py-1 font-mono text-[10px] md:text-xs font-black uppercase tracking-[5px]">
                                Evento de Clausura • Temporada 2026
                            </span>
                        </div>

                        {{-- 2. Título con Subrayado Cinematográfico --}}
                        <h2 class="font-bebas text-8xl md:text-[10rem] lg:text-[12rem] leading-[0.8] tracking-tighter mb-4">
                            PREMIER
                        </h2>

                        {{-- 3. Línea Divisoria Estilo "Corte de Película" --}}
                        <div class="w-full max-w-2xl flex items-center gap-4 mb-8">
                            <div class="flex-grow h-[2px] bg-black/10"></div>
                            <div class="flex-shrink-0">
                                <svg class="w-8 h-8 opacity-20" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M18 4l2 4h-3l-2-4h-2l2 4h-3l-2-4H8l2 4H7L5 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V4h-4z" />
                                </svg>
                            </div>
                            <div class="flex-grow h-[2px] bg-black/10"></div>
                        </div>

                        {{-- 4. Descripción: Ahora centrada y con aire --}}
                        <div class="max-w-2xl mb-12">
                            <h4 class="font-bebas text-3xl md:text-4xl uppercase tracking-tight mb-3">
                                Exhibición pública y gala de premios
                            </h4>
                            <p class="text-sm md:text-lg font-bold italic opacity-60 leading-tight uppercase tracking-widest">
                                Estreno oficial de los cortometrajes ante la industria <br class="hidden md:block"> y socios de Actores Sociedad Colombiana de Gestión.
                            </p>
                        </div>

                        {{-- 5. FECHA: La protagonista absoluta --}}
                        <div class="relative py-10 w-full flex flex-col items-center">
                            {{-- Marca de agua de fondo específica para la fecha --}}
                            <div class="absolute inset-0 flex items-center justify-center opacity-[0.04] pointer-events-none scale-150">
                                <span class="font-bebas text-[15rem] md:text-[25rem]">2026</span>
                            </div>

                            <span class="block text-brand-orange text-xs font-black uppercase tracking-[10px] mb-4">Gran Lanzamiento</span>

                            {{-- OCTUBRE: Espacio infinito, sin cortes. Usamos line-height de 1.2 para seguridad --}}
                            <h3 class="font-bebas text-[6rem] sm:text-[9rem] md:text-[12rem] lg:text-[15rem] leading-[1] tracking-normal text-black transition-all hover:text-brand-orange">
                                OCTUBRE
                            </h3>

                            <div class="mt-4 px-10 py-2 border-x-2 border-black inline-block">
                                <span class="font-mono text-[10px] md:text-xs tracking-[5px] uppercase opacity-40">Bogotá, Colombia • Centro Camaleón</span>
                            </div>
                        </div>
                    </div>

                    {{-- Esquinas de diseño técnico --}}
                    <div class="absolute bottom-4 left-4 font-mono text-[8px] opacity-20 uppercase tracking-widest">
                        SEC: PREMIER_FINAL / CODE: 04-2026
                    </div>
                    <div class="absolute bottom-4 right-4 font-mono text-[8px] opacity-20 uppercase tracking-widest">
                        © ACTORES S.C.G. TODOS LOS DERECHOS RESERVADOS
                    </div>
                </div>
            </div>
        </div>

        {{-- Decorative Footer: Estética de Cinta de Película --}}
        <div class="mt-8 flex justify-between items-center px-4">
            <div class="flex gap-4 items-center">
                <div class="w-16 h-[2px] bg-brand-orange"></div>
                <div class="flex gap-1">
                    <div class="w-2 h-2 bg-white/20 rounded-full"></div>
                    <div class="w-2 h-2 bg-white/20 rounded-full"></div>
                    <div class="w-2 h-2 bg-brand-orange rounded-full animate-pulse"></div>
                </div>
                <span class="text-brand-orange/50 font-mono text-[9px] tracking-[2px] uppercase hidden md:block">Sistema de Gestión de Incentivos Actores S.C.G.</span>
            </div>
            <span class="text-white/20 font-mono text-[10px] tracking-[4px] uppercase underline decoration-brand-orange/30">REF_ID: 2026_AUDIOVISUAL_PROD</span>
        </div>
    </section>

    {{-- Sección de Cronograma y Etapas --}}
    <section id="anexos" class="mb-[120px] scroll-mt-[100px] max-w-7xl mx-auto px-4 font-outfit">

        {{-- Encabezado Mejorado --}}
        {{-- Encabezado Expandido y Aireado --}}
        <div class="mb-20 border-b border-white/10 pb-16">

            {{-- Fila Superior: Badge y Título Gigante --}}
            <div class="text-center md:text-left mb-12">
                <span class="text-brand-orange font-bold uppercase tracking-[8px] text-sm md:text-base mb-6 block opacity-90">
                    Ruta de participación 2026
                </span>
                <h2 class="font-bebas text-[6rem] md:text-[10rem] lg:text-[12rem] leading-[0.85] mb-8">
                    <span class="text-white">¡PREPÁRATE</span><span class="text-brand-orange">!</span>
                </h2>
            </div>

            {{-- Fila Inferior: Texto descriptivo y Caja de Alerta en Grid --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">

                {{-- Descripción con más interlineado --}}
                <div class="lg:col-span-7">
                    <p class="text-gray-300 text-2xl md:text-3xl uppercase tracking-tight font-light leading-[1.4]">
                        No esperes al día de las inscripciones.
                        <span class="text-white font-medium border-b-4 border-brand-orange/40 pb-1 inline-block mt-2">
                            Descarga aquí los anexos
                        </span>
                        <br class="hidden md:block"> que debes diligenciar por cada etapa.
                    </p>
                </div>

                {{-- Caja Informativa como un "Callout" flotante --}}
                <div class="lg:col-span-5">
                    <div class="relative bg-white/[0.03] backdrop-blur-sm border-l-4 border-brand-orange p-10 shadow-2xl overflow-hidden group">
                        {{-- Signo de exclamación decorativo más integrado --}}
                        <div class="absolute -right-4 -bottom-6 text-brand-orange/5 font-bebas text-[10rem] select-none group-hover:text-brand-orange/10 transition-colors">!</div>

                        <div class="relative z-10">
                            <div class="flex items-center gap-4 mb-4">
                                <div class="text-brand-orange bg-brand-orange/10 p-2 rounded-sm">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <h4 class="text-white font-bold text-base uppercase tracking-[4px]">Archivos de postulación</h4>
                            </div>

                            <p class="text-gray-400 text-base md:text-lg uppercase leading-relaxed tracking-wide font-medium">
                                Diligenciamiento <span class="text-white font-bold">100% digital</span>.
                                <span class="text-brand-orange font-bold">No modifiques</span> los formatos establecidos.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            {{-- 10.1 ETAPA I --}}
            <details class="group bg-black border-y-2 border-brand-orange/30 transition-all duration-700 ease-in-out" open>
                <summary class="flex items-center justify-between p-10 cursor-pointer list-none select-none hover:bg-brand-orange/[0.02] transition-colors relative overflow-hidden">
                    {{-- Efecto de iluminación de set --}}
                    <div class="absolute top-0 -left-1/4 w-1/2 h-full bg-brand-orange/5 blur-[120px] pointer-events-none"></div>

                    <div class="relative z-10 flex flex-col gap-2">
                        <div class="flex items-center gap-4">
                            <span class="inline-block w-3 h-3 bg-brand-orange animate-pulse rounded-full"></span>
                            <span class="text-brand-orange font-black uppercase tracking-[0.3em] text-xs md:text-sm">Fase de Convocatoria: 01</span>
                        </div>
                        <h3 class="font-bebas text-[4rem] md:text-[6.5rem] text-white leading-[0.85] tracking-tight uppercase">
                            ETAPA I <span class="text-brand-orange opacity-80">-</span> <br class="md:hidden"> INSCRIPCIÓN
                        </h3>
                        <p class="text-gray-500 font-bold text-xs md:text-sm uppercase tracking-[2px]">Verificación de requisitos y soportes iniciales</p>
                    </div>

                    <div class="relative z-10">
                        <div class="w-20 h-20 md:w-24 md:h-24 border border-white/10 flex items-center justify-center group-open:border-brand-orange/50 transition-all duration-500 group-hover:scale-110">
                            <svg class="w-10 h-10 text-white group-open:text-brand-orange group-open:rotate-180 transition-all duration-500 ease-out" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                </summary>

                <div class="px-10 pb-20 pt-10 bg-[#050505]">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                        {{-- Anexo 01 --}}
                        <a href="{{ asset('storage/formatos/etapa_01/anexo-01-manifestacion-del-director.pdf') }}" target="_blank" class="relative overflow-hidden bg-[#0a0a0a] border border-white/5 p-10 group/item transition-all duration-500 hover:border-brand-orange/40">
                            <div class="absolute top-0 right-0 p-4 font-bebas text-5xl text-white/5 group-hover/item:text-brand-orange/20 transition-colors italic">01</div>
                            <div class="relative z-10">
                                <span class="text-brand-orange text-[10px] font-black uppercase tracking-[4px] mb-6 block border-b border-brand-orange/20 pb-2 w-fit">Formato Descargable</span>
                                <h4 class="font-bebas text-3xl text-white mb-8 leading-none tracking-wide group-hover/item:text-brand-orange transition-colors">Manifestación <br> del Director</h4>
                                <div class="flex items-center gap-4 text-white/40 group-hover/item:text-white transition-colors">
                                    <div class="h-[1px] w-8 bg-brand-orange"></div>
                                    <span class="text-[10px] font-bold uppercase tracking-widest">Descargar PDF oficial</span>
                                </div>
                            </div>
                        </a>

                        {{-- Anexo 02 --}}
                        <a href="{{ asset('storage/formatos/etapa_01/anexo-02-experiencia-director-general.pdf') }}" target="_blank" class="relative overflow-hidden bg-[#0a0a0a] border border-white/5 p-10 group/item transition-all duration-500 hover:border-brand-orange/40">
                            <div class="absolute top-0 right-0 p-4 font-bebas text-5xl text-white/5 group-hover/item:text-brand-orange/20 italic">02</div>
                            <div class="relative z-10">
                                <span class="text-brand-orange text-[10px] font-black uppercase tracking-[4px] mb-6 block border-b border-brand-orange/20 pb-2 w-fit">Formato Descargable</span>
                                <h4 class="font-bebas text-3xl text-white mb-8 leading-none tracking-wide group-hover/item:text-brand-orange transition-colors uppercase">Experiencia como <br> Director General</h4>
                                <div class="flex items-center gap-4 text-white/40 group-hover/item:text-white transition-colors">
                                    <div class="h-[1px] w-8 bg-brand-orange"></div>
                                    <span class="text-[10px] font-bold uppercase tracking-widest">Descargar PDF oficial</span>
                                </div>
                            </div>
                        </a>

                        {{-- Bloque de Soportes (El diferente) --}}
                        <div class="relative bg-brand-orange p-10 flex flex-col justify-between shadow-[0_0_40px_rgba(255,102,0,0.1)] group/notes">
                            <div class="absolute top-0 right-0 p-4">
                                <svg class="w-8 h-8 text-black/20" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M13 14.5s2 3 5 3 5-3 5-3V3s-2 3-5 3-5-3-5-3v11.5zM5 14.5s2 3 5 3 5-3 5-3V3s-2 3-5 3-5-3-5-3v11.5z" />
                                </svg>
                            </div>
                            <div>
                                <span class="text-black text-[10px] font-black uppercase tracking-[4px] mb-4 block">Documentación Propia</span>
                                <h4 class="font-bebas text-3xl text-black mb-4 leading-none uppercase">Certificados <br> y Evidencias 1 y 2</h4>
                                <p class="text-black/80 text-sm font-bold leading-tight uppercase tracking-tighter">
                                    Debes preparar <span class="bg-black text-white px-1">2 archivos PDF</span> independientes con tus soportes de experiencia y evidencias visuales.
                                </p>
                            </div>
                            <div class="mt-8 pt-4 border-t border-black/10">
                                <span class="text-[9px] text-black font-black uppercase tracking-widest opacity-60 italic uppercase">No requiere formato de descarga</span>
                            </div>
                        </div>

                        {{-- Anexo 03 (Homogeneizado con descarga) --}}
                        <a href="{{ asset('storage/formatos/etapa_01/anexo-03-autorizacion-uso-de-guion.pdf') }}" target="_blank" class="relative overflow-hidden bg-[#0a0a0a] border border-white/5 p-10 group/item transition-all duration-500 hover:border-brand-orange/40">
                            <div class="absolute top-0 right-0 p-4 font-bebas text-5xl text-white/5 group-hover/item:text-brand-orange/20 italic">03</div>
                            <div class="relative z-10">
                                <span class="text-gray-500 text-[10px] font-black uppercase tracking-[4px] mb-1 block">Requisito Opcional</span>
                                <span class="text-brand-orange/70 text-[9px] font-bold uppercase mb-6 block italic leading-none">Solo autoría de terceros</span>

                                <h4 class="font-bebas text-3xl text-white mb-8 leading-none group-hover/item:text-brand-orange transition-colors uppercase">Autorización <br> Uso de Guion</h4>

                                <div class="flex items-center gap-4 text-white/40 group-hover/item:text-white transition-colors">
                                    <div class="h-[1px] w-8 bg-brand-orange"></div>
                                    <span class="text-[10px] font-bold uppercase tracking-widest">Descargar PDF oficial</span>
                                </div>
                            </div>
                        </a>

                        {{-- Anexo 04 --}}
                        <a href="{{ asset('storage/formatos/etapa_01/anexo-04-consideraciones-y-declaraciones.pdf') }}" target="_blank" class="relative overflow-hidden bg-[#0a0a0a] border border-white/5 p-10 group/item transition-all duration-500 hover:border-brand-orange/40 lg:col-span-2">
                            <div class="absolute top-0 right-0 p-4 font-bebas text-5xl text-white/5 group-hover/item:text-brand-orange/20 italic">04</div>
                            <div class="relative z-10">
                                <span class="text-brand-orange text-[10px] font-black uppercase tracking-[4px] mb-6 block border-b border-brand-orange/20 pb-2 w-fit">Formato Obligatorio</span>
                                <h4 class="font-bebas text-4xl md:text-5xl text-white mb-6 leading-[0.9] group-hover/item:text-brand-orange uppercase max-w-xl">
                                    Consideraciones y declaraciones generales
                                </h4>
                                <div class="flex items-center gap-4 text-white/40 group-hover/item:text-white transition-colors">
                                    <div class="h-[1px] w-12 bg-brand-orange"></div>
                                    <span class="text-[10px] font-bold uppercase tracking-[3px]">Descargar Formato Completo</span>
                                </div>
                            </div>
                        </a>

                    </div>
                </div>
            </details>

            <div class="space-y-6">
                {{-- ETAPA 02: VERIFICACIÓN TÉCNICA --}}
                <div class="relative overflow-hidden bg-[#0a0a0a]/40 border border-white/5 p-10 group transition-all duration-500">
                    {{-- Marca de agua de fondo --}}
                    <div class="absolute -bottom-6 -right-4 font-bebas text-[10rem] text-white/[0.02] select-none">02</div>

                    <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-8">
                        <div class="space-y-2">
                            <div class="flex items-center gap-3">
                                <span class="w-2 h-2 bg-gray-600 rounded-full"></span>
                                <span class="text-gray-500 font-black uppercase tracking-[0.3em] text-[10px]">Módulo en Espera</span>
                            </div>
                            <h3 class="font-bebas text-[3.5rem] md:text-[5rem] text-gray-500 leading-none uppercase tracking-tight">
                                VERIFICACIÓN <span class="text-gray-700">TÉCNICA</span>
                            </h3>
                        </div>

                        {{-- Badge de Disponibilidad Cinematográfico --}}
                        <div class="flex flex-col items-end">
                            <div class="bg-white/[0.03] border border-white/10 px-6 py-4 backdrop-blur-sm relative overflow-hidden group-hover:border-brand-orange/30 transition-colors">
                                <span class="block text-brand-orange/60 text-[9px] font-black uppercase tracking-[3px] mb-1">Anexos disponibles el:</span>
                                <span class="block text-white font-bebas text-3xl tracking-[2px]">25 / ABR / 2026</span>
                                {{-- Línea de carga decorativa --}}
                                <div class="absolute bottom-0 left-0 h-[2px] bg-brand-orange/20 w-full"></div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ETAPA 03: EVALUACIÓN DE JURADOS --}}
                <div class="relative overflow-hidden bg-[#0a0a0a]/40 border border-white/5 p-10 group transition-all duration-500">
                    <div class="absolute -bottom-6 -right-4 font-bebas text-[10rem] text-white/[0.02] select-none">03</div>

                    <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-8">
                        <div class="space-y-2">
                            <div class="flex items-center gap-3">
                                <span class="w-2 h-2 bg-gray-600 rounded-full"></span>
                                <span class="text-gray-500 font-black uppercase tracking-[0.3em] text-[10px]">Módulo en Espera</span>
                            </div>
                            <h3 class="font-bebas text-[3.5rem] md:text-[5rem] text-gray-500 leading-none uppercase tracking-tight">
                                EVALUACIÓN <span class="text-gray-700">DE JURADOS</span>
                            </h3>
                        </div>

                        <div class="flex flex-col items-end">
                            <div class="bg-white/[0.03] border border-white/10 px-6 py-4 backdrop-blur-sm">
                                <span class="block text-brand-orange/60 text-[9px] font-black uppercase tracking-[3px] mb-1">Apertura Programada:</span>
                                <span class="block text-white font-bebas text-3xl tracking-[2px]">14 / MAY / 2026</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ETAPA 04: SELECCIÓN Y PREMIER --}}
                <div class="relative overflow-hidden bg-[#0a0a0a]/40 border border-white/5 p-10 group transition-all duration-500">
                    <div class="absolute -bottom-6 -right-4 font-bebas text-[10rem] text-white/[0.02] select-none">04</div>

                    <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-8">
                        <div class="space-y-2">
                            <div class="flex items-center gap-3">
                                <span class="w-2 h-2 bg-gray-600 rounded-full"></span>
                                <span class="text-gray-500 font-black uppercase tracking-[0.3em] text-[10px]">Módulo en Espera</span>
                            </div>
                            <h3 class="font-bebas text-[3.5rem] md:text-[5rem] text-gray-500 leading-none uppercase tracking-tight">
                                SELECCIÓN <span class="text-gray-700">& PREMIER</span>
                            </h3>
                        </div>

                        <div class="flex flex-col items-end">
                            <div class="bg-white/[0.03] border border-white/10 px-6 py-4 backdrop-blur-sm">
                                <span class="block text-brand-orange/60 text-[9px] font-black uppercase tracking-[3px] mb-1">Evento Final:</span>
                                <span class="block text-white font-bebas text-3xl tracking-[2px]">25 / JUN / 2026</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Pasos e Inscripción Final - Versión Plataforma Digital con Logo de Fondo --}}
    <section id="pasos" class="mb-[120px] scroll-mt-[100px]">
        {{-- Encabezado --}}
        <div class="relative block mb-12">
            <h2 class="font-bebas text-[4rem] md:text-[5rem] text-brand-orange mb-2 border-b-4 border-brand-orange inline-block pb-1">¿CÓMO POSTULARSE?</h2>
            <p class="text-gray-500 font-bold uppercase tracking-[4px] text-sm md:text-base">Revisa las condiciones de participación.</p>
        </div>

        {{-- Grid de Pasos Digitales --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-24 gap-y-20 mb-24 border-t border-white/10 pt-16">

            {{-- Paso 1 --}}
            <div class="flex flex-col md:flex-row gap-8 group">
                <div class="flex-shrink-0">
                    <span class="font-bebas text-7xl text-white opacity-20 group-hover:text-brand-orange group-hover:opacity-100 transition-all duration-500 leading-none">
                        01
                    </span>
                </div>
                <div class="space-y-4">
                    <h4 class="text-white font-bebas text-4xl tracking-[3px] group-hover:translate-x-2 transition-transform duration-300">
                        VALIDACIÓN <span class="text-brand-orange">DE SOCIO</span>
                    </h4>
                    <div class="h-1 w-12 bg-brand-orange/40 group-hover:w-24 transition-all duration-500"></div>
                    <p class="text-gray-400 text-xl md:text-2xl font-light leading-relaxed uppercase tracking-tight max-w-md">
                        Ingresa con tu identificación para confirmar que eres un
                        <strong class="text-white font-medium">socio activo</strong>.
                    </p>
                </div>
            </div>

            {{-- Paso 2 --}}
            <div class="flex flex-col md:flex-row gap-8 group">
                <div class="flex-shrink-0">
                    <span class="font-bebas text-7xl text-white opacity-20 group-hover:text-brand-orange group-hover:opacity-100 transition-all duration-500 leading-none">
                        02
                    </span>
                </div>
                <div class="space-y-4">
                    <h4 class="text-white font-bebas text-4xl tracking-[3px] group-hover:translate-x-2 transition-transform duration-300">
                        GESTIÓN <span class="text-brand-orange">DE ANEXOS</span>
                    </h4>
                    <div class="h-1 w-12 bg-brand-orange/40 group-hover:w-24 transition-all duration-500"></div>
                    <p class="text-gray-400 text-xl md:text-2xl font-light leading-relaxed uppercase tracking-tight max-w-md">
                        Diligencia los anexos oficiales y conviértelos a
                        <strong class="text-white font-medium">formato PDF</strong> para la carga.
                    </p>
                </div>
            </div>

            {{-- Paso 3 --}}
            <div class="flex flex-col md:flex-row gap-8 group">
                <div class="flex-shrink-0">
                    <span class="font-bebas text-7xl text-white opacity-20 group-hover:text-brand-orange group-hover:opacity-100 transition-all duration-500 leading-none">
                        03
                    </span>
                </div>
                <div class="space-y-4">
                    <h4 class="text-white font-bebas text-4xl tracking-[3px] group-hover:translate-x-2 transition-transform duration-300">
                        CARGA <span class="text-brand-orange">AL SISTEMA</span>
                    </h4>
                    <div class="h-1 w-12 bg-brand-orange/40 group-hover:w-24 transition-all duration-500"></div>
                    <p class="text-gray-400 text-xl md:text-2xl font-light leading-relaxed uppercase tracking-tight max-w-md">
                        Sube tus documentos. El portal te guiará
                        <span class="text-white font-medium border-b border-brand-orange/30">paso a paso</span>.
                    </p>
                </div>
            </div>

            {{-- Paso 4 --}}
            <div class="flex flex-col md:flex-row gap-8 group">
                <div class="flex-shrink-0">
                    <span class="font-bebas text-7xl text-white opacity-20 group-hover:text-brand-orange group-hover:opacity-100 transition-all duration-500 leading-none">
                        04
                    </span>
                </div>
                <div class="space-y-4">
                    <h4 class="text-white font-bebas text-4xl tracking-[3px] group-hover:translate-x-2 transition-transform duration-300">
                        RADICADO <span class="text-brand-orange">OFICIAL</span>
                    </h4>
                    <div class="h-1 w-12 bg-brand-orange/40 group-hover:w-24 transition-all duration-500"></div>
                    <p class="text-gray-400 text-xl md:text-2xl font-light leading-relaxed uppercase tracking-tight max-w-md">
                        Obtén tu número de radicado y
                        <strong class="text-brand-orange font-medium">comprobante digital</strong> por correo.
                    </p>
                </div>
            </div>

        </div>

        {{-- Bloque Final Naranja (Inscripción) --}}
        <div class="relative bg-brand-orange p-12 md:p-24 overflow-hidden shadow-[0_30px_100px_rgba(255,102,0,0.25)] border-y border-white/20">

            {{-- Capa de textura sutil --}}
            <div class="absolute inset-0 opacity-[0.05] pointer-events-none bg-[url('https://www.transparenttextures.com/patterns/stardust.png')]"></div>

            {{-- Guías de Encuadre (Visor de Cine) --}}
            <div class="absolute top-8 left-8 w-16 h-16 border-t-4 border-l-4 border-black/30"></div>
            <div class="absolute top-8 right-8 w-16 h-16 border-t-4 border-r-4 border-black/30"></div>
            <div class="absolute bottom-8 left-8 w-16 h-16 border-b-4 border-l-4 border-black/30"></div>
            <div class="absolute bottom-8 right-8 w-16 h-16 border-b-4 border-r-4 border-black/30"></div>

            {{-- Logo de Actores S.C.G. en Marca de Agua --}}
            <div class="absolute inset-0 flex items-center justify-center opacity-[0.08] pointer-events-none">
                <img src="{{ asset('resources/imagenes/logo.png') }}" alt="Actores SCG" class="w-1/2 md:w-1/3 invert brightness-0 transform scale-150">
            </div>

            <div class="relative z-10 max-w-6xl mx-auto text-center">

                {{-- Tag Superior con Identidad del Evento --}}
                <div class="inline-flex items-center gap-4 mb-8 bg-black px-6 py-2 rounded-sm shadow-xl">
                    <span class="w-2 h-2 bg-brand-orange animate-pulse rounded-full"></span>
                    <span class="text-brand-orange font-black uppercase tracking-[0.4em] text-[10px] md:text-xs italic">
                        Actores S.C.G. • Incentivos 2026
                    </span>
                </div>

                {{-- Título: Invitación Directa --}}
                <h3 class="font-bebas text-[4.5rem] md:text-[8.5rem] text-black mb-8 leading-[0.8] uppercase tracking-tighter transform -rotate-1">
                    HAZ REALIDAD <br class="md:hidden"> <span class="bg-black text-brand-orange px-6 py-2 inline-block my-2">TU PROYECTO</span> <br> AUDIOVISUAL
                </h3>

                {{-- Bajada de Texto --}}
                <p class="text-black font-black mb-16 max-w-4xl mx-auto uppercase tracking-[1px] text-xl md:text-3xl leading-tight">
                    POSTULA TU OBRA EN EL PORTAL DE <br class="hidden md:block">
                    <span class="underline decoration-4 underline-offset-8">INSCRIPCIÓN VIRTUAL PARA SOCIOS</span>
                </p>

                {{-- Botón de Acción con Sombra Sólida --}}
                <div class="relative inline-block group">
                    <div class="absolute inset-0 bg-black translate-x-3 translate-y-3 transition-transform group-hover:translate-x-0 group-hover:translate-y-0"></div>

                    <a href="{{ route('validar-socio') }}" class="relative flex items-center gap-10 bg-white text-black px-12 md:px-20 py-8 no-underline font-bebas text-[2.5rem] md:text-[3.5rem] tracking-[6px] border-4 border-black transition-all">
                        POSTULARME AHORA
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 transition-transform group-hover:rotate-45" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>

                {{-- Footer de Marca y Evento --}}
                <div class="mt-20 pt-10 border-t-2 border-black/20 flex flex-wrap justify-center gap-x-12 gap-y-6">
                    <div class="flex flex-col items-center">
                        <span class="text-[10px] text-black/60 font-black uppercase tracking-[2px] mb-1 italic">Convocatoria</span>
                        <span class="text-lg text-black font-bebas tracking-widest">INCENTIVOS 2026</span>
                    </div>

                    <div class="h-10 w-[2px] bg-black/10 hidden md:block"></div>

                    <div class="flex flex-col items-center">
                        <span class="text-[10px] text-black/60 font-black uppercase tracking-[2px] mb-1 italic">Organiza</span>
                        <span class="text-lg text-black font-bebas tracking-widest">ACTORES S.C.G.</span>
                    </div>

                    <div class="h-10 w-[2px] bg-black/10 hidden md:block"></div>

                    <div class="flex flex-col items-center">
                        <span class="text-[10px] text-black/60 font-black uppercase tracking-[2px] mb-1 italic">Fase Actual</span>
                        <span class="text-lg text-black font-bebas tracking-widest">RECEPCIÓN DIGITAL</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </div>

    {{-- FOOTER: THE FINAL CUT - ESTILO CRÉDITOS CINEMATOGRÁFICOS --}}
    <footer class="bg-[#050505] text-[#888] pt-32 pb-12 border-t-2 border-brand-orange relative overflow-hidden">

        {{-- Elementos Decorativos de Lente (Lens Grid) --}}
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none">
            <div class="absolute top-0 left-0 w-full h-full" style="background-image: radial-gradient(circle, #fff 1px, transparent 1px); background-size: 100px 100px;"></div>
        </div>

        <div class="max-w-[1400px] mx-auto px-8 relative z-10">

            {{-- SECCIÓN SUPERIOR: TÍTULO MONUMENTAL --}}
            <div class="mb-24 border-b border-white/10 pb-16">
                <div class="flex flex-col md:flex-row justify-between items-end gap-8">
                    <div>
                        <span class="font-mono text-xs text-brand-orange tracking-[10px] uppercase block mb-4">Executive_Production</span>
                        <h3 class="font-bebas text-[5rem] md:text-[8rem] lg:text-[10rem] text-white leading-[0.8] tracking-tighter">
                            ACTORES <span class="text-brand-orange">S.C.G.</span>
                        </h3>
                    </div>
                    <div class="text-right hidden md:block">
                        <p class="font-bebas text-4xl text-white tracking-widest italic opacity-20">EST. 1987</p>
                        <p class="font-mono text-[10px] tracking-[4px] uppercase mt-2">Bogotá // Colombia</p>
                    </div>
                </div>
            </div>

            {{-- SECCIÓN MEDIA: CRÉDITOS Y DATOS (GRID TÉCNICO) --}}
            <div class="grid grid-cols-1 md:grid-cols-12 gap-12 lg:gap-24 mb-32">

                {{-- Columna: La Misión (Brief) --}}
                <div class="md:col-span-5">
                    <span class="font-mono text-[10px] text-brand-orange tracking-[5px] uppercase block mb-6">// MISSION_STATEMENT</span>
                    <p class="font-bebas text-3xl md:text-4xl text-gray-300 leading-tight tracking-tight uppercase">
                        Protegiendo y gestionando los derechos patrimoniales de los <span class="text-white italic">actores y actrices</span> de la industria colombiana.
                    </p>

                    {{-- Redes como "Channels" --}}
                    <div class="mt-12 flex items-center gap-8">
                        <a href="https://www.instagram.com/actoresscg/" target="_blank" class="group">
                            <span class="font-mono text-[10px] block opacity-30 group-hover:opacity-100 transition-opacity">FOLLOW_01</span>
                            <span class="font-bebas text-2xl text-white group-hover:text-brand-orange">INSTAGRAM</span>
                        </a>
                        <a href="https://www.facebook.com/ActoresSCG" target="_blank" class="group">
                            <span class="font-mono text-[10px] block opacity-30 group-hover:opacity-100 transition-opacity">FOLLOW_02</span>
                            <span class="font-bebas text-2xl text-white group-hover:text-brand-orange">FACEBOOK</span>
                        </a>
                    </div>
                </div>

                {{-- Columna: Enlaces (The Crew) --}}
                <div class="md:col-span-3">
                    <span class="font-mono text-[10px] text-brand-orange tracking-[5px] uppercase block mb-6">// INDEX</span>
                    <ul class="space-y-4 list-none p-0">
                        @php
                        $navItems = [
                        ['url' => '#inicio', 'label' => 'INICIO'],
                        ['url' => '#convocatoria', 'label' => 'CONVOCATORIA'],
                        ['url' => '#cronograma', 'label' => 'CRONOGRAMA'],
                        ['url' => '#anexos', 'label' => 'PREPÁRATE'],
                        ['url' => '#pasos', 'label' => 'POSTULACIÓN']
                        ];
                        @endphp

                        @foreach($navItems as $item)
                        <li class="group overflow-hidden">
                            <a href="{{ $item['url'] }}" class="nav-link-scroll font-bebas text-3xl md:text-4xl text-white flex items-center gap-4 transition-all duration-300 group-hover:translate-x-3 no-underline">
                                {{-- Separador estilo Telemetría --}}
                                <span class="text-brand-orange text-sm opacity-50 font-mono group-hover:opacity-100 transition-opacity">/</span>

                                <span class="group-hover:text-brand-orange transition-colors tracking-[1px]">
                                    {{ $item['label'] }}
                                </span>

                                {{-- Indicador visual de selección sutil --}}
                                <span class="w-0 h-[2px] bg-brand-orange group-hover:w-8 transition-all duration-500"></span>
                            </a>
                        </li>
                        @endforeach

                        {{-- Separador visual antes del botón especial --}}
                        <li class="py-2 opacity-20">
                            <div class="w-full h-px bg-gradient-to-r from-brand-orange to-transparent"></div>
                        </li>

                        {{-- Link Externo: Ver Inscritos --}}
                        <li class="group">
                            <a href="{{ route('inscritos.publico') }}" class="font-bebas text-3xl text-white/70 flex items-center gap-4 transition-all hover:text-brand-orange no-underline">
                                <span class="text-brand-orange text-sm opacity-50 font-mono">/</span>
                                VER INSCRITOS
                            </a>
                        </li>
                    </ul>
                </div>

                {{-- Columna: Contacto (Location Specs) --}}
                <div class="md:col-span-4">
                    <span class="font-mono text-[10px] text-brand-orange tracking-[5px] uppercase block mb-6">// LOCATION_SCOUTING</span>
                    <div class="space-y-8">
                        <div class="group">
                            <p class="font-mono text-[10px] opacity-30 uppercase mb-1">Office_Headquarters</p>
                            <p class="font-bebas text-2xl text-white group-hover:text-brand-orange transition-colors">Ak 15 #103 - 37, Bogotá, Of. 103</p>
                        </div>
                        <div class="group">
                            <p class="font-mono text-[10px] opacity-30 uppercase mb-1">Voice_Comm</p>
                            <p class="font-bebas text-2xl text-white group-hover:text-brand-orange transition-colors">3156896774</p>
                        </div>
                        <div class="group">
                            <p class="font-mono text-[10px] opacity-30 uppercase mb-1">Encrypted_Mail</p>
                            <p class="font-bebas text-2xl text-white group-hover:text-brand-orange transition-colors">incentivos@actores.org.co</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- SECCIÓN INFERIOR: LEGAL & TECHNICAL SPECS --}}
            <div class="flex flex-col lg:flex-row justify-between items-center gap-8 border-t border-white/5 pt-12">

                {{-- Copyright Estilo Subtítulo --}}
                <div class="flex flex-col md:flex-row items-center gap-6">
                    <div class="bg-white text-black px-3 py-1 font-mono text-[10px] font-black">
                        ACTORES SCG © 2026
                    </div>
                    <p class="font-mono text-[9px] tracking-[4px] uppercase opacity-40 text-center md:text-left">
                        Todos los derechos reservados // Prohibida su reproducción total o parcial.
                    </p>
                </div>

                {{-- Metadata de Producción --}}
                <div class="flex items-center gap-8 font-mono text-[9px] opacity-30">
                    <div class="flex flex-col items-end italic">
                        <span>FRAME_RATE: 24FPS</span>
                        <span>RESOLUTION: 4K_UHD</span>
                    </div>
                    <div class="w-[1px] h-10 bg-white/20"></div>
                    <div class="flex flex-col items-start tracking-[3px]">
                        <span>BOGOTA_COLOMBIA</span>
                        <span>COD: 04-2026-INCENTIVOS</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Decoración Final: Marca de agua masiva en el fondo --}}
        <div class="absolute -bottom-20 -right-20 opacity-[0.03] pointer-events-none select-none">
            <span class="font-bebas text-[25rem] leading-none tracking-tighter">FINAL</span>
        </div>
    </footer>



    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Seleccionamos los elementos una sola vez
            const menuBtn = document.querySelector('#mobile-menu');
            const navLinksContainer = document.querySelector('.nav-links');
            const bars = menuBtn ? menuBtn.querySelectorAll('span') : [];
            const navLinks = document.querySelectorAll('.nav-link-scroll');
            const sections = document.querySelectorAll('section[id]');

            // 1. LÓGICA DEL MENÚ MÓVIL (Abrir/Cerrar y Animación de Barras)
            if (menuBtn && navLinksContainer) {
                menuBtn.addEventListener('click', () => {
                    const isOpen = navLinksContainer.classList.contains('right-0');

                    // Toggle del contenedor
                    navLinksContainer.classList.toggle('-right-full');
                    navLinksContainer.classList.toggle('right-0');

                    // Animación de la hamburguesa a X
                    if (bars.length === 3) {
                        bars[0].classList.toggle('translate-y-[9px]');
                        bars[0].classList.toggle('rotate-45');
                        bars[1].classList.toggle('opacity-0');
                        bars[2].classList.toggle('-translate-y-[9px]');
                        bars[2].classList.toggle('-rotate-45');
                    }
                });
            }

            // 2. CERRAR MENÚ AL HACER CLIC EN UN LINK
            navLinks.forEach(link => {
                link.addEventListener('click', () => {
                    if (navLinksContainer.classList.contains('right-0')) {
                        navLinksContainer.classList.add('-right-full');
                        navLinksContainer.classList.remove('right-0');

                        // Resetear la hamburguesa
                        if (bars.length === 3) {
                            bars[0].classList.remove('translate-y-[9px]', 'rotate-45');
                            bars[1].classList.remove('opacity-0');
                            bars[2].classList.remove('-translate-y-[9px]', '-rotate-45');
                        }
                    }
                });
            });

            // 3. LÓGICA DE RESALTADO (ScrollSpy)
            function changeActiveLink() {
                let current = '';
                const scrollPos = window.scrollY + 160; // Margen para detectar antes de llegar

                sections.forEach(section => {
                    if (scrollPos >= section.offsetTop) {
                        current = section.getAttribute('id');
                    }
                });

                // Si estamos al puro inicio
                if (window.scrollY < 100) current = 'inicio';

                navLinks.forEach(link => {
                    link.classList.remove('text-brand-orange', 'opacity-100');
                    link.classList.add('text-white', 'opacity-80');

                    if (link.getAttribute('href') === `#${current}`) {
                        link.classList.add('text-brand-orange', 'opacity-100');
                        link.classList.remove('text-white', 'opacity-80');
                    }
                });
            }

            window.addEventListener('scroll', changeActiveLink);
            changeActiveLink();

            // 4. SEGURO DE VIDA MODAL (Esc)
            document.addEventListener('keydown', (e) => {
                if (e.key === "Escape") {
                    const modal = document.getElementById('success-modal');
                    if (modal) modal.style.display = 'none';
                }
            });
        });

        // 5. MANEJO ERROR 419 (Livewire)
        document.addEventListener('livewire:init', () => {
            Livewire.hook('request', ({
                fail
            }) => {
                fail(({
                    status,
                    preventDefault
                }) => {
                    if (status === 419) {
                        preventDefault();
                        window.location.reload();
                        return false;
                    }
                });
            });
        });
    </script>
</body>

</html>