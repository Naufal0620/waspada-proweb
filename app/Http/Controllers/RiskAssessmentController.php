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
        $questions = \App\Models\AssessmentQuestion::query()
            ->where('is_active', true)
            ->with('options')
            ->orderBy('sort_order')
            ->get();

        return view('assessments.create', compact('questions'));
    }

    /**
     * Memproses penilaian risiko berdasarkan indikator pilihan pengguna.
     */
   
    public function store(
        \Illuminate\Http\Request $request,
        \App\Services\RiskAssessmentService $service
    ) {
        $validated = $request->validate([
            'answers' => ['required', 'array', 'min:1'],
            'answers.*' => ['required', 'integer'],
        ]);

        $assessment = $service->assess($validated['answers']);

        $matchedPatterns = $assessment->matchedPatterns;

        return view('assessments.result', [
            'assessment' => $assessment->load('answers.question', 'answers.option', 'indicators'),
            'matchedPatterns' => $matchedPatterns,
        ]);
    }

}
