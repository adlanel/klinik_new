@extends('layouts.app')

@section('title', $newsItem->title . ' - Al-Fatih Center')

@section('content')
<div class="bg-gray-50">
    <!-- Hero Section -->
    <div class="relative pt-16 pb-10 md:pt-24 md:pb-16 bg-gradient-to-b from-blue-900 to-blue-800">
        <div class="container mx-auto px-6 max-w-5xl relative z-10">
            <div class="text-center text-white py-12 max-w-3xl mx-auto">
                <div class="mb-4 flex justify-center">
                    <span class="bg-blue-600 text-white text-xs font-bold px-3 py-1.5 rounded-full">Artikel</span>
                </div>
                
                <h1 class="text-3xl md:text-5xl font-bold mb-6">{{ $newsItem->title }}</h1>
                
                <div class="flex items-center justify-center text-sm text-blue-100">
                    <span class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ $newsItem->formatted_date }}
                    </span>
                    <span class="mx-3">•</span>
                    <span class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        {{ $newsItem->author }}
                    </span>
                </div>
            </div>
        </div>
        
        <!-- Background pattern -->
        <div class="absolute inset-0 z-0 opacity-10">
            <div class="absolute inset-0" style="background-image: radial-gradient(#ffffff 1px, transparent 2px); background-size: 20px 20px;"></div>
        </div>
        
        <!-- Bottom wave -->
        <div class="absolute bottom-0 left-0 right-0">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="w-full">
                <path fill="#f9fafb" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,186.7C384,213,480,235,576,234.7C672,235,768,213,864,197.3C960,181,1056,171,1152,165.3C1248,160,1344,160,1392,160L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
            </svg>
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="container mx-auto px-6 py-10 max-w-5xl">
        <div class="flex flex-col lg:flex-row gap-10">
            <!-- Main Article -->
            <div class="w-full lg:w-2/3">
                <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
                    <!-- Feature image -->
                    <div class="w-full h-80 md:h-96 relative">
                        <img 
                            src="{{ asset('storage/homepage/news/' . $newsItem->image) }}" 
                            alt="{{ $newsItem->title }}" 
                            class="w-full h-full object-cover"
                            onerror="this.src='https://via.placeholder.com/800x500/e2f1ff/2563eb?text={{ urlencode($newsItem->title) }}'"
                        >
                    </div>
                    
                    <!-- Article content -->
                    <div class="p-6 md:p-10">
                        <div class="prose prose-lg max-w-none">
                            {!! $newsItem->content !!}
                        </div>
                        
                        <!-- Share buttons -->
                        <div class="border-t border-gray-100 mt-10 pt-6">
                            <p class="text-gray-600 font-medium mb-3">Bagikan artikel ini:</p>
                            <div class="flex space-x-4">
                                <a href="#" class="text-blue-600 hover:text-blue-800 transition-colors">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"></path>
                                    </svg>
                                </a>
                                <a href="#" class="text-blue-400 hover:text-blue-600 transition-colors">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"></path>
                                    </svg>
                                </a>
                                <a href="#" class="text-green-600 hover:text-green-800 transition-colors">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd"></path>
                                    </svg>
                                </a>
                                <a href="#" class="text-green-500 hover:text-green-700 transition-colors">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Author box -->
                <div class="bg-blue-50 rounded-xl p-6 border border-blue-100 mb-10">
                    <div class="flex items-center">
                        <div class="w-16 h-16 rounded-full bg-gradient-to-r from-blue-600 to-blue-400 text-white flex items-center justify-center text-xl font-bold">
                            {{ substr($newsItem->author, 0, 1) }}
                        </div>
                        <div class="ml-5">
                            <h3 class="text-lg font-bold text-gray-800">{{ $newsItem->author }}</h3>
                            <p class="text-gray-600">Penulis</p>
                        </div>
                    </div>
                    <p class="mt-4 text-gray-600">
                        Penulis artikel terkait kesehatan anak dan tumbuh kembang di Al-Fatih Center.
                    </p>
                </div>
            </div>
            
            <!-- Sidebar -->
            <div class="w-full lg:w-1/3">
                <!-- Related articles -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-6 pb-2 border-b border-gray-100">Artikel Terkait</h3>
                        
                        <div class="space-y-6">
                            @foreach($relatedNews as $related)
                            <div class="flex space-x-4">
                                <div class="flex-shrink-0 w-20 h-20 rounded-lg overflow-hidden">
                                    <img 
                                        src="{{ asset('storage/homepage/news/' . $related->image) }}" 
                                        alt="{{ $related->title }}" 
                                        class="w-full h-full object-cover"
                                        onerror="this.src='https://via.placeholder.com/100x100/e2f1ff/2563eb?text=News'"
                                    >
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-700 hover:text-blue-600 transition-colors line-clamp-2">
                                        <a href="{{ route('news.show', $related->slug) }}">{{ $related->title }}</a>
                                    </h4>
                                    <p class="text-sm text-gray-500 mt-1">{{ $related->formatted_date }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        
                        <div class="mt-8 text-center">
                            <a href="{{ route('news.index') }}" class="inline-flex items-center text-blue-600 font-medium hover:text-blue-800 transition-colors">
                                Lihat Semua Artikel
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Contact box -->
                <div class="bg-gradient-to-br from-blue-700 to-blue-800 rounded-xl shadow-lg overflow-hidden text-white p-6">
                    <h3 class="text-xl font-bold mb-4">Ada Pertanyaan?</h3>
                    <p class="mb-6">Konsultasikan kebutuhan anak Anda dengan tim profesional kami.</p>
                    
                    <div class="space-y-3">
                        <a href="tel:+6281234567890" class="flex items-center">
                            <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <span>0812-3456-7890</span>
                        </a>
                        
                        <a href="mailto:info@alfatihcenter.com" class="flex items-center">
                            <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <span>info@alfatihcenter.com</span>
                        </a>
                    </div>
                    
                    <div class="mt-8">
                        <a href="/kontak" class="block w-full bg-white text-blue-700 text-center py-3 rounded-lg font-semibold hover:bg-blue-50 transition-colors">
                            Hubungi Kami
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection