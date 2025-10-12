@extends('layouts.admin.app')

@section('title', 'Edit Cabang')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="mb-6">
        <div class="flex items-center justify-between mb-4">
            <h1 class="text-2xl font-bold text-gray-800">Edit Cabang</h1>
            <a href="{{ route('admin.content.branches.index') }}" class="text-blue-600 hover:text-blue-800">
                <i class="fas fa-arrow-left mr-1"></i> Kembali
            </a>
        </div>
        <p class="text-gray-600">Edit informasi cabang klinik</p>
    </div>
    
    <form action="{{ route('admin.content.branches.update', $branch->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')
        
        <!-- Form Fields -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Nama Cabang -->
            <div>
                <label for="nama_cabang" class="block text-sm font-medium text-gray-700 mb-1">Nama Cabang <span class="text-red-600">*</span></label>
                <input type="text" name="nama_cabang" id="nama_cabang" value="{{ old('nama_cabang', $branch->nama_cabang) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
                @error('nama_cabang')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- No Telepon -->
            <div>
                <label for="no_telp" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                <input type="text" name="no_telp" id="no_telp" value="{{ old('no_telp', $branch->no_telp) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" placeholder="Contoh: 081234567890">
                @error('no_telp')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
        
        <!-- Alamat -->
        <div>
            <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap <span class="text-red-600">*</span></label>
            <textarea name="alamat" id="alamat" rows="3" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>{{ old('alamat', $branch->alamat) }}</textarea>
            @error('alamat')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <!-- Link Maps -->
        <div>
            <label for="link_maps" class="block text-sm font-medium text-gray-700 mb-1">Link Google Maps</label>
            <input type="url" name="link_maps" id="link_maps" value="{{ old('link_maps', $branch->link_maps) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" placeholder="Contoh: https://goo.gl/maps/...">
            <p class="text-xs text-gray-500 mt-1">Masukkan link Google Maps untuk lokasi cabang</p>
            @error('link_maps')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <!-- Maps Preview -->
        @if($branch->link_maps)
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Preview Maps</label>
                <div class="border border-gray-300 rounded-md overflow-hidden h-72">
                    <iframe src="{{ $branch->link_maps }}" width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
            </div>
        @endif
        
        <!-- Submit Button -->
        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">
                <i class="fas fa-save mr-2"></i>Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection