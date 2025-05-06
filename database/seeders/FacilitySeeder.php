<?php

namespace Database\Seeders;

use App\Models\Facility;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Facility::create([
            'name' => 'Studio Senam Sehat',
            'description' => 'Ruang senam dan yoga untuk umum.',
            'location' => 'Jl. Dr. Angka, Purwokerto',
            'type' => 'Studio',
            'capacity' => 200,
            'image' => 'studio_senam.jpg',
            'thumbnail_image' => 'tumbnel.jpg',
            'user_id' => 2,
        ]);
    }
}
