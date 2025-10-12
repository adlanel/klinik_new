@extends('layouts.terapis.app')

@section('title', 'Appointments')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Data Appointment</h1>
            <p class="text-gray-600 mt-1">Kelola janji temu pasien klinik</p>
        </div>
        <div class="mt-4 md:mt-0">
            <a href="{{ route('terapis.appointments.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                <i class="fas fa-plus mr-2"></i>Tambah Appointment
            </a>
        </div>
    </div>
    
    @if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
        <p>{{ session('success') }}</p>
    </div>
    @endif
    
    <!-- Search and Filter -->
    <div class="bg-gray-50 p-4 rounded-lg border mb-6">
        <form action="{{ route('terapis.appointments.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Cari Appointment</label>
                <input type="text" name="search" id="search" placeholder="Nama/Telepon" 
                    value="{{ request('search') }}" 
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
            </div>
            
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" id="status" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
            </div>
            
            <div>
                <label for="meeting_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Janji</label>
                <input type="date" name="meeting_date" id="meeting_date" value="{{ request('meeting_date') }}" 
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
            </div>
            
            <div>
                <label for="cabang_id" class="block text-sm font-medium text-gray-700 mb-1">Cabang</label>
                <select name="cabang_id" id="cabang_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    <option value="">Semua Cabang</option>
                    @foreach(App\Models\Cabang::getAllBranches() as $branch)
                        <option value="{{ $branch->id }}" {{ request('cabang_id') == $branch->id ? 'selected' : '' }}>{{ $branch->nama_cabang }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="flex items-end">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">
                    <i class="fas fa-search mr-2"></i>Filter
                </button>
                <a href="{{ route('terapis.appointments.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded ml-2">
                    Reset
                </a>
            </div>
        </form>
    </div>
    
    <!-- Appointments Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Patient Name</th>
                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone</th>
                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Meeting Date</th>
                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($appointments ?? [] as $key => $appointment)
                <tr>
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">{{ $loop->iteration }}</td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">{{ $appointment->patient_name }}</td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">{{ $appointment->phone }}</td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">{{ $appointment->formatted_date ?? \Carbon\Carbon::parse($appointment->meeting_date)->format('d M Y') }}</td>
                    <td class="px-4 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            {{ $appointment->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                              ($appointment->status == 'approved' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') }}">
                            {{ ucfirst($appointment->status) }}
                        </span>
                    </td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                        <div class="flex justify-center space-x-2">
                            <a href="{{ route('terapis.appointments.show', $appointment->id) }}" class="text-blue-600 hover:text-blue-900" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('terapis.appointments.edit', $appointment->id) }}" class="text-green-600 hover:text-green-900" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button type="button" class="text-red-600 hover:text-red-900" 
                                onclick="deleteAppointment('{{ $appointment->id }}')" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                            <form id="delete-form-{{ $appointment->id }}" action="{{ route('terapis.appointments.destroy', $appointment->id) }}" method="POST" class="hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-4 py-4 text-center text-gray-500">No appointments found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if(isset($appointments) && $appointments->hasPages())
    <div class="mt-4">
        {{ $appointments->links() }}
    </div>
    @endif
</div>

@push('scripts')
<script>
    function deleteAppointment(id) {
        if (confirm('Apakah Anda yakin ingin menghapus appointment ini?')) {
            document.getElementById('delete-form-' + id).submit();
        }
    }
</script>
@endpush
@endsection