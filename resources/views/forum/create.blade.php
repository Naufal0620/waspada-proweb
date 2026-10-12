@extends('layouts.app')

@section('title', 'Buat Diskusi Baru — WASPADA')

@section('content')
<div class="py-10 max-w-3xl mx-auto px-4 sm:px-6">

    <div class="mb-6">
        <x-button variant="outline" size="sm" href="{{ route('forum.index') }}">
            ← Kembali ke Forum
        </x-button>
    </div>

    <x-card variant="elevated">
        <x-badge variant="lime" class="mb-3">
            KONTRIBUSI KOMUNITAS
        </x-badge>
        
        <h1 class="text-2xl sm:text-3xl font-bold text-white tracking-tight mb-2">
            Bagikan Pengalaman / Modus Baru
        </h1>
        <p class="text-xs sm:text-sm text-[#8ba89b] mb-8 leading-relaxed">
            Pengalaman yang Anda bagikan dapat menjadi penyelamat orang lain dari jebakan penipuan digital.
        </p>

        <form action="{{ route('forum.store') }}" method="POST" class="space-y-6">
            @csrf

            {{-- Title Input --}}
            <div>
                <label for="title" class="block text-xs font-mono font-bold uppercase tracking-wider text-[#a0c5b5] mb-2">
                    Judul Diskusi
                </label>
                <input
                    id="title"
                    name="title"
                    type="text"
                    maxlength="200"
                    minlength="10"
                    required
                    value="{{ old('title') }}"
                    placeholder="Contoh: Modus tawaran kerja paruh waktu via Telegram meminta deposit"
                    class="w-full rounded-xl border border-[#1e382c] bg-[#0c1813] px-4 py-3 text-sm text-white placeholder:text-[#526f62] focus:border-[#c9f28a] focus:outline-none focus:ring-1 focus:ring-[#c9f28a] transition"
                >
                @error('title')
                    <p class="mt-1.5 text-xs text-rose-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Category Select --}}
            <div>
                <label for="category_id" class="block text-xs font-mono font-bold uppercase tracking-wider text-[#a0c5b5] mb-2">
                    Kategori Pola
                </label>
                <select id="category_id" 
                        name="category_id" 
                        required
                        class="w-full rounded-xl border border-[#1e382c] bg-[#0c1813] px-4 py-3 text-sm text-[#d0e2d9] focus:border-[#c9f28a] focus:outline-none focus:ring-1 focus:ring-[#c9f28a] transition">
                    <option value="">Pilih kategori yang sesuai...</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="mt-1.5 text-xs text-rose-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Body Content --}}
            <div>
                <label for="body" class="block text-xs font-mono font-bold uppercase tracking-wider text-[#a0c5b5] mb-2">
                    Kronologi & Informasi Penting
                </label>
                <textarea
                    id="body"
                    name="body"
                    rows="8"
                    minlength="30"
                    maxlength="10000"
                    required
                    placeholder="Ceritakan detail situasinya: bagaimana mereka menghubungi, syarat mencurigakan apa yang diajukan, nomor rekening/kontak (sensor data pribadi), serta saran pencegahan..."
                    class="w-full rounded-xl border border-[#1e382c] bg-[#0c1813] px-4 py-3 text-sm text-white placeholder:text-[#526f62] focus:border-[#c9f28a] focus:outline-none focus:ring-1 focus:ring-[#c9f28a] transition resize-y leading-relaxed"
                >{{ old('body') }}</textarea>
                <div class="mt-2 text-[11px] text-[#6d8d7e]">
                    Minimal 30 karakter. Demi keamanan, jangan mempublikasikan nomor KTP, foto selfie pribadi, kata sandi, atau kode OTP Anda.
                </div>
                @error('body')
                    <p class="mt-1.5 text-xs text-rose-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Moderation Notice --}}
            <x-alert type="warning">
                <strong>Ketentuan Moderasi:</strong> Laporan atau diskusi akan melalui tinjauan moderator sebelum terbit untuk menyaring konten hoax, fitnah tanpa dasar, maupun pelanggaran privasi.
            </x-alert>

            {{-- Action Buttons --}}
            <div class="flex items-center gap-4 pt-2">
                <x-button variant="lime" type="submit">
                    Kirim untuk Ditinjau Moderator
                </x-button>
                <x-button variant="outline" href="{{ route('forum.index') }}">
                    Batal
                </x-button>
            </div>
        </form>
    </x-card>

</div>
@endsection
