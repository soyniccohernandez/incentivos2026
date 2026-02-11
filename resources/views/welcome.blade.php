<!DOCTYPE html>
<html lang="es" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incentivos 2026 | ACTORES S.C.G.</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat:wght@300;400;600;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .hero-bg {
            background-image: url('{{ asset("resources/imagenes/hero.jpg") }}');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>

<body class="bg-black text-white font-montserrat antialiased leading-relaxed">

    {{-- Modal de Éxito --}}
    @if (session()->has('success'))
    <div id="success-modal" x-data="{ show: true }"
        x-show="show"
        class="fixed inset-0 z-[3000] flex items-center justify-center p-4"
        style="display: flex;"> {{-- Forzamos visibilidad inicial --}}

        {{-- Overlay / Fondo --}}
        <div class="fixed inset-0 bg-black/95 backdrop-blur-sm" @click="show = false; document.getElementById('success-modal').style.display='none'"></div>

        {{-- Contenedor del Modal --}}
        <div class="relative bg-[{{ '#111' }}] border-2 border-[#ff6600] max-w-2xl w-full shadow-[0_0_50px_rgba(255,102,0,0.3)] z-[3001]"
            x-show="show">

            <div class="p-8 md:p-12 text-center relative">
                <div class="mx-auto w-20 h-20 bg-[#ff6600] flex items-center justify-center rounded-full mb-8">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>

                <h2 class="font-bebas text-5xl md:text-6xl text-white tracking-wider mb-6">
                    ¡INSCRIPCIÓN <span class="text-[#ff6600]">EXITOSA!</span>
                </h2>

                <p class="text-gray-300 text-lg mb-10 italic">
                    {{ session('success') }}
                </p>

                <div class="flex flex-col items-center gap-4">
                    {{-- BOTÓN PRINCIPAL CON CIERRE DOBLE (Alpine + JS Puro) --}}
                    <button onclick="document.getElementById('success-modal').style.display='none'"
                        @click="show = false"
                        class="bg-[#ff6600] text-white font-bebas text-2xl px-12 py-4 hover:bg-white hover:text-black transition-all duration-300 tracking-widest">
                        ENTENDIDO Y FINALIZAR
                    </button>

                    <button onclick="document.getElementById('success-modal').style.display='none'"
                        @click="show = false"
                        class="text-gray-500 hover:text-white text-[10px] uppercase font-bold tracking-[3px] cursor-pointer">
                        [ CERRAR VENTANA ]
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- Navegación --}}
    <nav class="fixed top-0 left-0 w-full z-[1000] flex justify-between items-center px-6 py-5 md:px-12 bg-black/95 border-b border-brand-border">
        <a href="#" class="font-bebas text-3xl text-brand-orange tracking-[2px] no-underline">ACTORES S.C.G.</a>

        <div class="flex flex-col gap-[6px] cursor-pointer md:hidden z-[1100]" id="mobile-menu">
            <span class="w-[30px] h-[3px] bg-white transition-all duration-300"></span>
            <span class="w-[30px] h-[3px] bg-white transition-all duration-300"></span>
            <span class="w-[30px] h-[3px] bg-white transition-all duration-300"></span>
        </div>

        <ul class="nav-links fixed md:static top-0 -right-full md:right-0 w-full md:w-auto h-screen md:h-auto bg-brand-orange md:bg-transparent flex flex-col md:flex-row justify-center md:justify-end items-center gap-8 md:gap-[30px] transition-all duration-500 z-[1000] list-none">
            <li><a href="#" class="no-underline text-white font-bebas text-[2.5rem] md:text-xl tracking-[1.5px] opacity-100 md:opacity-80 hover:md:text-brand-orange hover:opacity-100 transition-all">INICIO</a></li>
            <li><a href="#convocatoria" class="no-underline text-white font-bebas text-[2.5rem] md:text-xl tracking-[1.5px] opacity-100 md:opacity-80 hover:md:text-brand-orange hover:opacity-100 transition-all">REQUISITOS</a></li>
            <li><a href="#cronograma" class="no-underline text-white font-bebas text-[2.5rem] md:text-xl tracking-[1.5px] opacity-100 md:opacity-80 hover:md:text-brand-orange hover:opacity-100 transition-all">CRONOGRAMA</a></li>
            <li><a href="#pasos" class="no-underline text-white font-bebas text-[2.5rem] md:text-xl tracking-[1.5px] opacity-100 md:opacity-80 hover:md:text-brand-orange hover:opacity-100 transition-all">INSCRIPCIÓN</a></li>
            <li><a href="./inscritos.html" class="no-underline text-white font-bebas text-[2.5rem] md:text-xl tracking-[1.5px] opacity-100 md:opacity-80 hover:md:text-brand-orange hover:opacity-100 transition-all">VER INSCRITOS</a></li>
            <li class="md:ml-[15px]">
                <a href="./estado-inscripcion.html" class="bg-brand-orange text-white !px-5 !py-2.5 rounded-[5px] font-bold no-underline transition-all duration-300 border border-transparent text-sm hover:bg-transparent hover:border-brand-orange hover:text-brand-orange hover:shadow-[0_0_10px_rgba(232,82,27,0.4)]">
                    CONSULTAR ESTADO DE INSCRIPCIÓN
                </a>
            </li>
        </ul>
    </nav>

    {{-- Hero Section --}}
    <div class="hero-bg relative h-[85vh] w-full flex items-center justify-center text-center overflow-hidden bg-black">
        <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/60 to-black z-[2]"></div>
        <div class="relative z-[3] max-w-[1000px] px-6 drop-shadow-[0_4px_15px_rgba(0,0,0,0.5)]">
            <div class="flex flex-col items-center gap-[15px] mb-[30px] opacity-90">
                <img src="{{ asset('resources/imagenes/logo.png') }}" alt="Logo" class="h-[80px] w-auto invert brightness-0 mb-5">
                <span class="text-[0.75rem] font-normal tracking-[5px] text-white uppercase relative pb-2.5 after:content-[''] after:absolute after:bottom-0 after:left-1/4 after:w-1/2 after:h-[1px] after:bg-gradient-to-r after:from-transparent after:via-brand-orange after:to-transparent">
                    SOCIEDAD COLOMBIANA DE GESTIÓN
                </span>
            </div>
            <p class="tracking-[5px] font-semibold text-[#BBBBBB] mb-5 uppercase">CONVOCATORIA 2026</p>
            <h1 class="font-bebas text-[clamp(3rem,10vw,6.5rem)] leading-[0.9] mb-5">
                INCENTIVOS PARA <br> <span class="text-brand-orange">CREACIÓN AUDIOVISUAL</span>
            </h1>
            <p class="text-[1.2rem] max-w-[700px] mx-auto mb-[30px] text-[#EEEEEE]">
                Transformamos tu guion en una realidad profesional. <br>
                <strong class="text-white">$40.000.000 COP</strong> para tu cortometraje.
            </p>
            {{-- EL BOTÓN SIGUIENTE AHORA APUNTA CORRECTAMENTE A #PASOS --}}
            <a href="#pasos" class="inline-block bg-brand-orange text-white px-[45px] py-[18px] no-underline font-bebas text-[1.6rem] transition-all duration-300 hover:bg-[#ff6a33] hover:-translate-y-[3px] hover:shadow-[0_10px_20px_rgba(232,82,27,0.3)]">
                POSTULAR MI PROYECTO
            </a>
        </div>
    </div>

    {{-- Términos --}}
    <div class="bg-brand-surface py-20 px-6 text-center border-b border-brand-border">
        <h2 class="font-bebas text-[3.5rem] text-brand-orange mb-[10px] border-none">TÉRMINOS Y CONDICIONES</h2>
        <p class="mb-[30px] text-[#BBBBBB]">Es indispensable leer el documento completo antes de iniciar tu postulación.</p>
        <a href="#" class="inline-block bg-transparent text-white px-10 py-[15px] no-underline font-bebas text-[1.4rem] border-2 border-brand-orange transition-all duration-300 hover:bg-brand-orange">
            DESCARGAR PDF COMPLETO
        </a>
    </div>

    {{-- Contenido Principal --}}
    <div class="max-w-[1100px] mx-auto px-6 py-24">
        {{-- Convocatoria --}}
        <section id="convocatoria" class="mb-[120px] scroll-mt-[100px]">
            <h2 class="font-bebas text-[3.5rem] text-brand-orange mb-10 border-b border-brand-border inline-block pb-[5px]">LA CONVOCATORIA</h2>
            <p class="text-[1.2rem] text-[#BBBBBB] mb-10 max-w-[850px]">
                A partir del <strong class="text-white">1 de abril</strong> regresa una de las iniciativas más exitosas del área de Bienestar Social. Buscamos historias que respeten valores como la equidad, la diversidad y el respeto.
            </p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-[25px]">
                <div class="bg-brand-surface p-10 border-l-4 border-brand-orange transition-all duration-300 hover:bg-[#151515]">
                    <h3 class="font-bebas text-[2rem] mb-[15px]">EL PREMIO</h3>
                    <p>¡3 seleccionados! Cada uno recibirá <strong>$40.000.000 COP</strong> para la ejecución total de su obra.</p>
                </div>
                <div class="bg-brand-surface p-10 border-l-4 border-brand-orange transition-all duration-300 hover:bg-[#151515]">
                    <h3 class="font-bebas text-[2rem] mb-[15px]">MODALIDAD</h3>
                    <p><strong>Cortometraje</strong> de ficción (Relatos imaginarios o basados en la vida real) de 7 a 15 min.</p>
                </div>
                <div class="bg-brand-surface p-10 border-l-4 border-brand-orange transition-all duration-300 hover:bg-[#151515]">
                    <h3 class="font-bebas text-[2rem] mb-[15px]">REQUISITOS</h3>
                    <p>Ser <strong>socio activo</strong>, mayor de edad y contar con datos actualizados en la sociedad.</p>
                </div>
            </div>
        </section>

        {{-- Cronograma --}}
        <section id="cronograma" class="mb-[120px] scroll-mt-[100px]">
            <h2 class="font-bebas text-[3.5rem] text-brand-orange mb-10 border-b border-brand-border inline-block pb-[5px]">CRONOGRAMA 2026</h2>
            <div class="overflow-x-auto bg-brand-surface p-5 border border-brand-border">
                <table class="w-full border-collapse min-w-[600px]">
                    <thead>
                        <tr class="bg-[#1a1a1a] text-left text-brand-orange font-bebas text-[1.3rem]">
                            <th class="p-[15px]">ETAPA</th>
                            <th class="p-[15px]">FECHAS</th>
                            <th class="p-[15px]">DETALLE</th>
                        </tr>
                    </thead>
                    <tbody class="text-[0.95rem]">
                        <tr>
                            <td class="p-[15px] border-b border-brand-border"><strong>Inscripciones</strong></td>
                            <td class="p-[15px] border-b border-brand-border">1 - 13 de abril</td>
                            <td class="p-[15px] border-b border-brand-border">Diligenciamiento de anexos</td>
                        </tr>
                        <tr>
                            <td class="p-[15px] border-b border-brand-border"><strong>Subsanaciones</strong></td>
                            <td class="p-[15px] border-b border-brand-border">28 abril - 5 mayo</td>
                            <td class="p-[15px] border-b border-brand-border">Plazo único correcciones</td>
                        </tr>
                        <tr>
                            <td class="p-[15px] border-b border-brand-border"><strong>Etapa 2</strong></td>
                            <td class="p-[15px] border-b border-brand-border">16 de mayo</td>
                            <td class="p-[15px] border-b border-brand-border">Recepción de Guiones (7am - 7pm)</td>
                        </tr>
                        <tr>
                            <td class="p-[15px] border-b border-brand-border"><strong>Jurados</strong></td>
                            <td class="p-[15px] border-b border-brand-border">30 mayo - 8 junio</td>
                            <td class="p-[15px] border-b border-brand-border">Evaluación por comité externo</td>
                        </tr>
                        <tr class="bg-brand-orange/10">
                            <td class="p-[15px] border-b border-brand-border"><strong class="text-brand-orange">GANADORES</strong></td>
                            <td class="p-[15px] border-b border-brand-border"><strong class="text-brand-orange">13 de junio</strong></td>
                            <td class="p-[15px] border-b border-brand-border">Publicación de seleccionados</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

        {{-- Pasos e Inscripción Final --}}
        <section id="pasos" class="mb-[120px] scroll-mt-[100px]">
            <div class="relative block mb-5">
                <h2 class="font-bebas text-[3.5rem] text-brand-orange mb-10 border-b border-brand-border inline-block pb-[5px]">¿CÓMO PARTICIPAR?</h2>
            </div>

            <ul class="list-none [counter-reset:step] mb-[50px]">
                <li class="[counter-increment:step] mb-[25px] pl-[60px] relative text-[1.1rem] before:content-[counter(step)] before:absolute before:left-0 before:top-0 before:w-10 before:h-10 before:bg-brand-orange before:text-white before:rounded-full before:flex before:items-center before:justify-center before:font-bebas before:text-[1.5rem]">
                    Adjunta en formato <strong>PDF</strong> todos los anexos de la etapa 1 debidamente firmados.
                </li>
                <li class="[counter-increment:step] mb-[25px] pl-[60px] relative text-[1.1rem] before:content-[counter(step)] before:absolute before:left-0 before:top-0 before:w-10 before:h-10 before:bg-brand-orange before:text-white before:rounded-full before:flex before:items-center before:justify-center before:font-bebas before:text-[1.5rem]">
                    Envía los documentos desde tu <strong>correo registrado</strong> en nuestra base de datos.
                </li>
                <li class="[counter-increment:step] mb-[25px] pl-[60px] relative text-[1.1rem] before:content-[counter(step)] before:absolute before:left-0 before:top-0 before:w-10 before:h-10 before:bg-brand-orange before:text-white before:rounded-full before:flex before:items-center before:justify-center before:font-bebas before:text-[1.5rem]">
                    Asunto: <strong>Nombre Proponente + Título de la Obra</strong>.
                </li>
                <li class="[counter-increment:step] mb-[25px] pl-[60px] relative text-[1.1rem] before:content-[counter(step)] before:absolute before:left-0 before:top-0 before:w-10 before:h-10 before:bg-brand-orange before:text-white before:rounded-full before:flex before:items-center before:justify-center before:font-bebas before:text-[1.5rem]">
                    Envía a: <strong class="text-brand-orange">incentivos@actores.org.co</strong>
                </li>
            </ul>

            <div class="bg-[#111] p-[50px] text-center border border-brand-orange mt-10">
                <h3 class="font-bebas text-[2rem] mb-5 uppercase">¿LISTO PARA ENVIAR TU PROPUESTA?</h3>
                <p class="text-[#BBBBBB] mb-[30px]">Asegúrate de tener todos los anexos listos antes de proceder al correo de inscripción.</p>
                <a href="/validar-socio" class="inline-block bg-brand-orange text-white px-[45px] py-[18px] no-underline font-bebas text-[1.6rem] transition-all duration-300 hover:bg-[#ff6a33] hover:-translate-y-[3px]">
                    INICIAR INSCRIPCIÓN AHORA
                </a>
            </div>
        </section>
    </div>

    {{-- Footer y Scripts se mantienen igual --}}
    <footer class="bg-[#050505] text-[#888] py-20 border-t border-[#1a1a1a] text-[0.9rem]">
        <div class="max-w-[1100px] mx-auto grid grid-cols-1 md:grid-cols-[2fr_1fr_1fr] gap-[50px] px-6">
            <div>
                <h3 class="font-bebas text-[1.8rem] text-white mb-[5px] tracking-[2px]">ACTORES S.C.G.</h3>
                <p class="text-brand-orange font-semibold mb-[15px] text-[0.75rem] uppercase tracking-[1px]">Sociedad Colombiana de Gestión de Actores</p>
                <p class="leading-[1.8] max-w-[350px]">
                    Protegiendo y gestionando los derechos patrimoniales de los actores y actrices de Colombia desde 1987.
                </p>
            </div>
            <div>
                <h4 class="text-white font-bebas text-[1.2rem] mb-[25px] tracking-[1px]">INSTITUCIONAL</h4>
                <ul class="list-none">
                    <li class="mb-3"><a href="#" class="text-[#888] no-underline transition-all duration-300 hover:text-brand-orange hover:pl-[5px]">Transparencia</a></li>
                    <li class="mb-3"><a href="#" class="text-[#888] no-underline transition-all duration-300 hover:text-brand-orange hover:pl-[5px]">Estatutos</a></li>
                    <li class="mb-3"><a href="#" class="text-[#888] no-underline transition-all duration-300 hover:text-brand-orange hover:pl-[5px]">Tratamiento de Datos</a></li>
                    <li class="mb-3"><a href="#" class="text-[#888] no-underline transition-all duration-300 hover:text-brand-orange hover:pl-[5px]">Contacto</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-bebas text-[1.2rem] mb-[25px] tracking-[1px]">CONTACTO</h4>
                <p class="mb-1">Bogotá, Colombia</p>
                <p class="mb-1">Calle 93A No. 13 - 24, Of. 402</p>
                <p class="mb-1">PBX: +57 (601) 743 0045</p>
                <p>Email: contacto@actores.org.co</p>
            </div>
        </div>
    </footer>

    {{-- Botones Flotantes --}}
    <div class="fixed bottom-6 right-6 flex flex-col gap-4 z-[2000]">
        <a href="#" class="flex items-center justify-center bg-brand-orange text-white w-14 h-14 rounded-full shadow-[0_4px_15px_rgba(0,0,0,0.3)] transition-all duration-300 hover:bg-[#ff6a33] hover:-translate-y-1 hover:shadow-[0_10px_20px_rgba(232,82,27,0.3)] group relative">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <span class="absolute right-16 bg-white text-black px-2 py-1 rounded text-xs font-bold opacity-0 group-hover:opacity-100 transition-opacity shadow-lg pointer-events-none uppercase tracking-wider whitespace-nowrap">
                Términos y condiciones
            </span>
        </a>

        <a href="https://wa.me/573229356936" target="_blank"
            class="flex items-center justify-center bg-[#25D366] text-white w-14 h-14 rounded-full shadow-[0_4px_15px_rgba(0,0,0,0.3)] transition-all duration-300 hover:scale-110 hover:shadow-[0_0_20px_rgba(37,211,102,0.4)] group relative">
            <svg class="w-8 h-8 fill-current" viewBox="0 0 24 24">
                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.588-5.946 0-6.556 5.332-11.888 11.888-11.888 3.176 0 6.161 1.237 8.404 3.48s3.481 5.229 3.481 8.404c0 6.556-5.332 11.888-11.888 11.888-2.01 0-3.988-.508-5.73-1.472l-6.254 1.641zm6.309-4.321c1.547.92 3.123 1.399 4.759 1.399 5.075 0 9.212-4.136 9.212-9.212 0-2.457-.957-4.767-2.693-6.503s-4.047-2.693-6.504-2.693c-5.075 0-9.212 4.136-9.212 9.212 0 1.77.51 3.5 1.476 4.997l-.999 3.648 3.765-.988zm11.458-6.191c-.078-.13-.288-.208-.603-.365-.315-.157-1.859-.918-2.148-1.023-.289-.105-.499-.157-.709.157-.21.315-.814 1.023-.997 1.233-.183.21-.367.236-.682.079-.315-.157-1.332-.49-2.537-1.565-.937-.836-1.57-1.868-1.754-2.183-.184-.315-.02-.486.137-.643.141-.141.315-.367.472-.551.157-.184.21-.315.315-.525.105-.21.052-.394-.026-.551-.079-.157-.709-1.706-.971-2.336-.255-.615-.514-.532-.709-.542-.183-.008-.393-.01-.603-.01s-.551.079-.84.394c-.289.315-1.102 1.076-1.102 2.625 0 1.549 1.129 3.045 1.286 3.255.157.21 2.221 3.391 5.38 4.754.752.324 1.339.518 1.797.663.754.24 1.441.206 1.983.125.603-.09 1.859-.761 2.121-1.469.262-.708.262-1.312.184-1.441z" />
            </svg>
            <span class="absolute right-16 bg-white text-black px-2 py-1 rounded text-xs font-bold opacity-0 group-hover:opacity-100 transition-opacity shadow-lg pointer-events-none uppercase tracking-wider">
                Escríbenos
            </span>
        </a>
    </div>

    <script>
        const menu = document.querySelector('#mobile-menu');
        const menuLinks = document.querySelector('.nav-links');
        const bars = menu.querySelectorAll('span');

        menu.addEventListener('click', () => {
            menuLinks.classList.toggle('-right-full');
            menuLinks.classList.toggle('right-0');
            bars[0].classList.toggle('translate-y-[9px]');
            bars[0].classList.toggle('rotate-45');
            bars[1].classList.toggle('opacity-0');
            bars[2].classList.toggle('-translate-y-[9px]');
            bars[2].classList.toggle('-rotate-45');
        });

        document.querySelectorAll('.nav-links a').forEach(link => {
            link.addEventListener('click', () => {
                menuLinks.classList.add('-right-full');
                menuLinks.classList.remove('right-0');
                bars[0].classList.remove('translate-y-[9px]', 'rotate-45');
                bars[1].classList.remove('opacity-0');
                bars[2].classList.remove('-translate-y-[9px]', '-rotate-45');
            });
        });

        // ESTO ES EL SEGURO DE VIDA: Si Alpine falla, JS puro cerrará el modal
        document.addEventListener('keydown', function(event) {
            if (event.key === "Escape") {
                const modal = document.getElementById('success-modal');
                if (modal) modal.style.display = 'none';
            }
        });
    </script>
</body>

</html>