@extends('layouts.admin.app')

@section('title', 'History Terapi Pasien')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">History Terapi Pasien</h1>
            <div class="mt-2">
                <p class="text-gray-600">
                    <span class="font-medium">Pasien:</span> {{ $patient->nama_anak }}
                    <span class="mx-2">|</span>
                    <span class="font-medium">ID:</span> {{ $patient->id_pasien }}
                    <span class="mx-2">|</span>
                    <span class="font-medium">Cabang Daftar:</span> {{ $patient->cabang->nama_cabang ?? '-' }}
                </p>
            </div>
        </div>
        <div>
            <a href="{{ route('admin.patients.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>
    </div>

    @if($histories->count() > 0)
        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-6">
            <div class="bg-blue-50 p-4 rounded-lg">
                <div class="flex items-center">
                    <div class="p-2 bg-blue-500 rounded-full">
                        <i class="fas fa-calendar-check text-white"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-blue-600">Total Sesi</p>
                        <p class="text-xl font-bold text-blue-800">{{ $histories->total() }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-green-50 p-4 rounded-lg">
                <div class="flex items-center">
                    <div class="p-2 bg-green-500 rounded-full">
                        <i class="fas fa-clock text-white"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-600">Sesi Terakhir</p>
                        <p class="text-sm font-bold text-green-800">
                            @if($histories->count() > 0)
                                {{ \Carbon\Carbon::parse($histories->first()->tanggal_terapi)->format('d M Y') }}
                            @else
                                -
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="bg-purple-50 p-4 rounded-lg">
                <div class="flex items-center">
                    <div class="p-2 bg-purple-500 rounded-full">
                        <i class="fas fa-user-md text-white"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-purple-600">Status Pasien</p>
                        <p class="text-sm font-bold text-purple-800">{{ $patient->status_pasien }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-orange-50 p-4 rounded-lg">
                <div class="flex items-center">
                    <div class="p-2 bg-orange-500 rounded-full">
                        <i class="fas fa-check-circle text-white"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-orange-600">Sudah Dikerjakan</p>
                        <p class="text-xl font-bold text-orange-800">
                            {{ $histories->filter(function($history) { 
                                return $history->status == 'Sudah Dikerjakan'; 
                            })->count() }}
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="bg-yellow-50 p-4 rounded-lg">
                <div class="flex items-center">
                    <div class="p-2 bg-yellow-500 rounded-full">
                        <i class="fas fa-clock text-white"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-yellow-600">Belum Dikerjakan</p>
                        <p class="text-xl font-bold text-yellow-800">
                            {{ $histories->filter(function($history) { 
                                return $history->status == 'Belum Dikerjakan' || is_null($history->status); 
                            })->count() }}
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="bg-red-50 p-4 rounded-lg">
                <div class="flex items-center">
                    <div class="p-2 bg-red-500 rounded-full">
                        <i class="fas fa-times-circle text-white"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-red-600">Cancelled</p>
                        <p class="text-xl font-bold text-red-800">
                            {{ $histories->filter(function($history) { 
                                return $history->status == 'Cancelled'; 
                            })->count() }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- History Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hari</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jam Sesi</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Layanan</th>
                        <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Paket</th>
                        <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cabang</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Terapis</th>
                        <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Informasi Kegiatan</th>
                        <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Download PDF</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($histories as $index => $history)
                        <tr>
                            <td class="px-4 py-3 text-sm text-gray-900">
                                {{ ($histories->currentPage() - 1) * $histories->perPage() + $index + 1 }}
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-900">
                                {{ \Carbon\Carbon::parse($history->tanggal_terapi)->format('d M Y') }}
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-900">
                                {{ \Carbon\Carbon::parse($history->tanggal_terapi)->locale('id')->translatedFormat('l') }}
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-900">
                                {{ $history->jam_sesi }}
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-900">
                                {{ $history->layanan_name }}
                            </td>
                            <td class="px-4 py-3 text-center">
                                @if($history->jenis_paket)
                                    @switch($history->jenis_paket)
                                        @case('reguler_weekday')
                                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs">Reguler Weekday</span>
                                            @break
                                        @case('paket_weekday') 
                                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">Paket Weekday</span>
                                            @break
                                        @case('reguler_weekend')
                                            <span class="bg-orange-100 text-orange-800 px-2 py-1 rounded-full text-xs">Reguler Weekend</span>
                                            @break
                                        @case('paket_weekend')
                                            <span class="bg-purple-100 text-purple-800 px-2 py-1 rounded-full text-xs">Paket Weekend</span>
                                            @break
                                        @default
                                            <span class="text-gray-400">-</span>
                                    @endswitch
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-center">
                                @if($history->jenis_paket)
                                    @php
                                        $harga = 0;
                                        switch($history->jenis_paket) {
                                            case 'reguler_weekday':
                                                $harga = $history->harga_reguler_weekday ?? 0;
                                                break;
                                            case 'paket_weekday':
                                                $harga = $history->harga_paket_weekday ?? 0;
                                                break;
                                            case 'reguler_weekend':
                                                $harga = $history->harga_reguler_weekend ?? 0;
                                                break;
                                            case 'paket_weekend':
                                                $harga = $history->harga_paket_weekend ?? 0;
                                                break;
                                        }
                                    @endphp
                                    <div class="text-sm text-gray-900">Rp {{ number_format($harga, 0, ',', '.') }}</div>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-900">
                                {{ $history->nama_cabang }}
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-900">
                                {{ $history->terapis_name ?? '-' }}
                            </td>
                            <td class="px-4 py-3 text-center">
                                @if($history->status == 'Sudah Dikerjakan')
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                        Sudah Dikerjakan
                                    </span>
                                @elseif($history->status == 'Belum Dikerjakan')
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Belum Dikerjakan
                                    </span>
                                @elseif($history->status == 'Cancelled')
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                        Cancelled
                                    </span>
                                @else
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                        {{ $history->status ?? 'Belum Dikerjakan' }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-center">
                                @if($history->notes || $history->saran_dirumah)
                                    <a href="{{ route('admin.patients.history.detail', ['patient' => $patient->id_pasien, 'history' => $history->id]) }}" 
                                       class="inline-flex items-center px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-medium rounded-md transition duration-150 ease-in-out">
                                        <i class="fas fa-eye mr-2"></i>
                                        Detail
                                    </a>
                                @else
                                    <span class="text-gray-400 text-sm">Tidak ada informasi</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-center">
                                @if($history->notes || $history->saran_dirumah)
                                    <button onclick="downloadPDF({{ $history->id }})" 
                                            class="text-red-600 hover:text-red-900 p-2 rounded-full hover:bg-red-50" 
                                            title="Download PDF">
                                        <i class="fas fa-file-pdf text-lg"></i>
                                    </button>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $histories->links() }}
        </div>
    @else
        <div class="text-center py-12">
            <div class="text-gray-400 text-6xl mb-4">
                <i class="fas fa-history"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada History Terapi</h3>
            <p class="text-gray-500">Pasien ini belum memiliki riwayat terapi yang tercatat.</p>
        </div>
    @endif
</div>

<script>
function downloadPDF(historyId) {
    // Download PDF laporan terapi - sama seperti di halaman detail
    window.open('{{ url("admin/patients/" . $patient->id_pasien . "/history/") }}/' + historyId + '/pdf', '_blank');
}
</script>
@endsection