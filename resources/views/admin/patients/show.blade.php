@extends('layouts.admin.app')

@section('title', 'Detail Pasien')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Detail Pasien</h1>
            <p class="text-gray-600 mt-1">Informasi lengkap pasien: {{ $patient->nama_anak }}</p>
        </div>
        <div class="flex space-x-2">
            <a href="{{ route('admin.patients.edit', $patient->id_pasien) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                <i class="fas fa-edit mr-2"></i>Edit
            </a>
            <a href="{{ route('admin.patients.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>
    </div>
    
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Personal Information -->
        <div class="lg:col-span-2">
            <div class="bg-white border rounded-lg overflow-hidden">
                <div class="px-6 py-4 bg-gray-50 border-b">
                    <h2 class="text-lg font-semibold text-gray-800">Informasi Pribadi</h2>
                </div>
                <div class="p-6 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Nama Lengkap</h3>
                            <p class="text-base text-gray-900">{{ $patient->nama_anak }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">ID Pasien</h3>
                            <p class="text-base text-gray-900">{{ $patient->id_pasien }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Jenis Kelamin</h3>
                            <p class="text-base text-gray-900">{{ $patient->jenis_kelamin }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Usia</h3>
                            <p class="text-base text-gray-900">
                                @if($patient->tanggal_lahir)
                                    {{ \Carbon\Carbon::parse($patient->tanggal_lahir)->age }} tahun
                                    ({{ \Carbon\Carbon::parse($patient->tanggal_lahir)->format('d M Y') }})
                                @else
                                    -
                                @endif
                            </p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Tempat Lahir</h3>
                            <p class="text-base text-gray-900">{{ $patient->tempat_lahir ?? '-' }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Nama Orang Tua</h3>
                            <p class="text-base text-gray-900">{{ $patient->nama_orang_tua ?? '-' }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Telepon</h3>
                            <p class="text-base text-gray-900">{{ $patient->telepon ?? '-' }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Cabang Daftar</h3>
                            <p class="text-base text-gray-900">{{ $patient->cabang->nama_cabang ?? '-' }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <h3 class="text-sm font-medium text-gray-500">Alamat</h3>
                            <p class="text-base text-gray-900">{{ $patient->alamat ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Medical Information -->
            <div class="bg-white border rounded-lg overflow-hidden mt-6">
                <div class="px-6 py-4 bg-gray-50 border-b">
                    <h2 class="text-lg font-semibold text-gray-800">Informasi Medis</h2>
                </div>
                <div class="p-6 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Status Pasien</h3>
                            <p class="text-base text-gray-900">
                                @if($patient->status_pasien == 'Aktif')
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                        Aktif
                                    </span>
                                @else
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                        Tidak Aktif
                                    </span>
                                @endif
                            </p>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <h3 class="text-sm font-medium text-gray-500 mb-2">Keluhan Awal</h3>
                        <div class="bg-gray-50 p-4 rounded border">
                            <p class="text-base text-gray-900">{{ $patient->keluhan_awal ?? 'Tidak ada keluhan awal tercatat.' }}</p>
                        </div>
                    </div>
                    

                </div>
            </div>
        </div>
        
        <!-- Side Panel -->
        <div>
            <div class="bg-white border rounded-lg overflow-hidden">
                <div class="px-6 py-4 bg-gray-50 border-b">
                    <h2 class="text-lg font-semibold text-gray-800">Informasi Tambahan</h2>
                </div>
                <div class="p-6 space-y-6">
                    <div class="flex items-center space-x-4 p-4 bg-blue-50 rounded-lg border border-blue-100">
                        <div class="flex-shrink-0 h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center">
                            <i class="fas fa-calendar-check text-blue-600"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900">Riwayat Konsultasi</p>
                            <p class="text-sm text-gray-500">Lihat semua riwayat konsultasi pasien</p>
                            <a href="{{ route('admin.patients.history', $patient->id_pasien) }}" class="text-sm text-blue-600 hover:text-blue-800 mt-1 inline-block">Detail</a>
                        </div>
                    </div>
                    

                </div>
            </div>
            
            <!-- Actions -->
            <div class="bg-white border rounded-lg overflow-hidden mt-6">
                <div class="px-6 py-4 bg-gray-50 border-b">
                    <h2 class="text-lg font-semibold text-gray-800">Aksi</h2>
                </div>
                <div class="p-6">
                    <div class="space-y-3">
                        <a href="{{ route('admin.patients.edit', $patient->id_pasien) }}" class="flex items-center w-full px-4 py-2 bg-blue-50 hover:bg-blue-100 text-blue-700 rounded-md">
                            <i class="fas fa-edit mr-2"></i>
                            <span>Edit Data Pasien</span>
                        </a>
                        <a href="#" class="flex items-center w-full px-4 py-2 bg-green-50 hover:bg-green-100 text-green-700 rounded-md">
                            <i class="fas fa-calendar-plus mr-2"></i>
                            <span>Jadwalkan Konsultasi</span>
                        </a>
                        <form action="{{ route('admin.patients.destroy', $patient->id_pasien) }}" method="POST" 
                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pasien ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="flex items-center w-full px-4 py-2 bg-red-50 hover:bg-red-100 text-red-700 rounded-md">
                                <i class="fas fa-trash-alt mr-2"></i>
                                <span>Hapus Data Pasien</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection