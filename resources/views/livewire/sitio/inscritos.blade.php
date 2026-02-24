<div class="bg-black min-h-screen text-white font-outfit antialiased selection:bg-[#ff6600] selection:text-white" wire:poll.10s>

    {{-- 1. NAVEGACIÓN (Mantenida según tu solicitud) --}}
    <nav class="fixed top-0 left-0 w-full z-[1000] flex justify-between items-center px-6 py-6 md:px-12 bg-black/95 backdrop-blur-xl border-b border-white/5">
        <a href="/" class="font-bebas text-4xl text-[#ff6600] tracking-[3px] no-underline">
            ACTORES <span class="text-white">S.C.G.</span>
        </a>
        <ul class="flex items-center gap-8 list-none m-0 p-0">
            <li>
                <a href="/" class="no-underline text-gray-400 font-bebas text-xl tracking-[2px] hover:text-[#ff6600] transition-all flex items-center gap-2">
                    <span class="text-2xl">←</span> VOLVER AL INICIO
                </a>
            </li>
        </ul>
    </nav>

    <main class="max-w-[1400px] mx-auto pt-48 pb-20 px-8">

        {{-- HERO SECTION: IMPACTO RADICAL --}}
        <div class="border-l-[12px] border-[#ff6600] pl-8 md:pl-16 mb-24">
            <span class="text-white/30 tracking-[12px] text-xs font-black uppercase mb-6 block">Plataforma de Transparencia 2026</span>
            <h1 class="font-bebas text-[11vw] md:text-[9rem] leading-[0.8] mb-12 tracking-tighter">
                MONITOR <br><span class="text-[#ff6600]">DE PROYECTOS</span>
            </h1>

            <div class="flex flex-wrap gap-8 items-center">
                {{-- Botón Principal: Inscripción --}}
                <a href="{{ route('validar-socio') }}" class="group flex items-center gap-6 no-underline bg-white/5 p-4 pr-10 hover:bg-[#ff6600] transition-all duration-500 rounded-full">
                    <div class="w-16 h-16 rounded-full bg-[#ff6600] group-hover:bg-white flex items-center justify-center transition-all">
                        <svg class="w-8 h-8 text-white group-hover:text-[#ff6600]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                        </svg>
                    </div>
                    <div>
                        <span class="block font-bebas text-3xl text-white group-hover:text-black leading-none uppercase">¡Quiero Inscribirme!</span>
                        <span class="text-white/40 group-hover:text-black/60 text-[10px] uppercase tracking-[3px] font-bold">Inicia tu postulación aquí</span>
                    </div>
                </a>

                <div class="h-16 w-[1px] bg-white/10 hidden md:block"></div>

                {{-- Acceso a Estado --}}
                <a href="{{ route('validar-socio') }}" class="group flex flex-col no-underline border-b-2 border-transparent hover:border-[#ff6600] pb-2 transition-all">
                    <span class="text-white font-bebas text-3xl tracking-tighter uppercase">Ver mi estado</span>
                    <span class="text-[#ff6600] text-[10px] uppercase tracking-[3px] font-black">Acceso a postulantes</span>
                </a>

                <div class="h-16 w-[1px] bg-white/10 hidden md:block"></div>

                {{-- Contador --}}
                <div class="flex flex-col">
                    <span class="text-[#ff6600] font-bebas text-6xl leading-none">{{ $total }}</span>
                    <span class="text-white/40 text-[10px] uppercase tracking-[4px] font-black">Obras Registradas</span>
                </div>
            </div>
        </div>

        {{-- GRID DE CRONOGRAMA: LAS FECHAS SON PROTAGONISTAS --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-1 mb-24 bg-white/5 border border-white/5">
            @if($convocatoriaActual)
            @foreach($convocatoriaActual->etapas->sortBy('orden') as $etapa)
            @php $activa = $etapa->estaActiva(); @endphp
            <div class="p-10 transition-all {{ $activa ? 'bg-[#ff6600] text-black shadow-[0_0_50px_rgba(255,102,0,0.2)]' : 'bg-black opacity-30' }}">
                <div class="flex justify-between items-start mb-10">
                    <span class="font-bebas text-2xl uppercase tracking-widest">{{ $etapa->nombre }}</span>
                    <span class="font-bebas text-5xl opacity-20">0{{ $etapa->orden }}</span>
                </div>
                <div class="space-y-1">
                    <p class="text-[10px] uppercase font-black tracking-[3px] opacity-60">Fecha Límite de Cierre</p>
                    <p class="font-bebas text-[3.5rem] leading-none tracking-tighter">{{ $etapa->fecha_fin->format('d.M') }}</p>
                    <p class="font-mono text-sm font-bold opacity-80">{{ $etapa->fecha_fin->format('h:i A') }} / 2026</p>
                </div>
                @if($activa)
                <div class="mt-8 pt-6 border-t border-black/20 flex items-center gap-3">
                    <span class="flex h-3 w-3 relative">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-black opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-black"></span>
                    </span>
                    <span class="text-[10px] font-black uppercase tracking-[4px]">Etapa actualmente abierta</span>
                </div>
                @endif
            </div>
            @endforeach
            @endif
        </div>

        {{-- CONTENEDOR DE BÚSQUEDA: DISEÑO DE GALERÍA --}}
        <div class="mb-32">
            <div class="max-w-7xl">
                {{-- Título sutil --}}
                <p class="text-[#ff6600] font-bold text-[10px] tracking-[6px] uppercase mb-4">Buscador Oficial</p>

                {{-- Input Masivo y Limpio --}}
                <div class="relative">
                    <input type="text" wire:model.live="search"
                        placeholder="Escriba el nombre de la obra..."
                        class="w-full bg-transparent border-none p-0 text-white text-4xl md:text-7xl font-light tracking-tighter outline-none placeholder:text-white/5 uppercase">

                    {{-- Línea de acento dinámica --}}
                    <div class="h-[1px] w-full bg-white/10 mt-6 relative">
                        <div class="absolute top-0 left-0 h-[2px] bg-[#ff6600] transition-all duration-700 w-24 group-focus-within:w-full"></div>
                    </div>
                </div>

                {{-- Instrucciones en lenguaje natural --}}
                <div class="mt-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-6 w-full">
                    {{-- Texto a la izquierda --}}
                    <p class="text-gray-500 text-sm max-w-md leading-relaxed m-0">
                        Utilice el buscador para filtrar por el título exacto de su proyecto audiovisual o el número de radicado asignado.
                    </p>

                    {{-- Botón a la derecha --}}
                    <div class="flex shrink-0">
                        <a href="{{ route('validar-socio') }}" class="text-white text-[11px] font-black uppercase tracking-[3px] border border-white/20 px-8 py-4 hover:bg-[#ff6600] hover:border-[#ff6600] hover:text-white transition-all no-underline whitespace-nowrap">
                            Ver mi estado de postulación
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- LISTADO DE PROYECTOS: MINIMALISMO TOTAL --}}
        <div class="space-y-1">
            {{-- Encabezado de tabla minimalista --}}
            <div class="grid grid-cols-12 gap-4 px-8 py-4 border-b border-white/5 text-[10px] font-black uppercase tracking-[4px] text-gray-600">
                <div class="col-span-8 md:col-span-9">Proyecto Audiovisual</div>
                <div class="col-span-4 md:col-span-3 text-right">Estatus</div>
            </div>

            @forelse($proyectos as $proyecto)
            <div class="group relative grid grid-cols-12 gap-4 px-8 py-12 items-center hover:bg-white/[0.02] transition-all border-b border-white/5">

                {{-- Columna de Información --}}
                <div class="col-span-12 md:col-span-9">
                    <div class="flex flex-col gap-2">
                        <span class="text-[#ff6600] font-mono text-[10px] font-bold tracking-[2px]">
                            #{{ $proyecto->codigo_radicado }}
                        </span>
                        <h3 class="text-white text-3xl md:text-5xl font-medium tracking-tight group-hover:translate-x-2 transition-transform duration-500 uppercase">
                            {{ $proyecto->titulo }}
                        </h3>
                        <div class="flex gap-6 mt-2 text-[10px] text-gray-500 uppercase tracking-[2px]">
                            <span>Registro: {{ $proyecto->created_at->format('d/m/Y') }}</span>
                            <span class="hidden md:inline">•</span>
                            <span class="hidden md:inline">Cód. Sistema: {{ $proyecto->id + 1000 }}</span>
                        </div>
                    </div>
                </div>

                {{-- Columna de Estado --}}
                <div class="col-span-12 md:col-span-3 text-left md:text-right mt-6 md:mt-0">
                    @if($proyecto->estado_id == 7)
                    <span class="text-emerald-500 font-bebas text-3xl tracking-widest uppercase italic">Seleccionado</span>
                    @elseif($proyecto->estado_id == 2)
                    <a href="{{ route('validar-socio') }}" class="inline-block bg-[#ff6600] text-black px-8 py-3 font-bebas text-2xl tracking-tighter no-underline hover:bg-white transition-colors">
                        Subsanar Documentos
                    </a>
                    @else
                    <span class="text-white/40 font-bebas text-2xl tracking-widest uppercase">
                        {{ $proyecto->estado->nombre }}
                    </span>
                    @endif
                </div>

                {{-- Decoración lateral sutil --}}
                <div class="absolute left-0 top-1/2 -translate-y-1/2 w-[2px] h-0 bg-[#ff6600] group-hover:h-1/2 transition-all duration-500"></div>
            </div>
            @empty
            <div class="py-32 text-center">
                <p class="text-white/10 font-bebas text-6xl uppercase italic">Sin resultados encontrados</p>
            </div>
            @endforelse
        </div>

        {{-- PAGINACIÓN --}}
        @if($proyectos->hasPages())
        <div class="mt-10 flex justify-center">
            {{ $proyectos->links() }}
        </div>
        @endif

    </main>

    {{-- FOOTER --}}
    <footer class="p-12 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-8 bg-[#030303]">
        <div class="flex flex-col gap-2">
            <span class="font-bebas text-3xl text-white tracking-widest uppercase leading-none">Actores SCG</span>
            <span class="font-mono text-[9px] font-bold tracking-[5px] uppercase text-white/30 italic">© 2026 Sociedad Colombiana de Gestión</span>
        </div>
        <div class="flex items-center gap-6">
            <div class="text-right">
                <span class="block font-mono text-[9px] font-black text-[#ff6600] tracking-[2px] uppercase">Estado del Sistema</span>
                <span class="block font-mono text-[9px] text-white/40 uppercase tracking-[2px]">Conexión Encriptada SSL-256</span>
            </div>
            <div class="w-12 h-12 border border-white/10 flex items-center justify-center">
                <div class="w-2 h-2 rounded-full bg-[#ff6600] animate-pulse"></div>
            </div>
        </div>
    </footer>
</div>