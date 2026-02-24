<div class="min-h-screen bg-black flex flex-col items-center justify-center p-6 relative overflow-hidden">
    <div class="absolute top-0 left-0 w-full h-1 bg-brand-orange"></div>
    <div class="absolute -top-24 -right-24 w-96 h-96 bg-brand-orange/5 blur-[100px] rounded-full"></div>

    <div class="max-w-[600px] w-full z-10">
        <header class="mb-10 text-center">
            <h1 class="font-bebas text-5xl text-white tracking-wider mb-2">¡PROPUESTA <span class="text-brand-orange">RECIBIDA!</span></h1>
            <p class="text-gray-400 font-inter uppercase tracking-[3px] text-xs">Convocatoria Incentivos 2026</p>
        </header>

        <section class="bg-brand-surface border border-brand-border p-8 md:p-12 shadow-2xl relative">
            <div class="space-y-8 text-center">

                <div class="flex justify-center">
                    <div class="w-20 h-20 border-2 border-brand-orange rounded-full flex items-center justify-center animate-pulse">
                        <svg class="w-10 h-10 text-brand-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>

                <div class="space-y-4">
                    <h2 class="text-white font-bebas text-3xl italic tracking-tight">
                        ESTADO: <span class="text-brand-orange">{{ $proyecto->estado->nombre }}</span>
                    </h2>

                    <div class="bg-black/50 border border-brand-border p-4">
                        <p class="text-gray-500 text-[10px] uppercase font-bold tracking-widest mb-1">Código de Radicado</p>
                        <p class="text-white font-mono text-2xl tracking-widest">{{ $proyecto->codigo_radicado }}</p>
                    </div>

                    <p class="text-gray-400 text-sm leading-relaxed">
                        Hola, <strong class="text-white">{{ Auth::user()->name }}</strong>. Tu documentación para el proyecto
                        <span class="text-brand-orange">"{{ $proyecto->titulo }}"</span> ha sido cargada exitosamente.
                        Nuestros auditores están verificando los archivos.
                    </p>
                </div>

                <div class="pt-6 border-t border-brand-border">
                    <p class="text-gray-500 text-[10px] uppercase font-bold mb-4">Te notificaremos por correo cualquier novedad</p>
                    <button wire:click="logout" wire:loading.attr="disabled" class="text-brand-orange font-bebas text-xl hover:text-white transition-colors flex items-center gap-2 mx-auto">
                        <span wire:loading.remove>← CERRAR SESIÓN SEGURA</span>
                        <span wire:loading>CERRANDO SESIÓN...</span>
                    </button>
                </div>
            </div>
        </section>
    </div>
</div>