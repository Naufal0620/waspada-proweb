<?php

namespace Database\Seeders;

use App\Models\AssessmentQuestion;
use App\Models\QuestionOption;
use App\Models\Indicator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssessmentQuestionSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            $questions = [
                [
                    'code' => 'official_claim',
                    'question_text' => 'Apakah pihak tersebut mengaku berasal dari bank, instansi, perusahaan, atau layanan resmi?',
                    'category' => 'identity',
                    'sort_order' => 1,
                    'is_core' => true,
                    'indicator' => 'Mengaku sebagai pihak resmi',
                    'options' => [
                        ['value' => 'yes', 'label' => 'Ya'],
                        ['value' => 'no', 'label' => 'Tidak'],
                        ['value' => 'unknown', 'label' => 'Tidak tahu / tidak yakin'],
                    ],
                ],
                [
                    'code' => 'urgent_action',
                    'question_text' => 'Apakah kamu didesak untuk segera bertindak dengan ancaman atau alasan mendesak?',
                    'category' => 'urgency',
                    'sort_order' => 2,
                    'is_core' => true,
                    'indicator' => 'Tekanan untuk bertindak segera',
                    'options' => [
                        ['value' => 'yes', 'label' => 'Ya'],
                        ['value' => 'no', 'label' => 'Tidak'],
                        ['value' => 'unknown', 'label' => 'Tidak tahu / tidak yakin'],
                    ],
                ],
                [
                    'code' => 'credential_request',
                    'question_text' => 'Apakah kamu diminta memberikan OTP atau kata sandi?',
                    'category' => 'credential',
                    'sort_order' => 3,
                    'is_core' => true,
                    'indicator' => 'Meminta kode OTP atau kata sandi',
                    'options' => [
                        ['value' => 'yes', 'label' => 'Ya'],
                        ['value' => 'no', 'label' => 'Tidak'],
                        ['value' => 'unknown', 'label' => 'Tidak tahu / tidak yakin'],
                    ],
                ],
                [
                    'code' => 'suspicious_link',
                    'question_text' => 'Apakah kamu menerima tautan yang mencurigakan?',
                    'category' => 'link',
                    'sort_order' => 4,
                    'is_core' => false,
                    'indicator' => 'Mengirim tautan yang mencurigakan',
                    'options' => [
                        ['value' => 'yes', 'label' => 'Ya'],
                        ['value' => 'no', 'label' => 'Tidak'],
                        ['value' => 'unknown', 'label' => 'Tidak tahu / tidak yakin'],
                    ],
                ],
                [
                    'code' => 'unexpected_prize',
                    'question_text' => 'Apakah kamu diberi tahu memenangkan hadiah yang tidak pernah kamu ikuti?',
                    'category' => 'prize',
                    'sort_order' => 5,
                    'is_core' => false,
                    'indicator' => 'Menjanjikan hadiah yang tidak terduga',
                    'options' => [
                        ['value' => 'yes', 'label' => 'Ya'],
                        ['value' => 'no', 'label' => 'Tidak'],
                        ['value' => 'unknown', 'label' => 'Tidak tahu / tidak yakin'],
                    ],
                ],
                [
                    'code' => 'personal_transfer',
                    'question_text' => 'Apakah kamu diminta mentransfer uang ke rekening pribadi?',
                    'category' => 'payment',
                    'sort_order' => 6,
                    'is_core' => false,
                    'indicator' => 'Meminta transfer ke rekening pribadi',
                    'options' => [
                        ['value' => 'yes', 'label' => 'Ya'],
                        ['value' => 'no', 'label' => 'Tidak'],
                        ['value' => 'unknown', 'label' => 'Tidak tahu / tidak yakin'],
                    ],
                ],
            ];

            foreach ($questions as $data) {
                $question = AssessmentQuestion::updateOrCreate(
                    ['code' => $data['code']],
                    [
                        'question_text' => $data['question_text'],
                        'category' => $data['category'],
                        'sort_order' => $data['sort_order'],
                        'is_core' => $data['is_core'],
                        'is_active' => true,
                    ]
                );

                foreach ($data['options'] as $optionData) {
                    $option = QuestionOption::updateOrCreate(
                        [
                            'question_id' => $question->id,
                            'value' => $optionData['value'],
                        ],
                        [
                            'label' => $optionData['label'],
                            'next_question_id' => null,
                            'sort_order' => match ($optionData['value']) {
                                'yes' => 1,
                                'no' => 2,
                                default => 3,
                            },
                        ]
                    );

                    // Hanya jawaban "Ya" yang mengaktifkan indikator.
                    if ($optionData['value'] === 'yes') {
                        $indicator = Indicator::where(
                            'label',
                            $data['indicator']
                        )->first();

                        if ($indicator) {
                            $option->indicators()->syncWithoutDetaching([
                                $indicator->id,
                            ]);
                        }
                    }
                }
            }
        });
    }
}
