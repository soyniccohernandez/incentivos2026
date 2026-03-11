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

    {{-- Elemento invisible que transporta el mensaje de Laravel a JS --}}
    @if(session('success'))
    <div id="swal-payload" data-message="{{ session('success') }}"></div>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const payload = document.getElementById('swal-payload');

            if (payload && payload.dataset.message) {
                Swal.fire({
                    title: '¡RADICACIÓN EXITOSA!',
                    text: payload.dataset.message,
                    icon: 'success',
                    confirmButtonText: 'ENTENDIDO',
                    confirmButtonColor: '#ff6600',
                    background: '#ffffff',
                    // Diseño premium y limpio
                    customClass: {
                        popup: 'rounded-[2rem] border-4 border-slate-900 shadow-2xl',
                        title: 'font-bebas text-4xl tracking-tight text-slate-900',
                        htmlContainer: 'font-inter text-slate-600 font-medium',
                        confirmButton: 'rounded-xl px-12 py-3 font-bebas text-xl tracking-widest hover:scale-105 transition-transform'
                    },
                    showClass: {
                        popup: 'animate__animated animate__fadeInUp animate__faster'
                    },
                    hideClass: {
                        popup: 'animate__animated animate__fadeOutDown animate__faster'
                    }
                }).then(() => {
                    // Opcional: Limpiar el rastro del DOM después de mostrarlo
                    payload.remove();
                });


                history.replaceState(null, null, window.location.href);
            }
        });
    </script>

    <nav x-data="{ dropdownOpen: false }" class="bg-black border-b border-white/10 sticky top-0 z-[1000] antialiased">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@600;800;900&display=swap');

            .font-outfit {
                font-family: 'Outfit', sans-serif;
            }

            .font-inter {
                font-family: 'Inter', sans-serif;
            }

            [x-cloak] {
                display: none !important;
            }

            .animate-fade-in {
                animation: fadeIn 0.5s ease-out forwards;
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
        </style>
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex justify-between h-20">
                <div class="flex items-center gap-8">
                    <a href="{{ route('dashboard') }}" wire:navigate class="flex items-center gap-4 no-underline group">
                        <img src="{{ asset('resources/imagenes/logo.png') }}" alt="Logo" class="h-9 w-auto object-contain group-hover:scale-105 transition-transform">
                        <div class="flex flex-col border-l border-white/10 pl-4">
                            <span class="font-outfit text-lg font-900 text-white tracking-tight leading-none group-hover:text-[#ff6600] transition-colors uppercase">
                                MI <span class="text-[#ff6600]">PANEL</span>
                            </span>
                        </div>
                    </a>
                    <div class="hidden lg:flex items-center gap-3 ml-4 bg-white/[0.03] px-4 py-1.5 rounded-full border border-white/5">
                        <div class="w-1.5 h-1.5 bg-[#ff6600] rounded-full animate-pulse shadow-[0_0_8px_#ff6600]"></div>
                        <span class="font-inter text-[11px] font-bold text-gray-400 tracking-wider uppercase">Seguimiento </span>
                    </div>
                </div>
                <div class="flex items-center font-inter">
                    <div class="relative">
                        <button @click="dropdownOpen = !dropdownOpen" class="flex items-center gap-3 px-2 py-1.5 hover:bg-white/5 transition-all duration-300 rounded-lg group">
                            <div class="w-9 h-9 bg-gradient-to-br from-[#ff6600] to-[#cc5200] rounded-lg flex items-center justify-center text-black font-outfit font-800 text-sm shadow-[0_0_15px_rgba(255,102,0,0.2)] overflow-hidden">
                                @if($foto_url) <img src="{{ $foto_url }}" class="w-full h-full object-cover"> @else {{ $iniciales }} @endif
                            </div>
                            <div class="text-left hidden sm:block">
                                <span class="text-sm font-700 text-white block leading-none">{{ auth()->user()->name }}</span>
                                <span class="text-[9px] font-bold text-gray-500 uppercase tracking-wider mt-1 block">
                                    {{ auth()->user()->tipo_socio === 'Administrador' ? 'Administrador' : 'Socio Proponente' }}
                                </span>
                            </div>
                            <svg class="w-4 h-4 text-gray-600 group-hover:text-white transition-colors" :class="dropdownOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="dropdownOpen" @click.away="dropdownOpen = false" x-transition class="absolute right-0 mt-3 w-64 bg-[#0a0a0a] border border-white/10 shadow-2xl rounded-xl overflow-hidden z-[1100]">
                            <div class="px-5 py-4 bg-white/[0.02] border-b border-white/5">
                                <p class="text-[9px] font-bold text-gray-500 uppercase tracking-widest mb-1">Usuario Conectado</p>
                                <p class="text-xs font-medium text-gray-300 truncate">{{ auth()->user()->email }}</p>
                            </div>
                            <div class="p-2">
                                <button wire:click="logout" class="w-full flex items-center gap-3 text-left px-4 py-3 text-[13px] font-bold text-red-500/80 hover:text-red-500 hover:bg-red-500/5 rounded-lg transition-all">
                                    Cerrar Sesión
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-6 pt-10 relative z-10">
        {{-- BREADCRUMB --}}
        <nav class="flex items-center gap-4 mb-8 text-[11px] font-bold uppercase tracking-[2px] text-slate-400">
            <a href="{{ route('dashboard') }}" class="hover:text-[#ff6600] transition-colors">MI ESPACIO</a>
            <span class="opacity-30">/</span>
            <span class="text-slate-600">EXPEDIENTE DIGITAL</span>
        </nav>

        {{-- GRID PRINCIPAL --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">

            {{-- CABECERA DE ESTADO: VERSIÓN PULIDA DE TU DISEÑO --}}
            <div class="lg:col-span-12">
                <div class="bg-white rounded-[4rem] p-10 md:p-14 shadow-[0_40px_80px_-15px_rgba(0,0,0,0.08)] border border-slate-50 relative overflow-hidden group">

                    {{-- El icono de fondo que tenías, pero con opacidad controlada --}}
                    <div class="absolute -right-12 -top-12 text-slate-100/80 pointer-events-none transform group-hover:scale-110 transition-transform duration-700">
                        <svg width="320" height="320" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm4.59-12.42L10 14.17l-2.59-2.58L6 13l4 4 8-8z" />
                        </svg>
                    </div>

                    <div class="relative z-10">
                        {{-- BLOQUE 1: ESTADO (MANTENIENDO TU ESTRUCTURA) --}}
                        <div class="flex flex-col md:flex-row items-center gap-10 mb-12">

                            {{-- Tu contenedor de icono redondeado, más estilizado --}}
                            <div class="h-28 w-28 rounded-[2.5rem] flex-shrink-0 flex items-center justify-center border-2 shadow-inner transition-colors duration-500 {{ $proyecto->estado_id == 2 ? 'bg-red-50 border-red-100 text-red-500' : 'bg-orange-50 border-orange-100 text-brand-orange' }}">
                                @if($proyecto->estado_id == 2)
                                <svg class="w-14 h-14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" stroke-width="2" />
                                </svg>
                                @else
                                <svg class="w-14 h-14 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M13 10V3L4 14h7v7l9-11h-7z" stroke-width="2" />
                                </svg>
                                @endif
                            </div>

                            <div class="flex-1 text-center md:text-left">
                                <span class="text-[11px] font-black uppercase tracking-[5px] text-slate-400 block mb-2">ESTADO</span>
                                <h2 class="text-5xl md:text-7xl font-black text-slate-900 leading-[0.9] tracking-tighter uppercase">
                                    @php
                                    $estadoStr = $proyecto->estado->nombre;
                                    $separador = strpos($estadoStr, '/') !== false ? '/' : (strpos($estadoStr, '-') !== false ? '-' : null);
                                    [$principal, $secundario] = $separador ? explode($separador, $estadoStr, 2) : [$estadoStr, null];
                                    @endphp
                                    {{ trim($principal) }}
                                    @if($secundario)
                                    <span class="block text-2xl md:text-4xl mt-1 {{ in_array($proyecto->estado_id, [2, 8]) ? 'text-red-500' : 'text-brand-orange' }}">
                                        {{ $separador }} {{ trim($secundario) }}
                                    </span>
                                    @endif
                                </h2>
                            </div>
                        </div>

                        {{-- BLOQUE 2: ¿QUÉ HACER? (OPTIMIZADO Y 100% RESPONSIVE) --}}
                        <div class="bg-slate-50 rounded-[2rem] md:rounded-[3rem] p-6 md:p-10 border border-slate-100 mb-10 overflow-hidden">

                            <div class="flex items-center gap-3 mb-5">
                                <span class="relative flex h-3 w-3 shrink-0">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-600 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-3 w-3 bg-blue-600"></span>
                                </span>
                                <h3 class="text-[10px] md:text-xs font-black uppercase tracking-widest text-slate-900 truncate">
                                    Instrucciones de seguimiento
                                </h3>
                            </div>

                            {{-- Contenedor de texto con control de desbordamiento --}}
                            <div class="w-full overflow-hidden">
                                <p class="text-lg md:text-2xl font-bold text-slate-700 leading-tight italic break-words whitespace-normal">
                                    "{{ $proyecto->observacion_general ?? 'Su solicitud se encuentra en etapa de revisión técnica. No se requieren acciones adicionales por ahora.' }}"
                                </p>
                            </div>

                        </div>

                        {{-- BLOQUE 3: WHATSAPP Y HORARIOS (UNIFICADOS EN TU ESTILO) --}}
                        <div class="grid lg:grid-cols-12 gap-6 items-stretch">

                            {{-- Botón WhatsApp: El CTA principal --}}
                            <div class="lg:col-span-7 bg-white border border-slate-100 rounded-[3rem] p-8 shadow-xl shadow-slate-100/50 flex flex-col md:flex-row items-center justify-between gap-6 hover:border-brand-orange transition-colors duration-500">
                                <div class="text-center md:text-left">
                                    <h4 class="text-2xl font-black text-slate-900 leading-none">¿TIENE DUDAS?</h4>
                                    <p class="text-slate-500 text-sm mt-1 font-medium italic">Chat directo línea de Incentivos</p>
                                </div>
                                <a href="https://wa.me/573156896774?text=Hola,%20tengo%20una%20duda%20sobre%20mi%20proyecto" target="_blank"
                                    class="bg-brand-orange hover:bg-black text-white px-8 py-4 rounded-2xl text-2xl font-black transition-all transform hover:scale-105 shadow-lg shadow-orange-200 flex items-center gap-3 uppercase tracking-tighter">
                                    <i class="fa-brands fa-whatsapp text-3xl"></i>
                                    315 6896774
                                </a>
                            </div>

                            {{-- Horarios: El bloque de info --}}
                            <div class="lg:col-span-5 bg-slate-900 rounded-[3rem] p-8 text-white flex flex-col justify-center">
                                <div class="flex items-center gap-2 mb-4">
                                    <span class="w-6 h-[1px] bg-brand-orange"></span>
                                    <span class="text-[9px] font-bold uppercase tracking-[3px] text-slate-400">Horarios</span>
                                </div>
                                <div class="space-y-2">
                                    <div class="flex justify-between items-center text-sm">
                                        <span class="font-bold opacity-60">LUNE - JUEVES</span>
                                        <span class="font-black text-lg tracking-tighter">7:30AM - 4:30PM</span>
                                    </div>
                                    <div class="flex justify-between items-center text-sm">
                                        <span class="font-bold opacity-60">VIERNES</span>
                                        <span class="font-black text-lg tracking-tighter text-brand-orange">7:30AM - 3:30PM</span>
                                    </div>
                                </div>
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
                                <div class="flex flex-col lg:flex-row items-center lg:items-start gap-10">
                                    {{-- AVATAR / INICIALES --}}
                                    <div class="shrink-0 h-28 w-28 rounded-[2.5rem] bg-white border-4 border-slate-50 shadow-[0_20px_40px_-15px_rgba(0,0,0,0.1)] overflow-hidden flex items-center justify-center transition-transform hover:scale-105 duration-500">
                                        @if($foto_url)
                                        <img src="{{ $foto_url }}" class="h-full w-full object-cover">
                                        @else
                                        <div class="h-full w-full bg-slate-50 flex items-center justify-center">
                                            <span class="font-outfit text-4xl font-900 text-[#ff6600] tracking-tighter">{{ $iniciales }}</span>
                                        </div>
                                        @endif
                                    </div>

                                    {{-- INFORMACIÓN PRINCIPAL --}}
                                    <div class="flex-1 w-full">
                                        <div class="text-center lg:text-left mb-8">
                                            <h3 class="font-outfit text-4xl font-800 text-slate-900 uppercase leading-none tracking-tighter">{{ Auth::user()->name }}</h3>
                                            <div class="flex items-center justify-center lg:justify-start gap-2 mt-3">
                                                <span class="h-[1px] w-4 bg-[#ff6600]/40"></span>
                                                <p class="text-[11px] text-[#ff6600] font-black uppercase tracking-[0.3em]">Socio Proponente</p>
                                            </div>
                                        </div>

                                        {{-- GRID DE DATOS: 3 COLUMNAS EN DESKTOP --}}
                                        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 pt-8 border-t border-slate-100">

                                            {{-- Identificación --}}
                                            <div class="flex items-center gap-4 group">
                                                <div class="h-12 w-12 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-400 group-hover:bg-[#ff6600]/10 group-hover:text-[#ff6600] transition-colors duration-300">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-4 0H5m14 0h-5" stroke-width="1.5" />
                                                    </svg>
                                                </div>
                                                <div class="overflow-hidden">
                                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Identificación</p>
                                                    <p class="text-base font-bold text-slate-700 truncate">{{ Auth::user()->identificacion }}</p>
                                                </div>
                                            </div>

                                            {{-- Teléfono --}}
                                            <div class="flex items-center gap-4 group">
                                                <div class="h-12 w-12 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-400 group-hover:bg-[#ff6600]/10 group-hover:text-[#ff6600] transition-colors duration-300">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" stroke-width="1.5" />
                                                    </svg>
                                                </div>
                                                <div class="overflow-hidden">
                                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Teléfono</p>
                                                    <p class="text-base font-bold text-slate-700 truncate">{{ Auth::user()->telefono ?? '---' }}</p>
                                                </div>
                                            </div>

                                            {{-- Correo --}}
                                            <div class="flex items-center gap-4 group md:col-span-2 xl:col-span-1">
                                                <div class="h-12 w-12 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-400 group-hover:bg-[#ff6600]/10 group-hover:text-[#ff6600] transition-colors duration-300">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                                <div class="overflow-hidden">
                                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Correo Electrónico</p>
                                                    <p class="text-base font-bold text-slate-700 truncate" title="{{ Auth::user()->email }}">{{ Auth::user()->email ?? '---' }}</p>
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