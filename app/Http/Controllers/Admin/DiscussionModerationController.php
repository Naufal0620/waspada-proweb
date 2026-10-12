<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Discussion;
use Illuminate\Support\Facades\DB;

class DiscussionModerationController extends Controller
{
    public function index()
    {
        $discussions = Discussion::with(['user', 'category'])
            ->where('status', 'pending')
            ->latest()
            ->paginate(10);

        return view(
            'admin.discussions.index',
            compact('discussions')
        );
    }

    public function show(int $id)
    {
        $discussion = Discussion::with(['user', 'category'])
            ->findOrFail($id);

        return view(
            'admin.discussions.show',
            compact('discussion')
        );
    }

    public function approve(int $id)
    {
        $result = DB::transaction(function () use ($id) {
            $discussion = Discussion::whereKey($id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($discussion->status !== 'pending') {
                return false;
            }

            $discussion->status = 'published';
            $discussion->save();

            return true;
        });

        if (!$result) {
            return back()->withErrors([
                'discussion' => 'Postingan ini sudah tidak menunggu persetujuan.',
            ]);
        }

        return redirect()
            ->route('admin.discussions.index')
            ->with('success', 'Postingan berhasil disetujui dan dipublikasikan.');
    }

    public function reject(int $id)
    {
        $result = DB::transaction(function () use ($id) {
            $discussion = Discussion::whereKey($id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($discussion->status !== 'pending') {
                return false;
            }

            $discussion->status = 'rejected';
            $discussion->save();

            return true;
        });

        if (!$result) {
            return back()->withErrors([
                'discussion' => 'Postingan ini sudah tidak menunggu persetujuan.',
            ]);
        }

        return redirect()
            ->route('admin.discussions.index')
            ->with('success', 'Postingan berhasil ditolak.');
    }
}