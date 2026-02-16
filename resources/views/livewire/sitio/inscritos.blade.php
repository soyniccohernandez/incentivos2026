<div class="bg-black min-h-screen text-white font-montserrat antialiased" wire:poll.5s>
    {{-- 1. NAVEGACIÓN (Copiada de tu Home para consistencia) --}}
    <nav class="fixed top-0 left-0 w-full z-[1000] flex justify-between items-center px-6 py-5 md:px-12 bg-black/95 border-b border-[#1a1a1a]">
        <a href="/" class="font-bebas text-3xl text-[#ff6600] tracking-[2px] no-underline">ACTORES S.C.G.</a>

        {{-- Enlace de regreso rápido --}}
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

        {{-- Encabezado con más aire y elegancia --}}
        <div class="relative mb-16">
            <span class="text-[#ff6600] tracking-[8px] text-[10px] font-bold uppercase mb-4 block">Transparencia Institucional</span>
            <h2 class="font-bebas text-[4rem] md:text-[6rem] leading-[0.9] mb-4 tracking-wider">
                PROYECTOS <span class="text-[#ff6600]">INSCRITOS</span>
            </h2>
            <div class="w-24 h-1 bg-[#ff6600] mb-6"></div>
            <p class="text-gray-400 text-lg italic max-w-2xl">
                Listado oficial de propuestas recibidas para la convocatoria <span class="text-white font-bold">{{ $nombreConvocatoria }}</span>.
            </p>
        </div>

        {{-- Panel de Control: Buscador y Contador --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12 items-end">
            <div class="md:col-span-2">
                <label class="text-[10px] uppercase tracking-[3px] text-gray-500 font-bold mb-3 block">Filtrar por nombre o radicado</label>
                <div class="relative">
                    <input type="text" wire:model.live="search"
                        placeholder="EJ: EL GUION DE MI VIDA..."
                        class="w-full bg-[#0a0a0a] border border-[#222] py-5 px-6 text-white focus:border-[#ff6600] focus:ring-1 focus:ring-[#ff6600] transition-all outline-none font-medium text-sm tracking-widest">
                    <div class="absolute right-6 top-1/2 -translate-y-1/2">
                        <svg class="w-5 h-5 text-[#ff6600]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-[#111] p-6 border-l-2 border-[#ff6600] flex flex-col justify-center">
                <span class="text-gray-500 text-[10px] uppercase tracking-[2px] font-bold">Total Recibidos</span>
                <span class="text-[#ff6600] font-bebas text-5xl leading-none mt-1">{{ $total }}</span>
            </div>
        </div>

        {{-- Tabla Rediseñada para Legibilidad --}}
        <div class="overflow-hidden border border-[#1a1a1a] bg-[#050505] shadow-2xl">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-[#0a0a0a] border-b border-[#1a1a1a]">
                        <th class="p-6 font-bebas text-xl tracking-[3px] text-gray-400">RADICADO</th>
                        <th class="p-6 font-bebas text-xl tracking-[3px] text-gray-400">TÍTULO DE LA OBRA</th>
                        <th class="p-6 font-bebas text-xl tracking-[3px] text-gray-400 text-center">ESTADO PÚBLICO</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#121212]">
                    @forelse($proyectos as $proyecto)
                    <tr class="hover:bg-white/[0.02] transition-colors group">
                        <td class="p-6">
                            <span class="bg-[#111] text-[#ff6600] px-3 py-2 rounded font-bold tracking-tighter border border-[#222]">
                                {{ $proyecto->codigo_radicado }}
                            </span>
                        </td>
                        <td class="p-6">
                            <div class="text-white font-bold text-lg uppercase group-hover:text-[#ff6600] transition-colors duration-300">
                                {{ $proyecto->titulo }}
                            </div>
                            <div class="flex items-center gap-3 mt-2">
                                <span class="text-[9px] text-gray-500 uppercase tracking-widest">Postulado el: {{ $proyecto->created_at->format('d M, Y') }}</span>
                            </div>
                        </td>
                        <td class="p-6 text-center">
                            @php
                            $ID_EN_ETAPA_2 = 4;
                            $ID_REVISION_ETAPA_2 = 5;
                            $ID_ELIMINADO = 8;
                            @endphp

                            <div class="flex items-center justify-center gap-3">
                                {{-- CASO 1: ACCIÓN REQUERIDA (ETAPA 2) --}}
                                @if($proyecto->estado_id == $ID_EN_ETAPA_2)
                                <div class="flex items-center bg-[#111] border border-[#ff6600]/30 p-1 rounded-sm">
                                    {{-- Badge de Estado --}}
                                    <span class="px-4 py-2 text-[10px] font-black uppercase tracking-[2px] text-gray-400 border-r border-[#222]">
                                        {{ $proyecto->estado->nombre }}
                                    </span>

                                    {{-- Botón de Acción --}}
                                    <a href="{{ route('validar-socio', ['proyecto' => $proyecto->id]) }}"
                                        class="flex items-center gap-2 px-5 py-2 bg-[#ff6600] text-white font-bebas text-lg tracking-wider hover:bg-white hover:text-black transition-all no-underline group">
                                        <span class="relative flex h-2 w-2">
                                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span>
                                            <span class="relative inline-flex rounded-full h-2 w-2 bg-white"></span>
                                        </span>
                                        DILIGENCIAR FORMULARIO
                                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                        </svg>
                                    </a>
                                </div>

                                {{-- CASO 2: EN REVISIÓN (HORIZONTAL Y ELEGANTE) --}}
                                @elseif($proyecto->estado_id == $ID_REVISION_ETAPA_2)
                                <div class="flex items-center gap-3 bg-[#0a0a0a] border border-[#222] px-4 py-2 rounded-full">
                                    <div class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></div>
                                    <span class="text-[10px] font-bold uppercase tracking-[2px] text-gray-400">
                                        {{ $proyecto->estado->nombre }}
                                    </span>
                                    <span class="text-[9px] text-gray-600 border-l border-[#222] pl-3 uppercase">Recibido</span>
                                </div>

                                {{-- CASO 3: ESTADOS FINALES O BLOQUEADOS --}}
                                @else
                                <span class="px-6 py-2 border {{ $proyecto->estado_id == $ID_ELIMINADO ? 'border-red-900/50 text-red-600 bg-red-900/10' : 'border-[#222] text-gray-500 bg-[#0a0a0a]' }} text-[10px] font-black uppercase tracking-[2px]">
                                    {{ $proyecto->estado->nombre ?? 'S/N' }}
                                </span>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="p-32 text-center">
                            <div class="flex flex-col items-center opacity-20">
                                <svg class="w-16 h-16 mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <p class="font-bebas text-3xl tracking-widest uppercase">No hay registros coincidentes</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Paginación Estilizada --}}
        <div class="mt-12">
            {{ $proyectos->links() }}
        </div>
    </div>

    {{-- 3. FOOTER (Copiado de tu Home para consistencia) --}}
    <footer class="bg-[#050505] text-[#888] py-20 border-t border-[#1a1a1a] text-[0.9rem]">
        <div class="max-w-[1100px] mx-auto grid grid-cols-1 md:grid-cols-[2fr_1fr_1fr] gap-[50px] px-6">
            <div>
                <h3 class="font-bebas text-[1.8rem] text-white mb-[5px] tracking-[2px]">ACTORES S.C.G.</h3>
                <p class="text-[#ff6600] font-semibold mb-[15px] text-[0.75rem] uppercase tracking-[1px]">Sociedad Colombiana de Gestión de Actores</p>
                <p class="leading-[1.8] max-w-[350px]">Protegiendo y gestionando los derechos patrimoniales de los actores y actrices de Colombia desde 1987.</p>
            </div>
            <div>
                <h4 class="text-white font-bebas text-[1.2rem] mb-[25px] tracking-[1px]">INSTITUCIONAL</h4>
                <ul class="list-none p-0">
                    <li class="mb-3"><a href="#" class="text-[#888] no-underline hover:text-[#ff6600] transition-all">Transparencia</a></li>
                    <li class="mb-3"><a href="#" class="text-[#888] no-underline hover:text-[#ff6600] transition-all">Estatutos</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-bebas text-[1.2rem] mb-[25px] tracking-[1px]">CONTACTO</h4>
                <p class="mb-1">Bogotá, Colombia</p>
                <p class="mb-1 italic">contacto@actores.org.co</p>
            </div>
        </div>
    </footer>
</div>