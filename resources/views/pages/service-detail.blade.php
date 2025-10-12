@extends('layouts.app')

@section('title', $service->title . ' - Al-Fatih Center')

@push('styles')
<style>
    .text-justify p {
        text-align: justify;
        margin-bottom: 1.75rem;
    }
    .space-y-8 > p {
        margin-top: 2rem;
        margin-bottom: 2rem;
    }
    .space-y-8 > ul {
        margin-top: 2rem;
        margin-bottom: 2rem;
    }
</style>
@endpush

@section('content')

    <!-- Hero Banner -->
    <section class="relative">
        <div class="w-full h-64 md:h-80 lg:h-96 bg-gradient-to-r from-blue-800 to-blue-600 overflow-hidden">
            <img src="{{ $service->image_url }}" alt="{{ $service->title }}" class="w-full h-full object-cover opacity-50">
            <div class="absolute inset-0 bg-gradient-to-t from-blue-900/70 to-blue-800/50"></div>
            <div class="absolute inset-0 flex items-center justify-center text-center p-4">
                <div class="max-w-4xl">
                    <h1 class="text-3xl md:text-5xl font-bold mb-4 text-white">{{ $service->title }}</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Service Content -->
    <section class="py-12 md:py-16">
        <div class="container mx-auto px-4 md:px-8 max-w-5xl">
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6 md:p-10">
                    <!-- Featured Service Image -->
                    <div class="mb-10 rounded-xl overflow-hidden shadow-lg transform hover:scale-[1.01] transition-transform duration-300">
                        <img 
                            src="{{ $service->image_url }}" 
                            alt="{{ $service->title }}" 
                            class="w-full h-auto object-cover"
                            style="max-height: 500px; width: 100%;"
                        >
                        <div class="bg-gradient-to-r from-blue-600 to-blue-800 py-4 px-6">
                            <h2 class="text-xl md:text-2xl font-bold text-white">{{ $service->title }}</h2>
                        </div>
                    </div>
                    
                    <div class="prose prose-lg max-w-none prose-headings:text-blue-700 prose-a:text-blue-600 prose-ul:mb-8 prose-li:mb-2 prose-li:text-gray-700">
                        <h2 class="text-3xl font-bold text-blue-700 mb-6">Detail Layanan</h2>
                        <div class="text-justify space-y-8">
                            {!! $service->description !!}
                        </div>
                    </div>
                    
                    <div class="mt-12 flex justify-center">
                        <a href="{{ route('home') }}" class="inline-flex items-center px-8 py-3 bg-blue-600 text-white font-medium rounded-lg transition-colors hover:bg-blue-700">
                            Kembali ke Beranda
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Other Services -->
    <section class="py-12 bg-blue-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12 text-blue-800">Layanan Lainnya</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($otherServices as $otherService)
                <div class="bg-white rounded-xl shadow-md overflow-hidden transition-transform hover:scale-[1.02] duration-300">
                    <div class="h-48 overflow-hidden">
                        <img src="{{ $otherService->image_url }}" alt="{{ $otherService->title }}" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-xl mb-2 text-blue-700">{{ $otherService->title }}</h3>
                        <p class="text-gray-600 mb-4 line-clamp-3">{{ $otherService->short_description }}</p>
                        <a href="{{ route('service.show', $otherService->slug) }}" class="text-blue-600 font-medium flex items-center">
                            Selengkapnya
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection