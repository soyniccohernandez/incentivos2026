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
            <a href="{{ route('validar-socio', ['radicado' => $proyecto->codigo_radicado]) }}" class="group relative flex flex-col bg-[#0a0a0a] border border-white/5 hover:border-brand-orange/50 transition-all duration-500 shadow-[0_20px_50px_rgba(0,0,0,0.5)] hover:-translate-y-2 no-underline overflow-hidden">

                {{-- Barra superior dinámica según estado --}}
                <div class="h-2 w-full {{ $proyecto->estado?->nombre == 'SELECCIONADO' ? 'bg-brand-orange' : 'bg-white/5' }} group-hover:bg-brand-orange transition-colors duration-500"></div>

                <div class="p-8">
                    {{-- Radicado y Fecha --}}
                    <div class="flex justify-between items-center mb-8 border-b border-white/5 pb-4">
                        <span class="font-mono text-[10px] text-brand-orange tracking-[3px] font-bold uppercase">#{{ $proyecto->codigo_radicado }}</span>
                        <span class="font-mono text-[10px] text-white/30 tracking-[2px] uppercase">{{ $proyecto->created_at->format('d/m/Y') }}</span>
                    </div>

                    {{-- Título --}}
                    <h2 class="font-bebas text-4xl md:text-5xl text-white leading-tight uppercase mb-6 min-h-[120px] group-hover:text-brand-orange transition-colors duration-500 italic">
                        {{ $proyecto->titulo }}
                    </h2>

                    {{-- Proponente (Nombre del Usuario) --}}
                    <div class="mb-10">
                        <span class="text-[9px] font-mono text-white/20 uppercase tracking-[3px] mb-1 block">Postulado por:</span>
                        <span class="font-bebas text-2xl text-white/80 tracking-widest uppercase group-hover:text-white transition-colors">
                            {{ $proyecto->user?->name ?? 'N/A' }}
                        </span>
                    </div>

                    {{-- Footer: Estado y Acción --}}
                    <div class="mt-auto pt-6 border-t border-white/5 flex items-center justify-between">
                        <div class="flex flex-col">
                            <span class="font-mono text-[8px] text-white/20 uppercase tracking-[4px] mb-1">Estatus_</span>
                            <span class="font-bebas text-2xl tracking-[2px] {{ $proyecto->estado?->nombre == 'SELECCIONADO' ? 'text-brand-orange' : 'text-white/40' }} uppercase">
                                {{ $proyecto->estado?->nombre ?? 'RECIBIDO' }}
                            </span>
                        </div>

                        <div class="flex items-center gap-2 text-brand-orange opacity-0 group-hover:opacity-100 transition-all transform translate-x-4 group-hover:translate-x-0">
                            <span class="font-bebas text-xl tracking-widest">VALIDAR</span>
                            <i class="fas fa-arrow-right text-sm"></i>
                        </div>
                    </div>
                </div>

                <div class="absolute inset-0 bg-gradient-to-tr from-brand-orange/[0.05] via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none"></div>
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
</div>