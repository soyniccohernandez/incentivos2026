<div class="mt-5 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
    {{-- Cabecera del Panel --}}
    <div class="border-b border-gray-200 pb-5">
        <h2 class="text-3xl font-black text-gray-900 tracking-tight">Panel de Administración General</h2>
        <p class="text-sm text-gray-500 mt-1">Gestión centralizada de convocatorias, base de socios y seguridad del sistema.</p>
    </div>

    {{-- Grid de Tarjetas --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

        {{-- Tarjeta: Socios --}}
        <div class="group bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 flex flex-col relative overflow-hidden">
            <div class="h-1.5 w-full bg-emerald-500"></div>
            <div class="p-6 flex-1">
                <div class="flex justify-between items-start mb-5">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold tracking-wide uppercase bg-emerald-50 text-emerald-700 ring-1 ring-inset ring-emerald-600/20">
                        <span class="w-1.5 h-1.5 rounded-full mr-1.5 bg-emerald-600"></span>
                        Base de Datos
                    </span>
                    <div class="bg-emerald-50 p-2 rounded-lg text-emerald-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                </div>
                <h3 class="text-xl font-extrabold text-gray-900 mb-2 group-hover:text-emerald-600 transition-colors">Socios Registrados</h3>
                <p class="text-sm text-gray-500 mb-6 leading-relaxed">Administra la base de datos de socios, verifica estados de cuenta y cargos internos.</p>
                <div class="grid grid-cols-2 gap-4 py-4 border-t border-gray-50">
                    <div class="flex flex-col">
                        <span class="text-[10px] uppercase tracking-wider text-gray-400 font-bold">Total Socios</span>
                        <span class="text-lg font-black text-emerald-700">{{ $totalSocios ?? '0' }}</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-[10px] uppercase tracking-wider text-gray-400 font-bold">Activos</span>
                        <span class="text-lg font-black text-gray-800">{{ $sociosActivos ?? '0' }}</span>
                    </div>
                </div>
            </div>
            <div class="p-4 bg-white">
                <button wire:click="irASocios" class="flex items-center justify-center w-full px-4 py-2.5 text-sm font-bold text-white bg-emerald-600 rounded-xl hover:bg-emerald-700 transition-all shadow-md shadow-emerald-200">
                    Ver Listado de Socios
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- Tarjeta: Seguridad --}}
        <div class="group bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 flex flex-col relative overflow-hidden">
            <div class="h-1.5 w-full bg-slate-700"></div>
            <div class="p-6 flex-1">
                <div class="flex justify-between items-start mb-5">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold tracking-wide uppercase bg-slate-100 text-slate-700 ring-1 ring-inset ring-slate-600/20">Seguridad</span>
                    <div class="bg-slate-50 p-2 rounded-lg text-slate-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                </div>
                <h3 class="text-xl font-extrabold text-gray-900 mb-2 group-hover:text-slate-600 transition-colors">Usuarios de Sistema</h3>
                <p class="text-sm text-gray-500 mb-6 leading-relaxed">Control de acceso administrativo, gestión de contraseñas y permisos de red.</p>
                <div class="grid grid-cols-2 gap-4 py-4 border-t border-gray-50">
                    <div class="flex flex-col">
                        <span class="text-[10px] uppercase tracking-wider text-gray-400 font-bold">Administradores</span>
                        <span class="text-lg font-black text-slate-700">{{ $totalAdmins ?? '0' }}</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-[10px] uppercase tracking-wider text-gray-400 font-bold">Estado</span>
                        <span class="text-xs font-bold text-emerald-600 mt-1 flex items-center">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 mr-1 animate-pulse"></span> Seguro
                        </span>
                    </div>
                </div>
            </div>
            <div class="p-4 bg-white">
                <button wire:click="irAUsuarios" class="flex items-center justify-center w-full px-4 py-2.5 text-sm font-bold text-white bg-slate-800 rounded-xl hover:bg-slate-900 transition-all shadow-md shadow-slate-200">
                    Configurar Accesos
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- Tarjeta Convocatorias --}}
        <div class="group bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 flex flex-col relative overflow-hidden">
            <div class="h-1.5 w-full bg-indigo-500"></div>
            <div class="p-6 flex-1">
                <div class="flex justify-between items-start mb-5">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold tracking-wide uppercase bg-indigo-50 text-indigo-700 ring-1 ring-inset ring-indigo-600/20">
                        Convocatorias
                    </span>
                    <div class="bg-indigo-50 p-2 rounded-lg text-indigo-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                        </svg>
                    </div>
                </div>

                <h3 class="text-xl font-extrabold text-gray-900 mb-2 group-hover:text-indigo-600 transition-colors">Gestión de Fondos</h3>
                <p class="text-sm text-gray-500 mb-6 leading-relaxed">Monitoreo de participación y estados de los incentivos vigentes.</p>

                {{-- Simetría perfecta con 2 datos clave --}}
                <div class="grid grid-cols-2 gap-4 py-4 border-t border-gray-50">
                    <div class="flex flex-col">
                        <span class="text-[10px] uppercase tracking-wider text-gray-400 font-bold">Convocatorias Activas</span>
                        <div class="flex items-center mt-1">
                            <span class="text-lg font-black text-indigo-700">{{ $convocatoriasAbiertas }}</span>
                            @if($convocatoriasAbiertas > 0)
                            <span class="ml-2 flex h-2 w-2">
                                <span class="animate-ping absolute inline-flex h-2 w-2 rounded-full bg-indigo-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-500"></span>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-[10px] uppercase tracking-wider text-gray-400 font-bold">Participación</span>
                        <span class="text-lg font-black text-gray-800 mt-1">
                            {{ $totalParticipantes }} <span class="text-[10px] text-gray-400 font-medium">proyectos</span>
                        </span>
                    </div>
                </div>
            </div>

            <div class="p-4 bg-white">
                <a href="{{ route('admin.convocatorias.index') }}" wire:navigate class="flex items-center justify-center w-full px-4 py-2.5 text-sm font-bold text-white bg-indigo-600 rounded-xl hover:bg-indigo-700 transition-all shadow-md shadow-indigo-200">
                    Ver Detalles
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>
        </div>

    </div>
</div>