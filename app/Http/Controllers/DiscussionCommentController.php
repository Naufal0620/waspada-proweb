<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use App\Models\DiscussionComment;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DiscussionCommentController extends Controller
{
    public function store(Request $request, string $slug)
    {
        $discussion = Discussion::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        $validated = $request->validate([
            'body' => ['required', 'string', 'min:2', 'max:3000'],

            'parent_id' => [
                'nullable',
                'integer',
                Rule::exists('discussion_comments', 'id')
                    ->where('discussion_id', $discussion->id)
                    ->where('status', 'published'),
            ],
        ]);

        DiscussionComment::create([
            'discussion_id' => $discussion->id,
            'user_id' => $request->user()->id,
            'parent_id' => $validated['parent_id'] ?? null,
            'body' => $validated['body'],
        ]);

        return redirect()
            ->route('forum.show', $discussion->slug)
            ->with('success', 'Komentar berhasil ditambahkan.');
    }

    public function update(Request $request, string $slug, DiscussionComment $comment)
    {
        $this->authorize('update', $comment);

        $validated = $request->validate([
            'body' => ['required', 'string', 'min:2', 'max:3000'],
        ]);

        $comment->update([
            'body' => $validated['body'],
        ]);

        return redirect()
            ->route('forum.show', $slug)
            ->with('success', 'Komentar berhasil diperbarui.');
    }

    public function destroy(Request $request, string $slug, DiscussionComment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return redirect()
            ->route('forum.show', $slug)
            ->with('success', 'Komentar berhasil dihapus.');
    }
}
