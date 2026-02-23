<div class="min-h-screen bg-[#f1f5f9] text-slate-900 font-inter pb-20 pt-10">
    {{-- Tipografías: Outfit para impacto, Inter para lectura técnica --}}
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@600;800;900&display=swap');

        .font-outfit {
            font-family: 'Outfit', sans-serif;
        }

        .font-inter {
            font-family: 'Inter', sans-serif;
        }
    </style>

    <div class="max-w-7xl mx-auto px-6 space-y-12">

        <nav class="flex items-center gap-4 mb-8 text-[11px] font-bold uppercase tracking-[2px] text-slate-400">
            <span class="text-slate-600">
                INICIO
            </span>
        </nav>

        {{-- Cabecera Estilo Tech-Admin --}}
        <div class="relative pl-8 py-2">
            <div class="absolute left-0 top-0 h-full w-1.5 bg-slate-950 rounded-full"></div>
            <h2 class="font-outfit text-5xl md:text-6xl font-900 tracking-tight text-slate-950 leading-none">
                PANEL DE <span class="text-[#ff6600]">CONTROL</span>
            </h2>
            <p class="font-inter text-[13px] font-semibold text-slate-500 uppercase tracking-[4px] mt-3 opacity-70">
                Sistemas de Gestión Centralizada <span class="mx-2 text-slate-300">/</span> 2026
            </p>
        </div>

        {{-- Grid de Tarjetas --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            {{-- Tarjeta: SOCIOS --}}
            <div class="group bg-white rounded-[2rem] border border-slate-200/60 shadow-sm hover:shadow-2xl hover:shadow-slate-200 transition-all duration-500 flex flex-col overflow-hidden">
                <div class="h-2 w-full bg-[#ff6600]"></div>
                <div class="p-8 flex-1">
                    <div class="flex justify-between items-start mb-8">
                        <div>
                            <h3 class="font-outfit text-2xl font-800 text-slate-900 group-hover:text-[#ff6600] transition-colors">SOCIOS</h3>
                            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mt-1">Base de datos</p>
                        </div>
                        <div class="bg-orange-50 p-4 rounded-2xl text-[#ff6600]">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="relative">
                            <span class="font-outfit text-7xl font-900 text-slate-950 leading-none tracking-tighter">
                                {{ $totalSocios ?? '0' }}
                            </span>
                        </div>

                        <div class="flex items-center gap-6 py-5 border-y border-slate-50 font-inter">
                            <div>
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block mb-1">Activos</span>
                                <span class="text-xl font-bold text-slate-900">{{ $sociosActivos ?? '0' }}</span>
                            </div>
                            <div class="h-8 w-px bg-slate-100"></div>
                            <div>
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block mb-1">Sincronización</span>
                                <span class="text-[11px] font-bold text-emerald-600 uppercase flex items-center">
                                    <span class="w-2 h-2 bg-emerald-500 rounded-full mr-2 animate-pulse"></span> Al día
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-8 pt-0">
                    <button wire:click="irASocios" class="w-full py-4 rounded-2xl bg-slate-950 hover:bg-[#ff6600] text-white font-inter text-xs font-bold tracking-widest transition-all uppercase shadow-lg shadow-slate-200">
                        Abrir Directorio
                    </button>
                </div>
            </div>

            {{-- Tarjeta: CONVOCATORIAS --}}
            <div class="group bg-white rounded-[2rem] border border-slate-200/60 shadow-sm hover:shadow-2xl hover:shadow-slate-200 transition-all duration-500 flex flex-col overflow-hidden">
                <div class="h-2 w-full bg-slate-950"></div>
                <div class="p-8 flex-1">
                    <div class="flex justify-between items-start mb-8">
                        <div>
                            <h3 class="font-outfit text-2xl font-800 text-slate-900 group-hover:text-[#ff6600] transition-colors">INCENTIVOS</h3>
                            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mt-1">Convocatorias</p>
                        </div>
                        <div class="bg-slate-50 p-4 rounded-2xl text-slate-900 group-hover:bg-orange-50 group-hover:text-[#ff6600] transition-all">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                            </svg>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <span class="font-outfit text-7xl font-900 text-slate-950 leading-none tracking-tighter">
                                {{ $convocatoriasAbiertas ?? '0' }}
                            </span>
                        </div>

                        <div class="flex items-center gap-6 py-5 border-y border-slate-50 font-inter">
                            <div>
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block mb-1">Proyectos</span>
                                <span class="text-xl font-bold text-slate-900">{{ $totalParticipantes ?? '0' }}</span>
                            </div>
                            <div class="h-8 w-px bg-slate-100"></div>
                            <div class="flex-1">
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block mb-1">Último Radicado</span>
                                <span class="text-[11px] font-bold text-slate-600 uppercase">Hace 5 min</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-8 pt-0">
                    <a href="{{ route('admin.convocatorias.index') }}" wire:navigate class="no-underline text-center w-full py-4 rounded-2xl bg-slate-950 hover:bg-[#ff6600] text-white font-inter text-xs font-bold tracking-widest transition-all uppercase block shadow-lg shadow-slate-200">
                        Administrar Procesos
                    </a>
                </div>
            </div>

            {{-- Tarjeta: SEGURIDAD --}}
            <div class="group bg-white rounded-[2rem] border border-slate-200/60 shadow-sm hover:shadow-2xl hover:shadow-slate-200 transition-all duration-500 flex flex-col overflow-hidden">
                <div class="h-2 w-full bg-[#ff6600]"></div>
                <div class="p-8 flex-1">
                    <div class="flex justify-between items-start mb-8">
                        <div>
                            <h3 class="font-outfit text-2xl font-800 text-slate-900 group-hover:text-[#ff6600] transition-colors">ACCESOS</h3>
                            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mt-1">Seguridad</p>
                        </div>
                        <div class="bg-orange-50 p-4 rounded-2xl text-[#ff6600]">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <span class="font-outfit text-7xl font-900 text-slate-950 leading-none tracking-tighter">
                                {{ $totalAdmins ?? '0' }}
                            </span>
                        </div>

                        <div class="py-5 border-t border-slate-50 font-inter">
                            <div class="bg-slate-50 rounded-2xl p-4 flex items-center justify-between">
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Estado Servidor</span>
                                <span class="text-[10px] font-black text-white bg-slate-950 px-3 py-1 rounded-full uppercase">Encriptado</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-8 pt-0">
                    <button wire:click="irAUsuarios" class="w-full py-4 rounded-2xl bg-slate-950 hover:bg-[#ff6600] text-white font-inter text-xs font-bold tracking-widest transition-all uppercase shadow-lg shadow-slate-200">
                        Configuración
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>