<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

new class extends Component
{
    public $foto_url = null;
    public $iniciales = '';

    public function mount()
    {
        $user = Auth::user();

        // 1. Iniciales
        $nameParts = explode(' ', trim($user->name));
        $this->iniciales = strtoupper(
            substr($nameParts[0] ?? 'U', 0, 1) .
                (isset($nameParts[1]) ? substr($nameParts[1], 0, 1) : '')
        );

        // 2. Búsqueda de Foto
        $identificacion = (string)$user->identificacion; // Forzamos a string

        if ($identificacion) {
            // Obtenemos todos los archivos de la carpeta
            $files = Storage::disk('public')->files('socios');

            // Buscamos coincidencia exacta del nombre (sin importar la extensión)
            $fotoEncontrada = collect($files)->first(function ($path) use ($identificacion) {
                $filename = pathinfo($path, PATHINFO_FILENAME); // Solo el nombre, sin .jpg, .png, etc.
                return $filename === $identificacion;
            });

            if ($fotoEncontrada) {
                $this->foto_url = asset('storage/' . $fotoEncontrada);
            }
        }
    }

    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();
        $this->redirect('/', navigate: true);
    }
}; ?>

<nav x-data="{ open: false }" class="bg-black border-b border-white/[0.08] sticky top-0 z-[1000] antialiased nav-principal-negro">
    {{-- Estilos Forzados --}}
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Outfit:wght@700;800&family=Bebas+Neue&display=swap');

        .nav-principal-negro {
            background-color: #000000 !important;
        }

        .font-bebas {
            font-family: 'Bebas Neue', cursive !important;
        }

        .font-outfit {
            font-family: 'Outfit', sans-serif !important;
        }

        .font-inter {
            font-family: 'Inter', sans-serif !important;
        }
    </style>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-10">
        <div class="flex justify-between h-24">
            {{-- Izquierda: Identidad --}}
            <div class="flex items-center">
                <div class="shrink-0 flex items-center">
                    <a href="/" class="flex items-center gap-5 no-underline group">
                        <img src="{{ asset('resources/imagenes/logo.png') }}" alt="Logo" class="h-12 w-auto brightness-125 transition-transform group-hover:scale-110">
                        <div class="flex flex-col border-l border-white/20 pl-5">
                            <span class="font-bebas text-3xl text-white leading-none">
                                @if(Auth::user()->tipo_socio === 'Administrador')
                                SISTEMA <span class="text-[#ff6600]">ADMIN</span>
                                @else
                                PORTAL <span class="text-[#ff6600]">SOCIOS</span>
                                @endif
                            </span>
                            <span class="text-[9px] font-black text-slate-500 uppercase tracking-[4px] mt-1">
                                Convocatoria 2026
                            </span>
                        </div>
                    </a>
                </div>

                <div class="hidden sm:flex sm:ms-16 space-x-10">
                    <a href="{{ route('dashboard') }}" wire:navigate
                        class="font-inter text-[11px] font-black tracking-[4px] no-underline {{ request()->routeIs('dashboard') ? 'text-[#ff6600]' : 'text-slate-500 hover:text-white' }}">
                        {{ Auth::user()->tipo_socio === 'Administrador' ? 'GESTIÓN GLOBAL' : 'MI PROYECTO' }}
                    </a>
                </div>
            </div>

            {{-- Derecha: Usuario y Dropdown --}}
            <div class="hidden sm:flex sm:items-center">
                <div x-data="{ dropdownOpen: false }" class="relative">
                    <button @click="dropdownOpen = !dropdownOpen"
                        class="flex items-center gap-4 pl-2 pr-4 py-2 rounded-2xl border border-white/10 bg-[#0a0a0a] hover:bg-[#111111] transition-all group">

                        {{-- Avatar --}}
                        <div class="h-14 w-14 rounded-2xl bg-white border border-white/5 shadow-sm flex items-center justify-center overflow-hidden shrink-0">
                            @if($foto_url)
                            <img src="{{ $foto_url }}" class="w-full h-full object-cover" alt="Foto Titular">
                            @else
                            <div class="w-full h-full bg-slate-900 flex items-center justify-center">
                                <span class="font-outfit text-xl font-extrabold text-[#ff6600] uppercase">
                                    {{ $iniciales }}
                                </span>
                            </div>
                            @endif
                        </div>

                        <div class="flex flex-col items-start text-left">
                            <span class="font-outfit text-sm font-bold text-white leading-none truncate max-w-[140px]">
                                {{ auth()->user()->name }}
                            </span>
                            <span class="text-[9px] font-black text-[#ff6600] uppercase tracking-[2px] mt-1.5">
                                {{ Auth::user()->tipo_socio === 'Administrador' ? 'Administrador' : 'Socio Proponente' }}
                            </span>
                        </div>
                        <svg class="w-4 h-4 text-slate-500 group-hover:text-white transition-transform" :class="dropdownOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    {{-- Dropdown Menú --}}
                    <div x-show="dropdownOpen"
                        @click.away="dropdownOpen = false"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="opacity-100 scale-100"
                        style="background-color: #050505 !important;"
                        class="absolute right-0 mt-4 w-64 border border-white/10 shadow-2xl rounded-[24px] overflow-hidden z-[1100]">

                        <div class="px-6 py-5 border-b border-white/5 bg-white/[0.02]">
                            <p class="text-[9px] font-black text-slate-500 uppercase tracking-[3px] mb-2">Cuenta Activa</p>
                            <p class="text-[11px] font-semibold text-slate-300 truncate font-inter">{{ auth()->user()->email }}</p>
                        </div>

                        <div class="p-3">
                            <a href="{{ route('profile') }}" wire:navigate class="flex items-center gap-3 px-4 py-3.5 font-inter text-[10px] font-black text-slate-300 hover:bg-[#ff6600] hover:text-white rounded-xl no-underline transition-all group">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" stroke-width="2" />
                                </svg>
                                MI PERFIL {{ Auth::user()->tipo_socio === 'Administrador' ? 'ADMIN' : '' }}
                            </a>

                            <button wire:click="logout" class="w-full flex items-center gap-3 text-left px-4 py-3.5 font-inter text-[10px] font-black text-red-400 hover:bg-red-500/10 rounded-xl transition-all mt-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" stroke-width="2" />
                                </svg>
                                FINALIZAR SESIÓN
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Mobile Button --}}
            <div class="flex items-center sm:hidden">
                <button @click="open = !open" class="p-3 rounded-2xl bg-white/[0.05] border border-white/10 text-[#ff6600]">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path :class="open ? 'hidden' : 'inline-flex'" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="!open ? 'hidden' : 'inline-flex'" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div x-show="open" x-transition class="sm:hidden bg-black border-t border-white/10">
        <div class="px-6 py-8 space-y-6">
            <div class="flex items-center gap-4 mb-8">
                {{-- Avatar Mobile --}}
                <div class="w-12 h-12 rounded-xl bg-[#ff6600] flex items-center justify-center text-white font-outfit font-black text-lg overflow-hidden">
                    @if($foto_url)
                    <img src="{{ $foto_url }}" class="w-full h-full object-cover">
                    @else
                    {{ $iniciales }}
                    @endif
                </div>
                <div>
                    <div class="font-outfit text-base font-bold text-white uppercase tracking-tight">{{ auth()->user()->name }}</div>
                    <div class="font-inter text-[10px] text-slate-500 font-bold tracking-widest">{{ auth()->user()->tipo_socio }}</div>
                </div>
            </div>
            <a href="{{ route('dashboard') }}" wire:navigate class="block font-inter text-xs font-black text-[#ff6600] tracking-[4px] no-underline uppercase">Mi Proceso</a>
            <a href="{{ route('profile') }}" wire:navigate class="block font-inter text-xs font-black text-slate-400 no-underline tracking-[4px] uppercase">Mi Perfil</a>
            <button wire:click="logout" class="w-full text-left font-inter text-xs font-black text-red-500 tracking-[4px] uppercase">Finalizar Sesión</button>
        </div>
    </div>
</nav>