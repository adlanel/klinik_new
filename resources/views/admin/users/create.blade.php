@extends('layouts.admin.app')

@section('title', 'Tambah User Baru')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Tambah User Baru</h1>
        <p class="text-gray-600 mt-1">Buat akun user baru untuk sistem</p>
    </div>
    
    <form action="{{ route('admin.users.store') }}" method="POST" class="max-w-3xl">
        @csrf
        
        <div class="mb-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" 
                        class="w-full rounded-md @error('name') border-red-300 @else border-gray-300 @enderror shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" 
                        class="w-full rounded-md @error('email') border-red-300 @else border-gray-300 @enderror shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Telepon</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 @error('phone') ring-2 ring-red-200 @enderror" required>
                    @error('phone')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                    <select name="role" id="role" class="w-full rounded-md @error('role') border-red-300 @else border-gray-300 @enderror shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
                        <option value="">Pilih Role</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="terapis" {{ old('role') == 'terapis' ? 'selected' : '' }}>Terapis</option>
                        <option value="kepala_terapis" {{ old('role') == 'kepala_terapis' ? 'selected' : '' }}>Kepala Terapis</option>
                    </select>
                    @error('role')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="cabang_id" class="block text-sm font-medium text-gray-700 mb-1">Cabang</label>
                    <select name="cabang_id" id="cabang_id" class="w-full rounded-md @error('cabang_id') border-red-300 @else border-gray-300 @enderror shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <option value="">Pilih Cabang (Opsional)</option>
                        @foreach($branches as $branch)
                            <option value="{{ $branch->id }}" {{ old('cabang_id') == $branch->id ? 'selected' : '' }}>{{ $branch->nama_cabang }}</option>
                        @endforeach
                    </select>
                    @error('cabang_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="pendidikan" class="block text-sm font-medium text-gray-700 mb-1">Pendidikan</label>
                    <input type="text" name="pendidikan" id="pendidikan" value="{{ old('pendidikan') }}" 
                        class="w-full rounded-md @error('pendidikan') border-red-300 @else border-gray-300 @enderror shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    @error('pendidikan')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="bidang" class="block text-sm font-medium text-gray-700 mb-1">Bidang</label>
                    <input type="text" name="bidang" id="bidang" value="{{ old('bidang') }}" 
                        class="w-full rounded-md @error('bidang') border-red-300 @else border-gray-300 @enderror shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    @error('bidang')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
        
        <div class="mb-6">
            <h2 class="text-lg font-medium text-gray-800 mb-3">Password</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" id="password" 
                        class="w-full rounded-md @error('password') border-red-300 @else border-gray-300 @enderror shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" 
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
                </div>
            </div>
        </div>
        
        <div class="flex justify-between items-center pt-4 border-t border-gray-200">
            <a href="{{ route('admin.users.index') }}" class="text-gray-600 hover:text-gray-800">
                <i class="fas fa-arrow-left mr-1"></i> Kembali
            </a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline">
                <i class="fas fa-save mr-1"></i> Simpan
            </button>
        </div>
    </form>
</div>
@endsection