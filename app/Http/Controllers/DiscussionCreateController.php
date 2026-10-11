<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use App\Models\ForumCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class DiscussionCreateController extends Controller
{
    public function create()
    {
        $categories = ForumCategory::orderBy('name')->get();

        return view('forum.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'min:10', 'max:200'],
            'category_id' => [
                'required',
                'integer',
                Rule::exists('forum_categories', 'id'),
            ],
            'body' => ['required', 'string', 'min:30', 'max:10000'],
        ]);

        $baseSlug = Str::slug($validated['title']);

        if ($baseSlug === '') {
            $baseSlug = 'diskusi';
        }

        do {
            $slug = $baseSlug . '-' . Str::lower(Str::random(8));
        } while (Discussion::where('slug', $slug)->exists());

        $discussion = Discussion::create([
            'user_id' => $request->user()->id,
            'category_id' => $validated['category_id'],
            'title' => $validated['title'],
            'slug' => $slug,
            'body' => $validated['body'],
            'status' => 'pending',
        ]);

        return redirect()
            ->route('forum.index')
            ->with(
                'success',
                'Diskusi berhasil dikirim dan sedang menunggu peninjauan moderator.'
            );
    }
}
