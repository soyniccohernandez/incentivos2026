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
                                <p class="text-xs font-medium text-gray-300 truncate">{{ $this->maskEmail($this->socio->email) }}</p>
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

            {{-- PASO 0: VERIFICACIÓN (OTP) --}}
            @if($mostrarPasoCero)
            <section wire:key="paso-cero" x-data="{ timer: 0, interval: null, codigoLocal: '', mostrarSoporte: @js($socio->otp_requests >= $this->maxIntentos), startTimer(seconds) { if (this.timer > 0) return; clearInterval(this.interval); this.timer = Math.ceil(seconds); this.interval = setInterval(() => { if (this.timer > 0) this.timer--; else { clearInterval(this.interval); this.timer = 0; } }, 1000); } }" x-init=" @if($socio->otp_last_sent_at) @php $restante = $this->segundosEntreIntentos - now()->diffInSeconds($socio->otp_last_sent_at); @endphp @if($restante > 0) if(timer === 0) startTimer({{ $restante }}); @endif @endif $watch('$wire.socio.otp_requests', value => { if (value >= @js($this->maxIntentos)) mostrarSoporte = true; }); " @timer-reset.window="timer = 0; startTimer($event.detail.seconds)">
                <div class="bg-white rounded-[2.5rem] md:rounded-[4rem] p-6 md:p-20 border border-slate-100 shadow-2xl relative overflow-hidden min-h-[600px] flex flex-col justify-center">
                    <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-[#ff6600] to-orange-400"></div>

                    {{-- VISTA SOPORTE --}}
                    <div x-show="mostrarSoporte" x-cloak x-transition class="animate-in fade-in zoom-in duration-300">
                        @if($socio->otp_requests < $this->maxIntentos)
                            <button @click="mostrarSoporte = false" class="mb-8 inline-flex items-center gap-2 text-slate-400 hover:text-[#ff6600] font-bold text-[10px] uppercase tracking-widest"> ← Volver a la verificación </button>
                            @endif
                            @if($socio->otp_requests >= $this->maxIntentos)
                            <div class="mb-10 bg-red-50 border-l-4 border-red-500 p-6 rounded-r-3xl animate-fade-in text-left">
                                <div class="flex items-center gap-4">
                                    <div class="bg-red-500 p-2 rounded-full text-white"> <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                        </svg> </div>
                                    <div>
                                        <h3 class="text-red-800 font-900 uppercase text-sm tracking-tight">Acceso Bloqueado</h3>
                                        <p class="text-red-600/80 text-xs font-bold uppercase mt-1">Has agotado tus {{ $this->maxIntentos }} intentos. Contacta soporte para desbloquear.</p>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <h2 class="font-outfit text-4xl md:text-5xl text-slate-800 uppercase mb-2 leading-tight">
                                Gestión de <span class="text-[#ff6600]">Socios</span>
                            </h2>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-10">

                                <div class="group relative overflow-hidden p-8 bg-white border border-slate-100 rounded-3xl shadow-sm hover:shadow-xl hover:border-[#ff6600]/20 transition-all duration-500 text-left">
                                    <div class="absolute -right-4 -bottom-4 text-slate-200 group-hover:text-[#ff6600]/10 transition-colors duration-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.246 2.248 3.484 5.232 3.484 8.412-.003 6.557-5.338 11.892-11.893 11.892-1.997-.001-3.951-.5-5.688-1.448l-6.309 1.656zm6.224-3.82l.303.18c1.397.831 2.993 1.27 4.617 1.271 5.033 0 9.13-4.097 9.133-9.129.002-2.438-.949-4.73-2.678-6.46s-4.022-2.68-6.46-2.682c-5.033 0-9.13 4.099-9.133 9.131-.001 1.674.452 3.3 1.311 4.704l.198.324-1.002 3.66 3.74-.982-.029-.015z" />
                                        </svg>
                                    </div>

                                    <div class="relative z-10">
                                        <span class="text-[10px] font-black text-[#ff6600] uppercase block mb-2 tracking-[3px]">WhatsApp Directo</span>
                                        <p class="text-slate-800 font-bold text-xl lg:text-2xl break-words tracking-tight">+57 317 4188415</p>
                                        <a href="https://wa.me/573174188415" target="_blank" class="mt-4 inline-flex items-center text-[10px] font-bold text-slate-400 group-hover:text-[#ff6600] transition-colors uppercase tracking-widest">
                                            Iniciar chat
                                            <span class="ml-2 transform group-hover:translate-x-1 transition-transform">→</span>
                                        </a>
                                    </div>
                                </div>

                                <div class="group relative overflow-hidden p-8 bg-white border border-slate-100 rounded-3xl shadow-sm hover:shadow-xl hover:border-[#ff6600]/20 transition-all duration-500 text-left">
                                    <div class="absolute -right-4 -bottom-4 text-slate-200 group-hover:text-[#ff6600]/10 transition-colors duration-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M0 3v18h24v-18h-24zm6.623 7.929l-4.623 5.712v-9.458l4.623 3.746zm-4.141-5.929h19.035l-9.517 7.713-9.518-7.713zm5.694 7.188l3.824 3.099 3.83-3.104 5.612 8.138h-18.745l5.479-8.133zm9.201-1.259l4.623-3.746v9.458l-4.623-5.712z" />
                                        </svg>
                                    </div>

                                    <div class="relative z-10">
                                        <span class="text-[10px] font-black text-[#ff6600] uppercase block mb-2 tracking-[3px]">Enviar Correo</span>
                                        <p class="text-slate-800 font-bold text-xl lg:text-2xl break-all tracking-tight">socios@actores.org.co</p>
                                        <a href="mailto:socios@actores.org.co" class="mt-4 inline-flex items-center text-[10px] font-bold text-slate-400 group-hover:text-[#ff6600] transition-colors uppercase tracking-widest">
                                            Abrir e-mail
                                            <span class="ml-2 transform group-hover:translate-x-1 transition-transform">→</span>
                                        </a>
                                    </div>
                                </div>

                            </div>
                    </div>

                    {{-- VISTA FLUJO OTP --}}
                    <div x-show="!mostrarSoporte" x-transition>
                        @if(!$otpEnviado)
                        {{-- PANTALLA 1: CONFIRMACIÓN --}}
                        <div class="text-center animate-fade-in" wire:key="vista-confirmacion">
                            <div class="inline-flex items-center justify-center w-20 h-20 bg-orange-50 rounded-3xl mb-8 border border-orange-100"> <svg class="w-10 h-10 text-[#ff6600]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg> </div>
                            <div class="mb-6 max-w-md mx-auto"> @if(session()->has('message')) <div class="bg-emerald-50 text-emerald-600 border border-emerald-100 px-4 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest animate-fade-in"> {{ session('message') }} </div> @endif </div>
                            <h2 class="font-outfit text-4xl md:text-6xl font-900 text-slate-800 uppercase tracking-tighter mb-6 leading-none">Confirma tu Correo</h2>
                            <p class="text-slate-500 text-lg md:text-xl font-medium max-w-2xl mx-auto mb-12">Enviaremos un código de seguridad <span class="text-[#ff6600] font-800 underline decoration-orange-200">únicamente a tu correo</span> registrado.</p>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8 max-w-4xl mx-auto text-left">
                                <div class="bg-slate-50 border border-slate-100 p-8 rounded-[2.5rem]"> <label class="block text-[10px] uppercase font-black text-slate-400 tracking-[3px] mb-2">Correo de destino</label>
                                    <p class="text-slate-700 font-outfit text-xl md:text-2xl font-800 truncate">{{ $this->maskEmail($this->socio->email) }}</p>
                                </div>
                                <div class="bg-slate-50 border border-slate-100 p-8 rounded-[2.5rem]"> <label class="block text-[10px] uppercase font-black text-slate-400 tracking-[3px] mb-2">Referencia Celular</label>
                                    <p class="text-slate-700 font-outfit text-xl md:text-2xl font-800">{{ $this->maskPhone($socio->telefono) }}</p>
                                </div>
                            </div>
                            <div class="flex flex-col md:flex-row gap-4 justify-center items-center">
                                <button @click="mostrarSoporte = true" class="w-full md:w-auto px-10 py-5 text-slate-400 font-outfit text-sm font-800 uppercase tracking-widest hover:text-red-500 transition-all">No, debo actualizar datos</button>
                                <button wire:click="enviarCodigo" wire:loading.attr="disabled" class="w-full md:w-auto px-12 py-6 bg-[#ff6600] text-white rounded-2xl font-outfit text-xl font-800 uppercase tracking-widest shadow-xl shadow-orange-200 hover:bg-slate-800 transition-all"> <span wire:loading.remove wire:target="enviarCodigo">SÍ, ENVIAR CÓDIGO</span> <span wire:loading wire:target="enviarCodigo">ENVIANDO...</span> </button>
                            </div>
                        </div>
                        @else
                        {{-- PANTALLA 2: INPUT DEL CÓDIGO --}}
                        <div class="max-w-xl mx-auto text-center animate-fade-in" wire:key="vista-otp">
                            <button wire:click="$set('otpEnviado', false)" class="mb-8 inline-flex items-center gap-2 text-slate-400 hover:text-slate-600 font-bold text-[10px] uppercase tracking-widest transition-all group">
                                <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M15 19l-7-7 7-7" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                                </svg> Cambiar método / Volver
                            </button>

                            <div class="inline-flex items-center justify-center w-20 h-20 bg-orange-50 rounded-3xl mb-8 border border-orange-100">
                                <svg class="w-10 h-10 text-[#ff6600]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>

                            <h2 class="font-outfit text-4xl font-900 text-slate-800 uppercase mb-4">Ingresa el Código</h2>
                            <p class="text-slate-500 mb-10 text-lg">Revisa tu bandeja de entrada en:<br><span class="font-bold text-slate-800">{{ $this->maskEmail($this->socio->email) }}</span></p>

                            <div class="space-y-6 text-center">
                                <div class="relative">
                                    <input type="text" x-model="codigoLocal" wire:model.defer="codigoUsuario" maxlength="6" oninput="this.value = this.value.replace(/[^0-9]/g, '')" placeholder="000000" class="w-full bg-slate-50 border-2 border-slate-100 rounded-[2rem] py-8 text-center font-outfit text-6xl font-900 text-[#ff6600] tracking-[10px] focus:ring-8 focus:ring-orange-100 outline-none transition-all">
                                    @error('codigoUsuario')
                                    <div class="mt-4 bg-red-50 text-red-600 py-2 px-4 rounded-xl text-[11px] font-black uppercase tracking-widest animate-fade-in"> {{ $message }} </div>
                                    @enderror
                                </div>

                                <button wire:click="validarCodigo" wire:loading.attr="disabled" :disabled="codigoLocal.length !== 6" class="w-full py-6 bg-slate-800 text-white rounded-2xl font-outfit text-xl font-800 uppercase tracking-widest hover:bg-[#ff6600] transition-all shadow-xl disabled:opacity-30 disabled:cursor-not-allowed">
                                    <span wire:loading.remove wire:target="validarCodigo">VERIFICAR E INGRESAR</span>
                                    <span wire:loading wire:target="validarCodigo">VALIDANDO...</span>
                                </button>

                                {{-- ZONA DEL TIMER: Con wire:ignore para que el contador de Alpine no se resetee al validar --}}
                                <div class="pt-4 border-t border-slate-100" wire:ignore>
                                    @if($socio->otp_requests < $this->maxIntentos)
                                        <div x-show="timer > 0" class="text-[10px] font-bold text-slate-400 uppercase">
                                            Reenvío disponible en: <span class="text-[#ff6600]" x-text="timer"></span>s
                                        </div>
                                        <button x-show="timer <= 0" wire:click="enviarCodigo" class="text-[#ff6600] font-black text-[11px] uppercase underline hover:text-slate-800 transition-colors">
                                            ¿No te llegó? Nuevo intento #{{ $socio->otp_requests + 1 }}
                                        </button>
                                        @else
                                        <div class="space-y-4">
                                            <p class="text-red-500 font-black text-[10px] uppercase">Límite de intentos alcanzado</p>
                                            <button @click="mostrarSoporte = true" class="bg-red-50 text-red-600 px-6 py-2 rounded-full text-[10px] font-black uppercase tracking-widest border border-red-100">
                                                Contactar Soporte
                                            </button>
                                        </div>
                                        @endif
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </section>
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
                            </div>
                        </div>
                    </div>
                </section> {{-- 2. DETALLES DE PROPUESTA --}}
                <section class="bg-white rounded-[2.5rem] p-10 border border-slate-100 shadow-sm text-left">
                    <h2 class="font-outfit text-2xl font-800 text-slate-800 uppercase tracking-tight mb-8">2. Detalles de la Propuesta</h2>
                    <div class="text-left"> <label class="text-[10px] font-bold text-slate-400 uppercase tracking-[2px] mb-3 block">Título oficial del proyecto <span class="text-red-500">*</span></label> <input type="text" wire:model.blur="titulo" placeholder="Ej: Mi Gran Documental" class="w-full bg-slate-50 border border-slate-100 rounded-2xl p-5 font-bold text-slate-700 focus:ring-4 focus:ring-orange-50 focus:border-[#ff6600] outline-none transition-all uppercase"> @error('titulo') <span class="text-red-500 text-[10px] font-bold mt-2 block uppercase animate-fade-in">{{ $message }}</span> @enderror </div>
                </section> {{-- 3. PERFIL DEL DIRECTOR --}}
                <section class="bg-white rounded-[2.5rem] p-10 border border-slate-100 shadow-sm text-left">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-10">
                        <h2 class="font-outfit text-2xl font-800 text-slate-800 uppercase tracking-tight">3. Perfil del Director</h2>
                        <div class="flex items-center gap-3 bg-slate-50 p-2 rounded-xl border border-slate-100"> <span class="text-[9px] font-bold text-slate-400 uppercase px-3 tracking-widest">¿Eres el director?</span>
                            <div class="flex bg-white rounded-lg p-1 shadow-sm border border-slate-100"> <label class="px-6 py-1.5 rounded-md cursor-pointer transition-all {{ $directorPropio === 'si' ? 'bg-[#ff6600] text-white shadow-md' : 'text-slate-400 hover:text-slate-600' }}"> <input type="radio" value="si" wire:model.live="directorPropio" class="hidden"> <span class="text-[10px] font-black">SÍ</span> </label> <label class="px-6 py-1.5 rounded-md cursor-pointer transition-all {{ $directorPropio === 'no' ? 'bg-[#ff6600] text-white shadow-md' : 'text-slate-400 hover:text-slate-600' }}"> <input type="radio" value="no" wire:model.live="directorPropio" class="hidden"> <span class="text-[10px] font-black">NO</span> </label> </div>
                        </div>
                    </div> {{-- Campos condicionales Director --}}
                    <div x-show="$wire.directorPropio === 'no'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform -translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0" x-cloak class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 bg-slate-50/50 p-6 rounded-3xl border border-dashed border-slate-200 mb-10"> @foreach(['directorIdentificacion' => 'Identificación', 'directorNombre' => 'Nombre Completo', 'directorCelular' => 'Celular', 'directorCorreo' => 'Correo'] as $model => $label) <div> <label class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mb-1 block ml-1"> {{ $label }} <span class="text-red-500">*</span> </label> <input type="text" wire:model.blur="{{ $model }}" placeholder="Obligatorio" class="w-full bg-white border @error($model) border-red-300 @else border-slate-100 @enderror rounded-xl px-4 py-3 text-sm font-bold text-slate-700 outline-none focus:border-[#ff6600] uppercase transition-all"> @error($model) <span class="text-red-500 text-[8px] font-bold mt-1 block uppercase animate-fade-in">{{ $message }}</span> @enderror </div> @endforeach </div> {{-- Grid de Documentos Director --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6"> @php $docsDirector = [ [ 'model' => 'docDirectorCompromiso', 'label' => 'ANEXO 1: MANIFESTACIÓN DEL DIRECTOR', 'desc' => 'Aceptación del cargo de director', 'formato' => 'etapa_01/anexo-01-manifestacion-del-director.pdf', 'hasDownload' => true ], [ 'model' => 'docDirectorExperiencia', 'label' => 'ANEXO 2: EXPERIENCIA COMO DIRECTOR GENERAL', 'desc' => 'Filmografía y experiencia general', 'formato' => 'etapa_01/anexo-02-experiencia-director-general.pdf', 'hasDownload' => true ], [ 'model' => 'docDirectorEvidencia1', 'label' => 'Evidencia de Soporte 1', 'desc' => 'Certificado o contrato previo', 'formato' => null, 'hasDownload' => false ], [ 'model' => 'docDirectorEvidencia2', 'label' => 'Evidencia de Soporte 2', 'desc' => 'Certificado o contrato previo', 'formato' => null, 'hasDownload' => false ], ]; @endphp @foreach($docsDirector as $doc) <div class="p-6 bg-slate-50/50 rounded-[2rem] border border-slate-100 flex flex-col justify-between group hover:border-orange-200 transition-all" x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">
                            <div class="mb-6">
                                <h4 class="font-outfit text-sm font-800 text-slate-700 uppercase mb-1"> {{ $doc['label'] }} <span class="text-red-500">*</span> </h4>
                                <p class="text-[10px] text-slate-400 font-medium uppercase tracking-tighter"> {{ $doc['desc'] }} </p>
                            </div>
                            <div class="space-y-4"> @if($doc['hasDownload']) <a href="{{ asset('storage/formatos/'.$doc['formato']) }}" target="_blank" class="block w-full text-center py-2.5 bg-white text-slate-600 rounded-xl text-[9px] font-black uppercase tracking-widest border border-slate-200 hover:border-[#ff6600] hover:text-[#ff6600] transition-all"> Descargar Formato </a> @else <div class="py-1 text-[9px] font-bold text-slate-300 uppercase tracking-widest text-center border border-transparent"> Documento Libre (Sin Formato) </div> @endif <div class="relative" wire:key="wrap-{{ $doc['model'] }}-{{ $this->{$doc['model']} ? 'filled' : 'empty' }}"> @if(!$this->{$doc['model']}) <label x-show="!isUploading" class="flex flex-col items-center justify-center w-full h-24 border-2 border-dashed border-slate-200 rounded-2xl cursor-pointer hover:bg-white hover:border-[#ff6600]/30 transition-all group/up animate-fade-in"> <svg class="w-6 h-6 text-slate-300 group-hover/up:text-[#ff6600] mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                    <div class="bg-slate-50/50 p-8 rounded-3xl border border-slate-100"> <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-[2px] mb-6">¿El guion es de tu total autoría?</label>
                        <div class="flex gap-8 mb-8"> <label class="flex items-center gap-3 cursor-pointer group"> <input type="radio" value="si" wire:model.live="autoria" class="w-5 h-5 accent-[#ff6600]"> <span class="text-sm font-bold text-slate-700 group-hover:text-[#ff6600] transition-colors uppercase">SÍ, ES MÍO</span> </label> <label class="flex items-center gap-3 cursor-pointer group"> <input type="radio" value="no" wire:model.live="autoria" class="w-5 h-5 accent-[#ff6600]"> <span class="text-sm font-bold text-slate-700 group-hover:text-[#ff6600] transition-colors uppercase">NO, TENGO CESIÓN</span> </label> </div>
                        <div x-show="$wire.autoria === 'no'" x-transition x-cloak class="pt-8 border-t border-slate-200">
                            <div class="max-w-md mx-auto">
                                <div class="p-6 bg-white rounded-[2rem] border border-slate-100 flex flex-col justify-between group hover:border-orange-200 transition-all" x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">
                                    <div class="mb-6">
                                        <h4 class="font-outfit text-sm font-800 text-slate-700 uppercase mb-1">ANEXO 3: AUTORIZACIÓN USO DEL GUION <span class="text-red-500">*</span></h4>
                                        <p class="text-[10px] text-slate-400 font-medium uppercase tracking-tighter">Cesión de derechos de uso de guion</p>
                                    </div>
                                    <div class="space-y-4"> <a href="{{ asset('storage/formatos/etapa_01/anexo-03-autorizacion-uso-de-guion.pdf') }}" target="_blank" class="block w-full text-center py-2.5 bg-slate-50 text-slate-600 rounded-xl text-[9px] font-black uppercase tracking-widest border border-slate-100 hover:border-[#ff6600] hover:text-[#ff6600] transition-all">Descargar Formato</a>
                                        <div class="relative" wire:key="wrap-guion-{{ $guionArchivo ? 'filled' : 'empty' }}"> @if(!$guionArchivo) <label x-show="!isUploading" class="flex flex-col items-center justify-center w-full h-24 border-2 border-dashed border-slate-200 rounded-2xl cursor-pointer hover:bg-slate-50 hover:border-[#ff6600]/30 transition-all group/up animate-fade-in"> <svg class="w-6 h-6 text-slate-300 group-hover/up:text-[#ff6600] mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" stroke-width="2" stroke-linecap="round" />
                                                </svg> <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Subir Anexo 3</span> <input type="file" wire:model.live="guionArchivo" class="hidden" accept=".pdf" /> </label>
                                            <div x-show="isUploading" x-cloak class="w-full h-24 flex flex-col items-center justify-center bg-white border-2 border-orange-100 rounded-2xl animate-pulse">
                                                <div class="w-3/4 h-1.5 bg-slate-100 rounded-full overflow-hidden mb-2">
                                                    <div class="h-full bg-[#ff6600] transition-all duration-300" :style="'width: ' + progress + '%'"></div>
                                                </div> <span class="text-[8px] font-black text-[#ff6600] uppercase tracking-widest">Cargando <span x-text="progress"></span>%</span>
                                            </div> @else <div class="bg-slate-50 border border-emerald-100 p-4 rounded-2xl flex items-center justify-between shadow-sm animate-fade-in">
                                                <div class="flex items-center gap-3 truncate">
                                                    <div class="h-8 w-8 bg-emerald-50 rounded-lg flex items-center justify-center text-emerald-500"> <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path d="M5 13l4 4L19 7" stroke-width="3" stroke-linecap="round" />
                                                        </svg> </div> <span class="text-[9px] font-bold text-slate-600 truncate uppercase">{{ $guionArchivo->getClientOriginalName() }}</span>
                                                </div> <button type="button" @click="isUploading = false; progress = 0; $wire.limpiarDocumento('guionArchivo')" class="text-slate-300 hover:text-red-500 transition-colors cursor-pointer">✕</button>
                                            </div> @endif
                                        </div> @error('guionArchivo') <span class="text-red-500 text-[9px] font-bold block uppercase animate-fade-in mt-1">{{ $message }}</span> @enderror
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
                                <div class="mb-6">
                                    <h4 class="font-outfit text-sm font-800 text-slate-700 uppercase mb-1">ANEXO 4: CONSIDERACIONES Y DECLARACIONES GENERALES <span class="text-red-500">*</span></h4>
                                    <p class="text-[10px] text-slate-400 font-medium uppercase tracking-tighter">Documento firmado por el titular</p>
                                </div>
                                <div class="space-y-4"> <a href="{{ asset('storage/formatos/etapa_01/anexo-04-consideraciones-y-declaraciones.pdf') }}" target="_blank" class="block w-full text-center py-2.5 bg-slate-50 text-slate-600 rounded-xl text-[9px] font-black uppercase tracking-widest border border-slate-100 hover:border-[#ff6600] hover:text-[#ff6600] transition-all">Descargar Anexo 4</a>
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
                        <div class="space-y-4 max-w-2xl mx-auto"> <label class="flex items-center gap-5 p-5 bg-white rounded-2xl border border-slate-100 cursor-pointer hover:border-[#ff6600]/30 transition-all group"> <input type="checkbox" wire:model.live="aceptaTerminos" class="w-6 h-6 accent-[#ff6600] cursor-pointer"> <span class="text-xs md:text-sm font-semibold text-slate-600 uppercase tracking-tight">Acepto, de manera voluntaria, previa, explícita e informada los términos y ondiciones establecidos en la presente convocatoria.</span> </label> @error('aceptaTerminos') <span class="text-red-500 text-[10px] font-bold ml-5 uppercase block animate-fade-in">{{ $message }}</span> @enderror <label class="flex items-center gap-5 p-5 bg-white rounded-2xl border border-slate-100 cursor-pointer hover:border-[#ff6600]/30 transition-all group"> <input type="checkbox" wire:model.live="aceptaDatos" class="w-6 h-6 accent-[#ff6600] cursor-pointer"> <span class="text-xs md:text-sm font-semibold text-slate-600 uppercase tracking-tight">Acepto y autorizo de manera voluntaria, previa, explícita e informada a ACTORES S.C.G. para el tratamiento de mis datos personales conforme a su Política de Tratamiento de Datos Personales y a lo establecido en la presente convocatoria. Declaro que la información suministrada es veraz y autorizo, en caso de resultar seleccionada la propuesta, la verificación de la información aportada y la consulta de antecedentes judiciales, disciplinarios o fiscales. Si se evidencian incumplimientos de las condiciones de participación, acepto la exclusión de la propuesta y la selección de la siguiente siempre y cuando cumpla con los requisitos establecidos.</span> </label> @error('aceptaDatos') <span class="text-red-500 text-[10px] font-bold ml-5 uppercase block animate-fade-in">{{ $message }}</span> @enderror </div>
                    </div>
                </section> {{-- BOTÓN DE CIERRE --}}
                <div class="text-center pt-10">
                    {{-- Mensajes de Error Globales --}}
                    @if ($errors->has('directorIdentificacion') || $errors->has('error'))
                    <div class="max-w-4xl mx-auto mb-6 animate-fade-in">
                        <div class="bg-red-50 border-l-4 border-red-500 p-6 rounded-r-[2rem] shadow-sm">
                            <div class="flex items-center gap-4">
                                <div class="bg-red-500 p-2 rounded-full text-white">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-red-800 font-900 uppercase text-xs tracking-widest">Atención: Error de Validación</h3>
                                    <p class="text-red-600/80 text-[11px] font-bold uppercase mt-1">
                                        {{ $errors->first('directorIdentificacion') ?: $errors->first('error') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
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