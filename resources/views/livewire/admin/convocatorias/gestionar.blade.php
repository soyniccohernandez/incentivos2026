<div class="min-h-screen bg-[#f1f5f9] text-slate-900 font-inter pb-20 pt-10" wire:poll.10s>
    {{-- Tipografías: Outfit para impacto, Inter para precisión --}}
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@600;800;900&display=swap');

        .font-outfit {
            font-family: 'Outfit', sans-serif;
        }

        .font-inter {
            font-family: 'Inter', sans-serif;
        }
    </style>

    <div class="max-w-7xl mx-auto px-6 space-y-12">

        <div>
            {{-- Navegación - Consistente con los demás --}}
            <nav class="flex items-center gap-4 mb-8 text-[11px] font-bold uppercase tracking-[2px] text-slate-400">
                <a href="{{ route('dashboard') }}" wire:navigate class="hover:text-[#ff6600] transition-colors">
                    INICIO
                </a>
                <span class="opacity-30">/</span>
                <a href="{{ route('admin.convocatorias.index') }}" wire:navigate class="hover:text-[#ff6600] transition-colors">
                    CONVOCATORIAS
                </a>
                <span class="opacity-30">/</span>
                <span class="text-slate-600">
                    POSTULACIONES
                </span>
            </nav>

            {{-- Cabecera Estilo Tech-Admin (Idéntica a la Base Aprobada) --}}
            <div class="relative pl-8 py-2">
                {{-- Barra Lateral Negra --}}
                <div class="absolute left-0 top-0 h-full w-1.5 bg-slate-950 rounded-full"></div>

                <h2 class="font-outfit text-5xl md:text-6xl font-900 tracking-tight text-slate-950 leading-none uppercase">
                    {{ $convocatoria->nombre }}
                </h2>

                <p class="font-inter text-[13px] font-semibold text-slate-500 uppercase tracking-[4px] mt-3 opacity-70">
                    Gestión de Postulaciones <span class="mx-2 text-slate-300">/</span> Proyectos 2026
                </p>
            </div>
        </div>
        {{-- Cabecera con Breadcrumbs --}}
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 relative pl-8 py-2">


            <div class="flex flex-wrap gap-3">
                @php
                // Lógica para el botón de Publicar (Pendientes)
                $queryPendientes = \App\Models\Proyecto::where('convocatoria_id', $this->convocatoria->id)->where('publicado', false);
                if($estadoSelected) { $queryPendientes->where('estado_id', $estadoSelected); }
                $totalPendientes = $queryPendientes->count();

                // Lógica para el botón de Ocultar (Ya publicados)
                $queryPublicados = \App\Models\Proyecto::where('convocatoria_id', $this->convocatoria->id)->where('publicado', true);
                if($estadoSelected) { $queryPublicados->where('estado_id', $estadoSelected); }
                $totalPublicados = $queryPublicados->count();
                @endphp

                <button wire:click="publicarResultados"
                    @if($totalPendientes> 0) wire:confirm="¿Deseas publicar {{ $totalPendientes }} resultados?" @endif
                    @disabled($totalPendientes == 0)
                    class="px-8 py-4 bg-[#ff6600] text-white font-inter text-xs font-bold tracking-widest hover:bg-slate-950 disabled:bg-slate-300 transition-all shadow-xl shadow-orange-200 disabled:shadow-none uppercase rounded-2xl flex items-center gap-3">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" stroke-width="2" />
                        <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" stroke-width="2" />
                    </svg>
                    Publicar ({{ $totalPendientes }})
                </button>

                <button wire:click="ocultarResultados"
                    @if($totalPublicados> 0) wire:confirm="¿Deseas ocultar {{ $totalPublicados }} resultados?" @endif
                    @disabled($totalPublicados == 0)
                    class="px-8 py-4 bg-slate-800 text-white font-inter text-xs font-bold tracking-widest hover:bg-red-700 disabled:bg-slate-200 transition-all shadow-xl shadow-slate-200 disabled:shadow-none uppercase rounded-2xl flex items-center gap-3">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88L4.22 4.22m15.56 15.56l-5.66-5.66m0 0a9.96 9.96 0 003.442-3.92C18.268 7.943 14.478 5 10 5a9.95 9.95 0 00-1.875.175" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Ocultar ({{ $totalPublicados }})
                </button>
            </div>
        </div>

        {{-- Grid de Estadísticas Rápidas --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            {{-- POSTULADOS --}}
            <div class="bg-white rounded-[2rem] border border-slate-200/60 shadow-sm p-8 flex flex-col group transition-all hover:shadow-xl">
                <div class="flex justify-between items-start mb-6">
                    <h3 class="font-outfit text-xl font-800 text-slate-900 uppercase tracking-tight">Postulados</h3>
                    <div class="bg-slate-50 p-3 rounded-xl text-slate-400 group-hover:text-slate-950 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                </div>
                <div class="space-y-1">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block font-inter">Proyectos Totales</span>
                    <span class="font-outfit text-6xl font-900 text-slate-950 leading-none tracking-tighter">{{ $proyectos->total() }}</span>
                </div>
            </div>

            {{-- ETAPA ACTUAL --}}
            <div class="bg-white rounded-[2rem] border border-slate-200/60 shadow-sm p-8 flex flex-col group transition-all hover:shadow-xl">
                <div class="flex justify-between items-start mb-6">
                    <h3 class="font-outfit text-xl font-800 text-slate-900 uppercase tracking-tight">Fase Activa</h3>
                    <div class="bg-orange-50 p-3 rounded-xl text-[#ff6600]">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="space-y-3">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block font-inter">Cronograma</span>
                    <p class="font-outfit text-2xl font-800 text-slate-950 leading-tight uppercase">{{ $nombreEtapaActual }}</p>
                </div>
                <a href="{{ route('admin.convocatorias.config', $convocatoria->id) }}" wire:navigate class="mt-4 text-[11px] font-bold text-[#ff6600] uppercase tracking-widest no-underline flex items-center gap-2 hover:translate-x-1 transition-transform">
                    Ajustar Calendario →
                </a>
            </div>

            {{-- ESTADO GLOBAL --}}
            <div class="bg-white rounded-[2rem] border border-slate-200/60 shadow-sm p-8 flex flex-col group transition-all hover:shadow-xl">
                <div class="flex justify-between items-start mb-6">
                    <h3 class="font-outfit text-xl font-800 text-slate-900 uppercase tracking-tight">Visibilidad</h3>
                    <div class="bg-emerald-50 p-3 rounded-xl text-emerald-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="space-y-1">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block font-inter">Estado en Portal</span>
                    <p class="font-outfit text-4xl font-900 text-emerald-600 leading-tight uppercase tracking-tighter">{{ $convocatoria->estado }}</p>
                </div>
            </div>
        </div>

        {{-- SECCIÓN DE TABLA --}}
        <div class="bg-white rounded-[2.5rem] border border-slate-200/60 shadow-sm overflow-hidden mt-12">
            {{-- Filtros --}}
            <div class="p-8 bg-white border-b border-slate-100 flex flex-col lg:flex-row justify-between items-center gap-8">
                <h3 class="font-outfit text-3xl text-slate-950 font-800 tracking-tight">Proyectos Registrados</h3>

                <div class="flex flex-col sm:flex-row items-center gap-4 w-full lg:w-auto font-inter">
                    <select wire:model.live="estadoSelected" class="w-full sm:w-64 bg-slate-50 border-none rounded-2xl py-4 px-6 font-bold text-[11px] uppercase tracking-widest focus:ring-2 focus:ring-[#ff6600]/20 transition-all outline-none">
                        <option value="">TODOS LOS ESTADOS</option>
                        @foreach($estados as $est)
                        <option value="{{ $est->id }}">{{ $est->nombre }} ({{ $est->proyectos_count }})</option>
                        @endforeach
                    </select>

                    <div class="relative w-full sm:w-72">
                        <input type="text" wire:model.live="search" placeholder="BUSCAR RADICADO..." class="w-full bg-slate-50 border-none rounded-2xl py-4 px-6 pl-12 font-bold text-[11px] uppercase tracking-widest focus:ring-2 focus:ring-[#ff6600]/20 transition-all outline-none">
                        <svg class="w-4 h-4 absolute left-5 top-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke-width="3" />
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Tabla --}}
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse font-inter">
                    <thead>
                        <tr class="bg-slate-50 text-slate-400 text-[10px] uppercase tracking-[3px] font-bold">
                            <th class="px-8 py-6">Radicado</th>
                            <th class="px-8 py-6">Proyecto</th>
                            <th class="px-8 py-6">Postulante</th>
                            <th class="px-8 py-6 text-center">Estado / Visibilidad</th>
                            <th class="px-8 py-6 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($proyectos as $proyecto)
                        <tr class="hover:bg-slate-50/80 transition-all group">
                            <td class="px-8 py-6">
                                <span class="px-3 py-1.5 rounded-lg bg-orange-50 text-[11px] font-bold text-[#ff6600] tracking-widest">
                                    {{ $proyecto->codigo_radicado }}
                                </span>
                            </td>
                            <td class="px-8 py-6 max-w-xs">
                                <span class="text-[13px] font-bold text-slate-900 leading-snug uppercase block group-hover:text-[#ff6600] transition-colors line-clamp-2">
                                    {{ $proyecto->titulo }}
                                </span>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-4">
                                    <div class="h-10 w-10 rounded-xl bg-slate-950 flex items-center justify-center text-white text-[11px] font-bold">
                                        {{ substr($proyecto->user->name ?? 'U', 0, 2) }}
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-[12px] font-bold text-slate-900 uppercase leading-none">{{ $proyecto->user->name ?? 'Usuario no encontrado' }}</span>
                                        <span class="text-[10px] font-semibold text-slate-400 mt-1.5 uppercase">ID: {{ $proyecto->user->identificacion ?? '---' }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex flex-col items-center gap-2">
                                    <span class="px-4 py-1.5 rounded-full bg-slate-100 text-[10px] font-bold uppercase tracking-wide text-slate-700">
                                        {{ $proyecto->estado->nombre }}
                                    </span>
                                    <div class="flex items-center gap-1.5">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $proyecto->publicado ? 'bg-emerald-500' : 'bg-orange-500' }}"></span>
                                        <span class="text-[9px] font-bold tracking-widest uppercase {{ $proyecto->publicado ? 'text-emerald-600' : 'text-orange-500' }}">
                                            {{ $proyecto->publicado ? 'Público' : 'Oculto' }}
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <a href="{{ route('proyecto.revisar', $proyecto->id) }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-slate-950 text-white font-bold text-[11px] tracking-widest hover:bg-[#ff6600] transition-all no-underline shadow-lg shadow-slate-200">
                                    REVISAR
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M9 5l7 7-7 7" stroke-width="3" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-20 text-center">
                                <div class="flex flex-col items-center opacity-20">
                                    <svg class="w-20 h-20 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" stroke-width="1.5" />
                                    </svg>
                                    <p class="font-outfit text-2xl font-800 uppercase tracking-widest">Sin registros</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($proyectos->hasPages())
            <div class="p-8 bg-slate-50 border-t border-slate-100">
                {{ $proyectos->links() }}
            </div>
            @endif
        </div>
    </div>
</div>