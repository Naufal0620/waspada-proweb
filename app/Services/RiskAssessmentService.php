<?php

namespace App\Services;

use App\Models\Assessment;
use App\Models\Indicator;
use App\Models\Pattern;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class RiskAssessmentService
{
    public function assess(array $indicatorIds): Assessment
    {
        return DB::transaction(function () use ($indicatorIds) {
            $indicatorIds = array_values(array_unique(
                array_map('intval', $indicatorIds)
            ));

            $indicators = Indicator::query()
                ->where('is_active', true)
                ->whereIn('id', $indicatorIds)
                ->get();

            if (
                empty($indicatorIds) ||
                $indicators->count() !== count($indicatorIds)
            ) {
                throw ValidationException::withMessages([
                    'indicators' =>
                        'Pilih minimal satu indikator aktif yang valid.',
                ]);
            }

            $selectedIds = $indicators->modelKeys();

            $patterns = Pattern::query()
                ->with([
                    'indicators' => fn ($query) =>
                        $query->where('is_active', true),
                ])
                ->get();

            $matchedPatterns = $patterns->filter(
                function ($pattern) use ($selectedIds) {
                    $requiredIds = $pattern->indicators->modelKeys();

                    return count($requiredIds) > 0
                        && empty(array_diff(
                            $requiredIds,
                            $selectedIds
                        ));
                }
            )->values();

            $riskLevel = 'low';

            if ($matchedPatterns->contains(
                fn ($pattern) => $pattern->risk_level === 'high'
            )) {
                $riskLevel = 'high';
            } elseif ($matchedPatterns->isNotEmpty()) {
                $riskLevel = 'warning';
            }

            $assessment = Assessment::create([
                'session_id' => (string) Str::uuid(),
                'risk_level' => $riskLevel,
            ]);

            $assessment->indicators()->sync($selectedIds);

            // Sertakan pola yang benar-benar cocok dalam hasil.
            $assessment->setRelation(
                'matchedPatterns',
                $matchedPatterns
            );

            return $assessment->load('indicators');
        });
    }
}
