@extends('layouts.terapis.app')

@section('title', 'My Profile')

@section('content')
    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">My Profile</h1>
        
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Profile Information -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Profile Information</h2>
                    <p class="text-sm text-gray-600 mb-4">Update your account's profile information.</p>
                    
                    <form action="{{ route('terapis.profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <!-- Name -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="mt-1 block w-full rounded-md @error('name') border-red-500 @else border-gray-300 @enderror shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="mt-1 block w-full rounded-md @error('email') border-red-500 @else border-gray-300 @enderror shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <!-- Phone -->
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                                <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" class="mt-1 block w-full rounded-md @error('phone') border-red-500 @else border-gray-300 @enderror shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                                @error('phone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <!-- Role (read-only) -->
                            <div>
                                <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                                <input type="text" id="role" value="{{ ucfirst($user->role) }}" class="mt-1 block w-full rounded-md border-gray-300 bg-gray-50 shadow-sm" disabled readonly>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <!-- Education -->
                            <div>
                                <label for="pendidikan" class="block text-sm font-medium text-gray-700 mb-1">Education</label>
                                <input type="text" name="pendidikan" id="pendidikan" value="{{ old('pendidikan', $user->pendidikan) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                            </div>
                            
                            <!-- Field/Specialty -->
                            <div>
                                <label for="bidang" class="block text-sm font-medium text-gray-700 mb-1">Specialty</label>
                                <input type="text" name="bidang" id="bidang" value="{{ old('bidang', $user->bidang) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                            </div>
                        </div>
                        
                        <div class="flex justify-end">
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
                
                <!-- Password Update Section -->
                <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-6 mt-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Update Password</h2>
                    <p class="text-sm text-gray-600 mb-4">Ensure your account is using a secure password.</p>
                    
                    <form action="{{ route('terapis.profile.password.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">Current Password</label>
                            <input type="password" name="current_password" id="current_password" class="mt-1 block w-full rounded-md @error('current_password') border-red-500 @else border-gray-300 @enderror shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                            @error('current_password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                            <input type="password" name="password" id="password" class="mt-1 block w-full rounded-md @error('password') border-red-500 @else border-gray-300 @enderror shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                            @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-6">
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                        </div>
                        
                        <div class="flex justify-end">
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Update Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Profile Card -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-6">
                    <div class="flex flex-col items-center text-center">
                        <div class="h-24 w-24 rounded-full bg-blue-500 flex items-center justify-center text-white text-3xl mb-4">
                            {{ substr($user->name, 0, 1) }}
                        </div>
                        <h2 class="text-xl font-semibold text-gray-800">{{ $user->name }}</h2>
                        <p class="text-gray-600 mb-1">{{ ucfirst($user->role) }}</p>
                        <p class="text-gray-500 text-sm mb-4">{{ $user->email }}</p>
                        
                        <div class="w-full border-t border-gray-200 pt-4 mt-2">
                            <div class="flex items-center mb-2">
                                <i class="fas fa-phone-alt text-gray-500 mr-2"></i>
                                <span class="text-gray-700">{{ $user->phone }}</span>
                            </div>
                            
                            @if($user->pendidikan)
                            <div class="flex items-center mb-2">
                                <i class="fas fa-graduation-cap text-gray-500 mr-2"></i>
                                <span class="text-gray-700">{{ $user->pendidikan }}</span>
                            </div>
                            @endif
                            
                            @if($user->bidang)
                            <div class="flex items-center">
                                <i class="fas fa-briefcase text-gray-500 mr-2"></i>
                                <span class="text-gray-700">{{ $user->bidang }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection