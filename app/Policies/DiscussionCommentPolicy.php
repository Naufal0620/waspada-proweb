<?php

namespace App\Policies;

use App\Models\DiscussionComment;
use App\Models\User;

class DiscussionCommentPolicy
{
    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, DiscussionComment $discussionComment): bool
    {
        return $user->id === $discussionComment->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, DiscussionComment $discussionComment): bool
    {
        return $user->id === $discussionComment->user_id || in_array($user->role, ['admin', 'moderator']);
    }
}
