@extends('layouts.app')

@section('title', 'Forum Diskusi Komunitas — WASPADA')

@section('content')
<div class="py-10 max-w-5xl mx-auto px-4 sm:px-6">

    {{-- Flash Alert --}}
    @if (session('success'))
        <x-alert type="success" class="mb-6">
            {{ session('success') }}
        </x-alert>
    @endif

    {{-- Forum Header Banner --}}
    <x-card variant="elevated" class="mb-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="max-w-2xl">
                <x-badge variant="lime" class="mb-3">
                    COMMUNITY INTELLIGENCE
                </x-badge>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">
                    Forum Diskusi WASPADA
                </h1>
                <p class="mt-2 text-xs sm:text-sm text-[#8ba99c] leading-relaxed">
                    Bagikan modus baru, pelajari taktik penipuan digital terkini, dan saling menjaga keamanan transaksi bersama komunitas.
                </p>
            </div>

            <div class="flex-shrink-0">
                @auth
                    <x-button variant="lime" href="{{ route('forum.create') }}">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                        </svg>
                        <span>Buat Diskusi</span>
                    </x-button>
                @else
                    <x-button variant="outline" href="{{ route('login') }}">
                        Masuk untuk Berdiskusi
                    </x-button>
                @endauth
            </div>
        </div>
    </x-card>

    {{-- Filter Toolbar --}}
    <form action="{{ route('forum.index') }}" method="GET" class="mb-8 flex flex-col sm:flex-row gap-3">
        <div class="relative flex-1">
            <input
                type="search"
                name="q"
                value="{{ request('q') }}"
                placeholder="Cari topik diskusi atau nama modus..."
                class="w-full rounded-xl border border-slate-200 dark:border-[#1e382c] bg-white dark:bg-[#102018] px-4 py-3 text-xs sm:text-sm text-slate-900 dark:text-white placeholder:text-slate-400 dark:placeholder:text-[#5f7d70] focus:border-[#c9f28a] focus:outline-none focus:ring-1 focus:ring-[#c9f28a] transition"
            >
        </div>

        <select name="category" 
                class="rounded-xl border border-slate-200 dark:border-[#1e382c] bg-white dark:bg-[#102018] px-4 py-3 text-xs sm:text-sm text-slate-800 dark:text-[#d1e3da] focus:border-[#c9f28a] focus:outline-none focus:ring-1 focus:ring-[#c9f28a] transition">
            <option value="">Semua Kategori</option>
            @foreach ($categories as $category)
                <option value="{{ $category->slug }}" @selected(request('category') === $category->slug)>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        <x-button variant="lime" type="submit">
            Cari
        </x-button>
    </form>

    {{-- Discussion Cards Stream --}}
    <div class="space-y-4">
        @forelse ($discussions as $discussion)
            <x-card class="group transition hover:border-emerald-500/40 dark:hover:border-[#c9f28a]/40 hover:bg-slate-50 dark:hover:bg-[#12221b]">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-3">
                    <x-badge variant="default">
                        {{ $discussion->category->name }}
                    </x-badge>
                    <span class="text-[11px] font-mono text-slate-400 dark:text-[#6c8c7d]">
                        {{ $discussion->created_at->format('d M Y, H:i') }}
                    </span>
                </div>

                <h2 class="text-base sm:text-lg font-bold text-slate-900 dark:text-white group-hover:text-emerald-700 dark:group-hover:text-[#c9f28a] transition">
                    <a href="{{ route('forum.show', $discussion->slug) }}" class="focus:outline-none">
                        {{ $discussion->title }}
                    </a>
                </h2>

                <p class="mt-2 text-xs sm:text-sm text-slate-600 dark:text-[#8ea79b] leading-relaxed line-clamp-2">
                    {{ \Illuminate\Support\Str::limit($discussion->body, 200) }}
                </p>

                <div class="mt-4 pt-4 border-t border-slate-100 dark:border-[#182f23] flex flex-wrap items-center justify-between gap-4 text-xs text-slate-500 dark:text-[#739485]">
                    <div class="flex items-center gap-2">
                        <div class="h-6 w-6 rounded-full bg-slate-100 dark:bg-[#1b362a] border border-slate-200 dark:border-[#2d5c46] flex items-center justify-center text-[10px] font-bold text-emerald-800 dark:text-[#c9f28a] uppercase">
                            {{ substr($discussion->user->name, 0, 1) }}
                        </div>
                        <span class="text-slate-700 dark:text-[#c0d6cc] font-medium">{{ $discussion->user->name }}</span>
                    </div>

                    <div class="flex items-center gap-4 text-[11px] font-mono">
                        <span class="flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 text-emerald-600 dark:text-[#c9f28a]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                            {{ $discussion->comments_count }} respon
                        </span>
                        <span class="flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 text-emerald-600 dark:text-[#c9f28a]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                            </svg>
                            {{ $discussion->votes_count }} vote
                        </span>
                    </div>
                </div>
            </x-card>
        @empty
            <div class="rounded-2xl border border-dashed border-[#1f372c] p-12 text-center text-xs text-[#6e8a7d]">
                Belum ada topik diskusi yang cocok dengan filter pencarian Anda.
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="mt-8">
        {{ $discussions->links() }}
    </div>

</div>
@endsection
