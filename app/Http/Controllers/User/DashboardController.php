<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($user->role === 'moderator') {
            return redirect()->route('moderator.dashboard');
        }

        $assessments = $user->assessments()
            ->with(['indicators'])
            ->withCount('answers')
            ->latest()
            ->paginate(5, ['*'], 'assessments_page');

        $discussions = $user->discussions()
            ->with('category')
            ->withCount(['comments', 'votes'])
            ->latest()
            ->paginate(5, ['*'], 'discussions_page');

        $stats = [
            'total_assessments' => $user->assessments()->count(),
            'high_risk_assessments' => $user->assessments()->where('risk_level', 'high')->count(),
            'warning_assessments' => $user->assessments()->where('risk_level', 'warning')->count(),
            'total_discussions' => $user->discussions()->count(),
            'total_comments' => $user->discussionComments()->count(),
        ];

        return view('user.dashboard', compact('user', 'assessments', 'discussions', 'stats'));
    }
}
