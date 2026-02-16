<div>
    {{-- NAV --}}
    <nav class="fixed top-0 left-0 w-full z-[1000] flex justify-between items-center px-6 py-5 md:px-12 bg-black/95 border-b border-brand-border">
        <a href="/" class="font-bebas text-3xl text-brand-orange tracking-[2px] no-underline"> ACTORES S.C.G. </a>
        <span class="font-bebas text-xl text-gray-500 hidden md:block uppercase tracking-widest"> Etapa 01: Inscripción Inicial </span>
    </nav>

    <main class="bg-black min-h-screen pt-32 pb-24 px-6">
        <div class="max-w-[1100px] mx-auto text-left">
            <header class="mb-12 border-l-4 border-brand-orange pl-6">
                <div class="text-brand-orange font-bold text-sm uppercase tracking-[3px] mb-2"> Convocatoria 2026 </div>
                <h1 class="font-bebas text-[clamp(2.5rem,6vw,4.5rem)] leading-none mb-4 text-white uppercase"> INSCRIPCIÓN INCENTIVOS AUDIOVISUALES </h1>
            </header>

            @if (session()->has('error'))
            <div class="bg-red-600 text-white p-4 mb-6 font-bold uppercase text-sm border-l-4 border-white animate-pulse">
                {{ session('error') }}
            </div>
            @endif

            <form wire:submit.prevent="guardar" class="space-y-10">

                {{-- 1. DATOS DEL PROPONENTE --}}
                <section class="bg-brand-surface border border-brand-border p-8 md:p-10 relative overflow-hidden group hover:border-brand-orange/50 transition-colors duration-500 text-left">
                    <h2 class="font-bebas text-3xl text-brand-orange tracking-wider border-b border-brand-border pb-4 mb-8 uppercase"> 1. DATOS DEL PROPONENTE </h2>
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-y-10 gap-x-12 relative z-10">
                        <div class="md:col-span-8 space-y-1">
                            <label class="block text-[10px] uppercase font-bold text-brand-orange/70 mb-2 tracking-widest">Nombre Completo</label>
                            <p class="text-white font-bebas text-3xl tracking-wide border-b border-white/10 pb-2 uppercase">
                                {{ str_replace(',', '', mb_strtoupper($socio->nombre)) }}
                            </p>
                        </div>
                        <div class="md:col-span-4 space-y-1">
                            <label class="block text-[10px] uppercase font-bold text-gray-500 mb-2 tracking-widest">Teléfono</label>
                            <p class="text-white font-mono text-xl border-b border-white/10 pb-2">{{ $socio->telefono }}</p>
                        </div>
                        <div class="md:col-span-12 mt-2">
                            <div class="bg-black/50 p-6 border-l-4 border-brand-orange">
                                <label class="block text-[10px] uppercase font-bold text-brand-orange mb-2 tracking-[2px]">Correo Electrónico Principal</label>
                                <p class="text-white font-bold text-2xl break-all">{{ mb_strtolower($socio->correo) }}</p>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- 2. DETALLES DE LA PROPUESTA --}}
                <section class="bg-brand-surface border border-brand-border p-8 md:p-10 space-y-8 text-left">
                    <h2 class="font-bebas text-3xl text-brand-orange border-b border-brand-border pb-2 inline-block uppercase"> 2. DETALLES DE LA PROPUESTA </h2>
                    <div>
                        <label class="block text-[10px] uppercase font-bold mb-2 tracking-widest text-brand-orange">Nombre de la propuesta</label>
                        <input type="text" wire:model.live="titulo" class="w-full bg-black border border-brand-border px-4 py-4 text-white focus:border-brand-orange outline-none uppercase font-semibold">
                        @error('titulo') <span class="text-red-500 text-[10px] mt-1 block uppercase font-bold">{{ $message }}</span> @enderror
                    </div>

                    <div class="bg-black/40 p-6 border border-brand-border space-y-6">
                        <label class="block text-sm font-bold text-gray-300 uppercase">¿El guion es de tu autoría?</label>
                        <div class="flex flex-col md:flex-row gap-6">
                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="radio" value="si" wire:model.live="autoria" class="w-5 h-5 accent-brand-orange">
                                <span class="text-white font-medium">Sí</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="radio" value="no" wire:model.live="autoria" class="w-5 h-5 accent-brand-orange">
                                <span class="text-white font-medium">No</span>
                            </label>
                        </div>

                        <div x-show="$wire.autoria === 'no'" x-transition class="mt-6 p-6 border border-dashed border-brand-border bg-black/30 space-y-5">
                            <div class="flex flex-col md:flex-row gap-6"
                                x-data="{ isUploading: false, isUploaded: false, progress: 0, hasError: false }"
                                x-on:livewire-upload-start="isUploading = true; isUploaded = false; hasError = false; progress = 0"
                                x-on:livewire-upload-finish="isUploading = false; isUploaded = true;"
                                x-on:livewire-upload-error="isUploading = false; hasError = true;"
                                x-on:livewire-upload-progress="progress = $event.detail.progress">

                                <a href="{{ asset('storage/formatos/etapa_01_autorizacion_uso_guion_cia_2026.pdf') }}" target="_blank" class="inline-flex items-center gap-3 px-6 py-3 bg-brand-orange text-black font-semibold rounded no-underline shrink-0 h-fit"> Descargar formato </a>
                                <div class="flex-1 w-full text-left">
                                    <label class="block text-xs uppercase font-bold text-gray-500 mb-2 tracking-widest">Subir formato firmado (PDF)</label>
                                    <input type="file" wire:model.live="guionArchivo" accept=".pdf" class="w-full text-sm text-gray-400 file:bg-gray-800 file:text-white file:border-0 file:px-4 file:py-2">

                                    <div x-show="isUploading || hasError" class="mt-2 w-full bg-gray-800 rounded-full h-1.5">
                                        <div class="h-1.5 rounded-full transition-all duration-300" :class="hasError ? 'bg-red-500 w-full' : 'bg-brand-orange'" :style="'width: ' + progress + '%'"></div>
                                    </div>

                                    {{-- Éxito en Cápsula --}}
                                    <div x-show="isUploaded && !isUploading" x-transition class="mt-3 flex items-center gap-3 px-4 py-3 bg-green-500/10 border border-green-500/50 rounded w-full">
                                        <span class="text-[11px] text-green-400 font-bold uppercase tracking-wider">Documento cargado correctamente</span>
                                    </div>

                                    {{-- Error en Texto --}}
                                    @error('guionArchivo')
                                    <span class="text-red-500 text-[10px] mt-2 block uppercase font-bold">{{ str_replace('kilobytes', 'MB', str_replace('12288', '12', $message)) }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- 3. DATOS DEL DIRECTOR --}}
                <section class="bg-brand-surface border border-brand-border p-8 md:p-10 space-y-10 text-left">
                    <div class="border-b border-brand-border pb-4 flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <h2 class="font-bebas text-3xl text-brand-orange tracking-wider uppercase"> 3. DOCUMENTACIÓN DEL DIRECTOR </h2>
                        <div class="flex items-center gap-4 bg-black/50 px-4 py-2 border border-brand-border">
                            <span class="text-[10px] uppercase font-bold text-gray-400">¿Tú eres el director?</span>
                            <div class="flex gap-4">
                                <label class="flex items-center gap-2 cursor-pointer group">
                                    <input type="radio" value="si" wire:model.live="directorPropio" class="w-4 h-4 accent-brand-orange">
                                    <span class="text-xs uppercase font-bold text-white group-hover:text-brand-orange">SÍ</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer group">
                                    <input type="radio" value="no" wire:model.live="directorPropio" class="w-4 h-4 accent-brand-orange">
                                    <span class="text-xs uppercase font-bold text-white group-hover:text-brand-orange">NO</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div x-show="$wire.directorPropio === 'no'" x-transition class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-black/30 p-8 border border-dashed border-brand-border">
                        <div class="md:col-span-2"><p class="text-brand-orange font-bold text-[10px] uppercase tracking-[2px] mb-2">Información del Director Externo</p></div>
                        <div>
                            <label class="block text-[10px] uppercase font-bold mb-2 text-gray-500 tracking-widest">Identificación</label>
                            <input type="text" wire:model.live="directorIdentificacion" class="w-full bg-black border border-brand-border px-4 py-3 text-white focus:border-brand-orange outline-none uppercase text-sm">
                            @error('directorIdentificacion') <span class="text-red-500 text-[10px] mt-1 block uppercase font-bold">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-[10px] uppercase font-bold mb-2 text-gray-500 tracking-widest">Nombre Completo</label>
                            <input type="text" wire:model.live="directorNombre" class="w-full bg-black border border-brand-border px-4 py-3 text-white focus:border-brand-orange outline-none uppercase text-sm">
                            @error('directorNombre') <span class="text-red-500 text-[10px] mt-1 block uppercase font-bold">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-[10px] uppercase font-bold mb-2 text-gray-500 tracking-widest">Celular</label>
                            <input type="text" wire:model.live="directorCelular" class="w-full bg-black border border-brand-border px-4 py-3 text-white focus:border-brand-orange outline-none text-sm">
                            @error('directorCelular') <span class="text-red-500 text-[10px] mt-1 block uppercase font-bold">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-[10px] uppercase font-bold mb-2 text-gray-500 tracking-widest">Correo Electrónico</label>
                            <input type="email" wire:model.live="directorCorreo" class="w-full bg-black border border-brand-border px-4 py-3 text-white focus:border-brand-orange outline-none text-sm">
                            @error('directorCorreo') <span class="text-red-500 text-[10px] mt-1 block uppercase font-bold">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-6">
                        @foreach([
                            ['model' => 'docDirectorExperiencia', 'label' => 'Experiencia del director', 'formato' => 'formato_experiencia_director.pdf'],
                            ['model' => 'docDirectorCompromiso', 'label' => 'Compromiso de participación', 'formato' => 'formato_compromiso_director.pdf'],
                            ['model' => 'docDirectorEvidencia1', 'label' => 'Certificado y evidencias 1', 'formato' => 'formato_evidencias_director.pdf'],
                            ['model' => 'docDirectorEvidencia2', 'label' => 'Certificado y evidencias 2', 'formato' => 'formato_evidencias_director.pdf']
                        ] as $item)
                        <div class="p-6 border border-brand-border bg-black/30 space-y-5" x-data="{ isUploading: false, isUploaded: false, progress: 0, hasError: false }" x-on:livewire-upload-start="isUploading = true; isUploaded = false; hasError = false; progress = 0" x-on:livewire-upload-finish="isUploading = false; isUploaded = true;" x-on:livewire-upload-error="isUploading = false; hasError = true;" x-on:livewire-upload-progress="progress = $event.detail.progress">
                            <label class="block text-[10px] uppercase font-bold text-brand-orange tracking-widest text-left">{{ $item['label'] }}</label>
                            <div class="flex flex-col gap-4">
                                <a href="{{ asset('storage/formatos/'.$item['formato']) }}" target="_blank" class="inline-flex items-center justify-center gap-3 px-5 py-3 bg-brand-orange text-black font-semibold rounded no-underline"> Descargar formato </a>
                                <input type="file" wire:model.live="{{ $item['model'] }}" accept=".pdf" class="w-full text-sm text-gray-400 file:bg-gray-800 file:text-white file:border-0 file:px-4 file:py-2">
                                <div x-show="isUploading || hasError" class="w-full bg-gray-800 rounded-full h-1.5"><div class="h-1.5 rounded-full transition-all duration-300" :class="hasError ? 'bg-red-500 w-full' : 'bg-brand-orange'" :style="'width: ' + progress + '%'"></div></div>
                                
                                {{-- Éxito en Cápsula --}}
                                <div x-show="isUploaded && !isUploading" class="mt-1 flex items-center gap-3 px-4 py-3 bg-green-500/10 border border-green-500/50 rounded w-full text-green-400">
                                    <span class="text-[11px] font-bold uppercase tracking-wider">Documento cargado correctamente</span>
                                </div>

                                {{-- Error en Texto --}}
                                @error($item['model'])
                                <span class="text-red-500 text-[10px] mt-1 block uppercase font-bold text-left">
                                    {{ str_replace('kilobytes', 'MB', str_replace('12288', '12', $message)) }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        @endforeach
                    </div>
                </section>

                {{-- 4. CONSIDERACIONES FINALES --}}
                <section class="bg-brand-surface border border-brand-border p-8 md:p-10 space-y-8 text-left">
                    <h2 class="font-bebas text-3xl text-brand-orange border-b border-brand-border pb-4 uppercase tracking-wider"> 4. CONSIDERACIONES FINALES </h2>
                    
                    <div class="bg-black/40 p-8 border border-brand-border space-y-10">
                        <div class="flex flex-col md:flex-row gap-6 items-end" x-data="{ isUploading: false, isUploaded: false, progress: 0, hasError: false }" x-on:livewire-upload-start="isUploading=true; isUploaded=false; hasError=false; progress=0" x-on:livewire-upload-finish="isUploading=false; isUploaded=true;" x-on:livewire-upload-error="isUploading=false; hasError=true;" x-on:livewire-upload-progress="progress=$event.detail.progress">
                            <a href="{{ asset('storage/formatos/formato_declaraciones_2026.pdf') }}" class="px-6 py-3 bg-brand-orange text-black font-semibold rounded no-underline shrink-0 h-fit"> Descargar formato </a>
                            <div class="flex-1 w-full text-left">
                                <label class="block text-xs uppercase font-bold text-gray-500 mb-2 tracking-widest">Subir formato firmado (PDF)</label>
                                <input type="file" wire:model.live="formatoFirmado" accept=".pdf" class="w-full text-sm text-gray-400 file:bg-gray-800 file:text-white file:border-0 file:px-4 file:py-2">
                                <div x-show="isUploading || hasError" class="mt-2 w-full bg-gray-800 h-1.5"><div class="h-1.5 transition-all" :class="hasError ? 'bg-red-500 w-full' : 'bg-brand-orange'" :style="'width: ' + progress + '%'"></div></div>
                                
                                {{-- Éxito en Cápsula --}}
                                <div x-show="isUploaded && !isUploading" class="mt-3 p-3 bg-green-500/10 border border-green-500/50 rounded text-green-400 font-bold text-[11px] uppercase text-center">Documento cargado correctamente</div>
                                
                                {{-- Error en Texto --}}
                                @error('formatoFirmado') 
                                <span class="text-red-500 text-[10px] mt-2 block uppercase font-bold">{{ str_replace('kilobytes', 'MB', str_replace('12288', '12', $message)) }}</span> 
                                @enderror
                            </div>
                        </div>

                        <div class="space-y-8 pt-10 border-t border-white/10 text-left">
                            <div class="space-y-4">
                                <label class="flex items-start gap-5 cursor-pointer group">
                                    <input type="checkbox" wire:model.live="aceptaTerminos" class="mt-1 w-6 h-6 accent-brand-orange shrink-0">
                                    <span class="text-sm text-gray-300 group-hover:text-white transition-colors leading-relaxed">
                                        Acepto, de manera voluntaria, previa, explícita e informada los términos y condiciones establecidos en la presente convocatoria.
                                    </span>
                                </label>
                                @error('aceptaTerminos') <span class="text-red-500 text-[10px] block uppercase font-bold ml-11">{{ $message }}</span> @enderror
                            </div>

                            <div class="space-y-4">
                                <label class="flex items-start gap-5 cursor-pointer group">
                                    <input type="checkbox" wire:model.live="aceptaDatos" class="mt-1 w-6 h-6 accent-brand-orange shrink-0">
                                    <span class="text-sm text-gray-300 group-hover:text-white transition-colors leading-relaxed">
                                        Autorizo de manera voluntaria, previa, explícita e informada a Actores Sociedad Colombiana de Gestión (ACTORES S.C.G.) para tratar mis datos personales de acuerdo con la Política de Tratamiento de Datos Personales de la Sociedad, lo establecido en la presente convocatoria y para los fines relacionados con su objeto social y en especial para fines legales, contractuales, comerciales descritos en la Política de Tratamiento de Datos Personales. La información obtenida para el Tratamiento de mis datos personales la he suministrado de forma voluntaria y es verídica.
                                    </span>
                                </label>
                                @error('aceptaDatos') <span class="text-red-500 text-[10px] block uppercase font-bold ml-11">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                </section>

                <div class="text-center pt-10 pb-20 flex flex-col items-center">
                    <button type="submit" wire:loading.attr="disabled" class="group relative inline-flex items-center justify-center bg-brand-orange text-white font-bebas text-4xl hover:bg-[#ff6a33] transition-all disabled:opacity-50 min-w-[450px] py-6 shadow-2xl">
                        <span wire:loading.remove wire:target="guardar"> FINALIZAR E INSCRIBIR PROYECTO </span>
                        <div wire:loading wire:target="guardar" class="flex items-center gap-4">
                            <svg class="animate-spin h-8 w-8 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                            <span>PROCESANDO REGISTRO...</span>
                        </div>
                    </button>
                    <p class="text-gray-500 text-[10px] uppercase font-bold mt-6 tracking-[3px]">Asegúrese de haber cargado todos los documentos obligatorios</p>
                </div>
            </form>
        </div>
    </main>
</div>