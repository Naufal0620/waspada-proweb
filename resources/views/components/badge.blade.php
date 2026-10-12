@props([
    'variant' => 'default', // default, lime, alert, danger
])

@php
    $classes = match($variant) {
        'lime' => 'border-emerald-300 dark:border-[#c9f28a]/40 bg-emerald-100 dark:bg-[#162d22] text-emerald-800 dark:text-[#c9f28a] shadow-sm dark:shadow-[0_0_12px_rgba(201,242,138,0.15)]',
        'alert' => 'border-amber-300 dark:border-amber-500/30 bg-amber-50 dark:bg-amber-950/40 text-amber-800 dark:text-amber-300',
        'danger' => 'border-rose-300 dark:border-rose-500/40 bg-rose-50 dark:bg-rose-950/40 text-rose-800 dark:text-rose-300',
        default => 'border-slate-200 dark:border-[#223d31] bg-slate-100 dark:bg-[#12231c] text-slate-700 dark:text-[#a4c8b8]',
    };
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center gap-1.5 rounded-full border px-3 py-1 font-mono text-[10px] sm:text-[11px] uppercase tracking-wider font-semibold transition-colors {$classes}"]) }}>
    {{ $slot }}
</span>
