@extends('layouts.app')

@section('title', 'Pemeriksaan Risiko Penipuan Online — WASPADA')

@section('content')

    <div class="py-10 max-w-4xl mx-auto px-4 sm:px-6">

        {{-- Header Breadcrumb & Back --}}
        <div class="mb-6 flex items-center justify-between">
            <x-button variant="outline" size="sm" href="{{ route('home') }}">
                ← Kembali ke Beranda
            </x-button>

            <span class="text-xs font-mono text-slate-500 dark:text-[#7d9b8e]">
                Engine: Heuristic Detection v1.2
            </span>
        </div>

        {{-- Section Title Card --}}
        <div class="text-center max-w-2xl mx-auto mb-8">
            <div
                class="inline-flex items-center gap-2 rounded-full border border-slate-200 dark:border-[#21382e] bg-white dark:bg-[#12211b] px-3.5 py-1 text-[11px] font-mono text-emerald-700 dark:text-[#c9f28a] mb-4 shadow-sm">
                <span>MODUL SKRINING RISIKO KEAMANAN</span>
            </div>
            <h1 class="text-2xl sm:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                Pemeriksaan Potensi Risiko
            </h1>
            <p class="mt-3 text-xs sm:text-sm text-slate-600 dark:text-[#8ca89b] leading-relaxed">
                Jawab pertanyaan berikut berdasarkan situasi atau kontak yang Anda alami. Sistem akan mencocokkannya dengan pola penipuan terdaftar secara anonim.
            </p>
        </div>

        {{-- Assessment Form --}}
        <form id="assessment-form" action="{{ route('assessments.store') }}" method="POST">
            @csrf

            <div
                class="rounded-3xl border border-slate-200 dark:border-[#1f372c] bg-white dark:bg-[#101e18] p-6 sm:p-10 shadow-lg dark:shadow-[0_20px_50px_rgba(0,0,0,0.6)]">

                {{-- Header --}}
                <div
                    class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-slate-100 dark:border-[#1b3127]">
                    <div class="flex items-center gap-3">
                        <div
                            class="h-8 w-8 rounded-lg bg-emerald-50 dark:bg-[#182f25] border border-emerald-200 dark:border-[#2c5341] flex items-center justify-center text-emerald-700 dark:text-[#c9f28a]">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>

                        <div>
                            <h3 class="text-base font-bold text-slate-900 dark:text-white">
                                Kuesioner Indikator
                            </h3>
                            <p class="text-xs text-slate-500 dark:text-[#7d9b8e]">
                                Pilih jawaban yang paling sesuai dengan kejadian riil
                            </p>
                        </div>
                    </div>

                    <span
                        class="self-start sm:self-auto text-xs px-3 py-1 rounded-md bg-slate-100 dark:bg-[#162a21] border border-slate-200 dark:border-[#264939] text-emerald-800 dark:text-[#c9f28a] font-mono">
                        {{ $questions->count() }} Pertanyaan
                    </span>
                </div>

                {{-- Error Alert --}}
                @if ($errors->any())
                    <div class="mt-6 rounded-xl border border-rose-500/40 bg-rose-50 dark:bg-rose-950/40 p-4 text-xs text-rose-700 dark:text-rose-300"
                        role="alert">
                        {{ $errors->first('answers') ?? 'Periksa kembali jawaban kamu.' }}
                    </div>
                @endif

                {{-- Questions List --}}
                <div id="question-container" class="mt-6 space-y-4">
                    @foreach ($questions as $index => $question)
                        <div class="assessment-question rounded-2xl border border-slate-200/80 dark:border-[#1a3328] bg-slate-50/50 dark:bg-[#0c1813] p-5 transition-colors"
                            data-question-id="{{ $question->id }}" data-category="{{ $question->category }}"
                            data-core="{{ $question->is_core ? '1' : '0' }}">

                            <div class="flex items-start gap-3">
                                <span
                                    class="flex-shrink-0 inline-flex items-center justify-center h-6 w-6 rounded-full bg-slate-200 dark:bg-[#162b21] text-[11px] font-mono font-bold text-slate-700 dark:text-[#a5cbb9]">
                                    {{ $index + 1 }}
                                </span>

                                <div class="flex-1">
                                    <p class="text-sm font-semibold text-slate-900 dark:text-[#e4eee9] leading-snug">
                                        {{ $question->question_text }}
                                    </p>

                                    @if ($question->is_core)
                                        <span class="inline-block mt-1 font-mono text-[10px] text-emerald-700 dark:text-[#c9f28a] uppercase tracking-wider font-bold">
                                            [Pertanyaan Inti]
                                        </span>
                                    @endif

                                    <div class="mt-4 flex flex-wrap gap-2.5">
                                        @foreach ($question->options as $option)
                                            <label
                                                class="cursor-pointer inline-flex items-center gap-2 px-3.5 py-2 rounded-xl border border-slate-200 dark:border-[#1d382c] bg-white dark:bg-[#11211a] text-xs font-medium text-slate-700 dark:text-[#b7d3c6] hover:border-emerald-500 dark:hover:border-[#c9f28a] hover:bg-slate-50 dark:hover:bg-[#162920] has-[:checked]:border-emerald-600 dark:has-[:checked]:border-[#c9f28a] has-[:checked]:bg-emerald-50 dark:has-[:checked]:bg-[#183124] has-[:checked]:text-emerald-950 dark:has-[:checked]:text-[#c9f28a] transition shadow-sm">
                                                <input type="radio" name="answers[{{ $question->id }}]"
                                                    value="{{ $option->id }}" data-value="{{ $option->value }}"
                                                    class="sr-only" required>
                                                <span>{{ $option->label }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Footer Info & Submit --}}
                <div class="mt-8 pt-6 border-t border-slate-100 dark:border-[#1b3127] flex flex-col sm:flex-row items-center justify-between gap-4">
                    <p id="question-progress" class="text-xs text-slate-500 dark:text-[#7d9b8e] font-mono">
                        Jawab sesuai situasi yang Anda alami.
                    </p>

                    <x-button variant="lime" type="submit" class="w-full sm:w-auto px-8 py-3">
                        <span>Analisis Risiko Sekarang</span>
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </x-button>
                </div>

            </div>
        </form>

        {{-- Privacy Disclaimer Note --}}
        <div class="mt-6 text-center text-xs text-slate-400 dark:text-[#678275]">
            <p>100% Bebas Pelacakan • Data masukan hanya diproses di memori kalkulasi dan tidak disebarluaskan.</p>
        </div>

    </div>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('assessment-form');
            if (!form) return;

            const questions = [
                ...form.querySelectorAll('.assessment-question')
            ];

            function answerValue(category) {
                const question = questions.find(
                    item => item.dataset.category === category
                );

                return question?.querySelector('input:checked')
                    ?.dataset.value ?? null;
            }

            function updateQuestions() {
                const rules = {
                    link: () => answerValue('identity') !== null ||
                        answerValue('credential') !== null,
                    prize: () => answerValue('identity') !== null ||
                        answerValue('urgency') !== null,
                    payment: () => answerValue('prize') === 'yes' ||
                        answerValue('identity') === 'yes' ||
                        answerValue('urgency') === 'yes',
                };

                questions.forEach(question => {
                    const category = question.dataset.category;
                    const isCore = question.dataset.core === '1';

                    const shouldShow = isCore ||
                        (rules[category]?.() ?? false);

                    question.hidden = !shouldShow;

                    question.querySelectorAll('input').forEach(input => {
                        input.required = shouldShow;
                        input.disabled = !shouldShow;

                        if (!shouldShow) {
                            input.checked = false;
                        }
                    });
                });

                const visible = questions.filter(q => !q.hidden).length;
                const progress = document.getElementById('question-progress');

                if (progress) {
                    progress.textContent =
                        `${visible} pertanyaan ditampilkan. Jawab sesuai keadaan sebenarnya.`;
                }
            }

            form.addEventListener('change', updateQuestions);

            form.addEventListener('submit', function(event) {
                const visibleQuestions = questions.filter(q => !q.hidden);
                const unanswered = visibleQuestions.some(
                    q => !q.querySelector('input:checked')
                );

                if (unanswered) {
                    event.preventDefault();
                    alert('Silakan jawab semua pertanyaan yang ditampilkan.');
                }
            });

            updateQuestions();
        });
    </script>
@endpush
