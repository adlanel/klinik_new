@extends('layouts.terapis.app')

@section('title', 'History Terapi Pasien')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white rounded-lg shadow-sm border overflow-hidden">
        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-4 border-b border-gray-200">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div class="mb-4 sm:mb-0">
                    <h1 class="text-2xl font-bold text-gray-800 mb-2">History Terapi Pasien</h1>
                    <div class="flex flex-col sm:flex-row sm:items-center text-sm text-gray-600 space-y-1 sm:space-y-0 sm:space-x-4">
                        <div class="flex items-center">
                            <i class="fas fa-user mr-2 text-blue-500"></i>
                            <span class="font-medium">Pasien:</span>
                            <span class="ml-1 font-semibold">{{ $patient->nama_anak }}</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-id-card mr-2 text-green-500"></i>
                            <span class="font-medium">ID:</span>
                            <span class="ml-1 font-semibold">{{ $patient->id_pasien }}</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-building mr-2 text-purple-500"></i>
                            <span class="font-medium">Cabang:</span>
                            <span class="ml-1 font-semibold">{{ $patient->cabang->nama_cabang ?? '-' }}</span>
                        </div>
                    </div>
                </div>
                <div class="flex-shrink-0">
                    <a href="{{ route('terapis.patients.index') }}" 
                       class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition-colors duration-200 shadow-sm">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali
                    </a>
                </div>
            </div>
        </div>

        @if($histories->count() > 0)
            <!-- Summary Cards -->
            <div class="p-6 bg-gray-50 border-b border-gray-200">
                <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-6 gap-4">
                    <div class="bg-white border border-blue-200 rounded-lg p-4 shadow-sm">
                        <div class="text-center">
                            <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center mx-auto mb-3">
                                <i class="fas fa-calendar-check text-white"></i>
                            </div>
                            <p class="text-xs font-medium text-blue-600 mb-1">Total Sesi</p>
                            <p class="text-2xl font-bold text-blue-800">{{ $histories->total() }}</p>
                        </div>
                    </div>
                    
                    <div class="bg-white border border-green-200 rounded-lg p-4 shadow-sm">
                        <div class="text-center">
                            <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-3">
                                <i class="fas fa-clock text-white"></i>
                            </div>
                            <p class="text-xs font-medium text-green-600 mb-1">Sesi Terakhir</p>
                            <p class="text-sm font-bold text-green-800">
                                @if($histories->count() > 0)
                                    {{ \Carbon\Carbon::parse($histories->first()->tanggal_terapi)->format('d/m/Y') }}
                                @else
                                    -
                                @endif
                            </p>
                        </div>
                    </div>
                    
                    <div class="bg-white border border-purple-200 rounded-lg p-4 shadow-sm">
                        <div class="text-center">
                            <div class="w-12 h-12 bg-purple-500 rounded-full flex items-center justify-center mx-auto mb-3">
                                <i class="fas fa-user-md text-white"></i>
                            </div>
                            <p class="text-xs font-medium text-purple-600 mb-1">Status Pasien</p>
                            <p class="text-sm font-bold text-purple-800">{{ $patient->status_pasien }}</p>
                        </div>
                    </div>
                    
                    <div class="bg-white border border-orange-200 rounded-lg p-4 shadow-sm">
                        <div class="text-center">
                            <div class="w-12 h-12 bg-orange-500 rounded-full flex items-center justify-center mx-auto mb-3">
                                <i class="fas fa-check-circle text-white"></i>
                            </div>
                            <p class="text-xs font-medium text-orange-600 mb-1">Selesai</p>
                            <p class="text-2xl font-bold text-orange-800">
                                {{ $histories->filter(function($history) { 
                                    return $history->status == 'Sudah Dikerjakan'; 
                                })->count() }}
                            </p>
                        </div>
                    </div>
                    
                    <div class="bg-white border border-yellow-200 rounded-lg p-4 shadow-sm">
                        <div class="text-center">
                            <div class="w-12 h-12 bg-yellow-500 rounded-full flex items-center justify-center mx-auto mb-3">
                                <i class="fas fa-hourglass-half text-white"></i>
                            </div>
                            <p class="text-xs font-medium text-yellow-600 mb-1">Menunggu</p>
                            <p class="text-2xl font-bold text-yellow-800">
                                {{ $histories->filter(function($history) { 
                                    return $history->status == 'Belum Dikerjakan' || is_null($history->status); 
                                })->count() }}
                            </p>
                        </div>
                    </div>
                    
                    <div class="bg-white border border-red-200 rounded-lg p-4 shadow-sm">
                        <div class="text-center">
                            <div class="w-12 h-12 bg-red-500 rounded-full flex items-center justify-center mx-auto mb-3">
                                <i class="fas fa-times-circle text-white"></i>
                            </div>
                            <p class="text-xs font-medium text-red-600 mb-1">Dibatalkan</p>
                            <p class="text-2xl font-bold text-red-800">
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
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <div class="flex items-center">
                                    <i class="fas fa-hashtag mr-2 text-gray-400"></i>
                                    No
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <div class="flex items-center">
                                    <i class="fas fa-calendar mr-2 text-gray-400"></i>
                                    Tanggal & Waktu
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <div class="flex items-center">
                                    <i class="fas fa-stethoscope mr-2 text-gray-400"></i>
                                    Layanan
                                </div>
                            </th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <div class="flex items-center justify-center">
                                    <i class="fas fa-tag mr-2 text-gray-400"></i>
                                    Paket
                                </div>
                            </th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <div class="flex items-center justify-center">
                                    <i class="fas fa-money-bill-wave mr-2 text-gray-400"></i>
                                    Harga
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <div class="flex items-center">
                                    <i class="fas fa-building mr-2 text-gray-400"></i>
                                    Cabang
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <div class="flex items-center">
                                    <i class="fas fa-user-md mr-2 text-gray-400"></i>
                                    Terapis
                                </div>
                            </th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <div class="flex items-center justify-center">
                                    <i class="fas fa-info-circle mr-2 text-gray-400"></i>
                                    Status
                                </div>
                            </th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <div class="flex items-center justify-center">
                                    <i class="fas fa-cogs mr-2 text-gray-400"></i>
                                    Aksi
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($histories as $index => $history)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span class="text-sm font-medium text-gray-900 bg-gray-100 rounded-full w-8 h-8 flex items-center justify-center">
                                            {{ ($histories->currentPage() - 1) * $histories->perPage() + $index + 1 }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <div class="flex flex-col">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ \Carbon\Carbon::parse($history->tanggal_terapi)->format('d M Y') }}
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            {{ \Carbon\Carbon::parse($history->tanggal_terapi)->locale('id')->translatedFormat('l') }} • {{ $history->jam_sesi }}
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $history->layanan_name }}</div>
                                </td>
                                <td class="px-6 py-5 text-center">
                                    @if($history->jenis_paket)
                                        @switch($history->jenis_paket)
                                            @case('reguler_weekday')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                    <i class="fas fa-calendar-day mr-1"></i>
                                                    Reguler Weekday
                                                </span>
                                                @break
                                            @case('paket_weekday') 
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    <i class="fas fa-box mr-1"></i>
                                                    Paket Weekday
                                                </span>
                                                @break
                                            @case('reguler_weekend')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                                    <i class="fas fa-calendar-weekend mr-1"></i>
                                                    Reguler Weekend
                                                </span>
                                                @break
                                            @case('paket_weekend')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                                    <i class="fas fa-box mr-1"></i>
                                                    Paket Weekend
                                                </span>
                                                @break
                                            @default
                                                <span class="text-gray-400">-</span>
                                        @endswitch
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-5 text-center">
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
                                        <div class="text-sm font-semibold text-gray-900">
                                            Rp {{ number_format($harga, 0, ',', '.') }}
                                        </div>
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <i class="fas fa-building text-gray-400 mr-2"></i>
                                        <span class="text-sm text-gray-900">{{ $history->nama_cabang }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <i class="fas fa-user-md text-gray-400 mr-2"></i>
                                        <span class="text-sm text-gray-900">{{ $history->terapis_name ?? '-' }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-5 text-center">
                                    @if($history->status == 'Sudah Dikerjakan')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <i class="fas fa-check-circle mr-1"></i>
                                            Selesai
                                        </span>
                                    @elseif($history->status == 'Belum Dikerjakan')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            <i class="fas fa-clock mr-1"></i>
                                            Menunggu
                                        </span>
                                    @elseif($history->status == 'Cancelled')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            <i class="fas fa-times-circle mr-1"></i>
                                            Dibatalkan
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            <i class="fas fa-question-circle mr-1"></i>
                                            {{ $history->status ?? 'Menunggu' }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-5 text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        @if($history->notes || $history->saran_dirumah)
                                            <a href="{{ route('terapis.patients.history.detail', ['patient' => $patient->id_pasien, 'history' => $history->id]) }}" 
                                               class="inline-flex items-center px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-medium rounded-lg transition-colors duration-200 shadow-sm">
                                                <i class="fas fa-eye mr-1"></i>
                                                Detail
                                            </a>
                                            <button onclick="downloadPDF({{ $history->id }})" 
                                                    class="inline-flex items-center px-3 py-2 bg-red-600 hover:bg-red-700 text-white text-xs font-medium rounded-lg transition-colors duration-200 shadow-sm" 
                                                    title="Download PDF">
                                                <i class="fas fa-file-pdf mr-1"></i>
                                                PDF
                                            </button>
                                        @else
                                            <span class="text-gray-400 text-sm italic">Tidak ada data</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
            </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                {{ $histories->links() }}
            </div>
        @else
            <div class="p-12 text-center">
                <div class="w-24 h-24 mx-auto mb-6 bg-gray-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-history text-gray-400 text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Belum Ada History Terapi</h3>
                <p class="text-gray-500 max-w-md mx-auto">
                    Pasien ini belum memiliki riwayat terapi yang tercatat dalam sistem. 
                    History akan muncul setelah sesi terapi pertama dilakukan.
                </p>
            </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
function downloadPDF(historyId) {
    // Download PDF laporan terapi - sama seperti di halaman detail
    window.open('{{ url("terapis/patients/" . $patient->id_pasien . "/history/") }}/' + historyId + '/pdf', '_blank');
}
</script>
@endpush
@endsection