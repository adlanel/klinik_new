@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="relative pt-32 pb-24 bg-gradient-to-b from-blue-50 to-white overflow-hidden">
    <!-- Background decorative elements -->
    <div class="absolute inset-0 z-0">
        <div class="absolute top-0 right-0 w-96 h-96 bg-blue-200 rounded-full opacity-20 -mr-32 -mt-32"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-blue-300 rounded-full opacity-10 -ml-40 -mb-40"></div>
        <div class="absolute top-1/3 left-1/4 w-24 h-24 bg-yellow-200 rounded-full opacity-30 blur-xl"></div>
        <!-- Dotted pattern -->
        <div class="absolute inset-0" style="background-image: radial-gradient(#3b82f6 1px, transparent 2px); background-size: 30px 30px; opacity: 0.1;"></div>
    </div>

    <div class="container mx-auto px-6 relative z-10">
        <div class="max-w-4xl mx-auto text-center mb-12">
            <h1 class="text-5xl md:text-6xl font-bold text-gray-800 mb-6">Tentang Kami</h1>
            <div class="w-24 h-1.5 bg-blue-600 mx-auto mb-8 rounded-full"></div>
            <p class="text-xl text-gray-600 leading-relaxed">
                Mengenal lebih dekat Klinik Alfatih Center, mitra terpercaya dalam mendampingi tumbuh kembang anak dengan pendekatan terbaik
            </p>
        </div>
        
        <div class="relative mx-auto max-w-6xl">
            <div class="absolute -inset-1.5 rounded-xl bg-gradient-to-r from-blue-500 to-blue-600 opacity-30 blur"></div>
            <img 
                src="{{ $aboutSection->image_url }}" 
                alt="Klinik Alfatih Center" 
                class="w-full h-auto object-cover rounded-xl relative shadow-2xl"
                style="aspect-ratio: 16/6;"
            >
        </div>
    </div>
</section>

