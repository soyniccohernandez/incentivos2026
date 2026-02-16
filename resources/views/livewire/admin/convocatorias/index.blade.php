<div class="max-w-7xl mx-auto px-4 py-8">
    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-4">
        <div>
            <nav class="flex items-center gap-4 mb-6 text-[10px] font-black uppercase tracking-widest">
                <a href="{{ route('dashboard') }}" wire:navigate class="flex items-center gap-2 text-gray-400 hover:text-indigo-600 transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span>Inicio</span>
                </a>
                <svg class="w-3 h-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
                <span class="text-indigo-600">Convocatorias</span>
            </nav>
            <h2 class="text-3xl font-black text-gray-900">Procesos de Selección</h2>
        </div>

        <button class="inline-flex items-center px-6 py-3 bg-gray-900 text-white text-sm font-bold rounded-2xl hover:bg-indigo-600 transition-all shadow-lg shadow-gray-200">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
            Nueva Convocatoria
        </button>
    </div>

    {{-- Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($convocatorias as $convocatoria)
        <div class="group bg-white rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl hover:border-indigo-100 transition-all duration-300 flex flex-col overflow-hidden">
            <div class="p-8">
                <div class="flex justify-between items-start mb-6">
                    {{-- Badge Dinámico según tu ENUM --}}
                    @php
                        $color = match($convocatoria->estado) {
                            'abierta' => 'bg-emerald-50 text-emerald-600 ring-emerald-500/20',
                            'borrador' => 'bg-amber-50 text-amber-600 ring-amber-500/20',
                            'cerrada' => 'bg-red-50 text-red-600 ring-red-500/20',
                            default => 'bg-gray-50 text-gray-500 ring-gray-500/10'
                        };
                    @endphp
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest {{ $color }} ring-1">
                        {{ $convocatoria->estado }}
                    </span>

                    <div class="flex items-center text-gray-400 group-hover:text-indigo-500 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                    </div>
                </div>

                <h3 class="text-xl font-extrabold text-gray-900 mb-2 leading-tight group-hover:text-indigo-600 transition-colors">
                    {{ $convocatoria->nombre }}
                </h3>

                <p class="text-gray-500 text-sm line-clamp-2 mb-6 h-10">
                    {{ $convocatoria->descripcion ?? 'Sin descripción disponible para este proceso.' }}
                </p>

                <div class="flex items-center gap-6 py-4 border-t border-gray-50">
                    <div class="flex flex-col">
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-tighter">Proyectos</span>
                        <span class="text-lg font-black text-gray-800">{{ $convocatoria->proyectos_count }}</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-tighter">Vigencia</span>
                        @if($convocatoria->dias_restantes > 0)
                            <span class="text-sm font-bold text-gray-700">{{ $convocatoria->dias_restantes }} días restantes</span>
                        @elseif($convocatoria->dias_restantes == 0)
                            <span class="text-sm font-bold text-orange-600">Cierra hoy</span>
                        @else
                            <span class="text-sm font-bold text-red-500">Finalizado</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="px-8 pb-8">
                <a href="{{ route('convocatoria.gestionar', $convocatoria->id) }}"
                    wire:navigate
                    class="flex items-center justify-center w-full py-4 bg-indigo-600 text-white hover:bg-indigo-700 rounded-2xl font-bold text-sm transition-all shadow-md shadow-indigo-100 hover:shadow-indigo-200">
                    Gestionar Radicados
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                </a>
            </div>
        </div>
        @empty
        {{-- Estado Vacío --}}
        <div class="col-span-full bg-white rounded-3xl border-2 border-dashed border-gray-100 p-12 text-center">
            <h3 class="text-lg font-bold text-gray-400">No se encontraron convocatorias activas</h3>
        </div>
        @endforelse
    </div>
</div>