<?php

namespace App\Http\Controllers;

use App\Models\Indicator;
use App\Services\RiskAssessmentService;
use Illuminate\Http\Request;

class RiskAssessmentController extends Controller
{
    public function create()
    {
        $indicators = Indicator::query()
            ->where('is_active', true)
            ->orderBy('category')
            ->orderBy('label')
            ->get();

        return view('assessments.create', compact('indicators'));
    }

    public function store(
        Request $request,
        RiskAssessmentService $service
    ) {
        $validated = $request->validate([
            'indicators' => ['required', 'array', 'min:1'],
            'indicators.*' => [
                'required',
                'integer',
                'distinct',
                'exists:indicators,id',
            ],
        ]);

        $assessment = $service->assess(
            $validated['indicators']
        );

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Penilaian risiko berhasil dilakukan.',
                'data' => [
                    'id' => $assessment->id,
                    'session_id' => $assessment->session_id,
                    'risk_level' => $assessment->risk_level,
                    'indicators' => $assessment->indicators,
                ],
            ], 201);
        }

        return view('assessments.result', compact('assessment'));
    }
}
