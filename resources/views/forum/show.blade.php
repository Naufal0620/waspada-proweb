@extends('layouts.app')

@section('title', $discussion->title . ' — WASPADA')

@section('content')
<div class="py-10 max-w-4xl mx-auto px-4 sm:px-6">

    {{-- Session & Error Alerts --}}
    @if (session('success'))
        <x-alert type="success" class="mb-6">
            {{ session('success') }}
        </x-alert>
    @endif

    @if ($errors->any())
        <x-alert type="error" class="mb-6">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </x-alert>
    @endif

    {{-- Back Link --}}
    <div class="mb-6">
        <x-button variant="outline" size="sm" href="{{ route('forum.index') }}">
            ← Kembali ke Forum
        </x-button>
    </div>

    {{-- Main Article Card --}}
    <x-card variant="elevated" class="mb-8">
        
        {{-- Top Metadata & Vote Bar --}}
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-slate-200 dark:border-[#1b3127]">
            <div class="flex items-center gap-3">
                <x-badge variant="lime">
                    {{ $discussion->category->name }}
                </x-badge>
                <span class="text-xs font-mono text-slate-500 dark:text-[#6d8d7e]">
                    {{ $discussion->created_at->format('d M Y, H:i') }}
                </span>
            </div>

            {{-- Vote Mechanism --}}
            <div class="flex items-center gap-3">
                <span class="text-xs font-mono text-slate-600 dark:text-[#a2c4b5]">
                    <strong>{{ $discussion->votes_count }}</strong> vote
                </span>

                @auth
                    @php
                        $hasVoted = $discussion
                            ->votes()
                            ->where('user_id', auth()->id())
                            ->exists();
                    @endphp

                    <form action="{{ route('forum.votes.toggle', $discussion->slug) }}" method="POST">
                        @csrf
                        <x-button :variant="$hasVoted ? 'danger' : 'lime'" size="sm" type="submit">
                            {{ $hasVoted ? 'Batalkan Vote' : '▲ Beri Dukungan' }}
                        </x-button>
                    </form>
                @else
                    <x-button variant="outline" size="sm" href="{{ route('login') }}">
                        Login to Vote
                    </x-button>
                @endauth
            </div>
        </div>

        {{-- Title --}}
        <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight mt-6 mb-4 leading-tight">
            {{ $discussion->title }}
        </h1>

        {{-- Author Signature --}}
        <div class="flex items-center gap-2.5 mb-6 text-xs text-slate-500 dark:text-[#7d9f90]">
            <div class="h-6 w-6 rounded-full bg-slate-100 dark:bg-[#1b362a] border border-slate-200 dark:border-[#2d5c46] flex items-center justify-center text-[10px] font-bold text-emerald-800 dark:text-[#c9f28a] uppercase">
                {{ substr($discussion->user->name, 0, 1) }}
            </div>
            <span>Ditulis oleh <strong class="text-slate-900 dark:text-white">{{ $discussion->user->name }}</strong></span>
        </div>

        {{-- Body Content --}}
        <div class="text-sm sm:text-base text-slate-700 dark:text-[#d0e4db] leading-relaxed whitespace-pre-line py-4 border-t border-b border-slate-200 dark:border-[#172c21]">
            {{ $discussion->body }}
        </div>

        {{-- Report Dropdown --}}
        @auth
            <div class="mt-6 pt-2 flex items-center justify-between">
                <details class="text-xs text-rose-600 dark:text-rose-400 group">
                    <summary class="cursor-pointer font-semibold flex items-center gap-1.5 hover:text-rose-700 dark:hover:text-rose-300">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9" />
                        </svg>
                        <span>Laporkan Konten / Pelanggaran</span>
                    </summary>

                    <form action="{{ route('forum.reports.store', $discussion->slug) }}" method="POST"
                          class="mt-4 p-4 rounded-xl border border-rose-300 dark:border-rose-500/30 bg-rose-50/70 dark:bg-rose-950/20 max-w-lg space-y-3">
                        @csrf

                        <label for="reason" class="block font-mono text-[10px] uppercase tracking-wider text-rose-800 dark:text-rose-300 font-bold">
                            Alasan Laporan
                        </label>
                        <select id="reason" name="reason" required
                                class="w-full rounded-lg border border-rose-300 dark:border-rose-900/60 bg-white dark:bg-[#0c1813] px-3 py-2 text-xs text-slate-900 dark:text-white focus:border-rose-500 focus:outline-none">
                            <option value="">Pilih alasan pelanggaran...</option>
                            <option value="Informasi menyesatkan">Informasi menyesatkan / Hoax</option>
                            <option value="Dugaan penipuan">Dugaan penipuan</option>
                            <option value="Spam">Spam / Promosi terlarang</option>
                            <option value="Data pribadi">Memuat nomor telepon / data pribadi orang lain</option>
                            <option value="Pelecehan">Pelecehan atau serangan personal</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>

                        <label for="details" class="block font-mono text-[10px] uppercase tracking-wider text-rose-800 dark:text-rose-300 font-bold">
                            Keterangan Tambahan (Opsional)
                        </label>
                        <textarea id="details" name="details" rows="2" maxlength="2000"
                                  placeholder="Jelaskan alasan laporan secara singkat..."
                                  class="w-full rounded-lg border border-rose-300 dark:border-rose-900/60 bg-white dark:bg-[#0c1813] px-3 py-2 text-xs text-slate-900 dark:text-white focus:border-rose-500 focus:outline-none"></textarea>

                        <x-button variant="danger" size="sm" type="submit">
                            Kirim Tiket Laporan
                        </x-button>
                    </form>
                </details>
            </div>
        @endauth

    </x-card>

    {{-- Comments Stream Section --}}
    <x-card id="comments">
        <h2 class="text-lg font-bold text-slate-900 dark:text-white mb-6 flex items-center gap-2">
            <svg class="w-5 h-5 text-emerald-600 dark:text-[#c9f28a]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
            </svg>
            Tanggapan Komunitas ({{ $discussion->comments->count() }})
        </h2>

        <div class="space-y-6">
            @forelse ($discussion->comments as $comment)
                <div class="rounded-xl border border-slate-200 dark:border-[#1b3127] bg-slate-50 dark:bg-[#0c1813] p-5 text-xs sm:text-sm">
                    <div class="flex items-center justify-between mb-2">
                        <div class="flex items-center gap-2">
                            <div class="h-6 w-6 rounded-full bg-slate-200 dark:bg-[#172c21] text-emerald-800 dark:text-[#c9f28a] font-bold text-[10px] flex items-center justify-center uppercase">
                                {{ substr($comment->user->name, 0, 1) }}
                            </div>
                            <span class="font-bold text-slate-900 dark:text-white">{{ $comment->user->name }}</span>
                        </div>
                        <span class="text-[10px] font-mono text-slate-500 dark:text-[#6d8e80]">
                            {{ $comment->created_at->format('d M Y, H:i') }}
                        </span>
                    </div>

                    <p class="text-slate-700 dark:text-[#c7dbd2] leading-relaxed pl-8 mb-3 whitespace-pre-line">
                        {{ $comment->body }}
                    </p>

                    @auth
                        <div class="pl-8">
                            <button type="button"
                                    onclick="document.getElementById('reply-form-{{ $comment->id }}').hidden = !document.getElementById('reply-form-{{ $comment->id }}').hidden"
                                    class="text-xs font-semibold text-emerald-700 dark:text-[#c9f28a] hover:underline cursor-pointer">
                                ↳ Balas komentar
                            </button>

                            <form id="reply-form-{{ $comment->id }}"
                                  action="{{ route('forum.comments.store', $discussion->slug) }}" method="POST" 
                                  hidden
                                  class="mt-3 space-y-2">
                                @csrf
                                <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                <textarea name="body" rows="2" minlength="2" maxlength="3000" required 
                                          placeholder="Tulis balasan Anda..."
                                          class="w-full rounded-lg border border-slate-200 dark:border-[#213f31] bg-white dark:bg-[#09130f] px-3 py-2 text-xs text-slate-900 dark:text-white focus:border-[#c9f28a] focus:outline-none"></textarea>
                                <x-button variant="lime" size="sm" type="submit">
                                    Kirim Balasan
                                </x-button>
                            </form>
                        </div>
                    @endauth

                    {{-- Nested Replies --}}
                    @if($comment->replies->count() > 0)
                        <div class="mt-4 pl-8 space-y-3 border-l-2 border-slate-200 dark:border-[#1c3629]">
                            @foreach ($comment->replies as $reply)
                                <div class="rounded-lg bg-slate-100 dark:bg-[#0e1d17] p-3 text-xs">
                                    <div class="flex items-center justify-between mb-1 text-[11px]">
                                        <strong class="text-slate-900 dark:text-white">{{ $reply->user->name }}</strong>
                                        <span class="font-mono text-slate-500 dark:text-[#607d70]">{{ $reply->created_at->format('d M Y, H:i') }}</span>
                                    </div>
                                    <p class="text-slate-700 dark:text-[#b4cbbf] leading-relaxed">{{ $reply->body }}</p>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            @empty
                <div class="rounded-xl border border-dashed border-slate-300 dark:border-[#1f372c] p-8 text-center text-xs text-slate-500 dark:text-[#6e8a7d]">
                    Belum ada komentar. Jadilah orang pertama yang memberikan masukan atau konfirmasi.
                </div>
            @endforelse
        </div>

        {{-- Add Comment Form --}}
        <div class="mt-8 pt-8 border-t border-slate-200 dark:border-[#1b3127]">
            @auth
                <form action="{{ route('forum.comments.store', $discussion->slug) }}" method="POST" class="space-y-4">
                    @csrf
                    <label for="comment-body" class="block text-xs font-mono font-bold uppercase tracking-wider text-slate-700 dark:text-[#a0c5b5]">
                        Tulis Tanggapan Anda
                    </label>

                    <textarea id="comment-body" name="body" rows="4" minlength="2" maxlength="3000" required
                              placeholder="Bagikan opini atau pengalaman Anda secara faktual..."
                              class="w-full rounded-xl border border-slate-200 dark:border-[#1e382c] bg-white dark:bg-[#0c1813] px-4 py-3 text-sm text-slate-900 dark:text-white placeholder:text-slate-400 dark:placeholder:text-[#526f62] focus:border-[#c9f28a] focus:outline-none focus:ring-1 focus:ring-[#c9f28a] transition leading-relaxed">{{ old('body') }}</textarea>

                    <x-button variant="lime" type="submit">
                        Kirim Komentar
                    </x-button>
                </form>
            @else
                <div class="rounded-xl bg-slate-50 dark:bg-[#0c1813] border border-slate-200 dark:border-[#1c3328] p-5 text-center text-xs text-slate-600 dark:text-[#87a396]">
                    <a href="{{ route('login') }}" class="font-bold text-emerald-700 dark:text-[#c9f28a] hover:underline">Masuk ke akun</a> untuk ikut memberikan respon dalam diskusi ini.
                </div>
            @endauth
        </div>
    </x-card>

</div>
@endsection
