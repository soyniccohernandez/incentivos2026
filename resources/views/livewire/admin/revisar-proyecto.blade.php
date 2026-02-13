<div class="min-h-screen bg-gray-50/50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 mb-8">
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">
                <div class="space-y-2">
                    <div class="flex items-center gap-3">
                        <span class="px-3 py-1 bg-indigo-600 text-white text-[10px] font-black rounded-full uppercase tracking-tighter">
                            {{ $proyecto->etapa->nombre }}
                        </span>
                        <span class="text-sm font-bold text-gray-400 tracking-tight">PROYECTO ID #{{ $proyecto->id }}</span>
                    </div>
                    <h1 class="text-4xl font-black text-gray-900 tracking-tight leading-none">{{ $proyecto->titulo }}</h1>
                    <div class="flex flex-wrap gap-x-6 gap-y-2 text-sm text-gray-500 pt-2">
                        <p><span class="font-bold text-gray-800 underline decoration-indigo-200">Socio:</span> {{ $proyecto->socio->nombre }}</p>
                        <p><span class="font-bold text-gray-800 underline decoration-indigo-200">ID:</span> {{ $proyecto->socio->identificacion }}</p>
                    </div>
                </div>

                <div class="relative group">
                    <div class="bg-gradient-to-br from-indigo-50 to-white px-10 py-5 rounded-3xl border border-indigo-100 text-center shadow-sm">
                        <label class="block text-[10px] font-black text-indigo-400 uppercase mb-1 tracking-widest">Estado</label>
                        <span class="text-2xl font-black text-indigo-900 uppercase">{{ $proyecto->estado->nombre }}</span>
                    </div>
                </div>
            </div>
        </div>

        @if (session()->has('message'))
            <div class="mb-6 p-4 bg-emerald-500 text-white rounded-2xl font-bold shadow-lg">
                {{ session('message') }}
            </div>
        @endif

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
                                        <span class="text-[10px] font-bold bg-gray-100 text-gray-500 px-2 py-0.5 rounded-full uppercase">VERSIÓN {{ $doc->version }}</span>
                                    </div>
                                </div>
                                <a href="{{ asset('storage/' . $doc->ruta_archivo) }}" target="_blank" class="inline-flex items-center px-5 py-2.5 bg-gray-900 text-white rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-indigo-600 transition-all">
                                    Visualizar Original
                                </a>
                            </div>

                            <div class="md:w-80 space-y-4">
                                <div>
                                    <label class="text-[10px] font-black text-gray-400 uppercase">Dictamen Técnico</label>
                                    <div class="grid grid-cols-3 gap-1.5 mt-1.5">
                                        
                                        {{-- Botón APROBAR --}}
                                        <button wire:click="cambiarEstadoDocumento({{ $doc->id }}, 'aprobado')" 
                                            wire:loading.attr="disabled"
                                            class="flex justify-center items-center h-10 rounded-xl font-black text-[10px] transition-all {{ $doc->estado === 'aprobado' ? 'bg-emerald-500 text-white shadow-lg' : 'bg-gray-100 text-gray-400 hover:bg-emerald-50' }}">
                                            <span wire:loading.remove wire:target="cambiarEstadoDocumento({{ $doc->id }}, 'aprobado')">APROBAR</span>
                                            <span wire:loading wire:target="cambiarEstadoDocumento({{ $doc->id }}, 'aprobado')"><div class="spinner-ring"></div></span>
                                        </button>

                                        {{-- Botón SUBSANAR --}}
                                        <button wire:click="cambiarEstadoDocumento({{ $doc->id }}, 'subsanar')" 
                                            wire:loading.attr="disabled"
                                            class="flex justify-center items-center h-10 rounded-xl font-black text-[10px] transition-all {{ $doc->estado === 'subsanar' ? 'bg-amber-500 text-white shadow-lg' : 'bg-gray-100 text-gray-400 hover:bg-amber-50' }}">
                                            <span wire:loading.remove wire:target="cambiarEstadoDocumento({{ $doc->id }}, 'subsanar')">SUBSANAR</span>
                                            <span wire:loading wire:target="cambiarEstadoDocumento({{ $doc->id }}, 'subsanar')"><div class="spinner-ring"></div></span>
                                        </button>

                                        {{-- Botón NO VÁLIDO --}}
                                        <button wire:click="cambiarEstadoDocumento({{ $doc->id }}, 'rechazado')" 
                                            wire:loading.attr="disabled"
                                            class="flex justify-center items-center h-10 rounded-xl font-black text-[10px] transition-all {{ $doc->estado === 'rechazado' ? 'bg-rose-500 text-white shadow-lg' : 'bg-gray-100 text-gray-400 hover:bg-rose-50' }}">
                                            <span wire:loading.remove wire:target="cambiarEstadoDocumento({{ $doc->id }}, 'rechazado')">NO VÁLIDO</span>
                                            <span wire:loading wire:target="cambiarEstadoDocumento({{ $doc->id }}, 'rechazado')"><div class="spinner-ring"></div></span>
                                        </button>

                                    </div>
                                </div>

                                {{-- Área de Comentario --}}
                                <div class="relative {{ $doc->estado === 'aprobado' && !$errors->has('obs.'.$doc->id) ? 'hidden' : 'block' }}">
                                    <div class="bg-gray-50 rounded-2xl p-4 border-2 {{ $errors->has('obs.'.$doc->id) ? 'border-rose-400 bg-rose-50' : 'border-gray-100 shadow-inner' }}">
                                        <textarea
                                            wire:model.blur="observacionesDocs.{{ $doc->id }}"
                                            class="w-full bg-transparent border-none text-xs p-0 focus:ring-0 text-gray-600 placeholder:text-gray-400"
                                            placeholder="Escriba el motivo detallado..."
                                            rows="3"></textarea>
                                    </div>
                                    @error('obs.'.$doc->id)
                                        <div class="absolute -bottom-2 left-3 bg-rose-600 text-white text-[8px] font-black px-2 py-0.5 rounded uppercase">{{ $message }}</div>
                                    @enderror
                                </div>

                                @if($doc->estado === 'aprobado')
                                    <div class="flex items-center gap-2 px-4 py-3 bg-emerald-50 rounded-2xl border border-emerald-100 text-emerald-700 animate-in fade-in duration-300">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path></svg>
                                        <span class="text-[10px] font-black uppercase">Documento OK</span>
                                    </div>
                                @endif
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
                        <label class="block text-xs font-black text-gray-400 uppercase mb-3">Dictamen General</label>
                        <textarea wire:model="comentarioCierre"
                            class="w-full rounded-2xl border-gray-100 bg-gray-50 text-sm focus:ring-indigo-500 p-4 {{ $errors->has('comentarioCierre') ? 'border-rose-300' : '' }}"
                            rows="8" placeholder="Conclusión final para el socio..."></textarea>
                        @error('comentarioCierre') <p class="text-rose-600 text-[10px] font-black mt-2 uppercase">{{ $message }}</p> @enderror
                    </div>

                    <button wire:click="finalizarRevision"
                        wire:loading.attr="disabled"
                        class="relative w-full py-5 bg-gray-900 text-white hover:bg-indigo-700 rounded-2xl font-black text-xs uppercase tracking-widest transition-all shadow-xl disabled:opacity-70 disabled:cursor-not-allowed">
                        
                        <span wire:loading.remove wire:target="finalizarRevision">
                            Finalizar Auditoría
                        </span>
                        
                        <div wire:loading wire:target="finalizarRevision" class="flex items-center justify-center gap-2">
                            <div class="spinner-ring"></div>
                            <span>Procesando...</span>
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>