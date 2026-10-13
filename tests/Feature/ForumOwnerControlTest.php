<?php

namespace Tests\Feature;

use App\Models\Discussion;
use App\Models\DiscussionComment;
use App\Models\ForumCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ForumOwnerControlTest extends TestCase
{
    use RefreshDatabase;

    private function createCategory(): ForumCategory
    {
        return ForumCategory::create([
            'name' => 'Waspada Penipuan',
            'slug' => 'waspada-penipuan',
            'description' => 'Diskusi seputar penipuan daring',
        ]);
    }

    public function test_owner_can_edit_and_update_their_discussion(): void
    {
        $category = $this->createCategory();
        $user = User::factory()->create(['role' => 'user']);
        $discussion = Discussion::create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'title' => 'Judul Awal Percobaan Diskusi',
            'slug' => 'judul-awal-percobaan-diskusi',
            'body' => 'Isi kronologi panjang untuk memenuhi validasi minimal 30 karakter.',
            'status' => 'published',
        ]);

        $this->actingAs($user)
            ->get(route('forum.edit', $discussion->slug))
            ->assertOk()
            ->assertSee('Perbarui Topik Diskusi');

        $this->actingAs($user)
            ->put(route('forum.update', $discussion->slug), [
                'title' => 'Judul Baru Setelah Diedit Oleh Pemilik',
                'category_id' => $category->id,
                'body' => 'Isi kronologi baru setelah proses edit diperbarui dengan benar.',
            ])
            ->assertRedirect(route('forum.show', $discussion->slug));

        $this->assertDatabaseHas('discussions', [
            'id' => $discussion->id,
            'title' => 'Judul Baru Setelah Diedit Oleh Pemilik',
        ]);
    }

    public function test_non_owner_cannot_update_discussion(): void
    {
        $category = $this->createCategory();
        $owner = User::factory()->create(['role' => 'user']);
        $otherUser = User::factory()->create(['role' => 'user']);

        $discussion = Discussion::create([
            'user_id' => $owner->id,
            'category_id' => $category->id,
            'title' => 'Judul Awal Percobaan Diskusi',
            'slug' => 'judul-awal-percobaan-diskusi',
            'body' => 'Isi kronologi panjang untuk memenuhi validasi minimal 30 karakter.',
            'status' => 'published',
        ]);

        $this->actingAs($otherUser)
            ->get(route('forum.edit', $discussion->slug))
            ->assertForbidden();

        $this->actingAs($otherUser)
            ->put(route('forum.update', $discussion->slug), [
                'title' => 'Judul Dibajak Orang Lain',
                'category_id' => $category->id,
                'body' => 'Isi kronologi yang dicoba oleh akun lain yang tidak berhak.',
            ])
            ->assertForbidden();
    }

    public function test_owner_and_admin_can_delete_discussion(): void
    {
        $category = $this->createCategory();
        $owner = User::factory()->create(['role' => 'user']);
        $admin = User::factory()->create(['role' => 'admin']);
        $stranger = User::factory()->create(['role' => 'user']);

        $discussion = Discussion::create([
            'user_id' => $owner->id,
            'category_id' => $category->id,
            'title' => 'Judul Awal Percobaan Hapus',
            'slug' => 'judul-awal-percobaan-hapus',
            'body' => 'Isi kronologi panjang untuk memenuhi validasi minimal 30 karakter.',
            'status' => 'published',
        ]);

        // Stranger cannot delete
        $this->actingAs($stranger)
            ->delete(route('forum.destroy', $discussion->slug))
            ->assertForbidden();

        // Owner can delete
        $this->actingAs($owner)
            ->delete(route('forum.destroy', $discussion->slug))
            ->assertRedirect(route('forum.index'));

        $this->assertDatabaseMissing('discussions', ['id' => $discussion->id]);
    }

    public function test_owner_can_edit_and_delete_comment(): void
    {
        $category = $this->createCategory();
        $author = User::factory()->create(['role' => 'user']);
        $commenter = User::factory()->create(['role' => 'user']);
        $otherUser = User::factory()->create(['role' => 'user']);

        $discussion = Discussion::create([
            'user_id' => $author->id,
            'category_id' => $category->id,
            'title' => 'Judul Diskusi Tentang Komentar',
            'slug' => 'judul-diskusi-tentang-komentar',
            'body' => 'Isi kronologi panjang untuk memenuhi validasi minimal 30 karakter.',
            'status' => 'published',
        ]);

        $comment = DiscussionComment::create([
            'discussion_id' => $discussion->id,
            'user_id' => $commenter->id,
            'body' => 'Komentar awal dari pengguna pertama',
        ]);

        // Stranger cannot update
        $this->actingAs($otherUser)
            ->put(route('forum.comments.update', [$discussion->slug, $comment->id]), [
                'body' => 'Percobaan hijack komentar',
            ])
            ->assertForbidden();

        // Commenter can update
        $this->actingAs($commenter)
            ->put(route('forum.comments.update', [$discussion->slug, $comment->id]), [
                'body' => 'Komentar telah diperbaiki oleh pemilik',
            ])
            ->assertRedirect(route('forum.show', $discussion->slug));

        $this->assertDatabaseHas('discussion_comments', [
            'id' => $comment->id,
            'body' => 'Komentar telah diperbaiki oleh pemilik',
        ]);

        // Commenter can delete
        $this->actingAs($commenter)
            ->delete(route('forum.comments.destroy', [$discussion->slug, $comment->id]))
            ->assertRedirect(route('forum.show', $discussion->slug));

        $this->assertDatabaseMissing('discussion_comments', ['id' => $comment->id]);
    }
}
