@props([
    'variant' => 'default', // default, lime, outline, danger, dark
    'size' => 'md',        // sm, md, lg
    'type' => 'button',
    'href' => null,
])

@php
    $baseClasses = 'inline-flex items-center justify-center font-bold transition-all duration-200 select-none cursor-pointer focus:outline-none disabled:opacity-50 disabled:cursor-not-allowed';
    
    $sizeClasses = match($size) {
        'sm' => 'px-3 py-1.5 text-xs rounded-lg gap-1.5',
        'lg' => 'px-7 py-3.5 text-sm sm:text-base rounded-xl gap-2.5 shadow-md',
        default => 'px-5 py-2.5 text-xs sm:text-sm rounded-lg gap-2',
    };

    $variantClasses = match($variant) {
        'lime' => 'bg-[#c9f28a] text-[#0b1411] hover:bg-[#d8faa2] shadow-[0_4px_16px_rgba(201,242,138,0.25)] active:scale-95',
        'dark' => 'bg-slate-900 dark:bg-[#14261f] text-white border border-slate-700 dark:border-[#234235] hover:bg-slate-800 dark:hover:bg-[#1a332a] active:scale-95 shadow-sm',
        'outline' => 'bg-transparent text-slate-700 dark:text-[#c4d8ce] border border-slate-300 dark:border-[#223d30] hover:text-slate-950 dark:hover:text-white hover:border-emerald-600 dark:hover:border-[#c9f28a]/60 hover:bg-slate-100 dark:hover:bg-[#13251e] active:scale-95',
        'danger' => 'bg-rose-50 dark:bg-rose-950/40 text-rose-700 dark:text-rose-300 border border-rose-200 dark:border-rose-500/30 hover:bg-rose-100 dark:hover:bg-rose-900/50 hover:border-rose-400 active:scale-95',
        default => 'bg-emerald-800 dark:bg-[#183125] text-white hover:bg-emerald-700 dark:hover:bg-[#204031] border border-emerald-900 dark:border-[#28503d]',
    };

    $classes = "{$baseClasses} {$sizeClasses} {$variantClasses}";
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif
