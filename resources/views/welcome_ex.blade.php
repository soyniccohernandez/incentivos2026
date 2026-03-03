<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRÓXIMAMENTE | Incentivos 2026 | ACTORES S.C.G.</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat:wght@300;400;600;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .hero-bg-expectativa {
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.9)), url('{{ asset("resources/imagenes/hero.jpg") }}');
            background-size: cover;
            background-position: center;
            filter: grayscale(0.5);
        }
        .countdown-item {
            background: rgba(255, 102, 0, 0.1);
            border: 1px solid rgba(255, 102, 0, 0.3);
            backdrop-filter: blur(10px);
        }
        .locked-overlay {
            position: relative;
            overflow: hidden;
        }
        .locked-overlay::before {
            content: 'PRÓXIMAMENTE';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-15deg);
            font-family: 'Bebas Neue';
            font-size: 5rem;
            color: rgba(255, 102, 0, 0.2);
            z-index: 5;
            pointer-events: none;
            white-space: nowrap;
        }
        @keyframes pulse-orange {
            0% { box-shadow: 0 0 0 0 rgba(255, 102, 0, 0.4); }
            70% { box-shadow: 0 0 0 20px rgba(255, 102, 0, 0); }
            100% { box-shadow: 0 0 0 0 rgba(255, 102, 0, 0); }
        }
        .pulse-btn {
            animation: pulse-orange 2s infinite;
        }
    </style>
