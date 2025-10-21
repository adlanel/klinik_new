<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Beranda - Al-Fatih Center</title>
    @vite('resources/css/app.css')
    
    <!-- Custom Slider CSS -->
    <style>
        .slider-container {
            width: 100%;
            overflow: hidden;
            max-width: 100vw;
            position: relative;
        }
        
        .slider {
            width: 100%;
            position: relative;
            display: flex;
            transition: transform 0.6s ease-in-out;
        }
        
        .slider-item {
            width: 100%;
            min-width: 100%;
            flex: 0 0 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            background-color: #f0f0f0;
        }
        
        .slider-arrow {
            cursor: pointer;
            transition: all 0.3s ease;
            z-index: 20;
            opacity: 0.5;
        }
        
        .slider-arrow:hover {
            transform: translateY(-50%) scale(1.1);
            opacity: 0.9;
        }
        
        .slider-container:hover .slider-arrow {
            opacity: 0.7;
        }
        
        .slider-dot {
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .slider-dot.active {
            width: 1rem; /* Make active dot wider but not too much */
            opacity: 0.9;
        }
        
        /* Add sliding animation */
        @keyframes slideFromRight {
            from {transform: translateX(100%);}
            to {transform: translateX(0);}
        }
        
        @keyframes slideFromLeft {
            from {transform: translateX(-100%);}
            to {transform: translateX(0);}
        }
        }
    </style>
