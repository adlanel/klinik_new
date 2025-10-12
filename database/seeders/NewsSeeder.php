<?php

namespace Database\Seeders;

use App\Models\news;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Str;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $news = [
            [
                'title' => 'Pentingnya Stimulasi Dini untuk Tumbuh Kembang Anak',
                'short_description' => 'Mengenal berbagai metode stimulasi yang dapat dilakukan orang tua untuk mendukung perkembangan optimal anak di masa emas.',
                'content' => '<p>Stimulasi dini memiliki peran yang sangat penting dalam tumbuh kembang anak. Periode 0-5 tahun dikenal sebagai periode emas (golden age) dimana perkembangan otak anak mencapai 80% dari otak orang dewasa.</p><p>Al-Fatih Center menekankan pentingnya memberikan stimulasi yang sesuai dengan tahapan perkembangan anak. Stimulasi dapat mencakup permainan, interaksi sosial, membaca buku, aktivitas fisik, dan berbagai kegiatan lainnya yang melibatkan indra anak.</p><p>Penelitian menunjukkan bahwa anak yang mendapatkan stimulasi yang cukup akan memiliki kemampuan kognitif, motorik, bahasa, dan sosial yang lebih baik di masa depan.</p>',
                'author' => 'Dr. Anisa Putri',
                'image' => 'news-stimulasi-dini.jpg',
                'published_at' => Carbon::now()->subDays(5),
                'status' => 'published',
            ],
            [
                'title' => 'Tips Mengatasi Anak dengan Gangguan Bicara dan Bahasa',
                'short_description' => 'Panduan praktis bagi orang tua dalam membantu anak yang mengalami keterlambatan bicara dengan metode yang efektif dan menyenangkan.',
                'content' => '<p>Gangguan bicara dan bahasa merupakan salah satu masalah tumbuh kembang yang cukup umum ditemui pada anak. Sebagai orang tua, penting untuk mengenali tanda-tanda keterlambatan bicara sejak dini.</p><p>Beberapa tips yang bisa dilakukan di rumah antara lain:</p><ul><li>Berbicara pada anak dengan jelas dan perlahan</li><li>Membacakan buku cerita setiap hari</li><li>Mengurangi penggunaan gadget yang berlebihan</li><li>Mengajak anak berkomunikasi dua arah</li><li>Menciptakan lingkungan yang kaya bahasa</li></ul><p>Jika keterlambatan bicara sudah mengganggu, segera konsultasikan dengan terapis wicara profesional untuk mendapatkan penanganan yang tepat.</p>',
                'author' => 'Terapis Maya Sari',
                'image' => 'news-gangguan-bicara.jpg',
                'published_at' => Carbon::now()->subDays(10),
                'status' => 'published',
            ],
            [
                'title' => 'Al-Fatih Center Mengadakan Workshop Parenting Bulan Depan',
                'short_description' => 'Ikuti workshop parenting dengan tema "Membangun Karakter Positif Anak" yang akan diselenggarakan oleh pakar psikologi anak terkemuka.',
                'content' => '<p>Al-Fatih Center dengan bangga mengumumkan akan mengadakan workshop parenting bertema "Membangun Karakter Positif Anak" pada tanggal 15 Oktober 2025.</p><p>Workshop ini akan dibawakan oleh Prof. Dr. Hendra Wijaya, seorang pakar psikologi anak dengan pengalaman lebih dari 20 tahun di bidangnya.</p><p>Materi yang akan dibahas meliputi:</p><ul><li>Prinsip dasar pembentukan karakter</li><li>Komunikasi efektif dengan anak</li><li>Mengatasi tantangan pengasuhan di era digital</li><li>Metode positive discipline</li></ul><p>Workshop akan berlangsung dari pukul 09.00 - 15.00 WIB dan termasuk makan siang serta materi workshop. Tempat terbatas, segera daftarkan diri Anda!</p>',
                'author' => 'Tim Al-Fatih Center',
                'image' => 'news-workshop.jpg',
                'published_at' => Carbon::now()->subDays(2),
                'status' => 'published',
            ],
            [
                'title' => 'Mengenal Metode Sensori Integrasi untuk Anak Berkebutuhan Khusus',
                'short_description' => 'Pendekatan terapi sensori integrasi yang dapat membantu anak-anak dengan gangguan pemrosesan sensorik untuk berkembang lebih optimal.',
                'content' => '<p>Terapi sensori integrasi merupakan salah satu metode yang sangat bermanfaat bagi anak-anak berkebutuhan khusus, terutama yang mengalami gangguan pemrosesan sensorik.</p><p>Terapi ini membantu anak mengorganisir dan memproses informasi sensorik dari lingkungan dengan lebih baik, sehingga dapat memberikan respons yang sesuai.</p><p>Di Al-Fatih Center, terapi sensori integrasi dilakukan oleh terapis okupasi berpengalaman dengan menggunakan berbagai alat seperti ayunan sensori, bola terapi, papan keseimbangan, dan berbagai tekstur untuk stimulasi taktil.</p><p>Terapi ini telah terbukti membantu meningkatkan kemampuan anak dalam fokus, koordinasi motorik, kemampuan belajar, dan keterampilan sosial.</p>',
                'author' => 'Terapis Okupasi Dimas',
                'image' => 'news-sensori-integrasi.jpg',
                'published_at' => Carbon::now()->subDays(15),
                'status' => 'published',
            ],
            [
                'title' => 'Peran Nutrisi dalam Perkembangan Otak Anak',
                'short_description' => 'Mengenal jenis makanan dan pola makan yang optimal untuk mendukung perkembangan kognitif dan kecerdasan anak sejak dini.',
                'content' => '<p>Nutrisi memainkan peran sangat penting dalam perkembangan otak anak, terutama di tahun-tahun pertama kehidupannya.</p><p>Beberapa nutrisi penting untuk perkembangan otak antara lain:</p><ul><li>Asam lemak omega-3 (terutama DHA) yang banyak terdapat pada ikan</li><li>Kolin yang terdapat pada telur dan kacang-kacangan</li><li>Zat besi dari daging merah, bayam, dan kacang-kacangan</li><li>Zinc dari daging, biji-bijian, dan produk susu</li><li>Vitamin B kompleks dari sayuran hijau dan biji-bijian utuh</li></ul><p>Pola makan seimbang dengan berbagai variasi makanan bergizi sangat dianjurkan untuk mendukung perkembangan kognitif optimal anak. Hindari makanan olahan yang tinggi gula, pengawet, dan pewarna buatan.</p>',
                'author' => 'Ahli Gizi Nadia Putri',
                'image' => 'news-nutrisi.jpg',
                'published_at' => Carbon::now()->subDays(20),
                'status' => 'published',
            ],
            [
                'title' => 'Mengenali Tanda-Tanda Autisme pada Anak Balita',
                'short_description' => 'Panduan untuk orang tua dalam mengidentifikasi gejala awal autisme dan langkah-langkah intervensi dini yang dapat dilakukan.',
                'content' => '<p>Mengenali tanda-tanda autisme sejak dini sangat penting untuk intervensi yang tepat waktu. Beberapa tanda yang perlu diwaspadai pada anak balita antara lain:</p><ul><li>Kurangnya kontak mata</li><li>Tidak merespon saat dipanggil namanya</li><li>Keterlambatan bicara atau kehilangan kemampuan berbicara yang sudah dimiliki</li><li>Perilaku repetitif atau stereotipik</li><li>Kesulitan dalam interaksi sosial dengan anak sebaya</li><li>Sensitif terhadap rangsangan sensorik tertentu (suara, sentuhan, dll)</li></ul><p>Jika Anda melihat tanda-tanda tersebut, segera konsultasikan dengan ahli. Intervensi dini seperti terapi wicara, terapi okupasi, dan Applied Behavior Analysis (ABA) dapat sangat membantu perkembangan anak dengan autisme.</p>',
                'author' => 'Dr. Bima Wicaksana, Sp.A',
                'image' => 'news-autisme.jpg',
                'published_at' => Carbon::now()->subDays(25),
                'status' => 'published',
            ],
        ];

        foreach ($news as $item) {
            Sc4::create([
                'title' => $item['title'],
                'slug' => Str::slug($item['title']),
                'short_description' => $item['short_description'],
                'content' => $item['content'],
                'image' => $item['image'],
                'author' => $item['author'],
                'published_at' => $item['published_at'],
                'status' => $item['status']
            ]);
        }
    }
}