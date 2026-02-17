<div class="min-h-screen bg-[#f8fafc] py-6" wire:poll.15s>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        {{-- NAVEGACIÓN --}}
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
            <a href="{{ route('convocatoria.gestionar', $proyecto->convocatoria_id) }}" wire:navigate class="text-gray-400 hover:text-indigo-600 transition-colors">Postulaciones</a>
            <svg class="w-3 h-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path>
            </svg>
            <span class="text-indigo-600">Revisión Técnica</span>
        </nav>

        {{-- HEADER COMPACTO --}}
        <div class="mb-8 bg-white rounded-[2rem] p-8 border border-gray-100 shadow-xl relative overflow-hidden">
            <div class="relative z-10 flex flex-col lg:flex-row justify-between items-center gap-8">
                <div class="flex-1 text-center lg:text-left">
                    <span class="inline-block px-4 py-1 bg-indigo-600 text-white text-[9px] font-black uppercase tracking-[3px] rounded-full mb-4 shadow-lg shadow-indigo-200">
                        RADICADO: {{ $proyecto->codigo_radicado }}
                    </span>
                    <h1 class="text-3xl md:text-5xl font-black text-gray-900 tracking-tighter leading-tight uppercase mb-1">{{ $proyecto->titulo }}</h1>
                    <p class="text-indigo-500 font-bold text-xs uppercase tracking-[4px]">Expediente Técnico de Inscripción</p>
                </div>
                <div class="shrink-0 flex items-center gap-6 bg-gray-50 p-5 rounded-[2rem] border border-gray-100">
                    <div class="text-right hidden md:block">
                        <p class="text-[9px] font-black text-indigo-500 uppercase tracking-[2px] mb-2">Información del Titular</p>

                        {{-- Nombre y Tipo de Socio --}}
                        <p class="text-lg font-black text-gray-900 uppercase leading-none mb-1">
                            {{ $proyecto->socio->nombre }}
                        </p>
                        <p class="text-[10px] font-bold text-indigo-600 uppercase tracking-widest mb-3">
                            {{ $proyecto->socio->tipo_socio ?? 'Socio Individual' }}
                        </p>

                        {{-- Datos de Contacto --}}
                        <div class="flex flex-col gap-1 mt-2 border-t border-gray-100 pt-2">
                            <div class="flex items-center justify-end gap-2 text-gray-500">
                                <span class="text-[11px] font-bold">{{ $proyecto->socio->correo }}</span>
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="flex items-center justify-end gap-2 text-gray-500">
                                <span class="text-[11px] font-bold">{{ $proyecto->socio->telefono ?? 'Sin teléfono' }}</span>
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="h-28 w-28 rounded-[1.5rem] bg-white border-4 border-white shadow-2xl overflow-hidden ring-2 ring-indigo-500/10">
                        @if($proyecto->socio->foto_url)
                        <img src="{{ $proyecto->socio->foto_url }}" class="h-full w-full object-cover">
                        @else
                        <div class="h-full w-full flex items-center justify-center bg-black text-2xl font-black text-brand-orange">{{ $proyecto->socio->iniciales }}</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- LISTADO DE DOCUMENTOS --}}
        <div class="space-y-6 mb-10">

            {{-- TARJETA INFORMATIVA: Se muestra si el campo en DB es true --}}
            @if($proyecto->guion_propio)
            <div class="bg-indigo-50/50 rounded-[2rem] border-2 border-dashed border-indigo-200 p-8 flex items-center justify-between shadow-sm">
                <div class="flex items-center gap-6">
                    <div class="h-14 w-14 bg-white rounded-2xl flex items-center justify-center shadow-sm text-indigo-600">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-black text-gray-900 uppercase tracking-tight">AUTORIZACIÓN USO DE GUIÓN</h3>
                        <div class="flex items-center gap-2 mt-1">
                            <span class="h-2 w-2 bg-indigo-500 rounded-full"></span>
                            <p class="text-[10px] font-bold text-indigo-600 uppercase tracking-widest">El proponente confirma (Guion Propio)</p>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <span class="px-6 py-2 bg-indigo-600 text-white text-[9px] font-black uppercase tracking-widest rounded-full shadow-lg shadow-indigo-100">Exento de Soporte</span>
                </div>
            </div>
            @endif

            @foreach($documentosAgrupados as $tipoId => $versiones)
            @php
            $docActual = $versiones->sortByDesc('version')->first();
            $estado = $docActual->estado;
            $tieneObs = $docActual->observaciones->where('etapa_id', $this->proyecto->etapa_id)->first();

            // Identificamos si este documento es el de Guion para no duplicarlo si ya mostramos la azul
            $nombreSlug = \Illuminate\Support\Str::slug($docActual->tipoDocumento->nombre);
            $esTipoGuion = str_contains($nombreSlug, 'guion') || str_contains($nombreSlug, 'autorizacion');
            @endphp

            {{-- Solo mostramos la tarjeta blanca si NO es un caso de guion propio --}}
            @if(!($proyecto->guion_propio && $esTipoGuion))
            <div class="bg-white rounded-[2rem] border border-gray-100 shadow-lg overflow-hidden" wire:key="doc-container-{{ $docActual->id }}">
                <div class="p-6 md:p-8">
                    <div class="flex flex-col lg:flex-row justify-between gap-6 items-start">
                        <div class="flex-1">
                            <h3 class="text-xl font-black text-gray-900 mb-4 tracking-tight uppercase leading-tight">{{ $docActual->tipoDocumento->nombre }}</h3>
                            <div class="flex flex-wrap items-center gap-2">
                                @foreach($versiones->sortBy('version') as $v)
                                <a href="{{ asset('storage/' . $v->ruta_archivo) }}" target="_blank" class="px-5 py-2.5 rounded-xl text-[9px] font-black uppercase transition-all border-2 {{ $v->id === $docActual->id ? 'bg-gray-900 border-gray-900 text-white shadow-lg' : 'bg-white border-gray-100 text-gray-400 hover:border-indigo-200' }}">
                                    VER ANEXO V{{ $v->version }}
                                </a>
                                @endforeach
                            </div>
                        </div>

                        <div class="flex bg-gray-100 p-1.5 rounded-2xl border border-gray-200 shrink-0">
                            @foreach(['aprobado' => 'CUMPLE', 'subsanar' => 'SUBSANAR', 'rechazado' => 'NO VÁLIDO'] as $key => $label)
                            <button wire:click="cambiarEstadoDocumento({{ $docActual->id }}, '{{ $key }}')" wire:loading.attr="disabled"
                                class="relative px-6 py-3.5 rounded-xl text-[9px] font-black uppercase tracking-widest transition-all min-w-[120px] flex items-center justify-center {{ $estado === $key ? ($key === 'aprobado' ? 'bg-emerald-600 text-white shadow-md' : ($key === 'subsanar' ? 'bg-amber-500 text-white shadow-md' : 'bg-rose-600 text-white shadow-md')) : 'text-gray-400 hover:text-gray-900 hover:bg-white' }} disabled:opacity-50">
                                <span wire:loading.remove wire:target="cambiarEstadoDocumento({{ $docActual->id }}, '{{ $key }}')">{{ $label }}</span>
                                <svg wire:loading wire:target="cambiarEstadoDocumento({{ $docActual->id }}, '{{ $key }}')" class="animate-spin h-4 w-4 text-current" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </button>
                            @endforeach
                        </div>
                    </div>

                    <div class="mt-6">
                        @if($estado === 'aprobado')
                        <div class="p-4 bg-emerald-50/50 rounded-2xl border-2 border-dashed border-emerald-100 flex items-center justify-center gap-3">
                            <span class="text-[10px] font-black text-emerald-700 uppercase tracking-widest">Requisito validado correctamente</span>
                        </div>
                        @elseif($estado === 'subsanar' || $estado === 'rechazado')
                        @if($tieneObs && !empty($observacionesDocs[$docActual->id]) && !$errors->has('observacionesDocs.'.$docActual->id))
                        <div wire:click="prepararEdicion({{ $docActual->id }})" class="cursor-pointer p-5 bg-gray-50 rounded-2xl border-2 border-dashed border-gray-200 flex items-center justify-center gap-4 group transition-all hover:bg-white hover:border-indigo-300">
                            <div class="h-2 w-2 rounded-full {{ $estado === 'subsanar' ? 'bg-amber-500' : 'bg-rose-500' }}"></div>
                            <span class="text-[10px] font-black text-gray-600 uppercase tracking-widest italic">Justificación registrada</span>
                            <span class="text-[8px] font-black text-indigo-600 opacity-0 group-hover:opacity-100 uppercase underline ml-2">Editar Justificación</span>
                        </div>
                        @else
                        <div class="pt-6 border-t border-gray-100 space-y-4" wire:key="area-obs-{{ $docActual->id }}">
                            <textarea wire:model.defer="observacionesDocs.{{ $docActual->id }}" wire:key="txt-{{ $docActual->id }}" class="w-full rounded-2xl p-5 text-sm font-bold text-gray-700 border-2 transition-all min-h-[100px] {{ $errors->has('observacionesDocs.'.$docActual->id) ? 'border-red-500 bg-red-50' : 'border-gray-100 bg-gray-50 focus:border-indigo-500' }}" placeholder="Describa el hallazgo..."></textarea>
                            @error('observacionesDocs.'.$docActual->id) <p class="text-[9px] font-black text-red-600 uppercase ml-2">{{ $message }}</p> @enderror
                            <div class="flex justify-end">
                                <button wire:click="guardarAvanceDocumento({{ $docActual->id }})" wire:loading.attr="disabled" class="px-6 py-3 bg-gray-900 text-white text-[9px] font-black uppercase tracking-widest rounded-xl flex items-center gap-2 transition-transform active:scale-95">
                                    <span wire:loading.remove wire:target="guardarAvanceDocumento({{ $docActual->id }})">Confirmar</span>
                                    <svg wire:loading wire:target="guardarAvanceDocumento({{ $docActual->id }})" class="animate-spin h-3 w-3 text-white" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        @endif
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>

        {{-- SECCIÓN FINAL: DICTAMEN --}}
        <div class="bg-gray-900 rounded-[2.5rem] p-10 shadow-3xl relative overflow-hidden" wire:key="seccion-final">
            <div class="absolute top-0 right-0 -mt-20 -mr-20 w-80 h-80 bg-indigo-500/10 rounded-full blur-3xl"></div>
            <div class="relative z-10 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="space-y-6">
                    <div>
                        <div class="flex items-center gap-3 mb-4">
                            <div class="h-10 w-10 bg-indigo-600 rounded-xl flex items-center justify-center shadow-lg"><svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg></div>
                            <span class="text-indigo-400 text-[9px] font-black uppercase tracking-[3px]">Protocolo Actores S.C.G.</span>
                        </div>
                        <h2 class="text-3xl md:text-4xl font-black text-white tracking-tighter mb-4 uppercase leading-none">Dictamen de <br><span class="text-indigo-500">Auditoría Final</span></h2>
                    </div>

                    <div class="flex items-center gap-4 p-4 bg-white/5 border border-white/10 rounded-2xl w-fit">
                        <div class="flex flex-col">
                            <span class="text-[8px] font-black text-indigo-400 uppercase tracking-[2px] mb-2">Validado por</span>
                            <div class="flex items-center gap-3">
                                <div class="h-10 w-10 rounded-full border-2 border-indigo-500/30 bg-gray-800 flex items-center justify-center text-[11px] font-black text-white uppercase shadow-inner">
                                    {{ collect(explode(' ', auth()->user()->name))->map(fn($n) => mb_substr($n, 0, 1))->take(2)->implode('') }}
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-[10px] font-black text-gray-200 uppercase tracking-widest leading-none">{{ auth()->user()->name }}</span>
                                    <span class="text-[8px] font-bold text-gray-500 uppercase tracking-tight mt-1">Auditor Técnico S.C.G.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-y-5">
                    <div class="relative">
                        <label class="text-[9px] font-black text-indigo-400 uppercase tracking-[3px] ml-4 mb-2 block">Resumen del Dictamen</label>
                        <textarea wire:model.lazy="comentarioCierre" wire:key="main-dictamen" class="w-full bg-white/5 border-2 rounded-[2rem] p-6 text-white font-bold focus:ring-4 transition-all min-h-[180px] text-sm leading-relaxed {{ $errors->has('comentarioCierre') ? 'border-red-500 bg-red-500/5' : 'border-white/10 focus:border-indigo-500' }}" placeholder="Conclusiones finales..."></textarea>
                        @error('comentarioCierre') <p class="text-red-500 text-[9px] font-black uppercase mt-3 ml-4">{{ $message }}</p> @enderror
                    </div>

                    <button wire:click="finalizarRevision" wire:loading.attr="disabled" class="group relative w-full py-6 bg-indigo-600 hover:bg-indigo-500 text-white rounded-[1.5rem] font-black text-xs uppercase tracking-[4px] shadow-2xl transition-all active:scale-95">
                        <div class="flex items-center justify-center gap-3">
                            <span wire:loading.remove wire:target="finalizarRevision">FIRMAR Y EMITIR VEREDICTO</span>
                            <span wire:loading wire:target="finalizarRevision">PROCESANDO DICTAMEN...</span>
                            <svg wire:loading wire:target="finalizarRevision" class="animate-spin h-4 w-4 text-white" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>