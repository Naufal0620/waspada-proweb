<?php

namespace App\Http\Controllers;

use App\Models\Indicator;
use App\Services\RiskAssessmentService;
use Illuminate\Http\Request;

class RiskAssessmentController extends Controller
{
    /**
     * Menampilkan halaman pemeriksaan risiko.
     */
    public function create()
    {
        $indicators = Indicator::query()
            ->where('is_active', true)
            ->orderBy('category')
            ->orderBy('label')
            ->get();

        return view('assessments.create', compact('indicators'));
    }

    /**
     * Memproses penilaian risiko berdasarkan indikator pilihan pengguna.
     */
    public function store(
        Request $request,
        RiskAssessmentService $service
    ) {
        $validated = $request->validate([
            'indicators' => [
                'required',
                'array',
                'min:1',
            ],
            'indicators.*' => [
                'required',
                'integer',
                'distinct',
                'exists:indicators,id',
            ],
        ]);

        // Hitung tingkat risiko dan pola yang cocok.
        $assessment = $service->assess(
            $validated['indicators']
        );

        // Respons JSON untuk API atau permintaan AJAX.
        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Penilaian risiko berhasil dilakukan.',
                'data' => [
                    'id' => $assessment->id,
                    'session_id' => $assessment->session_id,
                    'risk_level' => $assessment->risk_level,

                    'indicators' => $assessment->indicators,

                    'matched_patterns' => $assessment
                        ->matchedPatterns
                        ->map(fn ($pattern) => [
                            'name' => $pattern->name,
                            'description' => $pattern->description,
                            'risk_level' => $pattern->risk_level,
                        ])
                        ->values(),
                ],
            ], 201);
        }

        // Tampilkan halaman hasil untuk pengguna web biasa.
        return view('assessments.result', [
            'assessment' => $assessment,
            'matchedPatterns' => $assessment->matchedPatterns,
        ]);
    }
}
