<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class QuestionOption extends Model
{
    protected $fillable = [
        'question_id',
        'value',
        'label',
        'next_question_id',
        'sort_order',
    ];

    public function question(): BelongsTo
    {
        return $this->belongsTo(
            AssessmentQuestion::class,
            'question_id'
        );
    }

    public function nextQuestion(): BelongsTo
    {
        return $this->belongsTo(
            AssessmentQuestion::class,
            'next_question_id'
        );
    }

    public function indicators(): BelongsToMany
    {
        return $this->belongsToMany(
            Indicator::class,
            'question_option_indicators',
            'question_option_id',
            'indicator_id'
        );
    }

    public function answers(): HasMany
    {
        return $this->hasMany(
            AssessmentAnswer::class,
            'question_option_id'
        );
    }
}
