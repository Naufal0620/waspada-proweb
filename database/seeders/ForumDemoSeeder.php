<?php

namespace Database\Seeders;

use App\Models\Discussion;
use App\Models\DiscussionComment;
use App\Models\DiscussionVote;
use App\Models\ForumCategory;
use App\Models\User;
use Illuminate\Database\Seeder;

class ForumDemoSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan kategori forum sudah tersedia.
        $this->call(ForumCategorySeeder::class);

        // Akun khusus untuk konten demo.
        $users = collect([
            [
                'name' => 'Nadia Putri',
                'email' => 'nadia.demo@example.test',
            ],
            [
                'name' => 'Rizky Pratama',
                'email' => 'rizky.demo@example.test',
            ],
            [
                'name' => 'Dimas Saputra',
                'email' => 'dimas.demo@example.test',
            ],
            [
                'name' => 'Salsa Maharani',
                'email' => 'salsa.demo@example.test',
            ],
        ])->mapWithKeys(function ($data) {
            $user = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'password' => 'DemoPassword123!',
                    'role' => 'user',
                ]
            );

            return [$data['email'] => $user];
        });

        $discussions = [
            [
                'slug' => 'pesan-akun-diblokir-verifikasi-hari-ini',
                'category' => 'phishing',
                'author' => 'nadia.demo@example.test',
                'title' => 'Mendapat pesan akun akan diblokir jika tidak verifikasi hari ini',
                'body' => <<<'TEXT'
Saya menerima pesan yang mengatakan akun saya akan diblokir dalam 24 jam jika tidak melakukan verifikasi.

Pesan tersebut meminta saya membuka tautan dan mengisi informasi akun. Saya belum membuka tautannya karena alamat pengirimnya terlihat berbeda dari kanal resmi yang biasa saya gunakan.

Menurut saya, ada beberapa hal yang perlu diperiksa:
- Apakah domain tautannya benar-benar milik layanan resmi?
- Apakah pemberitahuan serupa tersedia di aplikasi resminya?
- Apakah pesan tersebut meminta kata sandi atau kode OTP?

Saya ingin mengingatkan anggota lain agar tidak terburu-buru mengikuti instruksi yang menggunakan ancaman pemblokiran akun.
TEXT,
            ],
            [
                'slug' => 'penjual-minta-transfer-di-luar-marketplace',
                'category' => 'marketplace',
                'author' => 'rizky.demo@example.test',
                'title' => 'Penjual meminta pembayaran tambahan di luar aplikasi',
                'body' => <<<'TEXT'
Dalam sebuah simulasi transaksi, penjual menawarkan harga yang menarik, tetapi kemudian meminta pembayaran tambahan melalui rekening di luar platform.

Alasannya adalah agar barang segera dikirim dan biaya transaksi menjadi lebih murah.

Situasi seperti ini patut diperiksa karena pembayaran di luar platform dapat menghilangkan perlindungan transaksi yang disediakan layanan tersebut.

Sebelum melanjutkan transaksi, sebaiknya:
- Periksa aturan pembayaran di aplikasi resmi.
- Jangan mengikuti tautan pembayaran yang dikirim melalui chat tanpa verifikasi.
- Simpan percakapan dan bukti transaksi.
- Gunakan fitur pembayaran yang disediakan platform.

Apakah ada indikator risiko lain yang sebaiknya diperhatikan?
TEXT,
            ],
            [
                'slug' => 'lowongan-kerja-meminta-biaya-pendaftaran',
                'category' => 'lowongan-kerja',
                'author' => 'dimas.demo@example.test',
                'title' => 'Lowongan kerja bergaji tinggi tetapi meminta biaya pendaftaran',
                'body' => <<<'TEXT'
Saya menemukan contoh lowongan kerja yang menjanjikan gaji tinggi dengan proses penerimaan sangat cepat.

Sebelum wawancara, pelamar diminta membayar biaya administrasi dan mengirimkan bukti transfer kepada perekrut.

Permintaan pembayaran di awal merupakan indikator yang perlu diperiksa lebih lanjut, terutama jika informasi perusahaan dan proses rekrutmennya tidak jelas.

Langkah pemeriksaan yang bisa dilakukan:
- Cari situs karier resmi perusahaan.
- Verifikasi alamat email dan identitas perekrut.
- Baca pengumuman rekrutmen dari sumber resmi.
- Jangan mengirim dokumen sensitif sebelum mengetahui tujuan dan keabsahan permintaannya.

Janji gaji besar saja tidak cukup untuk membuktikan bahwa suatu lowongan benar-benar sah.
TEXT,
            ],
            [
                'slug' => 'pesan-hadiah-meminta-biaya-pencairan',
                'category' => 'hadiah-dan-undian',
                'author' => 'salsa.demo@example.test',
                'title' => 'Dinyatakan menang hadiah, tetapi harus membayar biaya pencairan',
                'body' => <<<'TEXT'
Contoh modus yang perlu diwaspadai adalah pesan yang menyatakan penerima memenangkan hadiah, padahal penerima tidak ingat pernah mengikuti undian tersebut.

Untuk mengambil hadiah, penerima diminta membayar biaya pencairan atau biaya administrasi melalui rekening tertentu.

Sebelum mempercayai pesan semacam ini, periksa:
- Apakah program hadiah benar-benar diumumkan oleh penyelenggara resmi?
- Apakah ada syarat dan ketentuan yang dapat diverifikasi?
- Apakah pembayaran diminta ke rekening pribadi?
- Apakah pengirim mendesak penerima agar segera mentransfer uang?

Jangan mengirim uang atau data pribadi hanya karena pesan menyebut nama dan jumlah hadiah yang menarik.
TEXT,
            ],
            [
                'slug' => 'penawaran-investasi-keuntungan-tetap',
                'category' => 'investasi',
                'author' => 'nadia.demo@example.test',
                'title' => 'Penawaran investasi menjanjikan keuntungan tetap dalam waktu singkat',
                'body' => <<<'TEXT'
Dalam contoh penawaran investasi ini, calon peserta dijanjikan keuntungan tetap dalam waktu singkat dan didorong untuk segera menyetorkan dana.

Promosi juga menyebut bahwa risiko kerugian sangat kecil tanpa memberikan penjelasan yang memadai mengenai sumber keuntungan.

Klaim keuntungan bukan bukti bahwa sebuah investasi aman. Sebelum mengambil keputusan, periksa:
- Identitas badan usaha dan pihak yang menawarkan.
- Legalitas melalui kanal regulator yang relevan.
- Penjelasan mengenai risiko dan mekanisme investasi.
- Apakah keuntungan dijelaskan secara masuk akal dan dapat diverifikasi.

Jangan memutuskan hanya berdasarkan testimoni, tangkapan layar keuntungan, atau ajakan teman.
TEXT,
            ],
        ];

        foreach ($discussions as $data) {
            $category = ForumCategory::where(
                'slug',
                $data['category']
            )->firstOrFail();

            $discussion = Discussion::updateOrCreate(
                ['slug' => $data['slug']],
                [
                    'user_id' => $users[$data['author']]->id,
                    'category_id' => $category->id,
                    'title' => $data['title'],
                    'body' => $data['body'],
                    'status' => 'published',
                ]
            );

            $commentData = match ($data['slug']) {
                'pesan-akun-diblokir-verifikasi-hari-ini' => [
                    [
                        'author' => 'rizky.demo@example.test',
                        'body' => 'Pengecekan domain dan alamat pengirim memang penting. Lebih aman membuka aplikasi resmi secara langsung daripada mengikuti tautan dari pesan.',
                        'replies' => [
                            [
                                'author' => 'nadia.demo@example.test',
                                'body' => 'Setuju. Saya juga akan memeriksa notifikasi dari aplikasi resminya terlebih dahulu.',
                            ],
                        ],
                    ],
                    [
                        'author' => 'dimas.demo@example.test',
                        'body' => 'Permintaan kode OTP melalui tautan yang tidak jelas juga perlu diwaspadai.',
                        'replies' => [],
                    ],
                ],
                'penjual-minta-transfer-di-luar-marketplace' => [
                    [
                        'author' => 'salsa.demo@example.test',
                        'body' => 'Sebaiknya tetap memakai sistem pembayaran platform agar ada mekanisme perlindungan transaksi.',
                        'replies' => [],
                    ],
                ],
                'lowongan-kerja-meminta-biaya-pendaftaran' => [
                    [
                        'author' => 'nadia.demo@example.test',
                        'body' => 'Memeriksa situs karier dan kontak resmi perusahaan bisa membantu membedakan pengumuman asli dan yang meragukan.',
                        'replies' => [],
                    ],
                ],
                'pesan-hadiah-meminta-biaya-pencairan' => [
                    [
                        'author' => 'rizky.demo@example.test',
                        'body' => 'Apalagi jika kita tidak pernah mengikuti undiannya. Sebaiknya verifikasi langsung ke penyelenggara.',
                        'replies' => [],
                    ],
                ],
                default => [
                    [
                        'author' => 'salsa.demo@example.test',
                        'body' => 'Penting untuk memeriksa legalitas, memahami risikonya, dan tidak mengambil keputusan karena tekanan waktu.',
                        'replies' => [],
                    ],
                ],
            };

            foreach ($commentData as $item) {
                $comment = DiscussionComment::firstOrCreate(
                    [
                        'discussion_id' => $discussion->id,
                        'user_id' => $users[$item['author']]->id,
                        'parent_id' => null,
                        'body' => $item['body'],
                    ],
                    ['status' => 'published']
                );

                foreach ($item['replies'] as $replyData) {
                    DiscussionComment::firstOrCreate(
                        [
                            'discussion_id' => $discussion->id,
                            'user_id' => $users[$replyData['author']]->id,
                            'parent_id' => $comment->id,
                            'body' => $replyData['body'],
                        ],
                        ['status' => 'published']
                    );
                }
            }

            // Vote demo dibuat unik untuk setiap pengguna dan diskusi.
            $voters = match ($data['slug']) {
                'pesan-akun-diblokir-verifikasi-hari-ini' =>
                    ['rizky.demo@example.test', 'dimas.demo@example.test', 'salsa.demo@example.test'],
                'penjual-minta-transfer-di-luar-marketplace' =>
                    ['nadia.demo@example.test', 'dimas.demo@example.test'],
                'lowongan-kerja-meminta-biaya-pendaftaran' =>
                    ['nadia.demo@example.test', 'rizky.demo@example.test', 'salsa.demo@example.test'],
                'pesan-hadiah-meminta-biaya-pencairan' =>
                    ['nadia.demo@example.test', 'rizky.demo@example.test'],
                default =>
                    ['rizky.demo@example.test', 'salsa.demo@example.test'],
            };

            foreach ($voters as $email) {
                DiscussionVote::firstOrCreate([
                    'discussion_id' => $discussion->id,
                    'user_id' => $users[$email]->id,
                ]);
            }
        }

        // Satu diskusi pending untuk menguji antrean moderasi.
        $pendingCategory = ForumCategory::where(
            'slug',
            'marketplace'
        )->firstOrFail();

        Discussion::updateOrCreate(
            ['slug' => 'demo-pending-review'],
            [
                'user_id' => $users['salsa.demo@example.test']->id,
                'category_id' => $pendingCategory->id,
                'title' => 'CONTOH MODERASI: Diskusi yang menunggu peninjauan',
                'body' => 'Konten contoh ini sengaja berstatus pending untuk menguji antrean moderasi. Diskusi ini tidak boleh muncul di daftar publik sampai ditinjau.',
                'status' => 'pending',
            ]
        );
    }
}
