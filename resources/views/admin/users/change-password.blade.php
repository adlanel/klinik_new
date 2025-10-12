@extends('layouts.admin.app')

@section('title', 'Ganti Password User')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Ganti Password User</h1>
        <p class="text-gray-600 mt-1">Update password untuk user {{ $user->name }}</p>
    </div>
    
    <form action="{{ route('admin.users.update-password', $user->id) }}" method="POST" class="max-w-3xl">
        @csrf
        @method('PUT')
        
        <div class="mb-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
                    <input type="password" name="password" id="password" 
                        class="w-full rounded-md @error('password') border-red-300 @else border-gray-300 @enderror shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password Baru</label>
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
                <i class="fas fa-key mr-1"></i> Update Password
            </button>
        </div>
    </form>
</div>
@endsection