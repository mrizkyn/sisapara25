<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $articles = [
            [
                'title' => 'Manfaat Olahraga Pagi',
                'content' => 'Olahraga pagi dapat membantu meningkatkan energi dan fokus sepanjang hari.',
                'image' => 'olahraga_pagi.jpg',
                'user_id' => 1,
            ],
            [
                'title' => 'Panduan Makan Sehat',
                'content' => 'Mengonsumsi makanan seimbang penting untuk menjaga kesehatan tubuh.',
                'image' => 'makan_sehat.jpg',
                'user_id' => 1,
            ],
            [
                'title' => 'Tips Lari Jarak Jauh',
                'content' => 'Latihan rutin dan pemanasan yang tepat membantu lari lebih optimal.',
                'image' => 'lari_jarak_jauh.jpg',
                'user_id' => 1,
            ],
            [
                'title' => 'Yoga untuk Pemula',
                'content' => 'Yoga dasar cocok untuk meningkatkan fleksibilitas dan relaksasi.',
                'image' => 'yoga_pemula.jpg',
                'user_id' => 1,
            ],
            [
                'title' => 'Cara Menjaga Kebugaran',
                'content' => 'Istirahat cukup dan olahraga rutin membuat tubuh tetap bugar.',
                'image' => 'kebugaran.jpg',
                'user_id' => 1,
            ],
            [
                'title' => 'Olahraga di Rumah',
                'content' => 'Gunakan ruang kecil di rumah untuk latihan ringan dan konsisten.',
                'image' => 'olahraga_rumah.jpg',
                'user_id' => 1,
            ],
            [
                'title' => 'Senam Sehat di Pagi Hari',
                'content' => 'Senam pagi menyegarkan tubuh dan memulai hari dengan positif.',
                'image' => 'senam.jpg',
                'user_id' => 1,
            ],
            [
                'title' => 'Manfaat Jalan Kaki',
                'content' => 'Jalan kaki rutin bisa membantu menjaga kesehatan jantung.',
                'image' => 'jalan_kaki.jpg',
                'user_id' => 2,
            ],
            [
                'title' => 'Pentingnya Pemanasan',
                'content' => 'Pemanasan mencegah cedera saat melakukan olahraga berat.',
                'image' => 'pemanasan.jpg',
                'user_id' => 2,
            ],
            [
                'title' => 'Olahraga untuk Lansia',
                'content' => 'Latihan ringan dapat menjaga kebugaran dan mobilitas lansia.',
                'image' => 'lansia.jpg',
                'user_id' => 2,
            ],
            [
                'title' => 'Cara Membentuk Otot',
                'content' => 'Latihan beban dan nutrisi cukup membantu membentuk massa otot.',
                'image' => 'otot.jpg',
                'user_id' => 2,
            ],
            [
                'title' => 'Mengatur Jadwal Latihan',
                'content' => 'Disiplin latihan dengan jadwal yang seimbang meningkatkan hasil.',
                'image' => 'jadwal_latihan.jpg',
                'user_id' => 2,
            ],
            [
                'title' => 'Hidrasi Saat Berolahraga',
                'content' => 'Minum cukup air penting agar tubuh tidak dehidrasi saat latihan.',
                'image' => 'hidrasi.jpg',
                'user_id' => 2,
            ],
            [
                'title' => 'Stretching Setelah Olahraga',
                'content' => 'Pendinginan membantu mengurangi nyeri otot dan mempercepat pemulihan.',
                'image' => 'stretching.jpg',
                'user_id' => 2,
            ],
            [
                'title' => 'Olahraga di Akhir Pekan',
                'content' => 'Manfaatkan akhir pekan untuk aktivitas fisik bersama keluarga.',
                'image' => 'akhir_pekan.jpg',
                'user_id' => 2,
            ],
        ];

        foreach ($articles as $index => $article) {
            Article::create([
                ...$article,
                'created_at' => now()->subDays(rand(1, 30)),
                'updated_at' => now(),
            ]);
        }
    }
}
