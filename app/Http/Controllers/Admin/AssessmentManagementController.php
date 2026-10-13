<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Assessment;
use Illuminate\Http\Request;

class AssessmentManagementController extends Controller
{
    public function index(Request $request)
    {
        $query = Assessment::query()
            ->with(['user', 'indicators'])
            ->withCount('answers');

        if ($request->filled('risk_level')) {
            $query->where('risk_level', $request->input('risk_level'));
        }

        if ($request->filled('user_type')) {
            if ($request->input('user_type') === 'registered') {
                $query->whereNotNull('user_id');
            } elseif ($request->input('user_type') === 'guest') {
                $query->whereNull('user_id');
            }
        }

        if ($request->filled('q')) {
            $search = trim($request->input('q'));
            $query->where(function ($q) use ($search) {
                $q->where('session_id', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($uq) use ($search) {
                        $uq->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    });
            });
        }

        $assessments = $query->latest()->paginate(15)->withQueryString();

        $stats = [
            'total' => Assessment::count(),
            'high' => Assessment::where('risk_level', 'high')->count(),
            'warning' => Assessment::where('risk_level', 'warning')->count(),
            'low' => Assessment::where('risk_level', 'low')->count(),
            'registered' => Assessment::whereNotNull('user_id')->count(),
            'guest' => Assessment::whereNull('user_id')->count(),
        ];

        return view('admin.assessments.index', compact('assessments', 'stats'));
    }

    public function show(Assessment $assessment)
    {
        $assessment->load(['user', 'indicators', 'answers.question', 'answers.option']);
        $matchedPatterns = $assessment->matchedPatterns;

        return view('admin.assessments.show', compact('assessment', 'matchedPatterns'));
    }
}
