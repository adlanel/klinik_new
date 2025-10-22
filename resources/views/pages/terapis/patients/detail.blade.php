<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <!-- Patient Information -->
    <div class="bg-gray-50 p-4 rounded">
        <h4 class="font-semibold text-gray-800 mb-3">Informasi Pasien</h4>
        <div class="space-y-2">
            <div>
                <span class="text-gray-600 text-sm">ID Pasien:</span>
                <span class="text-gray-900 font-medium">{{ $patient->id_pasien }}</span>
            </div>
            <div>
                <span class="text-gray-600 text-sm">Nama Anak:</span>
                <span class="text-gray-900 font-medium">{{ $patient->nama_anak }}</span>
            </div>
            <div>
                <span class="text-gray-600 text-sm">Jenis Kelamin:</span>
                <span class="text-gray-900">{{ $patient->jenis_kelamin }}</span>
            </div>
            <div>
                <span class="text-gray-600 text-sm">Tempat Lahir:</span>
                <span class="text-gray-900">{{ $patient->tempat_lahir ?? '-' }}</span>
            </div>
            <div>
                <span class="text-gray-600 text-sm">Tanggal Lahir:</span>
                <span class="text-gray-900">
                    @if($patient->tanggal_lahir)
                        {{ \Carbon\Carbon::parse($patient->tanggal_lahir)->format('d M Y') }}
                        ({{ \Carbon\Carbon::parse($patient->tanggal_lahir)->age }} tahun)
                    @else
                        -
                    @endif
                </span>
            </div>
        </div>
    </div>

    <!-- Parent Information -->
    <div class="bg-gray-50 p-4 rounded">
        <h4 class="font-semibold text-gray-800 mb-3">Informasi Orang Tua</h4>
        <div class="space-y-2">
            <div>
                <span class="text-gray-600 text-sm">Nama Orang Tua:</span>
                <span class="text-gray-900">{{ $patient->nama_orang_tua ?? '-' }}</span>
            </div>
            <div>
                <span class="text-gray-600 text-sm">Telepon:</span>
                <span class="text-gray-900">{{ $patient->telepon ?? '-' }}</span>
            </div>
        </div>
    </div>

    <!-- Branch Information -->
    <div class="bg-gray-50 p-4 rounded">
        <h4 class="font-semibold text-gray-800 mb-3">Informasi Cabang</h4>
        <div class="space-y-2">
            <div>
                <span class="text-gray-600 text-sm">Cabang:</span>
                <span class="text-gray-900">{{ $patient->cabang->nama_cabang ?? '-' }}</span>
            </div>
            <div>
                <span class="text-gray-600 text-sm">Status:</span>
                @if($patient->status_pasien == 'Aktif')
                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                        Aktif
                    </span>
                @else
                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                        Tidak Aktif
                    </span>
                @endif
            </div>
        </div>
    </div>

    <!-- Address & Complaint -->
    <div class="bg-gray-50 p-4 rounded">
        <h4 class="font-semibold text-gray-800 mb-3">Informasi Tambahan</h4>
        <div class="space-y-3">
            <div>
                <span class="text-gray-600 text-sm block mb-1">Alamat:</span>
                <p class="text-gray-900 text-sm">{{ $patient->alamat ?? '-' }}</p>
            </div>
            <div>
                <span class="text-gray-600 text-sm block mb-1">Keluhan Awal:</span>
                <p class="text-gray-900 text-sm">{{ $patient->keluhan_awal ?? '-' }}</p>
            </div>
        </div>
    </div>
</div>

<div class="mt-4 flex justify-end space-x-2">
    <a href="{{ route('terapis.patients.edit', $patient->id_pasien) }}" 
       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm">
        Edit Data
    </a>
    <button onclick="closePatientDetail()" 
            class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded text-sm">
        Tutup
    </button>
</div>