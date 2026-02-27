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

            {{-- COLUMNA IZQUIERDA (8) - EL PROYECTO --}}
            <div class="lg:col-span-8 space-y-8">

                {{-- CARD DE IDENTIDAD DEL PROYECTO --}}
                <div class="bg-white rounded-[3rem] border border-slate-100 shadow-sm overflow-hidden relative">
                    <div class="absolute top-0 left-0 w-full h-24 bg-slate-900 bg-grid opacity-5"></div>

                    <div class="relative pt-12 px-10 pb-10">
                        <div class="relative flex flex-col md:flex-row justify-between items-end gap-6 mb-12">

                            <div class="relative z-10 space-y-6">
                                {{-- BADGE INDUSTRIAL --}}
                                <div class="inline-flex items-center group">
                                    <div class="flex items-center bg-white border-2 border-slate-950 rounded-2xl overflow-hidden shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                                        <span class="px-4 py-2 bg-slate-950 text-[10px] font-black text-white uppercase tracking-[2px]">EXPEDIENTE</span>
                                        <span class="px-5 py-2 text-slate-900 text-[12px] font-black uppercase tracking-[3px]">
                                            {{ $proyecto->codigo_radicado }}
                                        </span>
                                    </div>
                                </div>

                                {{-- TÍTULO CON FUERZA --}}
                                <h1 class="font-outfit text-6xl md:text-8xl font-900 text-slate-950 tracking-[-0.05em] leading-[0.82] uppercase">
                                    <span class="text-[#ff6600]">{{ mb_substr($proyecto->titulo, 0, 1) }}</span>{{ mb_substr($proyecto->titulo, 1) }}
                                </h1>

                                {{-- SEPARADOR --}}
                                <div class="flex items-center gap-3">
                                    <div class="h-[3px] w-20 bg-[#ff6600]"></div>
                                    <div class="h-[3px] w-3 bg-slate-950"></div>
                                </div>
                            </div>

                            {{-- BLOQUE DE ESTADO RÁPIDO --}}
                            <div class="hidden md:block shrink-0 text-right pb-2">
                                <div class="inline-block px-4 py-1 border-2 border-[#ff6600] rounded-lg mb-2">
                                    <p class="text-[10px] font-black text-[#ff6600] uppercase tracking-[4px]">CONVOCATORIA</p>
                                </div>
                                <p class="font-outfit text-3xl font-900 text-slate-950 uppercase tracking-tighter leading-none">
                                    VIGENTE <span class="text-slate-300">2026</span>
                                </p>
                            </div>
                        </div>

                        {{-- DATOS DEL PROPONENTE (TITULAR) --}}
                        <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-sm relative overflow-hidden group mb-10">
                            {{-- Decoración sutil de fondo (Marca de agua) --}}
                            <div class="absolute right-10 top-1/2 -translate-y-1/2 text-slate-50 opacity-10 group-hover:scale-110 transition-transform duration-500 pointer-events-none">
                                <svg class="w-48 h-48" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                                </svg>
                            </div>

                            <div class="relative z-10">
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[4px] mb-8">Titular del Proyecto</p>

                                <div class="flex flex-col lg:flex-row items-center lg:items-start gap-8">
                                    {{-- Contenedor de Foto / Avatar --}}
                                    <div class="shrink-0 h-24 w-24 rounded-[2rem] bg-slate-100 border-4 border-white shadow-2xl shadow-slate-200 overflow-hidden flex items-center justify-center">
                                        @php
                                        $identificacion = Auth::user()->documento;
                                        $extensiones = ['jpg', 'jpeg', 'png', 'webp', 'JPG', 'PNG'];
                                        $rutaFoto = null;
                                        foreach ($extensiones as $ext) {
                                        if (file_exists(storage_path("app/public/socios/{$identificacion}.{$ext}"))) {
                                        $rutaFoto = asset("storage/socios/{$identificacion}.{$ext}");
                                        break;
                                        }
                                        }
                                        @endphp

                                        @if($rutaFoto)
                                        <img src="{{ $rutaFoto }}" class="h-full w-full object-cover">
                                        @else
                                        <span class="font-outfit text-3xl font-900 text-[#ff6600] uppercase">
                                            {{ collect(explode(' ', Auth::user()->name))->map(fn($n) => mb_substr($n, 0, 1))->take(2)->implode('') }}
                                        </span>
                                        @endif
                                    </div>

                                    <div class="flex-1 min-w-0 w-full">
                                        {{-- Nombre y Título --}}
                                        <div class="text-center lg:text-left mb-6">
                                            <h3 class="font-outfit text-3xl font-800 text-slate-900 uppercase leading-tight">
                                                {{ Auth::user()->name }}
                                            </h3>
                                            <p class="text-[11px] text-[#ff6600] font-bold uppercase mt-2 tracking-[0.3em]">
                                                Socio Proponente
                                            </p>
                                        </div>

                                        {{-- Rejilla de Datos de Contacto (Mismo estilo que el Director) --}}
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-6 mt-6 pt-8 border-t border-slate-50">

                                            {{-- Documento --}}
                                            <div class="flex items-center gap-4">
                                                <div class="h-10 w-10 shrink-0 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-4 0H5m14 0h-5" stroke-width="2" />
                                                    </svg>
                                                </div>
                                                <div class="min-w-0">
                                                    <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Identificación</p>
                                                    <p class="text-sm font-bold text-slate-700 truncate">
                                                        {{ Auth::user()->documento ?? 'No registrado' }}
                                                    </p>
                                                </div>
                                            </div>

                                            {{-- Teléfono --}}
                                            <div class="flex items-center gap-4">
                                                <div class="h-10 w-10 shrink-0 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" stroke-width="2" />
                                                    </svg>
                                                </div>
                                                <div class="min-w-0">
                                                    <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Teléfono Móvil</p>
                                                    <p class="text-sm font-bold text-slate-700">
                                                        {{ Auth::user()->telefono ?? 'Sin registro' }}
                                                    </p>
                                                </div>
                                            </div>

                                            {{-- Email (Ancho completo de la rejilla interna) --}}
                                            <div class="flex items-center gap-4 md:col-span-2">
                                                <div class="h-10 w-10 shrink-0 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 00-2 2z" stroke-width="2" />
                                                    </svg>
                                                </div>
                                                <div class="min-w-0">
                                                    <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Correo Electrónico Oficial</p>
                                                    <p class="text-sm font-bold text-slate-700 lowercase break-all">
                                                        {{ Auth::user()->email }}
                                                    </p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- INFO CLAVE DIRECTOR Y GUION --}}
                        <div class="grid grid-cols-1 gap-6">
                            {{-- TARJETA: DIRECTOR DE LA OBRA --}}
                            <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-sm relative overflow-hidden group">
                                {{-- Decoración sutil de fondo --}}
                                <div class="absolute right-10 top-1/2 -translate-y-1/2 text-slate-50 opacity-10 group-hover:scale-110 transition-transform duration-500 pointer-events-none">
                                    <svg class="w-48 h-48" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                                    </svg>
                                </div>

                                <div class="relative z-10">
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[4px] mb-8">Información del Director</p>

                                    <div class="flex flex-col lg:flex-row items-center lg:items-start gap-8">
                                        {{-- Avatar --}}
                                        <div class="shrink-0 h-24 w-24 rounded-[2rem] bg-slate-950 flex items-center justify-center text-white font-outfit text-4xl font-800 shadow-2xl shadow-slate-200">
                                            {{ mb_substr($proyecto->director->nombre ?? 'S', 0, 1) }}
                                        </div>

                                        <div class="flex-1 min-w-0 w-full">
                                            <div class="text-center lg:text-left mb-6">
                                                <h4 class="font-outfit text-3xl font-800 text-slate-800 uppercase leading-tight">
                                                    {{ $proyecto->director->nombre ?? 'Sin asignar' }}
                                                </h4>
                                                <p class="text-[11px] text-[#ff6600] font-bold uppercase mt-2 tracking-[0.3em]">
                                                    {{ ($proyecto->director->es_proponente ?? false) ? 'Socio Proponente' : 'Director Externo' }}
                                                </p>
                                            </div>

                                            {{-- Rejilla de Datos de Contacto: 2 columnas en desktop para que no se pisen --}}
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-6 mt-6 pt-8 border-t border-slate-50">

                                                {{-- Identificación --}}
                                                <div class="flex items-center gap-4">
                                                    <div class="h-10 w-10 shrink-0 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-4 0H5m14 0h-5" stroke-width="2" />
                                                        </svg>
                                                    </div>
                                                    <div class="min-w-0">
                                                        <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Identificación</p>
                                                        <p class="text-sm font-bold text-slate-700 truncate">{{ $proyecto->director->identificacion ?? '---' }}</p>
                                                    </div>
                                                </div>

                                                {{-- Teléfono --}}
                                                <div class="flex items-center gap-4">
                                                    <div class="h-10 w-10 shrink-0 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" stroke-width="2" />
                                                        </svg>
                                                    </div>
                                                    <div class="min-w-0">
                                                        <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Teléfono Móvil</p>
                                                        <p class="text-sm font-bold text-slate-700">{{ $proyecto->director->celular ?? '---' }}</p>
                                                    </div>
                                                </div>

                                                {{-- Correo Electrónico (Ocupa las 2 columnas en pantallas medianas si es necesario) --}}
                                                <div class="flex items-center gap-4 md:col-span-2">
                                                    <div class="h-10 w-10 shrink-0 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 00-2 2z" stroke-width="2" />
                                                        </svg>
                                                    </div>
                                                    <div class="min-w-0">
                                                        <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Correo Electrónico</p>
                                                        <p class="text-sm font-bold text-slate-700 lowercase break-all">
                                                            {{ $proyecto->director->correo ?? '---' }}
                                                        </p>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- TARJETA: ORIGEN DEL LIBRETO --}}
                            <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-sm relative overflow-hidden group">
                                <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-6">
                                    <div class="flex items-center gap-6">
                                        <div class="shrink-0 h-16 w-16 rounded-2xl bg-orange-50 flex items-center justify-center text-[#ff6600] border border-orange-100 shadow-sm">
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" stroke-width="2" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[4px] mb-1">Origen del Libreto</p>
                                            <h4 class="font-outfit text-2xl font-800 text-slate-800 uppercase leading-none">
                                                {{ $proyecto->guion_propio ? 'AUTORÍA PROPIA' : 'GUION DE TERCERO' }}
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="px-6 py-2 rounded-full bg-slate-50 border border-slate-100 text-[10px] font-bold text-slate-500 uppercase tracking-widest">
                                        Documentación Original Verificada
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ARCHIVOS DEL EXPEDIENTE --}}
                <div class="bg-white rounded-[3rem] p-10 border border-slate-100 shadow-sm">
                    <h3 class="font-outfit text-3xl font-800 text-slate-900 uppercase mb-8">
                        Expediente <span class="text-[#ff6600]">Técnico</span>
                    </h3>

                    @php
                    // Agrupamos y obtenemos solo la última versión de cada documento
                    $documentosRecientes = $proyecto->documentos
                    ->groupBy('tipo_documento_id')
                    ->map(function($grupo) {
                    return $grupo->sortByDesc('version')->first();
                    });
                    @endphp

                    {{-- Grid principal que se adapta: 1 columna en móvil, 2 en escritorio --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($documentosRecientes as $doc)
                        <div class="flex items-center justify-between p-6 bg-slate-50 border border-slate-100 rounded-[2rem] group hover:border-[#ff6600]/30 transition-all">
                            <div class="flex items-center gap-4 min-w-0">
                                {{-- Icono representativo --}}
                                <div class="shrink-0 h-12 w-12 bg-white rounded-2xl flex items-center justify-center text-slate-400 group-hover:text-[#ff6600] shadow-sm transition-colors">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" stroke-width="2" />
                                    </svg>
                                </div>

                                {{-- Información del documento --}}
                                <div class="min-w-0">
                                    <p class="text-[11px] font-bold text-slate-700 uppercase truncate" title="{{ $doc->tipoDocumento->nombre }}">
                                        {{ $doc->tipoDocumento->nombre }}
                                    </p>
                                    <div class="flex items-center gap-2 mt-0.5">
                                        <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest">
                                            Versión {{ $doc->version }}.0
                                        </p>

                                        @if($doc->estado == 'aprobado')
                                        <span class="text-[8px] bg-emerald-50 text-emerald-600 px-1.5 py-0.5 rounded-md border border-emerald-100 font-bold uppercase">
                                            Subsanado
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            {{-- Botón de Acción --}}
                            <div class="shrink-0 ml-4">
                                <a href="{{ asset('storage/' . $doc->ruta_archivo) }}"
                                    target="_blank"
                                    title="Ver documento actual"
                                    class="h-10 w-10 rounded-full flex items-center justify-center bg-white text-slate-400 hover:text-[#ff6600] hover:shadow-md transition-all border border-slate-100">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" stroke-width="2" />
                                        <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" stroke-width="2" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- COLUMNA DERECHA (ESTADO) --}}
            <div class="lg:col-span-4 space-y-8">
                <div class="bg-slate-950 rounded-[3rem] p-10 text-white shadow-2xl sticky top-10 overflow-hidden">
                    <div class="absolute -right-4 -top-4 opacity-[0.05] pointer-events-none">
                        <svg width="150" height="150" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 14H4V8l8 5 8-5v10zm-8-7L4 6h16l-8 5z" />
                        </svg>
                    </div>

                    <p class="text-[11px] font-black text-slate-500 uppercase tracking-[3px] text-center mb-8">Estado Actual</p>

                    <div class="text-center mb-10 relative z-10">
                        <div class="h-24 w-24 rounded-[2rem] bg-white/5 border border-white/10 flex items-center justify-center mx-auto mb-6">
                            @if($proyecto->estado_id == 2)
                            <svg class="w-10 h-10 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" stroke-width="2.5" />
                            </svg>
                            @else
                            <svg class="w-10 h-10 text-[#ff6600] animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M13 10V3L4 14h7v7l9-11h-7z" stroke-width="2.5" />
                            </svg>
                            @endif
                        </div>
                        <div class="space-y-4">
                            {{-- Indicador Visual de Actividad --}}
                            <div class="flex items-center gap-3">
                                <span class="relative flex h-3 w-3">
                                    {{-- El color cambia a Rojo solo si es estado 2 (Subsanación) o 8 (Eliminado), sino es Naranja --}}
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full {{ in_array($proyecto->estado_id, [2, 8]) ? 'bg-red-400' : 'bg-[#ff6600]' }} opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-3 w-3 {{ in_array($proyecto->estado_id, [2, 8]) ? 'bg-red-500' : 'bg-[#ff6600]' }}"></span>
                                </span>
                                <p class="text-[10px] font-black text-slate-500 uppercase tracking-[4px]">
                                    Estatus Actual
                                </p>
                            </div>

                            {{-- Nombre del Estado Dinámico --}}
                            <h2 class="font-outfit text-4xl md:text-5xl font-900 uppercase tracking-tighter leading-[0.85] text-white">
                                @php
                                $estadoStr = $proyecto->estado->nombre;
                                // Si el estado contiene un "/" o un "-", lo dividimos para darle estilo
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
                                <span class="block text-2xl md:text-3xl {{ in_array($proyecto->estado_id, [2, 8]) ? 'text-red-500' : 'text-[#ff6600]' }} mt-1 opacity-90">
                                    {{ $separador }} {{ trim($secundario) }}
                                </span>
                                @endif
                            </h2>

                            {{-- Pequeña descripción de la BD para dar contexto al socio --}}
                            <div class="pt-2">
                                <p class="text-[11px] text-slate-400 font-medium leading-relaxed border-l-2 border-white/10 pl-4 italic">
                                    {{ $proyecto->estado->descripcion }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white/5 rounded-2xl p-6 border border-white/10 mb-8">
                        <p class="text-[9px] font-black text-slate-500 uppercase tracking-widest mb-3">Comentarios Técnicos</p>
                        <p class="text-xs text-slate-300 leading-relaxed italic">
                            "{{ $proyecto->observacion_general ?? 'Su expediente está en proceso.' }}"
                        </p>
                    </div>

                    @if($proyecto->estado_id == 2)
                    <div class="w-full space-y-3">
                        <div class="flex items-center gap-2 px-1">
                            <span class="flex h-2 w-2 rounded-full bg-orange-500 shadow-[0_0_8px_rgba(249,115,22,0.8)]"></span>
                            <p class="text-[10px] font-black text-orange-500 uppercase tracking-[0.15em]">
                                Acción Requerida
                            </p>
                        </div>

                        <div class="bg-gradient-to-b from-orange-500/[0.08] to-transparent p-4 rounded-xl border border-orange-500/20">
                            <p class="text-xs text-slate-300 mb-4 leading-relaxed">
                                Debes corregir los documentos de la <span class="text-orange-400 font-bold">Etapa 1</span>.
                                Revisa los <a href="#comentarios-tecnicos" class="text-orange-400 underline decoration-orange-500/30 hover:text-orange-300 font-semibold transition-colors">comentarios técnicos detallados abajo</a> para conocer los ajustes solicitados.
                            </p>

                            <div class="space-y-3">
                                <div class="bg-black/20 p-3 rounded-lg border border-white/5">
                                    <p class="text-[9px] text-slate-500 uppercase font-bold mb-1 tracking-wider">Enviar documentos a:</p>
                                    <p class="text-sm font-semibold text-white">incentivos@actores.org.co</p>
                                </div>

                                <div x-data="{ 
                    asunto: 'SUBSANACIÓN E1 - {{ $proyecto->codigo_radicado }} - {{ strtoupper($proyecto->titulo) }}',
                    copied: false,
                    copyToClipboard() {
                        navigator.clipboard.writeText(this.asunto);
                        this.copied = true;
                        setTimeout(() => this.copied = false, 2000);
                    }
                }" class="bg-black/20 p-3 rounded-lg border border-white/5">
                                    <p class="text-[9px] text-slate-500 uppercase font-bold mb-1 tracking-wider">Asunto del correo:</p>
                                    <div class="flex items-center justify-between gap-3">
                                        <p class="text-[12px] font-mono text-orange-300 break-words leading-tight" x-text="asunto"></p>
                                        <button @click="copyToClipboard()"
                                            type="button"
                                            class="flex-shrink-0 p-1.5 rounded-md hover:bg-white/10 transition-all active:scale-95 group relative">
                                            <svg x-show="!copied" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400 group-hover:text-orange-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6a2 2 0 002-2V7a2 2 0 00-2-2h-6a2 2 0 00-2 2z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
                                            </svg>
                                            <svg x-show="copied" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                            <span x-show="copied" class="absolute -top-8 left-1/2 -translate-x-1/2 text-[9px] bg-green-500 text-white px-2 py-1 rounded shadow-lg">¡Copiado!</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="mt-10 pt-8 border-t border-white/10 space-y-4">
                        <div class="flex items-center justify-between text-[10px] font-black uppercase tracking-widest">
                            <span class="text-slate-500">Progreso</span>
                            <span class="text-white">Etapa 1 de 2</span>
                        </div>
                        <div class="h-1.5 w-full bg-white/10 rounded-full overflow-hidden">
                            <div class="h-full bg-[#ff6600] w-1/2 rounded-full shadow-[0_0_10px_#ff6600]"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>