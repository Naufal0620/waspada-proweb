<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AssessmentAnswer extends Model
{
    protected $fillable = [
        'assessment_id',
        'question_id',
        'question_option_id',
    ];

    public function assessment(): BelongsTo
    {
        return $this->belongsTo(Assessment::class);
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(
            AssessmentQuestion::class,
            'question_id'
        );
    }

    public function option(): BelongsTo
    {
        return $this->belongsTo(
            QuestionOption::class,
            'question_option_id'
        );
    }
}
