<div class="min-h-screen bg-black text-left">
    {{-- NAV --}}
    <nav class="fixed top-0 left-0 w-full z-[1000] flex justify-between items-center px-6 py-5 md:px-12 bg-black/95 border-b border-brand-border">
        <a href="/" class="font-bebas text-3xl text-brand-orange tracking-[2px] no-underline"> ACTORES S.C.G. </a>
        <span class="font-bebas text-xl text-gray-500 hidden md:block uppercase tracking-widest"> Etapa 02: Información Técnica y Elenco </span>
    </nav>

    <main class="bg-black min-h-screen pt-32 pb-24 px-6 text-left">
        <div class="max-w-[1100px] mx-auto text-left">

            <header class="mb-12 border-l-4 border-brand-orange pl-6 text-left">
                <div class="text-brand-orange font-bold text-sm uppercase tracking-[3px] mb-2"> Proyecto: {{ $proyecto->codigo_radicado }} </div>
                <h1 class="font-bebas text-[clamp(2.5rem,6vw,4.5rem)] leading-none mb-4 text-white uppercase"> {{ $proyecto->titulo }} </h1>
            </header>

            <form wire:submit.prevent="guardar" class="space-y-12">

                {{-- 1. SECCIÓN ELENCO --}}
                <section class="bg-brand-surface border border-brand-border p-8 md:p-10 relative overflow-hidden text-left">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-end border-b border-brand-border pb-6 mb-10 gap-6">
                        <h2 class="font-bebas text-3xl text-brand-orange tracking-wider uppercase"> 1. ELENCO (MIEMBROS SOCIOS) </h2>
                        <div class="flex gap-4">
                            <button type="button" wire:click="agregarProponenteComoMiembro" class="bg-white text-black px-5 py-2.5 font-bold text-[10px] uppercase tracking-widest hover:bg-brand-orange transition-all active:scale-95 shadow-lg"> YO ACTUARÉ </button>
                            <button type="button" wire:click="agregarMiembro" class="bg-brand-orange text-black px-5 py-2.5 font-bold text-[10px] uppercase tracking-widest hover:bg-white transition-all active:scale-95 shadow-lg"> + AGREGAR SOCIO </button>
                        </div>
                    </div>

                    <div class="space-y-10 text-left">
                        @foreach($elenco as $index => $miembro)
                        <div class="bg-black/40 border border-brand-border p-8 md:p-10 relative group" wire:key="miembro-v19-{{ $index }}">

                            @if(count($elenco) > 1)
                            <button type="button" wire:click="removerMiembro({{ $index }})" class="absolute top-4 right-4 text-gray-600 hover:text-red-500 transition-colors z-30">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                            @endif

                            {{-- CONTENEDOR GRID: Foto a la izquierda, Contenido a la derecha --}}
                            <div class="grid grid-cols-1 md:grid-cols-[auto_1fr] gap-x-12 items-start">

                                {{-- FOTO QUE OCUPA AMBAS FILAS --}}
                                <div class="row-span-2">
                                    <div class="w-28 h-28 rounded-full border-2 {{ $miembro['encontrado'] ? 'border-brand-orange shadow-[0_0_20px_rgba(255,77,0,0.2)]' : 'border-gray-800' }} flex items-center justify-center overflow-hidden bg-black transition-all duration-300">
                                        @if($miembro['encontrado'] && $miembro['foto_url'])
                                        <img src="{{ $miembro['foto_url'] }}" class="w-full h-full object-cover">
                                        @elseif($miembro['encontrado'])
                                        <span class="font-bebas text-5xl text-brand-orange">{{ $miembro['iniciales'] }}</span>
                                        @else
                                        <svg class="w-14 h-14 text-gray-800" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                                        </svg>
                                        @endif
                                    </div>
                                </div>

                                {{-- BLOQUE DE DATOS (Filas 1 y 2 más juntas) --}}
                                <div class="space-y-6">
                                    {{-- FILA 1: BUSCADOR Y RESULTADO --}}
                                    <div class="flex flex-col lg:flex-row gap-8 items-start">
                                        <div class="w-full lg:w-[320px]">
                                            <label class="block text-[10px] uppercase font-bold text-gray-500 mb-2 tracking-widest text-left">Identificación del Socio</label>
                                            <div class="flex">
                                                <input type="text"
                                                    wire:model.defer="elenco.{{ $index }}.cedula"
                                                    wire:keydown.enter.prevent="buscarSocio({{ $index }})"
                                                    class="flex-1 bg-black border border-brand-border px-4 py-3 text-white focus:border-brand-orange outline-none uppercase text-sm font-semibold"
                                                    placeholder="Cédula">
                                                <button type="button" wire:click="buscarSocio({{ $index }})" class="bg-brand-orange text-black px-5 font-bold text-[10px] uppercase hover:bg-[#ff6a33] transition-all">
                                                    @if($miembro['buscando'])
                                                    <svg class="animate-spin h-4 w-4 mx-auto" fill="none" viewBox="0 0 24 24">
                                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                    </svg>
                                                    @else BUSCAR @endif
                                                </button>
                                            </div>
                                        </div>

                                        <div class="flex-1 w-full">
                                            <label class="block text-[10px] uppercase font-bold text-brand-orange/70 mb-2 tracking-widest text-left">Información Validada</label>
                                            <div class="border-b border-white/10 min-h-[48px] flex items-center">
                                                @if($miembro['nombre'])
                                                <p class="font-bebas text-3xl tracking-wide uppercase leading-tight {{ !$miembro['encontrado'] ? 'text-red-500 text-xs font-sans font-bold tracking-widest' : 'text-white' }}">
                                                    {{ $miembro['nombre'] }}
                                                </p>
                                                @else
                                                <p class="text-gray-700 italic text-xl font-bebas tracking-widest">---</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    {{-- FILA 2: CARGA DE ARCHIVOS --}}
                                    <div class="pt-4 border-t border-white/5" x-data="{ isUploading: false, isUploaded: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true; isUploaded = false; progress = 0" x-on:livewire-upload-finish="isUploading = false; isUploaded = true;" x-on:livewire-upload-progress="progress = $event.detail.progress">
                                        <div class="flex flex-col md:flex-row gap-6 items-end">
                                            <div class="shrink-0">
                                                <a href="{{ asset('storage/formatos/etapa_02_autorizacion_elenco_2026.pdf') }}" target="_blank" class="inline-flex items-center gap-3 px-6 py-3 bg-brand-orange text-black font-semibold rounded no-underline text-[11px] uppercase tracking-widest">
                                                    Descargar formato
                                                </a>
                                            </div>

                                            <div class="flex-1 w-full text-left">
                                                <label class="block text-[10px] uppercase font-bold text-gray-500 mb-2 tracking-widest">Subir formato firmado (PDF)</label>
                                                <input type="file" wire:model.live="elenco.{{ $index }}.archivo" accept=".pdf" class="w-full text-sm text-gray-400 file:bg-gray-800 file:text-white file:border-0 file:px-4 file:py-2 cursor-pointer">

                                                <div x-show="isUploading" class="mt-2 w-full bg-gray-800 h-1.5 rounded-full overflow-hidden">
                                                    <div class="bg-brand-orange h-full transition-all duration-300" :style="'width: ' + progress + '%'"></div>
                                                </div>

                                                <div x-show="isUploaded && !isUploading && $wire.elenco[{{ $index }}].archivo" x-transition class="mt-3 flex items-center gap-3 px-4 py-3 bg-green-500/10 border border-green-500/50 rounded w-full">
                                                    <span class="text-[11px] text-green-400 font-bold uppercase tracking-wider text-left">Documento cargado correctamente</span>
                                                </div>
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
                    {{-- Marca de agua sutil de fondo --}}
                    <div class="absolute top-0 right-0 p-10 opacity-[0.03] pointer-events-none">
                        <svg class="w-40 h-40 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z" />
                        </svg>
                    </div>

                    <div class="border-b border-brand-border pb-6">
                        <h2 class="font-bebas text-4xl text-brand-orange tracking-[2px] uppercase mb-2"> 2. EXPEDIENTE TÉCNICO </h2>
                        <p class="text-[10px] text-gray-500 uppercase font-bold tracking-[3px]"> Los archivos deben ser originales y estar debidamente foliados en formato PDF </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-10 mt-6">
                        @foreach([
                        [
                        'model' => 'guionFinal',
                        'label' => 'Guion Versión Final',
                        'icon' => '
                        <path d="M19 2H5c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V6h10v2z" />',
                        'desc' => 'Incluir diálogos, acotaciones y encabezados estandarizados.'
                        ],
                        [
                        'model' => 'radicadoGuion',
                        'label' => 'Radicado Guion',
                        'icon' => '
                        <path d="M11.67 3.87L9.9 2.1 0 12l9.9 9.9 1.77-1.77L3.54 12zM12.33 20.13l1.77 1.77L24 12 14.1 2.1l-1.77 1.77L20.46 12z" />',
                        'desc' => 'Certificado de registro ante la Dirección Nacional de Derecho de Autor.'
                        ],
                        [
                        'model' => 'propuestaCreativa',
                        'icon' => '
                        <path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z" />',
                        'label' => 'Propuesta Creativa',
                        'desc' => 'Moodboard, estética visual, propuesta sonora y de dirección.'
                        ]
                        ] as $doc)
                        <div class="relative p-8 border border-brand-border bg-black/40 group hover:border-brand-orange/40 transition-all duration-500 text-left flex flex-col h-full"
                            x-data="{ isUploading: false, isUploaded: false, progress: 0 }"
                            x-on:livewire-upload-start="isUploading = true; isUploaded = false; progress = 0"
                            x-on:livewire-upload-finish="isUploading = false; isUploaded = true;"
                            x-on:livewire-upload-progress="progress = $event.detail.progress">

                            {{-- Encabezado del Módulo --}}
                            <div class="flex items-start justify-between mb-6">
                                <div class="p-3 bg-brand-orange/10 border border-brand-orange/20 text-brand-orange group-hover:bg-brand-orange group-hover:text-black transition-all duration-500">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">{!! $doc['icon'] !!}</svg>
                                </div>
                            </div>

                            <div class="flex-1">
                                <label class="block text-xs uppercase font-black text-white tracking-[2px] mb-2">{{ $doc['label'] }}</label>
                                <p class="text-[10px] text-gray-500 font-bold uppercase leading-relaxed tracking-wider mb-6 opacity-70">
                                    {{ $doc['desc'] }}
                                </p>
                            </div>

                            <div class="mt-auto space-y-4">
                                <div class="relative">
                                    <input type="file" wire:model.live="{{ $doc['model'] }}" accept=".pdf" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                    <div class="bg-gray-900 border border-white/10 px-4 py-3 text-[10px] text-gray-400 font-black uppercase tracking-widest flex items-center justify-between group-hover:bg-gray-800 transition-colors">
                                        <span>Seleccionar PDF</span>
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                        </svg>
                                    </div>
                                </div>

                                {{-- Barra de progreso --}}
                                <div x-show="isUploading" class="w-full bg-gray-800 h-1 overflow-hidden">
                                    <div class="bg-brand-orange h-full transition-all duration-300" :style="'width: ' + progress + '%'"></div>
                                </div>

                                {{-- Estado de Éxito --}}
                                @if($this->{$doc['model']})
                                <div x-show="!isUploading" x-transition class="flex items-center gap-3 px-4 py-3 bg-green-500/10 border border-green-500/50 text-green-400">
                                    <svg class="w-4 h-4 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="text-[9px] font-black uppercase tracking-widest">Documento cargado correctamente</span>
                                </div>
                                @endif

                                @error($doc['model'])
                                <span class="text-red-500 text-[10px] block uppercase font-bold text-left tracking-tighter">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        @endforeach
                    </div>
                </section>

                {{-- 3. FINANCIERO --}}
                <section class="bg-brand-surface border border-brand-border p-8 md:p-10 space-y-8 text-left">
                    <h2 class="font-bebas text-3xl text-green-500 border-b border-brand-border pb-4 uppercase tracking-wider text-left"> 3. FINANCIERO Y TIEMPOS </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-left">
                        @foreach([ ['model' => 'presupuesto', 'label' => 'Presupuesto Detallado (XLSX)', 'desc' => 'formato_presupuesto_2026.xlsx'], ['model' => 'cronograma', 'label' => 'Cronograma de Producción (XLSX)', 'desc' => 'formato_cronograma_2026.xlsx'] ] as $excel)
                        <div class="p-8 border border-brand-border bg-black/40 text-left">
                            <label class="block text-sm uppercase font-bold text-green-500 mb-6 tracking-widest"> {{ $excel['label'] }} </label>
                            <div class="flex flex-col gap-5 text-left">
                                <a href="{{ asset('storage/formatos/'.$excel['desc']) }}" target="_blank" class="text-center py-3 bg-brand-orange text-black font-semibold rounded no-underline text-xs uppercase tracking-widest"> Descargar formato </a>
                                <div class="bg-black/30 p-4 border border-brand-border">
                                    <input type="file" wire:model="{{ $excel['model'] }}" accept=".xlsx,.xls" class="w-full text-xs text-gray-500 file:bg-gray-800 file:text-white file:border-0 file:px-3 file:py-1 file:uppercase">
                                </div>
                                @error($excel['model']) <span class="text-red-500 text-[10px] block uppercase font-bold text-left">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        @endforeach
                    </div>
                </section>

                {{-- FINALIZAR --}}
                <div class="text-center pt-10 pb-20 flex flex-col items-center">
                    <button type="submit" wire:loading.attr="disabled" class="group relative inline-flex items-center justify-center bg-brand-orange text-white font-bebas text-4xl hover:bg-[#ff6a33] transition-all disabled:opacity-50 min-w-[450px] py-6 shadow-2xl">
                        <span wire:loading.remove wire:target="guardar"> FINALIZAR E INSCRIBIR PROYECTO </span>
                        <div wire:loading wire:target="guardar" class="flex items-center gap-4">
                            <svg class="animate-spin h-8 w-8 text-white" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span>PROCESANDO...</span>
                        </div>
                    </button>
                </div>
            </form>
        </div>
    </main>
</div>