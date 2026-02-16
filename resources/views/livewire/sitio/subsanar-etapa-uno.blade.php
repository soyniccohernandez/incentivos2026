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
                @foreach($proyecto->documentos as $doc)
                    @php $esSubsanable = $doc->estado === 'subsanar'; @endphp
                    
                    <div class="bg-brand-surface border {{ $esSubsanable ? 'border-brand-orange/40 shadow-[0_15px_40px_rgba(255,77,0,0.05)]' : 'border-brand-border opacity-50' }} p-8 md:p-10 relative group transition-all duration-500">
                        
                        <div class="flex justify-between items-start mb-6">
                            <div class="text-left">
                                <h3 class="font-bebas text-3xl tracking-wider text-white uppercase mb-2">
                                    {{ $doc->tipoDocumento->nombre }}
                                </h3>
                                <div class="inline-flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full {{ $esSubsanable ? 'bg-brand-orange animate-pulse' : 'bg-green-500' }}"></span>
                                    <span class="text-[10px] font-black uppercase tracking-widest {{ $esSubsanable ? 'text-brand-orange' : 'text-green-500' }}">
                                        {{ $esSubsanable ? 'Pendiente por corregir' : 'Aprobado / Validado' }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        {{-- OBSERVACIONES (ESTILO TÉCNICO) --}}
                        @if($esSubsanable && isset($observaciones[$doc->id]))
                            <div class="bg-black/50 border border-brand-border/50 p-6 mb-8 text-left">
                                <span class="text-[9px] font-black uppercase text-brand-orange tracking-[3px] block mb-3 opacity-80">Observación de la Revisión:</span>
                                <p class="text-gray-300 text-sm italic leading-relaxed font-medium">
                                    "{{ $observaciones[$doc->id] }}"
                                </p>
                            </div>
                        @endif

                        {{-- ACCIONES DE CARGA --}}
                        <div class="mt-auto">
                            @if($esSubsanable)
                                <div x-data="{ isUploading: false, progress: 0 }" 
                                     x-on:livewire-upload-start="isUploading = true" 
                                     x-on:livewire-upload-finish="isUploading = false"
                                     x-on:livewire-upload-progress="progress = $event.detail.progress">
                                    
                                    <div class="space-y-4">
                                        <div class="relative group/input">
                                            <input type="file" wire:model.live="archivosNuevos.{{ $doc->id }}" accept=".pdf" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                            <div class="bg-black border border-brand-border px-4 py-4 text-[10px] text-gray-400 font-black uppercase tracking-widest flex items-center justify-between group-hover/input:bg-gray-900 transition-colors">
                                                <span>{{ isset($archivosNuevos[$doc->id]) ? '✓ Documento Seleccionado' : 'Seleccionar Nuevo PDF' }}</span>
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                            </div>
                                        </div>

                                        <div x-show="isUploading" class="w-full bg-gray-800 h-1.5 rounded-full overflow-hidden">
                                            <div class="bg-brand-orange h-full transition-all duration-300" :style="'width: ' + progress + '%'"></div>
                                        </div>

                                        @if(isset($archivosNuevos[$doc->id]))
                                            <button wire:click="guardarSubsanacion({{ $doc->id }})" class="w-full bg-brand-orange text-black font-bebas text-2xl py-3 hover:bg-white transition-all shadow-lg active:scale-95">
                                                ACTUALIZAR DOCUMENTO
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            @else
                                <div class="flex items-center justify-between border-t border-white/5 pt-6 mt-4">
                                    <div class="flex items-center gap-3 px-4 py-1.5 bg-green-500/10 border border-green-500/20 rounded-full">
                                        <span class="text-green-500 text-[9px] font-black uppercase tracking-widest">Listo para Inscripción</span>
                                    </div>
                                    <a href="{{ asset('storage/'.$doc->ruta_archivo) }}" target="_blank" class="text-[10px] text-gray-500 font-bold uppercase tracking-widest hover:text-white transition-colors no-underline">
                                        Ver Anterior
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