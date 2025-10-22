@extends('layouts.admin.app')

@section('title', 'Edit Data Pasien')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Edit Data Pasien</h1>
            <p class="text-gray-600 mt-1">Edit informasi pasien: {{ $patient->nama_anak }}</p>
        </div>
        <div>
            <a href="{{ route('admin.patients.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>
    </div>
    
    @if($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
            <p class="font-bold">Terjadi kesalahan:</p>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ route('admin.patients.update', $patient->id_pasien) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Nama Anak -->
            <div>
                <label for="nama_anak" class="block text-sm font-medium text-gray-700 mb-1">Nama Anak <span class="text-red-500">*</span></label>
                <input type="text" name="nama_anak" id="nama_anak" required value="{{ old('nama_anak', $patient->nama_anak) }}" 
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
            </div>
            
            <!-- Jenis Kelamin -->
            <div>
                <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin <span class="text-red-500">*</span></label>
                <select name="jenis_kelamin" id="jenis_kelamin" required 
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    <option value="Laki-laki" {{ old('jenis_kelamin', $patient->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ old('jenis_kelamin', $patient->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
            
            <!-- Tempat Lahir -->
            <div>
                <label for="tempat_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" id="tempat_lahir" value="{{ old('tempat_lahir', $patient->tempat_lahir) }}" 
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
            </div>
            
            <!-- Tanggal Lahir -->
            <div>
                <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir', $patient->tanggal_lahir) }}" 
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
            </div>
            
            <!-- Nama Orang Tua -->
            <div>
                <label for="nama_orang_tua" class="block text-sm font-medium text-gray-700 mb-1">Nama Orang Tua</label>
                <input type="text" name="nama_orang_tua" id="nama_orang_tua" value="{{ old('nama_orang_tua', $patient->nama_orang_tua) }}" 
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
            </div>
            
            <!-- Telepon -->
            <div>
                <label for="telepon" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                <input type="text" name="telepon" id="telepon" value="{{ old('telepon', $patient->telepon) }}" 
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
            </div>
            
            <!-- Cabang -->
            <div>
                <label for="id_cabang" class="block text-sm font-medium text-gray-700 mb-1">Cabang <span class="text-red-500">*</span></label>
                <select name="id_cabang" id="id_cabang" required 
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    <option value="">Pilih Cabang</option>
                    @foreach($branches as $branch)
                        <option value="{{ $branch->id }}" {{ old('id_cabang', $patient->id_cabang) == $branch->id ? 'selected' : '' }}>{{ $branch->nama_cabang }}</option>
                    @endforeach
                </select>
            </div>
            
            <!-- Status Pasien -->
            <div>
                <label for="status_pasien" class="block text-sm font-medium text-gray-700 mb-1">Status Pasien <span class="text-red-500">*</span></label>
                <select name="status_pasien" id="status_pasien" required 
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    <option value="Aktif" {{ old('status_pasien', $patient->status_pasien) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="Tidak Aktif" {{ old('status_pasien', $patient->status_pasien) == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
            </div>
        </div>
        
        <!-- Alamat -->
        <div>
            <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
            <textarea name="alamat" id="alamat" rows="3" 
                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">{{ old('alamat', $patient->alamat) }}</textarea>
        </div>
        
        <!-- Keluhan Awal -->
        <div>
            <label for="keluhan_awal" class="block text-sm font-medium text-gray-700 mb-1">Keluhan Awal</label>
            <textarea name="keluhan_awal" id="keluhan_awal" rows="3" 
                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">{{ old('keluhan_awal', $patient->keluhan_awal) }}</textarea>
        </div>
        

        
        <div class="flex justify-end space-x-2">
            <a href="{{ route('admin.patients.index') }}" class="bg-gray-400 hover:bg-gray-500 text-white font-bold py-2 px-6 rounded">
                Batal
            </a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">
                Perbarui Data
            </button>
        </div>
    </form>
</div>
@endsection