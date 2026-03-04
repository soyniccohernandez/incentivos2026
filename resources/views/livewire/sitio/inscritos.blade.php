<div class="bg-black min-h-screen text-white font-montserrat antialiased selection:bg-brand-orange selection:text-white" wire:poll.10s>
    {{-- 1. NAVEGACIÓN --}}
    <nav class="fixed top-0 left-0 w-full z-[1000] flex justify-between items-center px-4 py-4 md:px-12 bg-black/95 border-b border-white/10 backdrop-blur-md">
        <a href="/" class="flex items-center gap-4 no-underline">
            <span class="font-bebas text-2xl md:text-4xl text-brand-orange tracking-[2px]">ACTORES <span class="text-white">S.C.G.</span></span>
        </a>
        <a href="/" class="no-underline text-white/60 font-bebas text-lg md:text-xl tracking-[1px] md:tracking-[2px] hover:text-brand-orange transition-all flex items-center gap-2 md:gap-3 group">
            <span class="text-xl group-hover:-translate-x-2 transition-transform">←</span> <span class="hidden xs:inline">VOLVER</span> <span class="inline">INICIO</span>
        </a>
    </nav>

    <main class="max-w-[1400px] mx-auto pt-32 md:pt-40 pb-20 px-4 md:px-8">
        {{-- HERO SECTION --}}
        <div class="border-l-[8px] md:border-l-[15px] border-brand-orange pl-5 md:pl-16 mb-16 md:mb-24">
            {{-- Ajuste de tracking para que no se salga en móvil --}}
            <span class="text-brand-orange tracking-[4px] md:tracking-[10px] text-[9px] md:text-[10px] font-black uppercase mb-4 block opacity-80 break-words md:whitespace-nowrap">
                // PLATAFORMA_DE_TRANSPARENCIA_2026
            </span>
            <h1 class="font-bebas text-[18vw] md:text-[8.5rem] leading-[0.8] mb-8 md:mb-12 tracking-tighter uppercase">
                MONITOR <br><span class="text-brand-orange">DE PROYECTOS</span>
            </h1>

            <div class="flex flex-col md:flex-row items-stretch gap-0 border border-white/10 bg-white/[0.02]">
                {{-- BLOQUE A: MÉTRICA --}}
                <div class="flex items-center justify-between md:justify-start gap-4 md:gap-8 px-6 md:px-10 py-6 md:py-8 border-b md:border-b-0 md:border-r border-white/10 bg-white/[0.01]">
                    <div class="relative">
                        <span class="text-white font-bebas text-7xl md:text-9xl leading-none tracking-tighter block">
                            {{ $total }}
                        </span>
                        <span class="absolute -top-1 -right-2 md:-top-2 md:-right-4 bg-brand-orange text-black font-black text-[7px] md:text-[8px] px-1.5 md:px-2 py-0.5 tracking-tighter uppercase">Live_Data</span>
                    </div>
                    <div class="flex flex-col border-l border-brand-orange/30 pl-4 md:pl-6">
                        <span class="text-brand-orange text-[10px] md:text-[11px] font-black uppercase tracking-[3px] md:tracking-[5px] leading-tight">Proyectos</span>
                        <span class="text-white/40 text-[10px] md:text-[11px] font-black uppercase tracking-[3px] md:tracking-[5px] leading-tight italic">Registrados</span>
                    </div>
                </div>

                {{-- BLOQUE B: PANEL TÉCNICO --}}
                <div class="flex flex-1 items-center justify-between px-6 md:px-12 py-6 md:py-8 relative overflow-hidden group">
                    <div class="relative z-10">
                        <h2 class="font-bebas text-3xl md:text-5xl text-white leading-[0.8] uppercase tracking-tighter">
                            REGISTRO <span class="text-brand-orange italic">CONSOLIDADO</span>
                        </h2>
                        <div class="flex items-center gap-2 md:gap-3 mt-3">
                            <span class="text-white/30 font-mono text-[8px] md:text-[9px] uppercase tracking-[2px] md:tracking-[3px]">Protocolo: SCG-V.26</span>
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500/50 animate-pulse"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- GRID DE CRONOGRAMA: TRANSFORMADO A SLIDER EN MÓVIL --}}
        <div class="mb-12 md:mb-32">
            {{-- Label técnico para la sección --}}
            <span class="text-[8px] font-mono text-white/20 tracking-[4px] uppercase mb-4 block md:hidden">// TIMELINE_ESTATUS</span>

            <div class="flex overflow-x-auto md:grid md:grid-cols-4 gap-4 snap-x snap-mandatory hide-scrollbar pb-4 md:pb-0">
                @if($convocatoriaActual)
                @foreach($convocatoriaActual->etapas->sortBy('orden') as $etapa)
                @php $activa = $etapa->estaActiva(); @endphp

                {{-- Tarjeta: En móvil es más angosta (w-[280px]) para permitir el scroll horizontal --}}
                <div class="relative p-6 md:p-8 border min-w-[260px] md:min-w-full snap-center {{ $activa ? 'border-brand-orange bg-brand-orange/5' : 'border-white/5 bg-white/[0.01] opacity-40' }}">

                    @if($activa)
                    <div class="absolute top-0 right-0 bg-brand-orange text-black font-black text-[8px] px-2 py-0.5 tracking-widest uppercase">
                        LIVE
                    </div>
                    @endif

                    <span class="font-bebas text-lg text-brand-orange block mb-2 md:mb-6 tracking-[2px]">ETAPA 0{{ $etapa->orden }}</span>

                    <h4 class="font-bebas text-xl md:text-3xl text-white mb-3 uppercase tracking-tighter leading-none truncate">
                        {{ $etapa->nombre }}
                    </h4>

                    <div class="flex items-end justify-between md:block border-t border-white/10 pt-4 md:space-y-1">
                        <div>
                            <p class="text-[8px] uppercase font-black tracking-[1px] text-gray-500 md:block hidden">Cierre de fase:</p>
                            <p class="font-bebas text-3xl md:text-5xl text-white leading-none tracking-tighter">
                                {{ $etapa->fecha_fin->format('d / M') }}
                            </p>
                        </div>
                        <p class="font-mono text-[10px] md:text-[11px] font-bold text-brand-orange uppercase">
                            {{ $etapa->fecha_fin->format('h:i A') }}
                        </p>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>

        {{-- BÚSQUEDA (AHORA MUCHO MÁS ARRIBA EN MÓVIL) --}}
        <div class="mb-16 md:mb-20">
            <div class="max-w-7xl">
                <p class="text-brand-orange font-black text-[10px] md:text-[11px] tracking-[6px] md:tracking-[8px] uppercase mb-4 md:mb-6">
                    <span class="animate-pulse">●</span> BUSCADOR_DE_RADICADOS
                </p>
                <div class="relative group">
                    <input type="text"
                        wire:model.live="search"
                        placeholder="BUSCAR PROYECTO..."
                        class="w-full bg-transparent border-b-2 border-brand-orange/30 py-4 md:py-6 text-4xl md:text-6xl font-bebas tracking-widest outline-none focus:border-brand-orange transition-all placeholder:text-white/10 uppercase focus:placeholder:opacity-0">

                    <div class="absolute right-0 bottom-4 md:bottom-6 text-brand-orange">
                        <svg class="w-8 h-8 md:w-12 md:h-12 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <style>
            /* Oculta el scrollbar pero permite el scroll en el timeline móvil */
            .hide-scrollbar::-webkit-scrollbar {
                display: none;
            }

            .hide-scrollbar {
                -ms-overflow-style: none;
                scrollbar-width: none;
            }
        </style>

        {{-- BÚSQUEDA (PROTAGONISTA) --}}
        <div class="mb-16 md:mb-20">
            <div class="max-w-7xl">
                <p class="text-brand-orange font-black text-[9px] md:text-[11px] tracking-[4px] md:tracking-[8px] uppercase mb-4 md:mb-6">// BUSCADOR_DE_RADICADOS</p>
                <div class="relative group">
                    <input type="text" wire:model.live="search" placeholder="BUSCAR..." class="w-full bg-transparent border-b-2 border-white/10 py-4 md:py-6 text-3xl md:text-6xl font-bebas tracking-widest outline-none focus:border-brand-orange transition-all placeholder:text-white/5 uppercase">
                    <div class="absolute right-0 bottom-4 md:bottom-6 text-white/20 group-focus-within:text-brand-orange">
                        <svg class="w-8 h-8 md:w-12 md:h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        {{-- LISTADO DE PROYECTOS --}}
        <div class="border border-white/10 bg-[#080808]">
            <div class="hidden md:grid grid-cols-12 gap-4 px-10 py-5 bg-white/[0.03] border-b border-white/10">
                <div class="col-span-2 text-white/40 font-mono text-[10px] font-black tracking-[3px]">REFERENCIA</div>
                <div class="col-span-7 text-white/40 font-mono text-[10px] font-black tracking-[3px]">DETALLES DEL PROYECTO</div>
                <div class="col-span-3 text-right text-white/40 font-mono text-[10px] font-black tracking-[3px]">ESTADO</div>
            </div>

            @forelse($proyectos as $proyecto)
            <div class="group relative flex flex-col md:grid md:grid-cols-12 gap-4 px-6 md:px-10 py-8 md:py-12 items-start md:items-center hover:bg-white/[0.01] transition-all border-b border-white/5">

                {{-- Radicado de fondo (Solo Desktop para evitar ruido en móvil) --}}
                <span class="hidden md:block absolute right-10 top-1/2 -translate-y-1/2 font-bebas text-[11rem] text-white/[0.01] pointer-events-none uppercase tracking-tighter">
                    {{ $proyecto->codigo_radicado }}
                </span>

                {{-- 1. Info de Referencia --}}
                <div class="md:col-span-2 relative z-10">
                    <span class="text-brand-orange font-mono text-sm font-black italic">#{{ $proyecto->codigo_radicado }}</span>
                </div>

                {{-- 2. Título --}}
                <div class="md:col-span-7 relative z-10 w-full">
                    <h3 class="text-white text-2xl md:text-5xl font-bebas tracking-wider group-hover:text-brand-orange transition-colors uppercase leading-none break-words">
                        {{ $proyecto->titulo }}
                    </h3>
                </div>

                {{-- 3. Estatus --}}
                <div class="md:col-span-3 w-full md:text-right relative z-10 mt-4 md:mt-0">
                    @if($proyecto->publicado)
                    <div class="inline-flex flex-col items-start md:items-end border-l-2 md:border-l-0 md:border-r-2 border-brand-orange pl-4 md:pr-4">
                        <span class="text-white font-bebas text-2xl md:text-3xl tracking-widest uppercase leading-none">{{ $proyecto->estado->nombre }}</span>
                        <span class="text-white/20 font-mono text-[8px] md:text-[9px] font-black uppercase tracking-[2px] mt-1 italic">Trámite Activo</span>
                    </div>
                    @else
                    <span class="text-white/20 font-bebas text-2xl tracking-widest uppercase italic">EN REVISIÓN</span>
                    @endif
                </div>
            </div>
            @empty
            <div class="py-20 md:py-40 text-center px-6">
                <span class="block font-bebas text-5xl md:text-8xl text-white/5 uppercase tracking-tighter">DATA_NOT_FOUND</span>
            </div>
            @endforelse
        </div>
    </main>

    {{-- FOOTER --}}
    <footer class="p-8 md:p-16 border-t-[6px] md:border-t-[10px] border-brand-orange flex flex-col md:flex-row justify-between items-start md:items-center gap-8 bg-[#050505]">
        <span class="font-bebas text-3xl md:text-5xl text-white uppercase">Actores <span class="text-brand-orange">SCG</span></span>
        <div class="flex items-center gap-4 md:gap-8 border-l border-white/10 pl-4 md:pl-8">
            <div class="w-10 h-10 md:w-14 md:h-14 border border-brand-orange/20 flex items-center justify-center">
                <div class="w-2 h-2 bg-brand-orange animate-ping rounded-full"></div>
            </div>
            <span class="font-mono text-[9px] md:text-[11px] text-white/40 uppercase tracking-[2px]">SISTEMA 24/7</span>
        </div>
    </footer>
</div>