<div class="min-h-screen bg-black text-left" x-data="{ showExitModal: false }">
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
                                @if($foto_url)
                                <img src="{{ $foto_url }}" class="w-full h-full object-cover">
                                @else
                                {{ $iniciales }}
                                @endif
                            </div>
                            <div class="text-left hidden sm:block">
                                <span class="text-sm font-700 text-white block leading-none">
                                    {{ auth()->user()->name }}
                                </span>
                                <span class="text-[9px] font-bold text-gray-500 uppercase tracking-wider mt-1 block">
                                    Acceso {{ Auth::user()->tipo_socio === 'Administrador' ? 'Gestor' : 'Socio' }}
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

    <main class="min-h-screen bg-[#f8fafc] font-inter pb-24 pt-10" x-data="{ uploading: false }">
        {{-- Tipografías y Estilos Core --}}
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

            .premium-shadow {
                shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.04), 0 8px 10px -6px rgba(0, 0, 0, 0.04);
            }
        </style>

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
            <section class="max-w-7xl mx-auto" wire:key="paso-cero" x-data="{ mostrarSoporte: false }">
                <div class="bg-white rounded-[2.5rem] md:rounded-[4rem] p-6 md:p-20 border border-slate-100 shadow-2xl shadow-slate-200/60 relative overflow-hidden min-h-[600px] flex flex-col justify-center">

                    <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-[#ff6600] to-orange-400"></div>

                    {{-- VISTA SOPORTE --}}
                    <div x-show="mostrarSoporte" x-cloak x-transition class="animate-in fade-in zoom-in duration-300">

                        <button @click="mostrarSoporte = false" class="mb-8 inline-flex items-center gap-2 text-slate-400 hover:text-brand-orange font-bold text-[10px] uppercase tracking-widest transition-all cursor-pointer group">
                            <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M15 19l-7-7 7-7" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            Volver a la verificación
                        </button>

                        <h2 class="font-bebas text-5xl text-slate-800 uppercase tracking-tighter mb-2">
                            Gestión de <span class="text-brand-orange">Socios</span>
                        </h2>
                        <p class="text-slate-500 mb-10 font-medium tracking-wide">
                            Para actualizar tus datos de acceso o reportar un error, utiliza nuestros canales oficiales:
                        </p>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <div class="relative p-8 bg-white border border-slate-100 rounded-3xl shadow-sm hover:shadow-md transition-shadow group overflow-hidden">
                                <div class="absolute top-0 right-0 w-24 h-24 bg-orange-50 rounded-bl-[4rem] -mr-8 -mt-8 transition-transform group-hover:scale-110"></div>

                                <div class="relative z-10">
                                    <div class="w-12 h-12 bg-white shadow-sm border border-orange-100 rounded-2xl flex items-center justify-center mb-6 text-brand-orange">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                    <span class="text-[10px] font-black text-brand-orange uppercase tracking-[3px] block mb-2">Enviar Correo</span>
                                    <p class="text-slate-800 font-bebas text-2xl tracking-wide">socios@actores.org.co</p>
                                    <a href="mailto:socios@actores.org.co" class="mt-4 inline-block text-[10px] font-bold text-slate-400 hover:text-brand-orange uppercase tracking-widest transition-colors">Abrir e-mail →</a>
                                </div>
                            </div>

                            <div class="relative p-8 bg-white border border-slate-100 rounded-3xl shadow-sm hover:shadow-md transition-shadow group overflow-hidden">
                                <div class="absolute top-0 right-0 w-24 h-24 bg-emerald-50 rounded-bl-[4rem] -mr-8 -mt-8 transition-transform group-hover:scale-110"></div>

                                <div class="relative z-10">
                                    <div class="w-12 h-12 bg-white shadow-sm border border-emerald-100 rounded-2xl flex items-center justify-center mb-6 text-emerald-500">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                    <span class="text-[10px] font-black text-emerald-600 uppercase tracking-[3px] block mb-2">WhatsApp Directo</span>
                                    <p class="text-slate-800 font-bebas text-2xl tracking-wide">+57 317 4188415</p>
                                    <a href="https://wa.me/573174188415" target="_blank" class="mt-4 inline-block text-[10px] font-bold text-slate-400 hover:text-emerald-600 uppercase tracking-widest transition-colors">Iniciar chat →</a>
                                </div>
                            </div>

                        </div>

                        <div class="mt-10 py-6 border-t border-slate-100 flex flex-col md:flex-row justify-between items-center gap-4">
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">
                                Atención: <span class="text-slate-600 ml-2">Lunes a Viernes / 7:30 AM — 3:00 PM</span>
                            </p>
                            <div class="flex gap-4">
                                <div class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></div>
                                <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest text-right">Línea de soporte activa</span>
                            </div>
                        </div>
                    </div>

                    {{-- VISTA DE FLUJO (Livewire) --}}
                    <div x-show="!mostrarSoporte">
                        @if(!$otpEnviado)
                        {{-- PANTALLA 1: CONFIRMACIÓN --}}
                        <div class="text-center animate-fade-in" wire:key="vista-confirmacion">
                            <div class="inline-flex items-center justify-center w-20 h-20 bg-orange-50 rounded-3xl mb-8 border border-orange-100">
                                <svg class="w-10 h-10 text-[#ff6600]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <h2 class="font-outfit text-4xl md:text-6xl font-900 text-slate-800 uppercase tracking-tighter mb-6 leading-none">Confirma tu Correo</h2>
                            <p class="text-slate-500 text-lg md:text-xl font-medium max-w-2xl mx-auto mb-12 text-center">
                                Enviaremos un código de seguridad <span class="text-[#ff6600] font-800 underline decoration-orange-200">únicamente a tu correo</span> registrado.
                            </p>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12 max-w-4xl mx-auto text-left">
                                <div class="bg-slate-50 border border-slate-100 p-8 rounded-[2.5rem]">
                                    <label class="block text-[10px] uppercase font-black text-slate-400 tracking-[3px] mb-2">Correo de destino</label>
                                    <p class="text-slate-700 font-outfit text-xl md:text-2xl font-800 truncate">{{ $this->maskEmail($socio->email) }}</p>
                                </div>
                                <div class="bg-slate-50 border border-slate-100 p-8 rounded-[2.5rem]">
                                    <label class="block text-[10px] uppercase font-black text-slate-400 tracking-[3px] mb-2">Referencia Celular</label>
                                    <p class="text-slate-700 font-outfit text-xl md:text-2xl font-800">{{ $this->maskPhone($socio->telefono) }}</p>
                                </div>
                            </div>

                            <div class="flex flex-col md:flex-row gap-4 justify-center items-center">
                                <button @click="mostrarSoporte = true" class="w-full md:w-auto px-10 py-5 text-slate-400 font-outfit text-sm font-800 uppercase tracking-widest hover:text-red-500 transition-all cursor-pointer">
                                    No, debo actualizar datos
                                </button>
                                <button wire:click="enviarCodigo" wire:loading.attr="disabled" class="w-full md:w-auto px-12 py-6 bg-[#ff6600] text-white rounded-2xl font-outfit text-xl font-800 uppercase tracking-widest shadow-xl shadow-orange-200 hover:bg-slate-800 transition-all cursor-pointer">
                                    <span wire:loading.remove wire:target="enviarCodigo">SÍ, ENVIAR CÓDIGO</span>
                                    <span wire:loading wire:target="enviarCodigo">ENVIANDO...</span>
                                </button>
                            </div>
                        </div>
                        @else
                        {{-- PANTALLA 2: INPUT DEL CÓDIGO --}}
                        <div class="max-w-xl mx-auto text-center animate-fade-in" wire:key="vista-otp">
                            {{-- BOTÓN PARA VOLVER ATRÁS --}}
                            <button wire:click="$set('otpEnviado', false)" class="mb-8 inline-flex items-center gap-2 text-slate-400 hover:text-slate-600 font-bold text-[10px] uppercase tracking-widest transition-all cursor-pointer group">
                                <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M15 19l-7-7 7-7" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                Cambiar método / Volver
                            </button>

                            <div class="inline-flex items-center justify-center w-20 h-20 bg-orange-50 rounded-3xl mb-8 border border-orange-100">
                                <svg class="w-10 h-10 text-[#ff6600]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <h2 class="font-outfit text-4xl font-900 text-slate-800 uppercase tracking-tighter mb-4 text-center">Ingresa el Código</h2>
                            <p class="text-slate-500 mb-10 text-lg text-center">Revisa tu bandeja de entrada en:<br><span class="font-bold text-slate-800">{{ $this->maskEmail($socio->email) }}</span></p>

                            <div class="space-y-8">
                                <input type="text" wire:model.live="codigoUsuario" maxlength="6" placeholder="000000"
                                    class="w-full bg-slate-50 border-2 border-slate-100 rounded-[2rem] py-8 text-center font-outfit text-6xl font-900 text-[#ff6600] tracking-[10px] focus:ring-8 focus:ring-orange-100 outline-none transition-all">

                                <button wire:click="validarCodigo" wire:loading.attr="disabled" class="w-full py-6 bg-slate-800 text-white rounded-2xl font-outfit text-xl font-800 uppercase tracking-widest hover:bg-[#ff6600] transition-all shadow-xl">
                                    <span wire:loading.remove wire:target="validarCodigo">VERIFICAR E INGRESAR</span>
                                    <span wire:loading wire:target="validarCodigo">VALIDANDO...</span>
                                </button>

                                <button wire:click="enviarCodigo" class="text-[10px] font-black text-slate-400 uppercase tracking-widest hover:text-[#ff6600]">
                                    ¿No recibiste el correo? Reenviar código
                                </button>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </section>
            @endif

            {{-- FORMULARIO PRINCIPAL --}}
            @if(!$mostrarPasoCero)
            <form wire:submit.prevent="guardar" class="space-y-8 animate-fade-in">

                {{-- 1. DATOS PROPONENTE --}}
                <section class="bg-white rounded-[2.5rem] p-10 border border-slate-100 shadow-sm relative overflow-hidden">
                    <div class="flex items-center gap-4 mb-10">
                        <div class="h-8 w-1 bg-[#ff6600] rounded-full"></div>
                        <h2 class="font-outfit text-2xl font-800 text-slate-800 uppercase tracking-tight">1. Perfil del Proponente</h2>
                    </div>
                    <div class="flex flex-col lg:flex-row gap-10 items-center lg:items-start">
                        <div class="shrink-0">
                            <div class="w-32 h-32 rounded-[2rem] bg-slate-50 border-2 border-white shadow-inner flex items-center justify-center overflow-hidden">
                                @if($foto_url)
                                {{-- object-cover asegura que se llene el espacio sin estirar la imagen --}}
                                <img src="{{ $foto_url }}" class="w-full h-full object-cover shadow-sm" alt="Foto Proponente">
                                @else
                                <span class="font-outfit text-5xl font-800 text-slate-200 tracking-tighter">
                                    {{ $iniciales ?? 'SC' }}
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="flex-grow w-full grid grid-cols-1 md:grid-cols-2 gap-8 text-left">
                            <div>
                                <label class="text-[10px] font-bold text-slate-400 uppercase tracking-[2px] mb-1 block">Socio Titular</label>
                                <p class="font-outfit text-3xl font-800 text-slate-700 uppercase leading-none">{{ mb_strtoupper($socio->name) }}</p>
                                <p class="text-slate-400 font-mono text-sm mt-2">IDENTIFICACIÓN: {{ $socio->identificacion }}</p>
                            </div>
                            <div class="md:text-right">
                                <label class="text-[10px] font-bold text-slate-400 uppercase tracking-[2px] mb-1 block">Notificación</label>
                                <p class="font-inter text-lg font-bold text-[#ff6600]">{{ $socio->email }}</p>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- 2. DETALLES DE PROPUESTA --}}
                <section class="bg-white rounded-[2.5rem] p-10 border border-slate-100 shadow-sm text-left">
                    <h2 class="font-outfit text-2xl font-800 text-slate-800 uppercase tracking-tight mb-8">2. Detalles de la Propuesta</h2>
                    <div class="text-left">
                        <label class="text-[10px] font-bold text-slate-400 uppercase tracking-[2px] mb-3 block">Título oficial del proyecto <span class="text-red-500">*</span></label>
                        <input type="text" wire:model.blur="titulo" placeholder="Ej: Mi Gran Documental" class="w-full bg-slate-50 border border-slate-100 rounded-2xl p-5 font-bold text-slate-700 focus:ring-4 focus:ring-orange-50 focus:border-[#ff6600] outline-none transition-all uppercase">
                        @error('titulo') <span class="text-red-500 text-[10px] font-bold mt-2 block uppercase animate-fade-in">{{ $message }}</span> @enderror
                    </div>
                </section>

                {{-- 3. PERFIL DEL DIRECTOR --}}
                <section class="bg-white rounded-[2.5rem] p-10 border border-slate-100 shadow-sm text-left">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-10">
                        <h2 class="font-outfit text-2xl font-800 text-slate-800 uppercase tracking-tight">3. Perfil del Director</h2>

                        <div class="flex items-center gap-3 bg-slate-50 p-2 rounded-xl border border-slate-100">
                            <span class="text-[9px] font-bold text-slate-400 uppercase px-3 tracking-widest">¿Eres el director?</span>
                            <div class="flex bg-white rounded-lg p-1 shadow-sm border border-slate-100">
                                <label class="px-6 py-1.5 rounded-md cursor-pointer transition-all {{ $directorPropio === 'si' ? 'bg-[#ff6600] text-white shadow-md' : 'text-slate-400 hover:text-slate-600' }}">
                                    <input type="radio" value="si" wire:model.live="directorPropio" class="hidden"> <span class="text-[10px] font-black">SÍ</span>
                                </label>
                                <label class="px-6 py-1.5 rounded-md cursor-pointer transition-all {{ $directorPropio === 'no' ? 'bg-[#ff6600] text-white shadow-md' : 'text-slate-400 hover:text-slate-600' }}">
                                    <input type="radio" value="no" wire:model.live="directorPropio" class="hidden"> <span class="text-[10px] font-black">NO</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    {{-- Campos condicionales Director --}}
                    <div x-show="$wire.directorPropio === 'no'"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform -translate-y-4"
                        x-transition:enter-end="opacity-100 transform translate-y-0"
                        x-cloak
                        class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 bg-slate-50/50 p-6 rounded-3xl border border-dashed border-slate-200 mb-10">

                        @foreach(['directorIdentificacion' => 'Identificación', 'directorNombre' => 'Nombre Completo', 'directorCelular' => 'Celular', 'directorCorreo' => 'Correo'] as $model => $label)
                        <div>
                            <label class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mb-1 block ml-1">
                                {{ $label }} <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                wire:model.blur="{{ $model }}"
                                placeholder="Obligatorio"
                                class="w-full bg-white border @error($model) border-red-300 @else border-slate-100 @enderror rounded-xl px-4 py-3 text-sm font-bold text-slate-700 outline-none focus:border-[#ff6600] uppercase transition-all">

                            @error($model)
                            <span class="text-red-500 text-[8px] font-bold mt-1 block uppercase animate-fade-in">{{ $message }}</span>
                            @enderror
                        </div>
                        @endforeach
                    </div>

                    {{-- Grid de Documentos Director (Mismo código que ya tienes) --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @php
                        $docsDirector = [
                        ['model' => 'docDirectorCompromiso', 'label' => 'Anexo 1: Manifestación', 'desc' => 'Aceptación del cargo de director', 'formato' => 'formato_compromiso_director.pdf'],
                        ['model' => 'docDirectorExperiencia', 'label' => 'Anexo 2: Experiencia', 'desc' => 'Filmografía y experiencia general', 'formato' => 'formato_experiencia_director.pdf'],
                        ['model' => 'docDirectorEvidencia1', 'label' => 'Evidencia de Soporte 1', 'desc' => 'Certificado o contrato previo', 'formato' => 'formato_evidencias_director.pdf'],
                        ['model' => 'docDirectorEvidencia2', 'label' => 'Evidencia de Soporte 2', 'desc' => 'Certificado o contrato previo', 'formato' => 'formato_evidencias_director.pdf'],
                        ];
                        @endphp

                        @foreach($docsDirector as $doc)
                        <div class="p-6 bg-slate-50/50 rounded-[2rem] border border-slate-100 flex flex-col justify-between group hover:border-orange-200 transition-all"
                            x-data="{ isUploading: false, progress: 0 }"
                            x-on:livewire-upload-start="isUploading = true"
                            x-on:livewire-upload-finish="isUploading = false"
                            x-on:livewire-upload-error="isUploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress">

                            <div class="mb-6">
                                <h4 class="font-outfit text-sm font-800 text-slate-700 uppercase mb-1">{{ $doc['label'] }} <span class="text-red-500">*</span></h4>
                                <p class="text-[10px] text-slate-400 font-medium uppercase tracking-tighter">{{ $doc['desc'] }}</p>
                            </div>

                            <div class="space-y-4">
                                <a href="{{ asset('storage/formatos/'.$doc['formato']) }}" target="_blank" class="block w-full text-center py-2.5 bg-white text-slate-600 rounded-xl text-[9px] font-black uppercase tracking-widest border border-slate-200 hover:border-[#ff6600] hover:text-[#ff6600] transition-all">Descargar Formato</a>

                                <div class="relative">
                                    @if(!$this->{$doc['model']})
                                    <label x-show="!isUploading" class="flex flex-col items-center justify-center w-full h-24 border-2 border-dashed border-slate-200 rounded-2xl cursor-pointer hover:bg-white hover:border-[#ff6600]/30 transition-all group/up animate-fade-in">
                                        <svg class="w-6 h-6 text-slate-300 group-hover/up:text-[#ff6600] mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" stroke-width="2" stroke-linecap="round" />
                                        </svg>
                                        <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Subir PDF</span>
                                        <input type="file" wire:model.live="{{ $doc['model'] }}" class="hidden" accept=".pdf" />
                                    </label>

                                    <div x-show="isUploading" class="w-full h-24 flex flex-col items-center justify-center bg-white border-2 border-orange-100 rounded-2xl animate-pulse">
                                        <div class="w-3/4 h-1.5 bg-slate-100 rounded-full overflow-hidden mb-2">
                                            <div class="h-full bg-[#ff6600] transition-all duration-300" :style="'width: ' + progress + '%'"></div>
                                        </div>
                                        <span class="text-[8px] font-black text-[#ff6600] uppercase tracking-widest">Cargando <span x-text="progress"></span>%</span>
                                    </div>
                                    @else
                                    <div class="bg-white border border-emerald-100 p-4 rounded-2xl flex items-center justify-between shadow-sm animate-fade-in">
                                        <div class="flex items-center gap-3 truncate">
                                            <div class="h-8 w-8 bg-emerald-50 rounded-lg flex items-center justify-center text-emerald-500">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path d="M5 13l4 4L19 7" stroke-width="3" stroke-linecap="round" />
                                                </svg>
                                            </div>
                                            <span class="text-[9px] font-bold text-slate-600 truncate uppercase">{{ $this->{$doc['model']}->getClientOriginalName() }}</span>
                                        </div>
                                        <button type="button" wire:click="$set('{{ $doc['model'] }}', null)" class="text-slate-300 hover:text-red-500 transition-colors cursor-pointer">✕</button>
                                    </div>
                                    @endif
                                </div>

                                @error($doc['model'])
                                <span class="text-red-500 text-[9px] font-bold block uppercase animate-fade-in mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        @endforeach
                    </div>
                </section>

                {{-- 4. GUION --}}
                <section class="bg-white rounded-[2.5rem] p-10 border border-slate-100 shadow-sm text-left">
                    <h2 class="font-outfit text-2xl font-800 text-slate-800 uppercase tracking-tight mb-8">4. Derechos de Guion</h2>
                    <div class="bg-slate-50/50 p-8 rounded-3xl border border-slate-100">
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-[2px] mb-6">¿El guion es de tu total autoría?</label>
                        <div class="flex gap-8 mb-8">
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="radio" value="si" wire:model.live="autoria" class="w-5 h-5 accent-[#ff6600]">
                                <span class="text-sm font-bold text-slate-700 group-hover:text-[#ff6600] transition-colors uppercase">SÍ, ES MÍO</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="radio" value="no" wire:model.live="autoria" class="w-5 h-5 accent-[#ff6600]">
                                <span class="text-sm font-bold text-slate-700 group-hover:text-[#ff6600] transition-colors uppercase">NO, TENGO CESIÓN</span>
                            </label>
                        </div>

                        <div x-show="$wire.autoria === 'no'" x-transition x-cloak class="pt-8 border-t border-slate-200">
                            <div class="max-w-md mx-auto">
                                <div class="p-6 bg-white rounded-[2rem] border border-slate-100 flex flex-col justify-between group hover:border-orange-200 transition-all"
                                    x-data="{ isUploading: false, progress: 0 }"
                                    x-on:livewire-upload-start="isUploading = true"
                                    x-on:livewire-upload-finish="isUploading = false"
                                    x-on:livewire-upload-progress="progress = $event.detail.progress">

                                    <div class="mb-6">
                                        <h4 class="font-outfit text-sm font-800 text-slate-700 uppercase mb-1">Anexo 3: Autorización <span class="text-red-500">*</span></h4>
                                        <p class="text-[10px] text-slate-400 font-medium uppercase tracking-tighter">Cesión de derechos de uso de guion</p>
                                    </div>

                                    <div class="space-y-4"
                                        x-data="{ isUploading: false, progress: 0 }"
                                        x-on:livewire-upload-start="isUploading = true"
                                        x-on:livewire-upload-finish="isUploading = false"
                                        x-on:livewire-upload-error="isUploading = false"
                                        x-on:livewire-upload-progress="progress = $event.detail.progress">

                                        {{-- Botón de descarga --}}
                                        <a href="{{ asset('storage/formatos/etapa_01_autorizacion_uso_guion_cia_2026.pdf') }}" target="_blank" class="block w-full text-center py-2.5 bg-slate-50 text-slate-600 rounded-xl text-[9px] font-black uppercase tracking-widest border border-slate-100 hover:border-[#ff6600] hover:text-[#ff6600] transition-all">Descargar Formato</a>

                                        <div class="relative">
                                            @if(!$guionArchivo)
                                            {{-- ÁREA DE SUBIDA: Solo se ve si NO hay archivo y NO se está subiendo --}}
                                            <label x-show="!isUploading" class="flex flex-col items-center justify-center w-full h-24 border-2 border-dashed border-slate-200 rounded-2xl cursor-pointer hover:bg-slate-50 hover:border-[#ff6600]/30 transition-all group/up animate-fade-in">
                                                <svg class="w-6 h-6 text-slate-300 group-hover/up:text-[#ff6600] mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" stroke-width="2" stroke-linecap="round" />
                                                </svg>
                                                <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Subir Anexo 3</span>
                                                <input type="file" wire:model.live="guionArchivo" class="hidden" accept=".pdf" />
                                            </label>

                                            {{-- BARRA DE PROGRESO: Solo se ve MIENTRAS se sube --}}
                                            <div x-show="isUploading" class="w-full h-24 flex flex-col items-center justify-center bg-white border-2 border-orange-100 rounded-2xl animate-pulse">
                                                <div class="w-3/4 h-1.5 bg-slate-100 rounded-full overflow-hidden mb-2">
                                                    <div class="h-full bg-[#ff6600] transition-all duration-300" :style="'width: ' + progress + '%'"></div>
                                                </div>
                                                <span class="text-[8px] font-black text-[#ff6600] uppercase tracking-widest">Cargando <span x-text="progress"></span>%</span>
                                            </div>
                                            @else
                                            {{-- ARCHIVO CARGADO: Se ve cuando ya está listo --}}
                                            <div class="bg-slate-50 border border-emerald-100 p-4 rounded-2xl flex items-center justify-between shadow-sm animate-fade-in">
                                                <div class="flex items-center gap-3 truncate">
                                                    <div class="h-8 w-8 bg-emerald-50 rounded-lg flex items-center justify-center text-emerald-500">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path d="M5 13l4 4L19 7" stroke-width="3" stroke-linecap="round" />
                                                        </svg>
                                                    </div>
                                                    <span class="text-[9px] font-bold text-slate-600 truncate uppercase">{{ $guionArchivo->getClientOriginalName() }}</span>
                                                </div>
                                                <button type="button" wire:click="$set('guionArchivo', null)" class="text-slate-300 hover:text-red-500 transition-colors cursor-pointer">✕</button>
                                            </div>
                                            @endif
                                        </div>

                                        {{-- EL ERROR: Reactivo --}}
                                        @error('guionArchivo')
                                        <span class="text-red-500 text-[9px] font-bold block uppercase animate-fade-in mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- 5. DECLARACIONES --}}
                <section class="bg-white rounded-[2.5rem] p-10 border border-slate-100 shadow-sm text-left">
                    <h2 class="font-outfit text-2xl font-800 text-slate-800 uppercase tracking-tight mb-8">5. Declaraciones Finales</h2>
                    <div class="bg-slate-50/50 p-8 rounded-3xl border border-slate-100 space-y-10">

                        <div class="max-w-md mx-auto">
                            <div class="p-6 bg-white rounded-[2rem] border border-slate-100 flex flex-col justify-between group hover:border-orange-200 transition-all"
                                x-data="{ isUploading: false, progress: 0 }"
                                x-on:livewire-upload-start="isUploading = true"
                                x-on:livewire-upload-finish="isUploading = false"
                                x-on:livewire-upload-progress="progress = $event.detail.progress">

                                <div class="mb-6">
                                    <h4 class="font-outfit text-sm font-800 text-slate-700 uppercase mb-1">Anexo 4: Declaraciones <span class="text-red-500">*</span></h4>
                                    <p class="text-[10px] text-slate-400 font-medium uppercase tracking-tighter">Documento firmado por el titular</p>
                                </div>

                                <div class="space-y-4"
                                    x-data="{ isUploading: false, progress: 0 }"
                                    x-on:livewire-upload-start="isUploading = true"
                                    x-on:livewire-upload-finish="isUploading = false"
                                    x-on:livewire-upload-error="isUploading = false"
                                    x-on:livewire-upload-progress="progress = $event.detail.progress">

                                    {{-- Botón de descarga --}}
                                    <a href="{{ asset('storage/formatos/formato_declaraciones_2026.pdf') }}" target="_blank" class="block w-full text-center py-2.5 bg-slate-50 text-slate-600 rounded-xl text-[9px] font-black uppercase tracking-widest border border-slate-100 hover:border-[#ff6600] hover:text-[#ff6600] transition-all">Descargar Anexo 4</a>

                                    <div class="relative">
                                        @if(!$formatoFirmado)
                                        {{-- ÁREA DE SUBIDA: Se oculta mientras carga --}}
                                        <label x-show="!isUploading" class="flex flex-col items-center justify-center w-full h-24 border-2 border-dashed border-slate-200 rounded-2xl cursor-pointer hover:bg-slate-50 hover:border-[#ff6600]/30 transition-all group/up animate-fade-in">
                                            <svg class="w-6 h-6 text-slate-300 group-hover/up:text-[#ff6600] mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" stroke-width="2" stroke-linecap="round" />
                                            </svg>
                                            <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Subir Anexo 4 firmado</span>
                                            <input type="file" wire:model.live="formatoFirmado" class="hidden" accept=".pdf" />
                                        </label>

                                        {{-- BARRA DE PROGRESO: Solo visible durante la subida --}}
                                        <div x-show="isUploading" class="w-full h-24 flex flex-col items-center justify-center bg-white border-2 border-orange-100 rounded-2xl animate-pulse">
                                            <div class="w-3/4 h-1.5 bg-slate-100 rounded-full overflow-hidden mb-2">
                                                <div class="h-full bg-[#ff6600] transition-all duration-300" :style="'width: ' + progress + '%'"></div>
                                            </div>
                                            <span class="text-[8px] font-black text-[#ff6600] uppercase tracking-widest">Cargando <span x-text="progress"></span>%</span>
                                        </div>
                                        @else
                                        {{-- ESTADO COMPLETADO: Aparece cuando el archivo ya está en el sistema --}}
                                        <div class="bg-slate-50 border border-emerald-100 p-4 rounded-2xl flex items-center justify-between shadow-sm animate-fade-in">
                                            <div class="flex items-center gap-3 truncate">
                                                <div class="h-8 w-8 bg-emerald-50 rounded-lg flex items-center justify-center text-emerald-500">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path d="M5 13l4 4L19 7" stroke-width="3" stroke-linecap="round" />
                                                    </svg>
                                                </div>
                                                <span class="text-[9px] font-bold text-slate-600 truncate uppercase">{{ $formatoFirmado->getClientOriginalName() }}</span>
                                            </div>
                                            <button type="button" wire:click="$set('formatoFirmado', null)" class="text-slate-300 hover:text-red-500 transition-colors cursor-pointer">✕</button>
                                        </div>
                                        @endif
                                    </div>

                                    {{-- MENSAJE DE ERROR: Se limpia automáticamente con el método updated() --}}
                                    @error('formatoFirmado')
                                    <span class="text-red-500 text-[9px] font-bold block uppercase animate-fade-in mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Checkboxes Reactivos --}}
                        <div class="space-y-4 max-w-2xl mx-auto">
                            <label class="flex items-center gap-5 p-5 bg-white rounded-2xl border border-slate-100 cursor-pointer hover:border-[#ff6600]/30 transition-all group">
                                <input type="checkbox" wire:model.live="aceptaTerminos" class="w-6 h-6 accent-[#ff6600] cursor-pointer">
                                <span class="text-xs md:text-sm font-semibold text-slate-600 uppercase tracking-tight">Acepto, de manera voluntaria, previa, explícita e informada los términos y ondiciones establecidos en la presente convocatoria.</span>
                            </label>
                            @error('aceptaTerminos') <span class="text-red-500 text-[10px] font-bold ml-5 uppercase block animate-fade-in">{{ $message }}</span> @enderror

                            <label class="flex items-center gap-5 p-5 bg-white rounded-2xl border border-slate-100 cursor-pointer hover:border-[#ff6600]/30 transition-all group">
                                <input type="checkbox" wire:model.live="aceptaDatos" class="w-6 h-6 accent-[#ff6600] cursor-pointer">
                                <span class="text-xs md:text-sm font-semibold text-slate-600 uppercase tracking-tight">Acepto y autorizo de manera voluntaria, previa, explícita e informada a ACTORES S.C.G. para el tratamiento de mis datos personales conforme a su Política de Tratamiento de Datos Personales y a lo establecido en la presente convocatoria. Declaro que la información suministrada es veraz y autorizo, en caso de resultar seleccionada la propuesta, la verificación de la información aportada y la consulta de antecedentes judiciales, disciplinarios o fiscales. Si se evidencian incumplimientos de las condiciones de participación, acepto la exclusión de la propuesta y la selección de la siguiente siempre y cuando cumpla con los requisitos establecidos.</span>
                            </label>
                            @error('aceptaDatos') <span class="text-red-500 text-[10px] font-bold ml-5 uppercase block animate-fade-in">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </section>

                {{-- BOTÓN DE CIERRE --}}
                <div class="text-center pt-10">
                    <button type="submit"
                        wire:loading.attr="disabled"
                        wire:target="guardar"
                        class="w-full max-w-xl h-24 bg-[#ff6600] text-white rounded-[2rem] font-outfit shadow-2xl shadow-orange-100 hover:bg-slate-800 transition-all mx-auto cursor-pointer disabled:opacity-80 flex items-center justify-center overflow-hidden">

                        <div class="relative w-full h-full flex items-center justify-center">

                            {{-- ESTADO NORMAL --}}
                            <div wire:loading.remove wire:target="guardar"
                                class="flex items-center justify-center gap-3 px-4">
                                <span class="text-2xl font-900 uppercase tracking-[2px] whitespace-nowrap">
                                    Finalizar e Inscribir
                                </span>
                                <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M13 7l5 5m0 0l-5 5m5-5H6" stroke-width="3" stroke-linecap="round" />
                                </svg>
                            </div>

                            {{-- ESTADO CARGANDO (FORZADO HORIZONTAL) --}}
                            <div wire:loading.flex wire:target="guardar"
                                class="absolute inset-0 items-center justify-center gap-4 px-4 bg-inherit rounded-[2rem]">
                                <svg class="animate-spin h-7 w-7 text-white flex-shrink-0" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <span class="text-xl font-900 uppercase tracking-[2px] whitespace-nowrap">
                                    Enviando Registro...
                                </span>
                            </div>

                        </div>
                    </button>
                </div>
            </form>
            @endif
        </div>
    </main>




    {{-- MODAL DE SALIDA --}}
    <div x-show="showExitModal" x-cloak class="fixed inset-0 z-[2000] flex items-center justify-center p-6 bg-black/90 backdrop-blur-md">
        <div class="bg-brand-surface border border-brand-border max-w-md w-full p-10 text-center shadow-2xl rounded-2xl">
            <h3 class="font-bebas text-4xl text-white mb-4 uppercase">¿Abandonar Registro?</h3>
            <p class="text-gray-400 text-[11px] mb-8 uppercase tracking-widest">Los datos no guardados se perderán.</p>
            <div class="flex flex-col gap-4">
                <a href="/" class="w-full py-4 bg-red-600 text-white font-bebas text-2xl no-underline uppercase text-center rounded-lg">SÍ, SALIR</a>
                <button @click="showExitModal = false" class="w-full py-4 border border-white/10 text-gray-500 font-bebas text-2xl uppercase rounded-lg">Volver al Registro</button>
            </div>
        </div>
    </div>
</div>