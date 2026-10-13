<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use App\Models\ForumCategory;
use Illuminate\Http\Request;

class DiscussionController extends Controller
{
    public function index(Request $request)
    {
        $discussions = Discussion::query()
            ->where('status', 'published')
            ->with(['user', 'category'])
            ->withCount([
                'comments' => fn ($query) =>
                    $query->where('status', 'published'),
                'votes',
            ])
            ->when($request->filled('q'), function ($query) use ($request) {
                $search = $request->string('q')->trim()->toString();

                $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', "%{$search}%")
                        ->orWhere('body', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('category'), function ($query) use ($request) {
                $query->whereHas('category', function ($query) use ($request) {
                    $query->where('slug', $request->input('category'));
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $categories = ForumCategory::orderBy('name')->get();

        return view('forum.index', compact('discussions', 'categories'));
    }

    public function show(string $slug)
    {
        $discussion = Discussion::query()
            ->where('slug', $slug)
            ->where('status', 'published')
            ->with([
                'user',
                'category',
                'comments' => fn ($query) => $query
                    ->where('status', 'published')
                    ->whereNull('parent_id')
                    ->with([
                        'user',
                        'replies' => fn ($replies) => $replies
                            ->where('status', 'published')
                            ->with('user'),
                    ]),
            ])
            ->withCount('votes')
            ->firstOrFail();

        return view('forum.show', compact('discussion'));
    }

    public function edit(Discussion $discussion)
    {
        $this->authorize('update', $discussion);

        $categories = ForumCategory::orderBy('name')->get();

        return view('forum.edit', compact('discussion', 'categories'));
    }

    public function update(Request $request, Discussion $discussion)
    {
        $this->authorize('update', $discussion);

        $validated = $request->validate([
            'title' => ['required', 'string', 'min:10', 'max:200'],
            'category_id' => ['required', 'integer', 'exists:forum_categories,id'],
            'body' => ['required', 'string', 'min:30', 'max:10000'],
        ]);

        $discussion->update([
            'title' => $validated['title'],
            'category_id' => $validated['category_id'],
            'body' => $validated['body'],
        ]);

        return redirect()
            ->route('forum.show', $discussion->slug)
            ->with('success', 'Diskusi berhasil diperbarui.');
    }

    public function destroy(Discussion $discussion)
    {
        $this->authorize('delete', $discussion);

        $discussion->delete();

        return redirect()
            ->route('forum.index')
            ->with('success', 'Diskusi berhasil dihapus.');
    }
}
