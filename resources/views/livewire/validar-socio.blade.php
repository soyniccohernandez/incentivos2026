<div class="min-h-screen bg-black flex flex-col items-center justify-center p-6 relative overflow-hidden">

    {{-- Decoración de fondo para coherencia visual --}}
    <div class="absolute top-0 left-0 w-full h-1 bg-brand-orange"></div>
    <div class="absolute -top-24 -right-24 w-96 h-96 bg-brand-orange/5 blur-[100px] rounded-full"></div>

    <div class="max-w-[560px] w-full z-10">

        {{-- Header de Marca --}}
        <header class="mb-10 text-center">
            <a href="/" class="font-bebas text-4xl text-brand-orange tracking-[3px] no-underline inline-block mb-2">
                ACTORES S.C.G.
            </a>
            <div class="text-brand-orange/60 font-bold text-[10px] uppercase tracking-[4px]">
                Convocatoria Incentivos 2026
            </div>
        </header>

        {{-- Tarjeta Principal Estilo Etapa 1 --}}
        <section class="bg-brand-surface border border-brand-border p-8 md:p-12 relative group shadow-[0_0_50px_rgba(0,0,0,0.5)]">

            {{-- Detalle visual en la esquina --}}
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-brand-orange/5 blur-[50px] group-hover:bg-brand-orange/10 transition-all"></div>

            <div class="relative z-10">
                <header class="mb-8 border-l-4 border-brand-orange pl-6 text-left">
                    <h1 class="font-bebas text-4xl md:text-5xl leading-none text-white mb-2">
                        ACCESO A <br> <span class="text-brand-orange">INSCRIPCIÓN</span>
                    </h1>
                    <p class="text-gray-400 text-sm leading-relaxed uppercase tracking-wider">
                        Verifica tu estado de socio para continuar
                    </p>
                </header>

                {{-- Formulario --}}
                <form wire:submit.prevent="validar" class="space-y-8">

                    <div class="group/item">
                        <label class="block text-[10px] uppercase font-bold text-gray-500 mb-3 tracking-widest group-hover/item:text-brand-orange transition-colors">
                            Número de Identificación
                        </label>
                        <input
                            type="text"
                            wire:model.defer="identificacion"
                            placeholder="EJ: 12345678"
                            class="w-full bg-black border border-brand-border px-4 py-5 text-white text-xl focus:border-brand-orange outline-none transition-all placeholder:text-gray-800"
                            required>

                        @error('identificacion')
                        <span class="text-red-500 text-[10px] mt-2 block uppercase font-bold tracking-widest animate-pulse">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <p class="text-[11px] text-gray-500 leading-relaxed uppercase tracking-tighter italic">
                        * Solo los socios activos de <span class="text-gray-300">ACTORES – Sociedad Colombiana de Gestión</span> pueden postularse.
                    </p>

                    {{-- Botón Estilo Etapa 1 con Centrado Absoluto --}}
                    <div class="pt-4">
                        <button type="submit"
                            wire:loading.attr="disabled"
                            wire:target="validar"
                            {{-- El botón es el contenedor principal flex --}}
                            class="w-full h-[70px] flex items-center justify-center bg-brand-orange text-white font-bebas text-2xl hover:bg-[#ff6a33] transition-all disabled:opacity-80 disabled:cursor-not-allowed overflow-hidden shadow-lg px-6">

                            {{-- ESTADO NORMAL --}}
                            <div wire:loading.remove wire:target="validar" class="flex items-center justify-center">
                                <span class="tracking-wider">VERIFICAR SOCIO →</span>
                            </div>

                            {{-- ESTADO PROCESANDO: Forzamos flex-row para que NO se pongan uno arriba del otro --}}
                            <div wire:loading wire:target="validar">
                                <div class="flex flex-row items-center justify-center gap-4">
                                    {{-- Spinner --}}
                                    <svg class="animate-spin h-7 w-7 text-white shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>

                                    {{-- Texto --}}
                                    <span class="uppercase tracking-[2px] whitespace-nowrap leading-none">
                                        VERIFICANDO...
                                    </span>
                                </div>
                            </div>
                        </button>
                    </div>
                </form>
            </div>
        </section>

        {{-- Footer --}}
        <div class="mt-8 text-center">
            <a href="/" class="text-gray-500 text-[10px] uppercase font-bold tracking-[2px] hover:text-brand-orange transition-colors no-underline">
                ← Volver al inicio de la convocatoria
            </a>
        </div>

    </div>
</div>