<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AssessmentQuestion extends Model
{
    protected $fillable = [
        'code',
        'question_text',
        'category',
        'sort_order',
        'is_core',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_core' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function options(): HasMany
    {
        return $this->hasMany(QuestionOption::class, 'question_id')
            ->orderBy('sort_order');
    }

    public function answers(): HasMany
    {
        return $this->hasMany(AssessmentAnswer::class, 'question_id');
    }
}
