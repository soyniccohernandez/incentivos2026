<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($convocatorias as $convocatoria)
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border-t-4 
        {{ $convocatoria->estado === 'abierta' ? 'border-green-500' : ($convocatoria->estado === 'cerrada' ? 'border-red-500' : 'border-yellow-500') }} 
        flex flex-col">
        
        <div class="p-6 flex-1">
            <div class="flex justify-between items-start mb-4">
                <span class="px-2 py-1 rounded-full text-xs font-bold uppercase 
                    {{ $convocatoria->estado === 'abierta' ? 'bg-green-100 text-green-700' : ($convocatoria->estado === 'cerrada' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') }}">
                    {{ $convocatoria->estado }}
                </span>
                <span class="text-gray-400 text-xs italic">ID: #{{ $convocatoria->id }}</span>
            </div>

            <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $convocatoria->nombre }}</h3>
            <p class="text-sm text-gray-600 mb-4 line-clamp-2">{{ $convocatoria->descripcion }}</p>

            <div class="space-y-2 border-t pt-4">
                <div class="flex justify-between text-xs">
                    <span class="text-gray-500 font-semibold">Cierra el:</span>
                    <span class="font-medium">{{ optional($convocatoria->fecha_fin)->format('d/m/Y') ?? 'Sin fecha' }}</span>
                </div>
                <div class="flex justify-between text-xs">
                    <span class="text-gray-500 font-semibold">Postulaciones:</span>
                    <span class="font-bold text-indigo-600">{{ $convocatoria->proyectos_count }}</span>
                </div>
                <div class="flex justify-between text-xs">
                    <span class="text-gray-500 font-semibold">Etapas definidas:</span>
                    <span class="font-medium text-gray-700">{{ $convocatoria->etapas->count() }}</span>
                </div>
            </div>
        </div>

        <div class="bg-gray-50 p-4 border-t">
            <a href="{{ route('convocatoria.gestionar', $convocatoria->id) }}"
                class="block w-full text-center bg-white border border-gray-300 text-gray-700 px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-100 transition shadow-sm">
                Gestionar Convocatoria
            </a>
        </div>
    </div>
    @empty
    <div class="col-span-full bg-white p-12 rounded-xl text-center shadow-sm">
        <p class="text-gray-500 italic">No se encontraron convocatorias en el sistema.</p>
    </div>
    @endforelse
</div>