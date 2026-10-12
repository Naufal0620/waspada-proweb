@props([
    'variant' => 'default', // default, elevated, light
])

@php
    $variantClass = match($variant) {
        'elevated' => 'bg-white dark:bg-[#12221b] border-slate-200 dark:border-[#254637] shadow-[0_15px_35px_rgba(0,0,0,0.06)] dark:shadow-[0_20px_50px_rgba(0,0,0,0.6)]',
        'light' => 'bg-[#f2f4f2] text-[#13221c] border-[#dde3df]',
        default => 'bg-white dark:bg-[#0f1d17] border-slate-200 dark:border-[#1b3327] shadow-sm dark:shadow-[0_10px_30px_rgba(0,0,0,0.4)]',
    };
@endphp

<div {{ $attributes->merge(['class' => "rounded-2xl sm:rounded-3xl border p-6 sm:p-8 backdrop-blur-xl transition-colors {$variantClass}"]) }}>
    {{ $slot }}
</div>
