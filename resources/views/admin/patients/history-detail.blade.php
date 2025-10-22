@extends('layouts.admin.app')

@section('title', 'Detail Informasi Kegiatan Terapi')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Detail Informasi Kegiatan Terapi</h1>
            <p class="text-gray-600 mt-1">Pasien: {{ $patient->nama_anak }} | Tanggal: {{ \Carbon\Carbon::parse($historyDetail->tanggal_terapi)->format('d M Y') }}</p>
        </div>
        <div class="flex space-x-2">
            <button onclick="downloadPDF()" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                <i class="fas fa-file-pdf mr-2"></i>Download PDF
            </button>
            <a href="{{ route('admin.patients.history', $patient->id_pasien) }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>
    </div>

    <!-- Session Information -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <div class="lg:col-span-2">
            <div class="bg-gray-50 p-4 rounded-lg h-full">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Sesi Terapi</h3>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    <div>
                        <p class="text-sm text-gray-500">Tanggal</p>
                        <p class="font-medium">{{ \Carbon\Carbon::parse($historyDetail->tanggal_terapi)->format('d M Y') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Hari</p>
                        <p class="font-medium">{{ \Carbon\Carbon::parse($historyDetail->tanggal_terapi)->locale('id')->translatedFormat('l') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Jam Sesi</p>
                        <p class="font-medium">{{ $historyDetail->jam_sesi }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Layanan</p>
                        <p class="font-medium">{{ $historyDetail->layanan_name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Cabang</p>
                        <p class="font-medium">{{ $historyDetail->nama_cabang }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Terapis</p>
                        <p class="font-medium">{{ $historyDetail->terapis_name ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div>
            <div class="bg-gray-50 p-4 rounded-lg h-full flex flex-col justify-center">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 text-center">Status</h3>
                <div class="flex justify-center items-center flex-1">
                    @if($historyDetail->status == 'Sudah Dikerjakan')
                        <span class="inline-flex items-center px-4 py-2 text-sm font-semibold rounded-full bg-green-100 text-green-800">
                            <i class="fas fa-check-circle mr-2"></i>Sudah Dikerjakan
                        </span>
                    @elseif($historyDetail->status == 'Belum Dikerjakan')
                        <span class="inline-flex items-center px-4 py-2 text-sm font-semibold rounded-full bg-yellow-100 text-yellow-800">
                            <i class="fas fa-clock mr-2"></i>Belum Dikerjakan
                        </span>
                    @elseif($historyDetail->status == 'Cancelled')
                        <span class="inline-flex items-center px-4 py-2 text-sm font-semibold rounded-full bg-red-100 text-red-800">
                            <i class="fas fa-times-circle mr-2"></i>Cancelled
                        </span>
                    @else
                        <span class="inline-flex items-center px-4 py-2 text-sm font-semibold rounded-full bg-gray-100 text-gray-800">
                            {{ $historyDetail->status ?? 'Belum Dikerjakan' }}
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Notes and Suggestions -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Notes Terapi -->
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
            <div class="flex items-center mb-4">
                <div class="p-2 bg-blue-500 rounded-full mr-3">
                    <i class="fas fa-file-alt text-white"></i>
                </div>
                <h3 class="text-lg font-semibold text-blue-800">Notes Terapi</h3>
            </div>
            <div class="bg-white p-4 rounded border border-blue-200 min-h-[200px]">
                @if($historyDetail->notes)
                    <p class="text-gray-800 whitespace-pre-wrap">{{ $historyDetail->notes }}</p>
                @else
                    <p class="text-gray-400 italic">Tidak ada catatan terapi yang tercatat.</p>
                @endif
            </div>
        </div>

        <!-- Saran di Rumah -->
        <div class="bg-green-50 border border-green-200 rounded-lg p-6">
            <div class="flex items-center mb-4">
                <div class="p-2 bg-green-500 rounded-full mr-3">
                    <i class="fas fa-home text-white"></i>
                </div>
                <h3 class="text-lg font-semibold text-green-800">Saran di Rumah</h3>
            </div>
            <div class="bg-white p-4 rounded border border-green-200 min-h-[200px]">
                @if($historyDetail->saran_dirumah)
                    <p class="text-gray-800 whitespace-pre-wrap">{{ $historyDetail->saran_dirumah }}</p>
                @else
                    <p class="text-gray-400 italic">Tidak ada saran di rumah yang tercatat.</p>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
function downloadPDF() {
    // Download PDF laporan terapi
    window.open('{{ route("admin.patients.history.pdf", [$patient->id_pasien, $historyDetail->id]) }}', '_blank');
}
</script>
@endsection