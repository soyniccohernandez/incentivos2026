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

    {{-- NAV PREMIUM INTEGRADO --}}
    <nav x-data="{ dropdownOpen: false }" class="bg-black border-b border-white/10 sticky top-0 z-[1000] antialiased">
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
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex justify-between h-20">
                <div class="flex items-center gap-8">
                    <a href="{{ route('dashboard') }}" wire:navigate class="flex items-center gap-4 no-underline group">
                        <img src="{{ asset('resources/imagenes/logo.png') }}" alt="Logo" class="h-9 w-auto object-contain brightness-200 group-hover:scale-105 transition-transform">
                        <div class="flex flex-col border-l border-white/10 pl-4">
                            <span class="font-outfit text-lg font-900 text-white tracking-tight leading-none group-hover:text-[#ff6600] transition-colors uppercase">
                                PORTAL <span class="text-[#ff6600]">POSTULACIÓN</span>
                            </span>
                            <span class="text-[9px] font-semibold text-gray-500 uppercase tracking-[2px] mt-1 font-inter">
                                Incentivos 2026
                            </span>
                        </div>
                    </a>
                    <div class="hidden lg:flex items-center gap-3 ml-4 bg-white/[0.03] px-4 py-1.5 rounded-full border border-white/5">
                        <div class="w-1.5 h-1.5 bg-[#ff6600] rounded-full animate-pulse shadow-[0_0_8px_#ff6600]"></div>
                        <span class="font-inter text-[11px] font-bold text-gray-400 tracking-wider uppercase">Etapa 01: Inscripción</span>
                    </div>
                </div>
                <div class="flex items-center font-inter">
                    <div class="relative">
                        <button @click="dropdownOpen = !dropdownOpen" class="flex items-center gap-3 px-2 py-1.5 hover:bg-white/5 transition-all duration-300 rounded-lg group">
                            <div class="w-9 h-9 bg-gradient-to-br from-[#ff6600] to-[#cc5200] rounded-lg flex items-center justify-center text-black font-outfit font-800 text-sm shadow-[0_0_15px_rgba(255,102,0,0.2)] overflow-hidden">
                                @if($foto_url) <img src="{{ $foto_url }}" class="w-full h-full object-cover"> @else {{ $iniciales }} @endif
                            </div>
                            <div class="text-left hidden sm:block">
                                <span class="text-sm font-700 text-white block leading-none">{{ auth()->user()->name }}</span>
                                <span class="text-[9px] font-bold text-gray-500 uppercase tracking-wider mt-1 block">
                                    {{ auth()->user()->tipo_socio === 'Administrador' ? 'Administrador' : 'Socio Proponente' }}
                                </span>
                            </div>
                            <svg class="w-4 h-4 text-gray-600 group-hover:text-white transition-colors" :class="dropdownOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="dropdownOpen" @click.away="dropdownOpen = false" x-transition class="absolute right-0 mt-3 w-64 bg-[#0a0a0a] border border-white/10 shadow-2xl rounded-xl overflow-hidden z-[1100]">
                            <div class="px-5 py-4 bg-white/[0.02] border-b border-white/5">
                                <p class="text-[9px] font-bold text-gray-500 uppercase tracking-widest mb-1">Usuario Conectado</p>
                                <p class="text-xs font-medium text-gray-300 truncate">{{ $socio->email }}</p>
                            </div>
                            <div class="p-2">
                                <button wire:click="logout" class="w-full flex items-center gap-3 text-left px-4 py-3 text-[13px] font-bold text-red-500/80 hover:text-red-500 hover:bg-red-500/5 rounded-lg transition-all">
                                    Cerrar Sesión
                                </button>
                            </div>
                        </div>
                    </div>
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

                    <div class="mb-8 flex flex-col md:flex-row items-center gap-5 p-6 bg-amber-50 border border-amber-100 rounded-[2rem] transition-all hover:bg-amber-100/50">
                        <div class="flex-shrink-0 w-12 h-12 bg-amber-500/10 rounded-2xl flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>

                        <div class="flex-grow text-center md:text-left">
                            <h4 class="text-sm font-bold text-amber-900 uppercase tracking-wider">
                                ¡Importante: Sin periodo de subsanación!
                            </h4>
                            <p class="text-xs text-amber-800/80 mt-1 leading-relaxed">
                                Recuerda que en esta etapa <strong>no se permite la corrección de documentos</strong>. Los datos tuyos y de todo tu elenco deben estar debidamente actualizados ante la sociedad; cualquier inconsistencia será <strong>causal de descalificación inmediata</strong>.
                            </p>
                        </div>
                    </div>
                    {{-- CABECERA SECCIÓN --}}
                    <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-6 border-b border-slate-100 pb-8">
                        <div class="flex items-center gap-4">
                            <div class="h-8 w-1 bg-[#ff6600] rounded-full"></div>
                            <h2 class="font-outfit text-2xl font-800 text-slate-800 uppercase tracking-tight">1. Elenco (Miembros Socios)</h2>
                        </div>
                        @if(!collect($elenco)->contains('identificacion', $socio->identificacion))
                        <button type="button"
                            wire:click="agregarProponenteComoMiembro"
                            class="px-6 py-3 bg-slate-100 text-slate-600 rounded-xl font-bold text-[10px] uppercase tracking-widest hover:bg-slate-200 transition-all shadow-sm">
                            Yo Actuaré
                        </button>
                        @endif
                    </div>

                    {{-- LISTADO DE MIEMBROS --}}
                    <div class="space-y-6">
                        @foreach($elenco as $index => $miembro)
                        <div class="p-8 rounded-[2rem] relative animate-fade-in group transition-all border 
                            {{ $errors->has('elenco_incompleto') && !($miembro['archivo_autorizacion'] ?? false) 
                                ? 'bg-red-50/50 border-red-200 shadow-inner' 
                                : 'bg-slate-50/50 border-slate-100 hover:border-orange-200 shadow-sm' }}"
                            wire:key="miembro-{{ $index }}">

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
                                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 block">
                                                Identificación del Socio <span class="text-red-500">*</span>
                                            </label>

                                            <div class="flex gap-2">
                                                <div class="relative flex-1">
                                                    <input type="text"
                                                        wire:model.defer="elenco.{{ $index }}.identificacion"
                                                        wire:keydown.enter.prevent="buscarSocio({{ $index }})"
                                                        {{ $miembro['encontrado'] ? 'readonly' : '' }}

                                                        /* Bloqueo de caracteres no numéricos en tiempo real */
                                                        oninput="this.value = this.value.replace(/[^0-9]/g, '')"

                                                        class="w-full border rounded-xl px-4 py-3 text-sm font-bold transition-all uppercase outline-none
                                                        {{ $miembro['encontrado'] 
                                                            ? 'bg-slate-100 text-slate-500 border-slate-200 cursor-not-allowed shadow-inner' 
                                                            : ($errors->has('elenco.'.$index.'.identificacion') 
                                                                ? 'bg-red-50 border-red-300 text-red-900 focus:border-red-400' 
                                                                : 'bg-white border-slate-200 text-slate-700 focus:border-[#ff6600] shadow-sm') 
                                                        }}"
                                                        placeholder="Presione Enter para validar">

                                                    {{-- BOTÓN PARA LIMPIAR (Sale si hay algo escrito O si ya se encontró) --}}
                                                    @if(!empty($miembro['identificacion']) || $miembro['encontrado'])
                                                    <button type="button"
                                                        wire:click="limpiarSocio({{ $index }})"
                                                        class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-red-500 transition-colors p-1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                    @endif
                                                </div>

                                                {{-- BOTÓN VALIDAR / ESTADO --}}
                                                <button type="button"
                                                    wire:click="buscarSocio({{ $index }})"
                                                    wire:loading.attr="disabled"
                                                    wire:target="buscarSocio({{ $index }})"
                                                    {{ $miembro['encontrado'] ? 'disabled' : '' }}
                                                    class="px-4 rounded-xl text-[10px] font-black uppercase tracking-widest transition-colors min-w-[90px] flex items-center justify-center
                                                        {{ $miembro['encontrado'] 
                                                            ? 'bg-emerald-500 text-white cursor-default' 
                                                            : ($errors->has('elenco.'.$index.'.identificacion') ? 'bg-red-500 text-white' : 'bg-slate-800 text-white hover:bg-[#ff6600]') 
                                                        }}">

                                                    <span wire:loading.remove wire:target="buscarSocio({{ $index }})">
                                                        {{ $miembro['encontrado'] ? 'Listo' : 'Validar' }}
                                                    </span>

                                                    <svg wire:loading wire:target="buscarSocio({{ $index }})" class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                    </svg>
                                                </button>
                                            </div>

                                            @error("elenco.$index.identificacion")
                                            <span class="text-red-500 text-[9px] font-bold mt-1.5 block uppercase animate-fade-in ml-1">
                                                {{ $message }}
                                            </span>
                                            @enderror
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
                                    <div class="pt-6 border-t border-slate-200 space-y-4">
                                        {{-- FILA 1: INFORMACIÓN Y DESCARGA --}}
                                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                                            <div class="space-y-1">
                                                <h4 class="font-outfit text-sm font-800 text-slate-700 uppercase">
                                                    ANEXO 5: CARTA DE INTENCIÓN ELENCO <span class="text-red-500">*</span>
                                                </h4>
                                                <p class="text-[10px] text-slate-400 font-medium uppercase tracking-tighter">
                                                    Documento obligatorio firmado por cada miembro del elenco.
                                                </p>
                                            </div>

                                            {{-- BOTÓN DESCARGA --}}
                                            <a href="{{ asset('storage/formatos/etapa_02/anexo-05-carta-de-intencion-del-elenco.pdf') }}"
                                                target="_blank"
                                                class="shrink-0 flex items-center justify-center gap-2 px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-[9px] font-black text-slate-500 uppercase tracking-widest hover:border-[#ff6600] hover:text-[#ff6600] transition-all group shadow-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 transition-transform group-hover:-translate-y-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                                </svg>
                                                Descargar Formato
                                            </a>
                                        </div>

                                        {{-- FILA 2: ÁREA DE SUBIDA (INPUT FILE) --}}
                                        <div x-data="{ isUploading: false, progress: 0 }"
                                            x-on:livewire-upload-start="isUploading = true"
                                            x-on:livewire-upload-finish="isUploading = false"
                                            x-on:livewire-upload-error="isUploading = false"
                                            x-on:livewire-upload-progress="progress = $event.detail.progress"
                                            class="relative">

                                            @if(!($miembro['archivo_autorizacion'] ?? false))
                                            {{-- ESTADO: PARA SUBIR --}}
                                            <label x-show="!isUploading"
                                                class="flex items-center justify-between w-full px-5 py-4 border-2 border-dashed rounded-xl cursor-pointer transition-all group/up animate-fade-in
                {{ $errors->has('elenco.'.$index.'.archivo_autorizacion') ? 'border-red-300 bg-red-50' : 'border-slate-200 hover:bg-slate-50 hover:border-[#ff6600]/30' }}">

                                                <div class="flex items-center gap-3">
                                                    <svg class="w-5 h-5 text-slate-300 group-hover/up:text-[#ff6600] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                                    </svg>
                                                    <span class="text-[10px] font-bold {{ $errors->has('elenco.'.$index.'.archivo_autorizacion') ? 'text-red-500' : 'text-slate-400' }} uppercase tracking-widest">
                                                        Subir Autorización Firmada (PDF)
                                                    </span>
                                                </div>

                                                <input type="file" wire:model.live="elenco.{{ $index }}.archivo_autorizacion" class="hidden" accept=".pdf">
                                            </label>

                                            {{-- PROGRESO DE CARGA --}}
                                            <div x-show="isUploading" x-cloak class="w-full h-14 flex flex-col justify-center px-5 bg-white border border-orange-100 rounded-xl">
                                                <div class="w-full h-1.5 bg-slate-100 rounded-full overflow-hidden mb-2">
                                                    <div class="h-full bg-[#ff6600] transition-all duration-300" :style="`width: ${progress}%` "></div>
                                                </div>
                                                <div class="flex justify-between items-center">
                                                    <span class="text-[8px] font-black text-[#ff6600] uppercase tracking-widest">Cargando archivo...</span>
                                                    <span class="text-[8px] font-black text-[#ff6600]" x-text="progress + '%'"></span>
                                                </div>
                                            </div>
                                            @else
                                            {{-- ESTADO: CARGADO --}}
                                            <div class="bg-emerald-50/50 border border-emerald-200 p-4 rounded-xl flex items-center justify-between animate-fade-in">
                                                <div class="flex items-center gap-3 truncate">
                                                    <div class="flex-shrink-0 h-8 w-8 bg-emerald-500 rounded-lg flex items-center justify-center text-white shadow-sm">
                                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                    </div>
                                                    <div class="flex flex-col truncate">
                                                        <span class="text-[10px] font-black text-slate-700 uppercase">Documento Cargado</span>
                                                        <span class="text-[9px] font-medium text-emerald-600 truncate">
                                                            {{ is_string($miembro['archivo_autorizacion']) ? 'anexo_05_firmado.pdf' : $miembro['archivo_autorizacion']->getClientOriginalName() }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <button type="button"
                                                    @click="isUploading = false; progress = 0; $wire.limpiarDocumento('elenco', {{ $index }})"
                                                    class="h-8 w-8 flex items-center justify-center bg-white border border-emerald-200 rounded-lg text-red-400 hover:text-red-600 hover:border-red-200 transition-all shadow-sm">
                                                    ✕
                                                </button>
                                            </div>
                                            @endif

                                            @error("elenco.$index.archivo_autorizacion")
                                            <span class="text-red-500 text-[9px] font-bold mt-2 block uppercase animate-fade-in ml-1">
                                                {{ $message }}
                                            </span>
                                            @enderror
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

                {{-- 2. DOCUMENTACIÓN TÉCNICA (PDF) --}}
                {{-- 2. DOCUMENTACIÓN TÉCNICA (PDF) --}}
                <section class="bg-white rounded-[2.5rem] p-10 border border-slate-100 shadow-sm">
                    <div class="flex items-center gap-4 mb-10">
                        <div class="h-8 w-1 bg-[#ff6600] rounded-full"></div>
                        <h2 class="font-outfit text-2xl font-800 text-slate-800 uppercase tracking-tight">2. Documentación Técnica (PDF)</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        @foreach([
                        ['model' => 'guionFinal', 'label' => 'Guion Final', 'desc' => 'Versión Definitiva', 'hasDownload' => false],
                        ['model' => 'radicadoGuion', 'label' => 'Radicado DNDA', 'desc' => 'Derechos de Autor', 'hasDownload' => false]
                        ] as $doc)

                        <div class="p-6 bg-slate-50/50 rounded-[2rem] border border-slate-100 flex flex-col justify-between group hover:border-orange-200 transition-all"
                            x-data="{ isUploading: false, progress: 0 }"
                            x-on:livewire-upload-start="isUploading = true"
                            x-on:livewire-upload-finish="isUploading = false"
                            x-on:livewire-upload-error="isUploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress">

                            <div class="mb-6">
                                <h4 class="font-outfit text-sm font-800 text-slate-700 uppercase mb-1">
                                    {{ $doc['label'] }} <span class="text-red-500">*</span>
                                </h4>
                                <p class="text-[10px] text-slate-400 font-medium uppercase tracking-tighter">{{ $doc['desc'] }}</p>
                            </div>

                            <div class="space-y-4">
                                {{-- Lógica de diseño: Estos no tienen formato de descarga según tu requerimiento --}}
                                <div class="py-1 text-[9px] font-bold text-slate-300 uppercase tracking-widest text-center border border-transparent">
                                    Documento Libre (Sin Formato)
                                </div>

                                <div class="relative" wire:key="wrap-doc-{{ $doc['model'] }}-{{ $this->{$doc['model']} ? 'filled' : 'empty' }}">
                                    @if(!$this->{$doc['model']})
                                    {{-- ESTADO: ESPERANDO ARCHIVO --}}
                                    <label x-show="!isUploading"
                                        class="flex flex-col items-center justify-center w-full h-24 border-2 border-dashed border-slate-200 rounded-2xl cursor-pointer hover:bg-white hover:border-[#ff6600]/30 transition-all group/up animate-fade-in">
                                        <svg class="w-6 h-6 text-slate-300 group-hover/up:text-[#ff6600] mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" stroke-width="2" stroke-linecap="round" />
                                        </svg>
                                        <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Subir PDF</span>
                                        <input type="file" wire:model.live="{{ $doc['model'] }}" class="hidden" accept=".pdf" />
                                    </label>

                                    {{-- ESTADO: CARGANDO --}}
                                    <div x-show="isUploading" x-cloak class="w-full h-24 flex flex-col items-center justify-center bg-white border-2 border-orange-100 rounded-2xl animate-pulse">
                                        <div class="w-3/4 h-1.5 bg-slate-100 rounded-full overflow-hidden mb-2">
                                            <div class="h-full bg-[#ff6600] transition-all duration-300" :style="'width: ' + progress + '%'"></div>
                                        </div>
                                        <span class="text-[8px] font-black text-[#ff6600] uppercase tracking-widest">Cargando <span x-text="progress"></span>%</span>
                                    </div>
                                    @else
                                    {{-- ESTADO: CARGADO --}}
                                    <div class="bg-white border border-emerald-100 p-4 rounded-2xl flex items-center justify-between shadow-sm animate-fade-in">
                                        <div class="flex items-center gap-3 truncate">
                                            <div class="h-8 w-8 bg-emerald-50 rounded-lg flex items-center justify-center text-emerald-500">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path d="M5 13l4 4L19 7" stroke-width="3" stroke-linecap="round" />
                                                </svg>
                                            </div>
                                            <span class="text-[9px] font-bold text-slate-600 truncate uppercase">
                                                {{ is_object($this->{$doc['model']}) ? $this->{$doc['model']}->getClientOriginalName() : 'Archivo Cargado' }}
                                            </span>
                                        </div>
                                        <button type="button"
                                            @click="isUploading = false; progress = 0; $wire.limpiarDocumento('{{ $doc['model'] }}')"
                                            class="text-slate-300 hover:text-red-500 transition-colors cursor-pointer px-2">
                                            ✕
                                        </button>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            {{-- ERRORES --}}
                            @error($doc['model'])
                            <span class="text-red-500 text-[9px] font-bold block uppercase animate-fade-in mt-2 ml-1">{{ $message }}</span>
                            @enderror
                        </div>
                        @endforeach
                    </div>
                </section>



                {{-- 3. PRESUPUESTO Y CRONOGRAMA (EXCEL) --}}
                <section class="bg-white rounded-[2.5rem] p-10 border border-slate-100 shadow-sm mt-10">
                    <div class="flex items-center gap-4 mb-10">
                        <div class="h-8 w-1 bg-[#ff6600] rounded-full"></div>
                        <h2 class="font-outfit text-2xl font-800 text-slate-800 uppercase tracking-tight">3. Presupuesto, Cronograma y Propuesta</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach([
                        ['model' => 'propuestaCreativa', 'label' => 'ANEXO 6. PROPUESTA CREATIVA', 'desc' => 'Concepto Visual', 'file' => 'etapa_02/ANEXO 6. PROPUESTA CREATIVA.docx'],
                        ['model' => 'presupuesto', 'label' => 'ANEXO 7. PRESUPUESTO', 'desc' => 'Formato Excel (.xlsx)', 'file' => 'etapa_02/ANEXO 7. PRESUPUESTO.xlsx'],
                        ['model' => 'cronograma', 'label' => 'ANEXO 8. CRONOGRAMA', 'desc' => 'Formato Excel (.xlsx)', 'file' => 'etapa_02/ANEXO 8. CRONOGRAMA.xlsx']
                        ] as $xls)

                        <div class="p-8 bg-white rounded-[2rem] border border-slate-100 group hover:border-orange-200 transition-all flex flex-col justify-between"
                            x-data="{ isUploading: false, progress: 0 }"
                            x-on:livewire-upload-start="isUploading = true"
                            x-on:livewire-upload-finish="isUploading = false"
                            x-on:livewire-upload-error="isUploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress">

                            <div class="mb-6">
                                <h4 class="font-outfit text-sm font-800 text-slate-700 uppercase mb-1">
                                    {{ $xls['label'] }} <span class="text-red-500">*</span>
                                </h4>
                                <p class="text-[10px] text-slate-400 font-medium uppercase tracking-tighter">{{ $xls['desc'] }}</p>
                            </div>

                            <div class="flex flex-col gap-4">
                                {{-- BOTÓN DE DESCARGA (ESTILO ANEXO 4) --}}
                                <a href="{{ asset('storage/formatos/'.$xls['file']) }}" target="_blank"
                                    class="group flex items-center justify-center gap-2 w-full py-3 bg-white text-slate-600 rounded-xl text-[10px] font-bold uppercase tracking-[0.15em] border border-slate-200 shadow-sm hover:shadow-md hover:border-[#ff6600] hover:text-[#ff6600] transition-all duration-300">

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                    </svg>

                                    <span>Descargar Formato</span>
                                </a>

                                <div class="relative" wire:key="wrap-xls-{{ $xls['model'] }}-{{ $this->{$xls['model']} ? 'filled' : 'empty' }}">
                                    @if(!$this->{$xls['model']})
                                    {{-- ESTADO: VACÍO (BOTÓN OSCURO) --}}
                                    <label x-show="!isUploading"
                                        class="flex items-center justify-between w-full px-5 py-4 bg-slate-800 text-white rounded-xl cursor-pointer hover:bg-[#ff6600] transition-all group/up animate-fade-in">
                                        <span class="text-[9px] font-black uppercase tracking-widest">Subir Archivo</span>
                                        <svg class="w-5 h-5 text-white/50 group-hover/up:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" stroke-width="2" stroke-linecap="round" />
                                        </svg>
                                        <input type="file" wire:model.live="{{ $xls['model'] }}" class="hidden" />
                                    </label>

                                    {{-- ESTADO: CARGANDO --}}
                                    <div x-show="isUploading" x-cloak class="w-full h-[52px] flex flex-col items-center justify-center bg-white border-2 border-orange-100 rounded-xl animate-pulse">
                                        <div class="w-3/4 h-1.5 bg-slate-100 rounded-full overflow-hidden mb-1">
                                            <div class="h-full bg-[#ff6600] transition-all duration-300" :style="'width: ' + progress + '%'"></div>
                                        </div>
                                        <span class="text-[8px] font-black text-[#ff6600] uppercase">Cargando <span x-text="progress"></span>%</span>
                                    </div>
                                    @else
                                    {{-- ESTADO: CARGADO --}}
                                    <div class="bg-slate-50 border border-emerald-100 p-4 rounded-xl flex items-center justify-between shadow-sm animate-fade-in">
                                        <div class="flex items-center gap-3 truncate">
                                            <div class="h-8 w-8 bg-emerald-50 rounded-lg flex items-center justify-center text-emerald-500">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path d="M5 13l4 4L19 7" stroke-width="3" stroke-linecap="round" />
                                                </svg>
                                            </div>
                                            <span class="text-[9px] font-bold text-slate-600 truncate uppercase">
                                                {{ is_object($this->{$xls['model']}) ? $this->{$xls['model']}->getClientOriginalName() : 'Cargado' }}
                                            </span>
                                        </div>
                                        <button type="button"
                                            @click="isUploading = false; progress = 0; $wire.limpiarDocumento('{{ $xls['model'] }}')"
                                            class="text-slate-300 hover:text-red-500 transition-colors cursor-pointer">
                                            ✕
                                        </button>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            {{-- ERRORES --}}
                            @error($xls['model'])
                            <span class="text-red-500 text-[9px] font-bold block uppercase animate-fade-in mt-3 ml-1">{{ $message }}</span>
                            @enderror
                        </div>
                        @endforeach
                    </div>
                </section>

                {{-- BOTÓN FINALIZAR --}}
                <div class="flex flex-col items-center pt-10">
                    <button type="submit"

                        wire:loading.attr="disabled"
                        wire:target="guardar, buscarSocio"
                        class="px-20 py-7 bg-[#ff6600] text-white rounded-[2.5rem] font-outfit text-2xl font-900 uppercase transition-all shadow-2xl active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed">

                        {{-- Texto normal: se oculta si ocurre CUALQUIERA de las dos acciones --}}
                        <span wire:loading.remove wire:target="guardar, buscarSocio">
                            FINALIZAR INSCRIPCIÓN
                        </span>

                        {{-- Texto de carga: aparece si está guardando --}}
                        <span wire:loading wire:target="guardar">
                            PROCESANDO...
                        </span>

                        {{-- Texto de carga: aparece si está validando un socio --}}
                        <span wire:loading wire:target="buscarSocio">
                            VALIDANDO SOCIO...
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </main>
</div>