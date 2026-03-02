<div class="min-h-screen bg-[#f1f5f9] text-slate-900 font-inter pb-20 pt-10">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@500;700;800;900&display=swap');
        .font-outfit { font-family: 'Outfit', sans-serif !important; }
        .font-inter { font-family: 'Inter', sans-serif !important; }
        input[type="datetime-local"] { color: #0f172a; }
    </style>

    <div class="max-w-7xl mx-auto px-6 space-y-12">
        {{-- NAVEGACIÓN --}}
        <nav class="flex items-center gap-4 mb-8 text-[11px] font-bold uppercase tracking-[2px] text-slate-400">
            <a href="{{ route('dashboard') }}" wire:navigate class="hover:text-[#ff6600] transition-colors"> INICIO </a>
            <span class="opacity-30">/</span>
            <a href="{{ route('admin.convocatorias.index') }}" wire:navigate class="hover:text-[#ff6600] transition-colors"> CONVOCATORIAS </a>
            <span class="opacity-30">/</span>
            <span class="text-slate-600 uppercase tracking-widest">Configuración</span>
        </nav>

        {{-- CABECERA --}}
        <div class="relative pl-8 py-2 mb-10">
            <div class="absolute left-0 top-0 h-full w-1.5 bg-slate-950 rounded-full"></div>
            <h2 class="font-outfit text-4xl md:text-5xl font-900 tracking-tight text-slate-950 leading-none uppercase">
                Configuración <span class="text-[#ff6600]">del Sistema</span>
            </h2>
            <p class="font-inter text-[13px] font-semibold text-slate-500 uppercase tracking-[4px] mt-3 opacity-70">
                Ajustes de tiempos: <span class="text-slate-900">{{ $nombreConvocatoria }}</span>
            </p>
        </div>

        <div class="space-y-10">
            {{-- SECCIÓN: ESTADO --}}
            <section class="bg-white rounded-[2.5rem] border border-slate-200/60 shadow-sm p-10 overflow-hidden relative">
                <div class="absolute top-0 left-0 w-full h-1.5 bg-orange-500"></div>
                
                <div class="flex items-center gap-4 mb-8">
                    <div class="bg-orange-50 p-3 rounded-2xl text-[#ff6600]">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M13 10V3L4 14h7v7l9-11h-7z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </div>
                    <h2 class="font-outfit text-xl font-800 uppercase tracking-tight text-slate-900">Estado de la Convocatoria</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach(['borrador', 'abierta', 'cerrada'] as $opcion)
                        <div wire:key="estado-{{ $opcion }}">
                            <label class="group relative flex flex-col p-6 border-2 rounded-[1.5rem] cursor-pointer transition-all duration-300 {{ $estadoConvocatoria === $opcion ? 'border-slate-950 bg-slate-50 shadow-inner' : 'border-slate-100 hover:border-orange-200 hover:bg-orange-50/30' }}">
                                <input type="radio" 
                                       wire:model.live="estadoConvocatoria" 
                                       value="{{ $opcion }}" 
                                       class="sr-only">
                                
                                <span class="text-[11px] font-black uppercase tracking-[2px] {{ $estadoConvocatoria === $opcion ? 'text-slate-950' : 'text-slate-400 group-hover:text-orange-500' }}">
                                    {{ $opcion }}
                                </span>

                                @if($estadoConvocatoria === $opcion)
                                    <div class="absolute top-4 right-4 w-2 h-2 rounded-full bg-[#ff6600] animate-pulse"></div>
                                @endif
                            </label>
                        </div>
                    @endforeach
                </div>
            </section>

            {{-- SECCIÓN: CRONOGRAMA --}}
            <section class="bg-white rounded-[2.5rem] border border-slate-200/60 shadow-sm overflow-hidden">
                <div class="p-10 bg-slate-950 text-white flex justify-between items-end">
                    <div>
                        <h2 class="font-outfit text-2xl font-800 uppercase tracking-tight text-[#ff6600]">Cronograma Maestro</h2>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mt-2 opacity-80">
                            Definición de periodos por etapa operativa
                        </p>
                    </div>
                    <div class="hidden md:block bg-white/10 px-4 py-2 rounded-xl border border-white/10 text-[9px] font-black text-orange-400 uppercase tracking-[2px]">
                        Configuración Estricta
                    </div>
                </div>

                <div class="p-10 space-y-8">
                    @foreach($etapas as $index => $etapa)
                        <div wire:key="etapa-{{ $etapa['id'] }}" class="group relative pl-12 pb-8 border-l-2 {{ $loop->last ? 'border-transparent' : 'border-slate-100' }}">
                            <div class="absolute -left-[9px] top-0 w-4 h-4 rounded-full bg-white border-4 border-slate-950 shadow-sm group-hover:border-[#ff6600] transition-colors"></div>
                            
                            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-center">
                                <div class="lg:col-span-4">
                                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1 block">Fase operativa</span>
                                    <h3 class="font-outfit text-xl font-800 text-slate-900 uppercase leading-none">{{ $etapa['nombre'] }}</h3>
                                </div>

                                <div class="lg:col-span-4">
                                    <div class="bg-slate-50 p-4 rounded-2xl border border-transparent focus-within:border-orange-200 transition-all">
                                        <label class="block text-[9px] font-black text-slate-400 uppercase tracking-widest mb-2">Apertura</label>
                                        <input type="datetime-local" wire:model="etapas.{{ $index }}.fecha_inicio" class="w-full bg-transparent border-none p-0 text-sm font-bold text-slate-900 focus:ring-0">
                                    </div>
                                </div>

                                <div class="lg:col-span-4">
                                    <div class="bg-slate-50 p-4 rounded-2xl border border-transparent focus-within:border-orange-200 transition-all">
                                        <label class="block text-[9px] font-black text-slate-400 uppercase tracking-widest mb-2">Cierre</label>
                                        <input type="datetime-local" wire:model="etapas.{{ $index }}.fecha_fin" class="w-full bg-transparent border-none p-0 text-sm font-bold text-slate-900 focus:ring-0">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            {{-- BOTÓN GUARDAR --}}
            <div class="flex justify-end pt-6">
                <button wire:click="guardar" wire:loading.attr="disabled" class="group relative overflow-hidden px-12 py-5 bg-slate-950 text-white rounded-[2rem] transition-all duration-300 hover:bg-[#ff6600] hover:shadow-2xl hover:shadow-orange-200 active:scale-95">
                    <span class="relative z-10 font-inter text-[11px] font-black uppercase tracking-[4px]" wire:loading.remove wire:target="guardar">
                        Guardar Configuración
                    </span>
                    <span class="relative z-10 font-inter text-[11px] font-black uppercase tracking-[4px] animate-pulse" wire:loading wire:target="guardar">
                        Actualizando base de datos...
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>