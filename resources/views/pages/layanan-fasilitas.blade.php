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
            <h1 class="text-5xl md:text-6xl font-bold text-gray-800 mb-6">Layanan & Fasilitas</h1>
            <div class="w-24 h-1.5 bg-blue-600 mx-auto mb-8 rounded-full"></div>
            <p class="text-xl text-gray-600 leading-relaxed">
                Mengenal berbagai layanan dan fasilitas terbaik yang kami sediakan untuk mendukung tumbuh kembang anak
            </p>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="py-20">
    <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">Layanan Kami</h2>
            <div class="w-16 h-1.5 bg-blue-500 mx-auto mb-6 rounded-full"></div>
            <p class="text-xl text-gray-600">
                Berbagai layanan terapi dan pendampingan untuk perkembangan optimal anak
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
            @foreach($layananList as $layanan)
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                <div class="relative h-56 overflow-hidden">
                    <img 
                        src="{{ asset('storage/homepage/layanan/' . $layanan->image) }}" 
                        alt="{{ $layanan->title }}" 
                        class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                        onerror="this.src='https://via.placeholder.com/600x400/e2f1ff/2563eb?text={{ urlencode($layanan->title) }}'"
                    >
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
                    <h3 class="absolute bottom-4 left-4 text-xl font-bold text-white">{{ $layanan->title }}</h3>
                </div>
                <div class="p-6">
                    <p class="text-gray-700 mb-4">{{ $layanan->short_description }}</p>
                    <a href="{{ route('service.show', $layanan->slug) }}" class="inline-flex items-center text-blue-600 font-semibold group">
                        Pelajari Selengkapnya
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 transform transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Facilities Section -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">Fasilitas Kami</h2>
            <div class="w-16 h-1.5 bg-blue-500 mx-auto mb-6 rounded-full"></div>
            <p class="text-xl text-gray-600">
                Lingkungan dan sarana yang dirancang khusus untuk mendukung proses terapi
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($fasilitasList as $fasilitas)
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                <div class="relative h-56 overflow-hidden">
                    <img 
                        src="{{ asset('storage/homepage/fasilitas/' . $fasilitas->image) }}" 
                        alt="{{ $fasilitas->title }}" 
                        class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                        onerror="this.src='https://via.placeholder.com/600x400/e6f7ff/0284c7?text={{ urlencode($fasilitas->title) }}'"
                    >
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $fasilitas->title }}</h3>
                    <p class="text-gray-700">{{ $fasilitas->short_description }}</p>
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <p class="text-gray-600 text-sm italic">{{ $fasilitas->description }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>



<!-- FAQ Section -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Pertanyaan Umum</h2>
                <div class="w-16 h-1.5 bg-blue-500 mx-auto mb-6 rounded-full"></div>
                <p class="text-xl text-gray-600">
                    Jawaban untuk pertanyaan yang sering diajukan tentang layanan dan fasilitas kami
                </p>
            </div>

            <div class="space-y-6">
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Apakah perlu melakukan janji temu terlebih dahulu?</h3>
                    <p class="text-gray-700">Ya, kami menyarankan untuk membuat janji temu terlebih dahulu agar kami dapat menyediakan waktu dan terapis yang sesuai untuk kebutuhan Anda. Anda dapat membuat janji melalui formulir online di situs kami atau menghubungi kami melalui telepon.</p>
                </div>
                
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Berapa lama satu sesi terapi?</h3>
                    <p class="text-gray-700">Satu sesi terapi biasanya berlangsung selama 45-60 menit, tergantung pada jenis terapi dan kebutuhan anak. Durasi ini sudah termasuk waktu konsultasi singkat dengan orang tua sebelum atau sesudah sesi terapi.</p>
                </div>
                
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Apakah orang tua boleh mendampingi selama sesi terapi?</h3>
                    <p class="text-gray-700">Ya, orang tua diperbolehkan dan bahkan dianjurkan untuk mendampingi anak selama sesi terapi, terutama pada sesi-sesi awal. Hal ini membantu orang tua memahami proses terapi dan dapat melanjutkan latihan di rumah.</p>
                </div>
                
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Apakah layanan terapi ditanggung asuransi?</h3>
                    <p class="text-gray-700">Beberapa asuransi kesehatan mungkin menanggung biaya terapi dengan syarat dan ketentuan tertentu. Kami menyarankan untuk mengkonfirmasi langsung dengan pihak asuransi Anda mengenai cakupan layanan terapi.</p>
                </div>
                
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Bagaimana cara mengetahui perkembangan anak selama terapi?</h3>
                    <p class="text-gray-700">Kami melakukan evaluasi berkala dan memberikan laporan perkembangan kepada orang tua. Selain itu, terapis juga akan berdiskusi dengan orang tua setelah setiap sesi untuk memberikan update dan saran untuk latihan di rumah.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection