@extends('layouts.admin.app')

@section('title', 'Manajemen Cabang')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Kelola Cabang</h1>
            <p class="text-gray-600 mt-1">Tambah, edit, dan hapus data cabang klinik</p>
        </div>
        <div class="mt-4 md:mt-0">
            <a href="{{ route('admin.content.branches.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                <i class="fas fa-plus mr-2"></i>Tambah Cabang Baru
            </a>
        </div>
    </div>
    
    <!-- Flash message -->
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif
    
    @if(session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
            <p>{{ session('error') }}</p>
        </div>
    @endif
    
    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded-lg overflow-hidden">
            <thead class="bg-gray-100">
                <tr>
                    <th class="py-3 px-4 text-left">No</th>
                    <th class="py-3 px-4 text-left">Nama Cabang</th>
                    <th class="py-3 px-4 text-left">Alamat</th>
                    <th class="py-3 px-4 text-left">No. Telepon</th>
                    <th class="py-3 px-4 text-left">Maps</th>
                    <th class="py-3 px-4 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($branches as $index => $branch)
                    <tr class="hover:bg-gray-50">
                        <td class="py-3 px-4">{{ $branches->firstItem() + $index }}</td>
                        <td class="py-3 px-4 font-medium">{{ $branch->nama_cabang }}</td>
                        <td class="py-3 px-4">
                            <div class="max-w-xs truncate">{{ $branch->alamat }}</div>
                        </td>
                        <td class="py-3 px-4">{{ $branch->no_telp ?? '-' }}</td>
                        <td class="py-3 px-4">
                            @if($branch->link_maps)
                                <a href="{{ $branch->link_maps }}" target="_blank" class="text-blue-600 hover:text-blue-800 inline-flex items-center">
                                    <i class="fas fa-map-marker-alt mr-1"></i> Lihat Maps
                                </a>
                            @else
                                <span class="text-gray-500">Tidak tersedia</span>
                            @endif
                        </td>
                        <td class="py-3 px-4">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.content.branches.edit', $branch->id) }}" class="text-blue-600 hover:text-blue-900" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.content.branches.destroy', $branch->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus cabang ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" title="Hapus">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-6 text-center text-gray-500">
                            <div class="flex flex-col items-center justify-center">
                                <i class="fas fa-map-marked-alt text-4xl mb-3 text-gray-400"></i>
                                <p class="text-lg">Belum ada data cabang</p>
                                <p class="text-sm mt-1">Klik tombol "Tambah Cabang Baru" untuk menambahkan cabang</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $branches->links() }}
    </div>
</div>
@endsection