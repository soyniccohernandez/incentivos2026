<div>
    {{-- NAV --}}
    <nav class="fixed top-0 left-0 w-full z-[1000] flex justify-between items-center px-6 py-5 md:px-12 bg-black/95 border-b border-brand-border">
        <a href="/" class="font-bebas text-3xl text-brand-orange tracking-[2px] no-underline">
            ACTORES S.C.G.
        </a>
        <span class="font-bebas text-xl text-gray-500 hidden md:block uppercase tracking-widest">
            Etapa 01: Inscripción Inicial
        </span>
    </nav>

    <main class="bg-black min-h-screen pt-32 pb-24 px-6">
        <div class="max-w-[1100px] mx-auto" x-data>

            <header class="mb-12 border-l-4 border-brand-orange pl-6">
                <div class="text-brand-orange font-bold text-sm uppercase tracking-[3px] mb-2">
                    Convocatoria 2026
                </div>
                <h1 class="font-bebas text-[clamp(2.5rem,6vw,4.5rem)] leading-none mb-4 text-white">
                    INSCRIPCIÓN INCENTIVOS AUDIOVISUALES
                </h1>
            </header>

            <form wire:submit.prevent="guardar" class="space-y-10">

                {{-- NOTA DE ACTUALIZACIÓN DE DATOS --}}
                <div class="mb-6 bg-blue-900/20 border-l-4 border-blue-500 p-6 flex items-start gap-4">
                    <svg class="w-6 h-6 text-blue-500 shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <h4 class="text-white font-bold text-sm uppercase tracking-wider mb-1">Nota Importante: Verificación de Datos</h4>
                        <p class="text-gray-400 text-sm leading-relaxed">
                            Para evitar inconsistencias en tu inscripción, es fundamental que tus datos ante la sociedad estén actualizados.
                            <span class="text-blue-400 font-semibold">Las notificaciones oficiales se realizarán exclusivamente a través de la información que verás a continuación.</span>
                            Si necesitas realizar cambios, comunícate de inmediato con el **Área de Gestión de Socios**.
                        </p>
                    </div>
                </div>

                {{-- 1. DATOS DEL PROPONENTE --}}
                <section class="bg-brand-surface border border-brand-border p-8 md:p-10 space-y-6 relative overflow-hidden group hover:border-brand-orange/50 transition-colors duration-500">
                    {{-- Efecto sutil de resaltado (Luz en la esquina) --}}
                    <div class="absolute -top-10 -right-10 w-32 h-32 bg-brand-orange/5 blur-[50px] group-hover:bg-brand-orange/10 transition-all"></div>

                    <h2 class="font-bebas text-3xl text-brand-orange border-b border-brand-border pb-2 inline-block">
                        1. DATOS DEL PROPONENTE
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 relative z-10">
                        <div class="group/item">
                            <label class="block text-[10px] uppercase font-bold text-gray-500 mb-2 tracking-widest group-hover/item:text-brand-orange transition-colors">Nombre Completo</label>
                            <p class="text-white font-semibold border-b border-white/10 pb-2">{{ $socio->nombre }}</p>
                        </div>
                        <div class="group/item">
                            <label class="block text-[10px] uppercase font-bold text-gray-500 mb-2 tracking-widest group-hover/item:text-brand-orange transition-colors">Tipo de Socio</label>
                            <p class="text-white font-semibold border-b border-white/10 pb-2">{{ $socio->tipo_socio }}</p>
                        </div>
                        <div class="group/item">
                            <label class="block text-[10px] uppercase font-bold text-gray-500 mb-2 tracking-widest group-hover/item:text-brand-orange transition-colors">Teléfono</label>
                            <p class="text-white font-semibold border-b border-white/10 pb-2">{{ $socio->telefono }}</p>
                        </div>
                        <div class="group/item">
                            <label class="block text-[10px] uppercase font-bold text-gray-500 mb-2 tracking-widest group-hover/item:text-brand-orange transition-colors">Correo Electrónico</label>
                            <p class="text-white font-semibold border-b border-white/10 pb-2">{{ $socio->correo }}</p>
                        </div>
                    </div>
                </section>

                {{-- 2. DETALLES DE LA PROPUESTA --}}
                <section class="bg-brand-surface border border-brand-border p-8 md:p-10 space-y-8">
                    <h2 class="font-bebas text-3xl text-brand-orange border-b border-brand-border pb-2 inline-block">
                        2. DETALLES DE LA PROPUESTA
                    </h2>

                    <div>
                        <label class="block text-[10px] uppercase font-bold mb-2 tracking-widest text-brand-orange">Nombre de la propuesta</label>
                        <input type="text" wire:model.live="titulo"
                            class="w-full bg-black border border-brand-border px-4 py-4 text-white focus:border-brand-orange outline-none">
                        @error('titulo') <span class="text-red-500 text-xs mt-1 block uppercase tracking-tight">{{ $message }}</span> @enderror
                    </div>

                    <div class="bg-black/40 p-6 border border-brand-border space-y-6">
                        <label class="block text-sm font-bold text-gray-300 uppercase">¿El guion es de tu autoría?</label>

                        <div class="flex flex-col md:flex-row gap-6">
                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="radio" value="si" wire:model.live="autoria" class="w-5 h-5 accent-brand-orange">
                                <span class="text-white font-medium">Sí, el guion es de mi autoría</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="radio" value="no" wire:model.live="autoria" class="w-5 h-5 accent-brand-orange">
                                <span class="text-white font-medium">No, el guion es de un tercero</span>
                            </label>
                        </div>
                        @error('autoria') <span class="text-red-500 text-xs mt-1 block uppercase tracking-tight">{{ $message }}</span> @enderror

                        <div x-show="$wire.autoria === 'no'" x-transition class="mt-6 p-6 border border-dashed border-brand-border bg-black/30 space-y-5">
                            <p class="text-sm text-gray-400">Debes descargar, diligenciar y subir el formato de autorización del guion.</p>

                            <div class="flex flex-col md:flex-row gap-6" x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">
                                <a href="{{ asset('storage/formatos/etapa_01_autorizacion_uso_guion_cia_2026.pdf') }}" target="_blank" class="inline-flex items-center gap-3 px-6 py-3 bg-brand-orange text-black font-semibold rounded no-underline shrink-0">
                                    Descargar formato
                                </a>

                                <div class="flex-1">
                                    <label class="block text-xs uppercase font-bold text-gray-500 mb-2 tracking-widest">Subir formato firmado (PDF)</label>
                                    <input type="file" wire:model.live="guionArchivo" class="w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-gray-800 file:text-white">

                                    <div x-show="isUploading" class="mt-2">
                                        <div class="w-full bg-gray-800 rounded-full h-1.5">
                                            <div class="bg-brand-orange h-1.5 rounded-full transition-all duration-300" :style="'width: ' + progress + '%'"></div>
                                        </div>
                                    </div>
                                    <div wire:loading wire:target="guionArchivo" class="text-blue-500 text-[10px] uppercase font-bold tracking-widest mt-2">
                                        Verificando archivo...
                                    </div>
                                    @error('guionArchivo') <span class="text-red-500 text-xs mt-1 block uppercase tracking-tight">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- 3. DATOS DEL DIRECTOR --}}
                <section class="bg-brand-surface border border-brand-border p-8 md:p-10 space-y-10">
                    <h2 class="font-bebas text-3xl text-brand-orange border-b border-brand-border pb-2 inline-block">
                        3. DATOS DEL DIRECTOR
                    </h2>

                    <div class="bg-black/40 p-6 border border-brand-border space-y-6">
                        <label class="block text-sm font-bold text-gray-300 uppercase">¿El director es el mismo proponente?</label>

                        <div class="flex gap-8">
                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="radio" value="si" wire:model.live="directorPropio" class="w-5 h-5 accent-brand-orange">
                                <span class="text-white">Sí</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="radio" value="no" wire:model.live="directorPropio" class="w-5 h-5 accent-brand-orange">
                                <span class="text-white">No</span>
                            </label>
                        </div>
                        @error('directorPropio') <span class="text-red-500 text-xs mt-1 block uppercase tracking-tight">{{ $message }}</span> @enderror

                        <div x-show="$wire.directorPropio === 'no'" x-transition class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-6 border-t border-brand-border/40">
                            <div>
                                <label class="block text-[10px] uppercase font-bold text-gray-500 mb-2 tracking-widest">Identificación</label>
                                <input type="text" wire:model.live="directorIdentificacion" class="w-full bg-black border border-brand-border px-4 py-3 text-white focus:border-brand-orange outline-none">
                                @error('directorIdentificacion') <span class="text-red-500 text-xs mt-1 block uppercase tracking-tight">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-[10px] uppercase font-bold text-gray-500 mb-2 tracking-widest">Nombre completo</label>
                                <input type="text" wire:model.live="directorNombre" class="w-full bg-black border border-brand-border px-4 py-3 text-white focus:border-brand-orange outline-none">
                                @error('directorNombre') <span class="text-red-500 text-xs mt-1 block uppercase tracking-tight">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-[10px] uppercase font-bold text-gray-500 mb-2 tracking-widest">Celular</label>
                                <input type="text" wire:model.live="directorCelular" class="w-full bg-black border border-brand-border px-4 py-3 text-white focus:border-brand-orange outline-none">
                                @error('directorCelular') <span class="text-red-500 text-xs mt-1 block uppercase tracking-tight">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-[10px] uppercase font-bold text-gray-500 mb-2 tracking-widest">Correo electrónico</label>
                                <input type="email" wire:model.live="directorCorreo" class="w-full bg-black border border-brand-border px-4 py-3 text-white focus:border-brand-orange outline-none">
                                @error('directorCorreo') <span class="text-red-500 text-xs mt-1 block uppercase tracking-tight">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Certificaciones --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-6">
                        @foreach(range(0, 1) as $index)
                        <div class="p-6 border border-brand-border bg-black/30 space-y-5">
                            <label class="block text-[10px] uppercase font-bold text-gray-500 tracking-widest">
                                Certificación Experiencia {{ $index + 1 }}
                            </label>

                            <div class="flex flex-col gap-4" x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">
                                <a href="#" class="inline-flex items-center justify-center gap-3 px-5 py-3 bg-brand-orange text-black font-semibold rounded no-underline hover:bg-[#ff6a33] transition-colors">
                                    Descargar formato
                                </a>

                                <input type="file" wire:model.live="certificaciones.{{ $index }}" class="w-full text-sm text-gray-400 file:bg-gray-800 file:text-white file:border-0 file:px-4 file:py-2">

                                <div x-show="isUploading" class="w-full bg-gray-800 rounded-full h-1.5 mt-1">
                                    <div class="bg-brand-orange h-1.5 rounded-full transition-all duration-300" :style="'width: ' + progress + '%'"></div>
                                </div>
                                <div wire:loading wire:target="certificaciones.{{ $index }}" class="text-blue-500 text-[10px] uppercase font-bold tracking-widest mt-2">
                                    Verificando archivo...
                                </div>
                                @error('certificaciones.' . $index) <span class="text-red-500 text-xs mt-1 block uppercase tracking-tight">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        @endforeach
                    </div>
                </section>

                {{-- 4. DECLARACIONES Y CONSIDERACIONES --}}
                <section class="bg-brand-surface border border-brand-border p-8 md:p-10 space-y-8">
                    <h2 class="font-bebas text-3xl text-brand-orange border-b border-brand-border pb-2 inline-block">
                        4. DECLARACIONES Y CONSIDERACIONES
                    </h2>

                    <div class="p-8 border-2 border-dashed border-brand-border bg-black/40 space-y-6">

                        <div class="flex flex-col md:flex-row gap-6 items-end" x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">
                            <a href="#" class="inline-flex items-center gap-3 px-6 py-3 bg-brand-orange text-black font-semibold rounded no-underline shrink-0">
                                Descargar formato
                            </a>

                            <div class="flex-1 w-full">
                                <label class="block text-xs uppercase font-bold text-gray-500 mb-2 tracking-widest">Subir formato firmado</label>
                                <input type="file" wire:model.live="formatoFirmado" class="w-full text-sm text-gray-400 file:bg-gray-800 file:text-white file:border-0 file:px-4 file:py-2">

                                <div x-show="isUploading" class="mt-2 w-full bg-gray-800 rounded-full h-1.5">
                                    <div class="bg-brand-orange h-1.5 rounded-full transition-all duration-300" :style="'width: ' + progress + '%'"></div>
                                </div>

                                <div wire:loading wire:target="formatoFirmado" class="text-blue-500 text-[10px] uppercase font-bold tracking-widest mt-2">
                                    Verificando archivo...
                                </div>

                                @error('formatoFirmado') <span class="text-red-500 text-xs mt-1 block uppercase tracking-tight">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="space-y-4 pt-4 border-t border-brand-border/40">
                            {{-- Primer Checkbox (Normal) --}}
                            <label class="flex items-start gap-3 cursor-pointer group">
                                <input type="checkbox" wire:model.live="aceptaTerminos" class="mt-1 w-4 h-4 accent-brand-orange shrink-0">
                                <span class="text-sm text-gray-300 group-hover:text-white transition-colors leading-snug">
                                    Acepto, de manera voluntaria, previa, explícita e informada los términos y condiciones establecidos en la presente convocatoria.
                                </span>
                            </label>
                            @error('aceptaTerminos') <span class="text-red-500 text-[10px] mt-1 block uppercase font-bold tracking-widest">{{ $message }}</span> @enderror

                            {{-- Segundo Checkbox: Clic marca y despliega --}}
                            <div x-data="{ open: @entangle('aceptaDatos') }" class="group/item">
                                <label class="flex items-start gap-3 cursor-pointer">
                                    {{-- Checkbox vinculado a Alpine y Livewire --}}
                                    <input type="checkbox"
                                        x-model="open"
                                        class="mt-1 w-4 h-4 accent-brand-orange shrink-0">

                                    <div class="flex flex-col w-full">
                                        {{-- Texto que invita a dar clic --}}
                                        <div class="flex items-center justify-between w-full group-hover/item:text-white transition-all text-sm text-gray-300">
                                            <span class="leading-snug">Autorizo el tratamiento de mis datos personales (ACTORES S.C.G.)...</span>
                                            {{-- Flecha que rota según el estado del check --}}
                                            <svg :class="open ? 'rotate-180' : ''" class="w-4 h-4 text-brand-orange transition-transform duration-300 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </div>

                                        {{-- Contenido legal que se despliega al marcar --}}
                                        <div x-show="open"
                                            x-collapse
                                            class="mt-3 text-[11px] text-gray-500 leading-relaxed italic uppercase tracking-tighter pr-4 border-l border-brand-orange/30 pl-4">
                                            Autorizo de manera voluntaria, previa, explícita e informada a Actores Sociedad Colombiana de Gestión (ACTORES S.C.G.) para tratar mis datos personales de acuerdo con la Política de Tratamiento de Datos Personales de la Sociedad, lo establecido en la presente convocatoria y para los fines relacionados con su objeto social y en especial para fines legales, contractuales, comerciales descritos en la Política de Tratamiento de Datos Personales. La información obtenida la he suministrado de forma voluntaria y es verídica.
                                        </div>
                                    </div>
                                </label>
                                @error('aceptaDatos') <span class="text-red-500 text-[10px] mt-1 block uppercase font-bold tracking-widest">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                </section>
                <div class="text-center pt-10 pb-20 flex flex-col items-center">

                    {{-- Contenedor del Botón --}}
                    <button type="submit"
                        wire:loading.attr="disabled"
                        wire:target="guardar, guionArchivo, certificaciones, formatoFirmado"
                        {{-- Mantenemos dimensiones fijas y posición relativa --}}
                        class="group relative inline-flex items-center justify-center bg-brand-orange text-white font-bebas text-3xl hover:bg-[#ff6a33] transition-all disabled:opacity-50 disabled:cursor-not-allowed min-w-[420px] h-[85px] overflow-hidden px-10">

                        {{-- ESTADO 1: Texto Normal --}}
                        <span wire:loading.remove wire:target="guardar">
                            FINALIZAR E INSCRIBIR PROYECTO
                        </span>

                        {{-- ESTADO 2: Procesando (Capa superior) --}}
                        <div wire:loading wire:target="guardar"
                            class="absolute inset-0 flex items-center justify-center bg-brand-orange">

                            {{-- CONTENEDOR DE BLOQUE: Esto obliga a que el spinner y texto estén juntos y centrados --}}
                            <div class="flex items-center justify-center gap-4 w-full h-full">
                                <svg class="animate-spin h-8 w-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <span class="uppercase tracking-wider whitespace-nowrap">
                                    PROCESANDO INSCRIPCIÓN...
                                </span>
                            </div>

                        </div>
                    </button>

                    {{-- Mensaje de carga de archivos (Forzado abajo con w-full) --}}
                    <div class="w-full mt-6 h-6"> {{-- Altura fija para evitar saltos de layout cuando aparece --}}
                        <div wire:loading wire:target="guionArchivo, certificaciones, formatoFirmado"
                            class="text-brand-orange text-xs font-bold uppercase tracking-[2px] animate-pulse">
                            Subiendo archivos al servidor, por favor espera...
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
</div>