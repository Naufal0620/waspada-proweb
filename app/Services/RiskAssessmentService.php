<?php

namespace App\Services;

use App\Models\Assessment;
use App\Models\AssessmentQuestion;
use App\Models\AssessmentAnswer;
use App\Models\Indicator;
use App\Models\Pattern;
use App\Models\QuestionOption;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class RiskAssessmentService
{
    public function assess(array $answers, ?int $userId = null): Assessment
    {
        return DB::transaction(function () use ($answers, $userId) {
            $questions = AssessmentQuestion::query()
                ->where('is_active', true)
                ->with('options.indicators')
                ->orderBy('sort_order')
                ->get();

            $coreQuestionIds = $questions
                ->where('is_core', true)
                ->modelKeys();

            // Semua pertanyaan inti wajib dijawab.
            foreach ($coreQuestionIds as $questionId) {
                if (!isset($answers[$questionId])) {
                    throw ValidationException::withMessages([
                        'answers' =>
                            'Jawab semua pertanyaan inti terlebih dahulu.',
                    ]);
                }
            }

            $validAnswers = [];
            $selectedIndicatorIds = [];

            foreach ($answers as $questionId => $optionId) {
                $question = $questions->firstWhere(
                    'id',
                    (int) $questionId
                );

                if (!$question) {
                    throw ValidationException::withMessages([
                        'answers' => 'Pertanyaan yang dipilih tidak valid.',
                    ]);
                }

                $option = $question->options->firstWhere(
                    'id',
                    (int) $optionId
                );

                if (!$option) {
                    throw ValidationException::withMessages([
                        'answers' =>
                            'Pilihan jawaban tidak sesuai dengan pertanyaan.',
                    ]);
                }

                $validAnswers[] = [
                    'question_id' => $question->id,
                    'question_option_id' => $option->id,
                    'value' => $option->value,
                ];

                if ($option->value === 'yes') {
                    foreach ($option->indicators as $indicator) {
                        if ($indicator->is_active) {
                            $selectedIndicatorIds[] = $indicator->id;
                        }
                    }
                }
            }

            $selectedIndicatorIds = array_values(array_unique(
                $selectedIndicatorIds
            ));

            $unknownCoreCount = collect($validAnswers)
                ->filter(fn ($answer) =>
                    in_array(
                        $answer['question_id'],
                        $coreQuestionIds
                    ) && $answer['value'] === 'unknown'
                )
                ->count();

            $informationStatus =
                $unknownCoreCount === count($coreQuestionIds)
                    ? 'insufficient'
                    : 'sufficient';

            $patterns = Pattern::query()
                ->with('indicators')
                ->get();

            // Pola dipertimbangkan cocok jika minimal 2 indikatornya
            // terdeteksi. Ini aturan awal MVP, bukan validasi ilmiah.
            $matchedPatterns = $patterns->filter(
                function ($pattern) use ($selectedIndicatorIds) {
                    $patternIndicatorIds = $pattern->indicators
                        ->where('is_active', true)
                        ->modelKeys();

                    if (count($patternIndicatorIds) < 2) {
                        return false;
                    }

                    $matchedCount = count(array_intersect(
                        $patternIndicatorIds,
                        $selectedIndicatorIds
                    ));

                    return $matchedCount >= 2;
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
                'user_id' => $userId,
                'session_id' => (string) Str::uuid(),
                'risk_level' => $riskLevel,
                'information_status' => $informationStatus,
                'match_status' => $matchedPatterns->isNotEmpty()
                    ? 'matched'
                    : 'no_match',
            ]);

            foreach ($validAnswers as $answer) {
                AssessmentAnswer::create([
                    'assessment_id' => $assessment->id,
                    'question_id' => $answer['question_id'],
                    'question_option_id' =>
                        $answer['question_option_id'],
                ]);
            }

            if (!empty($selectedIndicatorIds)) {
                $assessment->indicators()->sync(
                    Indicator::query()
                        ->where('is_active', true)
                        ->whereIn('id', $selectedIndicatorIds)
                        ->pluck('id')
                        ->all()
                );
            }

            $assessment->setRelation(
                'matchedPatterns',
                $matchedPatterns
            );

            return $assessment->load('indicators');
        });
    }

    /**
     * Membuat assessment langsung dari array indicator IDs (digunakan oleh API/test).
     */
    public function assessFromIndicators(array $indicatorIds, ?int $userId = null): Assessment
    {
        return DB::transaction(function () use ($indicatorIds, $userId) {
            $selectedIndicatorIds = array_values(array_unique($indicatorIds));

            $patterns = Pattern::query()->with('indicators')->get();

            $matchedPatterns = $patterns->filter(function ($pattern) use ($selectedIndicatorIds) {
                $patternIndicatorIds = $pattern->indicators
                    ->where('is_active', true)
                    ->modelKeys();

                if (count($patternIndicatorIds) < 2) {
                    return false;
                }

                return count(array_intersect($patternIndicatorIds, $selectedIndicatorIds)) >= 2;
            })->values();

            $riskLevel = 'low';
            if ($matchedPatterns->contains(fn ($p) => $p->risk_level === 'high')) {
                $riskLevel = 'high';
            } elseif ($matchedPatterns->isNotEmpty()) {
                $riskLevel = 'warning';
            }

            $assessment = Assessment::create([
                'user_id'            => $userId,
                'session_id'         => (string) Str::uuid(),
                'risk_level'         => $riskLevel,
                'information_status' => 'sufficient',
                'match_status'       => $matchedPatterns->isNotEmpty() ? 'matched' : 'no_match',
            ]);

            if (!empty($selectedIndicatorIds)) {
                $assessment->indicators()->sync(
                    Indicator::query()
                        ->where('is_active', true)
                        ->whereIn('id', $selectedIndicatorIds)
                        ->pluck('id')
                        ->all()
                );
            }

            $assessment->setRelation('matchedPatterns', $matchedPatterns);

            return $assessment->load('indicators');
        });
    }
}
