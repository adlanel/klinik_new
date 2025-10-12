<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if table is empty
        if (DB::table('sc_3')->count() === 0) {
            $services = [
                [
                    'title' => 'Terapi Wicara',
                    'short_description' => 'Layanan terapi untuk membantu anak-anak dengan kesulitan berbicara, artikulasi, dan gangguan bahasa.',
                    'description' => '<p>Terapi wicara adalah bentuk pengobatan yang bertujuan untuk membantu anak-anak mengatasi kesulitan komunikasi, artikulasi, dan gangguan bahasa. Terapis wicara kami yang berpengalaman menggunakan teknik yang disesuaikan dengan kebutuhan spesifik setiap anak untuk membantu mereka mengembangkan keterampilan bahasa reseptif dan ekspresif.</p>
                    <p>Layanan ini cocok untuk anak-anak dengan:</p>
                    <ul>
                        <li>Kesulitan artikulasi dan pengucapan</li>
                        <li>Keterlambatan bahasa</li>
                        <li>Gangguan bahasa spesifik</li>
                        <li>Gangguan komunikasi sosial</li>
                        <li>Gangguan kefasihan (seperti gagap)</li>
                        <li>Masalah pengolahan pendengaran</li>
                    </ul>
                    <p>Program terapi wicara kami dirancang secara individual dan menggunakan pendekatan berbasis permainan yang membuat sesi terapi menyenangkan dan menarik bagi anak-anak.</p>',
                    'image' => 'terapi-wicara.jpg',
                    'status' => 'active',
                ],
                [
                    'title' => 'Terapi Okupasi',
                    'short_description' => 'Membantu anak mengembangkan keterampilan motorik halus, integrasi sensorik, dan fungsi sehari-hari.',
                    'description' => '<p>Terapi okupasi membantu anak-anak mengembangkan keterampilan yang mereka butuhkan untuk aktivitas kehidupan sehari-hari. Terapi ini berfokus pada pengembangan keterampilan motorik halus, integrasi sensorik, koordinasi visual-motorik, dan kemandirian dalam tugas-tugas sehari-hari.</p>
                    <p>Terapi okupasi dapat membantu anak-anak dengan:</p>
                    <ul>
                        <li>Kesulitan koordinasi dan keterampilan motorik halus</li>
                        <li>Masalah pemrosesan sensorik</li>
                        <li>Kesulitan perhatian dan konsentrasi</li>
                        <li>Tantangan dalam perencanaan motorik</li>
                        <li>Kesulitan dengan kegiatan perawatan diri</li>
                        <li>Keterlambatan perkembangan</li>
                    </ul>
                    <p>Terapis okupasi kami bekerja sama dengan keluarga untuk mengembangkan program yang mendukung perkembangan keterampilan dalam lingkungan bermain yang menyenangkan.</p>',
                    'image' => 'terapi-okupasi.jpg',
                    'status' => 'active',
                ],
                [
                    'title' => 'Terapi Fisik',
                    'short_description' => 'Fokus pada pengembangan keterampilan motorik kasar, keseimbangan, koordinasi, dan kekuatan fisik.',
                    'description' => '<p>Terapi fisik di Klinik Alfatih Center berfokus pada meningkatkan keterampilan motorik kasar, kekuatan, keseimbangan, dan koordinasi anak-anak. Tim terapis fisik kami menggunakan berbagai teknik dan aktivitas untuk membantu anak-anak mencapai tonggak perkembangan fisik mereka.</p>
                    <p>Layanan terapi fisik kami dapat membantu anak-anak dengan:</p>
                    <ul>
                        <li>Keterlambatan perkembangan motorik</li>
                        <li>Masalah postur dan keseimbangan</li>
                        <li>Kelemahan otot</li>
                        <li>Gangguan koordinasi</li>
                        <li>Keterbatasan rentang gerak</li>
                        <li>Cerebral palsy dan kondisi neurologis lainnya</li>
                    </ul>
                    <p>Program terapi fisik kami dirancang secara individual berdasarkan kebutuhan spesifik setiap anak, dengan tujuan meningkatkan fungsi fisik dan kemandirian mereka dalam aktivitas sehari-hari.</p>',
                    'image' => 'terapi-fisik.jpg',
                    'status' => 'active',
                ],
                [
                    'title' => 'Konseling Psikologi',
                    'short_description' => 'Layanan konsultasi psikologi untuk mendukung kesehatan mental dan perkembangan emosional anak.',
                    'description' => '<p>Layanan konseling psikologi kami menyediakan dukungan kesehatan mental dan emosional bagi anak-anak dan keluarga. Psikolog anak kami yang berkualifikasi membantu mengatasi berbagai tantangan perkembangan, perilaku, dan emosional.</p>
                    <p>Layanan konseling psikologi kami dapat membantu dengan:</p>
                    <ul>
                        <li>Masalah perilaku dan disiplin</li>
                        <li>Kecemasan dan ketakutan pada anak</li>
                        <li>Kesulitan penyesuaian sosial</li>
                        <li>Tantangan pengasuhan</li>
                        <li>Masalah konsentrasi dan perhatian</li>
                        <li>Trauma dan stres</li>
                        <li>Manajemen emosi</li>
                    </ul>
                    <p>Pendekatan kami berfokus pada anak secara keseluruhan dan melibatkan keluarga dalam proses terapi, menciptakan sistem dukungan komprehensif untuk membantu anak-anak berkembang secara emosional dan sosial.</p>',
                    'image' => 'konseling-psikologi.jpg',
                    'status' => 'active',
                ],
            ];
            
            foreach ($services as $service) {
                DB::table('sc_3')->insert([
                    'title' => $service['title'],
                    'slug' => Str::slug($service['title']),
                    'short_description' => $service['short_description'],
                    'description' => $service['description'],
                    'image' => $service['image'],
                    'status' => $service['status'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
    }
}