<!-- Main Content Section -->
<section class="py-20">
    <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto">
            <div class="prose prose-lg max-w-none">
                <h2 class="text-3xl font-bold text-blue-700 mb-6">{{ $aboutSection->title }}</h2>
                
                <p class="mb-8 text-lg text-gray-700">
                    {{ $aboutSection->description }}
                </p>
                
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Visi Kami</h3>
                <p class="mb-8 text-lg text-gray-700">
                    Menjadi pusat terapi dan tumbuh kembang anak terdepan yang diakui secara nasional dengan standar pelayanan profesional dan pendekatan yang holistik, serta menjadi rujukan utama bagi keluarga dalam mendukung perkembangan optimal anak-anak Indonesia.
                </p>
                
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Misi Kami</h3>
                <ul class="list-disc pl-6 mb-8 text-lg text-gray-700 space-y-2">
                    <li>Memberikan layanan terapi berkualitas tinggi dengan pendekatan yang dipersonalisasi sesuai kebutuhan setiap anak</li>
                    <li>Mengembangkan metode terapi inovatif yang mengintegrasikan aspek fisik, kognitif, emosional, dan sosial anak</li>
                    <li>Membangun tim profesional yang kompeten, berdedikasi dan terus berkembang dalam bidang terapi anak</li>
                    <li>Melibatkan keluarga secara aktif dalam proses terapi untuk mencapai hasil terbaik dan berkelanjutan</li>
                    <li>Mengedukasi masyarakat tentang pentingnya deteksi dini dan penanganan tepat untuk berbagai kondisi tumbuh kembang anak</li>
                </ul>
                
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Nilai-Nilai Kami</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="bg-blue-50 p-6 rounded-lg">
                        <h4 class="font-semibold text-xl text-blue-700 mb-2">Profesionalisme</h4>
                        <p class="text-gray-700">Kami berkomitmen untuk memberikan standar pelayanan tertinggi dengan integritas dan etika profesional dalam setiap aspek pekerjaan kami.</p>
                    </div>
                    <div class="bg-blue-50 p-6 rounded-lg">
                        <h4 class="font-semibold text-xl text-blue-700 mb-2">Kasih Sayang</h4>
                        <p class="text-gray-700">Pendekatan kami didasari oleh kasih sayang dan empati terhadap setiap anak dan keluarga yang kami dampingi.</p>
                    </div>
                    <div class="bg-blue-50 p-6 rounded-lg">
                        <h4 class="font-semibold text-xl text-blue-700 mb-2">Inovasi</h4>
                        <p class="text-gray-700">Kami terus mengembangkan metode dan pendekatan baru untuk meningkatkan efektivitas terapi dan pelayanan kami.</p>
                    </div>
                    <div class="bg-blue-50 p-6 rounded-lg">
                        <h4 class="font-semibold text-xl text-blue-700 mb-2">Kolaborasi</h4>
                        <p class="text-gray-700">Kami percaya pada kekuatan kerja sama antara terapis, keluarga, dan anak untuk mencapai hasil terbaik.</p>
                    </div>
                </div>
                
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Sejarah Kami</h3>
                <p class="mb-4 text-lg text-gray-700">
                    Klinik Alfatih Center didirikan pada tahun 2018 oleh sekelompok terapis dan praktisi kesehatan anak yang berdedikasi dengan visi untuk menciptakan pusat terapi yang komprehensif bagi anak-anak dengan berbagai kebutuhan perkembangan khusus.
                </p>
                <p class="mb-4 text-lg text-gray-700">
                    Bermula dari klinik kecil dengan layanan terbatas, Klinik Alfatih Center terus berkembang dan kini menjadi salah satu pusat terapi terkemuka dengan berbagai layanan spesialisasi dan fasilitas modern yang dirancang khusus untuk mendukung perkembangan optimal anak.
                </p>
                <p class="mb-8 text-lg text-gray-700">
                    Sepanjang perjalanan kami, ribuan anak telah memperoleh manfaat dari program terapi kami, dan kami berkomitmen untuk terus berkembang dan berinovasi demi memberikan pelayanan terbaik bagi setiap anak yang datang ke klinik kami.
                </p>
                
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Tim Profesional</h3>
                <p class="mb-8 text-lg text-gray-700">
                    Klinik Alfatih Center dikelola oleh tim terapis dan spesialis yang berpengalaman di bidangnya masing-masing. Tim kami terdiri dari terapis wicara, terapis okupasi, fisioterapis, psikolog anak, dan spesialis pendidikan khusus yang terus mengembangkan keahlian mereka melalui pelatihan dan pendidikan berkelanjutan.
                </p>
                
                <div class="bg-blue-50 p-8 rounded-xl border border-blue-100 mb-8">
                    <h3 class="text-2xl font-bold text-blue-700 mb-4">Komitmen Kami</h3>
                    <p class="text-lg text-gray-700">
                        Di Klinik Alfatih Center, kami berkomitmen untuk:
                    </p>
                    <ul class="list-disc pl-6 mt-4 text-lg text-gray-700 space-y-2">
                        <li>Memprioritaskan kesejahteraan dan kemajuan setiap anak</li>
                        <li>Menghargai keunikan dan potensi individu</li>
                        <li>Memberikan lingkungan yang aman, nyaman dan mendukung</li>
                        <li>Terus meningkatkan kualitas layanan melalui inovasi dan penelitian</li>
                        <li>Menjaga komunikasi terbuka dan kolaborasi dengan keluarga</li>
                    </ul>
                </div>
            </div>
            
            <!-- CTA Section -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-xl p-8 text-white text-center mt-12">
                <h3 class="text-2xl font-bold mb-4">Jadwalkan Konsultasi</h3>
                <p class="mb-6">Buat janji konsultasi dengan terapis kami untuk memulai perjalanan perkembangan anak Anda</p>
                <a href="#consultation-form" class="inline-flex items-center px-6 py-3 bg-white text-blue-700 font-bold rounded-lg hover:bg-blue-50 transition duration-300">
                    Buat Janji Sekarang
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>

@endsection