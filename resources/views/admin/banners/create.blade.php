@extends('layouts.admin.app')

@section('title', 'Tambah Banner Baru')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Tambah Banner Baru</h1>
        <p class="text-gray-600 mt-1">Upload banner baru untuk website</p>
    </div>
    
    @if($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ route('admin.content.banners.store') }}" method="POST" enctype="multipart/form-data" class="max-w-4xl">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <!-- Desktop Image -->
            <div class="bg-gray-50 p-6 rounded-lg border">
                <label for="desktop_image" class="block text-sm font-medium text-gray-700 mb-2">Gambar Desktop</label>
                
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md" id="desktop-drop-area">
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-gray-600 justify-center">
                            <label for="desktop_image" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                <span>Upload file</span>
                                <input id="desktop_image" name="desktop_image" type="file" accept="image/*" class="sr-only" required>
                            </label>
                            <p class="pl-1">atau drag and drop</p>
                        </div>
                        <p class="text-xs text-gray-500">
                            PNG, JPG, GIF, WEBP hingga 2MB
                        </p>
                        <p class="text-xs text-gray-500 font-semibold">
                            Ukuran yang disarankan: 1920x600px
                        </p>
                    </div>
                </div>
                
                <div id="desktop-preview-container" class="mt-4 hidden">
                    <p class="text-sm font-medium text-gray-700 mb-2">Preview Desktop:</p>
                    <div class="bg-white p-2 rounded-lg border">
                        <img id="desktop-preview-image" src="#" alt="Preview Desktop" class="max-w-full h-auto">
                    </div>
                </div>
            </div>
            
            <!-- Mobile Image -->
            <div class="bg-gray-50 p-6 rounded-lg border">
                <label for="mobile_image" class="block text-sm font-medium text-gray-700 mb-2">Gambar Mobile</label>
                
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md" id="mobile-drop-area">
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-gray-600 justify-center">
                            <label for="mobile_image" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                <span>Upload file</span>
                                <input id="mobile_image" name="mobile_image" type="file" accept="image/*" class="sr-only" required>
                            </label>
                            <p class="pl-1">atau drag and drop</p>
                        </div>
                        <p class="text-xs text-gray-500">
                            PNG, JPG, GIF, WEBP hingga 2MB
                        </p>
                        <p class="text-xs text-gray-500 font-semibold">
                            Ukuran yang disarankan: 768x800px
                        </p>
                    </div>
                </div>
                
                <div id="mobile-preview-container" class="mt-4 hidden">
                    <p class="text-sm font-medium text-gray-700 mb-2">Preview Mobile:</p>
                    <div class="bg-white p-2 rounded-lg border">
                        <img id="mobile-preview-image" src="#" alt="Preview Mobile" class="max-w-full h-auto">
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Link URL -->
        <div class="mb-6">
            <label for="link_url" class="block text-sm font-medium text-gray-700 mb-2">Link URL (Opsional)</label>
            <input type="url" name="link_url" id="link_url" value="{{ old('link_url') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" placeholder="https://example.com">
            <p class="text-xs text-gray-500 mt-1">
                URL yang akan dibuka ketika banner diklik. Kosongkan jika banner tidak perlu dapat diklik.
            </p>
            @error('link_url')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        
        <!-- Order Number -->
        <div class="mb-6">
            <label for="order_number" class="block text-sm font-medium text-gray-700 mb-2">Urutan</label>
            <input type="number" name="order_number" id="order_number" value="{{ $nextOrderNumber }}" min="1" class="mt-1 block w-full md:w-1/4 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
            <p class="text-xs text-gray-500 mt-1">
                Banner dengan urutan lebih kecil akan ditampilkan lebih dulu.
            </p>
        </div>
        
        <!-- Submit Button -->
        <div class="flex justify-between items-center mt-8">
            <a href="{{ route('admin.content.banners.index') }}" class="text-gray-600 hover:text-gray-800">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                <i class="fas fa-save mr-2"></i>Simpan Banner
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Desktop Image Preview
        const desktopImage = document.getElementById('desktop_image');
        const desktopPreview = document.getElementById('desktop-preview-image');
        const desktopPreviewContainer = document.getElementById('desktop-preview-container');
        const desktopDropArea = document.getElementById('desktop-drop-area');
        
        // Mobile Image Preview
        const mobileImage = document.getElementById('mobile_image');
        const mobilePreview = document.getElementById('mobile-preview-image');
        const mobilePreviewContainer = document.getElementById('mobile-preview-container');
        const mobileDropArea = document.getElementById('mobile-drop-area');
        
        // Function to handle file selection
        function handleFileSelect(fileInput, previewImage, previewContainer) {
            const file = fileInput.files[0];
            
            if (file) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                };
                
                reader.readAsDataURL(file);
            }
        }
        
        // Desktop image change
        desktopImage.addEventListener('change', function() {
            handleFileSelect(desktopImage, desktopPreview, desktopPreviewContainer);
        });
        
        // Mobile image change
        mobileImage.addEventListener('change', function() {
            handleFileSelect(mobileImage, mobilePreview, mobilePreviewContainer);
        });
        
        // Setup drag and drop for desktop image
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            desktopDropArea.addEventListener(eventName, preventDefaults, false);
            mobileDropArea.addEventListener(eventName, preventDefaults, false);
        });
        
        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }
        
        ['dragenter', 'dragover'].forEach(eventName => {
            desktopDropArea.addEventListener(eventName, highlight.bind(null, desktopDropArea), false);
            mobileDropArea.addEventListener(eventName, highlight.bind(null, mobileDropArea), false);
        });
        
        ['dragleave', 'drop'].forEach(eventName => {
            desktopDropArea.addEventListener(eventName, unhighlight.bind(null, desktopDropArea), false);
            mobileDropArea.addEventListener(eventName, unhighlight.bind(null, mobileDropArea), false);
        });
        
        function highlight(element) {
            element.classList.add('border-blue-500', 'bg-blue-50');
        }
        
        function unhighlight(element) {
            element.classList.remove('border-blue-500', 'bg-blue-50');
        }
        
        desktopDropArea.addEventListener('drop', handleDrop.bind(null, desktopImage, desktopPreview, desktopPreviewContainer), false);
        mobileDropArea.addEventListener('drop', handleDrop.bind(null, mobileImage, mobilePreview, mobilePreviewContainer), false);
        
        function handleDrop(fileInput, previewImage, previewContainer, e) {
            const dt = e.dataTransfer;
            const file = dt.files[0];
            
            if (file && file.type.startsWith('image/')) {
                // Create a DataTransfer object and add our file
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                
                // Set the files property on the input
                fileInput.files = dataTransfer.files;
                
                // Show preview
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        }
    });
</script>
@endpush
@endsection