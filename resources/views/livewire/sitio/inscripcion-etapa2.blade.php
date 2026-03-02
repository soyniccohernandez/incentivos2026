<div class="w-full">
    {{-- ESTILOS Y FUENTES PREMIUM --}}
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@600;800;900&display=swap');

        .font-outfit {
            font-family: 'Outfit', sans-serif;
        }

        .font-inter {
            font-family: 'Inter', sans-serif;
        }

        [x-cloak] {
            display: none !important;
        }

        .animate-fade-in {
            animation: fadeIn 0.5s ease-out forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    {{-- NAV PREMIUM --}}
    <nav x-data="{ dropdownOpen: false }" class="bg-black border-b border-white/10 sticky top-0 z-[1000] antialiased">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex justify-between h-20">
                <div class="flex items-center gap-8">
                    <a href="{{ route('dashboard') }}" wire:navigate class="flex items-center gap-4 no-underline group">
                        <img src="{{ asset('resources/imagenes/logo.png') }}" class="h-9 w-auto brightness-200 group-hover:scale-105 transition-transform">
                        <div class="flex flex-col border-l border-white/10 pl-4">
                            <span class="font-outfit text-lg font-900 text-white tracking-tight leading-none uppercase">PORTAL <span class="text-[#ff6600]">POSTULACIÓN</span></span>
                            <span class="text-[9px] font-semibold text-gray-500 uppercase tracking-[2px] mt-1 font-inter">Incentivos 2026</span>
                        </div>
                    </a>
                    <div class="hidden lg:flex items-center gap-3 ml-4 bg-white/[0.03] px-4 py-1.5 rounded-full border border-white/5">
                        <div class="w-1.5 h-1.5 bg-[#ff6600] rounded-full animate-pulse shadow-[0_0_8px_#ff6600]"></div>
                        <span class="font-inter text-[11px] font-bold text-gray-400 tracking-wider uppercase">Etapa 02: Expediente Técnico</span>
                    </div>
                </div>
                <div class="flex items-center">
                    <button @click="dropdownOpen = !dropdownOpen" class="flex items-center gap-3 px-2 py-1.5 hover:bg-white/5 transition-all rounded-lg group">
                        <div class="w-9 h-9 bg-gradient-to-br from-[#ff6600] to-[#cc5200] rounded-lg flex items-center justify-center text-black font-outfit font-800 text-sm overflow-hidden shadow-lg">
                            {{ $iniciales }}
                        </div>
                        <div class="text-left hidden sm:block">
                            <span class="text-sm font-700 text-white block leading-none">{{ auth()->user()->name }}</span>
                            <span class="text-[9px] font-bold text-gray-500 uppercase mt-1 block tracking-widest">Socio Proponente</span>
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <main class="min-h-screen bg-[#f8fafc] font-inter pb-24 pt-10 text-left">
        <div class="max-w-7xl mx-auto px-6">
            {{-- HEADER --}}
            <header class="mb-12 flex flex-col md:flex-row md:items-end justify-between gap-6">
                <div class="border-l-4 border-[#ff6600] pl-6">
                    <span class="text-[#ff6600] font-bold text-[10px] uppercase tracking-[4px] mb-2 block">EXPEDIENTE: {{ $proyecto->codigo_radicado }}</span>
                    <h1 class="font-outfit text-5xl md:text-6xl font-900 text-slate-800 leading-none uppercase tracking-tighter">
                        DETALLES <span class="text-[#ff6600]">TÉCNICOS</span>
                    </h1>
                </div>
                <div class="hidden md:block text-right">
                    <p class="text-slate-400 font-bold text-[10px] uppercase tracking-[2px]">Proyecto Registrado</p>
                    <p class="font-outfit text-xl font-800 text-slate-700 uppercase">{{ $proyecto->titulo }}</p>
                </div>
            </header>

            <form wire:submit.prevent="guardar" class="space-y-10">
                {{-- 1. SECCIÓN ELENCO --}}
                <section class="bg-white rounded-[2.5rem] p-10 border border-slate-100 shadow-sm relative overflow-hidden">
                    {{-- CABECERA SECCIÓN --}}
                    <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-6 border-b border-slate-100 pb-8">
                        <div class="flex items-center gap-4">
                            <div class="h-8 w-1 bg-[#ff6600] rounded-full"></div>
                            <h2 class="font-outfit text-2xl font-800 text-slate-800 uppercase tracking-tight">1. Elenco (Miembros Socios)</h2>
                        </div>
                        <button type="button" wire:click="agregarProponenteComoMiembro" class="px-6 py-3 bg-slate-100 text-slate-600 rounded-xl font-bold text-[10px] uppercase tracking-widest hover:bg-slate-200 transition-all shadow-sm">
                            Yo Actuaré
                        </button>
                    </div>

                    {{-- LISTADO DE MIEMBROS --}}
                    <div class="space-y-6">
                        @foreach($elenco as $index => $miembro)
                        <div class="bg-slate-50/50 border border-slate-100 p-8 rounded-[2rem] relative animate-fade-in group hover:border-orange-200 transition-all" wire:key="miembro-{{ $index }}">
                            @if(count($elenco) > 1)
                            <button type="button" wire:click="removerMiembro({{ $index }})" class="absolute top-6 right-6 text-slate-300 hover:text-red-500 transition-colors">✕</button>
                            @endif

                            <div class="flex flex-col lg:flex-row gap-10 items-start">
                                <div class="shrink-0 mx-auto lg:mx-0">
                                    <div class="w-24 h-24 rounded-2xl bg-white border-2 {{ ($miembro['encontrado'] ?? false) ? 'border-[#ff6600]' : 'border-slate-200' }} flex items-center justify-center overflow-hidden shadow-sm transition-all">
                                        @if(($miembro['encontrado'] ?? false) && ($miembro['foto_url'] ?? false))
                                        <img src="{{ $miembro['foto_url'] }}" class="w-full h-full object-cover">
                                        @else
                                        <span class="font-outfit text-3xl font-800 {{ ($miembro['encontrado'] ?? false) ? 'text-[#ff6600]' : 'text-slate-200' }}">
                                            {{ ($miembro['encontrado'] ?? false) ? $miembro['iniciales'] : '?' }}
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="flex-grow w-full space-y-6">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        {{-- CÉDULA CON SPINNER --}}
                                        <div>
                                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 block">Cédula del Socio</label>
                                            <div class="flex gap-2">
                                                <input type="text" wire:model.defer="elenco.{{ $index }}.cedula" wire:keydown.enter.prevent="buscarSocio({{ $index }})" class="flex-1 bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm font-bold text-slate-700 outline-none focus:border-[#ff6600] transition-all uppercase">
                                                <button type="button" wire:click="buscarSocio({{ $index }})" wire:loading.attr="disabled" wire:target="buscarSocio({{ $index }})" class="bg-slate-800 text-white px-4 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-[#ff6600] transition-colors min-w-[90px] flex items-center justify-center">
                                                    <span wire:loading.remove wire:target="buscarSocio({{ $index }})">Validar</span>
                                                    <svg wire:loading wire:target="buscarSocio({{ $index }})" class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                            @error("elenco.$index.cedula") <span class="text-red-500 text-[9px] font-bold mt-1 block uppercase">{{ $message }}</span> @enderror
                                        </div>

                                        {{-- NOMBRE CON SKELETON --}}
                                        <div>
                                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 block">Nombre Completo</label>
                                            <div class="bg-slate-100/50 border border-slate-200 rounded-xl px-4 py-3 min-h-[46px] flex items-center relative overflow-hidden">
                                                <span wire:loading.remove wire:target="buscarSocio({{ $index }})" class="font-outfit text-sm font-800 {{ ($miembro['encontrado'] ?? false) ? 'text-slate-700' : 'text-slate-400 italic' }} uppercase">
                                                    {{ $miembro['nombre'] ?? 'Esperando búsqueda...' }}
                                                </span>
                                                <div wire:loading wire:target="buscarSocio({{ $index }})" class="flex items-center gap-2">
                                                    <div class="h-2 w-20 bg-slate-200 animate-pulse rounded"></div>
                                                    <span class="text-[9px] font-bold text-[#ff6600] animate-pulse">BUSCANDO...</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- ARCHIVO ELENCO --}}
                                    <div class="pt-6 border-t border-slate-200" x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">
                                        <div class="flex flex-col md:flex-row items-center gap-6">
                                            <a href="{{ asset('storage/formatos/etapa_02_autorizacion_elenco_2026.pdf') }}" target="_blank" class="w-full md:w-auto px-6 py-3 bg-white border border-slate-200 rounded-xl text-[9px] font-black text-slate-500 uppercase tracking-widest hover:border-[#ff6600] transition-all flex items-center justify-center gap-2">
                                                Formato PDF
                                            </a>
                                            <div class="flex-1 w-full">
                                                <div class="relative">
                                                    @if(!($miembro['archivo_autorizacion'] ?? false))
                                                    <label x-show="!isUploading" class="flex items-center justify-between w-full px-5 py-3 border-2 border-dashed border-slate-200 rounded-xl cursor-pointer hover:bg-white hover:border-[#ff6600]/30 transition-all group/up">
                                                        <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Subir Autorización Firmada (PDF)</span>
                                                        <input type="file" wire:model.live="elenco.{{ $index }}.archivo_autorizacion" class="hidden" accept=".pdf">
                                                    </label>
                                                    <div x-show="isUploading" x-cloak class="w-full h-12 flex flex-col justify-center px-5 bg-white border border-orange-100 rounded-xl">
                                                        <div class="w-full h-1 bg-slate-100 rounded-full overflow-hidden">
                                                            <div class="h-full bg-[#ff6600] transition-all duration-300" :style="`width: ${progress}%`"></div>
                                                        </div>
                                                    </div>
                                                    @else
                                                    <div class="bg-white border border-emerald-100 p-3 rounded-xl flex items-center justify-between animate-fade-in shadow-sm">
                                                        <span class="text-[9px] font-bold text-slate-600 uppercase truncate">{{ is_string($miembro['archivo_autorizacion']) ? 'Archivo cargado' : $miembro['archivo_autorizacion']->getClientOriginalName() }}</span>
                                                        <button type="button" @click="isUploading = false; progress = 0; $wire.limpiarDocumento('elenco', {{ $index }})" class="text-slate-300 hover:text-red-500 transition-colors">✕</button>
                                                    </div>
                                                    @endif
                                                </div>
                                                @error("elenco.$index.archivo_autorizacion") <span class="text-red-500 text-[9px] font-bold mt-1 block uppercase">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="mt-8 flex justify-center">
                        <button type="button" wire:click="agregarMiembro" class="group flex items-center gap-3 px-8 py-4 bg-white border-2 border-dashed border-slate-200 text-slate-500 rounded-2xl font-bold text-[11px] uppercase tracking-[2px] hover:border-[#ff6600] hover:text-[#ff6600] transition-all">
                            <span class="flex items-center justify-center w-6 h-6 bg-slate-100 text-slate-400 rounded-lg group-hover:bg-[#ff6600] group-hover:text-white transition-colors">+</span> Agregar miembro a mi elenco
                        </button>
                    </div>
                </section>

                {{-- 2. EXPEDIENTE TÉCNICO --}}
                <section class="bg-white rounded-[2.5rem] p-10 border border-slate-100 shadow-sm">
                    <div class="flex items-center gap-4 mb-10">
                        <div class="h-8 w-1 bg-[#ff6600] rounded-full"></div>
                        <h2 class="font-outfit text-2xl font-800 text-slate-800 uppercase tracking-tight">2. Documentación Técnica (PDF)</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach([
                        ['model' => 'guionFinal', 'label' => 'Guion Final', 'desc' => 'Versión Definitiva'],
                        ['model' => 'radicadoGuion', 'label' => 'Radicado DNDA', 'desc' => 'Derechos de Autor'],
                        ['model' => 'propuestaCreativa', 'label' => 'Propuesta', 'desc' => 'Concepto Visual']
                        ] as $doc)
                        <div class="p-6 bg-slate-50/50 rounded-[2rem] border border-slate-100 group hover:border-orange-200 transition-all flex flex-col justify-between" x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">
                            <div class="mb-6">
                                <h4 class="font-outfit text-sm font-800 text-slate-700 uppercase mb-1">{{ $doc['label'] }} *</h4>
                                <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest">{{ $doc['desc'] }}</p>
                            </div>
                            <div class="relative">
                                @if(!$this->{$doc['model']})
                                <label x-show="!isUploading" class="flex flex-col items-center justify-center w-full h-24 border-2 border-dashed border-slate-200 rounded-2xl cursor-pointer hover:bg-white hover:border-[#ff6600]/30 transition-all">
                                    <span class="text-[9px] font-black text-slate-400 uppercase">Subir PDF</span>
                                    <input type="file" wire:model.live="{{ $doc['model'] }}" class="hidden" accept=".pdf">
                                </label>
                                <div x-show="isUploading" x-cloak class="w-full h-24 flex flex-col items-center justify-center bg-white border border-orange-100 rounded-2xl">
                                    <div class="w-1/2 h-1 bg-slate-100 rounded-full overflow-hidden mb-2">
                                        <div class="h-full bg-[#ff6600]" :style="`width: ${progress}%`"></div>
                                    </div>
                                </div>
                                @else
                                <div class="bg-white border border-emerald-100 p-4 rounded-2xl flex items-center justify-between animate-fade-in shadow-sm">
                                    <span class="text-[9px] font-bold text-slate-600 uppercase">Cargado</span>
                                    {{-- AQUÍ ESTABA EL ERROR: Se cambió $index por el nombre del modelo --}}
                                    <button type="button" @click="isUploading = false; progress = 0; $wire.limpiarDocumento('{{ $doc['model'] }}')" class="text-slate-300 hover:text-red-500"> ✕ </button>
                                </div>
                                @endif
                            </div>
                            @error($doc['model']) <span class="text-red-500 text-[9px] font-bold mt-2 block uppercase">{{ $message }}</span> @enderror
                        </div>
                        @endforeach
                    </div>
                </section>

                {{-- 3. FINANCIERO --}}
                <section class="bg-white rounded-[2.5rem] p-10 border border-slate-100 shadow-sm">
                    <div class="flex items-center gap-4 mb-10">
                        <div class="h-8 w-1 bg-[#ff6600] rounded-full"></div>
                        <h2 class="font-outfit text-2xl font-800 text-slate-800 uppercase tracking-tight">3. Presupuesto y Cronograma (Excel)</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        @foreach([
                        ['model' => 'presupuesto', 'label' => 'Presupuesto Detallado', 'file' => 'formato_presupuesto_2026.xlsx'],
                        ['model' => 'cronograma', 'label' => 'Cronograma de Producción', 'file' => 'formato_cronograma_2026.xlsx']
                        ] as $xls)
                        <div class="p-8 bg-slate-50/50 rounded-[2rem] border border-slate-100 group hover:border-orange-200 transition-all" x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">
                            <label class="block text-sm font-800 text-slate-700 uppercase tracking-tight mb-6">{{ $xls['label'] }}</label>
                            <div class="flex flex-col gap-4">
                                <a href="{{ asset('storage/formatos/'.$xls['file']) }}" target="_blank" class="w-full py-3 bg-white border border-slate-200 rounded-xl text-[9px] font-black text-slate-500 uppercase tracking-widest hover:border-[#ff6600] transition-all text-center">Descargar Formato</a>
                                <div class="relative">
                                    @if(!$this->{$xls['model']})
                                    <label x-show="!isUploading" class="flex items-center justify-between w-full px-5 py-4 bg-slate-800 text-white rounded-xl cursor-pointer hover:bg-[#ff6600] transition-all">
                                        <span class="text-[9px] font-black uppercase">Subir Excel</span>
                                        <input type="file" wire:model.live="{{ $xls['model'] }}" class="hidden" accept=".xlsx,.xls">
                                    </label>
                                    <div x-show="isUploading" x-cloak class="w-full h-12 bg-white rounded-xl flex items-center px-4 border border-orange-100">
                                        <div class="h-1 bg-[#ff6600] rounded-full flex-1" :style="`width: ${progress}%`"></div>
                                    </div>
                                    @else
                                    <div class="bg-white border border-emerald-100 p-4 rounded-xl flex items-center justify-between animate-fade-in shadow-sm">
                                        <span class="text-[9px] font-bold text-slate-600 uppercase">Excel Listo</span>
                                        <button type="button" @click="isUploading = false; progress = 0; $wire.limpiarDocumento('{{ $xls['model'] }}')" class="text-slate-300 hover:text-red-500"> ✕ </button>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @error($xls['model']) <span class="text-red-500 text-[9px] font-bold mt-3 block uppercase">{{ $message }}</span> @enderror
                        </div>
                        @endforeach
                    </div>
                </section>

                {{-- BOTÓN FINALIZAR --}}
                <div class="flex flex-col items-center pt-10">
                    <button type="submit" wire:loading.attr="disabled" class="px-20 py-7 bg-[#ff6600] text-white rounded-[2.5rem] font-outfit text-2xl font-900 uppercase transition-all shadow-2xl active:scale-95 disabled:opacity-50">
                        <span wire:loading.remove wire:target="guardar">FINALIZAR INSCRIPCIÓN</span>
                        <span wire:loading wire:target="guardar">PROCESANDO...</span>
                    </button>
                </div>
            </form>
        </div>
    </main>
</div>