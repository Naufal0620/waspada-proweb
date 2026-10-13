<?php

namespace App\Http\Controllers;

use App\Services\RiskAssessmentService;
use Illuminate\Http\Request;

class RiskAssessmentController extends Controller
{
    /**
     * Menampilkan halaman pemeriksaan risiko.
     */
    public function create()
    {
        $questions = \App\Models\AssessmentQuestion::query()
            ->where('is_active', true)
            ->with('options')
            ->orderBy('sort_order')
            ->get();

        return view('assessments.create', compact('questions'));
    }

    /**
     * Memproses penilaian risiko.
     *
     * Mendukung dua format request:
     * - Web (form): POST dengan field `answers` berupa {question_id: option_id}
     * - API (JSON): POST dengan field `indicators` berupa array of indicator IDs
     */
    public function store(Request $request, RiskAssessmentService $service)
    {
        // Mode API: request JSON dengan field 'indicators'
        if ($request->wantsJson() || $request->has('indicators')) {
            return $this->storeApi($request, $service);
        }

        // Mode Web: form Q&A dengan field 'answers'
        return $this->storeWeb($request, $service);
    }

    /**
     * Handler untuk POST JSON dengan `indicators` (API / test).
     */
    private function storeApi(Request $request, RiskAssessmentService $service)
    {
        $validated = $request->validate([
            'indicators'   => ['required', 'array', 'min:1'],
            'indicators.*' => ['required', 'integer', 'exists:indicators,id', 'distinct'],
        ]);

        // Pastikan semua indikator yang dipilih aktif
        $indicatorIds = $validated['indicators'];
        $activeCount = \App\Models\Indicator::whereIn('id', $indicatorIds)
            ->where('is_active', true)
            ->count();

        if ($activeCount !== count(array_unique($indicatorIds))) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'indicators' => ['Salah satu atau lebih indikator tidak aktif.'],
            ]);
        }

        $assessment = $service->assessFromIndicators(
            $validated['indicators'],
            $request->user()?->id
        );

        return response()->json([
            'data' => [
                'risk_level'      => $assessment->risk_level,
                'matched_patterns' => $assessment->matchedPatterns->map(fn ($p) => [
                    'name'       => $p->name,
                    'risk_level' => $p->risk_level,
                ]),
            ],
        ], 201);
    }

    /**
     * Handler untuk POST form Q&A dengan `answers` (web).
     */
    private function storeWeb(Request $request, RiskAssessmentService $service)
    {
        $validated = $request->validate([
            'answers'   => ['required', 'array', 'min:1'],
            'answers.*' => ['required', 'integer'],
        ]);

        $assessment = $service->assess($validated['answers'], $request->user()?->id);

        $matchedPatterns = $assessment->matchedPatterns;

        return view('assessments.result', [
            'assessment'      => $assessment->load('answers.question', 'answers.option', 'indicators'),
            'matchedPatterns' => $matchedPatterns,
        ]);
    }

    /**
     * Menampilkan riwayat hasil penilaian risiko spesifik.
     */
    public function show(Request $request, \App\Models\Assessment $assessment)
    {
        // Hanya pemilik assessment yang bisa melihat (jika user login)
        if ($assessment->user_id && $assessment->user_id !== $request->user()?->id) {
            abort(403);
        }

        $matchedPatterns = \App\Models\Pattern::query()
            ->with('indicators')
            ->get()
            ->filter(function ($pattern) use ($assessment) {
                $patternIndicatorIds = $pattern->indicators
                    ->where('is_active', true)
                    ->modelKeys();

                if (count($patternIndicatorIds) < 2) {
                    return false;
                }

                $assessmentIndicatorIds = $assessment->indicators->modelKeys();
                $matchedCount = count(array_intersect($patternIndicatorIds, $assessmentIndicatorIds));

                return $matchedCount >= 2;
            })
            ->values();

        return view('assessments.result', [
            'assessment'      => $assessment->load('answers.question', 'answers.option', 'indicators'),
            'matchedPatterns' => $matchedPatterns,
        ]);
    }
}
