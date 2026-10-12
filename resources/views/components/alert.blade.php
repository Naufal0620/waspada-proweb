@props([
    'type' => 'success', // success, error, warning
    'message' => null,
])

@php
    $styles = match($type) {
        'error' => 'border-rose-200 dark:border-rose-500/40 bg-rose-50 dark:bg-rose-950/40 text-rose-800 dark:text-rose-300',
        'warning' => 'border-amber-200 dark:border-amber-500/40 bg-amber-50 dark:bg-amber-950/40 text-amber-800 dark:text-amber-300',
        default => 'border-emerald-200 dark:border-[#c9f28a]/40 bg-emerald-50 dark:bg-[#142820] text-emerald-800 dark:text-[#c9f28a]',
    };
@endphp

<div {{ $attributes->merge(['class' => "flex items-start gap-3 rounded-xl border p-4 text-xs sm:text-sm transition-colors {$styles}"]) }} role="alert">
    <div class="flex-shrink-0 pt-0.5">
        @if($type === 'error')
            <svg class="w-4 h-4 text-rose-600 dark:text-rose-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        @elseif($type === 'warning')
            <svg class="w-4 h-4 text-amber-600 dark:text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
        @else
            <svg class="w-4 h-4 text-emerald-600 dark:text-[#c9f28a]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
        @endif
    </div>
    <div class="flex-1 leading-relaxed">
        {{ $message ?? $slot }}
    </div>
</div>
