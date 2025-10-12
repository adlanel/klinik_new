<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AboutUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if table is empty
        if (DB::table('aboutus')->count() === 0) {
            DB::table('aboutus')->insert([
                'title' => 'Klinik Alfatih Center',
                'description' => 'Klinik Alfatih Center adalah pusat layanan kesehatan dan tumbuh kembang anak yang menyediakan berbagai terapi dan penanganan profesional. Dengan tim ahli yang berpengalaman dan fasilitas modern, kami berkomitmen untuk memberikan pelayanan terbaik bagi tumbuh kembang anak. Kami memahami bahwa setiap anak istimewa dengan kebutuhan yang berbeda, dan kami hadir untuk mendukung perjalanan perkembangan mereka secara optimal.',
                'image' => 'clinic-building.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}