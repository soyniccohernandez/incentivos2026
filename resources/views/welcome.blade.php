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
    {{-- TOOLBAR: RESPONSIVO (Lateral en Desktop, Barra Inferior en Móvil) --}}
    <div class="fixed z-[100] 
    {{-- Comportamiento Móvil: Abajo, horizontal --}}
    bottom-0 left-0 w-full bg-black/80 backdrop-blur-lg border-t border-white/10 px-6 py-4 flex flex-row justify-around items-center
    {{-- Comportamiento Desktop: Lateral derecho, vertical --}}
    md:right-8 md:top-1/2 md:-translate-y-1/2 md:bottom-auto md:left-auto md:w-auto md:bg-transparent md:backdrop-blur-none md:border-none md:flex-col md:gap-8">

        {{-- Decoración: Solo visible en Desktop --}}
        <div class="hidden md:flex flex-col items-center gap-3 mb-2">
            <span class="font-mono text-[10px] text-brand-orange tracking-[5px] uppercase rotate-180 [writing-mode:vertical-lr] font-black animate-pulse">
                System_Online
            </span>
            <div class="w-[3px] h-16 bg-gradient-to-t from-brand-orange via-brand-orange/50 to-transparent rounded-full"></div>
        </div>

        {{-- BOTÓN: WHATSAPP --}}
        <div class="group relative flex flex-col md:flex-col items-center gap-1 md:gap-0">
            <a href="https://wa.me/573156896774?text=Hola,%20me%20gustaría%20más%20información%20sobre%20los%20incentivos%20audiovisuales"
                target="_blank"
                class="relative flex items-center justify-center w-12 h-12 md:w-16 md:h-16 bg-[#25D366] text-white rounded-xl md:rounded-2xl hover:scale-110 md:hover:rotate-3 transition-all duration-500 shadow-lg border-b-4 border-black/20">

                {{-- Tooltip (Solo Desktop) --}}
                <span class="hidden md:block absolute right-20 bg-black border-2 border-[#25D366] text-white font-bold font-mono text-xs px-4 py-2 whitespace-nowrap opacity-0 group-hover:opacity-100 transition-all duration-300 translate-x-4 group-hover:translate-x-0">
                    [ WHATSAPP DIRECTO ]
                </span>

                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="md:w-8 md:h-8">
                    <path d="M3 21l1.65 -3.8a9 9 0 1 1 3.4 2.9l-5.05 .9" />
                    <path d="M9 10a.5 .5 0 0 0 1 0v-1a.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a.5 .5 0 0 0 0 -1h-1a.5 .5 0 0 0 0 1" />
                </svg>
            </a>
            <span class="font-mono text-[8px] md:text-[9px] text-[#25D366] font-bold uppercase md:mt-2 tracking-[1px] md:tracking-[2px]">WhatsApp</span>
        </div>

        {{-- BOTÓN: CORREO ELECTRÓNICO --}}
        <div class="group relative flex flex-col md:flex-col items-center gap-1 md:gap-0">
            <a href="mailto:incentivos@actores.org.co"
                class="relative flex items-center justify-center w-12 h-12 md:w-16 md:h-16 bg-[#3b82f6] text-white rounded-xl md:rounded-2xl hover:scale-110 md:hover:-rotate-3 transition-all duration-500 shadow-lg border-b-4 border-black/20">

                {{-- Tooltip (Solo Desktop) --}}
                <span class="hidden md:block absolute right-20 bg-black border-2 border-[#3b82f6] text-white font-bold font-mono text-xs px-4 py-2 whitespace-nowrap opacity-0 group-hover:opacity-100 transition-all duration-300 translate-x-4 group-hover:translate-x-0">
                    [ ENVIAR E-MAIL ]
                </span>

                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="md:w-8 md:h-8">
                    <path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10" />
                    <path d="M3 7l9 6l9 -6" />
                </svg>
            </a>
            <span class="font-mono text-[8px] md:text-[9px] text-[#3b82f6] font-bold uppercase md:mt-2 tracking-[1px] md:tracking-[2px]">E-mail</span>
        </div>

        {{-- Decoración: Solo Desktop --}}
        <div class="hidden md:flex mt-2 flex-col items-center gap-2">
            <div class="w-2 h-2 bg-brand-orange rounded-full animate-ping"></div>
            <div class="w-[1px] h-10 bg-gradient-to-b from-brand-orange to-transparent"></div>
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


    @php
    // Definición de la variable para evitar el error "Undefined variable"
    $navItems = [
    ['url' => '#inicio', 'label' => 'INICIO'],
    ['url' => '#requisitos', 'label' => 'CONDICIONES'],
    ['url' => '#convocatoria', 'label' => 'PARÁMETROS'],
    ['url' => '#cronograma', 'label' => 'CALENDARIO'],
    ['url' => '#anexos', 'label' => 'PREPÁRATE'],
    ['url' => '#exclusiones', 'label' => 'EXCLUSIÓN'],
    ['url' => route('inscritos.publico'), 'label' => 'VER INSCRITOS'],
    ['url' => '#pasos', 'label' => '¿CÓMO POSTULARSE?', 'cta' => true],
    ];
    @endphp

    <style>
        /* 1. NAVEGACIÓN SUAVE Y COMPENSACIÓN */
        html {
            scroll-behavior: smooth;
            scroll-padding-top: 70px;
        }

        @media (min-width: 768px) {
            html {
                scroll-padding-top: 90px;
            }
        }

        .font-bebas {
            font-family: 'Bebas Neue', sans-serif;
        }

        /* 2. CONGELADOR DE PANTALLA (BLOQUEO DE SCROLL) */
        body.menu-open {
            height: 100vh;
            overflow: hidden !important;
            position: fixed;
            width: 100%;
        }

        /* 3. ESTRUCTURA NAV FIJA */
        #main-nav {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 2000;
            height: 70px;
            background: rgba(0, 0, 0, 0.95);
            backdrop-blur: 10px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
        }

        @media (min-width: 768px) {
            #main-nav {
                height: 90px;
            }
        }

        /* 4. MENÚ MÓVIL FULLSCREEN */
        #nav-links {
            position: fixed;
            top: 0;
            right: 0;
            width: 100%;
            height: 100vh;
            background: #000;
            z-index: 2100;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 2rem;
            transition: transform 0.5s cubic-bezier(0.77, 0, 0.175, 1);
            transform: translateX(100%);
        }

        #nav-links.active {
            transform: translateX(0);
        }

        .nav-link-item {
            font-size: 2.2rem;
            color: white;
            text-decoration: none;
            font-family: 'Bebas Neue', sans-serif;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        /* Desktop Reset */
        @media (min-width: 1280px) {
            #nav-links {
                position: static;
                height: auto;
                width: auto;
                background: transparent;
                flex-direction: row;
                transform: none;
                gap: 1.5rem;
            }

            .nav-link-item {
                font-size: 1.1rem;
                letter-spacing: 1px;
            }

            .nav-link-item:hover {
                color: #ff6600;
            }
        }
    </style>

    <nav id="main-nav">
        <div class="w-full max-w-[1800px] mx-auto flex justify-between items-center px-6 xl:px-12">

            {{-- LOGO --}}
            <a href="#inicio" class="flex items-center gap-4 z-[2200] no-underline">
                <img src="{{ asset('resources/imagenes/logo.png') }}" alt="Logo" class="h-[40px] md:h-[60px] w-auto">
                <div class="hidden 2xl:flex flex-col border-l border-white/20 pl-4">
                    <span class="font-bebas text-2xl text-brand-orange tracking-[3px] leading-none uppercase">
                        ACTORES <span class="text-white italic">S.C.G.</span>
                    </span>
                </div>
            </a>

            {{-- HAMBURGUESA --}}
            <button id="mobile-menu-btn" class="xl:hidden z-[2200] flex flex-col gap-1.5 focus:outline-none p-2">
                <span class="w-8 h-0.5 bg-brand-orange transition-all duration-300" id="line1"></span>
                <span class="w-5 h-0.5 bg-white ml-auto transition-all duration-300" id="line2"></span>
                <span class="w-8 h-0.5 bg-brand-orange transition-all duration-300" id="line3"></span>
            </button>

            {{-- LISTA --}}
            <ul id="nav-links">
                @foreach($navItems as $item)
                <li class="w-full xl:w-auto text-center px-6 xl:px-0">
                    <a href="{{ $item['url'] }}"
                        class="{{ isset($item['cta']) 
        ? 'flex items-center justify-center gap-3 bg-brand-orange text-black px-6 py-3 w-full max-w-[260px] font-bebas text-lg tracking-[2px] transition-all duration-300 hover:bg-white border-2 border-brand-orange hover:border-black active:scale-95 group no-underline' 
        : 'nav-link-item' }}">

                        {{-- Icono de Cámara de Cine Profesional --}}
                        @if(isset($item['cta']))
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 shrink-0 transition-transform group-hover:scale-110" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="7" width="12" height="10" rx="2" ry="2"></rect>
                            <path d="M22 7l-8 5 8 5V7z"></path>
                            <circle cx="5" cy="4" r="1.5" fill="currentColor"></circle>
                            <circle cx="11" cy="4" r="1.5" fill="currentColor"></circle>
                        </svg>
                        @endif

                        <span>{{ $item['label'] }}</span>
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </nav>

    {{-- Espaciador --}}
    <div id="inicio" class="h-[70px] md:h-[90px]"></div>

    <script>
        const menuBtn = document.getElementById('mobile-menu-btn');
        const navLinks = document.getElementById('nav-links');
        const body = document.body;
        const l1 = document.getElementById('line1');
        const l2 = document.getElementById('line2');
        const l3 = document.getElementById('line3');

        let scrollPosition = 0;

        function toggleMenu() {
            const isOpen = navLinks.classList.contains('active');

            if (!isOpen) {
                // ABRIR
                scrollPosition = window.pageYOffset;
                body.style.top = `-${scrollPosition}px`;
                body.classList.add('menu-open');
                navLinks.classList.add('active');

                l1.style.transform = "rotate(45deg) translate(8px, 8px)";
                l2.style.opacity = "0";
                l3.style.transform = "rotate(-45deg) translate(7px, -7px)";
            } else {
                // CERRAR
                body.classList.remove('menu-open');
                body.style.top = '';
                window.scrollTo(0, scrollPosition);
                navLinks.classList.remove('active');

                l1.style.transform = "none";
                l2.style.opacity = "1";
                l3.style.transform = "none";
            }
        }

        menuBtn.addEventListener('click', toggleMenu);

        // LÓGICA DE CLIC EN LINKS CORREGIDA
        document.querySelectorAll('#nav-links a').forEach(link => {
            link.addEventListener('click', (e) => {
                const href = link.getAttribute('href');

                // Solo si es un enlace interno (#seccion)
                if (href.startsWith('#')) {
                    e.preventDefault(); // Detenemos el salto brusco

                    const targetId = href.substring(1);
                    const targetElement = document.getElementById(targetId);

                    if (window.innerWidth < 1280) {
                        // 1. Cerramos el menú y liberamos el body primero
                        toggleMenu();
                    }

                    // 2. Pequeño delay para dejar que el body se "descongele" 
                    // y el navegador procese la posición real antes de mover el scroll
                    setTimeout(() => {
                        if (targetElement) {
                            window.scrollTo({
                                top: targetElement.offsetTop - (window.innerWidth < 768 ? 70 : 90),
                                behavior: 'smooth'
                            });
                        }
                    }, 150);
                }
            });
        });

        // Bloqueador de eventos táctiles para que el fondo no se mueva NADA
        navLinks.addEventListener('touchmove', (e) => {
            if (body.classList.contains('menu-open')) {
                e.preventDefault();
            }
        }, {
            passive: false
        });
    </script>


    <section id="hero-cine-master" class="relative w-full flex items-center justify-center bg-black py-20 md:py-32 2xl:py-44 overflow-hidden">

        {{-- FONDO BLINDADO: Siempre 100% --}}
        <div class="absolute inset-0 z-0 pointer-events-none">
            <img src="{{ asset('resources/imagenes/hero.jpg') }}"
                class="w-full h-full object-cover opacity-40 grayscale contrast-125 brightness-50 scale-105 animate-[slowzoom_25s_linear_infinite]"
                alt="Cine Set">
            {{-- Gradiente dinámico para fundir con el resto de la web --}}
            <div class="absolute inset-0 bg-gradient-to-b from-black via-transparent to-black opacity-60"></div>
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,transparent_0%,#000_100%)] opacity-50"></div>
        </div>

        {{-- CONTENIDO DINÁMICO --}}
        <div class="relative z-20 w-full max-w-[1600px] mx-auto px-6 flex flex-col items-center">

            {{-- HUD REC --}}
            <div class="mb-8 md:mb-12 flex items-center gap-3 bg-black/60 backdrop-blur-md px-4 py-2 border border-white/10 rounded-full shadow-2xl">
                <span class="w-2.5 h-2.5 bg-red-600 rounded-full animate-pulse shadow-[0_0_15px_red]"></span>
                <span class="font-mono text-[10px] 2xl:text-xs text-white tracking-[4px] font-black uppercase">REC_2026</span>
            </div>

            {{-- LOGO PRINCIPAL: ESCALADO PERFECTO --}}
            <div class="mb-12 md:mb-16 2xl:mb-24 flex justify-center items-center w-full">
                {{-- Móvil: No más de 220px para no empujar todo --}}
                <img src="{{ asset('resources/imagenes/logo_incentivos_m.svg') }}"
                    class="block md:hidden w-full max-w-[220px] h-auto drop-shadow-[0_10px_20px_rgba(0,0,0,0.5)]" alt="Logo">
                {{-- Desktop: Escalado por Viewport para no cortar --}}
                <img src="{{ asset('resources/imagenes/logo_incentivos.svg') }}"
                    class="hidden md:block w-full max-w-[400px] lg:max-w-[550px] 2xl:max-w-[850px] h-auto object-contain drop-shadow-[0_20px_50px_rgba(0,0,0,0.8)]" alt="Logo">
            </div>

            {{-- BLOQUE DE DATOS: COLAPSABLE --}}
            <div class="w-full grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8 2xl:gap-12 mb-16 md:mb-24">

                {{-- Tarjeta 1 --}}
                <div class="bg-white/5 backdrop-blur-xl border-l-4 border-white p-6 2xl:p-10 flex flex-col justify-center transition-all hover:bg-white/10 hover:-translate-y-1">
                    <h4 class="font-bebas text-5xl lg:text-6xl 2xl:text-8xl text-white leading-none uppercase">
                        03 <span class="text-xl lg:text-2xl text-white/40 block mt-1">Seleccionados</span>
                    </h4>
                    <p class="text-white/60 text-[10px] lg:text-xs font-bold uppercase tracking-[2px] mt-2">
                        Por <span class="bg-white text-black px-1 italic">jurados</span> externos.
                    </p>
                </div>

                {{-- Tarjeta 2: LA ESTRELLA --}}
                <div class="bg-brand-orange/10 backdrop-blur-xl border-l-4 border-brand-orange p-6 2xl:p-10 relative overflow-hidden transition-all hover:bg-brand-orange/20 hover:-translate-y-1 shadow-[0_20px_40px_rgba(255,102,0,0.15)]">
                    <h4 class="font-bebas text-5xl lg:text-6xl 2xl:text-8xl text-white leading-none uppercase">
                        $45<span class="text-brand-orange">Millones</span>
                    </h4>
                    <p class="text-white/80 text-[10px] lg:text-xs font-bold uppercase tracking-[2px] mt-2">
                        Para cada proyecto <span class="bg-brand-orange text-black px-1 italic">seleccionado</span>.
                    </p>
                    <div class="absolute top-3 right-3 w-2 h-2 bg-brand-orange rounded-full animate-pulse shadow-[0_0_10px_#ff6600]"></div>
                </div>

                {{-- Tarjeta 3 --}}
                <div class="bg-white/5 backdrop-blur-xl border-l-4 border-white p-6 2xl:p-10 flex flex-col justify-center transition-all hover:bg-white/10 hover:-translate-y-1">
                    <h4 class="font-bebas text-5xl lg:text-6xl 2xl:text-8xl text-white leading-none uppercase">
                        $135<span class="text-xl lg:text-2xl text-white/40 mt-1">Millones</span>
                    </h4>
                    <p class="text-white/60 text-[10px] lg:text-xs font-bold uppercase tracking-[2px] mt-2">
                        <span class="bg-white text-black px-1 italic">Recurso total</span> para incentivos.
                    </p>
                </div>
            </div>

            {{-- NOTA ACLARATORIA: SIEMPRE VISIBLE --}}
            <div class="w-full max-w-5xl mx-auto">
                <div class="flex flex-col items-center pt-8 border-t border-white/10">
                    <span class="font-mono text-[9px] 2xl:text-xs tracking-[5px] text-brand-orange mb-4 uppercase font-black opacity-80">Nota Aclaratoria:</span>
                    <p class="text-[0.9rem] md:text-lg lg:text-xl 2xl:text-3xl text-center text-white/80 italic font-medium leading-relaxed">
                        "El incentivo constituye un <span class="text-brand-orange font-bold uppercase not-italic">apoyo económico exclusivo</span> para la ejecución del proyecto seleccionado y no genera vínculo laboral, contractual o asociativo."
                    </p>
                </div>
            </div>
        </div>

        {{-- GRANO DE CINE --}}
        <div class="absolute inset-0 pointer-events-none z-30 opacity-[0.03] bg-[url('https://www.transparenttextures.com/patterns/stardust.png')]"></div>
    </section>

    <section id="requisitos" class="relative z-40 bg-brand-orange pt-24 pb-24 px-6 border-y-[15px] border-black overflow-hidden">
        {{-- MARCA DE AGUA --}}
        <div class="absolute inset-0 opacity-[0.07] pointer-events-none select-none flex items-center justify-center overflow-hidden">
            <span class="font-bebas text-[25vw] leading-none text-black tracking-[-0.05em] uppercase whitespace-nowrap">
                INCENTIVOS
            </span>
        </div>

        {{-- ELEMENTOS DE SET --}}
        <div class="hidden xl:block absolute left-[-50px] top-1/2 -translate-y-1/2 opacity-20 transform -rotate-12 transition-transform hover:rotate-0 duration-700">
            <img src="{{ asset('resources/imagenes/claqueta.svg') }}" class="w-[30rem]" alt="Claqueta">
        </div>
        <div class="hidden xl:block absolute right-[-50px] top-1/2 -translate-y-1/2 opacity-20 transform rotate-12 transition-transform hover:rotate-0 duration-700">
            <img src="{{ asset('resources/imagenes/camara.svg') }}" class="w-[30rem]" alt="Cámara">
        </div>

        <div class="relative z-10 max-w-6xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                {{-- COLUMNA IZQUIERDA --}}
                <div class="text-center lg:text-left">
                    <h2 class="font-bebas text-[4.5rem] md:text-[8rem] lg:text-[7rem] xl:text-[8rem] text-black leading-[0.8] tracking-tighter uppercase mb-8">
                        CONDICIONES DE <br>
                        <span class="relative">
                            PARTICIPACIÓN
                            <div class="absolute -bottom-2 left-0 w-full h-4 bg-black/10 -z-10"></div>
                        </span>
                    </h2>

                    <div class="max-w-2xl mx-auto lg:mx-0 border-t-4 border-black pt-8">
                        <p class="text-black font-black uppercase text-xl md:text-2xl tracking-tighter leading-tight">
                            Conoce los lineamientos y requisitos generales para la postulación de tu proyecto.
                        </p>
                        <p class="font-mono text-[10px] text-black/60 tracking-[4px] mt-4 uppercase font-bold">
                            Actualizado: Marzo 2026 // Bogotá, Col
                        </p>
                    </div>
                </div>

                {{-- COLUMNA DERECHA --}}
                <div class="flex flex-col items-center justify-center">
                    <div class="w-full max-w-lg mx-auto relative group">
                        <div class="absolute inset-0 bg-black translate-x-4 translate-y-4 transition-transform group-hover:translate-x-0 group-hover:translate-y-0"></div>
                        <a href="{{ asset('storage/formatos/condiciones-de-participacion.pdf') }}" target="_blank"
                            class="relative flex items-center justify-center gap-6 bg-white text-black px-8 py-10 no-underline border-[5px] border-black transition-all duration-300">
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
            /* En lugar de height, usamos min-height */
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        /* Aseguramos que el fondo ocupe siempre el total real de la sección */
        #hero-cine-master .absolute.inset-0 {
            height: 100%;
            width: 100%;
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
                    <h2 class="font-bebas text-[5.5rem] md:text-[9rem] lg:text-[11rem] text-white leading-[0.8] uppercase tracking-tighter">
                        PARÁMETROS <br>
                        <span class="text-brand-orange italic">GENERALES</span>
                    </h2>
                </div>
                <div class="text-right font-mono">
                    <p class="text-brand-orange text-xl md:text-2xl tracking-[5px]">00:16:03:2026</p>
                    <!-- <p class="text-gray-500 text-[10px] uppercase tracking-widest">Global_System_Status</p> -->
                </div>
            </div>

            {{-- Grid de Datos Rápidos: Edición Master Cut Final --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-6 mb-24 font-montserrat">

                {{-- 1. GÉNERO: Impacto Lateral --}}
                <div class="lg:col-span-4 bg-[#0a0a0a] border-l-4 border-brand-orange p-8 md:p-12 flex flex-col justify-center relative overflow-hidden group">
                    <div class="absolute top-0 right-0 p-8 opacity-5 group-hover:opacity-20 transition-opacity">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-32 h-32 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z" />
                        </svg>
                    </div>
                    <span class="font-mono text-xs text-brand-orange tracking-[6px] uppercase mb-6 flex items-center gap-4">
                        <span class="w-8 h-[1px] bg-brand-orange"></span> GENERO
                    </span>
                    <h3 class="font-bebas text-5xl md:text-7xl text-white leading-[0.85] uppercase">
                        PRODUCCIÓN DE <br>
                        <span class="text-brand-orange italic">CORTOMETRAJES DE FICCIÓN</span>
                    </h3>
                </div>

                {{-- 2. TEMÁTICA: Minimalismo Extremo --}}
                <div class="lg:col-span-2 bg-brand-orange p-8 md:p-12 flex flex-col justify-between relative overflow-hidden">
                    <span class="font-mono text-xs text-black font-bold tracking-[6px] uppercase mb-4 block">Temática</span>
                    <p class="font-bebas text-8xl md:text-9xl text-black tracking-tighter leading-none">Libre</p>
                    {{-- Líneas decorativas de corte --}}
                    <div class="absolute top-0 right-0 w-12 h-12 border-t-4 border-r-4 border-black/20"></div>
                </div>

                {{-- 3. IDIOMA --}}
                <div class="lg:col-span-2 bg-[#111] border border-white/5 p-8 flex flex-col justify-between group hover:bg-[#151515] transition-colors">
                    <span class="font-mono text-xs text-brand-orange tracking-[4px] uppercase mb-8 block">Idioma</span>
                    <div>
                        <h3 class="font-bebas text-4xl text-white leading-none uppercase">
                            El proyecto debe ser <br>
                            <span class="text-brand-orange text-2xl md:text-3xl">presentado en español</span>
                        </h3>
                    </div>
                </div>

                {{-- 4. AUDIENCIA --}}
                <div class="lg:col-span-2 bg-[#111] border border-white/5 p-8 flex flex-col justify-between group hover:bg-[#151515] transition-colors">
                    <span class="font-mono text-xs text-brand-orange tracking-[4px] uppercase mb-8 block">Audiencia</span>
                    <div>
                        <h3 class="font-bebas text-4xl text-white leading-none uppercase">
                            Apto para <br>
                            <span class="text-brand-orange text-2xl md:text-3xl">todo público</span>
                        </h3>
                    </div>
                </div>

                {{-- 5. TIEMPO --}}
                <div class="lg:col-span-2 bg-[#111] border border-white/5 p-8 flex flex-col justify-between group hover:bg-[#151515] transition-colors">
                    <span class="font-mono text-xs text-brand-orange tracking-[4px] uppercase mb-8 block">Tiempo</span>
                    <div>
                        <h3 class="font-bebas text-4xl text-white leading-none uppercase">
                            Entre 7 a 15 minutos <br>
                            <span class="text-brand-orange text-2xl md:text-3xl">(máximo)</span>
                        </h3>
                    </div>
                </div>

                {{-- 6. ELENCO: Bloque de Cierre Industrial --}}
                <div class="lg:col-span-6 border-2 border-white/10 p-1 bg-white/5">
                    <div class="bg-[#0a0a0a] p-8 md:p-12 flex flex-col md:flex-row justify-between items-center gap-8 relative overflow-hidden">
                        {{-- Efecto de escaneo de fondo --}}
                        <div class="absolute inset-0 bg-[linear-gradient(rgba(255,255,255,0.02)_1px,transparent_1px)] bg-[size:100%_4px] pointer-events-none"></div>

                        <div class="relative z-10 text-center md:text-left">
                            <span class="font-mono text-xs text-brand-orange tracking-[8px] uppercase mb-4 block">Elenco</span>
                            <h3 class="font-bebas text-5xl md:text-8xl text-white leading-none">
                                Socios <span class="text-brand-orange">mayores de edad</span>
                            </h3>
                        </div>

                        <div class="relative z-10 flex flex-col items-center">
                            <div class="w-20 h-20 md:w-24 md:h-24 rounded-full border-4 border-brand-orange flex items-center justify-center mb-2 bg-brand-orange/10">
                                <span class="font-bebas text-4xl md:text-5xl text-white">+18</span>
                            </div>
                            <span class="font-mono text-[10px] text-white/40 tracking-[2px] uppercase">Verificación requerida</span>
                        </div>
                    </div>
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
                <h2 class="font-bebas text-[5.5rem] md:text-[9rem] lg:text-[11rem] text-white leading-[0.8] uppercase tracking-tighter">
                    CALENDARIO <br class="md:hidden">
                    <span class="text-brand-orange">INCENTIVOS</span> 2026
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
                                16 al 30 de marzo <span class="block font-mono text-sm text-white tracking-[3px] mt-1 uppercase font-medium">Último día hasta la 1:00 p.m.</span>
                            </div>
                        </div>
                        <!-- <div class="grid grid-cols-1 md:grid-cols-10 items-center py-8 px-8 hover:bg-white/[0.03] transition-colors gap-4">
                            <div class="md:col-span-6 font-bebas text-3xl uppercase text-white/60">Publicación de proponentes inscritos</div>
                            <div class="md:col-span-4 md:text-right text-4xl font-bebas text-brand-orange tracking-widest">26 de marzo</div>
                        </div> -->
                        <div class="grid grid-cols-1 md:grid-cols-10 items-center py-8 px-8 hover:bg-white/[0.03] transition-colors gap-4">
                            <div class="md:col-span-6 font-bebas text-3xl uppercase text-white/60">Publicaciones proponentes que deben subsanar Etapa I</div>
                            <div class="md:col-span-4 md:text-right text-4xl font-bebas text-brand-orange tracking-widest">18 de abril</div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-10 items-center py-8 px-8 hover:bg-white/[0.03] transition-colors gap-4">
                            <div class="md:col-span-6 font-bebas text-3xl uppercase text-white/60">Recepción de subsanaciones Etapa I</div>
                            <div class="md:col-span-4 md:text-right text-4xl font-bebas text-brand-orange tracking-widest">Del 19 al 26 de abril</div>
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
                    <div class="md:col-span-4 text-4xl font-bebas text-brand-orange tracking-widest text-center md:text-right">Del 1 de julio al 29 de septiembre</div>
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
                    <h2 class="font-bebas text-[5.5rem] md:text-[9rem] lg:text-[11rem] leading-[0.8] mb-8 uppercase tracking-tighter">
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

            <div class="space-y-24 md:space-y-32">

                {{-- ETAPA 1 --}}
                <section class="relative border-l-0 md:border-l-2 border-brand-orange/30 pl-0 md:pl-8 ml-0 md:ml-4 mr-0 md:mr-2">

                    {{-- Indicador de Etapa flotante (Visible solo en Desktop para ganar espacio en Móvil) --}}
                    <div class="hidden md:block absolute -left-[13px] top-0 w-6 h-6 bg-brand-orange rounded-full shadow-[0_0_15px_rgba(255,114,0,0.5)]"></div>

                    <div class="mb-8 md:mb-12 px-4 md:px-0">
                        <span class="bg-brand-orange text-black font-bebas text-2xl md:text-3xl px-6 py-2 tracking-tighter uppercase">Etapa I</span>
                        <h3 class="font-bebas text-4xl md:text-7xl text-white uppercase tracking-tight mt-4 leading-[0.9] md:leading-none">INSCRIPCIÓN Y VERIFICACIÓN INICIAL</h3>
                    </div>

                    {{-- CONTENEDOR DE LISTA DE ANEXOS --}}
                    <div class="max-w-6xl mx-auto space-y-2 md:space-y-4">

                        {{-- ITEM 01 --}}
                        <div class="group flex flex-col md:flex-row items-start md:items-center justify-between bg-[#0a0a0a] border-l-4 border-brand-orange p-5 md:p-8 hover:bg-white/[0.03] transition-all gap-5 md:gap-6">
                            <div class="flex items-start md:items-center gap-4 md:gap-8 w-full">
                                <span class="font-bebas text-3xl md:text-4xl text-white/20 tracking-tighter leading-none">01</span>
                                <div class="flex-grow">
                                    <span class="font-mono text-[9px] md:text-[10px] text-brand-orange uppercase tracking-[3px] mb-1 block">Anexo 01</span>
                                    <h4 class="font-bebas text-2xl md:text-3xl text-white uppercase leading-tight md:leading-none">Manifestación del Director</h4>
                                </div>
                            </div>
                            <a href="{{ asset('storage/formatos/etapa_01/anexo-01-manifestacion-del-director.pdf') }}" target="_blank"
                                class="w-full md:w-auto text-center px-10 py-4 bg-brand-orange text-white font-mono text-[10px] font-bold tracking-[3px] uppercase hover:bg-white hover:text-black transition-all">
                                Descargar Formato
                            </a>
                        </div>

                        {{-- ITEM 02 --}}
                        <div class="group flex flex-col md:flex-row items-start md:items-center justify-between bg-[#0a0a0a] border-l-4 border-brand-orange p-5 md:p-8 hover:bg-white/[0.03] transition-all gap-5 md:gap-6">
                            <div class="flex items-start md:items-center gap-4 md:gap-8 w-full">
                                <span class="font-bebas text-3xl md:text-4xl text-white/20 tracking-tighter leading-none">02</span>
                                <div class="flex-grow">
                                    <span class="font-mono text-[9px] md:text-[10px] text-brand-orange uppercase tracking-[3px] mb-1 block">Anexo 02</span>
                                    <h4 class="font-bebas text-2xl md:text-3xl text-white uppercase leading-tight md:leading-none">Experiencia Director General</h4>
                                </div>
                            </div>
                            <a href="{{ asset('storage/formatos/etapa_01/anexo-02-experiencia-director-general.pdf') }}" target="_blank"
                                class="w-full md:w-auto text-center px-10 py-4 bg-brand-orange text-white font-mono text-[10px] font-bold tracking-[3px] uppercase hover:bg-white hover:text-black transition-all">
                                Descargar Formato
                            </a>
                        </div>

                        {{-- ITEM 03 ESPECIAL (GESTIÓN DEL PROPONENTE) --}}
                        <div class="flex flex-col md:flex-row items-start md:items-center bg-brand-orange/10 border-l-4 border-white p-5 md:p-8 gap-4 md:gap-8">
                            <div class="flex items-start md:items-center gap-4 md:gap-8 w-full">
                                <div class="hidden md:block">
                                    <svg class="w-10 h-10 text-brand-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="flex-grow">
                                    <span class="font-mono text-[10px] text-brand-orange font-bold uppercase tracking-[3px] mb-2 block">Gestión del proponente</span>
                                    <h4 class="font-bebas text-2xl md:text-3xl text-white uppercase leading-tight md:leading-none mb-3">Certificados y Soportes</h4>
                                    <p class="text-white/60 text-[11px] font-bold uppercase tracking-widest max-w-2xl leading-relaxed">
                                        Ve preparando los dos (2) certificados de experiencia del director. Cada uno deberá presentarse en un archivo PDF con sus respectivos soportes y evidencias.
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- ITEM 04 (Originalmente Anexo 03) --}}
                        <div class="group flex flex-col md:flex-row items-start md:items-center justify-between bg-[#0a0a0a] border-l-4 border-brand-orange p-5 md:p-8 hover:bg-white/[0.03] transition-all gap-5 md:gap-6">
                            <div class="flex items-start md:items-center gap-4 md:gap-8 w-full">
                                <span class="font-bebas text-3xl md:text-4xl text-white/20 tracking-tighter leading-none">03</span>
                                <div class="flex-grow">
                                    <span class="font-mono text-[9px] md:text-[10px] text-brand-orange uppercase tracking-[3px] mb-1 block">Anexo 03</span>
                                    <h4 class="font-bebas text-2xl md:text-3xl text-white uppercase leading-tight md:leading-none">Autorización Uso de Guion</h4>
                                </div>
                            </div>
                            <a href="{{ asset('storage/formatos/etapa_01/anexo-03-autorizacion-uso-de-guion.pdf') }}" target="_blank"
                                class="w-full md:w-auto text-center px-10 py-4 bg-brand-orange text-white font-mono text-[10px] font-bold tracking-[3px] uppercase hover:bg-white hover:text-black transition-all">
                                Descargar Formato
                            </a>
                        </div>

                        {{-- ITEM 05 (Originalmente Anexo 04) --}}
                        <div class="group flex flex-col md:flex-row items-start md:items-center justify-between bg-[#0a0a0a] border-l-4 border-brand-orange p-5 md:p-8 hover:bg-white/[0.03] transition-all gap-5 md:gap-6">
                            <div class="flex items-start md:items-center gap-4 md:gap-8 w-full">
                                <span class="font-bebas text-3xl md:text-4xl text-white/20 tracking-tighter leading-none">04</span>
                                <div class="flex-grow">
                                    <span class="font-mono text-[9px] md:text-[10px] text-brand-orange uppercase tracking-[3px] mb-1 block">Anexo 04</span>
                                    <h4 class="font-bebas text-2xl md:text-3xl text-white uppercase leading-tight md:leading-none">Consideraciones y declaraciones</h4>
                                </div>
                            </div>
                            <a href="{{ asset('storage/formatos/etapa_01/anexo-04-consideraciones-y-declaraciones.pdf') }}" target="_blank"
                                class="w-full md:w-auto text-center px-10 py-4 bg-brand-orange text-white font-mono text-[10px] font-bold tracking-[3px] uppercase hover:bg-white hover:text-black transition-all">
                                Descargar Formato
                            </a>
                        </div>
                    </div>
                </section>

                {{-- ETAPA 2 --}}
                <section class="relative border-l-0 md:border-l-2 border-white/10 pl-0 md:pl-8 ml-0 md:ml-4">
                    <div class="hidden md:block absolute -left-[13px] top-0 w-6 h-6 bg-[#1a1a1a] border-2 border-white/20 rounded-full"></div>

                    <div class="mb-8 md:mb-12 px-4 md:px-0">
                        <span class="bg-white/10 text-white font-bebas text-2xl md:text-3xl px-6 py-2 tracking-tighter uppercase">Etapa II</span>
                        <h3 class="font-bebas text-4xl md:text-7xl text-white uppercase tracking-tight mt-4 opacity-80 leading-[0.9]">
                            PRESENTACIÓN DEL GUION Y <br class="hidden md:block"> DOCUMENTOS ADICIONALES
                        </h3>
                    </div>

                    <div class="max-w-6xl mx-auto space-y-2 md:space-y-4">
                        {{-- ANEXO 05 --}}
                        <div class="group flex flex-col md:flex-row items-start md:items-center justify-between bg-[#0a0a0a] border-l-4 border-brand-orange p-5 md:p-8 hover:bg-white/[0.03] transition-all gap-5 md:gap-6">
                            <div class="flex items-start gap-4 md:gap-8 flex-grow">
                                <span class="font-bebas text-3xl md:text-4xl text-white/20 tracking-tighter leading-none">05</span>
                                <div>
                                    <span class="font-mono text-[9px] md:text-[10px] text-brand-orange uppercase tracking-[3px] mb-1 block">Anexo 05</span>
                                    <h4 class="font-bebas text-2xl md:text-3xl text-white uppercase leading-tight md:leading-none mb-3">Carta Intención Elenco</h4>
                                    <p class="text-white/50 text-[10px] font-mono uppercase leading-tight max-w-xl">
                                        * Ve reuniendo tu elenco (socios de la Sociedad) y solicita que diligencien el presente anexo. Si el proponente también actúa, deberá igualmente diligenciarlo.
                                    </p>
                                </div>
                            </div>
                            <a href="{{ asset('storage/formatos/etapa_02/anexo-05-carta-de-intencion-del-elenco.pdf') }}" target="_blank"
                                class="w-full md:w-auto px-10 py-4 bg-brand-orange text-white font-mono text-[10px] font-bold tracking-[3px] uppercase hover:bg-white hover:text-black transition-all text-center">
                                Descargar Formato
                            </a>
                        </div>

                        {{-- REQUERIMIENTO (SIN DESCARGA) --}}
                        <div class="flex flex-col md:flex-row items-start md:items-center bg-brand-orange/10 border-l-4 border-white p-5 md:p-8 gap-4 md:gap-8">
                            <div class="flex items-start md:items-center gap-4 md:gap-8 w-full">
                                <div class="hidden md:block">
                                    <svg class="w-10 h-10 text-brand-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <div class="flex-grow">
                                    <span class="font-mono text-[10px] text-brand-orange font-bold uppercase tracking-[3px] mb-2 block">GESTIÓN DEL PROPONENTE</span>
                                    <h4 class="font-bebas text-2xl md:text-3xl text-white uppercase leading-tight md:leading-none mb-3">GUION FINAL Y RADICADO DE LA DIRECCIÓN NACIONAL DE DERECHOS DE AUTOR (DNDA)</h4>
                                    <p class="text-white/60 text-[11px] font-bold uppercase tracking-widest max-w-2xl leading-relaxed">
                                        Ve alistando el guion final y el comprobante de radicado correspondiente de la DNDA.
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- ANEXO 06 --}}
                        <div class="group flex flex-col md:flex-row items-start md:items-center justify-between bg-[#0a0a0a] border-l-4 border-brand-orange p-5 md:p-8 hover:bg-white/[0.03] transition-all gap-5 md:gap-6">
                            <div class="flex items-start md:items-center gap-4 md:gap-8 w-full">
                                <span class="font-bebas text-3xl md:text-4xl text-white/20 tracking-tighter leading-none">06</span>
                                <div class="flex-grow">
                                    <span class="font-mono text-[9px] md:text-[10px] text-brand-orange uppercase tracking-[3px] mb-1 block">Anexo 06</span>
                                    <h4 class="font-bebas text-2xl md:text-3xl text-white uppercase leading-tight md:leading-none">Propuesta Creativa</h4>
                                </div>
                            </div>
                            <a href="{{ asset('storage/formatos/etapa_02/ANEXO 6. PROPUESTA CREATIVA.docx') }}" target="_blank"
                                class="w-full md:w-auto px-10 py-4 bg-brand-orange text-white font-mono text-[10px] font-bold tracking-[3px] uppercase hover:bg-white hover:text-black transition-all text-center">
                                Descargar Formato
                            </a>
                        </div>

                        {{-- ANEXO 07 --}}
                        <div class="group flex flex-col md:flex-row items-start md:items-center justify-between bg-[#0a0a0a] border-l-4 border-brand-orange p-5 md:p-8 hover:bg-white/[0.03] transition-all gap-5 md:gap-6">
                            <div class="flex items-start md:items-center gap-4 md:gap-8 w-full">
                                <span class="font-bebas text-3xl md:text-4xl text-white/20 tracking-tighter leading-none">07</span>
                                <div class="flex-grow">
                                    <span class="font-mono text-[9px] md:text-[10px] text-brand-orange uppercase tracking-[3px] mb-1 block">Anexo 07</span>
                                    <h4 class="font-bebas text-2xl md:text-3xl text-white uppercase leading-tight md:leading-none">Presupuesto</h4>
                                </div>
                            </div>
                            <a href="{{ asset('storage/formatos/etapa_02/ANEXO 7. PRESUPUESTO.xlsx') }}" target="_blank"
                                class="w-full md:w-auto px-10 py-4 bg-brand-orange text-white font-mono text-[10px] font-bold tracking-[3px] uppercase hover:bg-white hover:text-black transition-all text-center">
                                Descargar Formato
                            </a>
                        </div>

                        {{-- ANEXO 08 --}}
                        <div class="group flex flex-col md:flex-row items-start md:items-center justify-between bg-[#0a0a0a] border-l-4 border-brand-orange p-5 md:p-8 hover:bg-white/[0.03] transition-all gap-5 md:gap-6">
                            <div class="flex items-start md:items-center gap-4 md:gap-8 w-full">
                                <span class="font-bebas text-3xl md:text-4xl text-white/20 tracking-tighter leading-none">08</span>
                                <div class="flex-grow">
                                    <span class="font-mono text-[9px] md:text-[10px] text-brand-orange uppercase tracking-[3px] mb-1 block">Anexo 08</span>
                                    <h4 class="font-bebas text-2xl md:text-3xl text-white uppercase leading-tight md:leading-none">Cronograma</h4>
                                </div>
                            </div>
                            <a href="{{ asset('storage/formatos/etapa_02/ANEXO 8. CRONOGRAMA.xlsx') }}" target="_blank"
                                class="w-full md:w-auto px-10 py-4 bg-brand-orange text-white font-mono text-[10px] font-bold tracking-[3px] uppercase hover:bg-white hover:text-black transition-all text-center">
                                Descargar Formato
                            </a>
                        </div>
                    </div>
                </section>
            </div>

            {{-- CONTENEDOR DE ETAPAS BLOQUEADAS --}}
            <div class="space-y-12 opacity-40 grayscale pointer-events-none select-none">

                {{-- ETAPA 3 --}}
                {{-- En móvil eliminamos bordes y márgenes laterales --}}
                <section class="relative border-l-0 md:border-l-2 border-white/10 pl-0 md:pl-8 ml-0 md:ml-4">
                    {{-- Punto de la línea: oculto en móvil --}}
                    <div class="hidden md:block absolute -left-[11px] top-0 w-5 h-5 bg-[#1a1a1a] border border-white/20 rounded-full"></div>

                    <div class="bg-white/5 border border-white/10 p-6 md:p-10 flex flex-col md:flex-row justify-between items-start md:items-center group transition-all gap-6">
                        <div class="w-full">
                            <span class="text-gray-500 font-mono text-[10px] md:text-xs tracking-[3px] md:tracking-[4px] uppercase mb-2 block">Etapa_03 // Bloqueada</span>
                            <h3 class="font-bebas text-4xl md:text-6xl text-gray-400 uppercase leading-tight md:leading-none">
                                ETAPA III – EVALUACIÓN Y REVISIÓN DE LOS PROYECTOS
                            </h3>
                        </div>

                        <div class="text-left md:text-right w-full md:w-auto">
                            <span class="block text-gray-600 font-mono text-[10px] uppercase tracking-widest">Disponible el:</span>
                            <span class="block text-gray-400 font-bebas text-3xl md:text-4xl">06 / JUN / 2026</span>
                        </div>
                    </div>
                </section>

                {{-- ETAPA 4 --}}
                <section class="relative border-l-0 md:border-l-2 border-white/5 pl-0 md:pl-8 ml-0 md:ml-4">
                    {{-- Punto de la línea: oculto en móvil --}}
                    <div class="hidden md:block absolute -left-[11px] top-0 w-5 h-5 bg-[#1a1a1a] border border-white/10 rounded-full"></div>

                    <div class="bg-white/5 border border-white/10 p-6 md:p-10 flex flex-col md:flex-row justify-between items-start md:items-center group transition-all gap-6">
                        <div class="w-full">
                            <span class="text-gray-500 font-mono text-[10px] md:text-xs tracking-[3px] md:tracking-[4px] uppercase mb-2 block">Etapa_04 // Bloqueada</span>
                            <h3 class="font-bebas text-4xl md:text-6xl text-gray-400 uppercase leading-tight md:leading-none">
                                ETAPA IV – SELECCIONADOS
                            </h3>
                        </div>

                        <div class="text-left md:text-right w-full md:w-auto">
                            <span class="block text-gray-600 font-mono text-[10px] uppercase tracking-widest">Disponible el:</span>
                            <span class="block text-gray-400 font-bebas text-3xl md:text-4xl">30 / JUN / 2026</span>
                        </div>
                    </div>
                </section>

            </div>
        </div>
        <p class="text-gray-400 text-base md:text-lg uppercase leading-relaxed tracking-wide font-medium">
            Diligenciamiento <span class="text-white font-bold">100% digital</span>.
            <span class="text-brand-orange font-bold">No modifiques</span> los formatos establecidos.
        </p>
    </section>

    {{-- SECCIÓN PRINCIPAL: CAUSALES DE EXCLUSIÓN --}}
    <section id="exclusiones" class="mb-[120px] scroll-mt-[100px] max-w-7xl mx-auto px-4">
        {{-- Encabezado de Impacto: CAUSALES DE EXCLUSIÓN --}}
        <div class="mb-20 border-b border-white/10 pb-16 px-4">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <div class="lg:col-span-10 text-center md:text-left">
                    {{-- Título Gigante --}}
                    <h2 class="font-bebas text-[5.5rem] md:text-[9rem] lg:text-[11rem] leading-[0.8] mb-8 uppercase tracking-tighter">
                        <span class="text-white">CAUSALES DE</span> <br class="hidden md:block">
                        <span class="text-red-600 italic">EXCLUSIÓN</span>
                    </h2>

                    {{-- Bajada de texto con el estilo de la sección anterior --}}
                    <div class="lg:col-span-8">
                        <p class="text-gray-300 text-2xl md:text-3xl uppercase tracking-tight font-light leading-[1.4]">
                            Serán <span class="text-white font-medium border-b-4 border-red-600/40 pb-1 inline-block mt-2">excluidos de la convocatoria</span>
                            <br class="hidden md:block"> los proyectos que incurran en cualquiera
                            <br class="hidden md:block"> de las siguientes situaciones:
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Grid Optimizado: 2 Columnas en PC, 1 en Móvil --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">

            {{-- BLOQUE 01: EL PROPONENTE --}}
            <div class="group bg-white/[0.03] border border-white/10 p-8 md:p-12 hover:bg-white/[0.05] transition-all">
                <div class="flex items-end justify-between mb-8 border-b border-red-600/30 pb-4">
                    <h4 class="font-bebas text-4xl md:text-5xl text-white uppercase tracking-wider">El proponente</h4>
                </div>
                <ul class="space-y-6 font-mono text-sm md:text-base text-gray-400 uppercase leading-relaxed">
                    <li class="flex gap-4"><span class="text-red-600 font-bold text-xl">✕</span> No cumple con los requisitos mínimos de participación.</li>
                    <li class="flex gap-4"><span class="text-red-600 font-bold text-xl">✕</span> Participa en más de una propuesta dentro de la presente convocatoria.</li>
                    <li class="flex gap-4"><span class="text-red-600 font-bold text-xl">✕</span> Oculta información relevante o presenta información falsa.</li>
                    <li class="flex gap-4"><span class="text-red-600 font-bold text-xl">✕</span> No diligencia o firma la documentación  obligatoria.</li>
                    <li class="flex gap-4"><span class="text-red-600 font-bold text-xl">✕</span> No atiende las solicitudes de subsanación dentro del plazo establecido.</li>
                    <li class="flex gap-4"><span class="text-red-600 font-bold text-xl">✕</span> Interfiera o intente interferir en el proceso.</li>
                    <li class="flex gap-4"><span class="text-red-600 font-bold text-xl">✕</span> Realiza prácticas abusivas, acoso o amenazas.</li>
                    <li class="flex gap-4"><span class="text-red-600 font-bold text-xl">✕</span> Utiliza el nombre de ACTORES con fines indebidos.</li>
                    <li class="flex gap-4"><span class="text-red-600 font-bold text-xl">✕</span> Destine el incentivo a fines distintos a los aprobados.</li>
                </ul>
            </div>

            {{-- BLOQUE 02: LA DOCUMENTACIÓN --}}
            <div class="group bg-red-600 p-8 md:p-12 shadow-[30px_30px_0px_rgba(220,38,38,0.1)]">
                <div class="flex items-end justify-between mb-8 border-b border-black/20 pb-4 text-black">
                    <h4 class="font-bebas text-4xl md:text-5xl uppercase tracking-wider">Documentación</h4>

                </div>
                <ul class="space-y-4 font-bold text-xs md:text-sm text-black uppercase leading-tight">
                    <li class="flex gap-4 items-start"><span>✕</span> Se presente por medios distintos a los oficiales.</li>
                    <li class="flex gap-4 items-start"><span>✕</span> Se envíe desde un correo no registrado ante la sociedad.</li>
                    <li class="flex gap-4 items-start"><span>✕</span> Se entregue fuera de la fecha y hora límite.</li>
                    <li class="flex gap-4 items-start"><span>✕</span> Estén en blanco.</li>
                    <li class="flex gap-4 items-start"><span>✕</span> Se carguen con contraseñas.</li>
                    <li class="flex gap-4 items-start"><span>✕</span> No se adjunten dentro del plazo.</li>
                    <li class="flex gap-4 items-start"><span>✕</span> Presenten inconsistencias o contradicciones.</li>
                    <li class="flex gap-4 items-start"><span>✕</span> No permitan corroborar la veracidad de la información.</li>
                    <li class="flex gap-4 items-start bg-black text-red-600 p-2"><span>✕</span> Rompan el anonimato (logos, nombres, marcas de agua, metadatos identificables).</li>
                    <li class="flex gap-4 items-start"><span>✕</span> Se alteren formatos oficiales.</li>
                </ul>
            </div>

            {{-- BLOQUE 03: EL DIRECTOR --}}
            <div class="group bg-white/[0.03] border border-white/10 p-8 md:p-12 hover:bg-white/[0.05] transition-all">
                <div class="flex items-end justify-between mb-8 border-b border-red-600/30 pb-4">
                    <h4 class="font-bebas text-4xl md:text-5xl text-white uppercase tracking-wider">El Director</h4>
                </div>
                <ul class="space-y-6 font-mono text-sm md:text-base text-gray-400 uppercase">
                    <li class="flex gap-4"><span class="text-red-600 font-bold text-xl">✕</span> No cumpla requisitos mínimos de participación.</li>
                    <li class="flex gap-4"><span class="text-red-600 font-bold text-xl">✕</span> Sea reemplazado sin autorización previa y escrita de Actores S.C.G.</li>
                    <li class="flex gap-4"><span class="text-red-600 font-bold text-xl">✕</span> No adjunte las experiencias requeridas.</li>
                    <li class="flex gap-4"><span class="text-red-600 font-bold text-xl">✕</span> Abandone la propuesta sin justificación.</li>
                </ul>
            </div>

            {{-- BLOQUE 04: EL ELENCO --}}
            <div class="group bg-white/[0.03] border border-white/10 p-8 md:p-12 hover:bg-white/[0.05] transition-all">
                <div class="flex items-end justify-between mb-8 border-b border-red-600/30 pb-4">
                    <h4 class="font-bebas text-4xl md:text-5xl text-white uppercase tracking-wider">El elenco</h4>
                </div>
                <ul class="space-y-6 font-mono text-sm md:text-base text-gray-400 uppercase">
                    <li class="flex gap-4"><span class="text-red-600 font-bold text-xl">✕</span> No cumpla requisitos mínimos de participación.</li>
                    <li class="flex gap-4"><span class="text-red-600 font-bold text-xl">✕</span> Algún integrante participe en más de una propuesta en la misma convocatoria.</li>
                    <li class="flex gap-4 font-bold text-white italic"><span class="text-red-600 font-bold text-xl animate-pulse">✕</span> Algún integrante sea menor de edad.</li>
                    <li class="flex gap-4"><span class="text-red-600 font-bold text-xl">✕</span> Se modifique el elenco principal sin aviso y sin carta de intención.</li>
                </ul>
            </div>

        </div>

        {{-- Bloque Nota Aclaratoria: Estética de Claqueta --}}
        <div class="mt-20 relative bg-white/5 p-12 border-y-2 border-red-600 group max-w-5xl mx-auto">

            {{-- SVG Claqueta decorativo en Rojo --}}
            <svg class="absolute -top-6 left-1/2 -translate-x-1/2 w-12 h-12 text-red-600 animate-pulse" fill="currentColor" viewBox="0 0 24 24">
                <path d="M18 4l2 4h-3l-2-4h-2l2 4h-3l-2-4H8l2 4H7L5 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V4h-4z" />
            </svg>

            <div class="text-center">
                <p class="text-[1.1rem] md:text-2xl text-white italic font-medium leading-relaxed max-w-4xl mx-auto">
                    <span class="text-red-600 font-bebas tracking-widest not-italic text-2xl block mb-2">Nota aclaratoria:</span>
                    Estas son algunas de las situaciones. Para conocerlas todas, consulta el

                    documento oficial de la convocatoria
                    </a>, literal 11 “Causales de exclusión” (pág. 16).
                </p>

                <span class="block text-[14px] underline font-mono mt-6 uppercase tracking-[4px] opacity-60 group-hover:opacity-100 transition-opacity">
                    <a href="{{ asset('storage/formatos/condiciones-de-participacion.pdf') }}"
                        target="_blank"
                        class="text-white underline decoration-red-600/50 hover:decoration-red-600 transition-all"> Da Clic sobre el enlace para abrir PDF completo </a>
                </span>
            </div>
        </div>

    </section>

    {{-- Pasos e Inscripción Final - Versión Plataforma Digital con Logo de Fondo --}}
    <section id="pasos" class="mb-[120px] scroll-mt-[100px]">
        {{-- Encabezado --}}
        <div class="relative block mb-12">
            <h2 class="font-bebas text-[5.5rem] md:text-[9rem] lg:text-[11rem] leading-[0.8] mb-8 uppercase tracking-tighter">
                <span class="text-white">¿CÓMO</span> <br class="hidden md:block">
                <span class="text-brand-orange underline">POSTULARSE?</span>
            </h2>
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
                // Configuración de fecha: 16 de Marzo de 2026, 00:00
                $fechaApertura = \Carbon\Carbon::create(2026, 3, 13, 0, 0, 0);
                $estaAbierto = \Carbon\Carbon::now()->greaterThanOrEqualTo($fechaApertura);
                $fechaJs = $fechaApertura->format('Y-m-d H:i:s');
                @endphp

                <div class="relative w-full flex justify-center py-10">
                    <div class="relative group w-full sm:w-auto">

                        @if($estaAbierto)
                        {{-- BOTÓN ESTADO: ACTIVO (LANZAMIENTO) --}}
                        <div class="relative inline-block group w-full sm:w-auto">
                            {{-- Sombra de fondo (Efecto 3D) --}}
                            <div class="absolute inset-0 bg-brand-orange translate-x-1 translate-y-1 md:translate-x-2 md:translate-y-2 transition-transform group-hover:translate-x-0 group-hover:translate-y-0"></div>

                            {{-- Botón Principal --}}
                            <a href="{{ route('validar-socio') }}"
                                class="relative flex items-center justify-center gap-4 md:gap-8 bg-white text-black px-6 sm:px-10 md:px-16 py-5 md:py-8 border-2 md:border-4 border-black transition-all active:translate-x-1 active:translate-y-1 no-underline">

                                {{-- Texto: Ajustado para mantener una línea en móvil --}}
                                <span class="whitespace-nowrap font-bebas text-[1.4rem] sm:text-[2.2rem] md:text-[3.5rem] tracking-[2px] md:tracking-[6px] leading-none">
                                    POSTULARME AHORA
                                </span>

                                {{-- Icono: Flecha con animación de Tailwind --}}
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-8 h-8 md:w-12 md:h-12 shrink-0 transition-transform group-hover:translate-x-2 animate-pulse"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </a>
                        </div>
                        @else
                        {{-- BOTÓN ESTADO: BLOQUEADO (CONTEO REGRESIVO TÉCNICO) --}}
                        <div class="relative flex flex-col items-center bg-[#0a0a0a] border-[1px] border-white/10 p-1 md:p-2 rounded-sm shadow-2xl w-full sm:w-auto">

                            {{-- Marco Interno Estilo Industrial --}}
                            <div class="border-[1px] border-white/20 px-6 sm:px-12 md:px-20 py-10 md:py-16 bg-gradient-to-b from-[#111] to-[#050505] flex flex-col items-center relative overflow-hidden">

                                {{-- Decoración de esquinas --}}
                                <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-brand-orange"></div>
                                <div class="absolute top-0 right-0 w-4 h-4 border-t-2 border-r-2 border-brand-orange"></div>
                                <div class="absolute bottom-0 left-0 w-4 h-4 border-b-2 border-l-2 border-brand-orange"></div>
                                <div class="absolute bottom-0 right-0 w-4 h-4 border-b-2 border-r-2 border-brand-orange"></div>

                                {{-- Texto Superior --}}
                                <div class="flex items-center gap-3 mb-10">
                                    <span class="w-2 h-2 bg-red-600 rounded-full animate-pulse"></span>
                                    <span class="font-mono text-[10px] md:text-xs text-white/40 tracking-[3px] md:tracking-[8px] uppercase text-center">Esperando Apertura de Plataforma</span>
                                </div>

                                {{-- CONTADOR PRINCIPAL --}}
                                <div id="countdown" class="flex items-baseline gap-3 md:gap-8 font-bebas text-white mb-10">
                                    <div class="text-center">
                                        <span id="days" class="text-4xl md:text-8xl [font-variant-numeric:tabular-nums]">00</span>
                                        <p class="font-mono text-[8px] md:text-[9px] text-brand-orange tracking-widest mt-2 uppercase opacity-70">Días</p>
                                    </div>
                                    <span class="text-2xl md:text-6xl text-white/20">:</span>
                                    <div class="text-center">
                                        <span id="hours" class="text-4xl md:text-8xl [font-variant-numeric:tabular-nums]">00</span>
                                        <p class="font-mono text-[8px] md:text-[9px] text-brand-orange tracking-widest mt-2 uppercase opacity-70">Hrs</p>
                                    </div>
                                    <span class="text-2xl md:text-6xl text-white/20">:</span>
                                    <div class="text-center">
                                        <span id="minutes" class="text-4xl md:text-8xl [font-variant-numeric:tabular-nums]">00</span>
                                        <p class="font-mono text-[8px] md:text-[9px] text-brand-orange tracking-widest mt-2 uppercase opacity-70">Min</p>
                                    </div>
                                    <span class="text-2xl md:text-6xl text-white/20">:</span>
                                    <div class="text-center min-w-[50px] md:min-w-[110px]">
                                        <span id="seconds" class="text-4xl md:text-8xl [font-variant-numeric:tabular-nums] text-brand-orange [text-shadow:0_0_15px_rgba(255,114,0,0.3)]">00</span>
                                        <p class="font-mono text-[8px] md:text-[9px] text-brand-orange tracking-widest mt-2 uppercase font-bold">Seg</p>
                                    </div>
                                </div>

                                {{-- Texto del botón bloqueado --}}
                                <div class="border-t border-white/10 pt-8 w-full text-center">
                                    <h3 class="font-bebas text-2xl md:text-4xl text-white/20 tracking-[4px] md:tracking-[12px] uppercase whitespace-nowrap">
                                        POSTULARME AHORA
                                    </h3>
                                    <p class="text-brand-orange/50 font-mono text-[9px] md:text-[11px] mt-4 tracking-[1px] md:tracking-[4px] uppercase">
                                        Habilitado el 16 de Marzo a las 00:00:00
                                    </p>
                                </div>

                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const targetDate = new Date("{{ $fechaJs }}").getTime();

                        function updateCountdown() {
                            const now = new Date().getTime();
                            const distance = targetDate - now;

                            if (distance < 0) {
                                window.location.reload();
                                return;
                            }

                            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                            const dEl = document.getElementById('days');
                            const hEl = document.getElementById('hours');
                            const mEl = document.getElementById('minutes');
                            const sEl = document.getElementById('seconds');

                            if (dEl) dEl.innerText = days.toString().padStart(2, '0');
                            if (hEl) hEl.innerText = hours.toString().padStart(2, '0');
                            if (mEl) mEl.innerText = minutes.toString().padStart(2, '0');
                            if (sEl) sEl.innerText = seconds.toString().padStart(2, '0');
                        }

                        if (document.getElementById('countdown')) {
                            setInterval(updateCountdown, 1000);
                            updateCountdown();
                        }
                    });
                </script>
                <style>
                    @keyframes bounce-x {

                        0%,
                        100% {
                            transform: translateX(0);
                        }

                        50% {
                            transform: translateX(15px);
                        }
                    }

                    .animate-bounce-x {
                        animation: bounce-x 1s infinite;
                    }

                    /* Para que los números no salten al cambiar (fuente monoespaciada para el reloj) */
                    .tabular-nums {
                        font-variant-numeric: tabular-nums;
                    }
                </style>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const targetDate = new Date("{{ $fechaJs }}").getTime();

                        function updateCountdown() {
                            const now = new Date().getTime();
                            const distance = targetDate - now;

                            if (distance < 0) {
                                window.location.reload();
                                return;
                            }

                            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                            const d = document.getElementById('days');
                            const h = document.getElementById('hours');
                            const m = document.getElementById('minutes');
                            const s = document.getElementById('seconds');

                            if (d) d.innerText = days.toString().padStart(2, '0');
                            if (h) h.innerText = hours.toString().padStart(2, '0');
                            if (m) m.innerText = minutes.toString().padStart(2, '0');
                            if (s) s.innerText = seconds.toString().padStart(2, '0');
                        }

                        if (document.getElementById('countdown')) {
                            setInterval(updateCountdown, 1000);
                            updateCountdown();
                        }
                    });
                </script>

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
                        <span class="font-mono text-xs text-brand-orange tracking-[10px] uppercase block mb-4">Una iniciativa de</span>
                        <h3 class="font-bebas text-[5rem] md:text-[8rem] lg:text-[10rem] text-white leading-[0.8] tracking-tighter">
                            ACTORES <span class="text-brand-orange">S.C.G.</span>
                        </h3>
                    </div>
                    <div class="text-right hidden md:block">
                        <p class="font-bebas text-4xl text-white tracking-widest italic opacity-20">Incentivos Audiovisuales</p>
                        <p class="font-mono text-[10px] tracking-[4px] uppercase mt-2">TU HISTORIA IMPORTA</p>
                    </div>
                </div>
            </div>

            {{-- SECCIÓN MEDIA: CRÉDITOS Y DATOS (GRID TÉCNICO) --}}
            <div class="grid grid-cols-1 md:grid-cols-12 gap-12 lg:gap-24 mb-32">

                {{-- Columna: La Misión (Brief) --}}
                <div class="md:col-span-5">
                    <span class="font-mono text-[10px] text-brand-orange tracking-[5px] uppercase block mb-6">// Misión</span>
                    <p class="font-bebas text-3xl md:text-5xl text-gray-300 leading-tight tracking-tight uppercase">
                        Impulsamos la <span class="text-white italic">excelencia audiovisual</span> mediante incentivos económicos para proyectos de alta calidad, liderados por los socios de <span class="text-brand-orange">ACTORES S.C.G.</span>
                    </p>

                    {{-- Redes como "Channels" --}}
                    <div class="mt-12 flex items-center gap-8">
                        <a href="https://www.instagram.com/actoresscg/" target="_blank" class="group">
                            <span class="font-mono text-[10px] block opacity-30 group-hover:opacity-100 transition-opacity">REDES SOCIALES</span>
                            <span class="font-bebas text-2xl text-white group-hover:text-brand-orange">INSTAGRAM</span>
                        </a>
                        <a href="https://www.facebook.com/ActoresSCG" target="_blank" class="group">
                            <span class="font-mono text-[10px] block opacity-30 group-hover:opacity-100 transition-opacity">REDES SOCIALES</span>
                            <span class="font-bebas text-2xl text-white group-hover:text-brand-orange">FACEBOOK</span>
                        </a>
                    </div>
                </div>

                {{-- Columna: Enlaces (The Crew) --}}
                <div class="md:col-span-3">
                    <span class="font-mono text-[10px] text-brand-orange tracking-[5px] uppercase block mb-6">// ÍNDICE</span>
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
                    <span class="font-mono text-[10px] text-brand-orange tracking-[5px] uppercase block mb-6">// CONTACTO</span>
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