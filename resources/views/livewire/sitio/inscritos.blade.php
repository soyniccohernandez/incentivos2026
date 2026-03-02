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

            <div class="flex flex-wrap items-stretch gap-0 border border-white/10 bg-white/[0.02]">

                {{-- BLOQUE A: MÉTRICA DE IMPACTO (EL DATO) --}}
                <div class="flex items-center gap-8 px-10 py-8 border-r border-white/10 bg-white/[0.01]">
                    <div class="relative">
                        <span class="text-white font-bebas text-9xl leading-none tracking-tighter block">
                            {{ $total }}
                        </span>
                        {{-- Badge técnico sobre el número --}}
                        <span class="absolute -top-2 -right-4 bg-brand-orange text-black font-black text-[8px] px-2 py-0.5 tracking-tighter uppercase">
                            Live_Data
                        </span>
                    </div>
                    <div class="flex flex-col border-l border-brand-orange/30 pl-6">
                        <span class="text-brand-orange text-[11px] font-black uppercase tracking-[5px] leading-tight">Proyectos</span>
                        <span class="text-white/40 text-[11px] font-black uppercase tracking-[5px] leading-tight italic">Registrados</span>

                        {{-- Indicador de actividad del sistema --}}
                        <div class="flex items-center gap-2 mt-4">
                            <div class="flex gap-1">
                                <div class="w-1 h-3 bg-brand-orange/40"></div>
                                <div class="w-1 h-3 bg-brand-orange"></div>
                                <div class="w-1 h-3 bg-brand-orange/20"></div>
                            </div>
                            <span class="text-[8px] font-mono text-white/20 uppercase tracking-[2px]">Sincronizado</span>
                        </div>
                    </div>
                </div>

                {{-- BLOQUE B: PANEL DE IDENTIDAD TÉCNICA (Sustituye al botón) --}}
                <div class="flex flex-1 items-center justify-between px-12 py-8 relative overflow-hidden group">
                    {{-- Fondo decorativo técnico --}}
                    <div class="absolute inset-0 opacity-[0.03] pointer-events-none">
                        <svg width="100%" height="100%">
                            <pattern id="grid" width="20" height="20" patternUnits="userSpaceOnUse">
                                <path d="M 20 0 L 0 0 0 20" fill="none" stroke="white" stroke-width="0.5" />
                            </pattern>
                            <rect width="100%" height="100%" fill="url(#grid)" />
                        </svg>
                    </div>

                    <div class="relative z-10">
                        <h2 class="font-bebas text-5xl text-white leading-[0.8] uppercase tracking-tighter">
                            REGISTRO <span class="text-brand-orange italic">CONSOLIDADO</span>
                        </h2>
                        <div class="flex items-center gap-3 mt-3">
                            <span class="text-white/30 font-mono text-[9px] uppercase tracking-[3px]">Protocolo de Verificación: SCG-V.26</span>
                            <span class="w-2 h-2 rounded-full bg-emerald-500/50 animate-pulse"></span>
                        </div>
                    </div>

                    {{-- Icono de seguridad/monitoreo: RE-DIBUJADO --}}
                    <div class="hidden md:flex flex-col items-end opacity-20 group-hover:opacity-60 transition-all duration-700">
                        <div class="relative">
                            {{-- Brillo sutil de fondo en hover --}}
                            <div class="absolute inset-0 bg-brand-orange/20 blur-xl opacity-0 group-hover:opacity-100 transition-opacity"></div>

                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-16 h-16 text-white relative z-10 icon icon-tabler icon-tabler-file-text-shield"
                                viewBox="0 0 24 24"
                                stroke-width="1" {{-- Grosor más fino para look más elegante/técnico --}}
                                stroke="currentColor"
                                fill="none"
                                stroke-linecap="round"
                                stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M13 3v4a.997 .997 0 0 0 1 1h4" />
                                <path d="M11 21h-5a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v3.5" />
                                <path d="M8 9h1" />
                                <path d="M8 12.994l3 0" />
                                <path d="M8 16.997l2 0" />
                                <path d="M21 15.994c0 4 -2.5 6 -3.5 6s-3.5 -2 -3.5 -6c1 0 2.5 -.5 3.5 -1.5c1 1 2.5 1.5 3.5 1.5" />
                            </svg>
                        </div>

                        <div class="text-right mt-3">
                            <span class="block text-[8px] font-mono text-white/50 tracking-[3px] leading-none uppercase">Database_Secure</span>
                            <span class="block text-[7px] font-mono text-brand-orange tracking-[2px] mt-1 font-black uppercase">SCG-2026-SSL</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- GRID DE CRONOGRAMA --}}
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

        {{-- BÚSQUEDA --}}
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

        {{-- LISTADO DE PROYECTOS: RE-DIBUJADO PARA MÁXIMA CLARIDAD --}}
        <div class="border border-white/10 bg-[#080808]">
            {{-- Header refinado --}}
            <div class="hidden md:grid grid-cols-12 gap-4 px-10 py-5 bg-white/[0.03] border-b border-white/10">
                <div class="col-span-2 text-white/40 font-mono text-[10px] font-black tracking-[3px]">REFERENCIA</div>
                <div class="col-span-7 text-white/40 font-mono text-[10px] font-black tracking-[3px]">DETALLES DEL PROYECTO</div>
                <div class="col-span-3 text-right text-white/40 font-mono text-[10px] font-black tracking-[3px]">ESTADO DE TRÁMITE</div>
            </div>

            @forelse($proyectos as $proyecto)
            <div class="group relative grid grid-cols-12 gap-4 px-10 py-12 items-center hover:bg-white/[0.01] transition-all border-b border-white/5 overflow-hidden">

                {{-- Radicado de fondo (más sutil) --}}
                <span class="absolute right-10 top-1/2 -translate-y-1/2 font-bebas text-[11rem] text-white/[0.01] pointer-events-none select-none uppercase tracking-tighter">
                    {{ $proyecto->codigo_radicado }}
                </span>

                {{-- 1. Info de Referencia --}}
                <div class="col-span-12 md:col-span-2 relative z-10 mb-4 md:mb-0">
                    <div class="flex flex-col gap-1">
                        <span class="text-brand-orange font-mono text-sm font-black tracking-tighter italic">#{{ $proyecto->codigo_radicado }}</span>
                        <span class="text-white/20 font-mono text-[9px] uppercase tracking-widest italic">ID-{{ $proyecto->id + 1000 }}</span>
                    </div>
                </div>

                {{-- 2. Título y Meta --}}
                <div class="col-span-12 md:col-span-7 relative z-10">
                    <div class="flex flex-col gap-2">
                        <h3 class="text-white text-4xl md:text-5xl font-bebas tracking-wider group-hover:text-brand-orange transition-colors uppercase leading-none">
                            {{ $proyecto->titulo }}
                        </h3>
                        <div class="flex items-center gap-4 font-mono text-[10px] text-white/30 uppercase tracking-[2px]">
                            <span class="flex items-center gap-2">
                                <span class="w-1.5 h-1.5 bg-brand-orange rounded-full"></span>
                                REGISTRO: {{ $proyecto->created_at->format('d.m.Y') }}
                            </span>
                            <span class="hidden md:block">|</span>
                            <span class="hidden md:block text-white/10 italic">VERIFICACIÓN_SSL_ACTIVA</span>
                        </div>
                    </div>
                </div>

                {{-- 3. Estatus Lateral --}}
                {{-- 3. Estatus Lateral --}}
                <div class="col-span-12 md:col-span-3 text-left md:text-right relative z-10">
                    @if($proyecto->publicado)
                    @if($proyecto->estado_id == 7)
                    {{-- SELECCIONADO --}}
                    <div class="inline-flex flex-col items-start md:items-end border-l-2 md:border-l-0 md:border-r-2 border-emerald-500 pl-4 md:pr-4">
                        <span class="text-emerald-500 font-bebas text-4xl tracking-tighter uppercase italic leading-none">SELECCIONADO</span>
                        <span class="text-emerald-500/30 font-mono text-[9px] font-black uppercase tracking-[2px] mt-1">Clasificación Etapa IV</span>
                    </div>

                    @elseif($proyecto->estado_id == 2)
                    {{-- SUBSANACIÓN --}}
                    <div class="flex flex-col md:items-end gap-2">
                        <a href="{{ route('validar-socio') }}" class="inline-block bg-white text-black px-8 py-3 font-bebas text-xl tracking-tight no-underline hover:bg-brand-orange hover:text-white transition-all shadow-xl">
                            SUBSANAR AHORA
                        </a>
                        <span class="text-red-500 font-mono text-[9px] font-black uppercase tracking-[2px] animate-pulse italic">Requiere Subsanación</span>
                    </div>

                    @elseif($proyecto->estado_id == 4)
                    {{-- ETAPA 2: COMPLETAR FORMULARIO --}}
                    <div class="flex flex-col md:items-end gap-2">
                        <a href="{{ route('validar-socio') }}" class="inline-block bg-brand-orange text-white px-8 py-3 font-bebas text-xl tracking-tight no-underline hover:bg-black transition-all shadow-xl">
                            COMPLETAR ETAPA 2
                        </a>
                        <span class="text-white/60 font-mono text-[9px] font-black uppercase tracking-[2px] italic">Formulario Técnico Pendiente</span>
                    </div>

                    @elseif(in_array($proyecto->estado_id, [8, 9]))
                    {{-- ELIMINADO O NO SELECCIONADO --}}
                    <div class="flex flex-col md:items-end gap-2">
                        <a href="{{ route('validar-socio') }}" class="inline-block bg-gray-600 text-white px-8 py-3 font-bebas text-xl tracking-tight no-underline hover:bg-red-700 transition-all shadow-xl">
                            {{ $proyecto->estado_id == 8 ? 'ELIMINADO' : 'NO SELECCIONADO' }}
                        </a>
                        <span class="text-white/40 font-mono text-[9px] font-black uppercase tracking-[2px] italic">Ver motivo de rechazo</span>
                    </div>

                    @else
                    {{-- ESTADOS POR DEFECTO (EN REVISIÓN) --}}
                    <div class="inline-flex flex-col items-start md:items-end border-l-2 md:border-l-0 md:border-r-2 border-white/20 pl-4 md:pr-4">
                        <span class="text-white/60 font-bebas text-3xl tracking-widest uppercase leading-none">{{ $proyecto->estado->nombre }}</span>
                        <span class="text-white/20 font-mono text-[9px] font-black uppercase tracking-[2px] mt-1 italic">En revisión técnica</span>
                    </div>
                    @endif
                    @else
                    {{-- NO PUBLICADO --}}
                    <div class="inline-flex flex-col items-start md:items-end opacity-20 border-l-2 md:border-l-0 md:border-r-2 border-white/10 pl-4 md:pr-4 italic">
                        <span class="text-white font-bebas text-3xl tracking-widest uppercase leading-none">EN REVISIÓN</span>
                        <span class="text-white font-mono text-[9px] font-black uppercase tracking-[2px] mt-1">Estatus en proceso</span>
                    </div>
                    @endif
                </div>

                {{-- Línea de acento vertical --}}
                <div class="absolute left-0 top-0 w-[3px] h-full bg-brand-orange opacity-0 group-hover:opacity-100 transition-opacity"></div>
            </div>
            @empty
            <div class="py-40 text-center">
                <span class="block font-bebas text-8xl text-white/5 uppercase italic mb-4 tracking-tighter">DATA_NOT_FOUND</span>
                <p class="text-brand-orange font-mono text-xs tracking-[5px] uppercase italic">No se han encontrado registros en la base de datos</p>
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