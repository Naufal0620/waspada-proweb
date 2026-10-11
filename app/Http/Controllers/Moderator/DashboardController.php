<?php

namespace App\Http\Controllers\Moderator;

use App\Http\Controllers\Controller;
use App\Models\Discussion;
use App\Models\DiscussionReport;

class DashboardController extends Controller
{
    public function index()
    {
        $pendingDiscussions = Discussion::where('status', 'pending')
            ->count();

        $pendingReports = DiscussionReport::where('status', 'pending')
            ->count();

        $publishedDiscussions = Discussion::where('status', 'published')
            ->count();

        $latestReports = DiscussionReport::with([
                'discussion',
                'reporter',
            ])
            ->where('status', 'pending')
            ->latest()
            ->take(5)
            ->get();

        return view('moderator.dashboard', compact(
            'pendingDiscussions',
            'pendingReports',
            'publishedDiscussions',
            'latestReports'
        ));
    }
}
