<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DiscussionReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class DiscussionReportController extends Controller
{
    public function index(Request $request)
    {
        $reports = DiscussionReport::with([
            'discussion',
            'reporter',
            'reviewer',
        ])
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->input('status'));
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.reports.index', compact('reports'));
    }

    public function show(int $id)
    {
        $report = DiscussionReport::with([
            'discussion',
            'reporter',
            'reviewer',
        ])->findOrFail($id);

        return view('admin.reports.show', compact('report'));
    }

    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'status' => [
                'required',
                'string',
                Rule::in(['reviewed', 'dismissed', 'actioned']),
            ],
        ]);

        $result = DB::transaction(function () use ($id, $validated, $request) {
            $report = DiscussionReport::with('discussion')
                ->lockForUpdate()
                ->findOrFail($id);

            if (!in_array($report->status, ['pending', 'reviewed'], true)) {
                return 'completed';
            }

            if (
                $validated['status'] === 'reviewed'
                && $report->status !== 'pending'
            ) {
                return 'already_reviewed';
            }

            if (
                $validated['status'] === 'actioned'
                && !$report->discussion
            ) {
                return 'discussion_missing';
            }

            if ($validated['status'] === 'actioned') {
                $report->discussion->status = 'hidden';
                $report->discussion->save();
            }

            $report->status = $validated['status'];
            $report->reviewed_by = $request->user()->id;
            $report->reviewed_at = now();
            $report->save();

            return 'success';
        });

        if ($result !== 'success') {
            $messages = [
                'completed' => 'Laporan ini sudah selesai diproses.',
                'already_reviewed' => 'Laporan ini sudah ditinjau.',
                'discussion_missing' => 'Diskusi terkait tidak tersedia.',
            ];

            return back()->withErrors([
                'status' => $messages[$result],
            ]);
        }

        return redirect()
            ->route('admin.reports.show', $id)
            ->with('success', 'Laporan berhasil diproses.');
    }
}