</head>
<body class="bg-gray-50 overflow-x-hidden">
    <style>
        /* Control dropdown option styling */
        select#cabang_id {
            width: 100%;
            text-overflow: ellipsis;
        }
        
        select#cabang_id option {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            padding: 8px; /* Add padding for better readability */
            font-size: 14px; /* Consistent font size */
            max-width: 100%;
        }
    </style>

    <!-- Include Navbar -->
    @include('components.navbar')

    <!-- Hero Slider Section -->
    <section class="relative overflow-hidden w-full">
        @if(count($sliders) > 0)
            <div class="slider-container relative w-full">
                <!-- Slider Items -->
                <div class="slider w-full">
                    @foreach($sliders as $slider)
                        <div class="slider-item relative w-full">
                            @if($slider->link_url)
                                <a href="{{ $slider->link_url }}" target="_blank" class="block w-full">
                                    <!-- Desktop Image (hidden on mobile) -->
                                    <img src="{{ $slider->desktop_image_url }}" alt="Slider image {{ $slider->order_number }}" class="hidden md:block w-full object-contain cursor-pointer hover:opacity-90 transition-opacity" style="max-height: 600px; width: 100%;">
                                    
                                    <!-- Mobile Image (visible only on mobile) -->
                                    <img src="{{ $slider->mobile_image_url }}" alt="Slider image {{ $slider->order_number }}" class="block md:hidden w-full object-contain cursor-pointer hover:opacity-90 transition-opacity" style="max-height: 500px; width: 100%;">
                                </a>
                            @else
                                <!-- Desktop Image (hidden on mobile) -->
                                <img src="{{ $slider->desktop_image_url }}" alt="Slider image {{ $slider->order_number }}" class="hidden md:block w-full object-contain" style="max-height: 600px; width: 100%;">
                                
                                <!-- Mobile Image (visible only on mobile) -->
                                <img src="{{ $slider->mobile_image_url }}" alt="Slider image {{ $slider->order_number }}" class="block md:hidden w-full object-contain" style="max-height: 500px; width: 100%;">
                            @endif
                            
                            <!-- Overlay text has been removed -->
                        </div>
                    @endforeach
                </div>
                
                <!-- Navigation Arrows - Smaller on mobile -->
                <button class="slider-arrow prev absolute top-1/2 left-2 md:left-4 transform -translate-y-1/2 bg-white bg-opacity-20 hover:bg-opacity-50 rounded-full p-1 md:p-2 focus:outline-none z-10 backdrop-blur-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 md:h-6 md:w-6 text-gray-700 opacity-70" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button class="slider-arrow next absolute top-1/2 right-2 md:right-4 transform -translate-y-1/2 bg-white bg-opacity-20 hover:bg-opacity-50 rounded-full p-1 md:p-2 focus:outline-none z-10 backdrop-blur-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 md:h-6 md:w-6 text-gray-700 opacity-70" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
                
                <!-- Slider Dots - Only visible on desktop -->
                <div class="slider-dots absolute bottom-4 left-1/2 transform -translate-x-1/2 hidden md:flex space-x-3 z-10 py-1 px-3 rounded-full bg-black bg-opacity-10 backdrop-blur-sm">
                    @foreach($sliders as $index => $slider)
                        <button class="slider-dot w-2 h-2 rounded-full bg-white bg-opacity-30 hover:bg-opacity-60 transition-all {{ $index === 0 ? 'active bg-opacity-50' : '' }}"
                            data-index="{{ $index }}">
                        </button>
                    @endforeach
                </div>
            </div>
        @else
            <!-- Fallback if no sliders are found -->
            <div class="container mx-auto px-4 py-20 bg-gradient-to-r from-blue-600 to-blue-800 text-white">
                <div class="text-center">
                    <h1 class="text-3xl md:text-5xl font-bold mb-6">
                        Selamat Datang di Al-Fatih Center
                    </h1>
                    <p class="text-lg md:text-xl mb-8 max-w-2xl mx-auto">
                        Pusat Tumbuh Kembang Anak
                    </p>
                    <div class="space-x-2 md:space-x-4">
                        <a href="/buat-janji" 
                           class="bg-white text-blue-600 px-4 md:px-8 py-2 md:py-4 rounded-lg font-semibold hover:bg-gray-100 transition-colors inline-block text-sm md:text-base">
                            Buat Janji Sekarang
                        </a>
                        <a href="/fasilitas" 
                           class="border-2 border-white text-white px-4 md:px-8 py-2 md:py-4 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition-colors inline-block text-sm md:text-base">
                            Lihat Fasilitas
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </section>

    <!-- About Us Section -->
    <section class="py-20 relative overflow-hidden">
        <!-- Decorative background elements -->
        <div class="absolute inset-0 bg-gradient-to-b from-white via-blue-50 to-blue-100 opacity-80 z-0"></div>
        
        <!-- Decorative shapes -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-blue-200 rounded-full opacity-20 -mr-20 -mt-20 z-0"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-blue-300 rounded-full opacity-10 -ml-40 -mb-40 z-0"></div>
        <div class="absolute top-1/2 left-1/4 w-20 h-20 bg-yellow-200 rounded-full opacity-30 blur-2xl z-0"></div>
        
        <!-- Wave pattern at the bottom -->
        <div class="absolute bottom-0 left-0 right-0 h-20 z-0">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="w-full h-full">
                <path fill="#dbeafe" fill-opacity="0.4" d="M0,128L48,138.7C96,149,192,171,288,186.7C384,203,480,213,576,202.7C672,192,768,160,864,154.7C960,149,1056,171,1152,170.7C1248,171,1344,149,1392,138.7L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
            </svg>
        </div>
        
        <!-- Dotted pattern -->
        <div class="absolute inset-0 z-0" style="background-image: radial-gradient(#3b82f6 1px, transparent 2px); background-size: 30px 30px; opacity: 0.1;"></div>
        
        <div class="container mx-auto px-6 md:px-12 max-w-6xl relative z-10">
            <div class="flex flex-col md:flex-row items-center gap-10 md:gap-16">
                <!-- Image Column with enhanced styling -->
                <div class="w-full md:w-1/2">
                    <div class="relative rounded-xl overflow-hidden shadow-2xl transform transition-transform hover:scale-[1.02] duration-300 border-2 border-white/30">
                        <!-- Decorative corner elements -->
                        <div class="absolute top-0 left-0 w-12 h-12 border-t-4 border-l-4 border-blue-500 rounded-tl-lg"></div>
                        <div class="absolute top-0 right-0 w-12 h-12 border-t-4 border-r-4 border-blue-500 rounded-tr-lg"></div>
                        <div class="absolute bottom-0 left-0 w-12 h-12 border-b-4 border-l-4 border-blue-500 rounded-bl-lg"></div>
                        <div class="absolute bottom-0 right-0 w-12 h-12 border-b-4 border-r-4 border-blue-500 rounded-br-lg"></div>
                        
                        <img 
                            src="{{ $aboutSection->image_url }}" 
                            alt="Klinik Alfatih Center" 
                            class="w-full h-auto object-cover rounded-xl"
                            style="aspect-ratio: 16/9;"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-blue-900/40 to-transparent"></div>
                    </div>
                </div>
                
                <!-- Content Column with enhanced styling -->
                <div class="w-full md:w-1/2">
                    <div class="p-6 md:p-8 bg-white/60 backdrop-blur-sm rounded-2xl shadow-lg border border-white/50">
                        <h2 class="text-4xl md:text-5xl font-bold mb-8 text-blue-700 relative inline-block">
                            {{ $aboutSection->title }}
                            <span class="absolute -bottom-3 left-0 w-full h-1.5 bg-blue-500 rounded animate-pulse"></span>
                            <div class="absolute -right-8 -top-8 w-16 h-16 bg-yellow-200 rounded-full opacity-30 blur-xl z-0"></div>
                        </h2>
                        
                        <p class="text-lg md:text-xl text-gray-700 leading-relaxed mb-8 mt-8 relative">
                            <span class="absolute -left-3 top-0 text-5xl text-blue-200 opacity-50">"</span>
                            {{ $aboutSection->description }}
                            <span class="absolute -right-3 bottom-0 text-5xl text-blue-200 opacity-50">"</span>
                        </p>
                        
                        <div class="mt-10 relative">
                            <div class="absolute -left-4 -right-4 -bottom-4 -top-4 bg-blue-50/50 rounded-xl -z-10"></div>
                            <a href="{{ route('about.index') }}" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-blue-700 text-lg text-white font-medium rounded-lg transition-all duration-300 hover:shadow-lg hover:shadow-blue-500/30 hover:-translate-y-1 group">
                                Pelajari Lebih Lanjut
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-2 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="py-20 relative overflow-hidden bg-gradient-to-b from-blue-100 via-blue-50 to-white">
        <!-- Background Decorative Elements -->
        <div class="absolute inset-0 z-0">
            <!-- Abstract shapes -->
            <div class="absolute top-0 right-0 w-96 h-96 bg-gradient-to-br from-blue-200 to-blue-100 rounded-full opacity-30 -mr-20 -mt-20"></div>
            <div class="absolute bottom-0 left-0 w-80 h-80 bg-gradient-to-tr from-blue-300 to-blue-200 rounded-full opacity-20 -ml-20 -mb-20"></div>
            
            <!-- Dotted pattern -->
            <div class="absolute inset-0" style="background-image: radial-gradient(#3b82f6 0.5px, transparent 1px); background-size: 20px 20px; opacity: 0.1;"></div>
            
            <!-- Wave pattern -->
            <div class="absolute top-0 left-0 right-0 h-20 transform rotate-180">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="w-full">
                    <path fill="#eff6ff" fill-opacity="0.6" d="M0,64L48,85.3C96,107,192,149,288,170.7C384,192,480,192,576,170.7C672,149,768,107,864,90.7C960,75,1056,85,1152,90.7C1248,96,1344,96,1392,96L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
                </svg>
            </div>
        </div>
        
        <div class="container mx-auto px-6 md:px-12 max-w-6xl relative z-10">
            <!-- Enhanced Header -->
            <div class="text-center mb-16 relative">
                <!-- Decorative elements around header -->
               
                
                <h2 class="text-4xl md:text-5xl font-bold text-blue-800 mb-6 relative inline-block">
                    Layanan Kami
                    <div class="absolute -right-8 -top-8 w-16 h-16 bg-yellow-300 rounded-full opacity-20 blur-xl z-0"></div>
                    <div class="absolute -left-8 -bottom-2 w-12 h-12 bg-blue-400 rounded-full opacity-20 blur-lg z-0"></div>
                </h2>
                
                <p class="text-lg md:text-xl text-gray-600 max-w-3xl mx-auto relative">
                    Kami menyediakan berbagai layanan profesional untuk mendukung tumbuh kembang anak secara optimal.
                </p>
                
                <!-- Decorative divider -->
                <div class="w-24 h-1.5 bg-gradient-to-r from-blue-400 to-blue-600 mx-auto mt-8 rounded-full"></div>
            </div>
            
            <!-- Enhanced Service Cards - Centered Layout -->
            <div class="flex justify-center">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-4xl">
                @foreach($services as $service)
                <div class="group bg-white rounded-2xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-2xl hover:-translate-y-2 relative border border-blue-100/50">
                    <!-- Card corner accents -->
                    <div class="absolute top-0 left-0 w-10 h-10 border-t-4 border-l-4 border-blue-400 rounded-tl-xl opacity-50 transition-opacity group-hover:opacity-100"></div>
                    <div class="absolute bottom-0 right-0 w-10 h-10 border-b-4 border-r-4 border-blue-400 rounded-br-xl opacity-50 transition-opacity group-hover:opacity-100"></div>
                    
                    <!-- Enhanced image container -->
                    <div class="h-48 overflow-hidden relative">
                        <!-- Overlay gradient on hover -->
                        <div class="absolute inset-0 bg-gradient-to-t from-blue-900/60 via-blue-900/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10"></div>
                        
                        <img 
                            src="{{ $service->image_url }}" 
                            alt="{{ $service->title }}" 
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                        >
                        
                        <!-- Quick view button that appears on hover -->
                        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 z-20">
                            <span class="bg-white/90 backdrop-blur-sm text-blue-700 px-4 py-2 rounded-full font-medium text-sm shadow-lg">
                                Lihat Layanan
                            </span>
                        </div>
                    </div>
                    
                    <!-- Enhanced content -->
                    <div class="p-6 relative">
                        <!-- Service icon (placeholder - you can replace with actual icons) -->
                        <div class="absolute -top-8 right-6 bg-gradient-to-br from-blue-500 to-blue-700 text-white w-16 h-16 rounded-full flex items-center justify-center shadow-lg border-4 border-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        
                        <h3 class="font-bold text-xl mb-3 text-blue-800 group-hover:text-blue-600 transition-colors">{{ $service->title }}</h3>
                        <p class="text-gray-600 mb-5 line-clamp-3">{{ $service->short_description }}</p>
                        
                        <a 
                            href="{{ route('service.show', $service->slug) }}" 
                            class="inline-flex items-center px-5 py-2.5 bg-blue-100 text-blue-700 rounded-lg font-medium group-hover:bg-blue-600 group-hover:text-white transition-all duration-300"
                        >
                            <span>Lihat Detail</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                    </div>
                </div>
                @endforeach
                </div>
            </div>
            
            <!-- Enhanced CTA button -->
            <div class="text-center mt-16">
                <div class="relative inline-block">
                    <!-- Button glow effect -->
                    <div class="absolute -inset-1 bg-gradient-to-r from-blue-600 to-blue-400 rounded-lg blur opacity-30 group-hover:opacity-100 transition duration-1000 group-hover:duration-200"></div>
                    
                    <a href="{{ route('layanan-fasilitas.index') }}" class="relative inline-flex items-center px-8 py-4 bg-white border-2 border-blue-600 text-blue-600 font-semibold rounded-lg hover:bg-blue-600 hover:text-white transition-all duration-300 hover:shadow-lg hover:shadow-blue-500/30">
                        <span class="relative">Lihat Semua Layanan</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 transition-transform duration-300 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- News Section -->
    <section class="py-20 relative bg-gradient-to-b from-white via-gray-50 to-gray-100">
        <!-- Background Decorative Elements -->
        <div class="absolute inset-0 z-0">
            <!-- Abstract background elements -->
            <div class="absolute top-0 left-0 w-72 h-72 bg-blue-100 rounded-full opacity-20 -ml-20 -mt-20 blur-3xl"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-blue-200 rounded-full opacity-20 -mr-20 -mb-20 blur-3xl"></div>
            
            <!-- Subtle pattern -->
            <div class="absolute inset-0" style="background-image: radial-gradient(#4b5563 0.5px, transparent 1px); background-size: 30px 30px; opacity: 0.05;"></div>
            
            <!-- Subtle top wave -->
            <div class="absolute top-0 left-0 right-0 h-12 overflow-hidden">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="w-full h-full">
                    <path fill="#eff6ff" fill-opacity="0.7" d="M0,224L48,213.3C96,203,192,181,288,186.7C384,192,480,224,576,229.3C672,235,768,213,864,202.7C960,192,1056,192,1152,213.3C1248,235,1344,277,1392,298.7L1440,320L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path>
                </svg>
            </div>
        </div>
        
        <div class="container mx-auto px-6 md:px-12 max-w-6xl relative z-10">
            <!-- Section Header -->
            <div class="text-center mb-14 relative">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-6 relative inline-block">
                    Berita & Artikel
                    <div class="absolute -right-8 -top-8 w-16 h-16 bg-blue-200 rounded-full opacity-20 blur-xl z-0"></div>
                    <div class="absolute -left-8 -bottom-2 w-12 h-12 bg-yellow-300 rounded-full opacity-20 blur-lg z-0"></div>
                </h2>
                
                <p class="text-lg text-gray-600 max-w-3xl mx-auto relative">
                    Informasi terkini seputar kesehatan anak, tips parenting, dan kegiatan di Al-Fatih Center
                </p>
                
                <!-- Decorative divider -->
                <div class="w-24 h-1.5 bg-gradient-to-r from-blue-400 to-blue-600 mx-auto mt-8 rounded-full"></div>
            </div>
            
            <!-- News Slider -->
            <div class="relative max-w-5xl mx-auto mb-12 overflow-hidden rounded-xl shadow-xl">
                <div class="news-slider flex transition-transform duration-500">
                    @foreach($news as $index => $newsItem)
                    <div class="news-slide w-full min-w-full flex-shrink-0 bg-white overflow-hidden">
                        <div class="flex flex-col md:flex-row h-full">
                            <!-- News Image -->
                            <div class="w-full md:w-1/2 h-48 md:h-auto relative overflow-hidden">
                                <img 
                                    src="{{ $newsItem->image_url }}" 
                                    alt="{{ $newsItem->title }}" 
                                    class="w-full h-full object-cover"
                                >
                                <div class="absolute inset-0 bg-gradient-to-r from-black/50 to-transparent"></div>
                                
                                <!-- Category badge -->
                                <div class="absolute top-4 left-4">
                                    <span class="bg-blue-600 text-white text-xs font-bold px-3 py-1.5 rounded-full">Artikel</span>
                                </div>
                            </div>
                            
                            <!-- News Content -->
                            <div class="w-full md:w-1/2 p-6 md:p-8 flex flex-col justify-center">
                                <div class="flex items-center mb-3 text-sm text-gray-500">
                                    <span class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        {{ $newsItem->formatted_date }}
                                    </span>
                                    <span class="mx-2">•</span>
                                    <span class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        {{ $newsItem->author }}
                                    </span>
                                </div>
                                
                                <h3 class="text-xl md:text-2xl font-bold mb-4 text-gray-800">{{ $newsItem->title }}</h3>
                                
                                <p class="text-gray-600 mb-6 line-clamp-3">{{ $newsItem->short_description }}</p>
                                
                                <a 
                                    href="{{ route('news.show', $newsItem->slug) }}" 
                                    class="inline-flex items-center px-5 py-2.5 bg-blue-100 text-blue-700 rounded-lg font-medium hover:bg-blue-600 hover:text-white transition-all duration-300 self-start"
                                >
                                    <span>Baca Selengkapnya</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <!-- Slider controls -->
                <button class="news-prev absolute top-1/2 left-2 md:left-4 transform -translate-y-1/2 bg-white bg-opacity-80 hover:bg-opacity-100 rounded-full p-1 md:p-2 focus:outline-none z-10 shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 md:h-6 md:w-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button class="news-next absolute top-1/2 right-2 md:right-4 transform -translate-y-1/2 bg-white bg-opacity-80 hover:bg-opacity-100 rounded-full p-1 md:p-2 focus:outline-none z-10 shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 md:h-6 md:w-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
                
                <!-- Slider dots -->
                <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2 z-10">
                    @foreach($news as $index => $newsItem)
                        <button class="news-dot w-2 h-2 rounded-full bg-white bg-opacity-50 hover:bg-opacity-100 transition-all {{ $index === 0 ? 'active bg-opacity-100' : '' }}" data-index="{{ $index }}"></button>
                    @endforeach
                </div>
            </div>
            
            <!-- Featured News Cards -->
            <div class="flex justify-center mt-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl">
                    @foreach($news->take(2) as $newsItem)
                    <div class="group bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
                        <!-- News Image -->
                        <div class="relative h-56 overflow-hidden">
                            <!-- Category label -->
                            <div class="absolute top-4 left-4 z-10">
                                <span class="bg-blue-600 text-white text-xs font-bold px-3 py-1.5 rounded-full">Artikel</span>
                            </div>
                            
                            <img 
                                src="{{ $newsItem->image_url }}" 
                                alt="{{ $newsItem->title }}" 
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                            >
                            <div class="absolute inset-0 bg-gradient-to-b from-gray-900/0 via-gray-900/20 to-gray-900/60 group-hover:opacity-90 transition-opacity"></div>
                        </div>
                        
                        <!-- News Content -->
                        <div class="p-6">
                            <!-- Meta info -->
                            <div class="flex items-center mb-3 text-sm text-gray-500">
                                <span class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $newsItem->formatted_date }}
                                </span>
                                <span class="mx-2">•</span>
                                <span class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    {{ $newsItem->author }}
                                </span>
                            </div>
                            
                            <h3 class="font-bold text-xl mb-3 text-gray-800 group-hover:text-blue-600 transition-colors line-clamp-2">{{ $newsItem->title }}</h3>
                            
                            <p class="text-gray-600 mb-5 line-clamp-3">{{ $newsItem->short_description }}</p>
                            
                            <div class="flex items-center justify-between">
                                <a 
                                    href="{{ route('news.show', $newsItem->slug) }}" 
                                    class="inline-flex items-center px-4 py-2 bg-gray-100 text-blue-700 rounded-lg font-medium group-hover:bg-blue-600 group-hover:text-white transition-all duration-300"
                                >
                                    <span>Baca Selengkapnya</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1.5 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            
            <!-- CTA Button -->
            <div class="text-center mt-16">
                <a href="{{ route('news.index') }}" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-700 to-blue-600 text-white font-semibold rounded-lg hover:from-blue-800 hover:to-blue-700 transition-all duration-300 shadow-md hover:shadow-lg hover:shadow-blue-500/30">
                    <span>Lihat Semua Berita</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-20 relative overflow-hidden">
        <!-- Background Image with Blue Overlay -->
        <div class="absolute inset-0 z-0">
            <!-- Background Image -->
            <div class="absolute inset-0 bg-cover bg-center bg-fixed" style="background-image: url('{{ asset('storage/homepage/testimonials/background.jpg') }}');">
                <!-- Blue Overlay - Reduced opacity -->
                <div class="absolute inset-0 bg-blue-900 bg-opacity-60"></div>
            </div>
            
            <!-- Additional decorative elements -->
            <div class="absolute top-0 right-0 w-96 h-96 bg-blue-200 rounded-full opacity-20 -mr-20 -mt-20 blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-80 h-80 bg-blue-400 rounded-full opacity-20 -ml-40 -mb-40 blur-3xl"></div>
        </div>
        
        <div class="container mx-auto px-6 md:px-12 max-w-6xl relative z-10">
            <!-- Section Header -->
            <div class="text-center mb-14 relative">
                <h2 class="text-4xl md:text-5xl font-bold text-white mb-6 relative inline-block">
                    Cerita Ayah Bunda
                    <div class="absolute -right-8 -top-8 w-16 h-16 bg-blue-200 rounded-full opacity-30 blur-xl z-0"></div>
                    <div class="absolute -left-8 -bottom-2 w-12 h-12 bg-yellow-300 rounded-full opacity-30 blur-lg z-0"></div>
                </h2>
                
                <p class="text-lg text-blue-100 max-w-3xl mx-auto relative">
                    Pengalaman ayah bunda yang mempercayakan terapi putra-putrinya pada layanan Al-Fatih Center
                </p>
                
                <!-- Decorative divider -->
                <div class="w-24 h-1.5 bg-gradient-to-r from-yellow-300 to-yellow-500 mx-auto mt-8 rounded-full shadow-lg"></div>
            </div>
            
            <!-- Testimonial Slider -->
            <div class="relative max-w-5xl mx-auto mb-12">
                <div class="testimonial-slider overflow-hidden rounded-xl shadow-2xl bg-white bg-opacity-10 backdrop-filter backdrop-blur-sm">
                    <div class="flex transition-transform duration-500">
                        @foreach($testimonials as $index => $testimonial)
                        <div class="testimonial-slide w-full min-w-full flex-shrink-0 p-4 md:p-6">
                            <div class="relative">
                                <!-- Background image blurred (subtle) -->
                                <div class="absolute inset-0 bg-cover bg-center opacity-5" style="background-image: url('{{ $testimonial->image_url }}'); filter: blur(10px);"></div>
                                
                                <div class="md:flex items-center relative">
                                    <!-- Testimonial Content -->
                                    <div class="w-full md:w-3/4 p-6 md:p-10">
                                        <div class="bg-white bg-opacity-95 backdrop-filter backdrop-blur-sm p-6 md:p-8 rounded-xl shadow-lg border border-blue-100">
                                            <svg class="h-10 w-10 text-blue-600 mb-4" fill="currentColor" viewBox="0 0 32 32">
                                                <path d="M10 8c-2.2 0-4 1.8-4 4v12h12V12h-6c0-1.1 0.9-2 2-2h2V8h-6zm14 0c-2.2 0-4 1.8-4 4v12h12V12h-6c0-1.1 0.9-2 2-2h2V8h-6z"/>
                                            </svg>
                                            
                                            <p class="text-gray-700 mb-6 leading-relaxed">
                                                {{ $testimonial->testimonial_text }}
                                            </p>
                                            
                                            <div class="flex items-center">
                                                <img 
                                                    src="{{ $testimonial->image_url }}" 
                                                    alt="{{ $testimonial->name }}" 
                                                    class="w-12 h-12 rounded-full object-cover mr-4 border-2 border-blue-300 shadow-md"
                                                >
                                                <div>
                                                    <h4 class="font-semibold text-gray-900">{{ $testimonial->name }}</h4>
                                                    <p class="text-sm text-blue-700">{{ $testimonial->role }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Testimonial Image -->
                                    <div class="hidden md:block w-1/4 p-8">
                                        <img 
                                            src="{{ $testimonial->image_url }}" 
                                            alt="{{ $testimonial->name }}" 
                                            class="w-full h-auto rounded-xl shadow-lg object-cover border-4 border-white"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                
                <!-- Slider controls -->
                <button class="testimonial-prev absolute top-1/2 left-2 md:left-4 transform -translate-y-1/2 bg-white bg-opacity-90 hover:bg-opacity-100 rounded-full p-1.5 md:p-3 focus:outline-none z-10 shadow-lg transition-all duration-300 hover:scale-110">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 md:h-6 md:w-6 text-blue-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button class="testimonial-next absolute top-1/2 right-2 md:right-4 transform -translate-y-1/2 bg-white bg-opacity-90 hover:bg-opacity-100 rounded-full p-1.5 md:p-3 focus:outline-none z-10 shadow-lg transition-all duration-300 hover:scale-110">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 md:h-6 md:w-6 text-blue-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
                
                <!-- Slider dots -->
                <div class="absolute -bottom-10 left-1/2 transform -translate-x-1/2 flex space-x-3 z-10">
                    @foreach($testimonials as $index => $testimonial)
                        <button class="testimonial-dot w-3 h-3 rounded-full bg-white bg-opacity-70 hover:bg-opacity-100 transition-all duration-300 {{ $index === 0 ? 'active bg-opacity-100 w-6' : '' }}" data-index="{{ $index }}"></button>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Slider JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get slider elements
            const slider = document.querySelector('.slider');
            const sliderItems = document.querySelectorAll('.slider-item');
            const prevButton = document.querySelector('.slider-arrow.prev');
            const nextButton = document.querySelector('.slider-arrow.next');
            const dots = document.querySelectorAll('.slider-dot');
            
            if (!slider || sliderItems.length === 0) return;
            
            let currentIndex = 0;
            let interval;
            const slideInterval = 5000; // Change slide every 5 seconds
            
            // Set up slider
            function setupSlider() {
                // Set display style for all items
                sliderItems.forEach(item => {
                    item.style.display = 'flex'; // Keep all items in the flex container
                });
                
                // Set initial position
                updateSlider();
                
                // Start auto sliding
                startAutoSlide();
                
                // Event listeners
                prevButton?.addEventListener('click', prevSlide);
                nextButton?.addEventListener('click', nextSlide);
                
                // Set up dots
                dots.forEach(dot => {
                    dot.addEventListener('click', function() {
                        currentIndex = parseInt(this.dataset.index);
                        updateSlider();
                        resetAutoSlide();
                    });
                });
                
                // Stop auto sliding on hover
                slider.addEventListener('mouseenter', () => {
                    clearInterval(interval);
                });
                
                // Resume auto sliding when mouse leaves
                slider.addEventListener('mouseleave', startAutoSlide);
            }
            
            // Update the slider position and active dot
            function updateSlider() {
                // Update slider position by transforming it
                const translateValue = -currentIndex * 100 + '%';
                slider.style.transform = 'translateX(' + translateValue + ')';
                
                // Update active dot
                dots.forEach((dot, index) => {
                    if (index === currentIndex) {
                        dot.classList.add('active', 'bg-opacity-100');
                        dot.classList.add('w-6'); // Make active dot wider
                    } else {
                        dot.classList.remove('active', 'bg-opacity-100');
                        dot.classList.remove('w-6'); // Reset width
                    }
                });
            }
            
            // Go to previous slide
            function prevSlide() {
                currentIndex = (currentIndex - 1 + sliderItems.length) % sliderItems.length;
                
                // Add transition class
                slider.classList.add('transition-transform');
                
                updateSlider();
                resetAutoSlide();
            }
            
            // Go to next slide
            function nextSlide() {
                currentIndex = (currentIndex + 1) % sliderItems.length;
                
                // Add transition class
                slider.classList.add('transition-transform');
                
                updateSlider();
                resetAutoSlide();
            }
            
            // Start auto sliding
            function startAutoSlide() {
                interval = setInterval(nextSlide, slideInterval);
            }
            
            // Reset auto slide timer
            function resetAutoSlide() {
                clearInterval(interval);
                startAutoSlide();
            }
            
            // Initialize the slider
            setupSlider();
            
            // Initialize testimonial slider
            const testimonialSlider = document.querySelector('.testimonial-slider .flex');
            const testimonialSlides = document.querySelectorAll('.testimonial-slide');
            const testimonialPrevButton = document.querySelector('.testimonial-prev');
            const testimonialNextButton = document.querySelector('.testimonial-next');
            const testimonialDots = document.querySelectorAll('.testimonial-dot');
            
            if (testimonialSlider && testimonialSlides.length > 0) {
                let testimonialCurrentIndex = 0;
                let testimonialInterval;
                const testimonialSlideInterval = 7000; // Change slide every 7 seconds
                
                // Set up testimonial slider
                function setupTestimonialSlider() {
                    // Set initial position
                    updateTestimonialSlider();
                    
                    // Start auto sliding
                    startTestimonialAutoSlide();
                    
                    // Event listeners
                    testimonialPrevButton?.addEventListener('click', prevTestimonialSlide);
                    testimonialNextButton?.addEventListener('click', nextTestimonialSlide);
                    
                    // Set up dots
                    testimonialDots.forEach((dot, index) => {
                        dot.addEventListener('click', function() {
                            goToTestimonialSlide(index);
                            resetTestimonialAutoSlide();
                        });
                    });
                }
                
                // Update slider position
                function updateTestimonialSlider() {
                    testimonialSlider.style.transform = `translateX(-${testimonialCurrentIndex * 100}%)`;
                    
                    // Update active dot
                    testimonialDots.forEach((dot, index) => {
                        if (index === testimonialCurrentIndex) {
                            dot.classList.add('active', 'bg-opacity-100', 'w-4');
                        } else {
                            dot.classList.remove('active', 'bg-opacity-100', 'w-4');
                        }
                    });
                }
                
                // Go to previous slide
                function prevTestimonialSlide() {
                    if (testimonialCurrentIndex === 0) {
                        testimonialCurrentIndex = testimonialSlides.length - 1;
                    } else {
                        testimonialCurrentIndex--;
                    }
                    
                    updateTestimonialSlider();
                    resetTestimonialAutoSlide();
                }
                
                // Go to next slide
                function nextTestimonialSlide() {
                    if (testimonialCurrentIndex === testimonialSlides.length - 1) {
                        testimonialCurrentIndex = 0;
                    } else {
                        testimonialCurrentIndex++;
                    }
                    
                    updateTestimonialSlider();
                    resetTestimonialAutoSlide();
                }
                
                // Go to specific slide
                function goToTestimonialSlide(index) {
                    testimonialCurrentIndex = index;
                    updateTestimonialSlider();
                }
                
                // Start auto sliding
                function startTestimonialAutoSlide() {
                    testimonialInterval = setInterval(nextTestimonialSlide, testimonialSlideInterval);
                }
                
                // Reset auto slide timer
                function resetTestimonialAutoSlide() {
                    clearInterval(testimonialInterval);
                    startTestimonialAutoSlide();
                }
                
                // Initialize the testimonial slider
                setupTestimonialSlider();
            }
        });
    </script>
    
    <!-- News Slider JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // News slider functionality
            const newsSlider = document.querySelector('.news-slider');
            const newsSlides = document.querySelectorAll('.news-slide');
            const newsPrevButton = document.querySelector('.news-prev');
            const newsNextButton = document.querySelector('.news-next');
            const newsDots = document.querySelectorAll('.news-dot');
            
            if (!newsSlider || newsSlides.length === 0) return;
            
            let newsCurrentIndex = 0;
            let newsInterval;
            const newsSlideInterval = 6000; // Change slide every 6 seconds
            
            // Set up news slider
            function setupNewsSlider() {
                // Set initial position
                updateNewsSlider();
                
                // Start auto sliding
                startNewsAutoSlide();
                
                // Event listeners
                newsPrevButton?.addEventListener('click', prevNewsSlide);
                newsNextButton?.addEventListener('click', nextNewsSlide);
                
                // Set up dots
                newsDots.forEach((dot, index) => {
                    dot.addEventListener('click', function() {
                        goToNewsSlide(index);
                        resetNewsAutoSlide();
                    });
                });
            }
            
            // Update slider position
            function updateNewsSlider() {
                newsSlider.style.transform = `translateX(-${newsCurrentIndex * 100}%)`;
                
                // Update active dot
                newsDots.forEach((dot, index) => {
                    if (index === newsCurrentIndex) {
                        dot.classList.add('active', 'bg-opacity-100', 'w-4');
                    } else {
                        dot.classList.remove('active', 'bg-opacity-100', 'w-4');
                    }
                });
            }
            
            // Go to previous slide
            function prevNewsSlide() {
                if (newsCurrentIndex === 0) {
                    newsCurrentIndex = newsSlides.length - 1;
                } else {
                    newsCurrentIndex--;
                }
                
                updateNewsSlider();
                resetNewsAutoSlide();
            }
            
            // Go to next slide
            function nextNewsSlide() {
                if (newsCurrentIndex === newsSlides.length - 1) {
                    newsCurrentIndex = 0;
                } else {
                    newsCurrentIndex++;
                }
                
                updateNewsSlider();
                resetNewsAutoSlide();
            }
            
            // Go to specific slide
            function goToNewsSlide(index) {
                newsCurrentIndex = index;
                updateNewsSlider();
            }
            
            // Start auto sliding
            function startNewsAutoSlide() {
                newsInterval = setInterval(nextNewsSlide, newsSlideInterval);
            }
            
            // Reset auto slide timer
            function resetNewsAutoSlide() {
                clearInterval(newsInterval);
                startNewsAutoSlide();
            }
            
            // Initialize the news slider
            setupNewsSlider();
            
            // Scroll to consultation form if there are errors
            @if(isset($scrollToConsultation) && $scrollToConsultation)
            document.addEventListener('DOMContentLoaded', function() {
                const appointmentForm = document.getElementById('appointment-form');
                if (appointmentForm) {
                    setTimeout(() => {
                        appointmentForm.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }, 500);
                }
            });
            @endif
        });
    </script>
    
    <!-- Appointment Section -->
    <section class="py-20 relative bg-gradient-to-b from-white to-blue-50">
        <!-- Background decorative elements -->
        <div class="absolute inset-0 z-0">
            <!-- Decorative circles -->
            <div class="absolute top-0 right-0 w-64 h-64 bg-blue-100 rounded-full opacity-40 -mr-20 -mt-20"></div>
            <div class="absolute bottom-0 left-0 w-80 h-80 bg-green-100 rounded-full opacity-50 -ml-40 -mb-40"></div>
            
            <!-- Decorative pattern -->
            <div class="absolute inset-0 bg-repeat" style="background-image: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMiIgY3k9IjIiIHI9IjIiIGZpbGw9IiMzYjgyZjYiIGZpbGwtb3BhY2l0eT0iMC4xIi8+PC9zdmc+'); opacity: 0.4;"></div>
        </div>
        
        <div class="container mx-auto px-6 md:px-12 max-w-6xl relative z-10">
            <!-- Section Header -->
            <div class="text-center mb-14 relative">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-6 relative inline-block">
                    Buat Janji Konsultasi
                    <div class="absolute -right-8 -top-8 w-16 h-16 bg-blue-200 rounded-full opacity-20 blur-xl z-0"></div>
                    <div class="absolute -left-8 -bottom-2 w-12 h-12 bg-yellow-300 rounded-full opacity-20 blur-lg z-0"></div>
                </h2>
                
                <p class="text-lg text-gray-600 max-w-3xl mx-auto relative">
                    Isi formulir di bawah ini untuk membuat janji konsultasi dengan terapis kami
                </p>
                
                <!-- Decorative divider -->
                <div class="w-24 h-1.5 bg-gradient-to-r from-blue-400 to-blue-600 mx-auto mt-8 rounded-full"></div>
            </div>
            
            <!-- Appointment Form -->
            <div id="appointment-form" class="max-w-4xl mx-auto bg-white rounded-xl shadow-xl overflow-hidden">
                <div class="md:flex">
                    <!-- Left side - Contact Info -->
                    <div class="w-full md:w-1/3 bg-gradient-to-br from-blue-600 to-blue-800 p-8 text-white">
                        <h3 class="text-2xl font-bold mb-6">Hubungi Kami</h3>
                        
                        <div class="space-y-6">
                            <div class="flex items-start">
                                <div class="mr-4 mt-1">
                                </div>
                                <div>
                                    
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="mr-4 mt-1">
                                   
                                </div>
                                <div>
                                 
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="mr-4 mt-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-blue-100">Email</h4>
                                    <p class="mt-1">info@alfatihcenter.com</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="mr-4 mt-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-blue-100">Jam Operasional</h4>
                                    <p class="mt-1">Senin - Sabtu: 08.00 - 17.00</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right side - Form -->
                    <div class="w-full md:w-2/3 p-8">
                        <h3 class="text-2xl font-bold text-gray-800 mb-6" id="consultation-form">Form Janji Konsultasi</h3>
                        
                        <form action="{{ route('consultation.store') }}" method="POST" class="space-y-6" id="consultation-form-element">
                            @csrf
                            <input type="hidden" name="open_whatsapp_in_new_tab" value="1">
                            
                            <!-- Data Orang Tua Section -->
                            <div class="bg-blue-50 p-4 rounded-lg mb-6">
                                <h4 class="text-xl font-semibold text-blue-800 mb-4 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                                    </svg>
                                    Data Orang Tua
                                </h4>
                                
                                <div class="space-y-4">
                                    <div>
                                        <label for="nama_orang_tua" class="block text-sm font-medium text-gray-700 mb-1">Nama Orang Tua</label>
                                        <input 
                                            type="text" 
                                            id="nama_orang_tua" 
                                            name="nama_orang_tua" 
                                            class="w-full px-4 py-3 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none {{ $errors->has('nama_orang_tua') ? 'border border-red-500' : 'border border-gray-300' }}" 
                                            placeholder="Masukkan nama lengkap orang tua"
                                            value="{{ old('nama_orang_tua') }}"
                                            required
                                        >
                                        @error('nama_orang_tua')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div>
                                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                        <input 
                                            type="email" 
                                            id="email" 
                                            name="email" 
                                            class="w-full px-4 py-3 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none {{ $errors->has('email') ? 'border border-red-500' : 'border border-gray-300' }}" 
                                            placeholder="Contoh: email@example.com"
                                            value="{{ old('email') }}"
                                            required
                                        >
                                        @error('email')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon / WhatsApp</label>
                                        <input 
                                            type="text" 
                                            id="phone" 
                                            name="phone" 
                                            class="w-full px-4 py-3 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none {{ $errors->has('phone') ? 'border border-red-500' : 'border border-gray-300' }}" 
                                            placeholder="Contoh: 08123456789"
                                            value="{{ old('phone') }}"
                                            required
                                        >
                                        @error('phone')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Data Anak Section -->
                            <div class="bg-green-50 p-4 rounded-lg mb-6">
                                <h4 class="text-xl font-semibold text-green-800 mb-4 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                    </svg>
                                    Data Anak
                                </h4>
                                
                                <div class="space-y-4">
                                    <div>
                                        <label for="patient_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap Anak</label>
                                        <input 
                                            type="text" 
                                            id="patient_name" 
                                            name="patient_name" 
                                            class="w-full px-4 py-3 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none {{ $errors->has('patient_name') ? 'border border-red-500' : 'border border-gray-300' }}" 
                                            placeholder="Masukkan nama lengkap anak"
                                            value="{{ old('patient_name') }}"
                                            required
                                        >
                                        @error('patient_name')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                                        <div class="flex gap-6 mt-1">
                                            <div class="flex items-center">
                                                <input 
                                                    type="radio" 
                                                    id="laki-laki" 
                                                    name="jenis_kelamin" 
                                                    value="Laki-laki" 
                                                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300" 
                                                    {{ old('jenis_kelamin') == 'Laki-laki' ? 'checked' : '' }}
                                                    required
                                                >
                                                <label for="laki-laki" class="ml-2 text-sm text-gray-700">Laki-laki</label>
                                            </div>
                                            <div class="flex items-center">
                                                <input 
                                                    type="radio" 
                                                    id="perempuan" 
                                                    name="jenis_kelamin" 
                                                    value="Perempuan" 
                                                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300" 
                                                    {{ old('jenis_kelamin') == 'Perempuan' ? 'checked' : '' }}
                                                >
                                                <label for="perempuan" class="ml-2 text-sm text-gray-700">Perempuan</label>
                                            </div>
                                        </div>
                                        @error('jenis_kelamin')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label for="tempat_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir</label>
                                            <input 
                                                type="text" 
                                                id="tempat_lahir" 
                                                name="tempat_lahir" 
                                                class="w-full px-4 py-3 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none {{ $errors->has('tempat_lahir') ? 'border border-red-500' : 'border border-gray-300' }}" 
                                                placeholder="Kota kelahiran"
                                                value="{{ old('tempat_lahir') }}"
                                                required
                                            >
                                            @error('tempat_lahir')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        
                                        <div>
                                            <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                                            <input 
                                                type="date" 
                                                id="tanggal_lahir" 
                                                name="tanggal_lahir" 
                                                class="w-full px-4 py-3 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none {{ $errors->has('tanggal_lahir') ? 'border border-red-500' : 'border border-gray-300' }}" 
                                                value="{{ old('tanggal_lahir') }}"
                                                required
                                            >
                                            @error('tanggal_lahir')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                                        <textarea 
                                            id="alamat" 
                                            name="alamat" 
                                            rows="2" 
                                            class="w-full px-4 py-3 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none {{ $errors->has('alamat') ? 'border border-red-500' : 'border border-gray-300' }}" 
                                            placeholder="Masukkan alamat lengkap"
                                            required
                                        >{{ old('alamat') }}</textarea>
                                        @error('alamat')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Data Konsultasi Section -->
                            <div class="bg-yellow-50 p-4 rounded-lg mb-6">
                                <h4 class="text-xl font-semibold text-yellow-800 mb-4 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                    </svg>
                                    Detail Konsultasi
                                </h4>
                                
                                <div class="space-y-4">
                                    <div>
                                        <label for="meeting_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Konsultasi</label>
                                        <input 
                                            type="date" 
                                            id="meeting_date" 
                                            name="meeting_date" 
                                            class="w-full px-4 py-3 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none {{ $errors->has('meeting_date') ? 'border border-red-500' : 'border border-gray-300' }}"
                                            min="{{ date('Y-m-d') }}"
                                            value="{{ old('meeting_date') }}"
                                            required
                                        >
                                        @error('meeting_date')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div>
                                        <label for="complaint" class="block text-sm font-medium text-gray-700 mb-1">Keluhan / Jenis Terapi</label>
                                        <textarea 
                                            id="complaint" 
                                            name="complaint" 
                                            rows="4" 
                                            class="w-full px-4 py-3 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none {{ $errors->has('complaint') ? 'border border-red-500' : 'border border-gray-300' }}" 
                                            placeholder="Ceritakan keluhan anak atau jenis terapi yang diinginkan"
                                            required
                                        >{{ old('complaint') }}</textarea>
                                        @error('complaint')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div>
                                        <label for="cabang_id" class="block text-sm font-medium text-gray-700 mb-1">Pilih Cabang</label>
                                <div class="relative">
                                    <select
                                        id="cabang_id"
                                        name="cabang_id"
                                        class="appearance-none w-full px-4 py-3 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none {{ $errors->has('cabang_id') ? 'border border-red-500' : 'border border-gray-300' }} bg-white"
                                        required
                                    >
                                        <option value="" disabled {{ old('cabang_id') ? '' : 'selected' }}>Pilih cabang klinik</option>
                                        @foreach($branches as $branch)
                                        <option value="{{ $branch->id }}" {{ old('cabang_id') == $branch->id ? 'selected' : '' }} 
                                            title="{{ $branch->nama_cabang }} - {{ $branch->alamat }}" data-full-info="{{ $branch->nama_cabang }} - {{ $branch->alamat }}">
                                            {{ $branch->nama_cabang }}{{ strlen($branch->alamat) > 15 ? ' - ' . substr($branch->alamat, 0, 15) . '...' : ' - ' . $branch->alamat }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                                @error('cabang_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="pt-4">
                                <button 
                                    type="submit" 
                                    id="consultation-submit"
                                    class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold py-3 px-4 rounded-lg transition duration-300 flex items-center justify-center gap-2"
                                >
                                    <span>Kirim & Hubungi via WhatsApp</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </button>
                                
                                <p class="text-sm text-gray-500 mt-4 text-center">
                                    Setelah mengisi form, Anda akan diarahkan ke WhatsApp untuk konfirmasi janji konsultasi
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- Simple toast notification for success message -->
                <div id="appointment-success" class="hidden fixed top-5 right-5 bg-green-600 text-white px-4 py-2 rounded shadow-lg z-50 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span class="font-bold">Berhasil Submit</span>
                </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Custom Dropdown and Form Submission JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Custom dropdown for branch selection
            const branchSelect = document.getElementById('cabang_id');
            
            if (branchSelect) {
                // Add title attribute for hover tooltip with full info
                Array.from(branchSelect.options).forEach(option => {
                    if (option.value) {
                        option.title = option.getAttribute('data-full-info'); // Show full info on hover
                    }
                });
            }
            
            // Handle form submission for consultation
            const consultationForm = document.getElementById('consultation-form-element');
            const successMessage = document.getElementById('appointment-success');
            
            console.log('Form element found:', !!consultationForm);
            console.log('Success message element found:', !!successMessage);
            
            if (consultationForm) {
                consultationForm.addEventListener('submit', function(e) {
                    e.preventDefault(); // Always prevent default first
                    
                    // Check if the form is valid
                    if (consultationForm.checkValidity()) {
                        // Get the form data
                        const formData = new FormData(consultationForm);
                        
                        // Log the form data for debugging
                        console.log('Submitting form data...');
                        
                        // Get CSRF token from meta tag
                        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                        if (!csrfToken) {
                            console.error('CSRF token not found! This may cause the form submission to fail');
                        } else {
                            console.log('CSRF token found and will be included in request');
                        }
                        
                        // Log the form data keys being submitted
                        console.log('Submitting form with fields:', Array.from(formData.keys()));
                        
                        // Send the form data using fetch API
                        fetch(consultationForm.action, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': csrfToken || '',
                                'Accept': 'application/json'
                            },
                            credentials: 'same-origin' // Include cookies
                        })
                        .then(response => {
                            console.log('Response received:', response);
                            
                            // Always try to parse JSON first, even if the response is not successful
                            try {
                                return response.json().then(data => {
                                    // Add the response status to the data
                                    return { 
                                        ...data, 
                                        status: response.status, 
                                        ok: response.ok 
                                    };
                                });
                            } catch (e) {
                                // If JSON parsing fails, throw an error with the response status
                                throw new Error(`Failed to parse JSON: ${e.message}. Response status: ${response.status}`);
                            }
                        })
                        .then(data => {
                            console.log('Response data:', data);
                            
                            // Check if the response was successful
                            if (!data.ok && !data.success) {
                                throw new Error(`Server error: ${data.message || 'Unknown error'}`);
                            }
                            
                            // Don't need to hide the form - we'll just reset it
                            consultationForm.reset();
                            
                            // Show toast notification
                            if (successMessage) {
                                // Show the toast notification
                                successMessage.classList.remove('hidden');
                                
                                // Add animation for smooth appearance
                                successMessage.style.opacity = '0';
                                successMessage.style.transform = 'translateY(-20px)';
                                
                                // Trigger animation
                                setTimeout(() => {
                                    successMessage.style.transition = 'opacity 0.3s, transform 0.3s';
                                    successMessage.style.opacity = '1';
                                    successMessage.style.transform = 'translateY(0)';
                                }, 10);
                                
                                // Auto-dismiss after 3 seconds
                                setTimeout(() => {
                                    successMessage.style.opacity = '0';
                                    successMessage.style.transform = 'translateY(-20px)';
                                    
                                    // Hide completely after fade out
                                    setTimeout(() => {
                                        successMessage.classList.add('hidden');
                                    }, 300);
                                }, 3000);
                                
                                console.log('Toast notification displayed');
                            } else {
                                console.error('Success message element not found with ID: appointment-success');
                                alert('Berhasil Submit');
                            }
                            
                            // Open WhatsApp in new tab if URL is provided
                            if (data.whatsapp_url) {
                                window.open(data.whatsapp_url, '_blank');
                            } else {
                                console.warn('WhatsApp URL not found in response');
                            }
                        })
                        .catch(error => {
                            console.error('Form submission error:', error);
                            // In case of error, try submitting the form normally
                            if (confirm('Terjadi kesalahan saat mengirim formulir: ' + error.message + '\nApakah Anda ingin mencoba lagi dengan pengalihan langsung?')) {
                                consultationForm.submit();
                            }
                        });
                    } else {
                        console.warn('Form validation failed');
                    }
                });
            }
        });
    </script>
    
    <!-- Include Footer -->
    @include('components.footer')
</body>
</html>
