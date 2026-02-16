<div class="min-h-screen bg-gray-50/50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Breadcrumbs --}}
        <nav class="flex items-center gap-4 mb-6 text-[10px] font-black uppercase tracking-widest text-gray-400">
            <a href="{{ route('dashboard') }}" wire:navigate class="hover:text-indigo-600 transition-colors">Inicio</a>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
            <a href="{{ route('convocatoria.gestionar', $proyecto->convocatoria_id) }}" wire:navigate class="hover:text-indigo-600 transition-colors">Postulaciones</a>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
            <span class="text-indigo-600">Revisión de Proyecto</span>
        </nav>

        {{-- Header Industrial --}}
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 mb-8">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="px-2 py-0.5 bg-indigo-600 text-white text-[9px] font-black rounded uppercase"> {{ $proyecto->etapa->nombre }} </span>
                        <span class="text-[9px] font-bold text-gray-300 uppercase tracking-[2px]">ID: #{{ $proyecto->id }}</span>
                    </div>
                    <div class="flex flex-wrap items-baseline gap-x-4">
                        <span class="text-3xl lg:text-4xl font-black text-indigo-600 tracking-tighter uppercase"> {{ $proyecto->codigo_radicado }} </span>
                        <h1 class="text-2xl lg:text-3xl font-black text-gray-900 tracking-tight uppercase leading-none"> {{ $proyecto->titulo }} </h1>
                    </div>
                </div>
                <div class="px-6 lg:border-l border-gray-100 text-right">
                    <label class="text-[9px] font-black text-gray-400 uppercase block">Estado Actual</label>
                    <span class="text-xl font-black text-gray-900 uppercase"> {{ $proyecto->estado->nombre }} </span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            {{-- Listado de Documentos --}}
            <div class="lg:col-span-8 space-y-6">
                @foreach($proyecto->documentos as $doc)
                    <div class="bg-white rounded-3xl border-2 {{ $doc->estado != 'pendiente' ? 'border-indigo-100 shadow-md' : 'border-transparent shadow-sm' }} p-6 transition-all group">
                        <div class="flex flex-col md:flex-row justify-between gap-8">
                            <div class="flex-1 space-y-4">
                                <div class="flex items-start gap-4">
                                    <div class="p-3 bg-gray-50 rounded-2xl text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    </div>
                                    <div>
                                        <h3 class="font-black text-gray-900 text-lg uppercase">{{ $doc->tipoDocumento->nombre }}</h3>
                                        <span class="text-[10px] font-bold bg-gray-100 text-gray-500 px-2 py-0.5 rounded-full uppercase">VERSIÓN: {{ $doc->version }}</span>
                                    </div>
                                </div>

                                <div class="flex flex-wrap gap-2">
                                    <a href="{{ asset('storage/' . $doc->ruta_archivo) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-gray-900 text-white rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-indigo-600 transition-all">
                                        Abrir Documento Actual
                                    </a>
                                    
                                    @php 
                                        $obsH = \App\Models\Observacion::where('documento_id', $doc->id)->where('etapa_id', $proyecto->etapa_id)->first();
                                    @endphp
                                    @if($obsH && $obsH->archivo_error_path && $doc->version > 1)
                                        <a href="{{ asset('storage/' . $obsH->archivo_error_path) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-amber-50 border border-amber-200 text-amber-700 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-amber-100 transition-all">
                                            Ver Anterior (v{{ $doc->version - 1 }})
                                        </a>
                                    @endif
                                </div>
                            </div>

                            <div class="md:w-80 space-y-4">
                                <div>
                                    <label class="text-[10px] font-black text-gray-400 uppercase">Dictamen Técnico</label>
                                    <div class="grid grid-cols-3 gap-1.5 mt-1.5">
                                        <button wire:click="cambiarEstadoDocumento({{ $doc->id }}, 'aprobado')" class="h-10 rounded-xl font-black text-[10px] transition-all {{ $doc->estado === 'aprobado' ? 'bg-emerald-500 text-white shadow-lg' : 'bg-gray-100 text-gray-400 hover:bg-emerald-50' }}">APROBAR</button>
                                        <button wire:click="cambiarEstadoDocumento({{ $doc->id }}, 'subsanar')" class="h-10 rounded-xl font-black text-[10px] transition-all {{ $doc->estado === 'subsanar' ? 'bg-amber-500 text-white shadow-lg' : 'bg-gray-100 text-gray-400 hover:bg-amber-50' }}">SUBSANAR</button>
                                        <button wire:click="cambiarEstadoDocumento({{ $doc->id }}, 'rechazado')" class="h-10 rounded-xl font-black text-[10px] transition-all {{ $doc->estado === 'rechazado' ? 'bg-rose-500 text-white shadow-lg' : 'bg-gray-100 text-gray-400 hover:bg-rose-50' }}">RECHAZAR</button>
                                    </div>
                                </div>

                                <div class="relative {{ $doc->estado === 'aprobado' ? 'hidden' : 'block' }}">
                                    <div class="bg-gray-50 rounded-2xl p-4 border-2 {{ $errors->has('obs.'.$doc->id) ? 'border-rose-400 bg-rose-50' : 'border-gray-100' }}">
                                        <textarea wire:model.blur="observacionesDocs.{{ $doc->id }}" class="w-full bg-transparent border-none text-xs p-0 focus:ring-0 text-gray-600" placeholder="Escriba el motivo..." rows="3"></textarea>
                                    </div>
                                    @error('obs.'.$doc->id)
                                        <span class="text-[9px] text-rose-600 font-bold uppercase mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Sidebar Cierre --}}
            <div class="lg:col-span-4">
                <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-gray-100 sticky top-8 space-y-6">
                    <h2 class="text-2xl font-black text-gray-900 uppercase tracking-tighter">Cierre de Auditoría</h2>
                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase mb-3">Observación General</label>
                        <textarea wire:model="comentarioCierre" class="w-full rounded-2xl border-gray-100 bg-gray-50 text-sm focus:ring-indigo-500 p-4" rows="6" placeholder="Resumen final..."></textarea>
                        @error('comentarioCierre') <p class="text-rose-600 text-[10px] font-black mt-2 uppercase">{{ $message }}</p> @enderror
                    </div>
                    <button wire:click="finalizarRevision" wire:loading.attr="disabled" class="w-full py-5 bg-gray-900 text-white hover:bg-indigo-700 rounded-2xl font-black text-xs uppercase tracking-widest transition-all shadow-xl">
                        <span wire:loading.remove>Finalizar y Guardar</span>
                        <span wire:loading>Procesando...</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>