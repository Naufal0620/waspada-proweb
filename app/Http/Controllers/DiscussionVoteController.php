<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use App\Models\DiscussionVote;
use Illuminate\Http\Request;

class DiscussionVoteController extends Controller
{
    public function toggle(Request $request, string $slug)
    {
        $discussion = Discussion::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        $vote = DiscussionVote::where('discussion_id', $discussion->id)
            ->where('user_id', $request->user()->id)
            ->first();

        if ($vote) {
            $vote->delete();
            $message = 'Vote berhasil dibatalkan.';
        } else {
            DiscussionVote::create([
                'discussion_id' => $discussion->id,
                'user_id' => $request->user()->id,
            ]);

            $message = 'Vote berhasil ditambahkan.';
        }

        return redirect()
            ->route('forum.show', $discussion->slug)
            ->with('success', $message);
    }
}
