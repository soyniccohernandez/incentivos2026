<div class="min-h-screen bg-gray-50/50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

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

            {{-- Link a Gestión (La convocatoria de este proyecto) --}}
            <a href="{{ route('convocatoria.gestionar', $proyecto->convocatoria_id) }}" wire:navigate class="text-gray-400 hover:text-indigo-600 transition-colors">
                Postulaciones
            </a>

            <svg class="w-3 h-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path>
            </svg>

            {{-- Posición Actual --}}
            <span class="text-indigo-600">Revisión de Proyecto</span>
        </nav>
        {{-- Header Industrial / Ultra-Wide --}}
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 mb-8">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">

                {{-- Bloque de Identidad --}}
                <div class="flex-1 min-w-0"> {{-- min-w-0 permite que el truncado o wrapping funcione en flex --}}
                    <div class="flex items-center gap-2 mb-2">
                        <span class="px-2 py-0.5 bg-indigo-600 text-white text-[9px] font-black rounded uppercase tracking-widest">
                            {{ $proyecto->etapa->nombre }}
                        </span>
                        <span class="text-[9px] font-bold text-gray-300 uppercase tracking-[2px]">ID Sistema: #{{ $proyecto->id }}</span>
                    </div>

                    <div class="flex flex-wrap lg:flex-nowrap items-baseline gap-x-4">
                        {{-- Radicado: Fijo y Fuerte --}}
                        <span class="text-3xl lg:text-4xl font-black text-indigo-600 tracking-tighter uppercase whitespace-nowrap">
                            {{ $proyecto->codigo_radicado }}
                        </span>

                        <span class="hidden lg:block text-3xl font-light text-gray-200">/</span>

                        {{-- Título: Flexible para nombres largos --}}
                        <h1 class="text-2xl lg:text-3xl font-black text-gray-900 tracking-tight uppercase leading-none break-words">
                            {{ $proyecto->titulo }}
                        </h1>
                    </div>

                    {{-- Data-Bar horizontal --}}
                    <div class="flex flex-wrap items-center gap-x-4 gap-y-1 mt-3 border-t border-gray-50 pt-3">
                        <div class="flex items-center gap-1.5">
                            <span class="text-[10px] font-black text-gray-400 uppercase">Socio proponente:</span>
                            <span class="text-[11px] font-bold text-gray-700 uppercase">{{ $proyecto->socio->nombre }}</span>
                        </div>
                        <div class="hidden lg:block w-1 h-1 rounded-full bg-gray-200"></div>
                        <div class="flex items-center gap-1.5">
                            <span class="text-[10px] font-black text-gray-400 uppercase">Documento:</span>
                            <span class="text-[11px] font-mono font-bold text-gray-700">{{ $proyecto->socio->identificacion }}</span>
                        </div>
                    </div>
                </div>

                {{-- Estado Lateral Compacto --}}
                <div class="flex lg:flex-col items-center lg:items-end justify-between lg:justify-center px-6 lg:border-l border-gray-100 min-w-fit">
                    <label class="text-[9px] font-black text-gray-400 uppercase tracking-[2px] lg:mb-1">Estado Revisión</label>
                    <div class="flex items-center gap-2">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-600"></span>
                        </span>
                        <span class="text-xl font-black text-gray-900 uppercase tracking-tighter">
                            {{ $proyecto->estado->nombre }}
                        </span>
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
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
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
                                        <span wire:loading wire:target="cambiarEstadoDocumento({{ $doc->id }}, 'aprobado')">
                                            <div class="spinner-ring"></div>
                                        </span>
                                    </button>

                                    {{-- Botón SUBSANAR --}}
                                    <button wire:click="cambiarEstadoDocumento({{ $doc->id }}, 'subsanar')"
                                        wire:loading.attr="disabled"
                                        class="flex justify-center items-center h-10 rounded-xl font-black text-[10px] transition-all {{ $doc->estado === 'subsanar' ? 'bg-amber-500 text-white shadow-lg' : 'bg-gray-100 text-gray-400 hover:bg-amber-50' }}">
                                        <span wire:loading.remove wire:target="cambiarEstadoDocumento({{ $doc->id }}, 'subsanar')">SUBSANAR</span>
                                        <span wire:loading wire:target="cambiarEstadoDocumento({{ $doc->id }}, 'subsanar')">
                                            <div class="spinner-ring"></div>
                                        </span>
                                    </button>

                                    {{-- Botón NO VÁLIDO --}}
                                    <button wire:click="cambiarEstadoDocumento({{ $doc->id }}, 'rechazado')"
                                        wire:loading.attr="disabled"
                                        class="flex justify-center items-center h-10 rounded-xl font-black text-[10px] transition-all {{ $doc->estado === 'rechazado' ? 'bg-rose-500 text-white shadow-lg' : 'bg-gray-100 text-gray-400 hover:bg-rose-50' }}">
                                        <span wire:loading.remove wire:target="cambiarEstadoDocumento({{ $doc->id }}, 'rechazado')">NO VÁLIDO</span>
                                        <span wire:loading wire:target="cambiarEstadoDocumento({{ $doc->id }}, 'rechazado')">
                                            <div class="spinner-ring"></div>
                                        </span>
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
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path>
                                </svg>
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