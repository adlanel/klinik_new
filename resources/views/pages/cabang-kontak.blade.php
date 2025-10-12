@extends('layouts.app')

@section('title', 'Cabang & Kontak - Klinik Alfatih Center')

@section('content')
<div class="bg-gradient-to-r from-blue-500 to-indigo-600 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-4">Cabang & Kontak Kami</h1>
            <p class="text-xl text-white opacity-90 max-w-3xl mx-auto">
                Temukan lokasi Klinik Alfatih Center terdekat untuk layanan konsultasi dan terapi tumbuh kembang anak
            </p>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="max-w-3xl mx-auto mb-12">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Informasi Kontak</h2>
            <div class="space-y-4">
                <div class="flex items-start">
                    <div class="flex-shrink-0 mt-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-lg font-medium text-gray-800">Email</p>
                        <p class="text-gray-600">info@alfatihcenter.com</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <div class="flex-shrink-0 mt-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-lg font-medium text-gray-800">Telepon Pusat</p>
                        <p class="text-gray-600">+62 811-1234-5678</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <div class="flex-shrink-0 mt-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-lg font-medium text-gray-800">Jam Operasional</p>
                        <p class="text-gray-600">Senin - Jumat: 08.00 - 17.00</p>
                        <p class="text-gray-600">Sabtu: 08.00 - 15.00</p>
                        <p class="text-gray-600">Minggu: Tutup</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-12">
        <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Lokasi Cabang Kami</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($branches as $branch)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $branch->nama_cabang }}</h3>
                    <div class="mb-4">
                        <div class="flex items-start mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <p class="ml-2 text-gray-600">{{ $branch->alamat }}</p>
                        </div>
                        <div class="flex items-center mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <p class="ml-2 text-gray-600">{{ $branch->no_telp }}</p>
                        </div>
                    </div>
                    <div class="aspect-w-16 aspect-h-9 rounded-md overflow-hidden mb-4">
                        @php
                            // Convert short Google Maps links to embed URLs
                            $mapUrl = $branch->link_maps;
                            // Extract location from Google Maps short URL
                            $location = urlencode($branch->alamat);
                            $embedUrl = "https://www.google.com/maps/embed/v1/place?key=YOUR_API_KEY&q=" . $location;
                        @endphp
                        <div class="w-full h-56 rounded-md overflow-hidden">
                            <iframe
                                width="100%"
                                height="100%"
                                style="border:0"
                                loading="lazy"
                                allowfullscreen
                                src="https://maps.google.com/maps?q={{ urlencode($branch->alamat) }}&output=embed">
                            </iframe>
                        </div>
                    </div>
                    <a href="{{ $branch->link_maps }}" 
                       target="_blank" 
                       rel="noopener noreferrer" 
                       class="flex items-center justify-center px-4 py-2 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                        </svg>
                        Lihat di Google Maps
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection