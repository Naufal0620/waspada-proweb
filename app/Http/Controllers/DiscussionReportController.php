<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use App\Models\DiscussionReport;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DiscussionReportController extends Controller
{
    public function store(Request $request, string $slug)
    {
        $discussion = Discussion::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        $validated = $request->validate([
            'reason' => [
                'required',
                'string',
                Rule::in([
                    'Informasi menyesatkan',
                    'Dugaan penipuan',
                    'Spam',
                    'Data pribadi',
                    'Pelecehan',
                    'Lainnya',
                ]),
            ],
            'details' => ['nullable', 'string', 'max:2000'],
        ]);

        $alreadyReported = DiscussionReport::where(
            'discussion_id',
            $discussion->id
        )
            ->where('reporter_id', $request->user()->id)
            ->whereIn('status', ['pending', 'reviewed', 'actioned'])
            ->exists();

        if ($alreadyReported) {
            return back()->withErrors([
                'reason' => 'Kamu sudah melaporkan diskusi ini.',
            ]);
        }

        DiscussionReport::create([
            'discussion_id' => $discussion->id,
            'reporter_id' => $request->user()->id,
            'reason' => $validated['reason'],
            'details' => $validated['details'] ?? null,
        ]);

        return back()->with(
            'success',
            'Laporan berhasil dikirim untuk ditinjau moderator.'
        );
    }
}
