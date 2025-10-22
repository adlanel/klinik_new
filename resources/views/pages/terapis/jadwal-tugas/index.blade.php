@extends('layouts.terapis.app')

@section('title', 'Jadwal Tugas - Terapis')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Jadwal Tugas</h1>
            <p class="text-gray-600 mt-1">Daftar pasien yang ditangani oleh {{ auth()->user()->name }}</p>
        </div>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            <i class="fas fa-check-circle mr-2"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <i class="fas fa-exclamation-circle mr-2"></i>
            {{ session('error') }}
        </div>
    @endif

    <!-- Filter Section -->
    <div class="bg-white rounded-lg shadow-sm border p-4 mb-6">
        <form method="GET" action="{{ route('terapis.jadwal-tugas.index') }}" class="flex flex-wrap gap-4 items-end">
            <!-- Search -->
            <div class="flex-1 min-w-64">
                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Cari Pasien</label>
                <input type="text" id="search" name="search" value="{{ request('search') }}" 
                       placeholder="Nama pasien..." 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Date Filter -->
            <div>
                <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                <input type="date" id="tanggal" name="tanggal" value="{{ request('tanggal') }}" 
                       class="px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Status Filter -->
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select id="status" name="status" 
                        class="px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Semua Status</option>
                    <option value="Belum Dikerjakan" {{ request('status') == 'Belum Dikerjakan' ? 'selected' : '' }}>Belum Dikerjakan</option>
                    <option value="Sudah Dikerjakan" {{ request('status') == 'Sudah Dikerjakan' ? 'selected' : '' }}>Sudah Dikerjakan</option>
                    <option value="Cancelled" {{ request('status') == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>

            <!-- Buttons -->
            <div class="flex gap-2">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                    <i class="fas fa-search mr-1"></i> Filter
                </button>
                <a href="{{ route('terapis.jadwal-tugas.index') }}" 
                   class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition-colors">
                    <i class="fas fa-times mr-1"></i> Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-calendar-alt text-blue-600 text-xl"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-blue-600">Total Sesi</p>
                    <p class="text-lg font-semibold text-blue-800">{{ $jadwalTugas->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-clock text-yellow-600 text-xl"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-yellow-600">Belum Dikerjakan</p>
                    <p class="text-lg font-semibold text-yellow-800">
                        {{ $jadwalTugas->where('status', 'Belum Dikerjakan')->count() }}
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-check-circle text-green-600 text-xl"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-600">Sudah Dikerjakan</p>
                    <p class="text-lg font-semibold text-green-800">
                        {{ $jadwalTugas->where('status', 'Sudah Dikerjakan')->count() }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Jadwal Tugas Table -->
    <div class="bg-white rounded-lg shadow-sm border overflow-hidden">
        @if($jadwalTugas->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal & Jam
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Pasien
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Layanan
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Cabang
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Jenis Paket
                            </th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($jadwalTugas as $tugas)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ \Carbon\Carbon::parse($tugas->tanggal_terapi)->format('d/m/Y') }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ $tugas->jam_sesi }}
                                    </div>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $tugas->nama_pasien }}
                                    </div>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        {{ $tugas->nama_layanan }}
                                    </div>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        {{ $tugas->nama_cabang }}
                                    </div>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    @if($tugas->status == 'Sudah Dikerjakan')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <i class="fas fa-check-circle mr-1"></i>
                                            Selesai
                                        </span>
                                    @elseif($tugas->status == 'Belum Dikerjakan')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            <i class="fas fa-clock mr-1"></i>
                                            Menunggu
                                        </span>
                                    @elseif($tugas->status == 'Cancelled')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            <i class="fas fa-times-circle mr-1"></i>
                                            Batal
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            {{ $tugas->status ?? 'Unknown' }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        @if($tugas->jenis_paket)
                                            <span class="capitalize">{{ str_replace('_', ' ', $tugas->jenis_paket) }}</span>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <!-- View Button -->
                                        <a href="{{ route('terapis.jadwal-tugas.show', $tugas->id) }}" 
                                           class="inline-flex items-center px-3 py-1 bg-blue-100 hover:bg-blue-200 text-blue-700 text-xs font-medium rounded transition-colors"
                                           title="Lihat Detail">
                                            <i class="fas fa-eye mr-1"></i>
                                            Detail
                                        </a>
                                        
                                        <!-- Edit Button -->
                                        <a href="{{ route('terapis.jadwal-tugas.edit', $tugas->id) }}" 
                                           class="inline-flex items-center px-3 py-1 bg-yellow-100 hover:bg-yellow-200 text-yellow-700 text-xs font-medium rounded transition-colors"
                                           title="Edit Status & Catatan">
                                            <i class="fas fa-edit mr-1"></i>
                                            Edit
                                        </a>

                                        <!-- Download PDF Button -->
                                        <a href="{{ route('terapis.jadwal-tugas.pdf', $tugas->id) }}" 
                                           class="inline-flex items-center px-3 py-1 bg-red-100 hover:bg-red-200 text-red-700 text-xs font-medium rounded transition-colors"
                                           title="Download PDF"
                                           target="_blank">
                                            <i class="fas fa-file-pdf mr-1"></i>
                                            PDF
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="p-8 text-center">
                <i class="fas fa-calendar-times text-gray-400 text-4xl mb-4"></i>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada jadwal tugas</h3>
                <p class="text-gray-500">
                    @if(request()->hasAny(['search', 'tanggal', 'status']))
                        Tidak ada jadwal yang cocok dengan filter yang dipilih.
                    @else
                        Belum ada jadwal tugas yang tersedia untuk Anda.
                    @endif
                </p>
                @if(request()->hasAny(['search', 'tanggal', 'status']))
                    <a href="{{ route('terapis.jadwal-tugas.index') }}" 
                       class="inline-flex items-center px-4 py-2 mt-4 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                        <i class="fas fa-times mr-2"></i>
                        Hapus Filter
                    </a>
                @endif
            </div>
        @endif
    </div>
</div>
@endsection