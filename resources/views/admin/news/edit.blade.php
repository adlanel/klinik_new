@extends('layouts.admin.app')

@section('title', 'Edit Berita')

@section('content')
<div class="container px-6 py-8 mx-auto">
    <div class="flex items-center justify-between">
        <h3 class="text-3xl font-medium text-gray-700">Edit Berita</h3>
        <a href="{{ route('admin.content.news.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 transition">
            <i class="fas fa-arrow-left mr-2"></i>Kembali
        </a>
    </div>
    
    <div class="mt-8">
        @include('layouts.admin.messages')
        
        <div class="p-6 bg-white rounded-md shadow">
            <form action="{{ route('admin.content.news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Judul Berita <span class="text-red-500">*</span></label>
                        <input type="text" name="title" id="title" value="{{ old('title', $news->title) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200" required>
                        @error('title')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="author" class="block text-sm font-medium text-gray-700 mb-2">Penulis</label>
                        <input type="text" name="author" id="author" value="{{ old('author', $news->author) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200">
                        @error('author')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status <span class="text-red-500">*</span></label>
                        <select name="status" id="status" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200" required>
                            <option value="draft" {{ old('status', $news->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ old('status', $news->status) == 'published' ? 'selected' : '' }}>Published</option>
                            <option value="archived" {{ old('status', $news->status) == 'archived' ? 'selected' : '' }}>Archived</option>
                        </select>
                        @error('status')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="published_at" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Publikasi</label>
                        <input type="datetime-local" name="published_at" id="published_at" value="{{ old('published_at', $news->published_at ? $news->published_at->format('Y-m-d\TH:i') : '') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200">
                        @error('published_at')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6">
                    <label for="short_description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Singkat</label>
                    <textarea name="short_description" id="short_description" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200">{{ old('short_description', $news->short_description) }}</textarea>
                    @error('short_description')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-6">
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Konten</label>
                    <textarea name="content" id="content" rows="8" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200 ckeditor">{{ old('content', $news->content) }}</textarea>
                    @error('content')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mt-6">
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Gambar (Max: 2MB, Format: JPG, PNG, GIF, WEBP)</label>
                    <input type="file" name="image" id="image" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200" accept="image/jpeg,image/png,image/gif,image/webp">
                    @error('image')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    
                    <div id="imagePreview" class="mt-2 {{ $news->image ? '' : 'hidden' }}">
                        <img id="preview" src="{{ $news->image ? $news->image_url : '#' }}" alt="Preview" class="h-32 object-cover rounded">
                        @if($news->image)
                            <p class="text-sm text-gray-500 mt-1">Current image: {{ $news->image }}</p>
                        @endif
                    </div>
                </div>

                <div class="mt-6">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                        <i class="fas fa-save mr-2"></i>Perbarui
                    </button>
                    <a href="{{ route('admin.content.news.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 transition ml-2">
                        <i class="fas fa-times mr-2"></i>Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize CKEditor
        CKEDITOR.replace('content', {
            filebrowserUploadUrl: "{{ route('admin.upload.image') }}?_token={{ csrf_token() }}",
            filebrowserUploadMethod: 'form'
        });
        
        // Image preview
        const imageInput = document.getElementById('image');
        const imagePreview = document.getElementById('imagePreview');
        const preview = document.getElementById('preview');
        
        imageInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    imagePreview.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        });
    });
</script>
@endsection