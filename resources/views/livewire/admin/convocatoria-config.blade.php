<div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-black text-gray-900 tracking-tight">Configuración del Sistema</h1>
                <p class="text-gray-500 font-medium">Gestiona tiempos y estados de: <span class="text-indigo-600">{{ $convocatoria->nombre }}</span></p>
            </div>
            <a href="{{ route('convocatoria.gestionar', $convocatoria->id) }}"
                wire:navigate
                class="text-xs font-black uppercase tracking-widest text-gray-400 hover:text-gray-600 transition">
                Volver
            </a>
        </div>

        <div class="space-y-6">
            <section class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                <div class="flex items-center gap-4 mb-6 text-amber-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M13 10V3L4 14h7v7l9-11h-7z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                    <h2 class="text-lg font-bold uppercase tracking-tight">Estado de la Convocatoria</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @foreach(['abierta', 'cerrada', 'pausada'] as $estado)
                    <label class="relative flex flex-col p-4 border rounded-xl cursor-pointer focus:outline-none transition {{ $estadoConvocatoria == $estado ? 'border-indigo-600 bg-indigo-50/50 ring-1 ring-indigo-600' : 'border-gray-100 hover:bg-gray-50' }}">
                        <input type="radio" wire:model="estadoConvocatoria" value="{{ $estado }}" class="sr-only">
                        <span class="text-[10px] font-black uppercase tracking-widest {{ $estadoConvocatoria == $estado ? 'text-indigo-600' : 'text-gray-400' }}">{{ $estado }}</span>
                    </label>
                    @endforeach
                </div>
            </section>

            <section class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-8 bg-gray-900 text-white">
                    <h2 class="text-lg font-bold uppercase tracking-tight">Cronograma Maestro</h2>
                    <p class="text-xs text-gray-400 font-medium mt-1">Define cuándo se abren y cierran los módulos para los socios.</p>
                </div>

                <div class="p-8 space-y-8">
                    @foreach($etapas as $index => $etapa)
                    <div class="relative pl-8 border-l-2 border-dashed {{ $loop->last ? 'border-transparent' : 'border-gray-200' }}">
                        <div class="absolute -left-[13px] top-0 w-6 h-6 rounded-full bg-indigo-600 text-white flex items-center justify-center text-[10px] font-black shadow-lg shadow-indigo-200">
                            {{ $index + 1 }}
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-12 gap-6 mb-4">
                            <div class="md:col-span-4">
                                <h3 class="font-black text-gray-800 uppercase text-xs tracking-wider mb-1">{{ $etapa['nombre'] }}</h3>
                                <div class="flex items-center gap-2">
                                    <input type="checkbox" wire:model="etapas.{{ $index }}.es_subsanable" class="rounded text-indigo-600 focus:ring-indigo-500">
                                    <span class="text-[10px] font-bold text-gray-500 uppercase">Permite corregir</span>
                                </div>
                            </div>

                            <div class="md:col-span-4">
                                <label class="block text-[9px] font-black text-gray-400 uppercase mb-1">Apertura (Fecha y Hora)</label>
                                <input type="datetime-local" wire:model="etapas.{{ $index }}.fecha_inicio"
                                    class="w-full border-gray-200 rounded-xl text-sm focus:ring-indigo-500 font-mono transition">
                            </div>

                            <div class="md:col-span-4">
                                <label class="block text-[9px] font-black text-gray-400 uppercase mb-1">Cierre (Fecha y Hora)</label>
                                <input type="datetime-local" wire:model="etapas.{{ $index }}.fecha_fin"
                                    class="w-full border-gray-200 rounded-xl text-sm focus:ring-indigo-500 font-mono transition">
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>

            <div class="flex justify-end gap-4 mt-10">
                <button wire:click="guardar" class="w-full md:w-auto px-10 py-4 bg-gray-900 text-white text-xs font-black uppercase tracking-[3px] rounded-2xl shadow-xl hover:bg-indigo-600 transition-all transform hover:-translate-y-1">
                    Guardar Configuración
                </button>
            </div>
        </div>
    </div>
</div>