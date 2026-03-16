<div class="min-h-screen bg-black flex flex-col items-center justify-center p-6 relative overflow-hidden">
    {{-- TOOLBAR LATERAL: POTENCIADO --}}
    <div class="fixed right-8 top-1/2 -translate-y-1/2 z-[100] flex flex-col items-center gap-8">

        {{-- Etiqueta de señal vertical (Más visible) --}}
        <div class="flex flex-col items-center gap-3 mb-2">
            <span class="font-mono text-[10px] text-brand-orange tracking-[5px] uppercase rotate-180 [writing-mode:vertical-lr] font-black animate-pulse">
                System_Online
            </span>
            <div class="w-[3px] h-16 bg-gradient-to-t from-brand-orange via-brand-orange/50 to-transparent rounded-full"></div>
        </div>

        {{-- BOTÓN: WHATSAPP CON MENSAJE PREDETERMINADO --}}
        <div class="group relative flex flex-col items-center">
            <a href="https://wa.me/573156896774?text=Hola,%20me%20gustaría%20más%20información%20sobre%20los%20incentivos%20audiovisuales"
                target="_blank"
                class="relative flex items-center justify-center w-16 h-16 bg-[#25D366] text-white rounded-2xl hover:scale-110 hover:rotate-3 transition-all duration-500 shadow-[0_10px_20px_rgba(37,211,102,0.3)] hover:shadow-[#25D366]/50 border-b-4 border-black/20">

                {{-- Tooltip --}}
                <span class="absolute right-20 bg-black border-2 border-[#25D366] text-white font-bold font-mono text-xs px-4 py-2 whitespace-nowrap opacity-0 group-hover:opacity-100 transition-all duration-300 translate-x-4 group-hover:translate-x-0">
                    [ WHATSAPP DIRECTO ]
                </span>

                {{-- Icono SVG --}}
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-brand-whatsapp">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M3 21l1.65 -3.8a9 9 0 1 1 3.4 2.9l-5.05 .9" />
                    <path d="M9 10a.5 .5 0 0 0 1 0v-1a.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a.5 .5 0 0 0 0 -1h-1a.5 .5 0 0 0 0 1" />
                </svg>
            </a>
            <span class="font-mono text-[9px] text-[#25D366] font-bold uppercase mt-2 tracking-[2px]">WhatsApp</span>
        </div>

        {{-- BOTÓN: CORREO ELECTRÓNICO --}}
        <div class="group relative flex flex-col items-center">
            <a href="mailto:incentivos@actores.org.co"
                class="relative flex items-center justify-center w-16 h-16 bg-[#3b82f6] text-white rounded-2xl hover:scale-110 hover:-rotate-3 transition-all duration-500 shadow-[0_10px_20px_rgba(59,130,246,0.3)] hover:shadow-[#3b82f6]/50 border-b-4 border-black/20">

                {{-- Tooltip --}}
                <span class="absolute right-20 bg-black border-2 border-[#3b82f6] text-white font-bold font-mono text-xs px-4 py-2 whitespace-nowrap opacity-0 group-hover:opacity-100 transition-all duration-300 translate-x-4 group-hover:translate-x-0">
                    [ ENVIAR E-MAIL ]
                </span>

                {{-- Icono SVG --}}
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-mail">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10" />
                    <path d="M3 7l9 6l9 -6" />
                </svg>
            </a>
            <span class="font-mono text-[9px] text-[#3b82f6] font-bold uppercase mt-2 tracking-[2px]">E-mail</span>
        </div>

        {{-- Decoración inferior: Pulso de datos mejorado --}}
        <div class="mt-2 flex flex-col items-center gap-2">
            <div class="w-2 h-2 bg-brand-orange rounded-full animate-ping"></div>
            <div class="w-[1px] h-10 bg-gradient-to-b from-brand-orange to-transparent"></div>
        </div>
    </div>
    <div class="absolute top-0 left-0 w-full h-1 bg-brand-orange"></div>
    <div class="absolute -top-24 -right-24 w-96 h-96 bg-brand-orange/5 blur-[100px] rounded-full"></div>
    <div class="max-w-[560px] w-full z-10">
        <header class="mb-10 text-center">
            <a href="/" class="font-bebas text-4xl text-brand-orange tracking-[3px] no-underline inline-block mb-2 uppercase">
                ACTORES S.C.G.
            </a>
            <div class="text-brand-orange/60 font-bold text-[10px] uppercase tracking-[4px]">
                Convocatoria Incentivos 2026
            </div>
        </header>

        <section class="bg-brand-surface border border-brand-border p-8 md:p-12 relative group shadow-[0_0_50px_rgba(0,0,0,0.5)]">
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-brand-orange/5 blur-[50px] group-hover:bg-brand-orange/10 transition-all"></div>
            <div class="relative z-10">
                <header class="mb-8 border-l-4 border-brand-orange pl-6 text-left">
                    <h1 class="font-bebas text-4xl md:text-5xl leading-none text-white mb-2 uppercase">
                        @if($paso == 'identificar')
                        ACCESO A <br> <span class="text-brand-orange">INSCRIPCIÓN</span>
                        @elseif($paso == 'verificar')
                        VALIDAR <br> <span class="text-brand-orange">IDENTIDAD</span>
                        @elseif($paso == 'registrar')
                        CREAR <br> <span class="text-brand-orange">CONTRASEÑA</span>
                        @else
                        BIENVENIDO <br> <span class="text-brand-orange">DE NUEVO</span>
                        @endif
                    </h1>
                    <p class="text-gray-400 text-sm leading-relaxed uppercase tracking-wider">
                        @if($paso == 'identificar')
                        Verifica tu estado de socio para continuar
                        @elseif($paso == 'verificar')
                        Hola {{ $nombreSocio }}, confirma tus datos
                        @elseif($paso == 'registrar')
                        Hola {{ $nombreSocio }}, protege tu cuenta
                        @else
                        Hola {{ $nombreSocio }}, ingresa para continuar
                        @endif
                    </p>
                </header>

                <form wire:submit.prevent="validar" class="space-y-6">
                    <div class="group/item">
                        <label class="block text-[10px] uppercase font-bold text-gray-500 mb-3 tracking-widest group-hover/item:text-brand-orange transition-colors">
                            Número de Identificación de proponente
                        </label>
                        <input type="text" wire:model.defer="identificacion" {{ $paso !== 'identificar' ? 'readonly' : '' }} placeholder="EJ: 12345678" class="w-full bg-black border border-brand-border px-4 py-5 text-white text-xl focus:border-brand-orange outline-none transition-all placeholder:text-gray-800 {{ $paso !== 'identificar' ? 'opacity-50' : '' }}" required>
                        @error('identificacion')
                        <span class="text-red-500 text-[10px] mt-2 block uppercase font-bold tracking-widest animate-pulse"> {{ $message }} </span>
                        @enderror
                    </div>

                    @if($paso == 'verificar')
                    <div class="group/item animate-in fade-in slide-in-from-top-4 duration-500">
                        <label class="block text-[10px] uppercase font-bold text-gray-500 mb-3 tracking-widest">
                            Año de Nacimiento (Seguridad)
                        </label>
                        <input type="text"
                            wire:model.defer="anio_nacimiento"
                            maxlength="4"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                            placeholder="EJ: 1980"
                            class="w-full bg-black border border-brand-border px-4 py-5 text-white text-xl focus:border-brand-orange outline-none">
                        @error('anio_nacimiento')
                        <span class="text-red-500 text-[10px] mt-2 block uppercase font-bold"> {{ $message }} </span>
                        @enderror
                        <p class="text-[9px] text-gray-600 mt-2 uppercase tracking-tighter italic">Para registrar tu contraseña, primero valida el año de tu nacimiento.</p>
                    </div>
                    @endif

                    @if($paso == 'registrar')
                    <div class="group/item animate-in fade-in slide-in-from-top-4 duration-500">
                        <label class="block text-[10px] uppercase font-bold text-gray-500 mb-3 tracking-widest"> Crear Contraseña </label>
                        <input type="password" wire:model.defer="password" class="w-full bg-black border border-brand-border px-4 py-5 text-white text-xl focus:border-brand-orange outline-none mb-4">
                        <label class="block text-[10px] uppercase font-bold text-gray-500 mb-3 tracking-widest"> Confirmar Contraseña </label>
                        <input type="password" wire:model.defer="password_confirmation" class="w-full bg-black border border-brand-border px-4 py-5 text-white text-xl focus:border-brand-orange outline-none">
                        @error('password') <span class="text-red-500 text-[10px] mt-2 block uppercase font-bold"> {{ $message }} </span> @enderror
                    </div>
                    @endif

                    @if($paso == 'login')
                    <div class="group/item animate-in fade-in slide-in-from-top-4 duration-500">
                        <label class="block text-[10px] uppercase font-bold text-gray-500 mb-3 tracking-widest"> Contraseña </label>
                        <input type="password" wire:model.defer="password" class="w-full bg-black border border-brand-border px-4 py-5 text-white text-xl focus:border-brand-orange outline-none">
                        @error('password') <span class="text-red-500 text-[10px] mt-2 block uppercase font-bold"> {{ $message }} </span> @enderror
                    </div>
                    @endif

                    <div class="pt-4">
                        <button type="submit" wire:loading.attr="disabled" class="w-full h-[70px] flex items-center justify-center bg-brand-orange text-white font-bebas text-2xl hover:bg-[#ff6a33] transition-all shadow-lg px-6">
                            <div wire:loading.remove>
                                @if($paso == 'identificar') VERIFICAR SOCIO →
                                @elseif($paso == 'verificar') VALIDAR AÑO →
                                @elseif($paso == 'registrar') REGISTRAR Y CONTINUAR →
                                @else INGRESAR →
                                @endif
                            </div>
                            <div wire:loading>
                                <div class="flex items-center gap-4">
                                    <svg class="animate-spin h-7 w-7 text-white" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    <span>PROCESANDO...</span>
                                </div>
                            </div>
                        </button>

                        @if($paso !== 'identificar')
                        <button type="button" wire:click="$set('paso', 'identificar')" class="w-full mt-4 text-[10px] text-gray-500 uppercase font-bold hover:text-white transition-colors">
                            ← No soy {{ explode(' ', $nombreSocio)[0] }}, cambiar identificación
                        </button>
                        @endif
                    </div>
                </form>
            </div>
        </section>

        <div class="mt-8 text-center">
            <a href="/" class="text-gray-500 text-[10px] uppercase font-bold tracking-[2px] hover:text-brand-orange transition-colors no-underline">
                ← Volver al inicio
            </a>
        </div>
    </div>
</div>