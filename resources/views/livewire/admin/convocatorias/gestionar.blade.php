<div class="min-h-screen py-8" wire:poll.10s>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        {{-- Breadcrumbs y Título --}}
        <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <nav class="flex items-center gap-4 mb-6 text-[10px] font-black uppercase tracking-widest">
                    <a href="{{ route('dashboard') }}" wire:navigate class="flex items-center gap-2 text-gray-400 hover:text-indigo-600 transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        <span>Inicio</span>
                    </a>
                    <svg class="w-3 h-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path>
                    </svg>
                    <a href="{{ route('admin.convocatorias.index') }}" wire:navigate class="text-gray-400 hover:text-indigo-600 transition-colors">Convocatorias</a>
                    <svg class="w-3 h-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path>
                    </svg>
                    <span class="text-indigo-600">Postulaciones</span>
                </nav>
                <h1 class="text-2xl font-black text-gray-900 sm:text-3xl tracking-tight">{{ $convocatoria->nombre }}</h1>
            </div>

            <div class="flex items-center gap-3">
                @php
                $queryPendientes = \App\Models\Proyecto::where('convocatoria_id', $this->convocatoria->id)->where('publicado', false);
                if($estadoSelected) {
                $queryPendientes->where('estado_id', $estadoSelected);
                }
                $totalPendientes = $queryPendientes->count();
                @endphp

                <button wire:click="publicarResultados" wire:loading.attr="disabled"
                    @if($totalPendientes> 0) wire:confirm="¿Deseas publicar {{ $totalPendientes }} resultados?" @endif
                    @disabled($totalPendientes == 0)
                    class="inline-flex items-center px-4 py-2 rounded-lg font-bold text-xs text-white uppercase tracking-widest shadow-md transition-all {{ $totalPendientes > 0 ? 'bg-[#ff6600] hover:bg-[#e65c00]' : 'bg-emerald-600 cursor-not-allowed opacity-60' }}">
                    <div wire:loading wire:target="publicarResultados">
                        <svg class="animate-spin h-4 w-4 text-white mr-2" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </div>
                    <span wire:loading.remove wire:target="publicarResultados">Publicar {{ $estadoSelected ? 'Lote' : 'Todo' }} ({{ $totalPendientes }})</span>
                </button>
                <a href="{{ route('admin.convocatorias.config', $convocatoria->id) }}"
                    wire:navigate
                    class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg font-bold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 transition">
                    Ajustes de Cronograma
                </a>
                <button class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-bold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 shadow-md transition"> Configurar Requisitos </button>
            </div>
        </div>

        {{-- Tarjetas de Estadísticas --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">
            <div class="bg-white shadow-sm border border-gray-100 rounded-2xl p-5">
                <div class="flex items-center">
                    <div class="p-3 rounded-xl bg-indigo-50 text-indigo-600"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg></div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Postulados</p>
                        <p class="text-2xl font-black text-gray-900">{{ $proyectos->total() }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white shadow-sm border border-gray-100 rounded-2xl p-5">
                <div class="flex items-center">
                    <div class="p-3 rounded-xl bg-amber-50 text-amber-600"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg></div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Etapa Actual</p>
                        <p class="text-lg font-bold text-gray-900 truncate">{{ $nombreEtapaActual }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white shadow-sm border border-gray-100 rounded-2xl p-5">
                <div class="flex items-center">
                    <div class="p-3 rounded-xl bg-green-50 text-green-600"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg></div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Estado Global</p>
                        <p class="text-lg font-bold text-gray-900 capitalize">{{ $convocatoria->estado }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Contenedor de Tabla --}}
        <div class="bg-white shadow-xl shadow-gray-200/50 rounded-2xl border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-50 flex flex-col lg:flex-row justify-between items-center gap-4 bg-gray-50/50">
                <h3 class="text-lg font-bold text-gray-800 uppercase tracking-tight">Proyectos Registrados</h3>
                <div class="flex flex-col sm:flex-row items-center gap-3 w-full lg:w-auto">
                    <select wire:model.live="estadoSelected" class="w-full sm:w-60 pl-4 pr-10 py-2 bg-white border-gray-200 rounded-xl text-[10px] font-black uppercase tracking-widest focus:ring-indigo-500 appearance-none text-gray-600">
                        <option value="">Todos los Estados ({{ $convocatoria->proyectos->count() }})</option>
                        @foreach($estados as $est)
                        <option value="{{ $est->id }}">{{ $est->nombre }} ({{ $est->proyectos_count }})</option>
                        @endforeach
                    </select>
                    <input type="text" wire:model.live="search" placeholder="Buscar radicado o título..." class="w-full sm:w-72 border-gray-200 rounded-xl text-sm focus:ring-indigo-500 transition">
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-gray-400 text-[10px] uppercase tracking-[2px] font-bold border-b border-gray-100">
                            <th class="px-6 py-4">ID</th>
                            <th class="px-6 py-4">Información</th>
                            <th class="px-6 py-4">Socio</th>
                            <th class="px-6 py-4 text-center">Estado / Pública</th>
                            <th class="px-6 py-4 text-right">Gestión</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($proyectos as $proyecto)
                        <tr class="hover:bg-indigo-50/30 transition-colors group">
                            <td class="px-6 py-4 text-[10px] text-gray-300 font-mono">#{{ $proyecto->id }}</td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col">
                                    <span class="text-xs font-black text-indigo-600 tracking-wider">{{ $proyecto->codigo_radicado }}</span>
                                    <span class="font-bold text-gray-900 group-hover:text-indigo-700 leading-tight block">{{ $proyecto->titulo }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 rounded-full bg-black border border-brand-orange/30 shadow-sm flex items-center justify-center overflow-hidden">
                                        @if($proyecto->socio->foto_url)
                                        <img src="{{ $proyecto->socio->foto_url }}" class="h-full w-full object-cover">
                                        @else
                                        <span class="text-[10px] font-black text-white">{{ $proyecto->socio->iniciales }}</span>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-bold text-gray-800 leading-none mb-1">{{ mb_strtoupper($proyecto->socio->nombre) }}</p>
                                        <p class="text-[10px] font-mono text-gray-400">{{ $proyecto->socio->identificacion }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex flex-col items-center gap-1">
                                    @php
                                    // ASIGNACIÓN DE COLORES POR ESTADO (IDs del Seeder)
                                    $colorClass = match($proyecto->estado_id) {
                                    1 => 'bg-blue-50 text-blue-700 border-blue-100', // Inscrito
                                    2 => 'bg-amber-50 text-amber-700 border-amber-100', // En Subsanación
                                    3 => 'bg-purple-50 text-purple-700 border-purple-100', // En revisión de subsanación
                                    4 => 'bg-indigo-50 text-indigo-700 border-indigo-100', // En Etapa 2
                                    5 => 'bg-cyan-50 text-cyan-700 border-cyan-100', // Etapa 2 - Revisión
                                    6 => 'bg-pink-50 text-pink-700 border-pink-100', // Etapa 3 - Jurados
                                    7 => 'bg-emerald-50 text-emerald-700 border-emerald-100', // Ganador
                                    8, 9 => 'bg-red-50 text-red-700 border-red-100', // No continúa / Eliminado
                                    default => 'bg-gray-50 text-gray-700 border-gray-100',
                                    };
                                    @endphp

                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest shadow-sm border {{ $colorClass }}">
                                        {{ $proyecto->estado->nombre }}
                                    </span>

                                    <span class="text-[8px] font-black uppercase tracking-tighter {{ $proyecto->publicado ? 'text-emerald-600' : 'text-[#ff6600]' }}">
                                        ● {{ $proyecto->publicado ? 'Visible' : 'Oculto' }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('proyecto.revisar', $proyecto->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-900 text-white text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-indigo-600 transition-all shadow-sm">
                                    Revisar
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-10 text-center text-gray-400 italic">No se encontraron proyectos.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($proyectos->hasPages())
            <div class="p-6 border-t border-gray-50">{{ $proyectos->links() }}</div>
            @endif
        </div>
    </div>
</div>