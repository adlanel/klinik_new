@extends('layouts.terapis.app')

@section('title', 'Detail Pasien')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Detail Pasien</h1>
            <p class="text-gray-600 mt-1">Informasi lengkap pasien: {{ $patient->nama_anak }}</p>
        </div>
        <div class="flex space-x-2">
            <a href="{{ route('terapis.patients.edit', $patient->id_pasien) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                <i class="fas fa-edit mr-2"></i>Edit
            </a>
            <a href="{{ route('terapis.patients.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
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
                            <h3 class="text-sm font-medium text-gray-500">Alamat</h3>
                            <p class="text-base text-gray-900">{{ $patient->alamat ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Therapy Information -->
            <div class="bg-white border rounded-lg overflow-hidden mt-6">
                <div class="px-6 py-4 bg-gray-50 border-b">
                    <h2 class="text-lg font-semibold text-gray-800">Informasi Terapi</h2>
                </div>
                <div class="p-6 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Jenis Terapi</h3>
                            <p class="text-base text-gray-900">{{ $patient->jenis_terapi ?? '-' }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Status Pasien</h3>
                            <p class="text-base text-gray-900">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $patient->status_pasien == 'Aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $patient->status_pasien }}
                                </span>
                            </p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Cabang</h3>
                            <p class="text-base text-gray-900">{{ $patient->cabang->nama_cabang ?? '-' }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Terakhir Konsultasi</h3>
                            <p class="text-base text-gray-900">
                                @if($patient->terakhir_konsultasi)
                                    {{ \Carbon\Carbon::parse($patient->terakhir_konsultasi)->format('d M Y') }}
                                @else
                                    -
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Clinical Information -->
        <div>
            <div class="bg-white border rounded-lg overflow-hidden">
                <div class="px-6 py-4 bg-gray-50 border-b">
                    <h2 class="text-lg font-semibold text-gray-800">Informasi Klinis</h2>
                </div>
                <div class="p-6 space-y-6">
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Keluhan Awal</h3>
                        <div class="mt-1 p-3 bg-gray-50 rounded-md">
                            <p class="text-sm text-gray-900 whitespace-pre-wrap">{{ $patient->keluhan_awal ?? '-' }}</p>
                        </div>
                    </div>
                    
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Hasil Follow Up</h3>
                        <div class="mt-1 p-3 bg-gray-50 rounded-md">
                            <p class="text-sm text-gray-900 whitespace-pre-wrap">{{ $patient->hasil_follow_up ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Additional Actions -->
            <div class="mt-6 space-y-3">
                <a href="{{ route('terapis.patients.edit', $patient->id_pasien) }}" class="block w-full py-2 px-4 text-center bg-blue-600 hover:bg-blue-700 text-white font-medium rounded">
                    <i class="fas fa-edit mr-2"></i> Update Data Pasien
                </a>
                <a href="{{ route('terapis.patients.index') }}" class="block w-full py-2 px-4 text-center bg-gray-500 hover:bg-gray-600 text-white font-medium rounded">
                    <i class="fas fa-list mr-2"></i> Kembali ke Daftar Pasien
                </a>
            </div>
        </div>
    </div>
</div>
@endsection