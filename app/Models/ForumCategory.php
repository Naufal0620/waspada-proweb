<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ForumCategory extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    public function discussions(): HasMany
    {
        return $this->hasMany(Discussion::class, 'category_id');
    }
}
