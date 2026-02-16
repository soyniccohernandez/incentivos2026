<div class="min-h-screen py-8" wire:poll.5s>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        {{-- Header con Breadcrumbs y Título --}}
        <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                {{-- Breadcrumbs / Migas de Pan --}}
                <nav class="flex items-center gap-4 mb-6 text-[10px] font-black uppercase tracking-widest">
                    {{-- Inicio --}}
                    <a href="{{ route('dashboard') }}" wire:navigate class="flex items-center gap-2 text-gray-400 hover:text-indigo-600 transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        <span>Inicio</span>
                    </a>

                    <svg class="w-3 h-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path>
                    </svg>

                    {{-- Link a Convocatorias --}}
                    <a href="{{ route('admin.convocatorias.index') }}" wire:navigate class="text-gray-400 hover:text-indigo-600 transition-colors">
                        Convocatorias
                    </a>

                    <svg class="w-3 h-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path>
                    </svg>

                    {{-- Posición Actual --}}
                    <span class="text-indigo-600">Postulaciones</span>
                </nav>
                <h1 class="text-2xl font-black text-gray-900 sm:text-3xl tracking-tight">
                    {{ $convocatoria->nombre }}
                </h1>
            </div>

            <div class="flex items-center gap-3">
                <div class="flex items-center gap-3">
                    @php
                    // Buscamos si existe algún proyecto en esta convocatoria que aún no sea público
                    $hayPendientes = \App\Models\Proyecto::where('convocatoria_id', $this->convocatoria->id)
                    ->where('publicado', false)
                    ->exists();
                    @endphp

                    <button
                        wire:click="publicarResultados"
                        wire:loading.attr="disabled"
                        @if($hayPendientes)
                        wire:confirm="¿Deseas publicar los nuevos resultados? Los socios podrán ver sus cambios de estado inmediatamente."
                        @endif
                        @disabled(!$hayPendientes)
                        class="inline-flex items-center px-4 py-2 rounded-lg font-bold text-xs text-white uppercase tracking-widest shadow-md transition-all 
        {{ $hayPendientes 
            ? 'bg-[#ff6600] hover:bg-[#e65c00] active:scale-95' 
            : 'bg-emerald-600 cursor-not-allowed opacity-90' 
        }}">

                        {{-- Spinner de carga --}}
                        <svg wire:loading wire:target="publicarResultados" class="animate-spin -ml-1 mr-3 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>

                        <div wire:loading.remove wire:target="publicarResultados" class="flex items-center">
                            @if($hayPendientes)
                            {{-- Icono de Ojo: Hay algo que mostrar --}}
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <span>Publicar Resultados</span>
                            @else
                            {{-- Icono de Check: Todo está publicado --}}
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Resultados al día</span>
                            @endif
                        </div>
                    </button>

                    {{-- Los otros botones se mantienen igual --}}
                    <button class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg font-bold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 transition">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                        Ajustes
                    </button>
                </div>
                <button class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg font-bold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 transition">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                    Ajustes
                </button>
                <button class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-bold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 shadow-md transition">
                    Configurar Requisitos
                </button>
            </div>
        </div>

        {{-- Stats Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">
            <div class="bg-white overflow-hidden shadow-sm border border-gray-100 rounded-2xl p-5">
                <div class="flex items-center">
                    <div class="p-3 rounded-xl bg-indigo-50 text-indigo-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Postulados</p>
                        <p class="text-2xl font-black text-gray-900">{{ $proyectos->total() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm border border-gray-100 rounded-2xl p-5">
                <div class="flex items-center">
                    <div class="p-3 rounded-xl bg-amber-50 text-amber-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Etapa Actual</p>
                        <p class="text-lg font-bold text-gray-900">{{ $convocatoria->etapas->where('orden', 1)->first()->nombre ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm border border-gray-100 rounded-2xl p-5">
                <div class="flex items-center">
                    <div class="p-3 rounded-xl bg-green-50 text-green-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Estado Global</p>
                        <p class="text-lg font-bold text-gray-900 capitalize">{{ $convocatoria->estado }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Main Content --}}
        <div class="bg-white shadow-xl shadow-gray-200/50 rounded-2xl border border-gray-100 overflow-hidden">
            {{-- Barra de Herramientas: Filtros y Búsqueda --}}
            <div class="p-6 border-b border-gray-50 flex flex-col lg:flex-row justify-between items-center gap-4 bg-gray-50/50">
                <h3 class="text-lg font-bold text-gray-800 uppercase tracking-tight">Proyectos Registrados</h3>

                <div class="flex flex-col sm:flex-row items-center gap-3 w-full lg:w-auto">

                    {{-- Selector de Estados (Nuevo) --}}
                    <div class="relative w-full sm:w-60">
                        <select wire:model.live="estadoSelected"
                            class="w-full pl-4 pr-10 py-2 bg-white border-gray-200 rounded-xl text-[10px] font-black uppercase tracking-widest focus:ring-indigo-500 focus:border-indigo-500 transition shadow-sm appearance-none text-gray-600">
                            <option value="">Todos los Estados ({{ $convocatoria->proyectos->count() }})</option>
                            @foreach($estados as $est)
                            <option value="{{ $est->id }}">
                                {{ $est->nombre }} ({{ $est->proyectos_count }})
                            </option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-indigo-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>

                    {{-- Buscador --}}
                    <div class="relative w-full sm:w-72">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </span>
                        <input type="text" wire:model.live="search"
                            placeholder="Buscar radicado o título..."
                            class="pl-10 w-full border-gray-200 rounded-xl text-sm focus:ring-indigo-500 focus:border-indigo-500 transition shadow-sm">
                    </div>

                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-gray-400 text-[10px] uppercase tracking-[2px] font-bold border-b border-gray-100">
                            <th class="px-6 py-4">ID</th>
                            <th class="px-6 py-4">Información del Proyecto</th>
                            <th class="px-6 py-4">Socio Proponente</th>
                            <th class="px-6 py-4 text-center">Estado</th>
                            <th class="px-6 py-4 text-right">Gestión</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($proyectos as $proyecto)
                        <tr class="hover:bg-indigo-50/30 transition-colors group">
                            {{-- ID Técnico más discreto --}}
                            <td class="px-6 py-4 text-[10px] text-gray-300 font-mono">#{{ $proyecto->id }}</td>

                            <td class="px-6 py-4">
                                <div class="flex flex-col gap-1">
                                    {{-- RADICADO DESTACADO --}}
                                    <div class="flex items-center gap-2">
                                        <span class="text-xs font-black text-indigo-600 tracking-wider">
                                            {{ $proyecto->codigo_radicado }}
                                        </span>
                                        <span class="h-1 w-1 rounded-full bg-gray-300"></span>
                                        <span class="text-[10px] text-gray-400 font-bold uppercase tracking-tight">
                                            {{ $proyecto->created_at->format('d M, Y') }}
                                        </span>
                                    </div>

                                    {{-- Título del Proyecto (soporta nombres largos) --}}
                                    <span class="font-bold text-gray-900 group-hover:text-indigo-700 transition-colors leading-tight max-w-md block">
                                        {{ $proyecto->titulo }}
                                    </span>
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="h-8 w-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-500 font-bold text-[10px] border border-gray-200">
                                        {{ substr($proyecto->socio->nombre, 0, 2) }}
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-bold text-gray-800 leading-none mb-1">{{ $proyecto->socio->nombre }}</p>
                                        <p class="text-[10px] font-mono text-gray-400">{{ $proyecto->socio->identificacion }}</p>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4 text-center">
                                @if($proyecto->estado)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest shadow-sm
            {{ $proyecto->estado->es_final ? 'bg-emerald-100 text-emerald-700 border border-emerald-200' : 'bg-indigo-50 text-indigo-700 border border-indigo-100' }}">
                                    {{ $proyecto->estado->nombre }}
                                </span>
                                @else
                                <span class="text-gray-400 text-[10px] font-bold italic uppercase">Sin estado</span>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('proyecto.revisar', $proyecto->id) }}"
                                    class="inline-flex items-center px-4 py-2 bg-gray-900 text-white text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-indigo-600 transition-all shadow-sm hover:shadow-indigo-200">
                                    Revisar
                                    <svg class="w-3 h-3 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-400 italic">
                                <div class="flex flex-col items-center">
                                    <svg class="w-12 h-12 text-gray-200 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                    </svg>
                                    No hay proyectos registrados para esta convocatoria.
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($proyectos->hasPages())
            <div class="p-6 border-t border-gray-50 bg-gray-50/30">
                {{ $proyectos->links() }}
            </div>
            @endif
        </div>
    </div>
</div>