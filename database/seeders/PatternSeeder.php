<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Pattern;
use App\Models\Indicator;
use Illuminate\Support\Str;

class PatternSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('role', 'admin')->firstOrFail();

        $patterns = [
            [
                'name' => 'Penipuan Berkedok Hadiah',
                'description' => 'Pelaku mengabarkan korban memenangkan hadiah, tetapi meminta pembayaran atau data sensitif sebagai syarat pencairan.',
                'risk_level' => 'warning',
                'indicators' => [
                    'Menjanjikan hadiah yang tidak terduga',
                    'Meminta transfer ke rekening pribadi',
                    'Tekanan untuk bertindak segera',
                ],
            ],
            [
                'name' => 'Phishing melalui Tautan',
                'description' => 'Pelaku mengirim tautan yang mengarahkan korban ke halaman tiruan untuk memperoleh informasi akun atau data pribadi.',
                'risk_level' => 'high',
                'indicators' => [
                    'Mengirim tautan yang mencurigakan',
                    'Mengaku sebagai pihak resmi',
                    'Meminta kode OTP atau kata sandi',
                ],
            ],
            [
                'name' => 'Penipuan Mengatasnamakan Pihak Resmi',
                'description' => 'Pelaku mengaku mewakili institusi atau layanan resmi untuk membuat korban percaya dan mengikuti instruksi tertentu.',
                'risk_level' => 'high',
                'indicators' => [
                    'Mengaku sebagai pihak resmi',
                    'Tekanan untuk bertindak segera',
                    'Meminta kode OTP atau kata sandi',
                ],
            ],
        ];

        foreach ($patterns as $item) {
            $pattern = Pattern::updateOrCreate(
                ['name' => $item['name']],
                [
                    'description' => $item['description'],
                    'risk_level' => $item['risk_level'],
                    'created_by' => $admin->id,
                ]
            );

            $indicatorIds = Indicator::whereIn(
                'label',
                $item['indicators']
            )->pluck('id');

            $pattern->indicators()->sync($indicatorIds);
        }
    }
}
