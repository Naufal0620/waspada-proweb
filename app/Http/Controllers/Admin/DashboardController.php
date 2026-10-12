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

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalDiscussions',
            'pendingDiscussions',
            'totalReports',
            'pendingReports',
            'totalPatterns'
        ));
    }
}
