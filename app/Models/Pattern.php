<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Pattern extends Model
{
    protected $fillable = [
        'name',
        'description',
        'risk_level',
        'created_by',
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function indicators(): BelongsToMany
    {
        return $this->belongsToMany(
            Indicator::class,
            'pattern_indicators',
            'pattern_id',
            'indicator_id'
        );
    }
}
