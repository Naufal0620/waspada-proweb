<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Indicator extends Model
{
    protected $fillable = [
        'category',
        'label',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function assessments(): BelongsToMany
    {
        return $this->belongsToMany(
            Assessment::class,
            'assessment_indicators',
            'indicator_id',
            'assessment_id'
        );
    }

    public function patterns(): BelongsToMany
    {
        return $this->belongsToMany(
            Pattern::class,
            'pattern_indicators',
            'indicator_id',
            'pattern_id'
        );
    }
}
