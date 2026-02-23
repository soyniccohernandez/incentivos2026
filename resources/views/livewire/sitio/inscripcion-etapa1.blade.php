<div class="min-h-screen bg-black text-left" x-data="{ showExitModal: false }" wire:poll.10s>

    {{-- NAV PREMIUM INTEGRADO - VERSIÓN BLACK --}}
    <nav x-data="{ dropdownOpen: false }" class="bg-black border-b border-white/10 sticky top-0 z-[1000] antialiased">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@600;800;900&display=swap');

            .font-outfit {
                font-family: 'Outfit', sans-serif;
            }

            .font-inter {
                font-family: 'Inter', sans-serif;
            }
        </style>

        <div class="max-w-7xl mx-auto px-6">
            <div class="flex justify-between h-20">

                {{-- LADO IZQUIERDO: Identidad Minimalista --}}
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

                    {{-- Indicador de Proceso --}}
                    <div class="hidden lg:flex items-center gap-3 ml-4 bg-white/[0.03] px-4 py-1.5 rounded-full border border-white/5">
                        <div class="w-1.5 h-1.5 bg-[#ff6600] rounded-full animate-pulse shadow-[0_0_8px_#ff6600]"></div>
                        <span class="font-inter text-[11px] font-bold text-gray-400 tracking-wider uppercase">Etapa 01: Inscripción</span>
                    </div>
                </div>

                {{-- LADO DERECHO: Usuario --}}
                <div class="flex items-center font-inter">
                    <div class="relative">
                        <button @click="dropdownOpen = !dropdownOpen"
                            class="flex items-center gap-3 px-2 py-1.5 hover:bg-white/5 transition-all duration-300 rounded-lg group">

                            {{-- Avatar Minimalista con Foto o Inicial --}}
                            <div class="w-9 h-9 bg-gradient-to-br from-[#ff6600] to-[#cc5200] rounded-lg flex items-center justify-center text-black font-outfit font-800 text-sm shadow-[0_0_15px_rgba(255,102,0,0.2)] overflow-hidden">
                                @php
                                // Buscamos la foto rápidamente para el NAV
                                $identificacion = auth()->user()->identificacion;
                                $fotoPath = null;

                                if ($identificacion) {
                                $archivos = Storage::disk('public')->files('socios');
                                $fotoEncontrada = collect($archivos)->first(function ($path) use ($identificacion) {
                                return str_contains(basename($path), (string)$identificacion);
                                });
                                if ($fotoEncontrada) {
                                $fotoPath = asset('storage/' . $fotoEncontrada);
                                }
                                }
                                @endphp

                                @if($fotoPath)
                                <img src="{{ $fotoPath }}" alt="Perfil" class="w-full h-full object-cover">
                                @else
                                {{ substr(auth()->user()->name, 0, 1) }}
                                @endif
                            </div>

                            <div class="text-left hidden sm:block">
                                <span class="text-sm font-700 text-white block leading-none">
                                    {{ auth()->user()->name }}
                                </span>
                                <span class="text-[9px] font-bold text-gray-500 uppercase tracking-wider mt-1 block">
                                    Acceso {{ Auth::user()->role === 'admin' ? 'Gestor' : 'Socio' }}
                                </span>
                            </div>

                            <svg class="w-4 h-4 text-gray-600 group-hover:text-white transition-colors" :class="dropdownOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        {{-- Dropdown Menú Limpio --}}
                        <div x-show="dropdownOpen"
                            @click.away="dropdownOpen = false"
                            x-transition:enter="transition ease-out duration-150"
                            x-transition:enter-start="opacity-0 translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            class="absolute right-0 mt-3 w-64 bg-[#0a0a0a] border border-white/10 shadow-[0_20px_50px_rgba(0,0,0,0.9)] rounded-xl overflow-hidden z-[1100]">

                            <div class="px-5 py-4 bg-white/[0.02] border-b border-white/5">
                                <p class="text-[9px] font-bold text-gray-500 uppercase tracking-widest mb-1">Usuario Conectado</p>
                                <p class="text-xs font-medium text-gray-300 truncate">{{ auth()->user()->email }}</p>
                            </div>

                            <div class="p-2 space-y-1">
                                <!-- <a href="{{ route('profile') }}" wire:navigate class="flex items-center gap-3 px-4 py-3 text-[13px] font-semibold text-gray-300 hover:text-white hover:bg-[#ff6600]/10 rounded-lg no-underline transition-all group">
                                    <svg class="w-4 h-4 text-[#ff6600] opacity-70 group-hover:opacity-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" stroke-width="2" />
                                    </svg>
                                    Mi Perfil
                                </a> -->

                                <button wire:click="logout" class="w-full flex items-center gap-3 text-left px-4 py-3 text-[13px] font-bold text-red-500/80 hover:text-red-500 hover:bg-red-500/5 rounded-lg transition-all border-t border-white/5 mt-1">
                                    <svg class="w-4 h-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" stroke-width="2" />
                                    </svg>
                                    Cerrar Sesión
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <main class="bg-black min-h-screen pt-16 pb-24 px-6 text-left">
        <div class="max-w-7xl mx-auto text-left">
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
                                @if($foto_url)
                                <img src="{{ $foto_url }}" class="w-full h-full object-cover">
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
                                        <p class="text-white font-bebas text-5xl md:text-6xl tracking-wide uppercase leading-none">{{ mb_strtoupper($socio->name) }}</p>
                                    </div>
                                    <div class="lg:text-right">
                                        <label class="block text-[10px] uppercase font-black text-gray-500 mb-2 tracking-[5px]">Identificación</label>
                                        <p class="text-white font-mono text-3xl tracking-tighter">{{ $socio->identificacion }}</p>
                                    </div>
                                </div>
                                <div class="relative pt-2 text-left">
                                    <label class="block text-[10px] uppercase font-black text-brand-orange mb-5 tracking-[6px]">Correo Electrónico de Notificación</label>
                                    <div class="bg-black border border-brand-orange px-8 py-5 inline-flex items-center gap-6">
                                        <p class="text-white font-bebas text-3xl md:text-5xl tracking-[3px] lowercase leading-none">{{ $socio->email }}</p>
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
                            @error('titulo')
                            <span class="text-red-500 text-[10px] mt-2 block uppercase font-bold text-left">{{ $message }}</span>
                            @enderror
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
                            @error($model)
                            <span class="text-red-500 text-[10px] mt-1 block uppercase font-bold text-left">{{ $message }}</span>
                            @enderror
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
                                        <button type="button" wire:click="$set('{{ $doc['model'] }}', null)" class="text-gray-600 hover:text-red-500"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg></button>
                                    </div>
                                    @endif
                                </div>
                                <div x-show="isUploading" class="w-full bg-gray-800 h-1.5 overflow-hidden rounded-full">
                                    <div class="bg-brand-orange h-full transition-all" :style="'width: ' + progress + '%'"></div>
                                </div>
                                @error($doc['model'])
                                <span class="text-red-500 text-[10px] block uppercase font-bold text-left">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        @endforeach
                    </div>
                </section>

                {{-- 3. GUION --}}
                <section class="bg-brand-surface border border-brand-border p-8 md:p-10 space-y-10 text-left">
                    <h2 class="font-bebas text-3xl text-brand-orange border-b border-brand-border pb-4 uppercase tracking-wider text-left">3. GUION</h2>
                    <div class="space-y-8">
                        <div class="bg-black/40 p-8 border border-brand-border text-left" x-data="{ isUploading: false, progress: 0 }">
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-[2px] mb-6 text-left">¿El guion es de tu autoría?</label>
                            <div class="flex gap-10 mb-8">
                                <label class="flex items-center gap-3 cursor-pointer group"><input type="radio" value="si" wire:model.live="autoria" class="w-5 h-5 accent-brand-orange"><span class="text-white font-bold uppercase text-sm">SÍ</span></label>
                                <label class="flex items-center gap-3 cursor-pointer group"><input type="radio" value="no" wire:model.live="autoria" class="w-5 h-5 accent-brand-orange"><span class="text-white font-bold uppercase text-sm">NO</span></label>
                            </div>
                            <div x-show="$wire.autoria === 'no'" x-transition x-cloak class="pt-8 border-t border-white/5" x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">
                                <div class="flex flex-col md:flex-row gap-8 items-end">
                                    <a href="{{ asset('storage/formatos/etapa_01_autorizacion_uso_guion_cia_2026.pdf') }}" target="_blank" class="bg-brand-orange text-black px-6 py-3 font-bold text-[10px] uppercase tracking-widest shadow-lg">Descargar Formato Guion</a>
                                    <div class="flex-1 w-full text-left">
                                        <label class="block text-[10px] uppercase font-bold text-gray-500 mb-2 tracking-widest">ANEXO 3. AUTORIZACIÓN USO DE GUION</label>
                                        <div class="relative group/input">
                                            @if(!$guionArchivo || $errors->has('guionArchivo'))
                                            <input type="file" wire:model="guionArchivo" accept=".pdf" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20">
                                            <div class="bg-black border border-brand-border px-4 py-3 text-[10px] text-gray-400 font-black uppercase tracking-widest flex items-center justify-between">
                                                <span>Seleccionar archivo</span>
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                                </svg>
                                            </div>
                                            @else
                                            <div class="bg-black border border-green-500/50 px-4 py-3 flex items-center justify-between">
                                                <span class="text-green-500 text-[9px] font-black uppercase tracking-widest">Cargado con éxito</span>
                                                <button type="button" wire:click="$set('guionArchivo', null)" class="text-gray-500 hover:text-red-500"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg></button>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- 4. CONSIDERACIONES --}}
                <section class="bg-brand-surface border border-brand-border p-8 md:p-10 space-y-8 text-left">
                    <h2 class="font-bebas text-3xl text-brand-orange border-b border-brand-border pb-4 uppercase tracking-wider text-left">4. CONSIDERACIONES Y DECLARACIONES GENERALES</h2>
                    <div class="bg-black/40 p-8 border border-brand-border text-left" x-data="{ isUploading: false, progress: 0 }">
                        <div class="flex flex-col md:flex-row gap-8 items-end mb-12 border-b border-white/5 pb-10 text-left">
                            <a href="{{ asset('storage/formatos/formato_declaraciones_2026.pdf') }}" target="_blank" class="bg-brand-orange text-black px-8 py-4 font-bold text-[11px] uppercase tracking-widest shadow-lg">Descargar Declaraciones</a>
                            <div class="flex-1 w-full text-left">
                                <label class="block text-[10px] uppercase font-bold text-gray-500 mb-2 tracking-widest">ANEXO 4. CONSIDERACIONES Y DECLARACIONES GENERALES</label>
                                <div class="relative group/input">
                                    @if(!$formatoFirmado || $errors->has('formatoFirmado'))
                                    <input type="file" wire:model="formatoFirmado" accept=".pdf" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20">
                                    <div class="bg-black border border-brand-border px-4 py-3 text-[10px] text-gray-400 font-black uppercase tracking-widest flex items-center justify-between">
                                        <span>Seleccionar archivo</span>
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                        </svg>
                                    </div>
                                    @else
                                    <div class="bg-black border border-green-500/50 px-4 py-3 flex items-center justify-between">
                                        <span class="text-green-500 text-[9px] font-black uppercase tracking-widest">Declaración Recibida</span>
                                        <button type="button" wire:click="$set('formatoFirmado', null)" class="text-gray-600 hover:text-red-500"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg></button>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="space-y-8 text-left">
                            <label class="flex items-start gap-5 cursor-pointer group"><input type="checkbox" wire:model.live="aceptaTerminos" class="mt-1 w-6 h-6 accent-brand-orange shrink-0"><span class="text-sm text-gray-300 leading-relaxed">Autorizo el tratamiento de mis datos personales de acuerdo con la Política de ACTORES S.C.G.</span></label>
                            @error('aceptaTerminos')
                            <span class="text-red-500 text-[10px] block uppercase font-bold">{{ $message }}</span>
                            @enderror
                            <label class="flex items-start gap-5 cursor-pointer group"><input type="checkbox" wire:model.live="aceptaDatos" class="mt-1 w-6 h-6 accent-brand-orange shrink-0"><span class="text-sm text-gray-300 leading-relaxed">Declaro que la información suministrada es veraz.</span></label>
                            @error('aceptaDatos')
                            <span class="text-red-500 text-[10px] block uppercase font-bold">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </section>

                <div class="text-center pt-10 pb-20 flex flex-col items-center">
                    <div class="max-w-[450px] w-full group relative">
                        <button type="submit" wire:loading.attr="disabled" class="w-full inline-flex items-center justify-center bg-brand-orange text-white font-bebas text-4xl hover:bg-white hover:text-black transition-all py-6 shadow-lg disabled:opacity-50">
                            <div class="flex items-center justify-center gap-4">
                                <span wire:loading.remove wire:target="guardar">FINALIZAR E INSCRIBIR</span>
                                <span wire:loading wire:target="guardar">ENVIANDO...</span>
                            </div>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </main>

    {{-- MODAL DE SALIDA --}}
    <div x-show="showExitModal" x-cloak class="fixed inset-0 z-[2000] flex items-center justify-center p-6 bg-black/90 backdrop-blur-md">
        <div class="bg-brand-surface border border-brand-border max-w-md w-full p-10 text-center shadow-2xl">
            <h3 class="font-bebas text-4xl text-white mb-4 uppercase">¿Abandonar Registro?</h3>
            <p class="text-gray-400 text-[11px] mb-8 uppercase tracking-widest">Los datos no guardados se perderán.</p>
            <div class="flex flex-col gap-4">
                <a href="/" class="w-full py-4 bg-red-600 text-white font-bebas text-2xl no-underline uppercase">SÍ, SALIR</a>
                <button @click="showExitModal = false" class="w-full py-4 border border-brand-border text-gray-500 font-bebas text-2xl uppercase">Seguir Editando</button>
            </div>
        </div>
    </div>
</div>