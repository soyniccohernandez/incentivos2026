@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex flex-col md:flex-row items-center justify-between gap-8 bg-[#0a0a0a] border border-white/10 p-6 shadow-2xl">
        
        {{-- Info de registros --}}
        <div class="flex flex-col">
            <span class="font-mono text-[10px] text-white/20 tracking-[4px] uppercase italic mb-1">Data_Stream_Output</span>
            <div class="font-mono text-[11px] text-white/40 tracking-[2px] uppercase">
                Registros <span class="text-white">{{ $paginator->firstItem() }}</span> - <span class="text-white">{{ $paginator->lastItem() }}</span> 
                de <span class="text-brand-orange font-bold">{{ $paginator->total() }}</span>
            </div>
        </div>

        <div class="flex items-center gap-2 bg-black/50 p-2 border border-white/5">
            {{-- Botón Anterior --}}
            @if ($paginator->onFirstPage())
                <span class="w-12 h-12 flex items-center justify-center border border-white/5 text-white/10 cursor-not-allowed">
                    <i class="fas fa-chevron-left text-xs"></i>
                </span>
            @else
                <button wire:click="previousPage" wire:loading.attr="disabled" class="w-12 h-12 flex items-center justify-center border border-white/10 text-white/40 hover:text-brand-orange hover:border-brand-orange transition-all group">
                    <i class="fas fa-chevron-left text-xs group-hover:-translate-x-1 transition-transform"></i>
                </button>
            @endif

            {{-- Elementos de la Paginación --}}
            <div class="flex gap-2 px-4">
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <span class="w-12 h-12 flex items-center justify-center text-white/10 italic">{{ $element }}</span>
                    @endif

                    {{-- Array de Enlaces --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span class="w-12 h-12 bg-brand-orange text-black font-bebas text-2xl flex items-center justify-center shadow-[0_0_15px_rgba(255,102,0,0.3)]">
                                    {{ str_pad($page, 2, '0', STR_PAD_LEFT) }}
                                </span>
                            @else
                                <button wire:click="gotoPage({{ $page }})" class="w-12 h-12 border border-white/10 text-white/40 font-bebas text-2xl flex items-center justify-center hover:bg-white/5 hover:text-white transition-all">
                                    {{ str_pad($page, 2, '0', STR_PAD_LEFT) }}
                                </button>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </div>

            {{-- Botón Siguiente --}}
            @if ($paginator->hasMorePages())
                <button wire:click="nextPage" wire:loading.attr="disabled" class="w-12 h-12 flex items-center justify-center border border-white/10 text-white/40 hover:text-brand-orange hover:border-brand-orange transition-all group">
                    <i class="fas fa-chevron-right text-xs group-hover:translate-x-1 transition-transform"></i>
                </button>
            @else
                <span class="w-12 h-12 flex items-center justify-center border border-white/5 text-white/10 cursor-not-allowed">
                    <i class="fas fa-chevron-right text-xs"></i>
                </span>
            @endif
        </div>

        {{-- Indicador de Página Actual --}}
        <div class="hidden lg:flex flex-col items-end">
            <span class="font-bebas text-xl text-white/20 tracking-[4px] uppercase">
                PÁG. {{ $paginator->currentPage() }} / {{ $paginator->lastPage() }}
            </span>
            <div class="flex gap-1 mt-1">
                @for($i=1; $i <= min($paginator->lastPage(), 5); $i++)
                    <div class="w-4 h-[2px] {{ $i == $paginator->currentPage() ? 'bg-brand-orange' : 'bg-white/10' }}"></div>
                @endfor
            </div>
        </div>
    </nav>
@endif