</head>
<body class="bg-black text-white font-montserrat antialiased overflow-x-hidden">

    {{-- Navegación Simplificada --}}
    <nav class="fixed top-0 left-0 w-full z-[1000] flex justify-between items-center px-4 py-5 md:px-12 bg-black/95 border-b border-white/10 backdrop-blur-sm">
        <div class="flex items-center gap-3 md:gap-4 group no-underline shrink-0">
            <img src="{{ asset('resources/imagenes/logo.png') }}" alt="Logo" class="h-[40px] md:h-[55px] w-auto">
            <div class="h-8 w-[1px] bg-orange-500/40 hidden sm:block"></div>
            <div class="flex flex-col justify-center">
                <span class="font-bebas text-xl md:text-3xl text-orange-500 tracking-[1px] leading-none uppercase">Convocatoria 2026</span>
                <span class="text-[7px] md:text-[8px] font-bold text-gray-500 tracking-[2px] uppercase hidden sm:block">Campaña de Expectativa</span>
            </div>
        </div>
        <div class="hidden md:block">
            <span class="font-bebas text-white/50 tracking-[2px]">ACTORES S.C.G. - SOCIEDAD DE GESTIÓN</span>
        </div>
    </nav>

    {{-- Hero de Expectativa --}}
    <section class="relative min-h-screen flex items-center justify-center hero-bg-expectativa pt-20">
        <div class="absolute inset-0 bg-black/60 z-0"></div>
        
        <div class="relative z-10 max-w-5xl mx-auto px-6 text-center">
            {{-- Badge --}}
            <div class="inline-block border border-orange-500 px-6 py-2 mb-8 skew-x-[-10deg]">
                <span class="text-orange-500 font-bold tracking-[5px] text-sm uppercase">Gran Lanzamiento</span>
            </div>

            <h1 class="font-bebas text-[4.5rem] md:text-[8rem] leading-[0.85] mb-6 text-white tracking-tighter">
                PREPÁRATE PARA <br>
                <span class="text-orange-500 drop-shadow-[0_0_20px_rgba(255,102,0,0.5)]">CREAR Y PRODUCIR</span>
            </h1>

            <p class="text-xl md:text-2xl text-gray-300 max-w-3xl mx-auto font-light mb-12 uppercase tracking-widest leading-relaxed">
                Estamos a pocos días de abrir la convocatoria más importante <br> para los actores de Colombia.
            </p>

            {{-- CONTADOR DINÁMICO --}}
            <div id="countdown" class="grid grid-cols-2 md:grid-cols-4 gap-4 max-w-3xl mx-auto mb-16">
                <div class="countdown-item p-6 rounded-sm">
                    <span id="days" class="block font-bebas text-5xl md:text-7xl text-white">00</span>
                    <span class="text-[10px] text-orange-500 font-black tracking-[3px] uppercase">Días</span>
                </div>
                <div class="countdown-item p-6 rounded-sm">
                    <span id="hours" class="block font-bebas text-5xl md:text-7xl text-white">00</span>
                    <span class="text-[10px] text-orange-500 font-black tracking-[3px] uppercase">Horas</span>
                </div>
                <div class="countdown-item p-6 rounded-sm">
                    <span id="minutes" class="block font-bebas text-5xl md:text-7xl text-white">00</span>
                    <span class="text-[10px] text-orange-500 font-black tracking-[3px] uppercase">Minutos</span>
                </div>
                <div class="countdown-item p-6 rounded-sm">
                    <span id="seconds" class="block font-bebas text-5xl md:text-7xl text-white">00</span>
                    <span class="text-[10px] text-orange-500 font-black tracking-[3px] uppercase">Segundos</span>
                </div>
            </div>

            <div class="flex flex-col items-center gap-6">
                <p class="font-mono text-orange-500 text-sm tracking-[4px] uppercase animate-pulse">
                    Apertura de inscripciones: 09 de Marzo
                </p>
                <div class="h-[1px] w-32 bg-orange-500/50"></div>
            </div>
        </div>
    </section>

    {{-- Sección de Información Bloqueada --}}
    <section class="bg-[#0a0a0a] py-24 border-t border-white/5 relative">
        <div class="max-w-[1100px] mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
                <div>
                    <h2 class="font-bebas text-5xl text-white mb-6 uppercase">¿Qué puedes esperar?</h2>
                    <div class="space-y-8 opacity-50">
                        <div class="flex gap-6 border-l border-orange-500/30 pl-6">
                            <span class="font-bebas text-3xl text-orange-500">01</span>
                            <p class="text-gray-400">Acceso a incentivos por <strong class="text-white">$45.000.000 COP</strong> por proyecto seleccionado.</p>
                        </div>
                        <div class="flex gap-6 border-l border-orange-500/30 pl-6">
                            <span class="font-bebas text-3xl text-orange-500">02</span>
                            <p class="text-gray-400">Proceso de postulación 100% digital a través de nuestra plataforma segura.</p>
                        </div>
                        <div class="flex gap-6 border-l border-orange-500/30 pl-6">
                            <span class="font-bebas text-3xl text-orange-500">03</span>
                            <p class="text-gray-400">Jurados expertos de la industria audiovisual nacional e internacional.</p>
                        </div>
                    </div>
                </div>

                {{-- Mockup de Documento Bloqueado --}}
                <div class="relative">
                    <div class="bg-brand-surface p-10 border border-white/10 filter blur-[4px] select-none pointer-events-none">
                        <div class="w-20 h-2 bg-orange-500 mb-4"></div>
                        <div class="w-full h-4 bg-white/10 mb-2"></div>
                        <div class="w-full h-4 bg-white/10 mb-2"></div>
                        <div class="w-3/4 h-4 bg-white/10 mb-6"></div>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="h-20 bg-white/5"></div>
                            <div class="h-20 bg-white/5"></div>
                        </div>
                    </div>
                    <div class="absolute inset-0 flex flex-col items-center justify-center z-10">
                        <div class="bg-black/80 p-8 border border-orange-500 text-center backdrop-blur-md pulse-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-orange-500 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            <span class="font-bebas text-2xl tracking-[2px]">TÉRMINOS BLOQUEADOS</span>
                            <p class="text-[10px] uppercase font-bold text-gray-400 mt-2">Disponibles el 09/03/2026</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="bg-black py-16 border-t border-white/5 text-center">
        <img src="{{ asset('resources/imagenes/logo.png') }}" alt="Logo" class="h-12 mx-auto mb-8 opacity-50 grayscale">
        <p class="text-gray-600 text-xs uppercase tracking-[5px]">ACTORES S.C.G. &copy; 2026 - Todos los derechos reservados</p>
    </footer>

    <script>
        // Configura aquí la fecha de apertura
        const launchDate = new Date("March 9, 2026 00:00:00").getTime();

        const timer = setInterval(function() {
            const now = new Date().getTime();
            const distance = launchDate - now;

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById("days").innerText = days < 10 ? "0"+days : days;
            document.getElementById("hours").innerText = hours < 10 ? "0"+hours : hours;
            document.getElementById("minutes").innerText = minutes < 10 ? "0"+minutes : minutes;
            document.getElementById("seconds").innerText = seconds < 10 ? "0"+seconds : seconds;

            if (distance < 0) {
                clearInterval(timer);
                window.location.reload(); // Recargar para mostrar la web real cuando llegue el momento
            }
        }, 1000);
    </script>
</body>
</html>