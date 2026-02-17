<div class="min-h-screen bg-black text-left antialiased" x-data="{ showExitModal: false }">
    {{-- NAV: CLON EXACTO DE ETAPA 2 --}}
    <nav class="fixed top-0 left-0 w-full z-[1000] flex justify-between items-center px-6 py-5 md:px-12 bg-black/95 border-b border-brand-border backdrop-blur-sm">
        <div class="flex items-center gap-8">
            <a href="/" class="font-bebas text-3xl text-brand-orange tracking-[2px] no-underline"> ACTORES S.C.G. </a>
            <span class="font-bebas text-xl text-gray-500 hidden md:block uppercase tracking-widest border-l border-brand-border pl-8">
                Módulo de <span class="text-brand-orange">Subsanación</span>
            </span>
        </div>

        <button @click="showExitModal = true" class="group flex items-center gap-3 text-gray-500 hover:text-white transition-colors focus:outline-none">
            <span class="font-bold text-[10px] uppercase tracking-[3px]">Salir de Subsanación</span>
            <div class="p-2 border border-brand-border group-hover:border-red-500 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
            </div>
        </button>
    </nav>

    <main class="bg-black min-h-screen pt-32 pb-24 px-6 text-left">
        <div class="max-w-[1100px] mx-auto text-left">

            {{-- HEADER: ESTILO ETAPA 2 --}}
            <header class="mb-12 border-l-4 border-brand-orange pl-6 text-left">
                <div class="text-brand-orange font-bold text-sm uppercase tracking-[3px] mb-2"> Acción Requerida: Subsanación de Documentos </div>
                <h1 class="font-bebas text-[clamp(2.5rem,6vw,4.5rem)] leading-none mb-4 text-white uppercase"> {{ $proyecto->titulo }} </h1>
                <div class="inline-flex items-center gap-4 bg-brand-surface border border-brand-border px-4 py-2 mt-2">
                    <span class="text-gray-500 text-[9px] uppercase font-black tracking-widest">Código de Radicado:</span>
                    <span class="text-white font-bold text-sm tracking-widest">{{ $proyecto->codigo_radicado }}</span>
                </div>
            </header>

            {{-- GRID DE DOCUMENTOS --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @php
                // Agrupamos por tipo y tomamos solo el registro más reciente (la última versión)
                $documentosPorTipo = $proyecto->documentos->groupBy('tipo_documento_id');
                @endphp

                @foreach($documentosPorTipo as $tipoId => $versiones)
                @php
                $doc = $versiones->sortByDesc('version')->first(); // La versión más nueva

                $necesitaSubsanar = $doc->estado === 'subsanar';
                $estaEnEspera = $doc->estado === 'pendiente';
                $estaAprobado = $doc->estado === 'aprobado';
                @endphp

                <div class="bg-brand-surface border transition-all duration-500 p-8 md:p-10
            {{ $necesitaSubsanar ? 'border-brand-orange/40' : '' }}
            {{ $estaEnEspera ? 'border-blue-500/30 bg-blue-500/5' : '' }}
            {{ $estaAprobado ? 'border-green-500/20 opacity-60' : '' }}">

                    <div class="flex justify-between items-start mb-6">
                        <div class="text-left">
                            <h3 class="font-bebas text-3xl tracking-wider text-white uppercase mb-2">
                                {{ $doc->tipoDocumento->nombre }}
                            </h3>

                            {{-- INDICADOR DE ESTADO DINÁMICO --}}
                            <div class="inline-flex items-center gap-2">
                                @if($necesitaSubsanar)
                                <span class="w-2 h-2 rounded-full bg-brand-orange animate-pulse"></span>
                                <span class="text-[10px] font-black uppercase tracking-widest text-brand-orange">Requiere Corrección</span>
                                @elseif($estaEnEspera)
                                <span class="w-2 h-2 rounded-full bg-blue-400"></span>
                                <span class="text-[10px] font-black uppercase tracking-widest text-blue-400">Enviado - A espera de revisión</span>
                                @elseif($estaAprobado)
                                <span class="w-2 h-2 rounded-full bg-green-500"></span>
                                <span class="text-[10px] font-black uppercase tracking-widest text-green-500">Documento Validado</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Área de carga: Solo aparece si el estado es 'subsanar' --}}
                    <div class="mt-8">
                        @if($necesitaSubsanar)
                        {{-- Bloque de observación del auditor --}}
                        @if(isset($observaciones[$doc->id]))
                        <div class="bg-black/40 border-l-2 border-brand-orange p-4 mb-6">
                            <p class="text-gray-400 text-xs italic">"{{ $observaciones[$doc->id] }}"</p>
                        </div>
                        @endif

                        <div x-data="{ isUploading: false, progress: 0 }"
                            x-on:livewire-upload-start="isUploading = true"
                            x-on:livewire-upload-finish="isUploading = false">

                            <div class="space-y-4">
                                <div class="relative group">
                                    <input type="file" wire:model.live="archivosNuevos.{{ $doc->id }}" accept=".pdf" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                    <div class="bg-black border border-brand-border px-4 py-4 text-[10px] text-gray-400 font-black uppercase tracking-widest flex items-center justify-between group-hover:bg-gray-900 transition-colors">
                                        <span>{{ isset($archivosNuevos[$doc->id]) ? '✓ Archivo Cargado' : 'Seleccionar Nuevo PDF' }}</span>
                                        <svg class="w-4 h-4 text-brand-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 4v16m8-8H4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                </div>

                                @if(isset($archivosNuevos[$doc->id]))
                                <button wire:click="guardarSubsanacion({{ $doc->id }})" class="w-full bg-brand-orange text-black font-bebas text-2xl py-3 hover:bg-white transition-all shadow-xl">
                                    ENVIAR PARA NUEVA REVISIÓN
                                </button>
                                @endif
                            </div>
                        </div>

                        @elseif($estaEnEspera)
                        {{-- Muestra que ya se envió y oculta el botón de carga --}}
                        <div class="bg-blue-500/10 border border-blue-500/20 p-4 rounded text-center">
                            <p class="text-blue-400 text-[10px] font-black uppercase tracking-widest mb-2">Trámite en curso</p>
                            <a href="{{ asset('storage/'.$doc->ruta_archivo) }}" target="_blank" class="text-white text-[9px] font-bold uppercase underline hover:text-blue-300">
                                Ver documento enviado (Versión {{ $doc->version }})
                            </a>
                        </div>

                        @endif
                    </div>
                </div>
                @endforeach
            </div>

            {{-- BOTÓN FINAL: IGUAL A ETAPA 2 --}}
            <div class="text-center pt-20 pb-20 flex flex-col items-center">
                <button wire:click="finalizar" wire:loading.attr="disabled" class="group relative inline-flex items-center justify-center bg-brand-orange text-white font-bebas text-4xl hover:bg-white hover:text-black transition-all active:scale-95 min-w-[450px] py-6 shadow-[0_0_40px_rgba(255,102,0,0.2)] disabled:opacity-50">
                    <div class="flex items-center justify-center gap-4">
                        <svg wire:loading wire:target="finalizar" class="animate-spin h-8 w-8 text-current" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span wire:loading.remove wire:target="finalizar"> ENVIAR SUBSANACIÓN FINALIZADA </span>
                        <span wire:loading wire:target="finalizar" class="tracking-widest uppercase"> PROCESANDO... </span>
                    </div>
                </button>
                <p class="text-gray-600 text-[10px] uppercase font-bold mt-8 tracking-[4px]">Una vez enviado, el proyecto entrará de nuevo a revisión técnica</p>
            </div>
        </div>
    </main>

    {{-- MODAL DE SALIDA: CLON EXACTO DE ETAPA 2 --}}
    <div x-show="showExitModal" class="fixed inset-0 z-[2000] flex items-center justify-center p-6 bg-black/95 backdrop-blur-md" x-transition x-cloak>
        <div class="bg-brand-surface border border-brand-border max-w-md w-full p-10 text-center shadow-2xl relative" @click.away="showExitModal = false">
            <h3 class="font-bebas text-4xl text-white mb-4 uppercase tracking-wider">¿Finalizar Sesión?</h3>
            <p class="text-gray-400 text-[11px] font-bold uppercase tracking-[2px] mb-8 leading-relaxed">Si no has guardado los cambios en cada documento, se perderán las cargas actuales.</p>
            <div class="flex flex-col gap-4">
                <a href="{{ route('inscritos.publico') }}" class="w-full py-4 bg-red-600 text-white font-bebas text-2xl tracking-widest hover:bg-white hover:text-black transition-all no-underline"> SALIR SIN GUARDAR </a>
                <button @click="showExitModal = false" class="w-full py-4 bg-transparent border border-brand-border text-gray-500 font-bebas text-2xl tracking-widest hover:text-white hover:border-white transition-all uppercase"> Seguir Editando </button>
            </div>
        </div>
    </div>
</div>