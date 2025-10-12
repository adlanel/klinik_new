@extends('layouts.terapis.app')

@section('title', 'Edit Pasien')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Edit Data Pasien</h1>
            <p class="text-gray-600 mt-1">{{ $patient->nama_anak }}</p>
        </div>
        <div class="mt-4 md:mt-0">
            <a href="{{ route('terapis.patients.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>
    </div>
    
    @if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        <strong class="font-bold">Error!</strong>
        <span class="block sm:inline">Please check the form for errors.</span>
        <ul class="mt-2 list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    
    <form action="{{ route('terapis.patients.update', $patient->id_pasien) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')
        
        <div class="bg-white rounded-lg border overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b">
                <h2 class="text-lg font-semibold text-gray-800">Informasi Pribadi</h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="nama_anak" class="block text-sm font-medium text-gray-700 mb-1">Nama Anak <span class="text-red-500">*</span></label>
                        <input type="text" id="nama_anak" name="nama_anak" value="{{ old('nama_anak', $patient->nama_anak) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                    </div>
                    
                    <div>
                        <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin <span class="text-red-500">*</span></label>
                        <select id="jenis_kelamin" name="jenis_kelamin" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                            <option value="Laki-laki" {{ old('jenis_kelamin', $patient->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin', $patient->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="tempat_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir</label>
                        <input type="text" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir', $patient->tempat_lahir) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                    </div>
                    
                    <div>
                        <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                        <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', $patient->tanggal_lahir) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                    </div>
                    
                    <div>
                        <label for="nama_orang_tua" class="block text-sm font-medium text-gray-700 mb-1">Nama Orang Tua</label>
                        <input type="text" id="nama_orang_tua" name="nama_orang_tua" value="{{ old('nama_orang_tua', $patient->nama_orang_tua) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                    </div>
                    
                    <div>
                        <label for="telepon" class="block text-sm font-medium text-gray-700 mb-1">Telepon</label>
                        <input type="text" id="telepon" name="telepon" value="{{ old('telepon', $patient->telepon) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                    </div>
                </div>
                
                <div class="mt-6">
                    <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                    <textarea id="alamat" name="alamat" rows="3" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">{{ old('alamat', $patient->alamat) }}</textarea>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg border overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b">
                <h2 class="text-lg font-semibold text-gray-800">Informasi Terapi</h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="id_cabang" class="block text-sm font-medium text-gray-700 mb-1">Cabang <span class="text-red-500">*</span></label>
                        <select id="id_cabang" name="id_cabang" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                            @foreach($branches as $branch)
                                <option value="{{ $branch->id }}" {{ old('id_cabang', $patient->id_cabang) == $branch->id ? 'selected' : '' }}>
                                    {{ $branch->nama_cabang }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div>
                        <label for="jenis_terapi" class="block text-sm font-medium text-gray-700 mb-1">Jenis Terapi</label>
                        <input type="text" id="jenis_terapi" name="jenis_terapi" value="{{ old('jenis_terapi', $patient->jenis_terapi) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                    </div>
                    
                    <div>
                        <label for="status_pasien" class="block text-sm font-medium text-gray-700 mb-1">Status Pasien <span class="text-red-500">*</span></label>
                        <select id="status_pasien" name="status_pasien" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                            <option value="Aktif" {{ old('status_pasien', $patient->status_pasien) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="Tidak Aktif" {{ old('status_pasien', $patient->status_pasien) == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="terakhir_konsultasi" class="block text-sm font-medium text-gray-700 mb-1">Terakhir Konsultasi</label>
                        <input type="date" id="terakhir_konsultasi" name="terakhir_konsultasi" value="{{ old('terakhir_konsultasi', $patient->terakhir_konsultasi) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                    </div>
                </div>
                
                <div class="mt-6">
                    <label for="keluhan_awal" class="block text-sm font-medium text-gray-700 mb-1">Keluhan Awal</label>
                    <textarea id="keluhan_awal" name="keluhan_awal" rows="3" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">{{ old('keluhan_awal', $patient->keluhan_awal) }}</textarea>
                </div>
                
                <div class="mt-6">
                    <label for="hasil_follow_up" class="block text-sm font-medium text-gray-700 mb-1">Hasil Follow Up</label>
                    <textarea id="hasil_follow_up" name="hasil_follow_up" rows="3" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">{{ old('hasil_follow_up', $patient->hasil_follow_up) }}</textarea>
                </div>
            </div>
        </div>
        
        <div class="flex justify-between">
            <a href="{{ route('terapis.patients.show', $patient->id_pasien) }}" class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded">
                <i class="fas fa-arrow-left mr-2"></i> Cancel
            </a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded">
                <i class="fas fa-save mr-2"></i> Update Data Pasien
            </button>
        </div>
    </form>
</div>
@endsection