<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\AssessmentQuestion;
use App\Models\Discussion;
use App\Models\Pattern;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $stats = [
            'total_assessments' => Assessment::count(),
            'total_patterns' => Pattern::count(),
            'total_discussions' => Discussion::where('status', 'published')->count(),
            'total_indicators' => AssessmentQuestion::where('is_active', true)->count(),
        ];

        $latestDiscussions = Discussion::query()
            ->where('status', 'published')
            ->with(['category', 'user'])
            ->withCount(['comments', 'votes'])
            ->latest()
            ->take(3)
            ->get();

        $patterns = Pattern::query()
            ->with('indicators')
            ->latest()
            ->take(3)
            ->get();

        return view('home', compact('stats', 'latestDiscussions', 'patterns'));
    }
}
