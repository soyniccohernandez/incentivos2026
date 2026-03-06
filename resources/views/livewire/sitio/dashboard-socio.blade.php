<div class="min-h-screen bg-white font-inter pb-20 relative overflow-hidden">
    {{-- Efecto de iluminación de fondo --}}
    <div class="absolute -top-24 -left-24 w-96 h-96 bg-[#ff6600] opacity-[0.03] rounded-full blur-[100px] pointer-events-none"></div>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@600;800;900&display=swap');

        .font-outfit {
            font-family: 'Outfit', sans-serif;
        }

        .font-inter {
            font-family: 'Inter', sans-serif;
        }

        .bg-grid {
            background-image: radial-gradient(#e2e8f0 0.8px, transparent 0.8px);
            background-size: 20px 20px;
        }
    </style>

    @livewire('layout.navigation')

    <div class="max-w-7xl mx-auto px-6 pt-10 relative z-10">
        {{-- BREADCRUMB --}}
        <nav class="flex items-center gap-4 mb-8 text-[11px] font-bold uppercase tracking-[2px] text-slate-400">
            <a href="{{ route('dashboard') }}" class="hover:text-[#ff6600] transition-colors">MI ESPACIO</a>
            <span class="opacity-30">/</span>
            <span class="text-slate-600">EXPEDIENTE DIGITAL</span>
        </nav>

        {{-- GRID PRINCIPAL --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">

            {{-- CABECERA DE ESTADO --}}
            <div class="lg:col-span-12 space-y-8">
                <div class="bg-white rounded-[3rem] p-8 md:p-12 border border-slate-100 shadow-sm relative overflow-hidden">
                    <div class="absolute -right-10 -top-10 text-slate-50 pointer-events-none">
                        <svg width="300" height="300" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm4.59-12.42L10 14.17l-2.59-2.58L6 13l4 4 8-8z" />
                        </svg>
                    </div>

                    <div class="relative z-10">
                        <div class="flex flex-col lg:flex-row justify-between items-center gap-10">
                            {{-- LADO IZQUIERDO: INDICADOR DE ESTADO --}}
                            <div class="w-full lg:w-7/12 space-y-6">
                                <div class="flex items-center gap-4">
                                    <div class="h-16 w-16 rounded-3xl {{ $proyecto->estado_id == 2 ? 'bg-red-50 text-red-500 border-red-100' : 'bg-orange-50 text-[#ff6600] border-orange-100' }} border-2 flex items-center justify-center shadow-sm">
                                        @if($proyecto->estado_id == 2)
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" stroke-width="2.5" />
                                        </svg>
                                        @else
                                        <svg class="w-8 h-8 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path d="M13 10V3L4 14h7v7l9-11h-7z" stroke-width="2.5" />
                                        </svg>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-[4px] mb-1">Estatus del Radicado</p>
                                        <h2 class="font-outfit text-4xl md:text-5xl font-900 uppercase tracking-tighter leading-tight text-slate-900">
                                            @php
                                            $estadoStr = $proyecto->estado->nombre;
                                            $separador = strpos($estadoStr, '/') !== false ? '/' : (strpos($estadoStr, '-') !== false ? '-' : null);
                                            if ($separador) {
                                            [$principal, $secundario] = explode($separador, $estadoStr, 2);
                                            } else {
                                            $principal = $estadoStr;
                                            $secundario = null;
                                            }
                                            @endphp
                                            {{ trim($principal) }}
                                            @if($secundario)
                                            <span class="{{ in_array($proyecto->estado_id, [2, 8]) ? 'text-red-500' : 'text-[#ff6600]' }} opacity-80">{{ $separador }} {{ trim($secundario) }}</span>
                                            @endif
                                        </h2>
                                    </div>
                                </div>
                                <div class="bg-slate-50 border-l-4 border-slate-900 p-6 rounded-r-3xl">
                                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-2">Observación de Registro</p>
                                    <p class="text-lg font-medium text-slate-700 leading-relaxed italic">
                                        "{{ $proyecto->observacion_general ?? 'Su solicitud se encuentra en etapa de revisión por el comité técnico de incentivos.' }}"
                                    </p>
                                </div>
                            </div>

                            {{-- LADO DERECHO: CONTACTO --}}
                            <div class="w-full lg:w-5/12 space-y-4">
                                <div class="bg-white border border-slate-100 rounded-[2rem] p-6 shadow-xl shadow-slate-200/50">
                                    <div class="flex items-center gap-3 mb-4">
                                        <span class="flex h-3 w-3 rounded-full bg-blue-500"></span>
                                        <p class="text-[10px] font-black text-slate-900 uppercase tracking-widest">Canal de Atención</p>
                                    </div>
                                    <p class="text-xs text-slate-500 mb-6 leading-relaxed">Para cualquier actualización, subsanación o trámite, contacte al área de <span class="font-bold text-slate-700">Incentivos</span>:</p>
                                    <div class="space-y-4">
                                        <a href="mailto:incentivos@actores.org.co" class="flex items-center gap-4 group no-underline">
                                            <div class="w-10 h-10 rounded-xl bg-slate-950 flex items-center justify-center text-white group-hover:bg-[#ff6600] transition-colors">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" stroke-width="2" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-[9px] font-black text-slate-400 uppercase tracking-tighter">Canal Oficial</p>
                                                <p class="text-sm font-bold text-slate-900">incentivos@actores.org.co</p>
                                            </div>
                                        </a>
                                        <div class="grid grid-cols-2 gap-3 pt-2">
                                            <a href="tel:+573174188415" class="flex items-center gap-3 p-3 rounded-2xl bg-white border border-slate-100 hover:border-slate-300 transition-all group no-underline">
                                                <div class="text-slate-400 group-hover:text-slate-900"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                        <path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" />
                                                    </svg></div>
                                                <span class="text-[11px] font-bold text-slate-700 italic">317 4188415</span>
                                            </a>
                                            <a href="https://wa.me/573174188415" target="_blank" class="flex items-center gap-3 p-3 rounded-2xl bg-white border border-slate-100 hover:border-green-200 hover:bg-green-50/30 transition-all group no-underline">
                                                <div class="text-slate-400 group-hover:text-green-500"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                        <path d="M3 21l1.65 -3.8a9 9 0 1 1 3.4 2.9l-5.05 .9" />
                                                        <path d="M9 10a.5 .5 0 0 0 1 0v-1a.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a.5 .5 0 0 0 0 -1h-1a.5 .5 0 0 0 0 1" />
                                                    </svg></div>
                                                <span class="text-[11px] font-bold text-slate-700 italic">WhatsApp</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-8 pt-6 border-t border-slate-50">
                            <div class="flex items-center justify-between mb-3 text-[10px] font-black uppercase tracking-[2px]">
                                <span class="text-slate-400">Progreso del Flujo de Trabajo</span>
                                <span class="text-slate-900">Etapa {{ $proyecto->etapa_id }} de 4</span>
                            </div>
                            <div class="h-2 w-full bg-slate-100 rounded-full overflow-hidden p-0.5">
                                <div class="h-full bg-slate-950 rounded-full transition-all duration-1000 shadow-[0_0_10px_rgba(0,0,0,0.1)]" style="width: {{ ($proyecto->etapa_id / 4) * 100 }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- COLUMNA IZQUIERDA - EL PROYECTO --}}
            <div class="lg:col-span-12 space-y-8">
                <div class="bg-white rounded-[3rem] border border-slate-100 shadow-sm overflow-hidden relative">
                    <div class="absolute top-0 left-0 w-full h-24 bg-slate-900 bg-grid opacity-5"></div>
                    <div class="relative pt-12 px-10 pb-10">
                        <div class="relative flex flex-col md:flex-row justify-between items-end gap-6 mb-12">
                            <div class="relative z-10 space-y-6">
                                <div class="inline-flex items-center group">
                                    <div class="flex items-center bg-white border-2 border-slate-950 rounded-2xl overflow-hidden shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                                        <span class="px-4 py-2 bg-slate-950 text-[10px] font-black text-white uppercase tracking-[2px]">EXPEDIENTE</span>
                                        <span class="px-5 py-2 text-slate-900 text-[12px] font-black uppercase tracking-[3px]">{{ $proyecto->codigo_radicado }}</span>
                                    </div>
                                </div>
                                <h1 class="font-outfit text-6xl md:text-8xl font-900 text-slate-950 tracking-[-0.05em] leading-[0.82] uppercase">
                                    <span class="text-[#ff6600]">{{ mb_substr($proyecto->titulo, 0, 1) }}</span>{{ mb_substr($proyecto->titulo, 1) }}
                                </h1>
                                <div class="flex items-center gap-3">
                                    <div class="h-[3px] w-20 bg-[#ff6600]"></div>
                                    <div class="h-[3px] w-3 bg-slate-950"></div>
                                </div>
                            </div>
                            <div class="hidden md:block shrink-0 text-right pb-2">
                                <div class="inline-block px-4 py-1 border-2 border-[#ff6600] rounded-lg mb-2">
                                    <p class="text-[10px] font-black text-[#ff6600] uppercase tracking-[4px]">CONVOCATORIA</p>
                                </div>
                                <p class="font-outfit text-3xl font-900 text-slate-950 uppercase tracking-tighter leading-none">VIGENTE <span class="text-slate-300">2026</span></p>
                            </div>
                        </div>

                        @php
                        $idSocio = trim((string)(Auth::user()->identificacion ?? ''));
                        $idDirector = trim((string)($proyecto->director->identificacion ?? ''));
                        $esMismoDirector = ($idSocio === $idDirector && $idSocio !== '');
                        @endphp

                        {{-- DATOS DEL PROPONENTE --}}
                        <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-sm relative overflow-hidden group mb-10">
                            <div class="absolute right-10 top-1/2 -translate-y-1/2 text-slate-50 opacity-10 pointer-events-none"><svg class="w-48 h-48" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                                </svg></div>
                            <div class="relative z-10">
                                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[4px]">Socio Proponente del Proyecto</p>
                                    @if($esMismoDirector)
                                    <div class="flex items-center gap-2 bg-orange-50 text-[#ff6600] px-4 py-1.5 rounded-full border border-orange-100">
                                        <span class="text-[9px] font-black tracking-widest uppercase">Proponente y Director</span>
                                    </div>
                                    @endif
                                </div>
                                <div class="flex flex-col lg:flex-row items-center lg:items-start gap-8">
                                    <div class="shrink-0 h-24 w-24 rounded-[2rem] bg-slate-100 border-4 border-white shadow-2xl overflow-hidden flex items-center justify-center">
                                        @if($foto_url) <img src="{{ $foto_url }}" class="h-full w-full object-cover"> @else <span class="font-outfit text-3xl font-900 text-[#ff6600] uppercase">{{ $iniciales }}</span> @endif
                                    </div>
                                    <div class="flex-1 w-full">
                                        <div class="text-center lg:text-left mb-6">
                                            <h3 class="font-outfit text-3xl font-800 text-slate-900 uppercase leading-tight">{{ Auth::user()->name }}</h3>
                                            <p class="text-[11px] text-[#ff6600] font-bold uppercase mt-2 tracking-[0.3em]">Socio Proponente</p>
                                        </div>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-6 pt-8 border-t border-slate-50">
                                            <div class="flex items-center gap-4">
                                                <div class="h-10 w-10 bg-slate-50 rounded-xl flex items-center justify-center text-slate-400"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-4 0H5m14 0h-5" stroke-width="2" />
                                                    </svg></div>
                                                <div>
                                                    <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Identificación</p>
                                                    <p class="text-sm font-bold text-slate-700">{{ Auth::user()->identificacion }}</p>
                                                </div>
                                            </div>
                                            <div class="flex items-center gap-4">
                                                <div class="h-10 w-10 bg-slate-50 rounded-xl flex items-center justify-center text-slate-400"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" stroke-width="2" />
                                                    </svg></div>
                                                <div>
                                                    <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Teléfono</p>
                                                    <p class="text-sm font-bold text-slate-700">{{ Auth::user()->telefono ?? '---' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- SECCIÓN DIRECTOR Y LIBRETO --}}
                        <div class="grid grid-cols-1 gap-6">
                            @if($proyecto->director && !$esMismoDirector)
                            <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-sm relative overflow-hidden">
                                <div class="relative z-10">
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[4px] mb-8">Información del Director</p>
                                    <div class="flex flex-col lg:flex-row items-center lg:items-start gap-8">
                                        <div class="shrink-0 h-24 w-24 rounded-[2rem] bg-slate-950 flex items-center justify-center text-white font-outfit text-4xl font-800 shadow-2xl">
                                            {{ mb_substr($proyecto->director->nombre ?? 'D', 0, 1) }}
                                        </div>
                                        <div class="flex-1 w-full">
                                            <div class="text-center lg:text-left mb-6">
                                                <h4 class="font-outfit text-3xl font-800 text-slate-800 uppercase leading-tight">{{ $proyecto->director->nombre }}</h4>
                                                <p class="text-[11px] text-[#ff6600] font-bold uppercase mt-2 tracking-[0.3em]">
                                                    {{ $proyecto->director->es_proponente ? 'Director Proponente' : 'Director Externo' }}
                                                </p>
                                            </div>

                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-6 pt-8 border-t border-slate-50">
                                                <div class="flex items-center gap-4">
                                                    <div class="h-10 w-10 bg-slate-50 rounded-xl flex items-center justify-center text-slate-400">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-4 0H5m14 0h-5" stroke-width="2" />
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Identificación</p>
                                                        <p class="text-sm font-bold text-slate-700">{{ $proyecto->director->identificacion }}</p>
                                                    </div>
                                                </div>

                                                <div class="flex items-center gap-4">
                                                    <div class="h-10 w-10 bg-slate-50 rounded-xl flex items-center justify-center text-slate-400">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Teléfono / Celular</p>
                                                        <p class="text-sm font-bold text-slate-700">{{ $proyecto->director->celular }}</p>
                                                    </div>
                                                </div>

                                                <div class="flex items-center gap-4">
                                                    <div class="h-10 w-10 bg-slate-50 rounded-xl flex items-center justify-center text-slate-400">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Correo Electrónico</p>
                                                        <p class="text-sm font-bold text-slate-700 lowercase">{{ $proyecto->director->correo }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

                            <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-sm relative overflow-hidden">
                                <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-6">
                                    <div class="flex items-center gap-6">
                                        <div class="h-16 w-16 rounded-2xl {{ $proyecto->guion_propio ? 'bg-orange-50 text-[#ff6600] border-orange-100' : 'bg-slate-50 text-slate-500 border-slate-100' }} flex items-center justify-center border">
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" stroke-width="2" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[4px] mb-1">Tu declaración</p>
                                            <h4 class="font-outfit text-2xl font-800 text-slate-800 uppercase">
                                                {{ $proyecto->guion_propio ? 'Soy el autor del guion' : 'Uso un guion de un tercero' }}
                                            </h4>
                                        </div>
                                    </div>

                                    @if($proyecto->guion_propio)
                                    <div class="flex items-center gap-2 px-5 py-2.5 rounded-xl bg-orange-500 text-white shadow-lg shadow-orange-100">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" />
                                        </svg>
                                        <span class="text-[10px] font-black uppercase tracking-wider">Autoría Confirmada</span>
                                    </div>
                                    @else
                                    <div class="flex items-center gap-2 px-5 py-2.5 rounded-xl bg-slate-100 text-slate-600 border border-slate-200">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                                            <path d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5z" />
                                        </svg>
                                        <span class="text-[10px] font-black uppercase tracking-wider">Con Cesión de Derechos</span>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SECCIÓN: ARCHIVOS DEL EXPEDIENTE --}}
                <div class="bg-white rounded-[3rem] p-10 border border-slate-100 shadow-sm">
                    <h3 class="font-outfit text-3xl font-800 text-slate-900 uppercase mb-8">Expediente <span class="text-[#ff6600]">Técnico</span></h3>
                    @php
                    // 1. Identificar si el proponente (usuario autenticado) está en el elenco
                    $proponenteIden = Auth::user()->identificacion;
                    $proponenteEnElenco = $proyecto->elenco->contains('identificacion', $proponenteIden);

                    // 2. Obtener la última versión de cada documento
                    $documentosRecientes = $proyecto->documentos->groupBy('tipo_documento_id')->map(function($grupo) {
                    return $grupo->sortByDesc('version')->first();
                    });

                    // 3. Si está en el elenco, filtramos para que la carta de intención NO salga aquí
                    if ($proponenteEnElenco) {
                    $documentosRecientes = $documentosRecientes->filter(function($doc) {
                    $nombreDoc = strtolower($doc->tipoDocumento->nombre);
                    // Excluimos si el nombre contiene "carta" o "intención"
                    return !(str_contains($nombreDoc, 'carta') || str_contains($nombreDoc, 'intención'));
                    });
                    }
                    @endphp
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($documentosRecientes as $doc)
                        <div class="flex items-center justify-between p-6 bg-slate-50 border border-slate-100 rounded-[2rem] group hover:border-[#ff6600]/30 transition-all">
                            <div class="flex items-center gap-4 min-w-0">
                                <div class="shrink-0 h-12 w-12 bg-white rounded-2xl flex items-center justify-center text-slate-400 group-hover:text-[#ff6600] shadow-sm"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" stroke-width="2" />
                                    </svg></div>
                                <div class="min-w-0">
                                    <p class="text-[11px] font-bold text-slate-700 uppercase truncate" title="{{ $doc->tipoDocumento->nombre }}">{{ $doc->tipoDocumento->nombre }}</p>
                                    <div class="flex items-center gap-2 mt-0.5">
                                        <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest">Versión {{ $doc->version }}.0</p>
                                        @if($doc->estado == 'aprobado') <span class="text-[8px] bg-emerald-50 text-emerald-600 px-1.5 py-0.5 rounded-md border border-emerald-100 font-bold uppercase">Subsanado</span> @endif
                                    </div>
                                </div>
                            </div>
                            <a href="{{ asset('storage/' . $doc->ruta_archivo) }}" target="_blank" class="h-10 w-10 rounded-full flex items-center justify-center bg-white text-slate-400 hover:text-[#ff6600] transition-all border border-slate-100"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" stroke-width="2" />
                                    <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" stroke-width="2" />
                                </svg></a>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- SECCIÓN: ELENCO ARTÍSTICO (SOLO SI ES ETAPA 2 O SUPERIOR) --}}
                @if($proyecto->etapa_id >= 2 && $proyecto->elenco->count() > 0)
                <div class="bg-white rounded-[3rem] p-10 border border-slate-100 shadow-sm mt-10">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10">
                        <div>
                            <h3 class="font-outfit text-4xl font-900 text-slate-950 uppercase tracking-tighter leading-none">
                                Elenco <span class="text-[#ff6600]">Artístico</span>
                            </h3>
                            <p class="text-[11px] text-slate-400 font-bold uppercase tracking-widest mt-2">Nómina de talentos vinculados al radicado</p>
                        </div>
                        <div class="shrink-0 px-6 py-2 bg-slate-50 border border-slate-100 rounded-2xl text-[11px] font-black text-slate-500 uppercase tracking-[2px]">
                            {{ $proyecto->elenco->count() }} Participantes
                        </div>
                    </div>

                    <div class="space-y-4">
                        @foreach($proyecto->elenco as $miembro)
                        @php
                        $archivosSocio = \Storage::disk('public')->files('socios');
                        $fotoMiembro = collect($archivosSocio)->first(fn($path) => str_contains(basename($path), (string)$miembro->identificacion));
                        $m_parts = explode(' ', trim($miembro->name));
                        $m_iniciales = strtoupper(substr($m_parts[0] ?? 'U', 0, 1) . (isset($m_parts[1]) ? substr($m_parts[1], 0, 1) : ''));
                        @endphp

                        <div class="group relative bg-white border border-slate-100 rounded-[2.5rem] shadow-sm hover:border-[#ff6600]/30 hover:shadow-xl hover:shadow-slate-200/50 transition-all duration-500 overflow-hidden">
                            <div class="flex flex-col md:flex-row items-stretch">
                                {{-- Foto / Iniciales --}}
                                <div class="w-full md:w-48 bg-slate-50/50 flex flex-col items-center justify-center p-8 border-r border-slate-50 relative">
                                    <div class="h-28 w-28 rounded-[2.5rem] overflow-hidden shadow-2xl border-4 border-white ring-1 ring-slate-100 group-hover:scale-105 transition-transform duration-500">
                                        @if($fotoMiembro)
                                        <img src="{{ asset('storage/' . $fotoMiembro) }}" class="w-full h-full object-cover">
                                        @else
                                        <div class="w-full h-full bg-white flex items-center justify-center">
                                            <span class="font-outfit text-4xl font-900 text-slate-100 uppercase">{{ $m_iniciales }}</span>
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                {{-- Datos y Documento --}}
                                <div class="flex-1 p-10 flex flex-col lg:flex-row lg:items-center justify-between gap-8">
                                    <div class="space-y-4">
                                        <div>
                                            <span class="text-[10px] font-black text-[#ff6600] uppercase tracking-[4px] mb-2 block">Perfil Verificado</span>
                                            <h4 class="font-outfit text-3xl font-800 text-slate-900 uppercase leading-none tracking-tighter group-hover:text-[#ff6600] transition-colors">
                                                {{ $miembro->name }}
                                            </h4>
                                        </div>
                                        <div class="flex flex-wrap items-center gap-6">
                                            <div class="flex flex-col">
                                                <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Identificación</span>
                                                <span class="text-sm font-black text-slate-700">{{ $miembro->identificacion }}</span>
                                            </div>
                                            <div class="h-8 w-px bg-slate-100 hidden sm:block"></div>
                                            <div class="flex flex-col">
                                                <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Rol Registrado</span>
                                                <span class="text-sm font-black text-slate-700 italic">Talento Elenco</span>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Botón de Autorización --}}
                                    <div class="flex items-center">
                                        @if($miembro->pivot->archivo_autorizacion_path)
                                        <a href="{{ asset('storage/' . $miembro->pivot->archivo_autorizacion_path) }}" target="_blank" class="group/btn flex items-center gap-5 px-10 py-5 bg-slate-950 text-white rounded-[2rem] hover:bg-[#ff6600] transition-all duration-300 shadow-xl shadow-slate-200">
                                            <div class="flex flex-col text-right">
                                                <span class="text-[8px] font-black text-white/40 uppercase tracking-[3px]">Ver PDF</span>
                                                <span class="text-[11px] font-bold uppercase tracking-[2px]">Autorización</span>
                                            </div>
                                            <div class="h-10 w-10 bg-white/10 rounded-2xl flex items-center justify-center group-hover/btn:bg-white group-hover/btn:text-[#ff6600] transition-all">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" stroke-width="2.5" />
                                                </svg>
                                            </div>
                                        </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>
</div>