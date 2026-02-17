<div class="bg-black min-h-screen text-white font-montserrat antialiased" wire:poll.10s>
    {{-- 1. NAVEGACIÓN --}}
    <nav class="fixed top-0 left-0 w-full z-[1000] flex justify-between items-center px-6 py-5 md:px-12 bg-black/95 border-b border-[#1a1a1a]">
        <a href="/" class="font-bebas text-3xl text-[#ff6600] tracking-[2px] no-underline">ACTORES S.C.G.</a>
        <ul class="flex items-center gap-8 list-none m-0 p-0">
            <li>
                <a href="/" class="no-underline text-white font-bebas text-xl tracking-[1.5px] opacity-80 hover:text-[#ff6600] hover:opacity-100 transition-all">
                    ← VOLVER AL INICIO
                </a>
            </li>
        </ul>
    </nav>

    {{-- 2. CONTENIDO PRINCIPAL --}}
    <div class="max-w-[1100px] mx-auto pt-40 pb-24 px-6">
        <div class="relative mb-10">
            <span class="text-[#ff6600] tracking-[8px] text-[10px] font-bold uppercase mb-4 block">Transparencia Institucional</span>
            <h2 class="font-bebas text-[4rem] md:text-[6rem] leading-[0.9] mb-4 tracking-wider">
                PROYECTOS <span class="text-[#ff6600]">INSCRITOS</span>
            </h2>
            <div class="w-24 h-1 bg-[#ff6600] mb-6"></div>
            
            {{-- BARRA DE ETAPAS (Sincronizada con Horas) --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-8 bg-[#0a0a0a] border border-[#1a1a1a] p-6">
                @if($convocatoriaActual)
                    @foreach($convocatoriaActual->etapas->sortBy('orden') as $etapa)
                        @php
                            $activa = $etapa->estaActiva();
                            $futura = now() < $etapa->fecha_inicio;
                        @endphp
                        <div class="flex items-center gap-4 {{ $activa ? 'opacity-100' : 'opacity-30' }}">
                            <div class="w-10 h-10 flex items-center justify-center border {{ $activa ? 'border-[#ff6600] text-[#ff6600] shadow-[0_0_15px_rgba(255,102,0,0.4)]' : 'border-gray-800 text-gray-600' }} font-bebas text-xl">
                                {{ $etapa->orden }}
                            </div>
                            <div>
                                <p class="text-[10px] uppercase tracking-tighter font-bold {{ $activa ? 'text-[#ff6600]' : 'text-gray-500' }}">
                                    {{ $etapa->nombre }}
                                    @if($activa) 
                                        <span class="ml-2 animate-pulse text-[8px] bg-[#ff6600] text-black px-1 rounded">EN VIVO</span> 
                                    @endif
                                </p>
                                <p class="text-[10px] font-mono {{ $activa ? 'text-gray-200' : 'text-gray-600' }}">
                                    {{ $etapa->fecha_inicio->format('d M, h:i A') }} — {{ $etapa->fecha_fin->format('d M, h:i A') }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        {{-- Panel de Control --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12 items-end">
            <div class="md:col-span-2">
                <label class="text-[10px] uppercase tracking-[3px] text-gray-500 font-bold mb-3 block">Filtrar por nombre o radicado</label>
                <div class="relative">
                    <input type="text" wire:model.live="search" placeholder="EJ: EL GUION DE MI VIDA..." class="w-full bg-[#0a0a0a] border border-[#222] py-5 px-6 text-white focus:border-[#ff6600] focus:ring-1 focus:ring-[#ff6600] transition-all outline-none font-medium text-sm tracking-widest">
                </div>
            </div>
            <div class="bg-[#111] p-6 border-l-2 border-[#ff6600] flex flex-col justify-center shadow-xl">
                <span class="text-gray-500 text-[10px] uppercase tracking-[2px] font-bold">Total Recibidos</span>
                <span class="text-[#ff6600] font-bebas text-5xl leading-none mt-1">{{ $total }}</span>
            </div>
        </div>

        {{-- Tabla de Proyectos --}}
        <div class="overflow-hidden border border-[#1a1a1a] bg-[#050505] shadow-2xl">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-[#0a0a0a] border-b border-[#1a1a1a]">
                        <th class="p-6 font-bebas text-xl tracking-[3px] text-gray-400">RADICADO</th>
                        <th class="p-6 font-bebas text-xl tracking-[3px] text-gray-400">TÍTULO DE LA OBRA</th>
                        <th class="p-6 font-bebas text-xl tracking-[3px] text-gray-400 text-center">ESTADO / ACCIÓN</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#121212]">
                    @forelse($proyectos as $proyecto)
                        <tr class="hover:bg-white/[0.02] transition-colors group">
                            <td class="p-6">
                                <span class="bg-[#111] text-[#ff6600] px-3 py-2 rounded font-bold tracking-tighter border border-[#222] font-mono text-sm">
                                    {{ $proyecto->codigo_radicado }}
                                </span>
                            </td>
                            <td class="p-6">
                                <div class="text-white font-bold text-lg uppercase group-hover:text-[#ff6600] transition-colors duration-300">
                                    {{ $proyecto->titulo }}
                                </div>
                                <span class="text-[9px] text-gray-500 uppercase tracking-widest block mt-1">
                                    Postulado: {{ $proyecto->created_at->format('d M, Y — h:i A') }}
                                </span>
                            </td>
                            <td class="p-6 text-center">
                                <div class="flex items-center justify-center">
                                    @php
                                        // Cacheamos las etapas para esta fila para evitar consultas repetitivas
                                        $e1 = $proyecto->convocatoria->etapas->where('orden', 1)->first();
                                        $e2 = $proyecto->convocatoria->etapas->where('orden', 2)->first();
                                    @endphp

                                    {{-- 1. SUBSANACIÓN --}}
                                    @if($proyecto->estado_id == 2)
                                        @if($e1 && $e1->estaActiva())
                                            <a href="{{ route('validar-socio') }}" class="flex items-center gap-3 px-6 py-3 bg-amber-500 text-black font-bebas text-xl tracking-wider hover:bg-white transition-all no-underline shadow-[0_0_20px_rgba(245,158,11,0.3)]">
                                                CORREGIR AHORA
                                            </a>
                                        @else
                                            <div class="flex flex-col items-center">
                                                <span class="text-[10px] text-amber-500/50 border border-amber-500/20 px-4 py-2 uppercase font-bold italic">Plazo vencido</span>
                                                <span class="text-[8px] text-gray-600 mt-1 uppercase">Cerró: {{ $e1?->fecha_fin->format('d/m h:i A') }}</span>
                                            </div>
                                        @endif

                                    {{-- 2. ETAPA 2 --}}
                                    @elseif($proyecto->estado_id == 4)
                                        @if($e2 && $e2->estaActiva())
                                            <a href="{{ route('validar-socio') }}" class="flex items-center gap-2 px-6 py-3 bg-[#ff6600] text-white font-bebas text-xl tracking-wider hover:bg-white hover:text-black transition-all no-underline shadow-[0_0_20px_rgba(255,102,0,0.3)]">
                                                COMPLETAR ETAPA 2
                                            </a>
                                        @else
                                            <div class="flex flex-col items-center text-[#ff6600]/40">
                                                <span class="text-[10px] border border-[#ff6600]/20 px-4 py-2 uppercase font-bold italic">
                                                    {{ now() < ($e2?->fecha_inicio ?? now()) ? 'Próximamente' : 'Etapa cerrada' }}
                                                </span>
                                                <span class="text-[8px] mt-1 uppercase">{{ $e2?->fecha_inicio->format('d M, h:i A') }}</span>
                                            </div>
                                        @endif

                                    {{-- 3. OTROS ESTADOS --}}
                                    @else
                                        <div class="flex items-center gap-3 bg-[#0a0a0a] border border-[#222] px-4 py-2 rounded-full">
                                            <div class="w-2 h-2 rounded-full {{ $proyecto->publicado ? 'bg-emerald-500 shadow-[0_0_8px_rgba(16,185,129,0.5)]' : 'bg-indigo-500 animate-pulse' }}"></div>
                                            <span class="text-[10px] font-bold uppercase tracking-[2px] text-gray-400">
                                                {{ $proyecto->estado->nombre }}
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="p-20 text-center">
                                <p class="font-bebas text-3xl text-gray-700 tracking-widest">No se encontraron proyectos</p>
                                <p class="text-xs text-gray-800 uppercase mt-2">Intenta con otro término de búsqueda</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($proyectos->hasPages())
            <div class="mt-12">
                {{ $proyectos->links() }}
            </div>
        @endif
    </div>

    {{-- FOOTER SIMPLE --}}
    <footer class="border-t border-[#1a1a1a] py-12 bg-black">
        <div class="max-w-[1100px] mx-auto px-6 text-center">
            <p class="text-[10px] tracking-[5px] text-gray-600 uppercase font-bold">© 2026 ACTORES SOCIEDAD COLOMBIANA DE GESTIÓN</p>
        </div>
    </footer>
</div>