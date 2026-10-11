<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Discussion extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'body',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ForumCategory::class, 'category_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(DiscussionComment::class);
    }

    public function votes(): HasMany
    {
        return $this->hasMany(DiscussionVote::class);
    }

    public function reports(): HasMany
    {
        return $this->hasMany(DiscussionReport::class);
    }
}
