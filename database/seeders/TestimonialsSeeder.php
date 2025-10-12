<?php

namespace Database\Seeders;

use App\Models\testimoni;
use Illuminate\Database\Seeder;

class TestimonialsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimonials = [
            [
                'name' => 'Rayka Azzuri Ibrahim Talib',
                'role' => 'Pasien Klinik Lalita Cibubur',
                'testimonial_text' => 'Perkembangan rayka setelah terapi selama kurang lebih 2 tahun menunjukan banyak perubahan yg positif, kemampuan berbicara meningkat. Dari yang tidak bisa bicara sama sekali diusia 3 tahun sekarang sudah bisa komunikasi 2 arah. Dari segi perilaku sudah menunjukan perbaikan perilaku dan lebih mandiri',
                'image' => 'testimonial-1.jpg',
                'order_number' => 1,
                'status' => 'active'
            ],
            [
                'name' => 'Malik Febrian',
                'role' => 'Pasien Klinik Lalita Cibubur',
                'testimonial_text' => 'Anak saya senang terapi di Lalita Cibubur dan selalu tidak sabar menunggu hari terapinya karena terapisnya sangat ramah dan mengerti bagaimana harus menangani anak ABK. Tim frontliner, satpam dan OB bekerja dengan baik, sabar dan memberikan informasi dengan jelas dan hafal nama anak satu per satu. Ruang tunggunya nyaman, area playground dan toilet bersih dan dilengkapi dengan mushola.',
                'image' => 'testimonial-2.jpg',
                'order_number' => 2,
                'status' => 'active'
            ],
            [
                'name' => 'Siti Nurhaliza',
                'role' => 'Pasien Klinik Lalita Cibubur',
                'testimonial_text' => 'Al-Fatih Center memberikan pelayanan yang sangat baik. Terapis sangat profesional dan memperhatikan kebutuhan anak saya. Setelah beberapa bulan terapi, perkembangan anak saya sangat terlihat. Terima kasih Al-Fatih Center!',
                'image' => 'testimonial-3.jpg',
                'order_number' => 3,
                'status' => 'active'
            ],
        ];

        foreach ($testimonials as $testimonial) {
            testimoni::create($testimonial);
        }
    }
}