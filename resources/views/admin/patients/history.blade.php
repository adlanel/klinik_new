<div class="mb-4">
    <h4 class="font-semibold text-gray-800">History Terapi - {{ $patient->nama_anak }}</h4>
    <p class="text-sm text-gray-600">ID Pasien: {{ $patient->id_pasien }}</p>
</div>

@if($histories->count() > 0)
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jam Sesi</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Layanan</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Cabang</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Terapis</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Notes</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($histories as $history)
                    <tr>
                        <td class="px-4 py-3 text-sm text-gray-900">
                            {{ \Carbon\Carbon::parse($history->tanggal_terapi)->format('d M Y') }}
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-900">
                            {{ $history->jam_sesi }}
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-900">
                            {{ $history->layanan_name }}
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-900">
                            {{ $history->nama_cabang }}
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-900">
                            {{ $history->terapis_name ?? '-' }}
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-900">
                            {{ $history->notes ?? '-' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if($histories->count() > 0)
        <div class="mt-4 p-4 bg-blue-50 rounded">
            <h5 class="font-semibold text-blue-800 mb-2">Ringkasan Terapi</h5>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                <div>
                    <span class="text-blue-600">Total Sesi:</span>
                    <span class="font-medium">{{ $histories->count() }}</span>
                </div>
                <div>
                    <span class="text-blue-600">Sesi Terakhir:</span>
                    <span class="font-medium">{{ \Carbon\Carbon::parse($histories->first()->tanggal_terapi)->format('d M Y') }}</span>
                </div>
                <div>
                    <span class="text-blue-600">Layanan Terbanyak:</span>
                    <span class="font-medium">{{ $histories->groupBy('layanan_name')->sortByDesc(function($item) { return $item->count(); })->keys()->first() ?? '-' }}</span>
                </div>
                <div>
                    <span class="text-blue-600">Status:</span>
                    <span class="font-medium">{{ $patient->status_pasien }}</span>
                </div>
            </div>
        </div>
    @endif
@else
    <div class="text-center py-8">
        <div class="text-gray-400 text-6xl mb-4">
            <i class="fas fa-history"></i>
        </div>
        <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada History Terapi</h3>
        <p class="text-gray-500">Pasien ini belum memiliki riwayat terapi yang tercatat.</p>
    </div>
@endif

<div class="mt-6 flex justify-end">
    <button onclick="closePatientHistory()" 
            class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded text-sm">
        Tutup
    </button>
</div>