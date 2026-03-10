<!DOCTYPE html>
<html lang="es" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/svg+xml" href="{{ asset('resources/imagenes/favicon.svg') }}">
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

<body class="bg-black text-white font-montserrat antialiased leading-relaxed" id="inicio">
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
                            Al continuar, acepta nuestro <a href="https://actores.org.co/storage/app/media/documentos/socios/politica_proteccion_datos.pdf" target="_blank class=" text-white underline hover:text-brand-orange transition-colors">Tratamiento de Datos Personales</a>.
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
    <style>
        html {
            scroll-behavior: smooth;
            scroll-padding-top: 100px;
        }

        /* Tipografía fluida y más grande */
        .nav-link-item {
            font-size: clamp(2.2rem, 5vw, 2.5rem);
            /* Móvil */
        }

        @media (min-width: 1024px) {
            .nav-link-item {
                font-size: clamp(1.1rem, 1.2vw, 1.4rem);
                /* Escritorio: un poco más grande que antes */
            }
        }
    </style>

    @php
    // Lógica de fecha para el bloqueo (9 de Marzo de 2026, 00:00)
    $fechaApertura = \Carbon\Carbon::create(2026, 3, 4, 0, 0, 0);
    $estaAbierto = \Carbon\Carbon::now()->greaterThanOrEqualTo($fechaApertura);
    @endphp
    <nav class="sticky top-0 left-0 w-full z-[1000] flex justify-between items-center px-6 py-4 md:px-16 bg-black/95 border-b-2 border-white/5 backdrop-blur-xl transition-all duration-500 transform-gpu">

        {{-- MARCAS DE ENCUADRE DECORATIVAS --}}
        <div class="absolute top-2 left-2 w-4 h-4 border-t border-l border-brand-orange/20 hidden md:block"></div>
        <div class="absolute top-2 right-2 w-4 h-4 border-t border-r border-brand-orange/20 hidden md:block"></div>

        {{-- LOGO Y BRANDING: TOTALMENTE ESTÁTICO --}}
        <a href="#inicio" class="flex items-center gap-4 md:gap-6 group no-underline shrink-0 z-[1101]">
            <div class="relative py-1">
                <img src="{{ asset('resources/imagenes/logo.png') }}" alt="Logo Actores SCG"
                    class="h-[45px] md:h-[65px] lg:h-[75px] w-auto object-contain transition-none select-none pointer-events-none">
            </div>

            <div class="h-10 w-[2px] bg-gradient-to-b from-transparent via-brand-orange/40 to-transparent hidden sm:block"></div>

            <div class="flex flex-col justify-center ml-2">
                <span class="font-bebas text-2xl md:text-4xl lg:text-5xl text-brand-orange tracking-[3px] md:tracking-[5px] leading-[0.85] uppercase">
                    ACTORES <span class="text-white italic opacity-90">S.C.G.</span>
                </span>
            </div>
        </a>

        {{-- BOTÓN MENÚ MÓVIL --}}
        <div class="flex flex-col gap-[8px] cursor-pointer lg:hidden z-[1101] group" id="mobile-menu-btn">
            <span class="w-[30px] h-[3px] bg-brand-orange transition-all duration-300"></span>
            <span class="w-[20px] h-[3px] bg-white ml-auto transition-all duration-300 group-hover:w-[30px]"></span>
            <span class="w-[30px] h-[3px] bg-brand-orange transition-all duration-300"></span>
        </div>

        {{-- ENLACES --}}
        <ul id="nav-links" class="fixed lg:static top-0 -right-full lg:right-0 w-full lg:w-auto h-screen lg:h-auto bg-[#0a0a0a] lg:bg-transparent flex flex-col lg:flex-row justify-center lg:justify-end items-center gap-8 lg:gap-6 xl:gap-10 transition-all duration-500 z-[1100] list-none px-10 lg:px-0 overflow-y-auto lg:overflow-visible">

            <div class="absolute top-10 left-10 opacity-5 font-bebas text-7xl text-white pointer-events-none lg:hidden uppercase tracking-tighter">SCENE_01</div>

            @php
            $navItems = [
            ['url' => '#inicio', 'label' => 'INICIO'],
            ['url' => '#requisitos', 'label' => 'CONDICIONES'],
            ['url' => '#convocatoria', 'label' => 'PARÁMETROS'],
            ['url' => '#cronograma', 'label' => 'CALENDARIO'],
            ['url' => '#anexos', 'label' => 'PREPÁRATE'],
            ['url' => '#pasos', 'label' => '¿CÓMO POSTULARSE?'],
            ['url' => route('inscritos.publico'), 'label' => 'VER INSCRITOS'],
            ];
            @endphp

            @foreach($navItems as $item)
            <li class="relative group w-full lg:w-auto text-center">
                <a href="{{ $item['url'] }}" class="nav-link-item no-underline text-white font-bebas tracking-[3px] lg:tracking-[1px] hover:text-brand-orange transition-all duration-300 block py-2 uppercase">
                    {{ $item['label'] }}
                </a>
                <span class="absolute bottom-0 left-0 w-full h-[2px] bg-brand-orange scale-x-0 lg:group-hover:scale-x-100 transition-transform duration-500 origin-left"></span>
            </li>
            @endforeach

            {{-- BOTÓN VER INSCRITOS: NARANJA ACTIVO --}}
            <!-- <li class="lg:border-l lg:border-white/20 lg:pl-6 w-full lg:w-auto text-center">
                <a href="{{ route('inscritos.publico') }}"
                    class="nav-link-item no-underline font-bebas text-xl lg:text-lg xl:text-xl tracking-[2px] lg:tracking-[1px] transition-all duration-300 px-6 py-2 border-2 border-brand-orange bg-brand-orange text-black hover:bg-transparent hover:text-brand-orange rounded-sm flex items-center justify-center gap-3 group/btn">
                    <i class="fas fa-user-check text-sm transition-transform group-hover/btn:scale-110"></i>
                    VER INSCRITOS
                </a>
            </li> -->
            <li class="lg:border-l lg:border-white/20 lg:pl-6 w-full lg:w-auto text-center">
                <a href="#pasos"
                    class="nav-link-item no-underline font-bebas text-xl lg:text-lg xl:text-xl tracking-[2px] lg:tracking-[1px] transition-all duration-300 px-6 py-2 border-2 border-brand-orange bg-brand-orange text-black hover:bg-transparent hover:text-brand-orange rounded-sm flex items-center justify-center gap-3 group/btn">

                    <i class="fas fa-clapperboard text-sm transition-all duration-500 group-hover/btn:rotate-[-10deg] group-hover/btn:scale-110"></i>

                    <span>Inscribirme</span>

                    <i class="fas fa-chevron-right text-[10px] opacity-0 -ml-2 transition-all duration-300 group-hover/btn:opacity-100 group-hover/btn:ml-0"></i>
                </a>
            </li>
        </ul>
    </nav>

    <script>
        const menuBtn = document.getElementById('mobile-menu-btn');
        const navLinks = document.getElementById('nav-links');
        const body = document.body;

        function toggleMenu() {
            navLinks.classList.toggle('-right-full');
            navLinks.classList.toggle('right-0');
            body.style.overflow = navLinks.classList.contains('right-0') ? 'hidden' : 'auto';
        }

        menuBtn.addEventListener('click', toggleMenu);

        document.querySelectorAll('.nav-link-item').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 1024) toggleMenu();
            });
        });

        window.addEventListener('scroll', () => {
            const nav = document.querySelector('nav');
            if (window.scrollY > 50) {
                nav.classList.replace('py-4', 'py-2');
                nav.classList.replace('bg-black/95', 'bg-black');
            } else {
                nav.classList.replace('py-2', 'py-4');
                nav.classList.replace('bg-black', 'bg-black/95');
            }
        });
    </script>


    {{-- HERO: CINEMATIC ENGINE // HUD FIXED COLLISION // 13" TO 27" --}}
    {{-- HERO: CINEMATIC ENGINE // MOBILE-TOP ADJUSTED // FULL CONTENT // 13" TO 27" --}}
    <section id="hero-cine-master" class="relative min-h-screen w-full flex flex-col items-center bg-[#000] overflow-hidden border-b-8 border-black pt-24 md:pt-40 2xl:pt-48 pb-16">

        {{-- 1. FONDO --}}
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('resources/imagenes/hero.jpg') }}"
                class="w-full h-full object-cover opacity-40 grayscale contrast-125 brightness-50 animate-[slowzoom_20s_linear_infinite]" alt="Cine Set">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,transparent_0%,#000_100%)] opacity-30"></div>
        </div>

        {{-- 2. CONTENIDO CENTRAL --}}
        <div class="relative z-20 w-full max-w-7xl 2xl:max-w-[1600px] mx-auto px-6 flex flex-col items-center justify-start h-full">

            {{-- HUD SUPERIOR: REC (Ajustado mb-6 para compactar más) --}}
            <div class="mb-6 md:mb-12 2xl:mb-16 flex items-center gap-4 bg-black/60 backdrop-blur-sm px-4 py-1.5 border border-white/10 rounded-full">
                <span class="w-2.5 h-2.5 bg-red-600 rounded-full animate-pulse shadow-[0_0_10px_red]"></span>
                <span class="font-mono text-[10px] 2xl:text-xs text-white tracking-[4px] font-bold uppercase whitespace-nowrap">REC_2026</span>
            </div>

            {{-- TÍTULO: LOGO RESPONSIVO --}}
            <div class="mb-8 md:mb-16 2xl:mb-24 text-center w-full flex justify-center items-center">
                {{-- Logo Móvil Compacto --}}
                <img src="{{ asset('resources/imagenes/logo_incentivos_m.svg') }}"
                    alt="Incentivos 2026"
                    class="block md:hidden h-auto w-auto max-w-[120px] select-none pointer-events-none drop-shadow-[0_0_15px_rgba(255,255,255,0.1)]">

                {{-- Logo Desktop Progresivo --}}
                <img src="{{ asset('resources/imagenes/logo_incentivos.svg') }}"
                    alt="Incentivos 2026"
                    class="hidden md:block h-auto w-auto max-w-[420px] lg:max-w-[520px] 2xl:max-w-[750px] max-h-[25vh] 2xl:max-h-[35vh] object-contain select-none pointer-events-none drop-shadow-[0_0_30px_rgba(255,255,255,0.15)]">
            </div>

            {{-- BLOQUE DE DATOS: LAS 3 TARJETAS (Completas en móvil) --}}
            <div class="w-full grid grid-cols-1 md:grid-cols-3 gap-3 md:gap-6 2xl:gap-10 mb-10 lg:mb-16 2xl:mb-24">

                {{-- Tarjeta 1: Cupos --}}
                <div class="bg-white/5 backdrop-blur-md border-l-4 border-white p-4 md:p-8 flex flex-col justify-center transition-transform hover:scale-[1.02]">
                    <h4 class="font-bebas text-3xl md:text-5xl lg:text-7xl 2xl:text-8xl text-white mb-1 leading-none uppercase">
                        03 <span class="text-lg md:text-2xl 2xl:text-3xl text-white/40">Seleccionados</span>
                    </h4>
                    <p class="text-white/60 text-[9px] md:text-[10px] 2xl:text-xs font-bold uppercase tracking-[1px] md:tracking-[2px] leading-tight">
                        Por <span class="bg-white text-black px-1 italic">jurados</span> externos.
                    </p>
                </div>

                {{-- Tarjeta 2: Asignación (Destacada) --}}
                <div class="bg-brand-orange/10 backdrop-blur-md border-l-4 border-brand-orange p-4 md:p-8 relative overflow-hidden shadow-[0_0_30px_rgba(255,100,0,0.1)] transition-transform hover:scale-[1.02]">
                    <h4 class="font-bebas text-3xl md:text-5xl lg:text-7xl 2xl:text-8xl text-white mb-1 leading-none uppercase">
                        $45<span class="text-brand-orange">Millones</span>
                    </h4>
                    <p class="text-white/80 text-[9px] md:text-[10px] 2xl:text-xs font-bold uppercase tracking-[1px] md:tracking-[2px] leading-tight">
                        Para cada proyecto <span class="bg-brand-orange text-black px-1 italic">seleccionado</span>.
                    </p>
                    <div class="absolute top-2 right-2 w-1.5 h-1.5 bg-brand-orange rounded-full animate-pulse shadow-[0_0_8px_#ff6600]"></div>
                </div>

                {{-- Tarjeta 3: Bolsa --}}
                <div class="bg-white/5 backdrop-blur-md border-l-4 border-white p-4 md:p-8 flex flex-col justify-center transition-transform hover:scale-[1.02]">
                    <h4 class="font-bebas text-3xl md:text-5xl lg:text-7xl 2xl:text-8xl text-white mb-1 leading-none uppercase">
                        $135<span class="text-lg md:text-2xl 2xl:text-3xl text-white/40"> Millones</span>
                    </h4>
                    <p class="text-white/60 text-[9px] md:text-[10px] 2xl:text-xs font-bold uppercase tracking-[1px] md:tracking-[2px] leading-tight">
                        <span class="bg-white text-black px-1 italic">Recurso total</span> destinado a los incentivos audiovisuales.
                    </p>
                </div>
            </div>

            {{-- NOTA ACLARATORIA --}}
            <div class="w-full max-w-4xl 2xl:max-w-6xl mx-auto border-t border-white/20 pt-6 md:pt-10 mb-10">
                <p class="text-[0.85rem] md:text-lg lg:text-xl 2xl:text-2xl text-center text-white/80 italic font-medium leading-relaxed px-2 md:px-4">
                    <span class="font-mono text-[9px] 2xl:text-[11px] block not-italic tracking-[4px] text-brand-orange mb-1 md:mb-2 uppercase font-black">Nota Aclaratoria:</span>
                    "El incentivo constituye un <span class="text-brand-orange font-bold uppercase">apoyo económico exclusivo</span> para la ejecución del proyecto seleccionado y no genera vínculo laboral, contractual o asociativo."
                </p>
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

        <div class="relative z-10 max-w-6xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

                {{-- COLUMNA IZQUIERDA: TEXTOS --}}
                <div class="text-center lg:text-left">
                    {{-- TÍTULO PRINCIPAL: IMPACTO TOTAL --}}
                    <h2 class="font-bebas text-[5rem] md:text-[8rem] lg:text-[7rem] xl:text-[8rem] text-black leading-[0.8] tracking-tighter uppercase mb-8">
                        CONDICIONES DE <br>
                        <span class="relative">
                            PARTICIPACIÓN
                            {{-- Subrayado tipo marcador --}}
                            <div class="absolute -bottom-2 left-0 w-full h-4 bg-black/10 -z-10"></div>
                        </span>
                    </h2>

                    {{-- DESCRIPCIÓN TÉCNICA --}}
                    <div class="max-w-2xl mx-auto lg:mx-0 border-t-4 border-black pt-8">
                        <p class="text-black font-black uppercase text-xl md:text-2xl tracking-tighter leading-tight">
                            Conoce los lineamientos y requisitos generales para
                            la postulación de tu proyecto.
                        </p>
                        <p class="font-mono text-[10px] text-black/60 tracking-[4px] mt-4 uppercase font-bold">
                            Actualizado: Marzo 2026 // Bogotá, Col
                        </p>
                    </div>
                </div>

                {{-- COLUMNA DERECHA: BOTÓN Y METADATOS --}}
                <div class="flex flex-col items-center justify-center">

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
                            </div>
                        </a>
                    </div>


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
                        PARÁMETROS <br>
                        <span class="text-brand-orange italic">GENERALES</span>
                    </h2>
                </div>
                <div class="text-right font-mono">
                    <p class="text-brand-orange text-xl md:text-2xl tracking-[5px]">00:09:03:2026</p>
                    <!-- <p class="text-gray-500 text-[10px] uppercase tracking-widest">Global_System_Status</p> -->
                </div>
            </div>

            {{-- Grid de Datos Rápidos: Edición Master Cut --}}
            {{-- Grid de Datos Rápidos: Edición Master Cut (Versión en Español) --}}
            <div class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-6 gap-4 mb-24 font-montserrat">

                {{-- 1. GÉNERO --}}
                <div class="md:col-span-2 lg:col-span-3 bg-[#111] border border-white/10 p-8 flex flex-col justify-center relative overflow-hidden">
                    <span class="font-mono text-[24px] text-brand-orange tracking-[4px] uppercase mb-4 block">GENERO</span>
                    <h3 class="font-bebas text-4xl sm:text-5xl text-white leading-tight">PRODUCCIÓN DE <br><span class="text-brand-orange text-3xl sm:text-5xl">CORTOMETRAJES DE FICCIÓN</span></h3>
                </div>
                {{-- 2. TEMÁTICA --}}
                <div class="md:col-span-2 lg:col-span-3 bg-[#111] border border-white/10 p-8 relative overflow-hidden group min-h-[220px] flex flex-col justify-center">
                    <div class="absolute top-0 right-0 p-4">
                        <div class="flex gap-1">
                            <div class="w-1 h-4 bg-brand-orange animate-pulse"></div>
                            <div class="w-1 h-4 bg-brand-orange/40"></div>
                            <div class="w-1 h-4 bg-brand-orange/10"></div>
                        </div>
                    </div>
                    <span class="font-mono text-[24px] text-brand-orange tracking-[4px] uppercase mb-4 block">Temática</span>

                    <p class="font-bebas text-7xl text-white tracking-tighter">Libre</p>
                </div>
                {{-- 3. IDIOMA --}}
                <div class="md:col-span-2 lg:col-span-3 bg-[#111] border border-white/10 p-8 flex flex-col justify-center relative overflow-hidden">
                    <span class="font-mono text-[24px] text-brand-orange tracking-[4px] uppercase mb-4 block">Idioma</span>
                    <h3 class="font-bebas text-4xl sm:text-5xl text-white leading-tight">El proyecto debe ser <br><span class="text-brand-orange text-3xl sm:text-5xl">presentado en español</SPAN></h3>
                </div>
                {{-- 4. AUDIENCIA --}}
                <div class="md:col-span-2 lg:col-span-3 bg-[#111] border border-white/10 p-8 flex flex-col justify-center relative overflow-hidden">
                    <span class="font-mono text-[24px] text-brand-orange tracking-[4px] uppercase mb-4 block">Audiencia</span>
                    <h3 class="font-bebas text-4xl sm:text-5xl text-white leading-tight">Apto para <br><span class="text-brand-orange text-3xl sm:text-5xl">todo público</span></h3>
                </div>
                {{-- 5. TIEMPO --}}
                <div class="md:col-span-2 lg:col-span-3 bg-[#111] border border-white/10 p-8 flex flex-col justify-center relative overflow-hidden">
                    <span class="font-mono text-[24px] text-brand-orange tracking-[4px] uppercase mb-4 block">Tiempo</span>
                    <h3 class="font-bebas text-4xl sm:text-5xl text-white leading-tight">Entre 7 a 15 minutos <br><span class="text-brand-orange text-3xl sm:text-5xl">(máximo)<br></h3>
                </div>
                {{-- 2. ELENCO --}}
                <div class="md:col-span-2 lg:col-span-3 bg-[#111] border border-white/10 p-8 flex flex-col justify-center relative overflow-hidden">
                    <span class="font-mono text-[24px] text-brand-orange tracking-[4px] uppercase mb-4 block">Elenco</span>
                    <h3 class="font-bebas text-4xl sm:text-5xl text-white leading-tight">Socios <br><span class="text-brand-orange text-3xl sm:text-5xl">mayores de edad</span></h3>
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

                {{-- Bloque Cita: Estética de Claqueta --}}
                <div class="relative bg-white/5 p-10 border-y-2 border-brand-orange group">
                    {{-- SVG Claqueta decorativo --}}
                    <svg class="absolute -top-6 left-1/2 -translate-x-1/2 w-12 h-12 text-brand-orange" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M18 4l2 4h-3l-2-4h-2l2 4h-3l-2-4H8l2 4H7L5 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V4h-4z" />
                    </svg>

                    <p class="text-[1.2rem] md:text-2xl text-center text-white italic font-medium leading-relaxed max-w-3xl mx-auto">
                        La duración del contenido audiovisual no modificará en ninguna circunstancia el plazo de
                        entrega del producto final.
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

            <div>
                <span class="text-brand-orange font-mono text-xs font-black tracking-[5px] uppercase block mb-2 animate-pulse">
                    // CRONOGRAMA_DE_PRODUCCIÓN
                </span>
                <h2 class="font-bebas text-[5rem] md:text-[8rem] text-white leading-[0.8] uppercase tracking-tighter">
                    CALENDARIO <br class="md:hidden"> <span class="text-brand-orange">INCENTIVOS AUDIOVISUALES</span> 2026
                </h2>
            </div>
        </div>

        {{-- Contenedor Principal: Estética de Monitor de Edición --}}
        <div class="w-full bg-[#050505] text-white font-sans border-x border-t border-white/10 overflow-hidden shadow-2xl">

            {{-- Encabezado de la Tabla --}}
            <!-- <div class="bg-white/5 border-b border-white/20 py-8 text-center relative">
                <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')]"></div>
                <h2 class="text-brand-orange font-bebas uppercase tracking-[0.3em] text-3xl md:text-4xl px-4 relative z-10">
                    LÍNEA DE TIEMPO: PROYECTOS SELECCIONADOS
                </h2>
            </div> -->

            {{-- Cabecera Desktop --}}
            <div class="hidden md:grid grid-cols-12 bg-white/10 border-b-2 border-brand-orange/50">
                <div class="col-span-8 py-6 px-8 border-r border-white/10 flex items-center">
                    <span class="text-brand-orange font-bebas uppercase tracking-[0.3em] text-3xl md:text-4xl flex items-center gap-4 relative z-10">
                        <span class="w-3 h-3 bg-brand-orange rounded-full animate-pulse"></span>
                        Desarrollo del proceso
                    </span>
                </div>

                <div class="col-span-4 py-6 px-8 text-right flex items-center justify-end">
                    <span class="text-brand-orange font-bebas uppercase tracking-[0.3em] text-3xl md:text-4xl relative z-10">
                        Fechas
                    </span>
                </div>
            </div>

            <div class="divide-y divide-white/10 bg-black">

                {{-- ETAPA I --}}
                <div class="grid grid-cols-1 md:grid-cols-12 group">
                    <div class="md:col-span-2 flex flex-col items-center justify-center border-b md:border-b-0 md:border-r border-white/10 bg-white/[0.02] py-8">
                        <span class="font-bebas text-5xl text-white tracking-tighter leading-none">ETAPA I</span>
                        <span class="font-mono text-[10px] text-brand-orange uppercase tracking-[3px] mt-2 font-bold">Inscripción</span>
                    </div>
                    <div class="md:col-span-10 divide-y divide-white/10">
                        <div class="grid grid-cols-1 md:grid-cols-10 items-center py-8 px-8 hover:bg-white/[0.03] transition-colors gap-4">
                            <div class="md:col-span-6 font-bebas text-3xl uppercase text-white/60">Inscripción de los proponentes</div>
                            <div class="md:col-span-4 md:text-right text-4xl font-bebas text-brand-orange tracking-widest">
                                9 al 24 de marzo <span class="block font-mono text-sm text-white tracking-[3px] mt-1 uppercase font-medium">Último día hasta la 1:00 p.m.</span>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-10 items-center py-8 px-8 hover:bg-white/[0.03] transition-colors gap-4">
                            <div class="md:col-span-6 font-bebas text-3xl uppercase text-white/60">Publicación de proponentes inscritos</div>
                            <div class="md:col-span-4 md:text-right text-4xl font-bebas text-brand-orange tracking-widest">26 de marzo</div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-10 items-center py-8 px-8 hover:bg-white/[0.03] transition-colors gap-4">
                            <div class="md:col-span-6 font-bebas text-3xl uppercase text-white/60">Publicaciones proponentes que deben subsanar Etapa I</div>
                            <div class="md:col-span-4 md:text-right text-4xl font-bebas text-brand-orange tracking-widest">15 de abril</div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-10 items-center py-8 px-8 hover:bg-white/[0.03] transition-colors gap-4">
                            <div class="md:col-span-6 font-bebas text-3xl uppercase text-white/60">Recepción de subsanaciones Etapa I</div>
                            <div class="md:col-span-4 md:text-right text-4xl font-bebas text-brand-orange tracking-widest">Del 16 al 24 de abril</div>
                        </div>
                        {{-- HITO DE CIERRE ETAPA I --}}
                        <div class="grid grid-cols-1 md:grid-cols-10 items-center py-10 px-8 bg-white/[0.04] border-l-2 md:border-l-0 md:border-r-4 border-brand-orange/50 transition-colors gap-4">
                            <div class="md:col-span-6 font-bebas text-3xl uppercase text-white tracking-wider">Publicación de proponentes que pasan a la Etapa II</div>
                            <div class="md:col-span-4 md:text-right text-4xl font-bebas text-brand-orange tracking-[4px]">11 de mayo</div>
                        </div>
                    </div>
                </div>

                {{-- ETAPA II --}}
                <div class="grid grid-cols-1 md:grid-cols-12 group">
                    <div class="md:col-span-2 flex flex-col items-center justify-center border-b md:border-b-0 md:border-r border-white/10 bg-white/[0.02] py-8">
                        <span class="font-bebas text-5xl text-white tracking-tighter leading-none">ETAPA II</span>
                        <span class="font-mono text-[10px] text-brand-orange uppercase tracking-[3px] mt-2 font-bold">Técnica</span>
                    </div>
                    <div class="md:col-span-10 divide-y divide-white/10">
                        <div class="grid grid-cols-1 md:grid-cols-10 items-center py-8 px-8 hover:bg-white/[0.03] transition-colors gap-4">
                            <div class="md:col-span-6 font-bebas text-3xl uppercase text-white/60">Recepciones de guiones y documentos de la Etapa II</div>
                            <div class="md:col-span-4 md:text-right text-4xl font-bebas text-brand-orange tracking-widest">
                                13 de mayo <span class="block font-mono text-sm text-white tracking-[3px] mt-1 uppercase font-medium">
                                    Único día
                                </span>
                            </div>
                        </div>
                        {{-- HITO DE CIERRE ETAPA II --}}
                        <div class="grid grid-cols-1 md:grid-cols-10 items-center py-10 px-8 bg-white/[0.04] border-l-2 md:border-l-0 md:border-r-4 border-brand-orange/50 transition-colors gap-4">
                            <div class="md:col-span-6 font-bebas text-3xl uppercase text-white tracking-wider">Publicación de proponentes que pasan a la Etapa III</div>
                            <div class="md:col-span-4 md:text-right text-4xl font-bebas text-brand-orange tracking-[4px]">4 de junio</div>
                        </div>
                    </div>
                </div>

                {{-- ETAPA III: JURADOS (Hito Único) --}}
                <div class="grid grid-cols-1 md:grid-cols-12 items-center py-12 px-8 bg-white/[0.01] hover:bg-white/[0.03] transition-colors gap-4">
                    <div class="md:col-span-2 md:border-r border-white/10 flex flex-col items-center md:items-start">
                        <span class="font-bebas text-5xl text-white tracking-tighter leading-none">ETAPA III</span>
                        <span class="font-mono text-[10px] text-brand-orange uppercase tracking-[3px] mt-1 font-bold">Jurados</span>
                    </div>
                    <div class="md:col-span-6 md:px-6 font-bebas text-3xl uppercase text-white/60">Revisión de guiones y documentación de la Etapa III por los jurados externos</div>
                    <div class="md:col-span-4 md:text-right text-4xl font-bebas text-brand-orange tracking-widest">Del 6 al 26 de junio</div>
                </div>

                {{-- ETAPA IV: SELECCIÓN (Hito Crítico) --}}
                <div class="grid grid-cols-1 md:grid-cols-12 items-center py-14 px-8 bg-brand-orange/[0.03] border-y border-brand-orange/10 transition-colors gap-4">
                    <div class="md:col-span-2 md:border-r border-brand-orange/20 flex flex-col items-center md:items-start">
                        <span class="font-bebas text-5xl text-white tracking-tighter leading-none">ETAPA IV</span>
                        <span class="font-mono text-[10px] text-brand-orange uppercase tracking-[3px] mt-1 font-bold">Selección</span>
                    </div>
                    <div class="md:col-span-6 md:px-6 font-bebas text-4xl uppercase text-white tracking-widest">Publicación de proponentes seleccionados</div>
                    <div class="md:col-span-4 md:text-right text-6xl font-bebas text-brand-orange tracking-[6px] drop-shadow-[0_0_15px_rgba(255,100,0,0.3)]">30 de junio</div>
                </div>

                {{-- PRODUCCIÓN --}}
                <div class="grid grid-cols-1 md:grid-cols-12 items-center py-14 px-8 border-y border-white/10 hover:bg-white/[0.03] transition-colors gap-4">
                    <div class="md:col-span-8 md:px-6 font-bebas text-4xl uppercase text-white/60 tracking-[2px]">Producción del contenido audiovisual</div>
                    <div class="md:col-span-4 md:text-right text-4xl font-bebas text-brand-orange tracking-widest text-center md:text-right">Del 1 de julio al 30 de septiembre</div>
                </div>

                {{-- ENTREGA FINAL --}}
                <div class="grid grid-cols-1 md:grid-cols-12 items-center py-14 px-8 bg-white/[0.05] border-t-2 border-white/20 transition-colors gap-4">
                    <div class="md:col-span-8 md:px-6 font-bebas text-4xl uppercase text-white tracking-tight leading-tight">Entrega del contenido audiovisual y documentación adicional</div>
                    <div class="md:col-span-4 md:text-right text-5xl font-bebas text-brand-orange tracking-widest">
                        30 de septiembre <span class="block font-mono text-sm text-white tracking-[3px] mt-1 uppercase font-medium">
                            Único día
                        </span>
                    </div>
                </div>
                {{-- PREMIERE --}}
                <div class="grid grid-cols-1 md:grid-cols-12 items-center py-14 px-8 bg-white/[0.05] border-t-2 border-white/20 transition-colors gap-4">
                    <div class="md:col-span-8 md:px-6 font-bebas text-4xl uppercase text-white tracking-tight leading-tight"><span class="text-brand-orange">PREMIERE</span>
                        <br><span>Evento exclusivo de Actores S.C.G.</span>
                    </div>
                    <div class="md:col-span-4 md:text-right text-5xl font-bebas text-brand-orange tracking-widest">
                        PRÓXIMAMENTE
                    </div>
                </div>

            </div>
        </div>

    </section>

    {{-- Sección de Cronograma y Etapas --}}
    <section id="anexos" class="mb-[120px] scroll-mt-[100px] max-w-7xl mx-auto px-4 font-outfit">

        {{-- Encabezado de Impacto --}}
        <div class="mb-20 border-b border-white/10 pb-16">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <div class="lg:col-span-8 text-center md:text-left">
                    <span class="text-brand-orange font-bold uppercase tracking-[8px] text-sm md:text-base mb-6 block opacity-90">
                        Etapas de participación
                    </span>
                    <h2 class="font-bebas text-[6rem] md:text-[10rem] lg:text-[12rem] leading-[0.85] mb-8">
                        <span class="text-white">¡PREPÁRATE</span><span class="text-brand-orange">!</span>
                    </h2>
                    <div class="lg:col-span-7">
                        <p class="text-gray-300 text-2xl md:text-3xl uppercase tracking-tight font-light leading-[1.4]">
                            No esperes al día de las inscripciones.
                            <span class="text-white font-medium border-b-4 border-brand-orange/40 pb-1 inline-block mt-2">
                                Descarga aquí los anexos
                            </span>
                            <br class="hidden md:block"> que debes diligenciar por cada etapa.
                        </p>
                    </div>
                </div>

            </div>
        </div>

        {{-- LISTADO DE ETAPAS --}}
        <div class="space-y-20">

            {{-- ETAPA 1: ACTIVA (CHECKLIST) --}}
            <div class="relative">
                <div class="flex items-center gap-4 mb-10">
                    <span class="bg-brand-orange text-black font-bebas text-2xl px-4 py-1 tracking-tighter">ACTIVA</span>
                    <h3 class="font-bebas text-5xl md:text-7xl text-white uppercase tracking-tight">ETAPA I – INSCRIPCIÓN Y VERIFICACIÓN INICIAL</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    {{-- Item 01 --}}
                    <div class="group bg-[#0a0a0a] border border-white/10 p-8 hover:border-brand-orange/50 transition-all">
                        <div class="flex justify-between items-start mb-6">
                            <span class="font-bebas text-5xl text-white group-hover:text-brand-orange transition-colors">01</span>
                            <div class="w-8 h-8 rounded-full border-2 border-brand-orange/30 flex items-center justify-center group-hover:bg-brand-orange transition-all">
                                <svg class="w-4 h-4 text-brand-orange group-hover:text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                        </div>
                        <h4 class="font-bebas text-3xl text-white mb-6 uppercase">Manifestación <br> del Director</h4>
                        <a href="{{ asset('storage/formatos/etapa_01/anexo-01-manifestacion-del-director.pdf') }}" target="_blank" class="block w-full text-center py-3 bg-white/5 text-white font-mono text-[10px] tracking-[3px] uppercase hover:bg-brand-orange hover:text-black transition-colors">Descargar Formato</a>
                    </div>

                    {{-- Item 02 --}}
                    <div class="group bg-[#0a0a0a] border border-white/10 p-8 hover:border-brand-orange/50 transition-all">
                        <div class="flex justify-between items-start mb-6">
                            <span class="font-bebas text-5xl text-white group-hover:text-brand-orange transition-colors">02</span>
                            <div class="w-8 h-8 rounded-full border-2 border-brand-orange/30 flex items-center justify-center group-hover:bg-brand-orange transition-all">
                                <svg class="w-4 h-4 text-brand-orange group-hover:text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                        </div>
                        <h4 class="font-bebas text-3xl text-white mb-6 uppercase">Experiencia <br> Director General</h4>
                        <a href="{{ asset('storage/formatos/etapa_01/anexo-02-experiencia-director-general.pdf') }}" target="_blank" class="block w-full text-center py-3 bg-white/5 text-white font-mono text-[10px] tracking-[3px] uppercase hover:bg-brand-orange hover:text-black transition-colors">Descargar Formato</a>
                    </div>

                    {{-- Item 03 (Especial: Tus Archivos) --}}
                    <div class="bg-brand-orange p-8 flex flex-col justify-between">
                        <div>
                            <div class="flex justify-between items-start mb-6 text-black">
                                <span class="font-bebas text-5xl  text-white">03</span>
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 15h-2v-6h2v6zm0-8h-2V7h2v2z" />
                                </svg>
                            </div>
                            <h4 class="font-bebas text-3xl text-black mb-2 uppercase">Certificados <br> y Evidencias</h4>
                            <p class="text-black/80 text-xs font-bold uppercase tracking-wide">Consigue dos (2) certificaciones de experiencia como director general
                                expedidas por la productora con sus respectivos soportes.</p>
                        </div>
                    </div>

                    {{-- Item 04 --}}
                    <div class="group bg-[#0a0a0a] border border-white/10 p-8 hover:border-brand-orange/50 transition-all">
                        <div class="flex justify-between items-start mb-6">
                            <span class="font-bebas text-5xl text-white group-hover:text-brand-orange transition-colors">04</span>
                            <div class="w-8 h-8 rounded-full border-2 border-white/10 flex items-center justify-center group-hover:border-brand-orange transition-all">
                                <span class="text-[9px] text-gray-500 font-bold">OPC</span>
                            </div>
                        </div>
                        <h4 class="font-bebas text-3xl text-white mb-6 uppercase">Autorización <br> Uso de Guion</h4>
                        <a href="{{ asset('storage/formatos/etapa_01/anexo-03-autorizacion-uso-de-guion.pdf') }}" target="_blank" class="block w-full text-center py-3 bg-white/5 text-white font-mono text-[10px] tracking-[3px] uppercase hover:bg-brand-orange hover:text-black transition-colors">Descargar Formato</a>
                    </div>

                    {{-- Item 05 (Ancho Doble) --}}
                    <div class="group bg-[#0a0a0a] border border-white/10 p-8 hover:border-brand-orange/50 transition-all md:col-span-2">
                        <div class="flex justify-between items-start mb-6">
                            <span class="font-bebas text-5xl text-white group-hover:text-brand-orange transition-colors">05</span>
                            <span class="text-brand-orange font-mono text-[10px] tracking-[4px] uppercase font-bold">Obligatorio</span>
                        </div>
                        <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                            <h4 class="font-bebas text-4xl text-white uppercase leading-none">Consideraciones y declaraciones</h4>
                            <a href="{{ asset('storage/formatos/etapa_01/anexo-04-consideraciones-y-declaraciones.pdf') }}" target="_blank" class="w-full md:w-auto px-8 py-4 bg-white text-black font-bebas text-xl tracking-widest hover:bg-brand-orange transition-colors uppercase">Descargar Formato</a>
                        </div>
                    </div>

                </div>
            </div>

            {{-- ETAPAS INHABILITADAS (2, 3 Y 4) --}}
            <div class="space-y-6 opacity-30 pointer-events-none select-none grayscale filter blur-[1px]">

                {{-- ETAPA 2 --}}
                <div class="bg-white/5 border border-white/10 p-10 flex flex-col md:flex-row justify-between items-center group">
                    <div>
                        <span class="text-gray-500 font-mono text-xs tracking-[4px] uppercase mb-2 block">Etapa_02 // Bloqueada</span>
                        <h3 class="font-bebas text-5xl md:text-6xl text-gray-400 uppercase">ETAPA II – PRESENTACIÓN DEL GUION Y DOCUMENTOS ADICIONALES</h3>
                    </div>
                    <div class="text-right">
                        <span class="block text-gray-600 font-mono text-[10px] uppercase tracking-widest">Disponible el:</span>
                        <span class="block text-gray-400 font-bebas text-4xl">13 / MAY / 2026</span>
                    </div>
                </div>

                {{-- ETAPA 3 --}}
                <div class="bg-white/5 border border-white/10 p-10 flex flex-col md:flex-row justify-between items-center">
                    <div>
                        <span class="text-gray-500 font-mono text-xs tracking-[4px] uppercase mb-2 block">Etapa_03 // Bloqueada</span>
                        <h3 class="font-bebas text-5xl md:text-6xl text-gray-400 uppercase">ETAPA III – EVALUACIÓN Y REVISIÓN DE PROPUESTAS</h3>
                    </div>
                    <div class="text-right">
                        <span class="block text-gray-600 font-mono text-[10px] uppercase tracking-widest">Disponible el:</span>
                        <span class="block text-gray-400 font-bebas text-4xl">06 / JUN / 2026</span>
                    </div>
                </div>

                {{-- ETAPA 4 --}}
                <div class="bg-white/5 border border-white/10 p-10 flex flex-col md:flex-row justify-between items-center">
                    <div>
                        <span class="text-gray-500 font-mono text-xs tracking-[4px] uppercase mb-2 block">Etaoa_04 // Bloqueada</span>
                        <h3 class="font-bebas text-5xl md:text-6xl text-gray-400 uppercase">ETAPA IV – SELECCIONADOS</h3>
                    </div>
                    <div class="text-right">
                        <span class="block text-gray-600 font-mono text-[10px] uppercase tracking-widest">Disponible el:</span>
                        <span class="block text-gray-400 font-bebas text-4xl">25 / JUN / 2026</span>
                    </div>
                </div>

            </div>
        </div>
        <p class="text-gray-400 text-base md:text-lg uppercase leading-relaxed tracking-wide font-medium">
            Diligenciamiento <span class="text-white font-bold">100% digital</span>.
            <span class="text-brand-orange font-bold">No modifiques</span> los formatos establecidos.
        </p>
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
                    <p class="text-gray-400 text-xl md:text-2xl font-light leading-relaxed tracking-tight max-w-md">
                        Inicia sesión con las credenciales enviadas a tu correo registrado
                        <strong class="text-white font-medium">ante la sociedad.</strong>
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
                    <p class="text-gray-400 text-xl md:text-2xl font-light leading-relaxed tracking-tight max-w-md">
                        Diligencia los anexos oficiales <strong class="text-white font-medium">digitalmente,</strong>
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
                    <p class="text-gray-400 text-xl md:text-2xl font-light leading-relaxed tracking-tight max-w-md">
                        Carga tus documentos; <span class="text-white font-medium border-b border-brand-orange/30">la plataforma te guiará </span>en cada etapa del proceso.
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
                    <p class="text-gray-400 text-xl md:text-2xl font-light leading-relaxed tracking-tight max-w-md">
                        Recibiras un número de radicado al correo
                        <strong class="text-brand-orange font-medium">correo registrado</strong> en la sociedad.
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
                    POSTúLATE EN EL PORTAL <br class="hidden md:block">
                    <span class="underline decoration-4 underline-offset-8">DE INSCRIPCIÓN VIRTUAL PARA SOCIOS</span>
                </p>

                @php
                // Lógica de fecha: Apertura 9 de Marzo de 2026, 00:00
                $fechaApertura = \Carbon\Carbon::create(2026, 3, 4, 0, 0, 0);
                $estaAbierto = \Carbon\Carbon::now()->greaterThanOrEqualTo($fechaApertura);
                @endphp

                <div class="relative inline-block group w-full max-w-fit mx-auto">
                    @if($estaAbierto)
                    {{-- BOTÓN ACTIVO (POSTULARME AHORA) --}}
                    <div class="absolute inset-0 bg-black translate-x-2 translate-y-2 md:translate-x-3 md:translate-y-3 transition-transform group-hover:translate-x-0 group-hover:translate-y-0"></div>

                    <a href="{{ route('validar-socio') }}"
                        class="relative flex items-center justify-center gap-4 md:gap-10 bg-white text-black px-6 sm:px-12 md:px-20 py-5 md:py-8 no-underline font-bebas text-[1.8rem] sm:text-[2.2rem] md:text-[3.5rem] tracking-[3px] md:tracking-[6px] border-4 border-black transition-all">

                        <span class="whitespace-nowrap">POSTULARME AHORA</span>

                        <svg xmlns="http://www.w3.org/2000/center/svg"
                            class="w-8 h-8 md:w-12 md:h-12 shrink-0 transition-transform group-hover:rotate-45"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                    @else
                    {{-- BOTÓN BLOQUEADO (EXPECTATIVA) --}}
                    <div class="absolute inset-0 bg-white/10 translate-x-1 translate-y-1 md:translate-x-2 md:translate-y-2 border border-white/20"></div>

                    <div class="relative flex flex-col items-center justify-center bg-zinc-900 text-zinc-500 px-6 sm:px-12 md:px-20 py-5 md:py-8 border-4 border-zinc-700 cursor-not-allowed overflow-hidden">

                        {{-- Texto de Expectativa --}}
                        <div class="flex items-center gap-4 md:gap-8 opacity-60">
                            <span class="whitespace-nowrap font-bebas text-[1.8rem] sm:text-[2.2rem] md:text-[3.5rem] tracking-[3px] md:tracking-[6px]">
                                POSTULARME AHORA
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 md:w-12 md:h-12 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>

                        {{-- Badge decorativo --}}
                        <div class="absolute top-0 left-0 bg-brand-orange text-black font-montserrat font-bold text-[10px] md:text-xs px-3 py-1 uppercase tracking-widest">
                            Próximamente
                        </div>
                    </div>
                    @endif
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