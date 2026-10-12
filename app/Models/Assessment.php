<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Assessment extends Model
{
    protected $fillable = [
        'session_id',
        'risk_level',
        'information_status',
        'match_status',
    ];


    public function reports(): HasMany
    {
        return $this->hasMany(Report::class);
    }
    public function answers(): HasMany
    {
        return $this->hasMany(AssessmentAnswer::class);
    }

    public function indicators(): BelongsToMany
    {
        return $this->belongsToMany(
            Indicator::class,
            'assessment_indicators',
            'assessment_id',
            'indicator_id'
        );
    }

    public function matchedPatterns()
    {
        return $this->belongsToMany(
            Pattern::class,
            'pattern_indicators',
            'indicator_id',
            'pattern_id',
            'id',
            'id'
        )->whereHas('indicators', function ($query) {
            $query->whereIn(
                'indicators.id',
                $this->indicators()->select('indicators.id')
            );
        });
    }
}
