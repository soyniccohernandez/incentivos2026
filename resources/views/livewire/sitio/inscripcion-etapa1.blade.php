<div class="min-h-screen bg-black text-left" x-data="{ showExitModal: false }" wire:poll.10s>
    {{-- NAV --}}
    <nav class="fixed top-0 left-0 w-full z-[1000] flex justify-between items-center px-6 py-5 md:px-12 bg-black/95 border-b border-brand-border backdrop-blur-sm">
        <div class="flex items-center gap-8">
            <a href="/" class="font-bebas text-3xl text-brand-orange tracking-[2px] no-underline">
                ACTORES S.C.G.
            </a>
            <span class="font-bebas text-xl text-gray-500 hidden md:block uppercase tracking-widest border-l border-brand-border pl-8">
                Etapa 01: Inscripción Inicial
            </span>
        </div>
        <button @click="showExitModal = true" class="group flex items-center gap-3 text-gray-500 hover:text-white transition-colors focus:outline-none">
            <span class="font-bold text-[10px] uppercase tracking-[3px]">Abandonar Registro</span>
            
            <div class="p-2 border border-brand-border group-hover:border-red-500 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
            </div>
        </button>
    </nav>

    <main class="bg-black min-h-screen pt-32 pb-24 px-6 text-left">
        <div class="max-w-[1100px] mx-auto text-left">
            {{-- HEADER --}}
            <header class="mb-12 border-l-4 border-brand-orange pl-6 text-left">
                <div class="text-brand-orange font-bold text-sm uppercase tracking-[3px] mb-2">
                    Convocatoria 2026
                </div>
                <h1 class="font-bebas text-[clamp(2.5rem,6vw,4.5rem)] leading-none mb-4 text-white uppercase">
                    INSCRIPCIÓN <span class="text-brand-orange">INCENTIVOS AUDIOVISUALES</span>
                </h1>
            </header>

            <form wire:submit.prevent="guardar" class="space-y-12">
                {{-- 1. DATOS DEL PROPONENTE --}}
                <section class="bg-brand-surface border border-brand-border p-8 md:p-12 relative overflow-hidden group">
                    <div class="flex items-center gap-6 mb-12">
                        <h2 class="font-bebas text-4xl text-brand-orange tracking-widest uppercase whitespace-nowrap">1. DATOS DEL PROPONENTE</h2>
                        <div class="h-[1px] w-full bg-gradient-to-r from-brand-border to-transparent"></div>
                    </div>

                    <div class="flex flex-col md:flex-row gap-12 items-center md:items-start">
                        <div class="shrink-0">
                            <div class="w-32 h-32 rounded-full border-2 border-brand-orange shadow-[0_0_25px_rgba(255,77,0,0.2)] flex items-center justify-center overflow-hidden bg-black transition-all duration-500 group-hover:scale-105 mx-auto">
                                @if(isset($socio->foto_url) && $socio->foto_url)
                                <img src="{{ $socio->foto_url }}" class="w-full h-full object-cover">
                                @else
                                <span class="font-bebas text-6xl text-brand-orange">{{ $iniciales ?? 'SC' }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="flex-grow w-full text-left">
                            <div class="grid grid-cols-1 gap-10">
                                <div class="grid grid-cols-1 lg:grid-cols-[1fr_auto] gap-8 items-end border-b border-white/5 pb-6">
                                    <div>
                                        <label class="block text-[10px] uppercase font-black text-gray-500 mb-2 tracking-[5px]">Nombre del Titular</label>
                                        <p class="text-white font-bebas text-5xl md:text-6xl tracking-wide uppercase leading-none">{{ mb_strtoupper($socio->nombre ?? $nombre) }}</p>
                                    </div>
                                    <div class="lg:text-right">
                                        <label class="block text-[10px] uppercase font-black text-gray-500 mb-2 tracking-[5px]">Identificación</label>
                                        <p class="text-white font-mono text-3xl tracking-tighter">{{ $socio->identificacion ?? $identificacion }}</p>
                                    </div>
                                </div>
                                <div class="relative pt-2 text-left">
                                    <label class="block text-[10px] uppercase font-black text-brand-orange mb-5 tracking-[6px]">Correo Electrónico de Notificación</label>
                                    <div class="bg-black border border-brand-orange px-8 py-5 inline-flex items-center gap-6">
                                        <p class="text-white font-bebas text-3xl md:text-5xl tracking-[3px] lowercase leading-none">{{ $socio->correo ?? $correo }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- 1. DETALLES DE LA PROPUESTA --}}
                <section class="bg-brand-surface border border-brand-border p-8 md:p-10 space-y-10 text-left">
                    <h2 class="font-bebas text-3xl text-brand-orange border-b border-brand-border pb-4 uppercase tracking-wider text-left">1. DETALLES DE LA PROPUESTA</h2>
                    <div class="space-y-8">
                        <div class="text-left">
                            <label class="block text-[10px] uppercase font-bold mb-3 tracking-widest text-brand-orange text-left">Título de la propuesta</label>
                            <input type="text" wire:model.live="titulo" class="w-full bg-black border border-brand-border px-6 py-5 text-white focus:border-brand-orange outline-none uppercase font-bold text-lg tracking-widest transition-all shadow-inner">
                            @error('titulo') <span class="text-red-500 text-[10px] mt-2 block uppercase font-bold text-left">{{ $message }}</span> @enderror
                        </div>


                    </div>
                </section>

                {{-- 2. PERFIL DEL DIRECTOR --}}
                <section class="bg-brand-surface border border-brand-border p-8 md:p-10 space-y-10 text-left">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-end border-b border-brand-border pb-6 mb-10 gap-6">
                        <h2 class="font-bebas text-3xl text-brand-orange tracking-wider uppercase text-left">2. PERFIL DEL DIRECTOR</h2>
                        <div class="flex items-center gap-4 bg-black/50 px-6 py-3 border border-brand-border">
                            <span class="text-[10px] uppercase font-bold text-gray-500 tracking-widest">¿Tú eres el director?</span>
                            <div class="flex gap-4">
                                <label class="flex items-center gap-2 cursor-pointer"><input type="radio" value="si" wire:model.live="directorPropio" class="w-4 h-4 accent-brand-orange"><span class="text-xs font-bold text-white">SÍ</span></label>
                                <label class="flex items-center gap-2 cursor-pointer"><input type="radio" value="no" wire:model.live="directorPropio" class="w-4 h-4 accent-brand-orange"><span class="text-xs font-bold text-white">NO</span></label>
                            </div>
                        </div>
                    </div>

                    <div x-show="$wire.directorPropio === 'no'" x-transition x-cloak class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-black/40 p-8 border border-dashed border-brand-border mb-10 text-left">
                        @foreach(['directorIdentificacion' => 'Identificación', 'directorNombre' => 'Nombre Completo', 'directorCelular' => 'Celular', 'directorCorreo' => 'Correo Electrónico'] as $model => $label)
                        <div class="text-left">
                            <label class="block text-[10px] uppercase font-bold text-gray-500 mb-2 tracking-widest text-left">{{ $label }}</label>
                            <input type="text" wire:model.live="{{ $model }}" class="w-full bg-black border border-brand-border px-4 py-3 text-white focus:border-brand-orange outline-none uppercase text-sm font-bold">
                            @error($model) <span class="text-red-500 text-[10px] mt-1 block uppercase font-bold text-left">{{ $message }}</span> @enderror
                        </div>
                        @endforeach
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-left">
                        @php
                        $docsDirector = [
                        ['model' => 'docDirectorCompromiso', 'label' => 'ANEXO 1. MANIFESTACIÓN DEL DIRECTOR', 'desc' => 'Aceptación del cargo.', 'formato' => 'formato_compromiso_director.pdf'],
                        ['model' => 'docDirectorExperiencia', 'label' => 'ANEXO 2. EXPERIENCIA COMO DIRECTOR GENERAL', 'desc' => 'Filmografía y experiencia.', 'formato' => 'formato_experiencia_director.pdf'],
                        ['model' => 'docDirectorEvidencia1', 'label' => 'Evidencia de Soporte 1', 'desc' => 'Certificado o contrato.', 'formato' => 'formato_evidencias_director.pdf'],
                        ['model' => 'docDirectorEvidencia2', 'label' => 'Evidencia de Soporte 2', 'desc' => 'Certificado o contrato.', 'formato' => 'formato_evidencias_director.pdf'],
                        ];
                        @endphp
                        @foreach($docsDirector as $doc)
                        <div class="p-8 border border-brand-border bg-black/40 text-left flex flex-col h-full" x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">
                            <div class="flex-1 text-left">
                                <label class="block text-xs uppercase font-black text-white tracking-[2px] mb-1 text-left">{{ $doc['label'] }}</label>
                                <p class="text-[10px] text-gray-500 font-bold uppercase tracking-wider mb-6 opacity-70 text-left">{{ $doc['desc'] }}</p>
                            </div>
                            <div class="space-y-4 text-left">
                                <a href="{{ asset('storage/formatos/'.$doc['formato']) }}" target="_blank" class="block text-center py-2.5 bg-brand-orange text-black font-bold text-[10px] uppercase tracking-widest hover:bg-white transition-all shadow-lg">Descargar Formato</a>
                                <div class="relative group/input">
                                    @if(!$this->{$doc['model']} || $errors->has($doc['model']))
                                    <input type="file" wire:model="{{ $doc['model'] }}" accept=".pdf" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20">
                                    <div class="bg-black/60 border border-white/10 px-4 py-3 text-[10px] text-gray-400 font-black uppercase tracking-widest flex items-center justify-between group-hover/input:border-brand-orange/40 group-hover/input:text-white transition-all duration-300">
                                        <span>Seleccionar PDF</span>
                                        <svg class="w-4 h-4 transition-transform group-hover/input:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                        </svg>
                                    </div>
                                    @else
                                    <div class="bg-green-500/5 border border-green-500/30 px-4 py-3 flex items-center justify-between">
                                        <div class="flex flex-col gap-1 overflow-hidden">
                                            <div class="flex items-center gap-2">
                                                <svg class="w-3 h-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" wire:loading.remove wire:target="{{ $doc['model'] }}">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                                </svg>
                                                <span class="text-green-500 text-[8px] font-black uppercase tracking-widest">Documento Listo</span>
                                            </div>
                                            <span class="text-[9px] text-gray-400 font-medium truncate">{{ $this->{$doc['model']}->getClientOriginalName() }}</span>
                                        </div>
                                        <div class="flex items-center">
                                            <div wire:loading wire:target="{{ $doc['model'] }}" class="mr-2">
                                                <svg class="animate-spin h-3 w-3 text-brand-orange" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                </svg>
                                            </div>
                                            <button type="button" wire:click="$set('{{ $doc['model'] }}', null)" @click="progress = 0; isUploading = false" class="text-gray-600 hover:text-red-500 transition-colors p-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                <div x-show="isUploading" class="w-full bg-gray-800 h-1.5 overflow-hidden rounded-full">
                                    <div class="bg-brand-orange h-full transition-all" :style="'width: ' + progress + '%'"></div>
                                </div>
                                @error($doc['model']) <span class="text-red-500 text-[10px] block uppercase font-bold text-left">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        @endforeach
                    </div>
                </section>

                <section class="bg-brand-surface border border-brand-border p-8 md:p-10 space-y-10 text-left">
                    <h2 class="font-bebas text-3xl text-brand-orange border-b border-brand-border pb-4 uppercase tracking-wider text-left">3. guion </h2>
                    <div class="space-y-8">


                        <div class="bg-black/40 p-8 border border-brand-border text-left" x-data="{ isUploading: false, progress: 0 }">
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-[2px] mb-6 text-left">¿El guion es de tu autoría?</label>
                            <div class="flex gap-10 mb-8">
                                <label class="flex items-center gap-3 cursor-pointer group">
                                    <input type="radio" value="si" wire:model.live="autoria" class="w-5 h-5 accent-brand-orange">
                                    <span class="text-white font-bold uppercase text-sm group-hover:text-brand-orange transition-colors">SÍ</span>
                                </label>
                                <label class="flex items-center gap-3 cursor-pointer group">
                                    <input type="radio" value="no" wire:model.live="autoria" class="w-5 h-5 accent-brand-orange">
                                    <span class="text-white font-bold uppercase text-sm group-hover:text-brand-orange transition-colors">NO</span>
                                </label>
                            </div>

                            <div x-show="$wire.autoria === 'no'" x-transition x-cloak class="pt-8 border-t border-white/5" x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">
                                <div class="flex flex-col md:flex-row gap-8 items-end">
                                    <a href="{{ asset('storage/formatos/etapa_01_autorizacion_uso_guion_cia_2026.pdf') }}" target="_blank" class="bg-brand-orange text-black px-6 py-3 font-bold text-[10px] uppercase tracking-widest no-underline shrink-0 hover:bg-white transition-all shadow-lg">Descargar Formato Guion</a>
                                    <div class="flex-1 w-full text-left">
                                        <label class="block text-[10px] uppercase font-bold text-gray-500 mb-2 tracking-widest text-left">ANEXO 3. AUTORIZACIÓN USO DE GUION</label>
                                        <div class="relative group/input">
                                            @if(!$guionArchivo || $errors->has('guionArchivo'))
                                            <input type="file" wire:model="guionArchivo" accept=".pdf" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20">
                                            <div class="bg-black border border-brand-border px-4 py-3 text-[10px] text-gray-400 font-black uppercase tracking-widest flex items-center justify-between group-hover/input:border-brand-orange/50 group-hover/input:text-white transition-all duration-300">
                                                <span>Seleccionar archivo</span>
                                                <svg class="w-4 h-4 transition-transform group-hover/input:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                                </svg>
                                            </div>
                                            @else
                                            <div class="bg-black border border-green-500/50 px-4 py-3 flex items-center justify-between">
                                                <div class="flex flex-col gap-1 overflow-hidden">
                                                    <div class="flex items-center gap-2">
                                                        <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse" wire:loading.remove wire:target="guionArchivo"></span>
                                                        <span class="text-green-500 text-[9px] font-black uppercase tracking-widest">Cargado con éxito</span>
                                                    </div>
                                                    <span class="text-[10px] text-white font-medium truncate opacity-80">{{ $guionArchivo->getClientOriginalName() }}</span>
                                                </div>
                                                <div class="flex items-center">
                                                    <div wire:loading wire:target="guionArchivo" class="mr-3">
                                                        <svg class="animate-spin h-4 w-4 text-brand-orange" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                        </svg>
                                                    </div>
                                                    <button type="button" wire:click="$set('guionArchivo', null)" @click="progress = 0; isUploading = false" class="text-gray-500 hover:text-red-500 transition-colors p-2">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                        <div x-show="isUploading" class="mt-2 w-full bg-gray-800 h-1.5 rounded-full overflow-hidden">
                                            <div class="bg-brand-orange h-full transition-all" :style="'width: ' + progress + '%'"></div>
                                        </div>
                                        @error('guionArchivo') <span class="text-red-500 text-[10px] mt-2 block uppercase font-bold">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- 4. CONSIDERACIONES FINALES --}}
                <section class="bg-brand-surface border border-brand-border p-8 md:p-10 space-y-8 text-left">
                    <h2 class="font-bebas text-3xl text-brand-orange border-b border-brand-border pb-4 uppercase tracking-wider text-left">4. CONSIDERACIONES Y DECLARACIONES GENERALES</h2>
                    <div class="bg-black/40 p-8 border border-brand-border text-left" x-data="{ isUploading: false, progress: 0 }">
                        <div class="flex flex-col md:flex-row gap-8 items-end mb-12 border-b border-white/5 pb-10 text-left" x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">
                            <a href="{{ asset('storage/formatos/formato_declaraciones_2026.pdf') }}" target="_blank" class="bg-brand-orange text-black px-8 py-4 font-bold text-[11px] uppercase tracking-widest no-underline shrink-0 hover:bg-white transition-all shadow-lg">Descargar Declaraciones</a>
                            <div class="flex-1 w-full text-left">
                                <label class="block text-[10px] uppercase font-bold text-gray-500 mb-2 tracking-widest text-left">ANEXO 4. CONSIDERACIONES Y DECLARACIONES GENERALES</label>
                                <div class="relative group/input">
                                    @if(!$formatoFirmado || $errors->has('formatoFirmado'))
                                    <input type="file" wire:model="formatoFirmado" accept=".pdf" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20">
                                    <div class="bg-black border border-brand-border px-4 py-3 text-[10px] text-gray-400 font-black uppercase tracking-widest flex items-center justify-between group-hover/input:border-brand-orange/50 group-hover/input:text-white transition-all duration-300">
                                        <span>Seleccionar archivo</span>
                                        <svg class="w-4 h-4 transition-transform group-hover/input:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                        </svg>
                                    </div>
                                    @else
                                    <div class="bg-black border border-green-500/50 px-4 py-3 flex items-center justify-between">
                                        <div class="flex flex-col gap-1 overflow-hidden">
                                            <div class="flex items-center gap-2">
                                                <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse" wire:loading.remove wire:target="formatoFirmado"></span>
                                                <span class="text-green-500 text-[9px] font-black uppercase tracking-widest">Declaración Recibida</span>
                                            </div>
                                            <span class="text-[10px] text-white font-medium truncate opacity-80">{{ $formatoFirmado->getClientOriginalName() }}</span>
                                        </div>
                                        <div class="flex items-center">
                                            <div wire:loading wire:target="formatoFirmado" class="mr-3">
                                                <svg class="animate-spin h-4 w-4 text-brand-orange" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                </svg>
                                            </div>
                                            <button type="button" wire:click="$set('formatoFirmado', null)" @click="progress = 0; isUploading = false" class="text-gray-500 hover:text-red-500 transition-colors p-2">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                <div x-show="isUploading" class="mt-2 w-full bg-gray-800 h-1.5 rounded-full overflow-hidden">
                                    <div class="bg-brand-orange h-full transition-all" :style="'width: ' + progress + '%'"></div>
                                </div>
                                @error('formatoFirmado') <span class="text-red-500 text-[10px] mt-2 block uppercase font-bold">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="space-y-8 text-left">
                            <label class="flex items-start gap-5 cursor-pointer group text-left">
                                <input type="checkbox" wire:model.live="aceptaTerminos" class="mt-1 w-6 h-6 accent-brand-orange shrink-0">
                                <span class="text-sm text-gray-300 group-hover:text-white transition-colors leading-relaxed">Acepto, de manera voluntaria, previa, explícita e informada los términos y
                                    condiciones establecidos en la presente convocatoria.</span>
                            </label>
                            @error('aceptaTerminos') <span class="text-red-500 text-[10px] block uppercase font-bold tracking-widest">{{ $message }}</span> @enderror

                            <label class="flex items-start gap-5 cursor-pointer group text-left">
                                <input type="checkbox" wire:model.live="aceptaDatos" class="mt-1 w-6 h-6 accent-brand-orange shrink-0">
                                <span class="text-sm text-gray-300 group-hover:text-white transition-colors leading-relaxed">Acepto y autorizo de manera voluntaria, previa, explícita e informada a ACTORES S.C.G. para el tratamiento de mis datos personales conforme a su Política de Tratamiento de Datos Personales y a lo establecido en la presente convocatoria. Declaro que la información suministrada es veraz y autorizo, en caso de resultar seleccionada la propuesta, la verificación de la información aportada y la consulta de antecedentes judiciales, disciplinarios o fiscales. Si se evidencian incumplimientos de las condiciones de participación, acepto la exclusión de la propuesta y la selección de la siguiente siempre y cuando cumpla con los requisitos establecidos.</span>
                            </label>
                            @error('aceptaDatos') <span class="text-red-500 text-[10px] block uppercase font-bold tracking-widest">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </section>

                {{-- BOTÓN FINAL OPTIMIZADO --}}
                <div class="text-center pt-10 pb-20 flex flex-col items-center">
                    <div class="max-w-[450px] w-full group relative">
                        <button type="submit" wire:loading.attr="disabled" class="w-full inline-flex items-center justify-center bg-brand-orange text-white font-bebas text-4xl hover:bg-white hover:text-black transition-all active:scale-95 py-6 shadow-[0_0_40px_rgba(255,102,0,0.2)] disabled:opacity-50 disabled:cursor-not-allowed disabled:bg-gray-800 disabled:text-gray-500 disabled:shadow-none">
                            <div class="flex items-center justify-center gap-4">
                                <svg wire:loading wire:target="guardar" class="animate-spin h-8 w-8 text-current" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <span wire:loading.remove>FINALIZAR E INSCRIBIR</span>
                                <span wire:loading wire:target="guardar" class="tracking-widest uppercase">Enviando registro...</span>
                                <span wire:loading wire:target="guionArchivo, docDirectorExperiencia, docDirectorCompromiso, docDirectorEvidencia1, docDirectorEvidencia2, formatoFirmado" class="text-xl tracking-widest uppercase"> Subiendo archivos... </span>
                            </div>
                        </button>
                        <p wire:loading class="text-brand-orange text-[10px] font-bold uppercase tracking-[3px] mt-4 animate-pulse"> Espera un momento, estamos procesando la información... </p>
                    </div>
                </div>
            </form>
        </div>
    </main>

    {{-- MODAL DE SALIDA --}}
    <div x-show="showExitModal" x-cloak class="fixed inset-0 z-[2000] flex items-center justify-center p-6 bg-black/90 backdrop-blur-md" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">
        <div class="bg-brand-surface border border-brand-border max-w-md w-full p-10 text-center shadow-[0_0_50px_rgba(0,0,0,0.5)] relative overflow-hidden" @click.away="showExitModal = false">
            <div class="mb-8">
                <div class="w-20 h-20 border-2 border-brand-orange rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-brand-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <h3 class="font-bebas text-4xl text-white mb-4 tracking-wider uppercase">¿Abandonar Registro?</h3>
                <p class="text-gray-400 text-sm leading-relaxed uppercase font-bold text-[11px] tracking-[2px]"> Si sales ahora, los datos y documentos <span class="text-brand-orange">no se guardarán</span>. </p>
            </div>
            <div class="flex flex-col gap-4">
                <a href="/" class="w-full py-4 bg-red-600 text-white font-bebas text-2xl tracking-widest hover:bg-white hover:text-black transition-all no-underline inline-block"> SÍ, SALIR </a>
                <button @click="showExitModal = false" class="w-full py-4 bg-transparent border border-brand-border text-gray-500 font-bebas text-2xl tracking-widest hover:border-white hover:text-white transition-all uppercase"> Seguir Editando </button>
            </div>
        </div>
    </div>
</div>