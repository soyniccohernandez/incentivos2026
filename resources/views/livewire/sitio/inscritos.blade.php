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

            {{-- BARRA DE ETAPAS --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-8 bg-[#0a0a0a] border border-[#1a1a1a] p-6">
                @if($convocatoriaActual)
                    @foreach($convocatoriaActual->etapas->sortBy('orden') as $etapa)
                        @php $activa = $etapa->estaActiva(); @endphp
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
                    <input type="text" wire:model.live="search" placeholder="EJ: EL GUION DE MI VIDA..." 
                        class="w-full bg-[#0a0a0a] border border-[#222] py-5 px-6 text-white focus:border-[#ff6600] focus:ring-1 focus:ring-[#ff6600] transition-all outline-none font-medium text-sm tracking-widest">
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
                                    @if(!$proyecto->publicado)
                                        {{-- ESTADO EN REVISIÓN --}}
                                        <div class="flex items-center gap-3 bg-[#0a0a0a] border border-[#222] px-4 py-2 rounded-full">
                                            <div class="w-2 h-2 rounded-full bg-indigo-500 animate-pulse"></div>
                                            <span class="text-[10px] font-bold uppercase tracking-[2px] text-gray-400"> Inscrito / En Revisión </span>
                                        </div>
                                    @else
                                        @php
                                            $e1 = $proyecto->convocatoria->etapas->where('orden', 1)->first();
                                            $e2 = $proyecto->convocatoria->etapas->where('orden', 2)->first();
                                        @endphp

                                        {{-- ESTADO 2: SUBSANACIÓN --}}
                                        @if($proyecto->estado_id == 2)
                                            @if($e1 && $e1->estaActiva())
                                                <a href="{{ route('validar-socio') }}" class="flex items-center gap-3 px-6 py-3 bg-amber-500 text-black font-bebas text-xl tracking-wider hover:bg-white transition-all no-underline shadow-[0_0_20px_rgba(245,158,11,0.3)]">
                                                    CORREGIR AHORA
                                                </a>
                                            @else
                                                <div class="flex flex-col items-center">
                                                    <span class="text-[10px] text-amber-500/50 border border-amber-500/20 px-4 py-2 uppercase font-bold italic">Plazo vencido</span>
                                                </div>
                                            @endif

                                        {{-- ESTADO 4: ETAPA 2 --}}
                                        @elseif($proyecto->estado_id == 4)
                                            @if($e2 && $e2->estaActiva())
                                                <a href="{{ route('validar-socio') }}" class="flex items-center gap-2 px-6 py-3 bg-[#ff6600] text-white font-bebas text-xl tracking-wider hover:bg-white hover:text-black transition-all no-underline shadow-[0_0_20px_rgba(255,102,0,0.3)]">
                                                    COMPLETAR ETAPA 2
                                                </a>
                                            @else
                                                <div class="flex flex-col items-center text-[#ff6600]/40">
                                                    <span class="text-[10px] border border-[#ff6600]/20 px-4 py-2 uppercase font-bold italic">Etapa cerrada</span>
                                                </div>
                                            @endif

                                        {{-- ESTADO 8 y 9: RECHAZADO / ELIMINADO --}}
                                        @elseif(in_array($proyecto->estado_id, [8, 9]))
                                            <a href="{{ route('validar-socio') }}" class="flex items-center gap-2 px-6 py-3 bg-red-600/10 text-red-500 border border-red-600/40 font-bebas text-xl tracking-wider hover:bg-red-600 hover:text-white transition-all no-underline">
                                                VER MOTIVO RECHAZO
                                            </a>

                                        {{-- ESTADO 7: SELECCIONADO / GANADOR --}}
                                        @elseif($proyecto->estado_id == 7)
                                            <a href="{{ route('validar-socio') }}" 
                                               class="flex flex-col items-center gap-1 px-6 py-3 bg-emerald-600 text-white hover:bg-emerald-500 transition-all no-underline shadow-[0_0_25px_rgba(16,185,129,0.4)] border border-emerald-400/30 group/btn">
                                                <div class="flex items-center gap-2">
                                                    <svg class="w-5 h-5 text-emerald-200 animate-bounce" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                    </svg>
                                                    <span class="font-bebas text-2xl tracking-wider uppercase">¡PROYECTO GANADOR!</span>
                                                </div>
                                                <span class="text-[10px] font-bold uppercase tracking-[2px] text-emerald-100 opacity-80 group-hover/btn:opacity-100">
                                                    Ver pasos a seguir →
                                                </span>
                                            </a>

                                        {{-- OTROS ESTADOS PUBLICADOS --}}
                                        @else
                                            <div class="flex items-center gap-3 bg-[#0a0a0a] border border-[#222] px-4 py-2 rounded-full">
                                                <div class="w-2 h-2 rounded-full bg-gray-600"></div>
                                                <span class="text-[10px] font-bold uppercase tracking-[2px] text-gray-400"> 
                                                    {{ $proyecto->estado->nombre }} 
                                                </span>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="p-20 text-center">
                                <p class="font-bebas text-3xl text-gray-700 tracking-widest">No se encontraron proyectos</p>
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

    {{-- FOOTER --}}
    <footer class="border-t border-[#1a1a1a] py-12 bg-black">
        <div class="max-w-[1100px] mx-auto px-6 text-center">
            <p class="text-[10px] tracking-[5px] text-gray-600 uppercase font-bold">
                © 2026 ACTORES SOCIEDAD COLOMBIANA DE GESTIÓN
            </p>
        </div>
    </footer>
</div>