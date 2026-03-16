<div class="min-h-screen bg-[#020202] text-white font-montserrat antialiased pb-20">
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
    <nav class="sticky top-0 left-0 w-full z-[1000] flex justify-between items-center px-6 py-4 md:px-16 bg-black/95 border-b-2 border-white/5 backdrop-blur-xl transition-all duration-500 transform-gpu">

        {{-- MARCAS DE ENCUADRE DECORATIVAS --}}
        <div class="absolute top-2 left-2 w-4 h-4 border-t border-l border-brand-orange/20 hidden md:block"></div>
        <div class="absolute top-2 right-2 w-4 h-4 border-t border-r border-brand-orange/20 hidden md:block"></div>

        {{-- 1. LADO IZQUIERDO: LOGO Y BRANDING --}}
        <a href="{{ url('/') }}" class="flex items-center gap-4 group no-underline shrink-0 z-[1101]">
            <div class="relative py-1">
                <img src="{{ asset('resources/imagenes/logo.png') }}" alt="Logo Actores SCG"
                    class="h-[45px] md:h-[60px] w-auto object-contain select-none pointer-events-none transition-transform duration-500 group-hover:scale-105">
            </div>

            <div class="h-8 w-[1px] bg-gradient-to-b from-transparent via-brand-orange/40 to-transparent hidden sm:block"></div>

            <div class="flex flex-col justify-center ml-2">
                <span class="font-bebas text-2xl md:text-4xl lg:text-5xl text-brand-orange tracking-[3px] md:tracking-[5px] leading-[0.85] uppercase">
                    ACTORES <span class="text-white italic opacity-90">S.C.G.</span>
                </span>
            </div>
        </a>

        {{-- 2. LADO DERECHO: INICIO + BOTÓN --}}
        <div class="flex items-center gap-6 md:gap-10">

            {{-- ENLACE INICIO --}}
            <a href="{{ url('/') }}"
                class="font-bebas text-lg md:text-xl text-brand-orange hover:text-white tracking-[3px] no-underline transition-all duration-300 relative group hidden sm:block">
                INICIO
                <span class="absolute -bottom-1 left-0 w-0 h-[1px] bg-brand-orange transition-all duration-300 group-hover:w-full"></span>
            </a>

            {{-- BOTÓN INSCRIBIRME --}}
            <!-- <a href="{{ route('validar-socio') }}"
                class="nav-link-item no-underline font-bebas text-xl lg:text-lg xl:text-xl tracking-[2px] lg:tracking-[1px] transition-all duration-300 px-6 py-2 border-2 border-brand-orange bg-brand-orange text-black hover:bg-transparent hover:text-brand-orange rounded-sm flex items-center justify-center gap-3 group/btn">

                <i class="fas fa-clapperboard text-sm transition-all duration-500 group-hover/btn:rotate-[-10deg] group-hover/btn:scale-110"></i>

                <span>Inscribirme</span>

                <i class="fas fa-chevron-right text-[10px] opacity-0 -ml-2 transition-all duration-300 group-hover/btn:opacity-100 group-hover/btn:ml-0"></i>
            </a> -->
        </div>
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

    <main class="max-w-[1500px] mx-auto px-8 pt-16">

        {{-- CABECERA --}}
        <div class="mb-24 w-full"> {{-- Eliminamos max-w-4xl para que el buscador pueda expandirse si el padre lo permite --}}
            <div class="max-w-4xl mb-12">
                <span class="text-brand-orange font-mono text-sm md:text-md tracking-[10px] uppercase mb-4 block animate-pulse">
                    DIRECTORIO DE PROYECTOS
                </span>
                <h1 class="font-bebas text-7xl md:text-9xl leading-[0.8] mb-0 uppercase tracking-tighter">
                    INSCRITOS
                </h1>
            </div>

            {{-- BUSCADOR MEJORADO --}}
            <div class="relative w-full group">
                {{-- Etiqueta flotante superior (estilo técnico) --}}
                <div class="absolute -top-3 left-6 z-10 bg-[#020202] px-3">
                    <span class="font-mono text-[10px] text-brand-orange tracking-[4px] uppercase">Filtrar base de datos</span>
                </div>

                {{-- Input principal --}}
                <div class="relative overflow-hidden">
                    <input type="text"
                        wire:model.live="search"
                        placeholder="ESCRIBE EL NOMBRE DEL PROYECTO O NÚMERO DE RADICADO..."
                        class="w-full bg-white/[0.03] border-2 border-white/10 p-8 md:p-10 pl-8 pr-20 text-2xl md:text-5xl font-bebas tracking-[2px] outline-none transition-all duration-500 
                placeholder:text-white/10 text-white uppercase
                focus:bg-white/[0.07] focus:border-brand-orange focus:ring-0
                group-hover:border-white/20 shadow-[0_0_50px_rgba(0,0,0,0.5)]">

                    {{-- Decoración: Línea de carga inferior estética --}}
                    <div class="absolute bottom-0 left-0 h-[2px] bg-brand-orange w-0 group-focus-within:w-full transition-all duration-700"></div>

                    {{-- Icono de búsqueda dinámico --}}
                    <div class="absolute right-8 top-1/2 -translate-y-1/2 flex items-center gap-4">
                        {{-- Spinner de carga de Livewire (se activa cuando buscas) --}}
                        <div wire:loading wire:target="search" class="animate-spin text-brand-orange">
                            <i class="fas fa-circle-notch text-2xl"></i>
                        </div>

                        <div class="h-12 w-[1px] bg-white/10 group-focus-within:bg-brand-orange/40 transition-colors"></div>

                        <i class="fas fa-search text-3xl md:text-4xl text-white/20 group-focus-within:text-brand-orange transition-all duration-500 transform group-focus-within:scale-110"></i>
                    </div>
                </div>

                {{-- Texto de ayuda rápido debajo del input --}}
                <div class="mt-4 flex justify-between items-center px-2">
                    <p class="font-mono text-[9px] text-white/30 uppercase tracking-[2px]">
                        Resultados en tiempo real <span class="text-brand-orange">_</span>
                    </p>
                    <p class="font-mono text-[9px] text-white/10 uppercase tracking-[2px] hidden md:block">
                        Presiona ESC para limpiar
                    </p>
                </div>
            </div>
        </div>

        {{-- CONTENEDOR DE LISTA DE PROYECTOS --}}
        <div class="flex flex-col gap-6">
            @forelse($proyectos as $proyecto)
            <a href="{{ route('validar-socio', ['radicado' => $proyecto->codigo_radicado]) }}"
                class="group relative flex flex-col md:flex-row bg-[#050505] border-l-4 {{ ($proyecto->estado->nombre ?? '') == 'SELECCIONADO' ? 'border-brand-orange shadow-[0_10px_30px_rgba(255,102,0,0.1)]' : 'border-white/10' }} hover:border-brand-orange border-y border-r border-white/5 transition-all duration-500 hover:bg-[#0a0a0a] no-underline overflow-hidden">

                <div class="p-6 md:p-8 flex flex-col md:flex-row items-center justify-between w-full gap-8">

                    {{-- 1. IDENTIFICADOR (Lado izquierdo) --}}
                    <div class="flex flex-col min-w-[180px]">
                        <span class="font-mono text-[9px] text-brand-orange tracking-[4px] mb-1 font-black uppercase">IDENTIFICADOR_ID</span>
                        <span class="font-mono text-3xl text-white tracking-widest font-black uppercase group-hover:text-brand-orange transition-colors">
                            #{{ $proyecto->codigo_radicado }}
                        </span>
                        <span class="font-mono text-[10px] text-white/30 mt-2 font-bold uppercase tracking-widest">
                            {{ $proyecto->created_at->format('d.m.Y') }}
                        </span>
                    </div>

                    {{-- 2. TÍTULO DEL PROYECTO (Centro - Expansible) --}}
                    <div class="flex-1 text-center md:text-left border-l border-white/5 md:pl-8">
                        <span class="font-mono text-[9px] text-white/20 tracking-[4px] mb-1 uppercase block">NOMBRE_DEL_PROYECTO</span>
                        <h2 class="font-bebas text-4xl md:text-5xl text-white leading-none uppercase group-hover:translate-x-2 transition-transform duration-500 italic tracking-tighter">
                            {{ $proyecto->titulo }}
                        </h2>
                    </div>

                    {{-- 3. DICTAMEN / ESTADO (Lado derecho) --}}
                    <div class="flex flex-col items-center md:items-end min-w-[200px] border-l border-white/5 md:pl-8">
                        <span class="font-mono text-[9px] text-brand-orange tracking-[4px] mb-2 font-black uppercase">STATUS_FINAL</span>
                        <span class="font-bebas text-4xl tracking-[2px] uppercase leading-none transition-all duration-500
                    {{ $proyecto->color_clase }} 
                    {{ !$proyecto->publicado ? 'animate-pulse opacity-60' : 'drop-shadow-[0_0_15px_rgba(255,255,255,0.05)]' }}">
                            {{ $proyecto->estado_final }}
                        </span>
                    </div>

                    {{-- 4. ACCIÓN (Botón Final) --}}
                    <div class="shrink-0">
                        <div class="bg-white/5 group-hover:bg-brand-orange text-white group-hover:text-black p-4 rounded-full transition-all duration-300">
                            <i class="fas fa-arrow-right transform group-hover:rotate-[-45deg] transition-transform"></i>
                        </div>
                    </div>
                </div>

                {{-- Efecto de Barrido de Luz --}}
                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/[0.02] to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000 pointer-events-none"></div>
            </a>

            @empty
            <div class="py-20 text-center border border-dashed border-white/10 bg-white/[0.02]">
                <i class="fas fa-film text-white/10 text-6xl mb-4"></i>
                <p class="font-bebas text-3xl text-white/20 tracking-widest uppercase">No se encontraron proyectos registrados</p>
            </div>
            @endforelse
        </div>

        {{-- PAGINACIÓN LIVEWIRE CUSTOM --}}
        <div class="mt-20">
            <div class="mt-20">
                {{ $proyectos->links('livewire.custom-pagination') }}
            </div>

            {{-- En caso de no tener el vendor publicado, el texto informativo --}}
            <div class="mt-8 bg-[#0a0a0a] border border-white/10 p-8 flex flex-col md:flex-row items-center justify-between gap-8">
                <div class="font-mono text-[16px] text-white/40 tracking-[5px] uppercase">
                    Mostrando <span class="text-white">{{ $proyectos->firstItem() ?? 0 }} - {{ $proyectos->lastItem() ?? 0 }}</span> de <span class="text-brand-orange">{{ $total }}</span> proyectos
                </div>
                <div class="hidden lg:block">
                    <span class="font-bebas text-xl text-white/20 tracking-[4px]">PROYECTOS INCENTIVOS AUDIOVISUALES</span>
                </div>
            </div>
        </div>
    </main>


    {{-- En tu welcome.blade.php o layout principal --}}
    @if(session('success'))
    <div id="swal-payload" data-message="{{ session('success') }}"></div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const payload = document.getElementById('swal-payload');
            if (payload && payload.dataset.message) {
                Swal.fire({
                    title: '¡REGISTRO EXITOSO!',
                    text: payload.dataset.message,
                    icon: 'success',
                    iconColor: '#ff6600', // El naranja de tu marca
                    background: '#ffffff',
                    showCancelButton: true,
                    confirmButtonText: 'VER MI POSTULACIÓN',
                    cancelButtonText: 'CERRAR',
                    confirmButtonColor: '#ff6600',
                    cancelButtonColor: '#0f172a',

                    // Agregamos el footer para la Etapa 2
                    footer: `
                    <div class="text-center pt-4 border-t border-slate-100">
                        <p class="font-inter text-slate-500 text-sm">
                            ¿Siguiente paso? 
                            <a href="/#anexos" class="text-brand-orange font-bold hover:underline ml-1">
                                Ve preparando la documentación de la ETAPA 2 AQUÍ →
                            </a>
                        </p>
                    </div>
                `,

                    customClass: {
                        popup: 'rounded-[2rem] border-4 border-slate-900 shadow-2xl',
                        title: 'font-bebas text-4xl tracking-tight text-slate-900',
                        htmlContainer: 'font-inter text-slate-600 font-medium',
                        confirmButton: 'rounded-xl px-8 py-3 font-bebas text-lg tracking-widest hover:scale-105 transition-transform order-2',
                        cancelButton: 'rounded-xl px-8 py-3 font-bebas text-lg tracking-widest hover:scale-105 transition-transform order-1',
                        footer: 'bg-slate-50 rounded-b-[1.8rem] py-4' // Estilo extra para el fondo del footer
                    },
                    showClass: {
                        popup: 'animate__animated animate__fadeInUp animate__faster'
                    },
                    hideClass: {
                        popup: 'animate__animated animate__fadeOutDown animate__faster'
                    },
                    buttonsStyling: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ route('inscritos.publico') }}";
                    }
                });

                history.replaceState(null, null, window.location.href);
            }
        });
    </script>
    @endif
</div>