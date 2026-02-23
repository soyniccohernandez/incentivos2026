<div class="min-h-screen bg-[#f1f5f9] text-slate-900 font-inter pb-20 pt-10">
    {{-- Carga de Fuentes: Outfit para títulos, Inter para el resto --}}
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@500;700;800;900&display=swap');

        .font-outfit {
            font-family: 'Outfit', sans-serif !important;
        }

        .font-inter {
            font-family: 'Inter', sans-serif !important;
        }

        .text-header {
            font-family: 'Outfit', sans-serif;
            font-weight: 800;
            letter-spacing: -0.03em;
        }
    </style>

    <div class="max-w-7xl mx-auto px-6 space-y-12">

        {{-- NAVEGACIÓN --}}
        <nav class="flex items-center gap-4 mb-8 text-[11px] font-bold uppercase tracking-[2px] text-slate-400">
            <a href="{{ route('dashboard') }}" wire:navigate class="hover:text-[#ff6600] transition-colors">
                INICIO
            </a>
            <span class="opacity-30">/</span>
            <span class="text-slate-600">
                CONVOCATORIAS
            </span>
        </nav>
        {{-- CABECERA --}}
        <div class="relative pl-8 py-2">
            {{-- Barra Lateral: Mantenemos el Slate-950 de tu base aprobada para consistencia --}}
            <div class="absolute left-0 top-0 h-full w-1.5 bg-slate-950 rounded-full"></div>

            <h2 class="font-outfit text-5xl md:text-6xl font-900 tracking-tight text-slate-950 leading-none uppercase">
                Procesos de <span class="text-[#ff6600]">Selección</span>
            </h2>

            <p class="font-inter text-[13px] font-semibold text-slate-500 uppercase tracking-[4px] mt-3 opacity-70">
                Administración de fondos e incentivos <span class="mx-2 text-slate-300">/</span> 2026
            </p>
        </div>

        {{-- Grid de Convocatorias --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($convocatorias as $convocatoria)
            {{-- Tarjeta: CONVOCATORIA (Clon exacto con Título Completo) --}}
            <div class="group bg-white rounded-[2rem] border border-slate-200/60 shadow-sm hover:shadow-2xl hover:shadow-slate-200 transition-all duration-500 flex flex-col overflow-hidden">
                {{-- Acento Superior --}}
                <div class="h-2 w-full bg-slate-950"></div>

                <div class="p-8 flex-1">
                    <div class="flex justify-between items-start mb-8 gap-4">
                        <div class="flex-1">
                            {{-- Título completo sin restricciones --}}
                            <h3 class="font-outfit text-2xl font-800 text-slate-900 group-hover:text-[#ff6600] transition-colors leading-[1.1] uppercase">
                                {{ $convocatoria->nombre }}
                            </h3>
                            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mt-2">Convocatoria</p>
                        </div>
                        <div class="flex-shrink-0 bg-slate-50 p-4 rounded-2xl text-slate-900 group-hover:bg-orange-50 group-hover:text-[#ff6600] transition-all">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                    </div>

                    <div class="space-y-6">
                        {{-- EL "BIG NUMBER" IDENTICO A LA BASE --}}
                        <div>
                            <span class="font-outfit text-7xl font-900 text-slate-950 leading-none tracking-tighter">
                                {{ $convocatoria->proyectos_count ?? '0' }}
                            </span>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-2">Postulaciones Recibidas</p>
                        </div>

                        {{-- Bloque de stats con separador vertical --}}
                        <div class="flex items-center gap-6 py-5 border-y border-slate-50 font-inter">
                            <div>
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block mb-1">Estado</span>
                                <span class="text-[11px] font-bold text-slate-900 uppercase">{{ $convocatoria->estado }}</span>
                            </div>
                            <div class="h-8 w-px bg-slate-100"></div>
                            <div class="flex-1">
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block mb-1">Vencimiento</span>
                                <span class="text-[11px] font-bold {{ $convocatoria->dias_restantes >= 0 ? 'text-slate-600' : 'text-red-500' }} uppercase">
                                    {{ $convocatoria->dias_restantes >= 0 ? 'EN ' . $convocatoria->dias_restantes . ' DÍAS' : 'FINALIZADO' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Botón Estilo Base --}}
                <div class="p-8 pt-0">
                    <a href="{{ route('convocatoria.gestionar', $convocatoria->id) }}" wire:navigate class="no-underline text-center w-full py-4 rounded-2xl bg-slate-950 hover:bg-[#ff6600] text-white font-inter text-xs font-bold tracking-widest transition-all uppercase block shadow-lg shadow-slate-200">
                        Gestionar Radicados
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-full py-20 bg-white rounded-3xl border-2 border-dashed border-slate-200 text-center">
                <p class="font-outfit text-xl font-bold text-slate-400 uppercase tracking-widest">No hay registros activos</p>
            </div>
            @endforelse
        </div>
    </div>
</div>