<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Discussion;
use App\Models\DiscussionReport;
use App\Models\Pattern;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();

        $totalDiscussions = Discussion::count();

        $pendingDiscussions = Discussion::where(
            'status',
            'pending'
        )->count();

        $totalReports = DiscussionReport::count();

        $pendingReports = DiscussionReport::where(
            'status',
            'pending'
        )->count();

        $totalPatterns = Pattern::count();

        $totalAssessments = \App\Models\Assessment::count();
        $highRiskAssessments = \App\Models\Assessment::where('risk_level', 'high')->count();
        
        $latestDiscussions = Discussion::latest()
            ->take(5)
            ->get();

        $latestReports = DiscussionReport::with('discussion')
            ->latest()
            ->take(5)
            ->get();

        $latestAssessments = \App\Models\Assessment::with('user', 'indicators')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalDiscussions',
            'pendingDiscussions',
            'totalReports',
            'pendingReports',
            'totalPatterns',
            'totalAssessments',
            'highRiskAssessments',
            'latestDiscussions',
            'latestReports',
            'latestAssessments'
        ));

    }
}
