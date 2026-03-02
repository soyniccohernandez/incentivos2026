<div class="min-h-screen bg-[#f8fafc] font-inter pb-20 pt-10" x-data="{ etapaAbierta: {{ $proyecto->etapa_id }} }">
    {{-- Tipografías --}}
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@600;800;900&display=swap');

        .font-outfit {
            font-family: 'Outfit', sans-serif;
        }

        .font-inter {
            font-family: 'Inter', sans-serif;
        }

        /* Efecto de elevación suave premium */
        .premium-shadow {
            shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.04), 0 8px 10px -6px rgba(0, 0, 0, 0.04);
        }
    </style>

    <div class="max-w-7xl mx-auto px-6">
        {{-- 1. NAVEGACIÓN --}}
        <nav class="flex items-center gap-4 mb-8 text-[11px] font-bold uppercase tracking-[2px] text-slate-400">
            <a href="{{ route('dashboard') }}" wire:navigate class="hover:text-[#ff6600] transition-colors">INICIO</a>
            <span class="opacity-30">/</span>
            <a href="{{ route('admin.convocatorias.index') }}" wire:navigate class="hover:text-[#ff6600] transition-colors">CONVOCATORIAS</a>
            <span class="opacity-30">/</span>
            <a href="{{ route('convocatoria.gestionar', $proyecto->convocatoria_id) }}" wire:navigate class="hover:text-[#ff6600] transition-colors">POSTULACIONES</a>
            <span class="opacity-30">/</span>
            <span class="text-slate-600">REVISIÓN TÉCNICA</span>
        </nav>

        {{-- 2. HEADER DEL PROYECTO --}}
        <div class="mb-10 bg-white rounded-[2.5rem] p-10 border border-slate-100 shadow-sm relative overflow-hidden">
            <div class="absolute top-0 left-0 w-1.5 h-full bg-[#ff6600]"></div>
            <div class="relative z-10 flex flex-col lg:flex-row justify-between items-center gap-8">
                <div class="flex-1 text-center lg:text-left">
                    <span class="inline-block px-4 py-1.5 bg-orange-50 text-[#ff6600] text-[10px] font-bold uppercase tracking-[3px] rounded-full mb-4 border border-orange-100">
                        RADICADO: {{ $proyecto->codigo_radicado }}
                    </span>
                    <h1 class="font-outfit text-4xl md:text-5xl font-800 text-slate-800 tracking-tight leading-none uppercase mb-2">
                        {{ $proyecto->titulo }}
                    </h1>
                    <p class="text-slate-400 font-medium text-xs uppercase tracking-[4px]">Expediente de Auditoría Administrativa</p>
                </div>

                <div class="shrink-0 flex items-center gap-8 bg-slate-50/50 p-6 rounded-[2.5rem] border border-slate-100 shadow-sm">
                    {{-- Bloque de Información --}}
                    <div class="text-right hidden lg:flex flex-col gap-3">
                        {{-- Nombre y ID --}}
                        <div>
                            <div class="flex items-center justify-end gap-2 mb-1">
                                <span class="px-2 py-0.5 bg-slate-200/50 text-slate-500 rounded-md text-[9px] font-black uppercase tracking-widest">
                                    ID: {{ $proyecto->user->identificacion }}
                                </span>
                                <p class="text-[9px] font-bold text-slate-400 uppercase tracking-[2px]">Socio proponente</p>
                            </div>
                            <h3 class="font-outfit text-2xl font-800 text-slate-800 uppercase leading-none tracking-tight">
                                {{ $proyecto->user->name ?? 'Usuario no definido' }}
                            </h3>
                        </div>

                        {{-- Datos de Contacto --}}
                        <div class="flex items-center justify-end gap-5">
                            {{-- Teléfono --}}
                            <div class="flex items-center gap-2">
                                <p class="text-[11px] font-bold text-slate-500 font-inter">{{ $proyecto->user->telefono ?? 'S/N' }}</p>
                                <div class="text-[#ff6600] opacity-70">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1" stroke-width="2" />
                                    </svg>
                                </div>
                            </div>

                            {{-- Separador vertical sutil --}}
                            <div class="h-3 w-px bg-slate-200"></div>

                            {{-- Email --}}
                            <div class="flex items-center gap-2">
                                <p class="text-[11px] font-bold text-slate-500 font-inter lowercase">{{ $proyecto->user->email ?? 'S/C' }}</p>
                                <div class="text-[#ff6600] opacity-70">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" stroke-width="2" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Avatar Limpio --}}
                    <div class="h-16 w-16 rounded-2xl bg-white border border-slate-100 shadow-sm flex items-center justify-center overflow-hidden shrink-0">
                        @if($foto_url)
                        <img src="{{ $foto_url }}"
                            class="w-full h-full object-cover"
                            alt="Foto Titular">
                        @else
                        <div class="w-full h-full bg-slate-50 flex items-center justify-center shadow-inner">
                            <span class="font-outfit text-2xl font-800 text-[#ff6600] tracking-tighter uppercase">
                                {{ $iniciales }}
                            </span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
            {{-- SECCIÓN IZQUIERDA: DOCUMENTOS --}}
            <div class="lg:col-span-7 space-y-6">
                @foreach($documentosPorEtapa as $etapaId => $documentosDeEstaEtapa)
                <div class="space-y-4">
                    <button @click="etapaAbierta = (etapaAbierta === {{ $etapaId }} ? null : {{ $etapaId }})"
                        class="w-full flex items-center justify-between px-8 py-6 bg-white border border-slate-100 rounded-[2rem] hover:border-[#ff6600]/50 transition-all group shadow-sm">
                        <div class="flex items-center gap-5">
                            <div class="h-10 w-10 rounded-xl bg-orange-50 flex items-center justify-center text-[#ff6600] text-xs font-bold border border-orange-100">
                                {{ $etapaId }}
                            </div>
                            <span class="font-outfit text-lg font-800 text-slate-700 uppercase tracking-tight">Etapa {{ $etapaId }}</span>
                        </div>
                        <svg class="w-5 h-5 text-slate-300 transition-transform duration-300" :class="etapaAbierta === {{ $etapaId }} ? 'rotate-180 text-[#ff6600]' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M19 9l-7 7-7-7" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>

                    <div x-show="etapaAbierta === {{ $etapaId }}" x-collapse class="space-y-4 px-2">
                        {{-- Bloque Director --}}
                        @if($etapaId == 1 && $proyecto->director)
                        <div class="bg-gradient-to-r from-orange-500 to-[#ff6600] rounded-[2.5rem] p-8 text-white shadow-lg shadow-orange-200 relative overflow-hidden">
                            {{-- Decoración de fondo (Icono gigante sutil) --}}
                            <div class="absolute -right-4 -bottom-4 opacity-10 pointer-events-none">
                                <svg class="w-40 h-40" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                                </svg>
                            </div>

                            <div class="relative z-10">
                                <div class="flex flex-col md:flex-row md:items-center gap-6">
                                    {{-- Icono Principal --}}
                                    <div class="h-16 w-16 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-md shrink-0 border border-white/30">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" stroke-width="2" />
                                        </svg>
                                    </div>

                                    <div class="flex-1">
                                        <div class="flex flex-wrap items-center gap-3">
                                            <p class="text-[10px] font-bold text-orange-100 uppercase tracking-[4px] opacity-90">Director Asignado</p>
                                            @if($proyecto->director->es_proponente)
                                            <span class="bg-white/20 px-2 py-0.5 rounded text-[9px] font-black uppercase tracking-widest border border-white/20">Es Proponente</span>
                                            @endif
                                        </div>
                                        <h3 class="font-outfit text-3xl font-800 uppercase leading-tight mt-1">{{ $proyecto->director->nombre }}</h3>
                                    </div>
                                </div>

                                {{-- Fila de Datos Secundarios --}}
                                <div class="mt-8 grid grid-cols-1 sm:grid-cols-3 gap-4 border-t border-white/20 pt-6">

                                    {{-- Dato: Identificación --}}
                                    <div class="flex items-center gap-3 bg-white/10 p-3 rounded-2xl backdrop-blur-sm border border-white/10">
                                        <div class="text-orange-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1" stroke-width="2" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-[8px] font-bold text-orange-100 uppercase opacity-70">Identificación</p>
                                            <p class="text-sm font-bold">{{ $proyecto->director->identificacion }}</p>
                                        </div>
                                    </div>

                                    {{-- Dato: Celular --}}
                                    <div class="flex items-center gap-3 bg-white/10 p-3 rounded-2xl backdrop-blur-sm border border-white/10">
                                        <div class="text-orange-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1" stroke-width="2" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-[8px] font-bold text-orange-100 uppercase opacity-70">Teléfono</p>
                                            <p class="text-sm font-bold">{{ $proyecto->director->celular ?? 'N/A' }}</p>
                                        </div>
                                    </div>

                                    {{-- Dato: Correo --}}
                                    <div class="flex items-center gap-3 bg-white/10 p-3 rounded-2xl backdrop-blur-sm border border-white/10">
                                        <div class="text-orange-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" stroke-width="2" />
                                            </svg>
                                        </div>
                                        <div class="min-w-0">
                                            <p class="text-[8px] font-bold text-orange-100 uppercase opacity-70">Email</p>
                                            <p class="text-xs font-bold truncate lowercase">{{ $proyecto->director->correo }}</p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        @endif

                        {{-- Bloque Origen del Guion (Vibrante) --}}
                        <div class="bg-gradient-to-r from-indigo-600 to-blue-500 rounded-[2.5rem] p-8 text-white shadow-lg shadow-indigo-200 relative overflow-hidden group mt-4 transition-all hover:translate-y-[-2px]">
                            {{-- Decoración sutil de fondo mejorada --}}
                            <div class="absolute -right-6 -bottom-6 text-white opacity-10 group-hover:scale-110 transition-transform duration-500 pointer-events-none">
                                <svg class="w-48 h-48" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" stroke-width="2" />
                                </svg>
                            </div>

                            <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-6">
                                <div class="flex items-center gap-6">
                                    {{-- Icono Principal con efecto Glassmorphism --}}
                                    <div class="shrink-0 h-16 w-16 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-md border border-white/30 shadow-inner">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" stroke-width="2" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-[10px] font-bold text-indigo-100 uppercase tracking-[4px] opacity-90 mb-1">Origen del Libreto</p>
                                        <h4 class="font-outfit text-3xl font-800 text-white uppercase leading-none tracking-tight">
                                            {{ $proyecto->guion_propio ? 'Autoría Propia' : 'Guion de Tercero' }}
                                        </h4>
                                    </div>
                                </div>

                                {{-- Badge de estado inteligente y vibrante --}}
                                @if($proyecto->guion_propio)
                                <div class="px-6 py-2.5 rounded-full bg-emerald-500 text-white border border-emerald-400 text-[10px] font-black uppercase tracking-widest shadow-md shadow-emerald-200/50 flex items-center gap-2">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M5 13l4 4L19 7" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    Titular es el autor
                                </div>
                                @else
                                <div class="px-6 py-2.5 rounded-full bg-white text-indigo-700 border border-slate-100 text-[10px] font-black uppercase tracking-widest shadow-md flex items-center gap-2">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" stroke-width="2" />
                                    </svg>
                                    Requiere Revisión Legal
                                </div>
                                @endif
                            </div>
                        </div>

                        {{-- Bloque Elenco --}}
                        @if($etapaId == 2)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @forelse($proyecto->users as $miembro)
                            <div class="bg-white border border-slate-100 rounded-[2rem] p-6 flex items-center gap-4 shadow-sm hover:shadow-md transition-shadow">
                                <div class="h-12 w-12 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400 font-bold border border-slate-100">
                                    {{ mb_substr($miembro->name, 0, 2) }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-sm font-bold text-slate-700 uppercase truncate">{{ $miembro->name }}</h4>
                                    <p class="text-[10px] text-slate-400 font-medium tracking-wider">ID: {{ $miembro->identificacion }}</p>
                                </div>
                            </div>
                            @empty
                            <div class="col-span-full p-10 text-center bg-white rounded-[2rem] border border-dashed border-slate-200">
                                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">No hay registros</p>
                            </div>
                            @endforelse
                        </div>
                        @endif

                        {{-- Documentos Estándar --}}
                        @foreach($documentosDeEstaEtapa->groupBy('tipo_documento_id') as $tipoId => $versiones)
                        @php
                        // Ordenamos para sacar el actual y los anteriores
                        $todasLasVersiones = $versiones->sortByDesc('version');
                        $docActual = $todasLasVersiones->first();
                        $versionesAnteriores = $todasLasVersiones->skip(1); // El resto son el historial
                        @endphp

                        <div class="bg-white rounded-[2rem] border border-slate-100 p-8 shadow-sm hover:border-[#ff6600]/30 transition-all">
                            <div class="flex flex-col gap-6">
                                <div class="flex-1">
                                    <p class="text-[10px] font-bold text-[#ff6600] uppercase tracking-[2px] mb-2">Archivo Técnico</p>
                                    <h4 class="font-outfit text-xl font-800 text-slate-700 uppercase leading-tight">{{ $docActual->tipoDocumento->nombre }}</h4>

                                    {{-- ACCIÓN PRINCIPAL: VER ACTUAL Y REEMPLAZAR --}}
                                    <div class="mt-6 flex flex-wrap items-center gap-4">
                                        <a href="{{ asset('storage/' . $docActual->ruta_archivo) }}" target="_blank"
                                            class="inline-flex items-center gap-2 px-6 py-3 bg-slate-50 text-slate-700 rounded-xl text-[11px] font-bold uppercase tracking-widest hover:bg-orange-50 hover:text-[#ff6600] transition-all border border-slate-100">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" stroke-width="2" />
                                                <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" stroke-width="2" />
                                            </svg>
                                            VER ACTUAL (V{{ $docActual->version }})
                                        </a>

                                        <label class="cursor-pointer group relative">
                                            <input type="file" wire:model="archivoSustituto.{{ $tipoId }}" class="hidden">
                                            <span wire:loading.remove wire:target="archivoSustituto.{{ $tipoId }}"
                                                class="text-[11px] font-bold text-slate-400 group-hover:text-[#ff6600] uppercase tracking-widest underline decoration-slate-200 transition-colors">
                                                Reemplazar
                                            </span>
                                            <span wire:loading wire:target="archivoSustituto.{{ $tipoId }}"
                                                class="text-[11px] font-bold text-[#ff6600] animate-pulse uppercase tracking-widest flex items-center gap-2">
                                                <svg class="animate-spin h-3 w-3" viewBox="0 0 24 24">
                                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"></circle>
                                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                </svg>
                                                Procesando...
                                            </span>
                                        </label>
                                    </div>

                                    @error('archivoSustituto.' . $tipoId)
                                    <p class="mt-2 text-[10px] text-red-500 font-bold uppercase tracking-tighter">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- HISTORIAL DE VERSIONES (Solo si existen versiones previas) --}}
                                @if($versionesAnteriores->count() > 0)
                                <div class="pt-6 border-t border-slate-50">
                                    <p class="text-[9px] font-bold text-slate-400 uppercase tracking-[1px] mb-3">Historial de archivos</p>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($versionesAnteriores as $ver)
                                        <a href="{{ asset('storage/' . $ver->ruta_archivo) }}" target="_blank"
                                            class="inline-flex items-center px-3 py-1.5 bg-slate-50 text-slate-500 rounded-lg text-[10px] font-medium border border-slate-100 hover:bg-slate-100 transition-colors">
                                            V{{ $ver->version }}
                                        </a>
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>

            {{-- PANEL DERECHA: DICTAMEN --}}
            <div class="lg:col-span-5">
                <div class="bg-white rounded-[2.5rem] p-10 shadow-xl shadow-slate-200/50 sticky top-10 border border-slate-100">
                    <div class="flex items-center justify-between mb-10">
                        <h2 class="font-outfit text-3xl font-800 text-slate-800 uppercase leading-none tracking-tight">Dictamen<br><span class="text-[#ff6600]">Técnico</span></h2>
                        <span class="px-4 py-1.5 rounded-full bg-slate-50 text-slate-500 text-[9px] font-bold uppercase tracking-widest border border-slate-100">
                            {{ $proyecto->publicado ? 'Estado: Público' : 'Estado: Oculto' }}
                        </span>
                    </div>

                    {{-- Alerta de Visibilidad para el Auditor --}}
                    <div class="mb-8 flex flex-col md:flex-row items-center gap-5 p-5 bg-blue-50/50 border border-blue-100 rounded-[2rem] transition-all hover:bg-blue-50">
                        <div class="flex-shrink-0 w-12 h-12 bg-blue-500/10 rounded-2xl flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </div>
                        <div class="flex-grow text-center md:text-left">
                            <h4 class="text-[11px] font-black text-blue-700 uppercase tracking-wider">Nota de Transparencia</h4>
                            <p class="text-[11px] text-blue-600/80 mt-1 leading-relaxed font-medium">
                                Ten en cuenta que tanto el <strong>estado final</strong> como las <strong>observaciones</strong> que redactes serán visibles para el proponente en su panel de usuario.
                            </p>
                        </div>
                    </div>

                    <div class="space-y-6">
                        {{-- Cambiar Estado --}}
                        <div>
                            <label class="text-[11px] font-bold text-slate-400 uppercase tracking-[2px] mb-3 block ml-1">Cambiar Estado</label>
                            <div class="relative">
                                <select wire:model="nuevoEstadoId"
                                    class="w-full bg-slate-50 border @error('nuevoEstadoId') border-red-500 @else border-slate-100 @enderror rounded-2xl p-4 text-slate-700 font-bold text-sm focus:ring-2 focus:ring-orange-100 focus:border-[#ff6600] outline-none appearance-none cursor-pointer transition-all">
                                    @foreach($estados as $est)
                                    <option value="{{ $est->id }}">{{ $est->nombre }}</option>
                                    @endforeach
                                </select>
                                <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M19 9l-7 7-7-7" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </div>
                            @error('nuevoEstadoId')
                            <span class="text-[10px] font-black text-red-500 uppercase tracking-widest mt-2 ml-2 block italic">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Observaciones --}}
                        <div>
                            <label class="text-[11px] font-bold text-slate-400 uppercase tracking-[2px] mb-3 block ml-1">Observaciones del Auditor</label>
                            <textarea wire:model.lazy="comentarioCierre"
                                class="w-full bg-slate-50 border @error('comentarioCierre') border-red-500 @else border-slate-100 @enderror rounded-[2rem] p-6 text-slate-700 text-sm min-h-[220px] focus:ring-2 focus:ring-orange-100 focus:border-[#ff6600] outline-none transition-all placeholder:text-slate-300"
                                placeholder="Escriba aquí los comentarios técnicos..."></textarea>

                            @error('comentarioCierre')
                            <div class="flex items-center gap-2 mt-3 ml-4 text-red-500">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-[10px] font-black uppercase tracking-widest italic">{{ $message }}</span>
                            </div>
                            @enderror
                        </div>

                        <div class="space-y-3 pt-4">
                            <button wire:click="guardarBorrador" class="w-full py-4 bg-white text-slate-400 hover:text-slate-600 rounded-2xl font-bold text-[11px] uppercase tracking-widest transition-all border border-slate-100 flex items-center justify-center gap-2">
                                <span wire:loading wire:target="guardarBorrador" class="animate-spin h-3 w-3 border-2 border-slate-300 border-t-slate-600 rounded-full"></span>
                                Guardar como Borrador
                            </button>

                            <button wire:click="finalizarRevisionManual"
                                class="w-full py-6 bg-[#ff6600] text-white rounded-2xl font-outfit text-lg font-800 uppercase tracking-widest shadow-lg shadow-orange-200 hover:bg-[#e65c00] hover:-translate-y-0.5 transition-all flex items-center justify-center gap-3">
                                <span wire:loading wire:target="finalizarRevisionManual" class="animate-spin h-5 w-5 border-3 border-white/30 border-t-white rounded-full"></span>
                                <span>Finalizar Revisión</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- NOTIFICACIONES --}}
    @if (session()->has('message'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" class="fixed bottom-10 right-10 z-50">
        <div class="bg-white border border-emerald-100 text-emerald-600 px-8 py-5 rounded-[2rem] font-bold text-[11px] uppercase tracking-widest shadow-2xl flex items-center gap-4">
            <div class="h-8 w-8 bg-emerald-50 rounded-full flex items-center justify-center">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M5 13l4 4L19 7" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
            {{ session('message') }}
        </div>
    </div>
    @endif
</div>