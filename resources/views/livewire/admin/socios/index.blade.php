<div class="p-6 lg:p-12 bg-slate-50 min-h-screen" x-data="{ open: @entangle('showingModal') }">
    <div class="max-w-7xl mx-auto">

        {{-- Navegación - Consistente con los demás --}}
        <nav class="flex items-center gap-4 mb-8 text-[11px] font-bold uppercase tracking-[2px] text-slate-400">
            <a href="{{ route('dashboard') }}" wire:navigate class="hover:text-[#ff6600] transition-colors">
                INICIO
            </a>
            <span class="opacity-30">/</span>
            <span class="text-slate-600">
                SOCIOS
            </span>
        </nav>
        {{-- HEADER --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10">
            <div>
                <h1 class="text-4xl font-outfit font-900 text-slate-950 tracking-tighter uppercase">Directorio de Socios</h1>
                <p class="text-slate-500 font-inter text-sm">Administración total de la base de datos de proponentes.</p>
            </div>
            <button wire:click="crearSocio"
                class="px-8 py-4 bg-[#ff6600] text-white rounded-2xl font-inter text-xs font-bold tracking-widest hover:bg-slate-950 transition-all shadow-xl shadow-orange-200 uppercase">
                Nuevo Socio
            </button>
        </div>

        {{-- BARRA DE BÚSQUEDA Y FILTROS --}}
        <div class="bg-white p-4 rounded-[2rem] border border-slate-200 shadow-sm mb-6 flex flex-col md:flex-row gap-4">
            <div class="flex-1 relative">
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Buscar por nombre, cédula o correo..."
                    class="w-full pl-12 pr-4 py-4 rounded-2xl border-none bg-slate-100 focus:ring-2 focus:ring-[#ff6600] transition-all font-inter text-sm">
                <svg class="w-5 h-5 absolute left-4 top-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke-width="2" />
                </svg>
            </div>
            <select wire:model.live="filtroEstado" class="md:w-56 py-4 rounded-2xl border-none bg-slate-100 focus:ring-2 focus:ring-[#ff6600] font-inter text-sm">
                <option value="">Todos los estados</option>
                <option value="Activo">Solo Activos</option>
                <option value="Inactivo">Solo Inactivos</option>
            </select>
        </div>

        {{-- TABLA --}}
        <div class="bg-white rounded-[2rem] border border-slate-200 shadow-sm overflow-hidden text-sm">
            <table class="w-full text-left font-inter">
                <thead class="bg-slate-50 border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-5 font-bold text-slate-400 uppercase tracking-widest text-[10px]">Socio / Correo</th>
                        <th class="px-6 py-5 font-bold text-slate-400 uppercase tracking-widest text-[10px]">Identificación</th>
                        <th class="px-6 py-5 font-bold text-slate-400 uppercase tracking-widest text-[10px]">Tipo / Género</th>
                        <th class="px-6 py-5 font-bold text-slate-400 uppercase tracking-widest text-[10px]">Estado</th>
                        <th class="px-6 py-5 font-bold text-slate-400 uppercase tracking-widest text-[10px] text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($socios as $socio)
                    <tr class="hover:bg-slate-50/50 transition-colors" wire:key="socio-{{ $socio->id }}">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-orange-100 flex items-center justify-center font-bold text-[#ff6600]">
                                    {{ substr($socio->name, 0, 1) }}
                                </div>
                                <div>
                                    <p class="font-bold text-slate-900">{{ $socio->name }}</p>
                                    <p class="text-[11px] text-slate-400 lowercase">{{ $socio->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-slate-600 font-medium font-mono text-xs">{{ $socio->identificacion }}</td>
                        <td class="px-6 py-4">
                            <p class="text-slate-700 font-bold text-[10px] uppercase tracking-tighter">{{ $socio->tipo_socio ?? 'Sin asignar' }}</p>
                            <p class="text-slate-400 text-[10px]">{{ $socio->genero }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <button wire:click="cambiarEstado({{ $socio->id }})"
                                class="px-3 py-1 rounded-full text-[10px] font-bold uppercase transition-all {{ $socio->estado === 'Activo' ? 'bg-emerald-100 text-emerald-600 hover:bg-emerald-200' : 'bg-red-100 text-red-600 hover:bg-red-200' }}">
                                {{ $socio->estado }}
                            </button>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex justify-end gap-2">
                                <button wire:click="editarSocio({{ $socio->id }})" class="text-slate-400 hover:text-[#ff6600] p-2 transition-colors bg-slate-50 rounded-xl">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" stroke-width="2" />
                                    </svg>
                                </button>
                                <!-- <button wire:click="eliminarSocio({{ $socio->id }})" wire:confirm="¿Seguro que deseas eliminar permanentemente a este socio?" class="text-slate-400 hover:text-red-600 p-2 transition-colors bg-slate-50 rounded-xl">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" stroke-width="2"/></svg>
                                    </button> -->
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-20 text-center">
                            <p class="text-slate-400 font-inter">No se encontraron socios con los criterios de búsqueda.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="p-6 border-t border-slate-50 bg-slate-50/30">
                {{ $socios->links() }}
            </div>
        </div>
    </div>

    {{-- MODAL CRUD --}}
    <div x-show="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        class="fixed inset-0 z-50 overflow-y-auto" x-cloak>

        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm" @click="open = false"></div>

            <div class="relative bg-white w-full max-w-2xl rounded-[2.5rem] shadow-2xl overflow-hidden">
                <div class="h-2 w-full bg-[#ff6600]"></div>
                <div class="p-8 md:p-12">
                    <div class="flex justify-between items-center mb-8">
                        <h2 class="text-3xl font-outfit font-900 text-slate-900 tracking-tighter uppercase">
                            {{ $userId ? 'Actualizar Socio' : 'Registrar Nuevo' }}
                        </h2>
                        <button @click="open = false" class="text-slate-400 hover:text-slate-900">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M6 18L18 6M6 6l12 12" stroke-width="2" />
                            </svg>
                        </button>
                    </div>

                    <form wire:submit="guardar" class="space-y-5">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="space-y-1">
                                <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-4">Nombre Completo</label>
                                <input wire:model="name" type="text" class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-[#ff6600] text-sm">
                                @error('name') <span class="text-red-500 text-[10px] ml-4">{{ $message }}</span> @enderror
                            </div>

                            <div class="space-y-1">
                                <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-4">Correo Electrónico</label>
                                <input wire:model="email" type="email" class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-[#ff6600] text-sm">
                                @error('email') <span class="text-red-500 text-[10px] ml-4">{{ $message }}</span> @enderror
                            </div>

                            <div class="space-y-1">
                                <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-4">Cédula / ID</label>
                                <input wire:model="identificacion" type="text" class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-[#ff6600] text-sm">
                                @error('identificacion') <span class="text-red-500 text-[10px] ml-4">{{ $message }}</span> @enderror
                            </div>

                            <div class="space-y-1">
                                <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-4">Tipo de Socio</label>
                                <div class="space-y-1">
                                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-4">Tipo de Socio</label>
                                    <select wire:model="tipo_socio" class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-[#ff6600] text-sm">
                                        <option value="">Seleccionar...</option>
                                        <option value="Adherido">Adherido</option>
                                        <option value="P. Derecho">P. Derecho</option>
                                    </select>
                                    @error('tipo_socio') <span class="text-red-500 text-[10px] ml-4">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="space-y-1">
                                <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-4">Género</label>
                                <select wire:model="genero" class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-[#ff6600] text-sm">
                                    <option value="">Seleccionar...</option>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Femenino">Femenino</option>
                                    <option value="Otro">Otro</option>
                                </select>
                            </div>

                            <div class="space-y-1">
                                <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-4">Fecha Nacimiento</label>
                                <input wire:model="fecha_nacimiento" type="date" class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-[#ff6600] text-sm">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="space-y-1">
                                <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-4">Teléfono</label>
                                <input wire:model="telefono" type="text" class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-[#ff6600] text-sm">
                            </div>
                            <div class="space-y-1">
                                <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-4">Estado Cuenta</label>
                                <select wire:model="estado" class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-[#ff6600] text-sm font-bold">
                                    <option value="Activo">ACTIVO</option>
                                    <option value="Inactivo">INACTIVO</option>
                                </select>
                            </div>
                        </div>

                        <div class="space-y-1">
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-4">Dirección</label>
                            <input wire:model="direccion" type="text" class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-[#ff6600] text-sm">
                        </div>

                        <div class="space-y-1">
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-4">Contraseña {{ $userId ? '(Dejar vacío para mantener)' : '' }}</label>
                            <input wire:model="password" type="password" class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-[#ff6600] text-sm">
                            @error('password') <span class="text-red-500 text-[10px] ml-4">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex gap-4 pt-8">
                            <button type="button" @click="open = false" class="flex-1 py-4 bg-slate-100 text-slate-500 rounded-2xl font-bold text-xs uppercase hover:bg-slate-200 transition-all tracking-widest">Cerrar</button>
                            <button type="submit" class="flex-1 py-4 bg-[#ff6600] text-white rounded-2xl font-bold text-xs uppercase shadow-lg shadow-orange-100 hover:bg-slate-950 transition-all tracking-widest">
                                {{ $userId ? 'Guardar Cambios' : 'Confirmar Registro' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>