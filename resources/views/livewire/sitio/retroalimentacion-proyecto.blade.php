<div class="min-h-screen bg-black text-left antialiased">
    {{-- NAV --}}
    <nav class="fixed top-0 left-0 w-full z-[1000] flex justify-between items-center px-6 py-5 md:px-12 bg-black/95 border-b border-brand-border backdrop-blur-sm">
        <div class="flex items-center gap-8">
            <a href="/" class="font-bebas text-3xl text-brand-orange tracking-[2px] no-underline"> ACTORES S.C.G. </a>
            <span class="font-bebas text-xl text-gray-500 hidden md:block uppercase tracking-widest border-l border-brand-border pl-8"> 
                Retroalimentación <span class="text-brand-orange">Técnica</span> 
            </span>
        </div>
        <a href="{{ route('inscritos.publico') }}" class="group flex items-center gap-3 text-gray-500 hover:text-white transition-colors no-underline">
            <span class="font-bold text-[10px] uppercase tracking-[3px]">Volver</span>
            <div class="p-2 border border-brand-border group-hover:border-brand-orange transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </div>
        </a>
    </nav>

    <main class="bg-black min-h-screen pt-32 pb-24 px-6">
        <div class="max-w-[1100px] mx-auto">
            {{-- HEADER --}}
            <header class="mb-12 border-l-4 border-red-600 pl-6 text-left">
                <div class="text-red-500 font-bold text-sm uppercase tracking-[3px] mb-2"> 
                    Estado Final: {{ $proyecto->estado->nombre }} 
                </div>
                <h1 class="font-bebas text-[clamp(2.5rem,6vw,4.5rem)] leading-none mb-4 text-white uppercase"> 
                    {{ $proyecto->titulo }} 
                </h1>
                <p class="text-gray-400 text-sm uppercase tracking-widest max-w-2xl leading-relaxed">
                    A continuación, se detallan los hallazgos técnicos encontrados durante el proceso de auditoría que motivaron la decisión actual.
                </p>
            </header>

            <div class="grid grid-cols-1 gap-8">
                {{-- 1. OBSERVACIÓN GENERAL DEL AUDITOR --}}
                <div class="bg-brand-surface border border-brand-border p-8 md:p-10">
                    <h3 class="font-bebas text-3xl tracking-wider text-brand-orange uppercase mb-6">Dictamen General</h3>
                    <div class="bg-black/50 p-6 border-l-2 border-brand-orange">
                        <p class="text-white font-medium leading-relaxed whitespace-pre-wrap">
                            {{ $proyecto->observacion_general ?: 'No se registró una observación general.' }}
                        </p>
                    </div>
                </div>

                {{-- 2. DETALLE POR DOCUMENTOS RECHAZADOS --}}
                <h3 class="font-bebas text-4xl text-white mt-8 mb-4 uppercase tracking-widest">Hallazgos por Documento</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($proyecto->documentos as $doc)
                        @php 
                            $ultimaObs = $doc->observaciones->last();
                        @endphp
                        
                        @if($doc->estado === 'rechazado' || $doc->estado === 'subsanar' || $ultimaObs)
                            <div class="bg-brand-surface border border-brand-border p-6 hover:border-red-500/50 transition-colors">
                                <div class="flex items-center gap-3 mb-4">
                                    <div class="w-2 h-2 rounded-full bg-red-600"></div>
                                    <h4 class="font-bebas text-2xl text-white tracking-wide uppercase">{{ $doc->tipoDocumento->nombre }}</h4>
                                </div>
                                
                                <div class="text-gray-400 text-xs leading-relaxed italic border-t border-brand-border/30 pt-4">
                                    "{{ $ultimaObs ? $ultimaObs->mensaje : 'Sin observación específica cargada.' }}"
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            
            {{-- FOOTER DE AYUDA --}}
            <div class="mt-20 p-10 border-2 border-dashed border-brand-border text-center">
                <p class="text-gray-500 text-[10px] font-black uppercase tracking-[4px]">
                    Si tiene dudas sobre este dictamen, contacte a soporte técnico de la convocatoria.
                </p>
            </div>
        </div>
    </main>
</div>