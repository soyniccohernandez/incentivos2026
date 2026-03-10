<div class="min-h-screen bg-[#020202] text-white font-montserrat antialiased pb-20">

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
                class="font-bebas text-lg md:text-xl text-white/50 hover:text-brand-orange tracking-[3px] no-underline transition-all duration-300 relative group hidden sm:block">
                INICIO
                <span class="absolute -bottom-1 left-0 w-0 h-[1px] bg-brand-orange transition-all duration-300 group-hover:w-full"></span>
            </a>

            {{-- BOTÓN INSCRIBIRME --}}
            <a href="{{ route('validar-socio') }}"
                class="nav-link-item no-underline font-bebas text-xl lg:text-lg xl:text-xl tracking-[2px] lg:tracking-[1px] transition-all duration-300 px-6 py-2 border-2 border-brand-orange bg-brand-orange text-black hover:bg-transparent hover:text-brand-orange rounded-sm flex items-center justify-center gap-3 group/btn">

                <i class="fas fa-clapperboard text-sm transition-all duration-500 group-hover/btn:rotate-[-10deg] group-hover/btn:scale-110"></i>

                <span>Inscribirme</span>

                <i class="fas fa-chevron-right text-[10px] opacity-0 -ml-2 transition-all duration-300 group-hover/btn:opacity-100 group-hover/btn:ml-0"></i>
            </a>
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
        <div class="mb-20 max-w-4xl">
            <span class="text-brand-orange font-mono text-xs tracking-[8px] uppercase mb-4 block">Fase de Selección {{ $ahora->year }}</span>
            <h1 class="font-bebas text-7xl md:text-9xl leading-[0.8] mb-8 uppercase">ARCHIVO DE <br><span class="text-brand-orange text-opacity-80">POSTULACIONES</span></h1>

            <div class="relative group">
                <input type="text" wire:model.live="search"
                    placeholder="BUSCAR POR NOMBRE, RADICADO O PROPONENTE..."
                    class="w-full bg-[#0a0a0a] border border-white/10 p-6 text-xl md:text-3xl font-bebas tracking-widest outline-none focus:border-brand-orange transition-all placeholder:text-white/5 uppercase shadow-2xl">
                <div class="absolute right-6 top-1/2 -translate-y-1/2 text-brand-orange opacity-20 group-focus-within:opacity-100 transition-opacity">
                    <i class="fas fa-search text-2xl"></i>
                </div>
            </div>
        </div>

        {{-- GRID DE PROYECTOS REALES --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @forelse($proyectos as $proyecto)
            <a href="{{ route('validar-socio', ['radicado' => $proyecto->codigo_radicado]) }}"
                class="group relative flex flex-col bg-[#050505] border border-white/10 hover:border-brand-orange/40 transition-all duration-500 shadow-[0_40px_80px_rgba(0,0,0,0.9)] hover:-translate-y-2 no-underline overflow-hidden min-h-[600px]">

                {{-- Barra de estado superior --}}
                <div class="h-2 w-full {{ ($proyecto->estado->nombre ?? '') == 'SELECCIONADO' ? 'bg-brand-orange shadow-[0_0_25px_rgba(255,102,0,0.6)]' : 'bg-white/10' }} group-hover:bg-brand-orange transition-all duration-500"></div>

                <div class="p-6 md:p-10 flex flex-col h-full flex-1">

                    {{-- 1. HEADER: RADICADO Y FECHA (Con Wrap Inteligente) --}}
                    <div class="flex flex-wrap items-end justify-between gap-6 mb-12 border-b border-white/5 pb-8">
                        <div class="flex flex-col min-w-[280px] flex-1">
                            <span class="font-mono text-[10px] text-brand-orange tracking-[5px] mb-2 font-black uppercase">IDENTIFICADOR_ÚNICO</span>
                            <span class="font-mono text-4xl md:text-5xl text-white tracking-[6px] md:tracking-[10px] font-black uppercase leading-none group-hover:text-brand-orange transition-colors break-all">
                                #{{ $proyecto->codigo_radicado }}
                            </span>
                        </div>

                        <div class="flex flex-col items-start md:items-end bg-white/5 md:bg-transparent p-3 md:p-0 rounded-lg md:rounded-none">
                            <span class="font-mono text-[9px] text-white/20 tracking-[3px] uppercase mb-1">REGISTRO_DATE</span>
                            <span class="font-mono text-lg text-white/50 font-bold border-b border-brand-orange/30 pb-1">
                                {{ $proyecto->created_at->format('d.m.Y') }}
                            </span>
                        </div>
                    </div>

                    {{-- 2. CUERPO: TÍTULO (Ajuste de tamaño dinámico) --}}
                    <div class="flex-1 flex flex-col justify-center py-4">
                        <h2 class="font-bebas text-5xl md:text-7xl lg:text-8xl text-white leading-[0.85] uppercase mb-6 group-hover:text-white transition-colors duration-500 italic tracking-tighter break-words">
                            {{ $proyecto->titulo }}
                        </h2>

                        <div class="flex items-start gap-4">
                            <div class="h-10 w-1.5 bg-brand-orange/50 shrink-0"></div>
                            <div class="flex flex-col">
                                <span class="text-[10px] font-mono text-white/20 uppercase tracking-[4px]">SOLICITANTE_OFICIAL</span>
                                <span class="font-bebas text-3xl md:text-4xl text-white/80 tracking-widest uppercase leading-tight">
                                    {{ $proyecto->user?->name ?? 'SISTEMA_UNDEFINED' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- 3. FOOTER: ESTATUS Y ACCIÓN (Layout Responsivo) --}}
                    <div class="mt-12 pt-8 border-t-2 border-white/10">
                        <div class="flex flex-wrap items-center justify-between gap-8">
                            <div class="flex flex-col min-w-[250px]">
                                <span class="font-mono text-[11px] text-brand-orange tracking-[6px] mb-3 font-black">DICTAMEN_ACTUAL</span>
                                <span class="font-bebas text-5xl md:text-7xl tracking-[4px] uppercase leading-none transition-all duration-500
                        {{ $proyecto->color_clase }} 
                        {{ !$proyecto->publicado ? 'animate-pulse' : 'drop-shadow-[0_0_25px_rgba(255,255,255,0.1)]' }}">
                                    {{ $proyecto->estado_final }}
                                </span>
                            </div>

                            {{-- Botón que invita al clic --}}
                            <div class="group/btn flex items-center gap-4 bg-brand-orange text-black px-8 py-4 rounded-full transform transition-all duration-300 hover:scale-105 shadow-xl shadow-brand-orange/10 shrink-0">
                                <span class="font-bebas text-2xl tracking-widest">VER EXPEDIENTE</span>
                                <i class="fas fa-arrow-right transform group-hover/btn:translate-x-2 transition-transform"></i>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Efecto de resplandor --}}
                <div class="absolute inset-0 bg-gradient-to-tr from-brand-orange/[0.1] via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none"></div>
            </a>
            @empty
            <div class="col-span-full py-20 text-center border border-dashed border-white/10 bg-white/[0.02]">
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
                <div class="font-mono text-[10px] text-white/40 tracking-[5px] uppercase">
                    Mostrando <span class="text-white">{{ $proyectos->firstItem() ?? 0 }} - {{ $proyectos->lastItem() ?? 0 }}</span> de <span class="text-brand-orange">{{ $total }}</span> proyectos
                </div>
                <div class="hidden lg:block">
                    <span class="font-bebas text-xl text-white/20 tracking-[4px]">ARCHIVO_ACTORES_SCG_V.26</span>
                </div>
            </div>
        </div>
    </main>

    <footer class="mt-32 py-16 bg-[#050505] border-t border-white/5 text-center">
        <p class="font-mono text-[9px] text-white/20 tracking-[4px] uppercase italic">Sistema de Gestión Audiovisual // Bogotá, Colombia // {{ $ahora->year }}</p>
    </footer>

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
                    title: '¡RADICACIÓN EXITOSA!',
                    text: payload.dataset.message,
                    icon: 'success',
                    background: '#ffffff',
                    // Configuramos dos botones
                    showCancelButton: true,
                    confirmButtonText: 'VER MI POSTULACIÓN',
                    cancelButtonText: 'CERRAR',
                    confirmButtonColor: '#ff6600',
                    cancelButtonColor: '#0f172a', // slate-900

                    customClass: {
                        popup: 'rounded-[2rem] border-4 border-slate-900 shadow-2xl',
                        title: 'font-bebas text-4xl tracking-tight text-slate-900',
                        htmlContainer: 'font-inter text-slate-600 font-medium',
                        confirmButton: 'rounded-xl px-8 py-3 font-bebas text-lg tracking-widest hover:scale-105 transition-transform order-2',
                        cancelButton: 'rounded-xl px-8 py-3 font-bebas text-lg tracking-widest hover:scale-105 transition-transform order-1'
                    },
                    showClass: {
                        popup: 'animate__animated animate__fadeInUp animate__faster'
                    },
                    hideClass: {
                        popup: 'animate__animated animate__fadeOutDown animate__faster'
                    },
                    buttonsStyling: true, // Usamos los estilos de SWAL pero con nuestras clases
                }).then((result) => {
                    // Si el usuario hace clic en "VER MI POSTULACIÓN"
                    if (result.isConfirmed) {
                        window.location.href = "{{ route('inscritos.publico') }}";
                    }
                });

                // Limpia la URL para evitar que el modal salga al recargar
                history.replaceState(null, null, window.location.href);
            }
        });
    </script>
    @endif
</div>