<div class="min-h-screen bg-black text-left antialiased">
    {{-- NAV --}}
    <nav class="fixed top-0 left-0 w-full z-[1000] flex justify-between items-center px-6 py-5 md:px-12 bg-black border-b border-brand-border">
        <div class="flex items-center gap-8">
            <a href="/" class="font-bebas text-3xl text-brand-orange no-underline tracking-[2px]">ACTORES S.C.G.</a>
            <span class="font-bebas text-xl text-gray-500 hidden md:block uppercase tracking-widest border-l border-brand-border pl-8">
                Panel de <span class="text-brand-orange">Proponente</span>
            </span>
        </div>
        <a href="{{ route('inscritos.publico') }}" class="group flex items-center gap-3 text-gray-500 hover:text-white transition-colors no-underline">
            <span class="font-bold text-[10px] uppercase tracking-[3px]">Volver al Inicio</span>
            <div class="p-2 border border-brand-border group-hover:border-brand-orange transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M10 19l-7-7m0 0l7-7m-7 7h18" stroke-width="2" />
                </svg>
            </div>
        </a>
    </nav>

    <main class="pt-32 pb-24 px-6">
        <div class="max-w-[1100px] mx-auto">

            {{-- SECCIÓN 1: EL VEREDICTO (Dinámico según estado) --}}
            @php
            $esEliminado = str_contains(strtolower($proyecto->estado->nombre), 'eliminado') || str_contains(strtolower($proyecto->estado->nombre), 'rechazado');
            $colorPrincipal = $esEliminado ? 'rose-600' : 'brand-orange';
            $bgCaja = $esEliminado ? 'bg-rose-950/20' : 'bg-brand-surface';
            @endphp

            <header class="mb-12 border-l-4 border-{{ $colorPrincipal }} pl-6">
                <div class="text-{{ $colorPrincipal }} font-bold text-sm uppercase tracking-[3px] mb-2 inline-flex items-center gap-2">
                    @if($esEliminado)
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                    Comunicado de Exclusión
                    @else
                    <span class="relative flex h-3 w-3">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-brand-orange opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-brand-orange"></span>
                    </span>
                    Observaciones del Equipo Técnico
                    @endif
                </div>
                <h1 class="font-bebas text-[clamp(2.5rem,6vw,4.5rem)] leading-none mb-6 text-white uppercase italic">
                    {{ $proyecto->titulo }}
                </h1>

                <div class="{{ $bgCaja }} border border-{{ $colorPrincipal }}/30 p-8 md:p-12 shadow-xl">
                    <p class="text-gray-500 text-[10px] font-black uppercase tracking-[4px] mb-6">Dictamen Oficial:</p>
                    <div class="text-white font-medium text-lg md:text-xl leading-relaxed whitespace-pre-line italic font-serif">
                        "{{ $proyecto->observacion_general ?: 'El proyecto se encuentra en proceso de revisión técnica.' }}"
                    </div>
                </div>
            </header>

            {{-- SECCIÓN 2: INSTRUCCIONES (Solo si no está eliminado) --}}
            @if(!$esEliminado)
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
                {{-- BLOQUE DE ACCIÓN IZQUIERDO --}}
                <div class="md:col-span-2 bg-white p-10 flex flex-col justify-center relative overflow-hidden">
                    <div class="relative z-10">
                        <h2 class="font-bebas text-4xl text-black mb-6 uppercase tracking-tight">¿Cómo subsanar estos hallazgos?</h2>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 mb-8">
                            {{-- CANAL 1: DOCUMENTOS --}}
                            <div class="space-y-3">
                                <p class="text-gray-400 font-black text-[9px] uppercase tracking-[2px]">Para corrección de documentos:</p>
                                <div class="bg-black text-brand-orange font-bebas text-2xl px-6 py-3 tracking-wider text-center border-l-4 border-brand-orange shadow-lg">
                                    incentivos@actores.org.co
                                </div>
                                <p class="text-gray-500 text-[11px] font-bold italic leading-tight">
                                    Envía los archivos pendientes o corregidos para avanzar en el proceso.
                                </p>
                            </div>

                            {{-- CANAL 2: DATOS --}}
                            <div class="space-y-3">
                                <p class="text-gray-400 font-black text-[9px] uppercase tracking-[2px]">Para actualizar información/datos:</p>
                                <div class="bg-gray-100 text-black font-bebas text-2xl px-6 py-3 tracking-wider text-center border-l-4 border-black">
                                    socios@actores.org.co
                                </div>
                                <p class="text-gray-500 text-[11px] font-bold italic leading-tight">
                                    Si requieres modificar nombres, identificación o datos de perfil.
                                </p>
                            </div>
                        </div>

                        {{-- REFERENCIA DE ASUNTO (ESTRUCTURA SUGERIDA) --}}
                        <div class="bg-gray-50 border border-gray-200 p-6 rounded-sm">
                            <div class="flex items-center gap-3 mb-2">
                                <div class="h-2 w-2 rounded-full bg-brand-orange animate-pulse"></div>
                                <span class="text-gray-400 font-black text-[10px] uppercase tracking-widest">Utiliza este Asunto en tu correo:</span>
                            </div>
                            <div class="font-mono text-[13px] md:text-sm font-bold text-black bg-white border border-dashed border-gray-300 p-3 select-all cursor-copy flex justify-between items-center group">
                                <span>
                                    Subsanación Etapa {{ $proyecto->etapa_id }} - {{ $proyecto->codigo_radicado }} - {{ Str::upper($proyecto->titulo) }}
                                </span>
                                <svg class="w-4 h-4 text-gray-300 group-hover:text-brand-orange transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- BLOQUE DE ESTADO DERECHO --}}
                <div class="bg-brand-surface border border-brand-border p-10 flex flex-col items-center justify-center text-center">
                    <p class="text-gray-500 text-[10px] font-black uppercase tracking-widest mb-4">Estado Actual</p>
                    <div class="font-bebas text-4xl text-white tracking-widest px-6 py-2 border border-brand-orange/50 mb-4">
                        {{ $proyecto->estado->nombre }}
                    </div>
                    <p class="text-[9px] font-black text-gray-500 uppercase tracking-widest leading-tight">
                        Última actualización: <br>
                        <span class="text-white font-mono uppercase">{{ $proyecto->updated_at->format('d/m/Y - H:i') }}</span>
                    </p>
                </div>
            </div>
            @endif

            {{-- SECCIÓN 3: EXPEDIENTE AGRUPADO POR ETAPAS --}}
            <div class="space-y-20">
                @foreach($documentosPorEtapa as $etapaId => $documentosDeEstaEtapa)
                <div>
                    <h3 class="font-bebas text-3xl text-white mb-8 uppercase tracking-[5px] flex items-center gap-4">
                        <span class="text-brand-orange">Etapa {{ $etapaId }}</span>
                        <div class="h-px bg-brand-border flex-1"></div>
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($documentosDeEstaEtapa->groupBy('tipo_documento_id') as $tipoId => $versiones)
                        @php
                        $todasLasVersiones = $versiones->sortBy('version');
                        $ultimaVersion = $todasLasVersiones->last();
                        $tieneSubsanacion = $todasLasVersiones->count() > 1;
                        @endphp

                        <div class="bg-brand-surface border {{ $tieneSubsanacion ? 'border-emerald-500/40' : 'border-brand-border' }} p-8 transition-all hover:border-gray-600 relative overflow-hidden">

                            {{-- Badge de Subsanado --}}
                            @if($tieneSubsanacion)
                            <div class="absolute top-0 right-0 bg-emerald-500 text-black font-black text-[8px] uppercase px-3 py-1 tracking-tighter">
                                Documento Subsanado
                            </div>
                            @endif

                            <div class="flex items-start justify-between mb-6">
                                <div class="min-w-0">
                                    <h4 class="font-bebas text-2xl text-white tracking-wide uppercase mb-1 truncate">
                                        {{ $ultimaVersion->tipoDocumento->nombre }}
                                    </h4>
                                    <div class="flex items-center gap-2">
                                        <span class="text-[9px] font-black {{ $tieneSubsanacion ? 'text-emerald-500' : 'text-gray-500' }} uppercase tracking-widest">
                                            {{ $tieneSubsanacion ? 'Revisión Completada' : 'Versión Original' }}
                                        </span>
                                    </div>
                                </div>
                                <div class="{{ $tieneSubsanacion ? 'text-emerald-500' : 'text-brand-orange' }}">
                                    @if($tieneSubsanacion)
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M5 13l4 4L19 7" stroke-width="3" />
                                    </svg>
                                    @else
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" stroke-width="2" />
                                    </svg>
                                    @endif
                                </div>
                            </div>

                            <div class="space-y-4">
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Trazabilidad de archivos:</p>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($todasLasVersiones as $v)
                                    <a href="{{ asset('storage/'.$v->ruta_archivo) }}" target="_blank"
                                        class="flex items-center gap-2 px-4 py-2 border {{ $loop->last ? 'border-brand-orange text-brand-orange bg-brand-orange/5' : 'border-brand-border text-gray-500 opacity-50 hover:opacity-100' }} transition-all no-underline group">
                                        <span class="font-bebas text-lg tracking-widest">V{{ $v->version }}</span>
                                        @if($loop->last)
                                        <span class="text-[8px] font-black uppercase px-1 bg-brand-orange text-black">Actual</span>
                                        @endif
                                    </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </main>
</div>