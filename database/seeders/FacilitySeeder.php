<?php

namespace Database\Seeders;

use App\Models\Facility;
use Illuminate\Database\Seeder;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $facilities = [
            [
                'name' => 'Studio Senam Sehat',
                'description' => 'Ruang senam dan yoga untuk umum.',
                'location' => 'Jl. Dr. Angka, Purwokerto',
                'type' => 'Studio',
                'capacity' => 200,
                'image' => 'studio_senam.jpg',

                'user_id' => 6,
            ],
            [
                'name' => 'Lapangan Futsal Indoor',
                'description' => 'Lapangan futsal berstandar nasional dengan pencahayaan maksimal.',
                'location' => 'GOR Satria, Purwokerto',
                'type' => 'Lapangan',
                'capacity' => 100,
                'image' => 'futsal.jpg',
                'user_id' => 6,
            ],
            [
                'name' => 'Kolam Renang Umum',
                'description' => 'Kolam renang untuk latihan dan kompetisi tingkat daerah.',
                'location' => 'Komplek GOR Wijaya Kusuma',
                'type' => 'Kolam Renang',
                'capacity' => 150,
                'image' => 'kolam_renang.jpg',
                'user_id' => 6,
            ],
            [
                'name' => 'Lapangan Basket',
                'description' => 'Lapangan basket outdoor dengan permukaan karet berkualitas.',
                'location' => 'Jl. Gerilya, Purwokerto',
                'type' => 'Lapangan',
                'capacity' => 80,
                'image' => 'basket.jpg',
                'user_id' => 6,
            ],
            [
                'name' => 'Gedung Serbaguna',
                'description' => 'Cocok untuk berbagai aktivitas olahraga dalam ruangan.',
                'location' => 'Komplek Dispora Banyumas',
                'type' => 'Gedung',
                'capacity' => 300,
                'image' => 'gedung_serbaguna.jpg',
                'user_id' => 6,
            ],
            [
                'name' => 'Studio Zumba',
                'description' => 'Dilengkapi sound system dan pencahayaan modern.',
                'location' => 'Jl. Jenderal Soedirman, Purwokerto',
                'type' => 'Studio',
                'capacity' => 60,
                'image' => 'zumba.jpg',
                'user_id' => 6,
            ],
            [
                'name' => 'Lapangan Tenis',
                'description' => 'Lapangan tenis berpermukaan sintetis dengan fasilitas lengkap.',
                'location' => 'Jl. Karang Kobar, Purwokerto',
                'type' => 'Lapangan',
                'capacity' => 70,
                'image' => 'tenis.jpg',
                'user_id' => 6,
            ],
            [
                'name' => 'Arena Panjat Tebing',
                'description' => 'Didesain untuk latihan panjat tebing tingkat pemula hingga ahli.',
                'location' => 'GOR Indoor Dispora',
                'type' => 'Arena',
                'capacity' => 50,
                'image' => 'panjat_tebing.jpg',
                'user_id' => 6,
            ],
            [
                'name' => 'Lintasan Atletik',
                'description' => 'Lintasan standar untuk latihan lari dan jalan cepat.',
                'location' => 'Stadion Wijaya Kusuma',
                'type' => 'Lapangan',
                'capacity' => 500,
                'image' => 'atletik.jpg',
                'user_id' => 6,
            ],
            [
                'name' => 'Gym Umum Dispora',
                'description' => 'Fasilitas gym lengkap dan terbuka untuk masyarakat.',
                'location' => 'Komplek Dispora Purwokerto',
                'type' => 'Gym',
                'capacity' => 100,
                'image' => 'gym.jpg',
                'user_id' => 6,
            ],
            [
                'name' => 'Lapangan Voli Pantai',
                'description' => 'Lapangan pasir untuk voli pantai berstandar nasional.',
                'location' => 'Arena Sport Center',
                'type' => 'Lapangan',
                'capacity' => 120,
                'image' => 'voli_pantai.jpg',
                'user_id' => 6,
            ],
            [
                'name' => 'Lapangan Badminton Indoor',
                'description' => 'Lapangan badminton dengan pencahayaan dan ventilasi optimal.',
                'location' => 'Jl. DI Panjaitan, Purwokerto',
                'type' => 'Lapangan',
                'capacity' => 90,
                'image' => 'badminton.jpg',
                'user_id' => 6,
            ],
            [
                'name' => 'Lapangan Sepak Bola Utama',
                'description' => 'Lapangan utama untuk kompetisi resmi tingkat daerah.',
                'location' => 'Stadion Purwokerto',
                'type' => 'Lapangan',
                'capacity' => 1000,
                'image' => 'sepakbola.jpg',
                'user_id' => 6,
            ],
            [
                'name' => 'Studio Aerobik',
                'description' => 'Studio aerobik dengan instruktur bersertifikat.',
                'location' => 'Fitness Center Purwokerto',
                'type' => 'Studio',
                'capacity' => 40,
                'image' => 'aerobik.jpg',
                'user_id' => 6,
            ],
            [
                'name' => 'Ruang Bela Diri',
                'description' => 'Ruang latihan bela diri seperti karate dan taekwondo.',
                'location' => 'GOR Dispora Lt. 2',
                'type' => 'Ruang',
                'capacity' => 60,
                'image' => 'bela_diri.jpg',
                'user_id' => 6,
            ],
        ];


        foreach ($facilities as $facility) {
            Facility::create($facility);
        }
    }
}
