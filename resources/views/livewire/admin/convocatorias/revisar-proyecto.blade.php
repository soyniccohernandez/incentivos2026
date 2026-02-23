<div class="min-h-screen bg-[#f8fafc] font-inter pb-20 pt-10" x-data="{ etapaAbierta: {{ $proyecto->etapa_id }} }">
    {{-- Tipografías --}}
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@600;800;900&display=swap');
        .font-outfit { font-family: 'Outfit', sans-serif; }
        .font-inter { font-family: 'Inter', sans-serif; }
        /* Efecto de elevación suave premium */
        .premium-shadow { shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.04), 0 8px 10px -6px rgba(0, 0, 0, 0.04); }
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

                <div class="shrink-0 flex items-center gap-6 bg-slate-50/50 p-6 rounded-[2rem] border border-slate-100">
                    <div class="text-right hidden md:block">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[2px] mb-1">Titular Responsable</p>
                        <p class="font-outfit text-xl font-800 text-slate-700 uppercase leading-none">
                            {{ $proyecto->user->name ?? 'Usuario no definido' }}
                        </p>
                    </div>
                    <div class="h-16 w-16 rounded-2xl bg-white flex items-center justify-center text-[#ff6600] font-outfit text-2xl font-800 shadow-sm border border-slate-100">
                        {{ mb_substr($proyecto->user->name ?? 'U', 0, 2) }}
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
                            @if($etapaId == 1)
                                <div class="bg-gradient-to-r from-orange-500 to-[#ff6600] rounded-[2rem] p-8 text-white flex items-center gap-6 shadow-lg shadow-orange-200">
                                    <div class="h-14 w-14 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-md">
                                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" stroke-width="2" /></svg>
                                    </div>
                                    <div>
                                        <p class="text-[10px] font-bold text-orange-100 uppercase tracking-widest opacity-80">Director Asignado</p>
                                        <h3 class="font-outfit text-2xl font-800 uppercase leading-none mt-1">{{ $proyecto->director->nombre ?? 'Sin asignar' }}</h3>
                                    </div>
                                </div>
                            @endif

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
                                @php $docActual = $versiones->sortByDesc('version')->first(); @endphp
                                <div class="bg-white rounded-[2rem] border border-slate-100 p-8 shadow-sm hover:border-[#ff6600]/30 transition-all">
                                    <div class="flex flex-col md:flex-row justify-between items-start gap-6">
                                        <div class="flex-1">
                                            <p class="text-[10px] font-bold text-[#ff6600] uppercase tracking-[2px] mb-2">Archivo Técnico</p>
                                            <h4 class="font-outfit text-xl font-800 text-slate-700 uppercase leading-tight">{{ $docActual->tipoDocumento->nombre }}</h4>
                                            
                                            <div class="flex items-center gap-4 mt-6">
                                                <a href="{{ asset('storage/' . $docActual->ruta_archivo) }}" target="_blank" 
                                                   class="inline-flex items-center gap-2 px-6 py-3 bg-slate-50 text-slate-700 rounded-xl text-[11px] font-bold uppercase tracking-widest hover:bg-orange-50 hover:text-[#ff6600] transition-all border border-slate-100">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" stroke-width="2"/><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" stroke-width="2"/></svg>
                                                    VER VERSIÓN {{ $docActual->version }}
                                                </a>
                                                <label class="cursor-pointer group">
                                                    <input type="file" wire:model="archivoSustituto.{{ $tipoId }}" class="hidden">
                                                    <span class="text-[11px] font-bold text-slate-400 group-hover:text-slate-600 uppercase tracking-widest underline decoration-slate-200">Reemplazar</span>
                                                </label>
                                            </div>
                                        </div>
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

                    <div class="space-y-6">
                        <div>
                            <label class="text-[11px] font-bold text-slate-400 uppercase tracking-[2px] mb-3 block ml-1">Cambiar Estado</label>
                            <div class="relative">
                                <select wire:model="nuevoEstadoId" class="w-full bg-slate-50 border border-slate-100 rounded-2xl p-4 text-slate-700 font-bold text-sm focus:ring-2 focus:ring-orange-100 focus:border-[#ff6600] outline-none appearance-none cursor-pointer transition-all">
                                    @foreach($estados as $est)
                                        <option value="{{ $est->id }}">{{ $est->nombre }}</option>
                                    @endforeach
                                </select>
                                <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" /></svg>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="text-[11px] font-bold text-slate-400 uppercase tracking-[2px] mb-3 block ml-1">Observaciones del Auditor</label>
                            <textarea wire:model.lazy="comentarioCierre" 
                                class="w-full bg-slate-50 border border-slate-100 rounded-[2rem] p-6 text-slate-700 text-sm min-h-[220px] focus:ring-2 focus:ring-orange-100 focus:border-[#ff6600] outline-none transition-all placeholder:text-slate-300"
                                placeholder="Escriba aquí los comentarios técnicos..."></textarea>
                        </div>

                        <div class="space-y-3 pt-4">
                            <button wire:click="guardarBorrador" class="w-full py-4 bg-white text-slate-400 hover:text-slate-600 rounded-2xl font-bold text-[11px] uppercase tracking-widest transition-all border border-slate-100">
                                Guardar como Borrador
                            </button>
                            
                            <button wire:click="finalizarRevisionManual" class="w-full py-6 bg-[#ff6600] text-white rounded-2xl font-outfit text-lg font-800 uppercase tracking-widest shadow-lg shadow-orange-200 hover:bg-[#e65c00] hover:-translate-y-0.5 transition-all">
                                Finalizar Revisión
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
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </div>
                {{ session('message') }}
            </div>
        </div>
    @endif
</div>