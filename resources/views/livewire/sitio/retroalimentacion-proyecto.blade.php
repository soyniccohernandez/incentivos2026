<div class="min-h-screen bg-black text-left antialiased">
    {{-- NAV --}}
    <nav class="fixed top-0 left-0 w-full z-[1000] flex justify-between items-center px-6 py-5 md:px-12 bg-black/95 border-b border-brand-border backdrop-blur-sm">
        <div class="flex items-center gap-8">
            <a href="/" class="font-bebas text-3xl text-brand-orange tracking-[2px] no-underline"> ACTORES S.C.G. </a>
            <span class="font-bebas text-xl text-gray-500 hidden md:block uppercase tracking-widest border-l border-brand-border pl-8"> 
                @if($proyecto->estado_id == 7) Resultado <span class="text-emerald-500">Seleccionado</span> @else Retroalimentación <span class="text-brand-orange">Técnica</span> @endif
            </span>
        </div>
        <a href="{{ route('inscritos.publico') }}" class="group flex items-center gap-3 text-gray-500 hover:text-white transition-colors no-underline">
            <span class="font-bold text-[10px] uppercase tracking-[3px]">Cerrar</span>
            <div class="p-2 border border-brand-border group-hover:border-brand-orange transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /> </svg>
            </div>
        </a>
    </nav>

    <main class="bg-black min-h-screen pt-32 pb-24 px-6">
        <div class="max-w-[1100px] mx-auto">
            
            @if($proyecto->estado_id == 7)
                {{-- --- DISEÑO PARA GANADOR (ESTADO 7) --- --}}
                <div class="relative mb-12 bg-emerald-950/20 border border-emerald-500/30 p-8 md:p-12 overflow-hidden shadow-[0_0_50px_rgba(16,185,129,0.1)]">
                    <div class="absolute -top-10 -right-10 w-64 h-64 bg-emerald-500/10 blur-[100px] rounded-full"></div>
                    
                    <header class="relative z-10">
                        <div class="inline-block px-4 py-1 bg-emerald-600 text-white font-bold text-[10px] uppercase tracking-[4px] mb-6">
                            PROYECTO SELECCIONADO
                        </div>
                        <h1 class="font-bebas text-[clamp(2.5rem,7vw,5rem)] leading-none mb-4 text-white uppercase italic">
                            ¡FELICITACIONES, <span class="text-emerald-500">GANADOR</span>!
                        </h1>
                        <h2 class="font-bebas text-3xl text-gray-300 mb-8 tracking-wide">{{ $proyecto->titulo }}</h2>
                        
                        <div class="max-w-2xl bg-black/40 p-6 border-l-4 border-emerald-500">
                            <p class="text-gray-200 text-lg leading-relaxed">
                                Nos complace informarte que tu proyecto ha superado con éxito todas las etapas de evaluación técnica y administrativa. 
                                <br><br>
                                <strong class="text-emerald-400">¿Qué sigue ahora?</strong> El equipo de ACTORES S.C.G. se pondrá en contacto contigo a través de los datos registrados en tu perfil para iniciar el proceso de formalización del incentivo.
                            </p>
                        </div>
                    </header>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                    <div class="bg-brand-surface border border-brand-border p-8 flex flex-col justify-center">
                        <span class="text-gray-500 text-[10px] uppercase font-bold tracking-widest mb-2">Código de Radicado</span>
                        <span class="text-emerald-500 font-bebas text-4xl">{{ $proyecto->codigo_radicado }}</span>
                    </div>
                    <div class="md:col-span-2 bg-brand-surface border border-brand-border p-8">
                        <h3 class="font-bebas text-2xl text-white mb-4 tracking-widest uppercase">Nota de Selección</h3>
                        <p class="text-gray-400 italic">"{{ $proyecto->observacion_general ?: 'Su proyecto ha sido seleccionado por su alto impacto y cumplimiento normativo.' }}"</p>
                    </div>
                </div>

            @else
                {{-- --- DISEÑO PARA RECHAZADO / ELIMINADO (ESTADO 8, 9) --- --}}
                <header class="mb-12 border-l-4 border-red-600 pl-6">
                    <div class="text-red-500 font-bold text-sm uppercase tracking-[3px] mb-2"> 
                        Estado: {{ $proyecto->estado->nombre }} 
                    </div>
                    <h1 class="font-bebas text-[clamp(2.5rem,6vw,4.5rem)] leading-none mb-4 text-white uppercase"> 
                        {{ $proyecto->titulo }} 
                    </h1>
                    <p class="text-gray-400 text-sm uppercase tracking-widest max-w-2xl leading-relaxed"> 
                        A continuación se detallan los hallazgos que motivaron esta decisión. 
                    </p>
                </header>

                <div class="bg-brand-surface border border-brand-border p-8 md:p-10 mb-12">
                    <h3 class="font-bebas text-3xl tracking-wider text-brand-orange uppercase mb-6">Dictamen Técnico</h3>
                    <div class="bg-black/50 p-6 border-l-2 border-brand-orange">
                        <p class="text-white font-medium leading-relaxed whitespace-pre-wrap">
                            {{ $proyecto->observacion_general ?: 'No se registró una observación general.' }}
                        </p>
                    </div>
                </div>

                @if($proyecto->documentos->whereIn('estado', ['rechazado', 'subsanar'])->count() > 0)
                    <h3 class="font-bebas text-4xl text-white mt-8 mb-4 uppercase tracking-widest">Detalle de Hallazgos</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($proyecto->documentos as $doc)
                            @php $ultimaObs = $doc->observaciones->last(); @endphp
                            @if($doc->estado === 'rechazado' || $doc->estado === 'subsanar')
                                <div class="bg-brand-surface border border-brand-border p-6 hover:border-red-500/50 transition-colors">
                                    <div class="flex items-center gap-3 mb-4">
                                        <div class="w-2 h-2 rounded-full bg-red-600"></div>
                                        <h4 class="font-bebas text-2xl text-white tracking-wide uppercase">{{ $doc->tipoDocumento->nombre }}</h4>
                                    </div>
                                    <div class="text-gray-400 text-xs leading-relaxed italic border-t border-brand-border/30 pt-4">
                                        "{{ $ultimaObs ? $ultimaObs->mensaje : 'Documento no cumple con los requisitos técnicos.' }}"
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endif
            @endif

            {{-- FOOTER COMÚN --}}
            <div class="mt-20 p-10 border-2 border-dashed border-brand-border text-center">
                <p class="text-gray-500 text-[10px] font-black uppercase tracking-[4px]">
                    ACTORES SOCIEDAD COLOMBIANA DE GESTIÓN — CONVOCATORIA 2026
                </p>
            </div>
        </div>
    </main>
</div>