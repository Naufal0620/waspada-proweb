<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Evidence extends Model
{
    protected $fillable = [
        'report_id',
        'evidence_type',
        'value',
    ];

    public function report(): BelongsTo
    {
        return $this->belongsTo(Report::class);
    }
}
