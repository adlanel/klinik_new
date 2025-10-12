@extends('layouts.admin.app')

@section('title', 'Content Management')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Manajemen Konten</h1>
        <p class="text-gray-600 mt-1">Kelola konten website klinik</p>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Logo Management -->
        <div class="bg-white p-6 rounded-lg border shadow-md hover:shadow-lg transition-all">
            <div class="flex items-center mb-4">
                <div class="bg-blue-100 p-3 rounded-full mr-4">
                    <svg class="h-6 w-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <h2 class="text-lg font-semibold text-gray-800">Logo</h2>
            </div>
            <p class="text-gray-600 mb-4">Upload dan kelola logo website klinik.</p>
            <a href="{{ route('admin.content.logos.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center">
                Kelola Logo
                <svg class="h-4 w-4 ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
            </a>
        </div>
        
        <!-- Banner Management -->
        <div class="bg-white p-6 rounded-lg border shadow-md hover:shadow-lg transition-all">
            <div class="flex items-center mb-4">
                <div class="bg-indigo-100 p-3 rounded-full mr-4">
                    <svg class="h-6 w-6 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2" />
                    </svg>
                </div>
                <h2 class="text-lg font-semibold text-gray-800">Banner Slider</h2>
            </div>
            <p class="text-gray-600 mb-4">Kelola banner slider pada halaman utama.</p>
            <a href="{{ route('admin.content.banners.index') }}" class="text-indigo-600 hover:text-indigo-800 flex items-center">
                Kelola Banner
                <svg class="h-4 w-4 ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
            </a>
        </div>
        
        <!-- More content management cards can be added here -->
    </div>
</div>
@endsection