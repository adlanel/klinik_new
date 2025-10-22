@extends('layouts.admin.app')

@section('title', 'Tambah Layanan')

@section('content')
<div class="container px-6 py-8 mx-auto">
    <div class="flex justify-between items-center">
        <h3 class="text-3xl font-medium text-gray-700">Tambah Layanan</h3>
        <a href="{{ route('admin.content.layanan.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 transition">
            <i class="fas fa-arrow-left mr-2"></i>Kembali
        </a>
    </div>
    
    <div class="mt-8">
        @include('layouts.admin.messages')
        
        <div class="bg-white p-6 rounded-md shadow">
            <form action="{{ route('admin.content.layanan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-6">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Judul Layanan</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200" required>
                    @error('title')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="harga_reguler_weekday" class="block text-sm font-medium text-gray-700 mb-2">Harga Reguler Weekday</label>
                        <input type="number" step="0.01" min="0" name="harga_reguler_weekday" id="harga_reguler_weekday" value="{{ old('harga_reguler_weekday', 0) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200">
                        @error('harga_reguler_weekday')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="harga_paket_weekday" class="block text-sm font-medium text-gray-700 mb-2">Harga Paket Weekday</label>
                        <input type="number" step="0.01" min="0" name="harga_paket_weekday" id="harga_paket_weekday" value="{{ old('harga_paket_weekday', 0) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200">
                        @error('harga_paket_weekday')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="harga_reguler_weekend" class="block text-sm font-medium text-gray-700 mb-2">Harga Reguler Weekend</label>
                        <input type="number" step="0.01" min="0" name="harga_reguler_weekend" id="harga_reguler_weekend" value="{{ old('harga_reguler_weekend', 0) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200">
                        @error('harga_reguler_weekend')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="harga_paket_weekend" class="block text-sm font-medium text-gray-700 mb-2">Harga Paket Weekend</label>
                        <input type="number" step="0.01" min="0" name="harga_paket_weekend" id="harga_paket_weekend" value="{{ old('harga_paket_weekend', 0) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200">
                        @error('harga_paket_weekend')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div class="mb-6">
                    <label for="short_description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Singkat</label>
                    <textarea name="short_description" id="short_description" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200">{{ old('short_description') }}</textarea>
                    @error('short_description')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Lengkap</label>
                    <textarea name="description" id="description" rows="10" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200">{{ old('description') }}</textarea>
                    <p class="text-xs text-gray-500 mt-1">HTML tags seperti &lt;b&gt;, &lt;i&gt;, &lt;ul&gt;, &lt;li&gt;, dll diperbolehkan.</p>
                    @error('description')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-6">
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Gambar</label>
                    <div class="flex items-center justify-center w-full">
                        <label class="flex flex-col w-full h-32 border-2 border-dashed border-gray-300 rounded-lg hover:bg-gray-50 hover:border-gray-400 cursor-pointer">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6" id="image-preview-section">
                                <i class="fas fa-cloud-upload-alt text-2xl text-gray-400 mb-2"></i>
                                <p class="text-sm text-gray-500">Klik untuk upload gambar</p>
                                <p class="text-xs text-gray-400 mt-1">PNG, JPG, GIF, WEBP up to 2MB</p>
                            </div>
                            <input type="file" name="image" id="image" class="hidden" accept="image/*" required>
                        </label>
                    </div>
                    <div id="image-preview" class="mt-3 hidden">
                        <img src="" alt="Preview" class="h-40 object-contain">
                    </div>
                    @error('image')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-6">
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select name="status" id="status" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200">
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="flex justify-end">
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@section('scripts')
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
@endsection