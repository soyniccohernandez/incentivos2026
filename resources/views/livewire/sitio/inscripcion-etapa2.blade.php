<div class="min-h-screen bg-black text-left" x-data="{ showExitModal: false }">
    {{-- NAV --}}
    <nav class="fixed top-0 left-0 w-full z-[1000] flex justify-between items-center px-6 py-5 md:px-12 bg-black/95 border-b border-brand-border backdrop-blur-sm">
        <div class="flex items-center gap-8">
            <a href="/" class="font-bebas text-3xl text-brand-orange tracking-[2px] no-underline">
                ACTORES S.C.G.
            </a>
            <span class="font-bebas text-xl text-gray-500 hidden md:block uppercase tracking-widest border-l border-brand-border pl-8">
                Etapa 02: Información Técnica y Elenco
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
                    Proyecto: {{ $proyecto->codigo_radicado }}
                </div>
                <h1 class="font-bebas text-[clamp(2.5rem,6vw,4.5rem)] leading-none mb-4 text-white uppercase">
                    {{ $proyecto->titulo }}
                </h1>
            </header>

            <form wire:submit.prevent="guardar" class="space-y-12">
                {{-- 1. SECCIÓN ELENCO --}}
                <section class="bg-brand-surface border border-brand-border p-8 md:p-10 relative overflow-hidden text-left">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-end border-b border-brand-border pb-6 mb-10 gap-6">
                        <h2 class="font-bebas text-3xl text-brand-orange tracking-wider uppercase">
                            1. ELENCO (MIEMBROS SOCIOS)
                        </h2>
                        <div class="flex gap-4">
                            <button type="button" wire:click="agregarProponenteComoMiembro" class="bg-white text-black px-5 py-2.5 font-bold text-[10px] uppercase tracking-widest hover:bg-brand-orange transition-all active:scale-95 shadow-lg">
                                YO ACTUARÉ
                            </button>
                            <button type="button" wire:click="agregarMiembro" class="bg-brand-orange text-black px-5 py-2.5 font-bold text-[10px] uppercase tracking-widest hover:bg-white transition-all active:scale-95 shadow-lg">
                                + AGREGAR SOCIO
                            </button>
                        </div>
                    </div>



                    <div class="space-y-10 text-left">
                        @foreach($elenco as $index => $miembro)
                        <div class="bg-black/40 border border-brand-border p-8 md:p-10 relative group hover:border-brand-orange/30 transition-all duration-500" wire:key="miembro-etapa2-{{ $index }}">
                            @if(count($elenco) > 1)
                            <button type="button" wire:click="removerMiembro({{ $index }})" class="absolute top-4 right-4 text-gray-600 hover:text-red-500 transition-colors z-30">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                            @endif

                            <div class="grid grid-cols-1 md:grid-cols-[auto_1fr] gap-x-12 items-start">
                                {{-- FOTO --}}
                                <div class="mb-6 md:mb-0">
                                    <div class="w-28 h-28 rounded-full border-2 {{ $miembro['encontrado'] ? 'border-brand-orange shadow-[0_0_20px_rgba(255,77,0,0.2)]' : 'border-gray-800' }} flex items-center justify-center overflow-hidden bg-black transition-all duration-300 mx-auto">
                                        @if($miembro['encontrado'] && $miembro['foto_url'])
                                        <img src="{{ $miembro['foto_url'] }}" class="w-full h-full object-cover">
                                        @elseif($miembro['encontrado'])
                                        <span class="font-bebas text-5xl text-brand-orange">{{ $miembro['iniciales'] }}</span>
                                        @else
                                        <svg class="w-12 h-12 text-gray-800" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                                        </svg>
                                        @endif
                                    </div>
                                </div>

                                {{-- DATOS Y CARGA --}}
                                <div class="space-y-8">
                                    <div class="flex flex-col lg:flex-row gap-8 items-start">
                                        <div class="w-full lg:w-[320px]">
                                            <label class="block text-[10px] uppercase font-bold text-gray-500 mb-2 tracking-widest text-left">Identificación del Socio</label>
                                            <div class="flex shadow-lg">
                                                <input type="text" wire:model.defer="elenco.{{ $index }}.cedula" wire:keydown.enter.prevent="buscarSocio({{ $index }})" class="flex-1 bg-black border border-brand-border px-4 py-4 text-white focus:border-brand-orange outline-none uppercase text-sm font-bold tracking-widest transition-all">
                                                <button type="button" wire:click="buscarSocio({{ $index }})" class="bg-brand-orange text-black px-6 font-bold text-[10px] uppercase tracking-widest hover:bg-white transition-all">
                                                    @if($miembro['buscando'])
                                                    <svg class="animate-spin h-4 w-4" fill="none" viewBox="0 0 24 24">
                                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                    </svg>
                                                    @else BUSCAR @endif
                                                </button>
                                            </div>
                                            @error("elenco.$index.cedula") <span class="text-red-500 text-[10px] mt-1 block uppercase font-bold">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="flex-1 w-full">
                                            <label class="block text-[10px] uppercase font-bold text-brand-orange/70 mb-2 tracking-widest text-left">Información Validada</label>
                                            <div class="border-b border-white/10 min-h-[56px] flex items-center">
                                                @if($miembro['nombre'])
                                                <p class="font-bebas text-3xl tracking-wide uppercase leading-tight {{ !$miembro['encontrado'] ? 'text-red-500 text-xs font-sans font-bold tracking-widest' : 'text-white' }}">
                                                    {{ $miembro['nombre'] }}
                                                </p>
                                                @else
                                                <p class="text-gray-800 italic text-xl font-bebas tracking-widest uppercase">Esperando búsqueda...</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Carga Elenco --}}
                                    <div class="pt-6 border-t border-white/5" x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">
                                        <div class="flex flex-col md:flex-row gap-6 items-end">
                                            <div class="shrink-0">
                                                <a href="{{ asset('storage/formatos/etapa_02_autorizacion_elenco_2026.pdf') }}" target="_blank" class="inline-block bg-brand-orange text-black px-6 py-3 font-bold text-[10px] uppercase tracking-widest no-underline hover:bg-white transition-all active:scale-95 shadow-lg">
                                                    Descargar Formato
                                                </a>
                                            </div>
                                            <div class="flex-1 w-full text-left">
                                                <label class="block text-[10px] uppercase font-bold text-gray-500 mb-2 tracking-widest">Subir Formato Firmado (PDF)</label>
                                                <div class="relative group/input">
                                                    <input type="file" wire:model.live="elenco.{{ $index }}.archivo_autorizacion_path" accept=".pdf" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                                    <div class="bg-black border border-brand-border px-4 py-3 text-[10px] text-gray-400 font-black uppercase tracking-widest flex items-center justify-between group-hover/input:bg-gray-900 transition-colors">
                                                        <span>{{ $miembro['archivo_autorizacion_path'] ? 'Archivo seleccionado' : 'Seleccionar archivo' }}</span>
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div x-show="isUploading" class="mt-2 w-full bg-gray-800 h-1.5 rounded-full overflow-hidden">
                                                    <div class="bg-brand-orange h-full transition-all duration-300" :style="'width: ' + progress + '%'"></div>
                                                </div>
                                                @if($miembro['archivo_autorizacion_path'])
                                                <div class="mt-3 inline-flex items-center gap-2 px-3 py-1 bg-green-500/10 border border-green-500/50 rounded-full">
                                                    <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                                                    <span class="text-green-500 text-[9px] font-black uppercase tracking-widest">Cargado con éxito</span>
                                                </div>
                                                @endif
                                                @error("elenco.$index.archivo_autorizacion_path") <span class="text-red-500 text-[10px] mt-2 block uppercase font-bold text-left">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </section>

                {{-- 2. DOCUMENTACIÓN TÉCNICA --}}
                <section class="bg-brand-surface border border-brand-border p-8 md:p-12 space-y-10 text-left relative overflow-hidden">
                    <div class="absolute top-0 right-0 p-10 opacity-[0.03] pointer-events-none">
                        <svg class="w-40 h-40 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z" />
                        </svg>
                    </div>
                    <div class="border-b border-brand-border pb-6">
                        <h2 class="font-bebas text-4xl text-brand-orange tracking-[2px] uppercase mb-2">
                            2. EXPEDIENTE TÉCNICO
                        </h2>
                        <p class="text-[10px] text-gray-500 uppercase font-bold tracking-[3px]">
                            Los archivos deben ser originales y estar en formato PDF
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-10 mt-6">
                        @foreach([
                        ['model' => 'guionFinal', 'label' => 'Guion Versión Final', 'icon' => 'M19 2H5c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V6h10v2z', 'desc' => 'Incluir diálogos y encabezados estandarizados.'],
                        ['model' => 'radicadoGuion', 'label' => 'Radicado Guion DNDA', 'icon' => 'M11.67 3.87L9.9 2.1 0 12l9.9 9.9 1.77-1.77L3.54 12zM12.33 20.13l1.77 1.77L24 12 14.1 2.1l-1.77 1.77L20.46 12z', 'desc' => 'Certificado ante la Dirección de Derecho de Autor.'],
                        ['model' => 'propuestaCreativa', 'label' => 'Propuesta Creativa', 'icon' => 'M12 3v10.55c-.59-.34-1.27-.55-2-.55-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z', 'desc' => 'Moodboard, estética visual y de dirección.']
                        ] as $doc)
                        <div class="relative p-8 border border-brand-border bg-black/40 group hover:border-brand-orange/40 transition-all duration-500 text-left flex flex-col h-full"
                            x-data="{ isUploading: false, progress: 0 }"
                            x-on:livewire-upload-start="isUploading = true"
                            x-on:livewire-upload-finish="isUploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress">

                            <div class="flex items-start justify-between mb-6">
                                <div class="p-3 bg-brand-orange/10 border border-brand-orange/20 text-brand-orange group-hover:bg-brand-orange group-hover:text-black transition-all duration-500">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="{{ $doc['icon'] }}" />
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1">
                                <label class="block text-xs uppercase font-black text-white tracking-[2px] mb-2">{{ $doc['label'] }}</label>
                                <p class="text-[10px] text-gray-500 font-bold uppercase leading-relaxed tracking-wider mb-6 opacity-70">{{ $doc['desc'] }}</p>
                            </div>

                            <div class="mt-auto space-y-4">
                                <div class="relative group/input">
                                    <input type="file" wire:model.live="{{ $doc['model'] }}" accept=".pdf" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                    <div class="bg-gray-900 border border-white/10 px-4 py-3 text-[10px] text-gray-400 font-black uppercase tracking-widest flex items-center justify-between group-hover/input:bg-gray-800 transition-colors">
                                        <span>{{ $this->{$doc['model']} ? 'Cambiar PDF' : 'Seleccionar PDF' }}</span>
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                        </svg>
                                    </div>
                                </div>
                                <div x-show="isUploading" class="w-full bg-gray-800 h-1 rounded-full overflow-hidden">
                                    <div class="bg-brand-orange h-full transition-all duration-300" :style="'width: ' + progress + '%'"></div>
                                </div>
                                @if($this->{$doc['model']})
                                <div class="flex items-center gap-2 px-3 py-1 bg-green-500/10 border border-green-500/50 rounded-full w-max">
                                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse"></span>
                                    <span class="text-green-500 text-[8px] font-black uppercase tracking-widest">Cargado con éxito</span>
                                </div>
                                @endif
                                @error($doc['model']) <span class="text-red-500 text-[10px] block uppercase font-bold text-left tracking-tighter">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        @endforeach
                    </div>
                </section>

                {{-- 3. FINANCIERO --}}
                <section class="bg-brand-surface border border-brand-border p-8 md:p-10 space-y-8 text-left">
                    <h2 class="font-bebas text-3xl text-brand-orange border-b border-brand-border pb-4 uppercase tracking-wider text-left">
                        3. FINANCIERO Y TIEMPOS
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-left">
                        @foreach([
                        ['model' => 'presupuesto', 'label' => 'Presupuesto Detallado (XLSX)', 'file' => 'formato_presupuesto_2026.xlsx'],
                        ['model' => 'cronograma', 'label' => 'Cronograma de Producción (XLSX)', 'file' => 'formato_cronograma_2026.xlsx']
                        ] as $excel)
                        <div class="p-8 border border-brand-border bg-black/40 group hover:border-brand-orange/30 transition-all duration-500 text-left"
                            x-data="{ isUploading: false, progress: 0 }"
                            x-on:livewire-upload-start="isUploading = true"
                            x-on:livewire-upload-finish="isUploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress">

                            <label class="block text-xs uppercase font-black text-white tracking-[2px] mb-6">{{ $excel['label'] }}</label>

                            <div class="flex flex-col gap-5 text-left">
                                <a href="{{ asset('storage/formatos/'.$excel['file']) }}" target="_blank" class="block text-center py-3 bg-brand-orange text-black font-bold text-[10px] uppercase tracking-widest hover:bg-white transition-all active:scale-95 shadow-lg no-underline">
                                    Descargar Formato
                                </a>

                                <div class="relative group/input">
                                    <input type="file" wire:model.live="{{ $excel['model'] }}" accept=".xlsx,.xls" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                    <div class="bg-black/60 border border-white/10 px-4 py-3 text-[10px] text-gray-400 font-black uppercase tracking-widest flex items-center justify-between group-hover/input:bg-gray-800 transition-colors">
                                        <span>{{ $this->{$excel['model']} ? 'Archivo cargado' : 'Seleccionar Excel' }}</span>
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                        </svg>
                                    </div>
                                </div>
                                <div x-show="isUploading" class="w-full bg-gray-800 h-1 rounded-full overflow-hidden">
                                    <div class="bg-brand-orange h-full transition-all duration-300" :style="'width: ' + progress + '%'"></div>
                                </div>
                                @if($this->{$excel['model']})
                                <div class="flex items-center gap-2 px-3 py-1 bg-green-500/10 border border-green-500/50 rounded-full w-max">
                                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse"></span>
                                    <span class="text-green-500 text-[8px] font-black uppercase tracking-widest">Documento listo</span>
                                </div>
                                @endif
                                @error($excel['model']) <span class="text-red-500 text-[10px] block uppercase font-bold text-left">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        @endforeach
                    </div>
                </section>

                {{-- FINALIZAR --}}

                {{-- Alerta de Errores Críticos --}}
                @if (session()->has('error'))
                <div class="bg-red-600 text-white p-4 mb-6 font-bold uppercase text-xs tracking-widest border-l-4 border-white">
                    {{ session('error') }}
                </div>
                @endif

                @if ($errors->any())
                <div class="bg-red-900/50 border border-red-500 p-6 mb-8 text-white">
                    <h4 class="font-bebas text-2xl mb-4 text-red-500">Errores de validación:</h4>
                    <ul class="space-y-2">
                        @foreach ($errors->all() as $error)
                        <li class="text-[10px] uppercase font-black tracking-tighter">• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="text-center pt-10 pb-20 flex flex-col items-center">
                    <button type="submit" wire:loading.attr="disabled" class="group relative inline-flex items-center justify-center bg-brand-orange text-white font-bebas text-4xl hover:bg-white hover:text-black transition-all active:scale-95 min-w-[450px] py-6 shadow-[0_0_40px_rgba(255,102,0,0.2)] disabled:opacity-50">
                        <div class="flex items-center justify-center gap-4">
                            <svg wire:loading wire:target="guardar" class="animate-spin h-8 w-8 text-current" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span wire:loading.remove wire:target="guardar">
                                FINALIZAR E INSCRIBIR PROYECTO
                            </span>
                            <span wire:loading wire:target="guardar" class="tracking-widest">
                                PROCESANDO...
                            </span>
                        </div>
                    </button>
                    <p class="text-gray-500 text-[10px] uppercase font-bold mt-6 tracking-[3px]">Verifique que todo el elenco haya sido validado antes de enviar</p>
                </div>
            </form>
        </div>
    </main>

    {{-- MODAL DE SALIDA --}}
    <div x-show="showExitModal" class="fixed inset-0 z-[2000] flex items-center justify-center p-6 bg-black/90 backdrop-blur-md" x-transition x-cloak>
        <div class="bg-brand-surface border border-brand-border max-w-md w-full p-10 text-center shadow-2xl relative" @click.away="showExitModal = false">
            <h3 class="font-bebas text-4xl text-white mb-4 uppercase tracking-wider">¿Abandonar Registro?</h3>
            <p class="text-gray-400 text-[11px] font-bold uppercase tracking-[2px] mb-8">Los cambios no guardados se perderán permanentemente.</p>
            <div class="flex flex-col gap-4">
                <a href="/" class="w-full py-4 bg-red-600 text-white font-bebas text-2xl tracking-widest hover:bg-white hover:text-black transition-all no-underline">
                    SÍ, SALIR
                </a>
                <button @click="showExitModal = false" class="w-full py-4 bg-transparent border border-brand-border text-gray-500 font-bebas text-2xl tracking-widest hover:text-white hover:border-white transition-all uppercase">
                    Seguir Editando
                </button>
            </div>
        </div>
    </div>
</div>