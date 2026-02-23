<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;
use Illuminate\Support\Facades\Auth;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();
        $this->redirect('/', navigate: true);
    }
}; ?>

<nav x-data="{ open: false }" class="bg-slate-950 border-b border-white/5 sticky top-0 z-[1000] antialiased font-inter">
    {{-- Estilos de Marca --}}
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@600;700;800&display=swap');
        .font-outfit { font-family: 'Outfit', sans-serif !important; }
        .font-inter { font-family: 'Inter', sans-serif !important; }
    </style>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            {{-- Sección Izquierda: Logo y Contexto Dinámico --}}
            <div class="flex items-center">
                <div class="shrink-0 flex items-center">
                    <a href="/" class="flex items-center gap-4 no-underline group">
                        <img src="{{ asset('resources/imagenes/logo.png') }}" alt="Logo" class="h-10 w-auto object-contain brightness-110 transition-transform group-hover:scale-105">
                        <div class="flex flex-col border-l border-white/10 pl-4">
                            <span class="font-outfit text-xl font-800 text-white tracking-tight leading-none group-hover:text-[#ff6600] transition-colors uppercase">
                                @if(Auth::user()->role === 'admin')
                                    PANEL <span class="text-[#ff6600]">ADMIN</span>
                                @else
                                    CONVOCATORIA <span class="text-[#ff6600]">2026</span>
                                @endif
                            </span>
                            <span class="text-[10px] font-bold text-slate-500 uppercase tracking-[3px] leading-tight mt-1">
                                Actores S.C.G.
                            </span>
                        </div>
                    </a>
                </div>

                {{-- Navegación Central (Desktop) --}}
                <div class="hidden sm:flex sm:ms-12 space-x-8">
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('dashboard') }}" wire:navigate 
                           class="font-inter text-[12px] font-bold tracking-[2px] transition-all no-underline relative py-2 {{ request()->routeIs('dashboard') ? 'text-[#ff6600]' : 'text-slate-400 hover:text-white' }}">
                            DASHBOARD
                            @if(request()->routeIs('dashboard')) <span class="absolute bottom-0 left-0 w-full h-0.5 bg-[#ff6600]"></span> @endif
                        </a>
                    @else
                        <a href="{{ url('/convocatoria/registro-etapa-1') }}" wire:navigate 
                           class="font-inter text-[12px] font-bold tracking-[2px] transition-all no-underline relative py-2 {{ request()->is('convocatoria*') ? 'text-[#ff6600]' : 'text-slate-400 hover:text-white' }}">
                            MI PROCESO
                            @if(request()->is('convocatoria*')) <span class="absolute bottom-0 left-0 w-full h-0.5 bg-[#ff6600]"></span> @endif
                        </a>
                    @endif
                </div>
            </div>

            {{-- Sección Derecha: Usuario --}}
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <div x-data="{ dropdownOpen: false }" class="relative">
                    <button @click="dropdownOpen = !dropdownOpen" 
                            class="flex items-center gap-3 px-4 py-2 rounded-xl border border-white/5 bg-white/5 hover:bg-white/10 transition-all duration-300">
                        <div class="w-8 h-8 rounded-lg bg-[#ff6600]/20 flex items-center justify-center text-[#ff6600] font-outfit font-bold text-xs uppercase shadow-inner">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                        <div class="flex flex-col items-start text-left">
                            <span class="font-outfit text-sm font-700 text-white tracking-wide leading-none truncate max-w-[150px]">
                                {{ auth()->user()->name }}
                            </span>
                            <span class="text-[9px] font-bold text-[#ff6600] uppercase tracking-widest mt-1 opacity-80">
                                {{ Auth::user()->role === 'admin' ? 'Administrador' : 'Socio Proponente' }}
                            </span>
                        </div>
                        <svg class="w-4 h-4 text-slate-500 transition-transform duration-300" :class="dropdownOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    {{-- Dropdown Menu --}}
                    <div x-show="dropdownOpen" 
                         @click.away="dropdownOpen = false" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                         class="absolute right-0 mt-3 w-60 bg-slate-900 border border-white/10 shadow-2xl rounded-2xl overflow-hidden z-[1100] backdrop-blur-xl">
                        
                        <div class="px-5 py-4 border-b border-white/5 bg-white/[0.02]">
                            <p class="text-[9px] font-bold text-slate-500 uppercase tracking-[3px] mb-1">Sesión iniciada</p>
                            <p class="text-xs font-semibold text-slate-200 truncate">{{ auth()->user()->email }}</p>
                        </div>

                        <div class="p-2 space-y-1">
                            <a href="{{ route('profile') }}" wire:navigate class="flex items-center gap-3 px-4 py-3 font-inter text-[11px] font-bold text-slate-300 hover:bg-white/5 rounded-xl no-underline transition-all group">
                                <svg class="w-4 h-4 text-[#ff6600] opacity-70 group-hover:opacity-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" stroke-width="2"/></svg>
                                PERFIL DE USUARIO
                            </a>

                            <button wire:click="logout" class="w-full flex items-center gap-3 text-left px-4 py-3 font-inter text-[11px] font-bold text-red-400 hover:bg-red-500/10 rounded-xl transition-all">
                                <svg class="w-4 h-4 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" stroke-width="2"/></svg>
                                CERRAR SESIÓN
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Mobile Button --}}
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = !open" class="text-[#ff6600] bg-white/5 p-2 rounded-xl focus:outline-none border border-white/5">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path :class="open ? 'hidden' : 'inline-flex'" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="!open ? 'hidden' : 'inline-flex'" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div x-show="open" @click.away="open = false" x-transition class="sm:hidden bg-slate-900 border-t border-white/5 font-inter">
        <div class="pt-2 pb-3 space-y-1">
            <div class="px-6 py-4 flex items-center gap-4 border-b border-white/5">
                <div class="w-10 h-10 rounded-lg bg-[#ff6600] flex items-center justify-center text-white font-outfit font-bold">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </div>
                <div>
                    <div class="font-outfit text-sm font-bold text-white uppercase">{{ auth()->user()->name }}</div>
                    <div class="font-inter text-[10px] text-slate-500 font-medium tracking-wider">{{ auth()->user()->email }}</div>
                </div>
            </div>
            
            <a href="{{ Auth::user()->role === 'admin' ? route('dashboard') : url('/') }}" class="block px-6 py-4 font-inter text-[11px] font-black text-[#ff6600] tracking-[3px] no-underline">
                {{ Auth::user()->role === 'admin' ? 'DASHBOARD' : 'MI PROCESO' }}
            </a>
            
            <a href="{{ route('profile') }}" class="block px-6 py-4 font-inter text-[11px] font-bold text-slate-400 no-underline">
                MI PERFIL
            </a>
            
            <button wire:click="logout" class="w-full text-left px-6 py-4 font-inter text-[11px] font-bold text-red-500">
                CERRAR SESIÓN
            </button>
        </div>
    </div>
</nav>