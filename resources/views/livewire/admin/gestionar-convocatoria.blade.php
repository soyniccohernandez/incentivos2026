<div class="min-h-screen py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        {{-- Header con Breadcrumbs y Título --}}
        <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <nav class="flex mb-2" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3 text-xs uppercase tracking-widest font-semibold">
                        <li><a href="{{ route('dashboard') }}" class="text-indigo-600 hover:text-indigo-800">Inicio</a></li>
                        <li class="text-gray-400">/</li>
                        <li class="text-gray-500">Gestionar Convocatoria</li>
                    </ol>
                </nav>
                <h1 class="text-2xl font-black text-gray-900 sm:text-3xl tracking-tight">
                    {{ $convocatoria->nombre }}
                </h1>
            </div>

            <div class="flex items-center gap-3">
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
            <div class="p-6 border-b border-gray-50 flex flex-col sm:flex-row justify-between items-center gap-4 bg-gray-50/50">
                <h3 class="text-lg font-bold text-gray-800">Proyectos Registrados</h3>
                <div class="relative w-full sm:w-72">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </span>
                    <input type="text" wire:model.live="search" placeholder="Buscar proyecto..." class="pl-10 w-full border-gray-200 rounded-xl text-sm focus:ring-indigo-500 focus:border-indigo-500 transition shadow-sm">
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
                            <td class="px-6 py-4 text-gray-400 font-mono text-xs">#{{ $proyecto->id }}</td>
                            <td class="px-6 py-4">
                                <span class="font-bold text-gray-900 group-hover:text-indigo-700 transition-colors">{{ $proyecto->titulo }}</span>
                                <div class="flex items-center mt-1 text-[10px] text-gray-400 uppercase">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    {{ $proyecto->created_at->format('d M, Y') }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="h-8 w-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-700 font-bold text-xs">
                                        {{ substr($proyecto->socio->nombre, 0, 2) }}
                                    </div>
                                    <div class="ml-3 text-sm">
                                        <p class="font-medium text-gray-900">{{ $proyecto->socio->nombre }}</p>
                                        <p class="text-gray-500 text-xs">{{ $proyecto->socio->identificacion }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($proyecto->estado)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold uppercase tracking-wider 
            {{ $proyecto->estado->es_final ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-700' }}">
                                    {{ $proyecto->estado->nombre }}
                                </span>
                                @else
                                <span class="text-gray-400 text-xs italic">Sin estado</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('proyecto.revisar', $proyecto->id) }}"
                                    class="inline-flex items-center px-3 py-1.5 bg-gray-900 text-white text-xs font-bold rounded-lg hover:bg-indigo-600 transition shadow-sm">
                                    Revisar
                                    <svg class="w-3 h-3 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M9 5l7 7-7 7"></path>
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