@extends('layouts.admin.app')

@section('title', 'Kelola Informasi Tentang Kami')

@section('content')
<div class="container px-6 py-8 mx-auto">
    <h3 class="text-3xl font-medium text-gray-700">Kelola Informasi Tentang Kami</h3>
    
    <div class="mt-8">
        @include('layouts.admin.messages')
        
        <div class="bg-white p-6 rounded-md shadow">
            <form action="{{ route('admin.content.aboutus.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-6">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Judul</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $aboutUs->title) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200" required>
                    @error('title')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                    <textarea name="description" id="description" rows="6" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200" required>{{ old('description', $aboutUs->description) }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Saat Ini</label>
                    <div class="mb-4">
                        <img src="{{ $aboutUs->image_url }}" alt="Current Image" class="h-40 object-contain border rounded">
                    </div>
                    
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Upload New Image (Optional)</label>
                    <div class="flex items-center justify-center w-full">
                        <label class="flex flex-col w-full h-32 border-2 border-dashed border-gray-300 rounded-lg hover:bg-gray-50 hover:border-gray-400 cursor-pointer">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6" id="image-preview-section">
                                <i class="fas fa-cloud-upload-alt text-2xl text-gray-400 mb-2"></i>
                                <p class="text-sm text-gray-500">Klik untuk upload gambar baru</p>
                                <p class="text-xs text-gray-400 mt-1">PNG, JPG, GIF up to 2MB</p>
                            </div>
                            <input type="file" name="image" id="image" class="hidden" accept="image/*">
                        </label>
                    </div>
                    <div id="image-preview" class="mt-3 hidden">
                        <img src="" alt="Preview" class="h-40 object-contain">
                    </div>
                    @error('image')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="flex justify-end">
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Image preview functionality
    document.addEventListener('DOMContentLoaded', function() {
        const imageInput = document.getElementById('image');
        const imagePreview = document.getElementById('image-preview');
        const previewImg = imagePreview.querySelector('img');
        
        imageInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    previewImg.setAttribute('src', e.target.result);
                    imagePreview.classList.remove('hidden');
                };
                
                reader.readAsDataURL(this.files[0]);
            }
        });
    });
</script>
@endsection