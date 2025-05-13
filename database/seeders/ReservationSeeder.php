<?php

namespace Database\Seeders;

use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reservations = [
            [
                'user_id' => 1,
                'facility_id' => 1,
                'image' => 'reservations/image1.jpg',
                'letter' => 'letters/surat1.pdf',
                'time_start' => Carbon::parse('2025-05-15 08:00:00'),
                'time_end' => Carbon::parse('2025-05-15 10:00:00'),
                'purpose' => 'Latihan futsal tim kampus',
                'status' => 'approved',
                'approved_by' => 6,
                'final_approved_by' => 1,
            ],
            [
                'user_id' => 2,
                'facility_id' => 2,
                'image' => 'reservations/image2.jpg',
                'letter' => 'letters/surat2.pdf',
                'time_start' => Carbon::parse('2025-05-16 13:00:00'),
                'time_end' => Carbon::parse('2025-05-16 15:00:00'),
                'purpose' => 'Kegiatan senam ibu-ibu RW',
                'status' => 'approved',
                'approved_by' => 6,
                'final_approved_by' => 1,
            ],
            [
                'user_id' => 3,
                'facility_id' => 3,
                'image' => 'reservations/image3.jpg',
                'letter' => 'letters/surat3.pdf',
                'time_start' => Carbon::parse('2025-05-18 09:00:00'),
                'time_end' => Carbon::parse('2025-05-18 11:30:00'),
                'purpose' => 'Workshop bela diri',
                'status' => 'approved',
                'approved_by' => 6,
                'final_approved_by' => 1,
            ],
            [
                'user_id' => 4,
                'facility_id' => 4,
                'image' => 'reservations/image4.jpg',
                'letter' => 'letters/surat4.pdf',
                'time_start' => Carbon::parse('2025-05-19 14:00:00'),
                'time_end' => Carbon::parse('2025-05-19 16:00:00'),
                'purpose' => 'Lomba olahraga antar kelas',
                'status' => 'approved',
                'approved_by' => 6,
                'final_approved_by' => 1,
            ],
            [
                'user_id' => 5,
                'facility_id' => 5,
                'image' => 'reservations/image5.jpg',
                'letter' => 'letters/surat5.pdf',
                'time_start' => Carbon::parse('2025-05-20 07:00:00'),
                'time_end' => Carbon::parse('2025-05-20 09:00:00'),
                'purpose' => 'Senam pagi bersama karyawan',
                'status' => 'approved',
                'approved_by' => 6,
                'final_approved_by' => 1,
            ],
        ];

        foreach ($reservations as $reservation) {
            Reservation::create($reservation);
        }
    }
}
