@extends('layouts.terapis.app')

@section('title', 'Detail Jadwal Tugas - Terapis')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Detail Jadwal Tugas</h1>
            <p class="text-gray-600 mt-1">Informasi lengkap jadwal tugas terapi</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('terapis.jadwal-tugas.edit', $jadwalTugas->id) }}" 
               class="inline-flex items-center px-4 py-2 bg-yellow-600 text-white rounded-md hover:bg-yellow-700 transition-colors">
                <i class="fas fa-edit mr-2"></i>
                Edit
            </a>
            <a href="{{ route('terapis.jadwal-tugas.pdf', $jadwalTugas->id) }}" 
               class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors"
               target="_blank">
                <i class="fas fa-file-pdf mr-2"></i>
                Download PDF
            </a>
            <a href="{{ route('terapis.jadwal-tugas.index') }}" 
               class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali
            </a>
        </div>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Informasi Jadwal -->
        <div class="bg-white rounded-lg shadow-sm border p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-calendar-alt text-blue-600 mr-2"></i>
                Informasi Jadwal
            </h2>
            
            <div class="space-y-4">
                <div class="flex justify-between py-2 border-b border-gray-100">
                    <span class="font-medium text-gray-600">Tanggal Terapi:</span>
                    <span class="text-gray-800">{{ \Carbon\Carbon::parse($jadwalTugas->tanggal_terapi)->format('d/m/Y') }}</span>
                </div>
                
                <div class="flex justify-between py-2 border-b border-gray-100">
                    <span class="font-medium text-gray-600">Jam Sesi:</span>
                    <span class="text-gray-800">{{ $jadwalTugas->jam_sesi }}</span>
                </div>
                
                <div class="flex justify-between py-2 border-b border-gray-100">
                    <span class="font-medium text-gray-600">Status:</span>
                    <span>
                        @if($jadwalTugas->status == 'Sudah Dikerjakan')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <i class="fas fa-check-circle mr-1"></i>
                                Selesai
                            </span>
                        @elseif($jadwalTugas->status == 'Belum Dikerjakan')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                <i class="fas fa-clock mr-1"></i>
                                Menunggu
                            </span>
                        @elseif($jadwalTugas->status == 'Cancelled')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                <i class="fas fa-times-circle mr-1"></i>
                                Batal
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                {{ $jadwalTugas->status ?? 'Unknown' }}
                            </span>
                        @endif
                    </span>
                </div>
                
                <div class="flex justify-between py-2 border-b border-gray-100">
                    <span class="font-medium text-gray-600">Jenis Paket:</span>
                    <span class="text-gray-800">
                        @if($jadwalTugas->jenis_paket)
                            <span class="capitalize">{{ str_replace('_', ' ', $jadwalTugas->jenis_paket) }}</span>
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </span>
                </div>
                
                <div class="flex justify-between py-2 border-b border-gray-100">
                    <span class="font-medium text-gray-600">Layanan:</span>
                    <span class="text-gray-800">{{ $jadwalTugas->nama_layanan }}</span>
                </div>
                
                <div class="flex justify-between py-2">
                    <span class="font-medium text-gray-600">Cabang:</span>
                    <span class="text-gray-800">{{ $jadwalTugas->nama_cabang }}</span>
                </div>
            </div>
        </div>

        <!-- Informasi Pasien -->
        <div class="bg-white rounded-lg shadow-sm border p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-user-injured text-green-600 mr-2"></i>
                Informasi Pasien
            </h2>
            
            <div class="space-y-4">
                <div class="flex justify-between py-2 border-b border-gray-100">
                    <span class="font-medium text-gray-600">Nama Anak:</span>
                    <span class="text-gray-800 font-medium">{{ $jadwalTugas->nama_pasien }}</span>
                </div>
                
                @if($jadwalTugas->nama_orang_tua)
                <div class="flex justify-between py-2 border-b border-gray-100">
                    <span class="font-medium text-gray-600">Nama Orang Tua:</span>
                    <span class="text-gray-800">{{ $jadwalTugas->nama_orang_tua }}</span>
                </div>
                @endif
                
                @if($jadwalTugas->telepon)
                <div class="flex justify-between py-2 border-b border-gray-100">
                    <span class="font-medium text-gray-600">Telepon:</span>
                    <span class="text-gray-800">{{ $jadwalTugas->telepon }}</span>
                </div>
                @endif
                
                @if($jadwalTugas->alamat)
                <div class="py-2">
                    <span class="font-medium text-gray-600 block mb-2">Alamat:</span>
                    <span class="text-gray-800">{{ $jadwalTugas->alamat }}</span>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Catatan Terapi -->
    <div class="mt-6 bg-white rounded-lg shadow-sm border p-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
            <i class="fas fa-sticky-note text-purple-600 mr-2"></i>
            Catatan Terapi
        </h2>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div>
                <h3 class="font-medium text-gray-600 mb-2">Notes:</h3>
                <div class="bg-gray-50 rounded-md p-4 min-h-24">
                    @if($jadwalTugas->notes)
                        <p class="text-gray-800 whitespace-pre-wrap">{{ $jadwalTugas->notes }}</p>
                    @else
                        <p class="text-gray-400 italic">Belum ada catatan</p>
                    @endif
                </div>
            </div>
            
            <div>
                <h3 class="font-medium text-gray-600 mb-2">Saran di Rumah:</h3>
                <div class="bg-gray-50 rounded-md p-4 min-h-24">
                    @if($jadwalTugas->saran_dirumah)
                        <p class="text-gray-800 whitespace-pre-wrap">{{ $jadwalTugas->saran_dirumah }}</p>
                    @else
                        <p class="text-gray-400 italic">Belum ada saran</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="mt-6 flex justify-center space-x-4">
        <a href="{{ route('terapis.jadwal-tugas.edit', $jadwalTugas->id) }}" 
           class="inline-flex items-center px-8 py-3 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition-colors shadow-lg">
            <i class="fas fa-edit mr-2"></i>
            Edit Status & Catatan
        </a>
        <a href="{{ route('terapis.jadwal-tugas.pdf', $jadwalTugas->id) }}" 
           class="inline-flex items-center px-8 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors shadow-lg"
           target="_blank">
            <i class="fas fa-file-pdf mr-2"></i>
            Download PDF
        </a>
    </div>
</div>
@endsection