<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    public function login(): void
    {
        $this->validate();

        // El método authenticate() de Laravel Breeze ya usa internamente 
        // $this->remember para crear la sesión persistente.
        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="min-h-screen bg-black flex flex-col justify-center items-center px-6" x-data="{ showSupport: false }">
    
    <div class="mb-10 text-center">
        <a href="/" class="font-bebas text-5xl text-[#ff6600] tracking-[3px] no-underline">
            ACTORES S.C.G.
        </a>
    </div>

    <div class="w-full max-w-md">
        <div class="bg-[#111] border border-[#222] p-8 md:p-10 shadow-2xl relative overflow-hidden">
            
            <h2 class="font-bebas text-3xl text-white mb-8 border-b border-[#ff6600] pb-2 inline-block">Acceso</h2>

            <form wire:submit="login" class="space-y-6">
                {{-- Email --}}
                <div>
                    <label class="block text-[10px] uppercase font-bold text-gray-500 mb-2 tracking-widest">Correo Electrónico</label>
                    <input wire:model="form.email" type="email" required autofocus 
                        class="w-full bg-black border border-[#222] px-4 py-3 text-white focus:border-[#ff6600] outline-none transition-all">
                    @error('form.email') <span class="text-red-500 text-[10px] uppercase font-bold mt-1">{{ $message }}</span> @enderror
                </div>

                {{-- Password --}}
                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label class="block text-[10px] uppercase font-bold text-gray-500 tracking-widest">Contraseña</label>
                        {{-- Link que activa el mensaje de soporte --}}
                        <button type="button" @click="showSupport = !showSupport" 
                           class="text-[9px] uppercase font-bold text-[#ff6600]/60 hover:text-[#ff6600] transition-colors tracking-tighter">
                            ¿Olvidaste tu contraseña?
                        </button>
                    </div>
                    <input wire:model="form.password" type="password" required 
                        class="w-full bg-black border border-[#222] px-4 py-3 text-white focus:border-[#ff6600] outline-none transition-all">
                </div>

                {{-- MENSAJE DE SOPORTE (Se muestra al hacer clic en Olvidaste contraseña) --}}
                <div x-show="showSupport" x-transition 
                    class="bg-[#ff6600]/10 border border-[#ff6600]/30 p-4 text-center">
                    <p class="text-[11px] text-gray-300 uppercase tracking-widest">
                        Para restablecer su clave, por favor comuníquese con el administrador:
                        <span class="block text-[#ff6600] font-bold mt-1">sistemas@actores.org.co</span>
                    </p>
                </div>

                {{-- Remember Me --}}
                <div class="flex items-center">
                    <label for="remember" class="flex items-center cursor-pointer">
                        {{-- Importante: wire:model="form.remember" --}}
                        <input wire:model="form.remember" id="remember" type="checkbox" 
                            class="w-4 h-4 bg-black border-[#222] text-[#ff6600] focus:ring-[#ff6600] focus:ring-offset-black rounded">
                        <span class="ms-2 text-[10px] uppercase font-bold text-gray-500 tracking-widest">Recordarme en este equipo</span>
                    </label>
                </div>

                {{-- Botón Ingresar --}}
                <div class="pt-2">
                    <button type="submit" wire:loading.attr="disabled"
                        class="w-full bg-[#ff6600] text-white font-bebas text-2xl py-4 hover:bg-[#e65c00] transition-all">
                        <span wire:loading.remove wire:target="login">ENTRAR AL PANEL</span>
                        <span wire:loading wire:target="login">VALIDANDO...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>