<?php

namespace Database\Seeders;

use App\Models\ForumCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ForumCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Phishing',
                'description' => 'Pesan, tautan, atau halaman palsu untuk mencuri informasi.',
            ],
            [
                'name' => 'Marketplace',
                'description' => 'Risiko penipuan saat jual beli online.',
            ],
            [
                'name' => 'Lowongan Kerja',
                'description' => 'Modus penipuan yang mengatasnamakan perekrutan kerja.',
            ],
            [
                'name' => 'Investasi',
                'description' => 'Pola penawaran investasi berisiko atau mencurigakan.',
            ],
            [
                'name' => 'Hadiah dan Undian',
                'description' => 'Pesan hadiah atau undian yang meminta tindakan mencurigakan.',
            ],
            [
                'name' => 'Lainnya',
                'description' => 'Diskusi risiko transaksi yang belum termasuk kategori lain.',
            ],
        ];

        foreach ($categories as $category) {
            ForumCategory::updateOrCreate(
                ['slug' => Str::slug($category['name'])],
                [
                    'name' => $category['name'],
                    'description' => $category['description'],
                ]
            );
        }
    }
}
