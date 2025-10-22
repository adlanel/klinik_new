@extends('layouts.terapis.app')

@section('title', 'Edit Jadwal Tugas - Terapis')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Edit Jadwal Tugas</h1>
            <p class="text-gray-600 mt-1">Update status dan catatan terapi</p>
        </div>
        <a href="{{ route('terapis.jadwal-tugas.show', $jadwalTugas->id) }}" 
           class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 transition-colors">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali
        </a>
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

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Informasi Jadwal (Read Only) -->
        <div class="bg-white rounded-lg shadow-sm border p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-info-circle text-blue-600 mr-2"></i>
                Informasi Jadwal
            </h2>
            
            <div class="space-y-4">
                <div class="flex justify-between py-2 border-b border-gray-100">
                    <span class="font-medium text-gray-600">Pasien:</span>
                    <span class="text-gray-800 font-medium">{{ $jadwalTugas->nama_pasien }}</span>
                </div>
                
                <div class="flex justify-between py-2 border-b border-gray-100">
                    <span class="font-medium text-gray-600">Tanggal:</span>
                    <span class="text-gray-800">{{ \Carbon\Carbon::parse($jadwalTugas->tanggal_terapi)->format('d/m/Y') }}</span>
                </div>
                
                <div class="flex justify-between py-2 border-b border-gray-100">
                    <span class="font-medium text-gray-600">Jam:</span>
                    <span class="text-gray-800">{{ $jadwalTugas->jam_sesi }}</span>
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

        <!-- Form Edit -->
        <div class="bg-white rounded-lg shadow-sm border p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-edit text-yellow-600 mr-2"></i>
                Edit Status & Catatan
            </h2>
            
            <form action="{{ route('terapis.jadwal-tugas.update', $jadwalTugas->id) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                
                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <select id="status" name="status" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('status') border-red-500 @enderror">
                        <option value="">Pilih Status</option>
                        <option value="Belum Dikerjakan" {{ $jadwalTugas->status == 'Belum Dikerjakan' ? 'selected' : '' }}>
                            Belum Dikerjakan
                        </option>
                        <option value="Sudah Dikerjakan" {{ $jadwalTugas->status == 'Sudah Dikerjakan' ? 'selected' : '' }}>
                            Sudah Dikerjakan
                        </option>
                        <option value="Cancelled" {{ $jadwalTugas->status == 'Cancelled' ? 'selected' : '' }}>
                            Cancelled
                        </option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Notes -->
                <div>
                    <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                        Notes Terapi
                    </label>
                    <textarea id="notes" name="notes" rows="4" placeholder="Catatan hasil terapi, progress pasien, dll..."
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('notes') border-red-500 @enderror">{{ old('notes', $jadwalTugas->notes) }}</textarea>
                    @error('notes')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Saran di Rumah -->
                <div>
                    <label for="saran_dirumah" class="block text-sm font-medium text-gray-700 mb-2">
                        Saran di Rumah
                    </label>
                    <textarea id="saran_dirumah" name="saran_dirumah" rows="4" placeholder="Saran latihan atau kegiatan yang bisa dilakukan di rumah..."
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('saran_dirumah') border-red-500 @enderror">{{ old('saran_dirumah', $jadwalTugas->saran_dirumah) }}</textarea>
                    @error('saran_dirumah')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex justify-end space-x-3 pt-4">
                    <a href="{{ route('terapis.jadwal-tugas.show', $jadwalTugas->id) }}" 
                       class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition-colors">
                        Batal
                    </a>
                    <button type="submit" 
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                        <i class="fas fa-save mr-2"></i>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection