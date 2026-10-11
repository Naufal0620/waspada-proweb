<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Indicator;

class IndicatorSeeder extends Seeder
{
    public function run(): void
    {
        $indicators = [
            [
                'category' => 'urgency',
                'label' => 'Tekanan untuk bertindak segera',
            ],
            [
                'category' => 'identity',
                'label' => 'Mengaku sebagai pihak resmi',
            ],
            [
                'category' => 'payment',
                'label' => 'Meminta transfer ke rekening pribadi',
            ],
            [
                'category' => 'credential',
                'label' => 'Meminta kode OTP atau kata sandi',
            ],
            [
                'category' => 'link',
                'label' => 'Mengirim tautan yang mencurigakan',
            ],
            [
                'category' => 'prize',
                'label' => 'Menjanjikan hadiah yang tidak terduga',
            ],
        ];

        foreach ($indicators as $indicator) {
            Indicator::firstOrCreate(
                ['category' => $indicator['category'],
                 'label' => $indicator['label']],
                ['is_active' => true]
            );
        }
    }
}
