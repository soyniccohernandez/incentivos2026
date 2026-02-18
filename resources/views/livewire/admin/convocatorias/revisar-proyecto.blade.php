<div class="min-h-screen bg-[#f8fafc] py-6" wire:poll.15s x-data="{ etapaAbierta: {{ $proyecto->etapa_id }} }">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        {{-- 1. NAVEGACIÓN --}}
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

        {{-- 2. HEADER COMPACTO --}}
        <div class="mb-8 bg-white rounded-[2rem] p-8 border border-gray-100 shadow-xl relative overflow-hidden">
            <div class="relative z-10 flex flex-col lg:flex-row justify-between items-center gap-8">
                <div class="flex-1 text-center lg:text-left">
                    <span class="inline-block px-4 py-1 bg-indigo-600 text-white text-[9px] font-black uppercase tracking-[3px] rounded-full mb-4 shadow-lg shadow-indigo-200">
                        RADICADO: {{ $proyecto->codigo_radicado }}
                    </span>
                    <h1 class="text-3xl md:text-5xl font-black text-gray-900 tracking-tighter leading-tight uppercase mb-1">{{ $proyecto->titulo }}</h1>
                    <p class="text-indigo-500 font-bold text-xs uppercase tracking-[4px]">Expediente Integral del Proyecto</p>
                </div>
                <div class="shrink-0 flex items-center gap-6 bg-gray-50 p-5 rounded-[2rem] border border-gray-100">
                    <div class="text-right hidden md:block">
                        <p class="text-[9px] font-black text-indigo-500 uppercase tracking-[2px] mb-2">Información del Titular</p>
                        <p class="text-lg font-black text-gray-900 uppercase leading-none mb-1">{{ $proyecto->socio->nombre }}</p>
                        <p class="text-[10px] font-bold text-indigo-600 uppercase tracking-widest mb-3">{{ $proyecto->socio->tipo_socio ?? 'Socio Individual' }}</p>
                        <div class="flex flex-col gap-1 mt-2 border-t border-gray-100 pt-2">
                            <div class="flex items-center justify-end gap-2 text-gray-500">
                                <span class="text-[11px] font-bold">{{ $proyecto->socio->correo }}</span>
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
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

        {{-- 3. CONTENEDOR DE ACORDEONES --}}
        <div class="space-y-4 mb-10">
            {{-- --- BLOQUE ETAPA 1 --- --}}
            <div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm overflow-hidden transition-all">
                <button @click="etapaAbierta = (etapaAbierta === 1 ? 0 : 1)" class="w-full px-8 py-7 flex items-center justify-between hover:bg-gray-50 transition-colors">
                    <div class="flex items-center gap-4">
                        <div class="h-9 w-9 rounded-full flex items-center justify-center text-[10px] font-black shadow-md transition-all" :class="etapaAbierta === 1 ? 'bg-indigo-600 text-white' : 'bg-gray-100 text-gray-400'">01</div>
                        <h2 class="text-sm font-black uppercase tracking-[4px]" :class="etapaAbierta === 1 ? 'text-gray-900' : 'text-gray-400'"> Requisitos de Inscripción (Etapa 1) </h2>
                    </div>
                    <svg class="w-6 h-6 text-gray-400 transition-transform duration-300" :class="etapaAbierta === 1 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="etapaAbierta === 1" x-collapse>
                    <div class="px-8 pb-10 space-y-6">
                        {{-- DATOS DIRECTOR --}}
                        <div class="bg-gray-50 rounded-[2rem] border border-indigo-100 p-8 mb-8 flex flex-col md:flex-row items-center gap-8 shadow-inner">
                            <div class="h-20 w-20 rounded-2xl bg-white border-2 border-indigo-100 flex items-center justify-center shadow-sm shrink-0">
                                <svg class="w-10 h-10 text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <div class="flex-1 text-center md:text-left">
                                <p class="text-[9px] font-black text-indigo-500 uppercase tracking-[3px] mb-1">Director del Proyecto</p>
                                <h3 class="text-xl font-black text-gray-900 uppercase tracking-tight leading-none mb-2"> {{ $proyecto->director_nombre ?? 'Nombre no registrado' }} </h3>
                                <div class="flex flex-wrap justify-center md:justify-start gap-4">
                                    <div class="flex items-center gap-2">
                                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Identificación:</span>
                                        <span class="text-[10px] font-black text-gray-700 uppercase">{{ $proyecto->director_identificacion ?? '---' }}</span>
                                    </div>
                                    <div class="flex items-center gap-2 text-gray-300">|</div>
                                    <div class="flex items-center gap-2">
                                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Teléfono:</span>
                                        <span class="text-[10px] font-black text-gray-700 uppercase">{{ $proyecto->director_telefono ?? '---' }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="shrink-0">
                                <span class="px-5 py-2 bg-white border border-indigo-100 text-indigo-600 text-[8px] font-black uppercase tracking-widest rounded-xl shadow-sm"> Perfil del Director </span>
                            </div>
                        </div>

                        @if($proyecto->guion_propio)
                            <div class="bg-indigo-50/50 rounded-[2rem] border-2 border-dashed border-indigo-200 p-8 flex items-center justify-between shadow-sm">
                                <div class="flex items-center gap-6">
                                    <div class="h-14 w-14 bg-white rounded-2xl flex items-center justify-center shadow-sm text-indigo-600"><svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path> </svg></div>
                                    <div>
                                        <h3 class="text-lg font-black text-gray-900 uppercase tracking-tight">AUTORIZACIÓN USO DE GUIÓN</h3>
                                        <div class="flex items-center gap-2 mt-1"><span class="h-2 w-2 bg-indigo-500 rounded-full"></span> <p class="text-[10px] font-bold text-indigo-600 uppercase tracking-widest">El proponente confirma (Guion Propio)</p> </div>
                                    </div>
                                </div>
                                <div class="text-right"><span class="px-6 py-2 bg-indigo-600 text-white text-[9px] font-black uppercase tracking-widest rounded-full shadow-lg shadow-indigo-100">Exento de Soporte</span></div>
                            </div>
                        @endif

                        @foreach($documentosAgrupados as $tipoId => $versiones)
                            @php
                                $docActual = $versiones->sortByDesc('version')->first();
                                if($docActual->tipoDocumento->etapa_id != 1) continue;
                                $estado = $docActual->estado;
                                $tieneObs = $docActual->observaciones->where('etapa_id', $this->proyecto->etapa_id)->first();
                                $nombreSlug = \Illuminate\Support\Str::slug($docActual->tipoDocumento->nombre);
                                $esTipoGuion = str_contains($nombreSlug, 'guion') || str_contains($nombreSlug, 'autorizacion');
                            @endphp
                            @if(!($proyecto->guion_propio && $esTipoGuion))
                                <div class="bg-white rounded-[2rem] border border-gray-100 shadow-lg overflow-hidden" wire:key="doc-{{ $docActual->id }}">
                                    <div class="p-6 md:p-8">
                                        <div class="flex flex-col lg:flex-row justify-between gap-6 items-start">
                                            <div class="flex-1">
                                                <h3 class="text-xl font-black text-gray-900 mb-4 tracking-tight uppercase leading-tight">{{ $docActual->tipoDocumento->nombre }}</h3>
                                                <div class="flex flex-wrap items-center gap-2">
                                                    @foreach($versiones->sortBy('version') as $v)
                                                        <a href="{{ asset('storage/' . $v->ruta_archivo) }}" target="_blank" class="px-5 py-2.5 rounded-xl text-[9px] font-black uppercase transition-all border-2 {{ $v->id === $docActual->id ? 'bg-gray-900 border-gray-900 text-white shadow-lg' : 'bg-white border-gray-100 text-gray-400 hover:border-indigo-200' }}">VER ANEXO V{{ $v->version }}</a>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="flex bg-gray-100 p-1.5 rounded-2xl border border-gray-200 shrink-0">
                                                @foreach(['aprobado' => 'CUMPLE', 'subsanar' => 'SUBSANAR', 'rechazado' => 'NO VÁLIDO'] as $key => $label)
                                                    <button wire:click="cambiarEstadoDocumento({{ $docActual->id }}, '{{ $key }}')" class="px-6 py-3.5 rounded-xl text-[9px] font-black uppercase tracking-widest transition-all min-w-[120px] {{ $estado === $key ? ($key === 'aprobado' ? 'bg-emerald-600 text-white shadow-md' : ($key === 'subsanar' ? 'bg-amber-500 text-white shadow-md' : 'bg-rose-600 text-white shadow-md')) : 'text-gray-400 hover:text-gray-900 hover:bg-white' }}">{{ $label }}</button>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="mt-6">
                                            @if($estado === 'aprobado')
                                                <div class="p-4 bg-emerald-50/50 rounded-2xl border-2 border-dashed border-emerald-100 flex items-center justify-center gap-3"><span class="text-[10px] font-black text-emerald-700 uppercase tracking-widest">Requisito validado correctamente</span></div>
                                            @elseif($estado === 'subsanar' || $estado === 'rechazado')
                                                @if($tieneObs && !empty($observacionesDocs[$docActual->id]))
                                                    <div class="p-5 bg-gray-50 rounded-2xl border-2 border-dashed border-gray-200 flex items-center justify-center gap-4 group transition-all">
                                                        <div class="h-2 w-2 rounded-full {{ $estado === 'subsanar' ? 'bg-amber-500' : 'bg-rose-500' }}"></div>
                                                        <span class="text-[10px] font-black text-gray-600 uppercase tracking-widest italic">Justificación registrada</span>
                                                    </div>
                                                @else
                                                    <div class="pt-6 border-t border-gray-100 space-y-4">
                                                        <textarea wire:model.defer="observacionesDocs.{{ $docActual->id }}" class="w-full rounded-2xl p-5 text-sm font-bold text-gray-700 border-2 border-gray-100 bg-gray-50 focus:border-indigo-500 min-h-[100px]" placeholder="Describa el hallazgo..."></textarea>
                                                        <div class="flex justify-end"><button wire:click="guardarAvanceDocumento({{ $docActual->id }})" class="px-6 py-3 bg-gray-900 text-white text-[9px] font-black uppercase rounded-xl active:scale-95 transition-transform">Confirmar</button></div>
                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- --- BLOQUE ETAPA 2 (CON FIX PARA ELENCO) --- --}}
            <div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm overflow-hidden transition-all">
                <button @click="etapaAbierta = (etapaAbierta === 2 ? 0 : 2)" class="w-full px-8 py-7 flex items-center justify-between hover:bg-gray-50 transition-colors">
                    <div class="flex items-center gap-4">
                        <div class="h-9 w-9 rounded-full flex items-center justify-center text-[10px] font-black shadow-md transition-all" :class="etapaAbierta === 2 ? 'bg-purple-600 text-white' : 'bg-gray-100 text-gray-400'">02</div>
                        <h2 class="text-sm font-black uppercase tracking-[3px]" :class="etapaAbierta === 2 ? 'text-gray-900' : 'text-gray-400'"> Información Técnica y Elenco (Etapa 2) </h2>
                    </div>
                    <div class="flex items-center gap-4">
                        @if($proyecto->etapa_id >= 2)
                            <span class="px-4 py-1.5 bg-emerald-50 text-emerald-600 text-[8px] font-black rounded-full uppercase tracking-widest border border-emerald-100">Expediente Recibido</span>
                        @endif
                        <svg class="w-6 h-6 text-gray-400 transition-transform duration-300" :class="etapaAbierta === 2 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </button>
                <div x-show="etapaAbierta === 2" x-collapse>
                    <div class="px-8 pb-10 space-y-8">
                        {{-- SECCIÓN DE ELENCO ACTUALIZADA --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($elencoActual as $miembro)
                                <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-2xl border border-gray-100">
                                    <div class="h-12 w-12 rounded-xl bg-purple-600 flex items-center justify-center text-white font-black text-xs shrink-0 shadow-sm">
                                        {{ mb_substr($miembro->nombre, 0, 2) }}
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-[10px] font-black text-gray-900 uppercase truncate">{{ $miembro->nombre }}</p>
                                        <p class="text-[9px] font-bold text-gray-400 uppercase tracking-tighter">C.C. {{ $miembro->identificacion }}</p>
                                    </div>
                                    
                                    @if($miembro->pivot?->archivo_autorizacion_path)
                                        <a href="{{ asset('storage/' . $miembro->pivot->archivo_autorizacion_path) }}" target="_blank" class="px-3 py-2 bg-white border border-gray-200 rounded-lg text-[8px] font-black uppercase hover:bg-purple-50 hover:text-purple-600 transition-colors">
                                            Autorización
                                        </a>
                                    @else
                                        <span class="px-3 py-2 bg-amber-50 text-amber-600 rounded-lg text-[7px] font-black uppercase border border-amber-100">
                                            Sin Archivo
                                        </span>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        <div class="h-px bg-gray-100 w-full"></div>

                        {{-- DOCUMENTOS TÉCNICOS --}}
                        <div class="space-y-6">
                            @foreach($documentosAgrupados as $tipoId => $versiones)
                                @php
                                    $docActual = $versiones->sortByDesc('version')->first();
                                    if($docActual->tipoDocumento->etapa_id != 2) continue;
                                    $estado = $docActual->estado;
                                @endphp
                                <div class="bg-white rounded-[2rem] border border-gray-100 shadow-lg overflow-hidden">
                                    <div class="p-6">
                                        <div class="flex flex-col lg:flex-row justify-between gap-6 items-start">
                                            <div class="flex-1">
                                                <h3 class="text-lg font-black text-gray-900 mb-3 tracking-tight uppercase">{{ $docActual->tipoDocumento->nombre }}</h3>
                                                <a href="{{ asset('storage/' . $docActual->ruta_archivo) }}" target="_blank" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gray-900 text-white rounded-xl text-[9px] font-black uppercase tracking-widest shadow-lg">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                    VER DOCUMENTO TÉCNICO
                                                </a>
                                            </div>
                                            <div class="flex bg-gray-100 p-1.5 rounded-2xl border border-gray-200 shrink-0">
                                                <button wire:click="cambiarEstadoDocumento({{ $docActual->id }}, 'aprobado')" class="px-6 py-3.5 rounded-xl text-[9px] font-black uppercase tracking-widest transition-all {{ $estado === 'aprobado' ? 'bg-emerald-600 text-white shadow-md' : 'text-gray-400 hover:text-gray-900' }}"> CUMPLE </button>
                                                <button wire:click="cambiarEstadoDocumento({{ $docActual->id }}, 'rechazado')" class="px-6 py-3.5 rounded-xl text-[9px] font-black uppercase tracking-widest transition-all {{ $estado === 'rechazado' ? 'bg-rose-600 text-white shadow-md' : 'text-gray-400 hover:text-gray-900' }}"> NO VÁLIDO </button>
                                            </div>
                                        </div>
                                        @if($estado === 'rechazado')
                                            <div class="mt-4 pt-4 border-t border-gray-100">
                                                <textarea wire:model.defer="observacionesDocs.{{ $docActual->id }}" class="w-full rounded-xl p-4 text-xs font-bold text-gray-700 border-2 border-gray-50 bg-gray-50 focus:border-purple-500" placeholder="Explique por qué no es válido..."></textarea>
                                                <div class="flex justify-end mt-2">
                                                    <button wire:click="guardarAvanceDocumento({{ $docActual->id }})" class="px-4 py-2 bg-gray-900 text-white text-[8px] font-black uppercase rounded-lg">Guardar Motivo</button>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 4. DICTAMEN FINAL --}}
        <div class="bg-gray-900 rounded-[2.5rem] p-10 shadow-3xl relative overflow-hidden">
            <div class="absolute top-0 right-0 -mt-20 -mr-20 w-80 h-80 bg-indigo-500/10 rounded-full blur-3xl"></div>
            <div class="relative z-10 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="space-y-6 text-left">
                    <h2 class="text-3xl md:text-4xl font-black text-white tracking-tighter mb-4 uppercase leading-none">Dictamen de <br><span class="text-indigo-500">Auditoría Final</span></h2>
                    <div class="p-4 bg-white/5 border border-white/10 rounded-2xl w-fit">
                        <span class="text-[8px] font-black text-indigo-400 uppercase tracking-[2px] mb-2 block text-left">Auditado por</span>
                        <div class="flex items-center gap-3">
                            <div class="h-10 w-10 rounded-full border-2 border-indigo-500/30 bg-gray-800 flex items-center justify-center text-[11px] font-black text-white uppercase">{{ collect(explode(' ', auth()->user()->name))->map(fn($n) => mb_substr($n, 0, 1))->take(2)->implode('') }}</div>
                            <span class="text-[10px] font-black text-gray-200 uppercase tracking-widest leading-none">{{ auth()->user()->name }}</span>
                        </div>
                    </div>
                </div>
                <div class="space-y-5">
                    <textarea wire:model.lazy="comentarioCierre" class="w-full bg-white/5 border-2 border-white/10 rounded-[2rem] p-6 text-white font-bold text-sm min-h-[160px] focus:border-indigo-500 outline-none transition-all shadow-inner" placeholder="Escriba aquí sus conclusiones finales..."></textarea>
                    @error('comentarioCierre') <p class="text-red-500 text-[10px] font-black uppercase tracking-widest px-4">{{ $message }}</p> @enderror
                    <button wire:click="finalizarRevision" wire:loading.attr="disabled" class="w-full py-6 bg-indigo-600 hover:bg-indigo-500 text-white rounded-[1.5rem] font-black text-xs uppercase tracking-[4px] shadow-2xl transition-all active:scale-95 flex items-center justify-center gap-3">
                        <span wire:loading.remove>FIRMAR Y EMITIR VEREDICTO</span>
                        <span wire:loading>PROCESANDO...</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>