<div class="bg-black min-h-screen text-white font-montserrat antialiased selection:bg-brand-orange selection:text-white" wire:poll.10s>
    
    {{-- 1. NAVEGACIÓN --}}
    <nav class="fixed top-0 left-0 w-full z-[1000] flex justify-between items-center px-6 py-5 md:px-12 bg-black/95 border-b border-white/10 backdrop-blur-md">
        <a href="/" class="flex items-center gap-4 no-underline">
            <span class="font-bebas text-3xl md:text-4xl text-brand-orange tracking-[2px]">ACTORES <span class="text-white">S.C.G.</span></span>
        </a>
        <a href="/" class="no-underline text-white/60 font-bebas text-xl tracking-[2px] hover:text-brand-orange transition-all flex items-center gap-3 group">
            <span class="text-2xl group-hover:-translate-x-2 transition-transform">←</span> VOLVER AL INICIO
        </a>
    </nav>

    <main class="max-w-[1400px] mx-auto pt-40 pb-20 px-8">
        
        {{-- HERO SECTION: IMPACTO RADICAL --}}
        <div class="border-l-[15px] border-brand-orange pl-8 md:pl-16 mb-24">
            <span class="text-brand-orange tracking-[10px] text-[10px] font-black uppercase mb-4 block opacity-80">// PLATAFORMA_DE_TRANSPARENCIA_2026</span>
            <h1 class="font-bebas text-[10vw] md:text-[8.5rem] leading-[0.8] mb-12 tracking-tighter uppercase">
                MONITOR <br><span class="text-brand-orange">DE PROYECTOS</span>
            </h1>
            
            <div class="flex flex-wrap gap-12 items-center">
                {{-- Botón Principal --}}
                <a href="{{ route('validar-socio') }}" class="group flex items-center gap-6 no-underline bg-white/[0.03] border border-white/10 p-5 pr-12 hover:bg-brand-orange transition-all duration-500">
                    <div class="w-16 h-16 bg-brand-orange group-hover:bg-white flex items-center justify-center transition-all">
                        <svg class="w-8 h-8 text-white group-hover:text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" />
                        </svg>
                    </div>
                    <div>
                        <span class="block font-bebas text-4xl text-white group-hover:text-black leading-none uppercase tracking-wider">¡Inscribirme Ahora!</span>
                        <span class="text-brand-orange group-hover:text-black/70 text-[10px] uppercase tracking-[3px] font-black">Abrir formulario oficial</span>
                    </div>
                </a>

                {{-- Contador Masivo --}}
                <div class="flex items-end gap-4">
                    <span class="text-white font-bebas text-8xl leading-none">{{ $total }}</span>
                    <div class="pb-2">
                        <span class="block text-brand-orange text-[10px] uppercase tracking-[4px] font-black leading-none">Proyectos</span>
                        <span class="block text-white/40 text-[10px] uppercase tracking-[4px] font-black leading-none">Registradas</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- GRID DE CRONOGRAMA: ESTILO INDUSTRIAL --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-32">
            @if($convocatoriaActual)
                @foreach($convocatoriaActual->etapas->sortBy('orden') as $etapa)
                    @php $activa = $etapa->estaActiva(); @endphp
                    <div class="relative p-8 border {{ $activa ? 'border-brand-orange bg-brand-orange/5' : 'border-white/5 bg-white/[0.01] opacity-40' }}">
                        @if($activa)
                            <div class="absolute top-0 right-0 bg-brand-orange text-black font-black text-[9px] px-3 py-1 tracking-widest uppercase animate-pulse">
                                Etapa Abierta
                            </div>
                        @endif
                        <span class="font-bebas text-xl text-brand-orange block mb-6 tracking-[3px]">ETAPA 0{{ $etapa->orden }}</span>
                        <h4 class="font-bebas text-3xl text-white mb-4 uppercase tracking-tighter leading-none">{{ $etapa->nombre }}</h4>
                        
                        <div class="space-y-1 border-t border-white/10 pt-4">
                            <p class="text-[10px] uppercase font-black tracking-[2px] text-gray-500">Cierre de fase:</p>
                            <p class="font-bebas text-5xl text-white leading-none tracking-tighter">{{ $etapa->fecha_fin->format('d / M') }}</p>
                            <p class="font-mono text-[11px] font-bold text-brand-orange uppercase">{{ $etapa->fecha_fin->format('h:i A') }}</p>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        {{-- BÚSQUEDA: ESTILO CINEMÁTICO --}}
        <div class="mb-20">
            <div class="max-w-7xl">
                <p class="text-brand-orange font-black text-[11px] tracking-[8px] uppercase mb-6">// BUSCADOR_DE_RADICADOS</p>
                <div class="relative group">
                    <input type="text" wire:model.live="search" 
                        placeholder="BUSCAR POR NOMBRE O RADICADO..." 
                        class="w-full bg-transparent border-b-2 border-white/10 py-6 text-white text-4xl md:text-6xl font-bebas tracking-widest outline-none focus:border-brand-orange transition-all placeholder:text-white/5 uppercase">
                    <div class="absolute right-0 bottom-6 text-white/20 group-focus-within:text-brand-orange transition-colors">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        {{-- LISTADO DE PROYECTOS --}}
        <div class="border border-white/10 bg-white/[0.02]">
            {{-- Header --}}
            <div class="grid grid-cols-12 gap-4 px-10 py-6 bg-white/[0.03] border-b border-white/10">
                <div class="col-span-8 md:col-span-9 text-brand-orange font-bebas text-xl tracking-[4px]">PROYECTO AUDIOVISUAL / RADICADO</div>
                <div class="col-span-4 md:col-span-3 text-right text-brand-orange font-bebas text-xl tracking-[4px]">ESTATUS ACTUAL</div>
            </div>

            @forelse($proyectos as $proyecto)
                <div class="group relative grid grid-cols-12 gap-4 px-10 py-14 items-center hover:bg-brand-orange/[0.02] transition-all border-b border-white/5 overflow-hidden">
                    {{-- Radicado de fondo decorativo --}}
                    <span class="absolute right-10 top-1/2 -translate-y-1/2 font-bebas text-[12rem] text-white/[0.02] pointer-events-none select-none uppercase">
                        #{{ $proyecto->codigo_radicado }}
                    </span>

                    <div class="col-span-12 md:col-span-9 relative z-10">
                        <div class="flex flex-col gap-3">
                            <div class="flex items-center gap-4">
                                <span class="bg-brand-orange text-black px-3 py-0.5 font-mono text-[11px] font-black uppercase tracking-tighter">
                                    ID-{{ $proyecto->id + 1000 }}
                                </span>
                                <span class="text-brand-orange font-mono text-xs font-bold tracking-[3px]">#{{ $proyecto->codigo_radicado }}</span>
                            </div>
                            <h3 class="text-white text-4xl md:text-5xl font-bebas tracking-wider group-hover:text-brand-orange transition-colors uppercase leading-none">
                                {{ $proyecto->titulo }}
                            </h3>
                            <div class="flex items-center gap-4 mt-2 font-mono text-[10px] text-white/30 uppercase tracking-[2px]">
                                <span>FECHA DE REGISTRO: {{ $proyecto->created_at->format('d.m.Y') }}</span>
                                <span class="text-brand-orange">|</span>
                                <span>VERIFICACIÓN SSL-SECURE</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-12 md:col-span-3 text-left md:text-right mt-8 md:mt-0 relative z-10">
                        @if($proyecto->estado_id == 7)
                            <div class="inline-flex flex-col items-end">
                                <span class="text-emerald-500 font-bebas text-4xl tracking-tighter uppercase italic leading-none">SELECCIONADO</span>
                                <span class="text-emerald-500/40 font-mono text-[9px] font-black uppercase tracking-[3px]">Clasificación Etapa IV</span>
                            </div>
                        @elseif($proyecto->estado_id == 2)
                            <a href="{{ route('validar-socio') }}" class="inline-block bg-white text-black px-10 py-4 font-bebas text-2xl tracking-tight no-underline hover:bg-brand-orange hover:text-white transition-all shadow-xl">
                                SUBSANAR AHORA
                            </a>
                        @else
                            <div class="inline-flex flex-col items-end">
                                <span class="text-white/60 font-bebas text-3xl tracking-widest uppercase leading-none">{{ $proyecto->estado->nombre }}</span>
                                <span class="text-white/20 font-mono text-[9px] font-black uppercase tracking-[2px]">En revisión técnica</span>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="py-40 text-center">
                    <span class="block font-bebas text-8xl text-white/5 uppercase italic mb-4">NO_DATA_FOUND</span>
                    <p class="text-brand-orange font-mono text-xs tracking-[5px] uppercase">No hay proyectos que coincidan con la búsqueda</p>
                </div>
            @endforelse
        </div>

    </main>

    {{-- FOOTER INDUSTRIAL --}}
    <footer class="p-16 border-t-[10px] border-brand-orange flex flex-col md:flex-row justify-between items-center gap-12 bg-[#050505]">
        <div class="flex flex-col gap-3">
            <span class="font-bebas text-5xl text-white tracking-[2px] uppercase leading-none">Actores <span class="text-brand-orange">SCG</span></span>
            <span class="font-mono text-[10px] font-black tracking-[6px] uppercase text-white/20 italic">Protegiendo la gestión del talento colombiano</span>
        </div>
        
        <div class="flex items-center gap-8 border-l border-white/10 pl-8">
            <div class="text-right">
                <span class="block font-mono text-[10px] font-black text-brand-orange tracking-[3px] uppercase">Estado del Servidor</span>
                <span class="block font-mono text-[11px] text-white/40 uppercase tracking-[2px]">SISTEMA DE MONITOREO 24/7</span>
            </div>
            <div class="w-14 h-14 border-2 border-brand-orange/20 flex items-center justify-center">
                <div class="w-3 h-3 bg-brand-orange animate-ping rounded-full"></div>
            </div>
        </div>
    </footer>
</div>