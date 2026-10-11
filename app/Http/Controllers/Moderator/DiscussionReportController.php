<?php

namespace App\Http\Controllers\Moderator;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\DiscussionReport;
use Illuminate\Http\Request;

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

        return view('moderator.reports.index', compact('reports'));
    }

    public function show(int $id)
    {
        $report = DiscussionReport::with([
                'discussion',
                'reporter',
                'reviewer',
            ])
            ->findOrFail($id);

        return view('moderator.reports.show', compact('report'));
    }

    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'status' => [
                'required',
                'string',
                \Illuminate\Validation\Rule::in([
                    'reviewed',
                    'dismissed',
                    'actioned',
                ]),
            ],
        ]);

        $report = DiscussionReport::with('discussion')->findOrFail($id);

        if (!in_array($report->status, ['pending', 'reviewed'])) {
            return back()->withErrors([
                'status' => 'Laporan ini sudah selesai diproses.',
            ]);
        }

        if (
            $validated['status'] === 'reviewed'
            && $report->status !== 'pending'
        ) {
            return back()->withErrors([
                'status' => 'Laporan ini sudah ditinjau.',
            ]);
        }

        DB::transaction(function () use ($report, $validated, $request) {
            if ($validated['status'] === 'actioned') {
                $discussion = $report->discussion;

                $discussion->status = 'hidden';
                $discussion->save();
            }

            $report->status = $validated['status'];
            $report->reviewed_by = $request->user()->id;
            $report->reviewed_at = now();
            $report->save();
        });

        return redirect()
            ->route('moderator.reports.show', $report->id)
            ->with('success', 'Laporan berhasil diproses.');
    }


}
