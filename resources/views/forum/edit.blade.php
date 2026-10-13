@extends('layouts.app')

@section('title', 'Edit Diskusi — ' . $discussion->title)

@section('content')
<div class="py-10 max-w-3xl mx-auto px-4 sm:px-6">

    <div class="mb-6">
        <x-button variant="outline" size="sm" href="{{ route('forum.show', $discussion->slug) }}">
            ← Kembali ke Diskusi
        </x-button>
    </div>

    <x-card variant="elevated">
        <x-badge variant="lime" class="mb-3">
            EDIT KONTEN
        </x-badge>
        
        <h1 class="text-2xl sm:text-3xl font-bold text-slate-900 dark:text-white tracking-tight mb-2">
            Perbarui Topik Diskusi
        </h1>
        <p class="text-xs sm:text-sm text-slate-500 dark:text-[#8ba89b] mb-8 leading-relaxed">
            Perbaiki informasi, kronologi, atau detail kejadian untuk memberikan konteks yang lebih jelas bagi komunitas.
        </p>

        <form action="{{ route('forum.update', $discussion->slug) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Title Input --}}
            <div>
                <label for="title" class="block text-xs font-mono font-bold uppercase tracking-wider text-slate-700 dark:text-[#a0c5b5] mb-2">
                    Judul Diskusi
                </label>
                <input
                    id="title"
                    name="title"
                    type="text"
                    maxlength="200"
                    minlength="10"
                    required
                    value="{{ old('title', $discussion->title) }}"
                    class="w-full rounded-xl border border-slate-200 dark:border-[#1e382c] bg-white dark:bg-[#0c1813] px-4 py-3 text-sm text-slate-900 dark:text-white placeholder:text-slate-400 dark:placeholder:text-[#526f62] focus:border-[#c9f28a] focus:outline-none focus:ring-1 focus:ring-[#c9f28a] transition"
                >
                @error('title')
                    <p class="mt-1.5 text-xs text-rose-500 dark:text-rose-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Category Select --}}
            <div>
                <label for="category_id" class="block text-xs font-mono font-bold uppercase tracking-wider text-slate-700 dark:text-[#a0c5b5] mb-2">
                    Kategori Pola
                </label>
                <select id="category_id" 
                        name="category_id" 
                        required
                        class="w-full rounded-xl border border-slate-200 dark:border-[#1e382c] bg-white dark:bg-[#0c1813] px-4 py-3 text-sm text-slate-900 dark:text-[#d0e2d9] focus:border-[#c9f28a] focus:outline-none focus:ring-1 focus:ring-[#c9f28a] transition">
                    <option value="">Pilih kategori yang sesuai...</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id', $discussion->category_id) == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="mt-1.5 text-xs text-rose-500 dark:text-rose-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Body Content --}}
            <div>
                <label for="body" class="block text-xs font-mono font-bold uppercase tracking-wider text-slate-700 dark:text-[#a0c5b5] mb-2">
                    Kronologi & Informasi Penting
                </label>
                <textarea
                    id="body"
                    name="body"
                    rows="8"
                    minlength="30"
                    maxlength="10000"
                    required
                    class="w-full rounded-xl border border-slate-200 dark:border-[#1e382c] bg-white dark:bg-[#0c1813] px-4 py-3 text-sm text-slate-900 dark:text-white placeholder:text-slate-400 dark:placeholder:text-[#526f62] focus:border-[#c9f28a] focus:outline-none focus:ring-1 focus:ring-[#c9f28a] transition resize-y leading-relaxed"
                >{{ old('body', $discussion->body) }}</textarea>
                <div class="mt-2 text-[11px] text-slate-500 dark:text-[#6d8d7e]">
                    Minimal 30 karakter. Demi keamanan, jangan mempublikasikan nomor KTP, nomor rekening orang lain, kata sandi, atau kode OTP.
                </div>
                @error('body')
                    <p class="mt-1.5 text-xs text-rose-500 dark:text-rose-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Action Buttons --}}
            <div class="flex items-center gap-4 pt-2">
                <x-button variant="lime" type="submit">
                    Simpan Perubahan
                </x-button>
                <x-button variant="outline" href="{{ route('forum.show', $discussion->slug) }}">
                    Batal
                </x-button>
            </div>
        </form>
    </x-card>

</div>
@endsection
