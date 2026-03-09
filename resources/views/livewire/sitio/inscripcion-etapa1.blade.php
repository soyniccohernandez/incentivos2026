<div class="w-full"> {{-- ÚNICO ELEMENTO RAÍZ PARA LIVEWIRE --}}

    {{-- NAV PREMIUM INTEGRADO --}}
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
                        <img src="{{ asset('resources/imagenes/logo.png') }}" alt="Logo" class="h-9 w-auto object-contain brightness-200 group-hover:scale-105 transition-transform">
                        <div class="flex flex-col border-l border-white/10 pl-4">
                            <span class="font-outfit text-lg font-900 text-white tracking-tight leading-none group-hover:text-[#ff6600] transition-colors uppercase">
                                PORTAL <span class="text-[#ff6600]">POSTULACIÓN</span>
                            </span>
                            <span class="text-[9px] font-semibold text-gray-500 uppercase tracking-[2px] mt-1 font-inter">
                                Incentivos 2026
                            </span>
                        </div>
                    </a>
                    <div class="hidden lg:flex items-center gap-3 ml-4 bg-white/[0.03] px-4 py-1.5 rounded-full border border-white/5">
                        <div class="w-1.5 h-1.5 bg-[#ff6600] rounded-full animate-pulse shadow-[0_0_8px_#ff6600]"></div>
                        <span class="font-inter text-[11px] font-bold text-gray-400 tracking-wider uppercase">Etapa 01: Inscripción</span>
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
                                <p class="text-xs font-medium text-gray-300 truncate">{{ $this->socio->email }}</p>
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

    <main class="min-h-screen bg-[#f8fafc] font-inter pb-24 pt-10">
        <div class="max-w-7xl mx-auto px-6">

            {{-- HEADER --}}
            <header class="mb-12 flex flex-col md:flex-row md:items-end justify-between gap-6">
                <div class="border-l-4 border-[#ff6600] pl-6">
                    <span class="text-[#ff6600] font-bold text-[10px] uppercase tracking-[4px] mb-2 block">Convocatoria 2026</span>
                    <h1 class="font-outfit text-5xl md:text-6xl font-900 text-slate-800 leading-none uppercase tracking-tighter">
                        INSCRIPCIÓN <span class="text-[#ff6600]">INCENTIVOS</span>
                    </h1>
                </div>
                <div class="hidden md:block text-right">
                    <p class="text-slate-400 font-bold text-[10px] uppercase tracking-[2px]">Módulo de Registro</p>
                    <p class="font-outfit text-xl font-800 text-slate-700 uppercase">Expediente Digital</p>
                </div>
            </header>

            {{-- CONTENEDOR ONBOARDING --}}
            @if($mostrarOnboarding)
            <div x-data="{ step: 1 }" class="fixed inset-0 z-[2000] flex items-center justify-center p-4 md:p-6 bg-slate-900/95 backdrop-blur-md animate-fade-in">
                <div class="bg-white w-full max-w-5xl rounded-[3rem] shadow-2xl border border-white/20 overflow-hidden relative flex flex-col max-h-[90vh]">

                    {{-- Barra de Progreso Superior --}}
                    <div class="absolute top-0 left-0 w-full h-2 bg-slate-100 flex z-50">
                        <div class="h-full bg-[#ff6600] transition-all duration-700 ease-out" :style="'width: ' + (step * 50) + '%'"></div>
                    </div>

                    <div class="p-8 md:p-14 overflow-y-auto">

                        {{-- PASO 1: BIENVENIDA --}}
                        <div x-show="step === 1" x-transition:enter="transition duration-500" x-transition:enter-start="opacity-0 scale-95" class="relative">
                            <div class="text-center py-6">

                                {{-- Identificador Institucional --}}
                                <div class="inline-flex items-center gap-3 mb-8 bg-slate-100 px-6 py-2 rounded-full">
                                    <span class="w-2 h-2 bg-black rounded-full"></span>
                                    <span class="text-black font-inter text-[10px] font-black tracking-[3px] uppercase">Iniciativa de Actores S.C.G.</span>
                                </div>

                                <h2 class="font-bebas text-[4.5rem] md:text-[7rem] leading-[0.85] text-slate-900 mb-8 uppercase tracking-tighter">
                                    HAZ REALIDAD TU <br>
                                    <span class="text-[#ff6600] bg-black px-6 py-2 inline-block my-2 transform -rotate-1">PROYECTO</span> <br>
                                    AUDIOVISUAL
                                </h2>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 max-w-2xl mx-auto mb-10">
                                    <div class="bg-slate-50 border-2 border-black p-6 text-center">
                                        <p class="font-bebas text-5xl text-black">3 INCENTIVOS</p>
                                        <p class="font-inter text-[10px] font-black text-slate-400 uppercase tracking-widest">Cupos Disponibles</p>
                                    </div>
                                    <div class="bg-black text-[#ff6600] p-6 shadow-xl text-center">
                                        <p class="font-bebas text-5xl">$45.000.000</p>
                                        <p class="font-inter text-[10px] font-black text-white/50 uppercase tracking-widest">Por cada Proyecto</p>
                                    </div>
                                </div>

                                <p class="font-inter text-slate-500 text-lg font-bold max-w-2xl mx-auto leading-tight uppercase tracking-tight">
                                    Bienvenido a la <span class="text-black">Convocatoria de Incentivos Audiovisuales 2026</span>,
                                    un espacio dedicado a la creación de cortometrajes de ficción liderados por nuestros
                                    <span class="text-black underline decoration-[#ff6600] decoration-4">Socios</span>.
                                </p>
                            </div>
                        </div>

                        {{-- PASO 2: ACTUALIZACIÓN Y CIERRE --}}
                        <div x-show="step === 2" x-transition:enter="transition duration-500" x-transition:enter-start="opacity-0 scale-95" class="relative max-w-6xl mx-auto px-4 text-center">

                            <div class="py-6">
                                {{-- Identificador Institucional Paso 2 --}}
                                <div class="inline-flex items-center gap-3 mb-12 bg-slate-100 px-6 py-2 rounded-full">
                                    <span class="w-2 h-2 bg-[#ff6600] rounded-full"></span>
                                    <span class="text-black font-inter text-[10px] font-black tracking-[3px] uppercase">Gestión y Actualización</span>
                                </div>

                                <div class="max-w-4xl mx-auto space-y-8">
                                    <p class="font-inter text-slate-800 text-xl md:text-2xl font-bold uppercase tracking-tight leading-tight max-w-2xl mx-auto">
                                        Es fundamental que tus datos estén <span class="text-[#ff6600] underline decoration-black decoration-4">actualizados</span> ante la Sociedad.
                                    </p>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div class="bg-slate-50 border-2 border-black p-8 group hover:bg-[#25D366] transition-all duration-300">
                                            <p class="font-bebas text-4xl text-black mb-3">¿DATOS AL DÍA?</p>
                                            <p class="font-inter text-[10px] font-black text-slate-400 uppercase tracking-widest mb-6 group-hover:text-black">Valida tu estado antes de postularte</p>
                                            <a href="https://wa.me/573174188415?text=Hola,%20quiero%20ver%20si%20mis%20datos%20están%20OK%20para%20la%20convocatoria%20de%20incentivos" target="_blank"
                                                class="inline-block bg-black text-white font-bebas text-lg px-6 py-2 shadow-[4px_4px_0px_0px_rgba(37,211,102,1)] group-hover:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] group-hover:bg-white group-hover:text-black transition-all">
                                                WHATSAPP: 317 4188415
                                            </a>
                                        </div>

                                        <div class="bg-black text-white p-8 border-2 border-black shadow-xl relative overflow-hidden group text-left">
                                            <p class="font-bebas text-4xl text-[#ff6600] mb-3">TU DASHBOARD</p>
                                            <p class="font-inter text-[10px] font-black text-white/50 uppercase tracking-widest mb-4">Panel de Control en tiempo real</p>
                                            <p class="font-inter text-xs font-bold uppercase leading-relaxed text-white/80">
                                                Usa tu usuario y contraseña para acceder al tablero y monitorear el <span class="text-[#ff6600]">Estado de Postulación</span>.
                                            </p>
                                        </div>
                                    </div>

                                    <div class="pt-12">
                                        <p class="font-bebas text-6xl md:text-8xl text-slate-900 tracking-tighter">
                                            ¡MUCHA <span class="text-[#ff6600]">SUERTE!</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- CONTROLES --}}
                        <div class="mt-12 flex flex-col md:flex-row items-center justify-between gap-6 pt-10 border-t border-slate-100">
                            <div class="flex gap-3">
                                <template x-for="i in 2">
                                    <div class="h-1.5 transition-all duration-500 rounded-full"
                                        :class="step === i ? 'w-12 bg-[#ff6600]' : 'w-4 bg-slate-200'"></div>
                                </template>
                            </div>

                            <div class="flex gap-4 w-full md:w-auto">
                                <button x-show="step > 1" @click="step--" class="flex-1 md:flex-none px-10 py-4 text-slate-400 font-bold text-[10px] uppercase tracking-[3px] hover:text-slate-800 transition-colors font-inter">
                                    Regresar
                                </button>

                                <button x-show="step < 2" @click="step++" class="flex-1 md:flex-none px-14 py-4 bg-black text-white rounded-2xl font-bebas text-2xl tracking-[2px] hover:bg-[#ff6600] transition-all shadow-xl shadow-slate-200">
                                    Siguiente
                                </button>

                                <button x-show="step === 2"
                                    wire:click="completarOnboarding"
                                    wire:loading.attr="disabled"
                                    class="flex-1 md:flex-none px-14 py-4 bg-[#ff6600] text-white rounded-2xl font-bebas text-2xl tracking-[2px] hover:bg-slate-800 transition-all shadow-xl shadow-orange-100 disabled:opacity-70 disabled:cursor-not-allowed">

                                    {{-- Texto normal --}}
                                    <span wire:loading.remove>¡COMENZAR INSCRIPCIÓN!</span>

                                    {{-- Texto mientras procesa --}}
                                    <span wire:loading class="flex items-center gap-2">
                                        <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                        PROCESANDO...
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            {{-- FORMULARIO PRINCIPAL --}}
            @if(!$mostrarPasoCero)
            <form wire:submit.prevent="guardar" class="space-y-8 animate-fade-in"> {{-- 1. DATOS PROPONENTE --}}
                <section class="bg-white rounded-[2.5rem] p-10 border border-slate-100 shadow-sm relative overflow-hidden">
                    <div class="mb-8 flex flex-col md:flex-row items-center gap-5 p-5 bg-slate-50 border border-slate-100 rounded-[2rem] transition-all hover:bg-slate-100/50">
                        <div class="flex-shrink-0 w-12 h-12 bg-[#ff6600]/10 rounded-2xl flex items-center justify-center"> <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#ff6600]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg> </div>
                        <div class="flex-grow text-center md:text-left">
                            <h4 class="text-sm font-bold text-slate-700 uppercase tracking-wider">¿Tus datos o foto están desactualizados?</h4>
                            <p class="text-xs text-slate-500 mt-1 leading-relaxed"> Para actualizar tu información personal, visítanos en la oficina principal o contáctanos directamente: <span class="block md:inline-flex items-center gap-4 mt-2 md:mt-0 md:ml-3"> <a href="mailto:socios@actores.org.co" class="text-[#ff6600] font-bold hover:text-orange-700 transition-colors flex items-center gap-1 justify-center"> <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg> socios@actores.org.co </a> <a href="https://wa.me/573174188415" target="_blank" class="text-[#ff6600] font-bold hover:text-orange-700 transition-colors flex items-center gap-1 justify-center"> <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12.031 6.172c-2.32 0-4.591 1.399-4.591 4.582 0 1.053.362 1.9 .876 2.671-.204.781-.711 2.256-.711 2.256.776-.231 2.107-.731 2.801-.941.52.131 1.053.21 1.625.21 2.32 0 4.591-1.399 4.591-4.582 0-3.183-2.271-4.211-4.591-4.211zm3.493 5.922s-.131.331-.44.471c-.3.131-.9.041-1.631-.251-1.14-.451-1.871-1.181-2.261-1.571-.39-.391-.711-.9-.821-1.391-.121-.541.131-.811.271-.951.141-.141.311-.141.411-.141l.241.01c.081 0 .181-.03.261.181.11.271.381.921.411.991.03.071.05.151.01.231-.04.091-.071.141-.141.221-.071.081-.141.161-.21.231-.07.071-.151.151-.06.311.091.161.401.661.861 1.071.591.521 1.091.681 1.251.761.161.081.251.071.341-.031.091-.1.381-.441.481-.591.1-.151.2-.131.341-.081.141.051.891.421 1.041.5.151.07.251.11.281.171.04.061.041.351-.11.751zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z" />
                                        </svg> WhatsApp </a> </span> </p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 mb-10">
                        <div class="h-8 w-1 bg-[#ff6600] rounded-full"></div>
                        <h2 class="font-outfit text-2xl font-800 text-slate-800 uppercase tracking-tight">1. Perfil del Proponente</h2>
                    </div>
                    <div class="flex flex-col lg:flex-row gap-10 items-center lg:items-start">
                        <div class="shrink-0">
                            <div class="w-32 h-32 rounded-[2rem] bg-slate-50 border-2 border-white shadow-inner flex items-center justify-center overflow-hidden"> @if($foto_url) <img src="{{ $foto_url }}" class="w-full h-full object-cover shadow-sm" alt="Foto Proponente"> @else <span class="font-outfit text-5xl font-800 text-slate-200 tracking-tighter"> {{ $iniciales ?? 'SC' }} </span> @endif </div>
                        </div>
                        <div class="flex-grow w-full grid grid-cols-1 md:grid-cols-2 gap-8 text-left">
                            <div> <label class="text-[10px] font-bold text-slate-400 uppercase tracking-[2px] mb-1 block">Socio Titular</label>
                                <p class="font-outfit text-3xl font-800 text-slate-700 uppercase leading-none">{{ mb_strtoupper($socio->name) }}</p>
                                <p class="text-slate-400 font-mono text-sm mt-2">IDENTIFICACIÓN: {{ $socio->identificacion }}</p>
                            </div>
                            <div class="md:text-right"> <label class="text-[10px] font-bold text-slate-400 uppercase tracking-[2px] mb-1 block">Notificación</label>
                                <p class="font-inter text-lg font-bold text-[#ff6600]">{{ $socio->email }}</p>
                                <p class="font-inter text-lg font-bold text-[#ff6600]">{{ $socio->telefono }}</p>
                            </div>

                        </div>
                    </div>
                </section> {{-- 2. DETALLES DE PROPUESTA --}}
                <section class="bg-white rounded-[2.5rem] p-10 border border-slate-100 shadow-sm text-left">
                    <h2 class="font-outfit text-2xl font-800 text-slate-800 uppercase tracking-tight mb-8">2. Detalles de la Propuesta</h2>
                    <div class="text-left"> <label class="text-[10px] font-bold text-slate-400 uppercase tracking-[2px] mb-3 block">Título oficial del proyecto <span class="text-red-500">*</span></label> <input type="text" wire:model.blur="titulo" placeholder="Ej: Mi Gran Documental" class="w-full bg-slate-50 border border-slate-100 rounded-2xl p-5 font-bold text-slate-700 focus:ring-4 focus:ring-orange-50 focus:border-[#ff6600] outline-none transition-all uppercase"> @error('titulo') <span class="text-red-500 text-[10px] font-bold mt-2 block uppercase animate-fade-in">{{ $message }}</span> @enderror </div>
                </section> {{-- 3. PERFIL DEL DIRECTOR --}}
                <section class="bg-white rounded-[2.5rem] p-10 border border-slate-100 shadow-sm text-left">
                    <div class="mb-8">
                        <h2 class="font-outfit text-2xl font-800 text-slate-800 uppercase tracking-tight">3. Perfil del Director</h2>
                    </div>

                    <div class="bg-slate-50/50 p-8 rounded-[3rem] border border-slate-100 mb-10 shadow-sm">
                        <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm transition-all hover:border-orange-100 max-w-lg mx-auto">

                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[3px] mb-6 flex items-center justify-center gap-2">
                                ¿Eres el director del proyecto?
                            </label>

                            <div x-data="{ esDirector: @entangle('directorPropio') }"
                                class="relative flex bg-slate-50 rounded-2xl p-1.5 border border-slate-200 shadow-inner w-full overflow-hidden mx-auto">

                                {{-- Slider Naranja Pro --}}
                                <div class="absolute inset-y-1.5 w-[calc(50%-6px)] bg-[#ff6600] rounded-xl transition-all duration-500 ease-out shadow-lg shadow-orange-500/30"
                                    :class="esDirector === 'si' ? 'left-1.5' : 'left-[calc(50%+3px)]'">
                                </div>

                                {{-- Opción SÍ --}}
                                <label class="relative z-10 flex-1 flex items-center justify-center gap-3 py-4 cursor-pointer transition-all duration-500"
                                    :class="esDirector === 'si' ? 'text-white' : 'text-slate-400 hover:text-slate-600'">
                                    <input type="radio" value="si" x-model="esDirector" class="hidden">
                                    <i class="fas fa-user-check text-xs" :class="esDirector === 'si' ? 'opacity-100' : 'opacity-30'"></i>
                                    <span class="text-[11px] font-black uppercase tracking-widest">SÍ, LO SOY</span>
                                </label>

                                {{-- Opción NO --}}
                                <label class="relative z-10 flex-1 flex items-center justify-center gap-3 py-4 cursor-pointer transition-all duration-500"
                                    :class="esDirector === 'no' ? 'text-white' : 'text-slate-400 hover:text-slate-600'">
                                    <input type="radio" value="no" x-model="esDirector" class="hidden">
                                    <i class="fas fa-users text-xs" :class="esDirector === 'no' ? 'opacity-100' : 'opacity-30'"></i>
                                    <span class="text-[11px] font-black uppercase tracking-widest">NO, ES OTRO</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div x-show="$wire.directorPropio === 'no'"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform -translate-y-4"
                        x-transition:enter-end="opacity-100 transform translate-y-0"
                        x-cloak
                        class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 bg-slate-50/50 p-8 rounded-[2.5rem] border border-dashed border-slate-200 mb-10 shadow-inner">

                        <div>
                            <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-2 block ml-1">Identificación <span class="text-red-500">*</span></label>
                            <input type="text" wire:model.blur="directorIdentificacion" placeholder="Ej: 10203040" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                class="w-full bg-white border @error('directorIdentificacion') border-red-300 @else border-slate-100 @enderror rounded-xl px-4 py-3 text-sm font-bold text-slate-700 outline-none focus:border-[#ff6600] placeholder:text-slate-300 placeholder:font-normal uppercase transition-all shadow-sm">
                            @error('directorIdentificacion') <span class="text-red-500 text-[8px] font-bold mt-1 block uppercase animate-fade-in">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-2 block ml-1">Nombre Completo <span class="text-red-500">*</span></label>
                            <input type="text" wire:model.blur="directorNombre" placeholder="Nombre y Apellidos"
                                class="w-full bg-white border @error('directorNombre') border-red-300 @else border-slate-100 @enderror rounded-xl px-4 py-3 text-sm font-bold text-slate-700 outline-none focus:border-[#ff6600] placeholder:text-slate-300 placeholder:font-normal uppercase transition-all shadow-sm">
                            @error('directorNombre') <span class="text-red-500 text-[8px] font-bold mt-1 block uppercase animate-fade-in">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-2 block ml-1">Celular <span class="text-red-500">*</span></label>
                            <input type="text" wire:model.blur="directorCelular" placeholder="3001234567" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                class="w-full bg-white border @error('directorCelular') border-red-300 @else border-slate-100 @enderror rounded-xl px-4 py-3 text-sm font-bold text-slate-700 outline-none focus:border-[#ff6600] placeholder:text-slate-300 placeholder:font-normal uppercase transition-all shadow-sm">
                            @error('directorCelular') <span class="text-red-500 text-[8px] font-bold mt-1 block uppercase animate-fade-in">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-2 block ml-1">Correo <span class="text-red-500">*</span></label>
                            <input type="email" wire:model.blur="directorCorreo" placeholder="ejemplo@correo.com"
                                class="w-full bg-white border @error('directorCorreo') border-red-300 @else border-slate-100 @enderror rounded-xl px-4 py-3 text-sm font-bold text-slate-700 outline-none focus:border-[#ff6600] placeholder:text-slate-300 placeholder:font-normal transition-all shadow-sm">
                            @error('directorCorreo') <span class="text-red-500 text-[8px] font-bold mt-1 block uppercase animate-fade-in">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    {{-- Grid de Documentos Director --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6"> @php $docsDirector = [ [ 'model' => 'docDirectorCompromiso', 'label' => 'ANEXO 1: MANIFESTACIÓN DEL DIRECTOR', 'desc' => 'Aceptación del cargo de director', 'formato' => 'etapa_01/anexo-01-manifestacion-del-director.pdf', 'hasDownload' => true ], [ 'model' => 'docDirectorExperiencia', 'label' => 'ANEXO 2: EXPERIENCIA COMO DIRECTOR GENERAL', 'desc' => 'Experiencia general', 'formato' => 'etapa_01/anexo-02-experiencia-director-general.pdf', 'hasDownload' => true ], [ 'model' => 'docDirectorEvidencia1', 'label' => 'Certificado de experiencia 1', 'desc' => 'Adjunte en un solo archivo PDF el certificado contractual y las evidencias correspondientes a la primera experiencia de dirección relacionada anteriormente en el anexo 2.', 'formato' => null, 'hasDownload' => false ], [ 'model' => 'docDirectorEvidencia2', 'label' => 'Certificado de experiencia 2', 'desc' => 'Adjunte en un solo archivo PDF el certificado contractual y las evidencias correspondientes a la segunda experiencia de dirección relacionada anteriormente en el anexo 2.', 'formato' => null, 'hasDownload' => false ], ]; @endphp @foreach($docsDirector as $doc) <div class="p-6 bg-slate-50/50 rounded-[2rem] border border-slate-100 flex flex-col justify-between group hover:border-orange-200 transition-all" x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">
                            <div class="mb-6">
                                <h4 class="font-outfit text-sm font-800 text-slate-700 uppercase mb-1 text-center"> {{ $doc['label'] }} <span class="text-red-500">*</span> </h4>
                                <p class="text-[10px] text-slate-400 font-medium uppercase tracking-tighter text-center"> {{ $doc['desc'] }} </p>
                            </div>
                            <div class="space-y-4"> @if($doc['hasDownload']) <a href="{{ asset('storage/formatos/'.$doc['formato']) }}"
                                    target="_blank"
                                    class="block w-full text-center py-3 bg-[#ff6600] text-white rounded-xl text-[10px] font-black uppercase tracking-[2px] border-2 border-[#ff6600] hover:bg-transparent hover:text-[#ff6600] transition-all duration-300 shadow-lg shadow-orange-500/20">
                                    <div class="flex items-center justify-center gap-2">
                                        <i class="fas fa-file-pdf text-sm"></i>
                                        DESCARGAR FORMATO
                                    </div>
                                </a> @else <div class="py-1 text-[9px] font-bold text-slate-300 uppercase tracking-widest text-center border border-transparent"> Documento Libre (Sin Formato) </div> @endif <div class="relative" wire:key="wrap-{{ $doc['model'] }}-{{ $this->{$doc['model']} ? 'filled' : 'empty' }}"> @if(!$this->{$doc['model']}) <label x-show="!isUploading" class="flex flex-col items-center justify-center w-full h-24 border-2 border-dashed border-slate-200 rounded-2xl cursor-pointer hover:bg-white hover:border-[#ff6600]/30 transition-all group/up animate-fade-in"> <svg class="w-6 h-6 text-slate-300 group-hover/up:text-[#ff6600] mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" stroke-width="2" stroke-linecap="round" />
                                        </svg> <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Subir PDF</span> <input type="file" wire:model.live="{{ $doc['model'] }}" class="hidden" accept=".pdf" /> </label>
                                    <div x-show="isUploading" x-cloak class="w-full h-24 flex flex-col items-center justify-center bg-white border-2 border-orange-100 rounded-2xl animate-pulse">
                                        <div class="w-3/4 h-1.5 bg-slate-100 rounded-full overflow-hidden mb-2">
                                            <div class="h-full bg-[#ff6600] transition-all duration-300" :style="'width: ' + progress + '%'"></div>
                                        </div> <span class="text-[8px] font-black text-[#ff6600] uppercase tracking-widest">Cargando <span x-text="progress"></span>%</span>
                                    </div> @else <div class="bg-white border border-emerald-100 p-4 rounded-2xl flex items-center justify-between shadow-sm animate-fade-in">
                                        <div class="flex items-center gap-3 truncate">
                                            <div class="h-8 w-8 bg-emerald-50 rounded-lg flex items-center justify-center text-emerald-500"> <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path d="M5 13l4 4L19 7" stroke-width="3" stroke-linecap="round" />
                                                </svg> </div> <span class="text-[9px] font-bold text-slate-600 truncate uppercase"> {{ $this->{$doc['model']}->getClientOriginalName() }} </span>
                                        </div> <button type="button" @click="isUploading = false; progress = 0; $wire.limpiarDocumento('{{ $doc['model'] }}')" class="text-slate-300 hover:text-red-500 transition-colors cursor-pointer">✕</button>
                                    </div> @endif
                                </div> @error($doc['model']) <span class="text-red-500 text-[9px] font-bold block uppercase animate-fade-in mt-1">{{ $message }}</span> @enderror </div>
                        </div> @endforeach
                    </div>
                </section> {{-- 4. GUION --}}
                <section class="bg-white rounded-[2.5rem] p-10 border border-slate-100 shadow-sm text-left">
                    <h2 class="font-outfit text-2xl font-800 text-slate-800 uppercase tracking-tight mb-8">4. Derechos de Guion</h2>
                    <div class="bg-slate-50/50 p-8 rounded-3xl border border-slate-100">
                        <div class="bg-slate-50/50 p-6 rounded-[2rem] border border-slate-100 shadow-sm transition-all hover:border-orange-100 max-w-lg mx-auto">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[3px] mb-6 flex items-center justify-center gap-2">
                                ¿El guion es de tu total autoría?
                            </label>

                            <div x-data="{ autoria: @entangle('autoria') }"
                                class="relative flex bg-white rounded-2xl p-1.5 border border-slate-200 shadow-inner w-full overflow-hidden mx-auto">

                                {{-- Slider Naranja que se desplaza --}}
                                <div class="absolute inset-y-1.5 w-[calc(50%-6px)] bg-[#ff6600] rounded-xl transition-all duration-500 ease-out shadow-lg shadow-orange-500/30"
                                    :class="autoria === 'si' ? 'left-1.5' : 'left-[calc(50%+3px)]'">
                                </div>

                                {{-- Opción SÍ --}}
                                <label class="relative z-10 flex-1 flex items-center justify-center gap-3 py-4 cursor-pointer transition-all duration-500"
                                    :class="autoria === 'si' ? 'text-white' : 'text-slate-400 hover:text-slate-600'">
                                    <input type="radio" value="si" wire:model.live="autoria" x-model="autoria" class="hidden">
                                    <i class="fas fa-pen-nib text-xs" :class="autoria === 'si' ? 'opacity-100' : 'opacity-30'"></i>
                                    <span class="text-xs font-black uppercase tracking-widest">SÍ, ES MÍO</span>
                                </label>

                                {{-- Opción NO --}}
                                <label class="relative z-10 flex-1 flex items-center justify-center gap-3 py-4 cursor-pointer transition-all duration-500"
                                    :class="autoria === 'no' ? 'text-white' : 'text-slate-400 hover:text-slate-600'">
                                    <input type="radio" value="no" wire:model.live="autoria" x-model="autoria" class="hidden">
                                    <i class="fas fa-file-contract text-xs" :class="autoria === 'no' ? 'opacity-100' : 'opacity-30'"></i>
                                    <span class="text-xs font-black uppercase tracking-widest">NO</span>
                                </label>
                            </div>
                        </div>

                        {{-- Bloque de carga centrado --}}
                        <div x-show="$wire.autoria === 'no'" x-transition x-cloak class="pt-10 border-t border-slate-200 mt-8">
                            <div class="flex flex-col items-center"> {{-- Contenedor flex para centrar contenido --}}
                                <div class="w-full max-w-md">
                                    <div class="p-6 bg-white rounded-[2rem] border border-slate-100 flex flex-col justify-between group hover:border-orange-200 transition-all shadow-sm" x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">
                                        <div class="mb-6 text-center"> {{-- Texto centrado --}}
                                            <h4 class="font-outfit text-sm font-800 text-slate-700 uppercase mb-1">ANEXO 3: AUTORIZACIÓN USO DEL GUION <span class="text-red-500">*</span></h4>
                                            <p class="text-[10px] text-slate-400 font-medium uppercase tracking-tighter text-center">Cesión de derechos de uso de guion</p>
                                        </div>

                                        <div class="space-y-4">
                                            <a href="{{ asset('storage/formatos/etapa_01/anexo-03-autorizacion-uso-de-guion.pdf') }}"
                                                target="_blank"
                                                class="block w-full text-center py-3 bg-[#ff6600] text-white rounded-xl text-[10px] font-black uppercase tracking-[2px] border-2 border-[#ff6600] hover:bg-transparent hover:text-[#ff6600] transition-all duration-300 shadow-lg shadow-orange-500/20">
                                                <div class="flex items-center justify-center gap-2">
                                                    <i class="fas fa-file-pdf text-sm"></i>
                                                    DESCARGAR FORMATO
                                                </div>
                                            </a>

                                            <div class="relative" wire:key="wrap-guion-{{ $guionArchivo ? 'filled' : 'empty' }}">
                                                @if(!$guionArchivo)
                                                <label x-show="!isUploading" class="flex flex-col items-center justify-center w-full h-28 border-2 border-dashed border-slate-200 rounded-2xl cursor-pointer hover:bg-slate-50 hover:border-[#ff6600]/30 transition-all group/up animate-fade-in">
                                                    <svg class="w-6 h-6 text-slate-300 group-hover/up:text-[#ff6600] mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" stroke-width="2" stroke-linecap="round" />
                                                    </svg>
                                                    <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Subir Anexo 3</span>
                                                    <input type="file" wire:model.live="guionArchivo" class="hidden" accept=".pdf" />
                                                </label>

                                                <div x-show="isUploading" x-cloak class="w-full h-28 flex flex-col items-center justify-center bg-white border-2 border-orange-100 rounded-2xl animate-pulse">
                                                    <div class="w-3/4 h-1.5 bg-slate-100 rounded-full overflow-hidden mb-2">
                                                        <div class="h-full bg-[#ff6600] transition-all duration-300" :style="'width: ' + progress + '%'"></div>
                                                    </div>
                                                    <span class="text-[8px] font-black text-[#ff6600] uppercase tracking-widest">Cargando <span x-text="progress"></span>%</span>
                                                </div>
                                                @else
                                                <div class="bg-slate-50 border border-emerald-100 p-4 rounded-2xl flex items-center justify-between shadow-sm animate-fade-in">
                                                    <div class="flex items-center gap-3 truncate">
                                                        <div class="h-8 w-8 bg-emerald-50 rounded-lg flex items-center justify-center text-emerald-500">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path d="M5 13l4 4L19 7" stroke-width="3" stroke-linecap="round" />
                                                            </svg>
                                                        </div>
                                                        <span class="text-[9px] font-bold text-slate-600 truncate uppercase">{{ $guionArchivo->getClientOriginalName() }}</span>
                                                    </div>
                                                    <button type="button" @click="isUploading = false; progress = 0; $wire.limpiarDocumento('guionArchivo')" class="text-slate-300 hover:text-red-500 transition-colors cursor-pointer">✕</button>
                                                </div>
                                                @endif
                                            </div>
                                            @error('guionArchivo') <span class="text-red-500 text-[9px] font-bold block uppercase animate-fade-in mt-1 text-center">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section> {{-- 5. DECLARACIONES --}}
                <section class="bg-white rounded-[2.5rem] p-10 border border-slate-100 shadow-sm text-left">
                    <h2 class="font-outfit text-2xl font-800 text-slate-800 uppercase tracking-tight mb-8">5. Declaraciones Finales</h2>
                    <div class="bg-slate-50/50 p-8 rounded-3xl border border-slate-100 space-y-10">
                        <div class="max-w-md mx-auto">
                            <div class="p-6 bg-white rounded-[2rem] border border-slate-100 flex flex-col justify-between group hover:border-orange-200 transition-all" x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">
                                <div class="mb-6 text-center">
                                    <h4 class="font-outfit text-sm font-800 text-slate-700 uppercase mb-1">ANEXO 4: CONSIDERACIONES Y DECLARACIONES GENERALES <span class="text-red-500">*</span></h4>
                                    <p class="text-[10px] text-slate-400 font-medium uppercase tracking-tighter">Documento firmado por el proponente</p>
                                </div>
                                <div class="space-y-4"> <a href="{{ asset('storage/formatos/etapa_01/anexo-04-consideraciones-y-declaraciones.pdf') }}"
                                        target="_blank"
                                        class="block w-full text-center py-3 bg-[#ff6600] text-white rounded-xl text-[10px] font-black uppercase tracking-[2px] border-2 border-[#ff6600] hover:bg-transparent hover:text-[#ff6600] transition-all duration-300 shadow-lg shadow-orange-500/20">
                                        <div class="flex items-center justify-center gap-2">
                                            <i class="fas fa-file-pdf text-sm"></i>
                                            DESCARGAR ANEXO 4
                                        </div>
                                    </a>
                                    <div class="relative" wire:key="wrap-firmado-{{ $formatoFirmado ? 'filled' : 'empty' }}"> @if(!$formatoFirmado) <label x-show="!isUploading" class="flex flex-col items-center justify-center w-full h-24 border-2 border-dashed border-slate-200 rounded-2xl cursor-pointer hover:bg-slate-50 hover:border-[#ff6600]/30 transition-all group/up animate-fade-in"> <svg class="w-6 h-6 text-slate-300 group-hover/up:text-[#ff6600] mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" stroke-width="2" stroke-linecap="round" />
                                            </svg> <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Subir Anexo 4 firmado</span> <input type="file" wire:model.live="formatoFirmado" class="hidden" accept=".pdf" /> </label>
                                        <div x-show="isUploading" x-cloak class="w-full h-24 flex flex-col items-center justify-center bg-white border-2 border-orange-100 rounded-2xl animate-pulse">
                                            <div class="w-3/4 h-1.5 bg-slate-100 rounded-full overflow-hidden mb-2">
                                                <div class="h-full bg-[#ff6600] transition-all duration-300" :style="'width: ' + progress + '%'"></div>
                                            </div> <span class="text-[8px] font-black text-[#ff6600] uppercase tracking-widest">Cargando <span x-text="progress"></span>%</span>
                                        </div> @else <div class="bg-slate-50 border border-emerald-100 p-4 rounded-2xl flex items-center justify-between shadow-sm animate-fade-in">
                                            <div class="flex items-center gap-3 truncate">
                                                <div class="h-8 w-8 bg-emerald-50 rounded-lg flex items-center justify-center text-emerald-500"> <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path d="M5 13l4 4L19 7" stroke-width="3" stroke-linecap="round" />
                                                    </svg> </div> <span class="text-[9px] font-bold text-slate-600 truncate uppercase">{{ $formatoFirmado->getClientOriginalName() }}</span>
                                            </div> <button type="button" @click="isUploading = false; progress = 0; $wire.limpiarDocumento('formatoFirmado')" class="text-slate-300 hover:text-red-500 transition-colors cursor-pointer">✕</button>
                                        </div> @endif
                                    </div> @error('formatoFirmado') <span class="text-red-500 text-[9px] font-bold block uppercase animate-fade-in mt-1">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="space-y-4 max-w-2xl mx-auto"> <label class="flex items-center gap-5 p-5 bg-white rounded-2xl border border-slate-100 cursor-pointer hover:border-[#ff6600]/30 transition-all group"> <input type="checkbox" wire:model.live="aceptaTerminos" class="w-6 h-6 accent-[#ff6600] cursor-pointer"> <span class="text-xs md:text-sm font-semibold text-slate-600 uppercase tracking-tight">Acepto, de manera voluntaria, previa, explícita e informada los términos y ondiciones establecidos en la presente convocatoria.</span> </label> @error('aceptaTerminos') <span class="text-red-500 text-[10px] font-bold ml-5 uppercase block animate-fade-in">{{ $message }}</span> @enderror <label class="flex items-center gap-5 p-5 bg-white rounded-2xl border border-slate-100 cursor-pointer hover:border-[#ff6600]/30 transition-all group"> <input type="checkbox" wire:model.live="aceptaDatos" class="w-6 h-6 accent-[#ff6600] cursor-pointer"> <span class="text-xs md:text-sm font-semibold text-slate-600 uppercase tracking-tight">Autorizo de manera voluntaria, previa, explícita e informada a Actores Sociedad
                                    Colombiana de Gestión (ACTORES S.C.G.) para tratar mis datos personales de
                                    acuerdo con la Política de Tratamiento de Datos Personales de la Sociedad, lo
                                    establecido en la presente convocatoria y para los fines relacionados con su objeto
                                    social y en especial para fines legales, contractuales, comerciales descritos en la
                                    Política de Tratamiento de Datos Personales. La información obtenida para el
                                    Tratamiento de mis datos personales la he suministrado de forma voluntaria y es
                                    verídica.</span> </label> @error('aceptaDatos') <span class="text-red-500 text-[10px] font-bold ml-5 uppercase block animate-fade-in">{{ $message }}</span> @enderror </div>
                    </div>
                </section> {{-- BOTÓN DE CIERRE --}}
                <div class="text-center pt-10">

                    <button type="submit" wire:loading.attr="disabled" wire:target="guardar" class="w-full max-w-xl h-24 bg-[#ff6600] text-white rounded-[2rem] font-outfit shadow-2xl shadow-orange-100 hover:bg-slate-800 transition-all mx-auto cursor-pointer disabled:opacity-80 flex items-center justify-center overflow-hidden">
                        <div class="relative w-full h-full flex items-center justify-center">
                            <div wire:loading.remove wire:target="guardar" class="flex items-center justify-center gap-3 px-4"> <span class="text-2xl font-900 uppercase tracking-[2px] whitespace-nowrap"> Finalizar e Inscribir </span> <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M13 7l5 5m0 0l-5 5m5-5H6" stroke-width="3" stroke-linecap="round" />
                                </svg> </div>
                            <div wire:loading.flex wire:target="guardar" class="absolute inset-0 items-center justify-center gap-4 px-4 bg-inherit rounded-[2rem]"> <svg class="animate-spin h-7 w-7 text-white flex-shrink-0" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg> <span class="text-xl font-900 uppercase tracking-[2px] whitespace-nowrap"> Enviando Registro... </span> </div>
                        </div>
                    </button>
                </div>
            </form>
            @endif

        </div>
    </main>
</div>