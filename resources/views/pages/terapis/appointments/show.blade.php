@extends('layouts.terapis.app')

@section('title', 'Appointment Details')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Appointment Details</h1>
        <div class="flex text-sm text-gray-600 mt-2">
            <a href="{{ route('terapis.dashboard') }}" class="hover:text-blue-500">Dashboard</a>
            <span class="mx-2">/</span>
            <a href="{{ route('terapis.appointments.index') }}" class="hover:text-blue-500">Appointments</a>
            <span class="mx-2">/</span>
            <span>Detail</span>
        </div>
    </div>
    
    <div class="mb-6">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-blue-600 text-white px-4 py-3 flex justify-between items-center">
                <div class="flex items-center">
                    <i class="fas fa-calendar-check mr-2"></i>
                    <span>Appointment Details</span>
                </div>
                <div>
                    <span class="px-3 py-1 rounded-full text-sm font-semibold
                        {{ $appointment->status == 'pending' ? 'bg-yellow-200 text-yellow-800' : 
                          ($appointment->status == 'approved' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800') }}">
                        {{ ucfirst($appointment->status) }}
                    </span>
                </div>
            </div>
            <div class="p-6">
                @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                    <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none'">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                @endif
                
                @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                    <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none'">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                @endif
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <h5 class="text-lg font-medium text-gray-700 border-b pb-2 mb-4">Patient Information</h5>
                        <div class="mb-4 grid grid-cols-3">
                            <div class="font-medium text-gray-700">Patient Name:</div>
                            <div class="col-span-2">{{ $appointment->patient_name }}</div>
                        </div>
                        <div class="mb-4 grid grid-cols-3">
                            <div class="font-medium text-gray-700">Parent/Guardian:</div>
                            <div class="col-span-2">{{ $appointment->nama_orang_tua }}</div>
                        </div>
                        <div class="mb-4 grid grid-cols-3">
                            <div class="font-medium text-gray-700">Gender:</div>
                            <div class="col-span-2">{{ $appointment->jenis_kelamin }}</div>
                        </div>
                        <div class="mb-4 grid grid-cols-3">
                            <div class="font-medium text-gray-700">Birth Place & Date:</div>
                            <div class="col-span-2">
                                {{ $appointment->tempat_lahir }}, {{ $appointment->formatDate($appointment->tanggal_lahir) }}
                            </div>
                        </div>
                        <div class="mb-4 grid grid-cols-3">
                            <div class="font-medium text-gray-700">Contact:</div>
                            <div class="col-span-2">
                                <div>Email: {{ $appointment->email }}</div>
                                <div>Phone: {{ $appointment->phone }}</div>
                            </div>
                        </div>
                        <div class="mb-4 grid grid-cols-3">
                            <div class="font-medium text-gray-700">Address:</div>
                            <div class="col-span-2">{{ $appointment->alamat }}</div>
                        </div>
                    </div>
                    
                    <div>
                        <h5 class="text-lg font-medium text-gray-700 border-b pb-2 mb-4">Appointment Details</h5>
                        <div class="mb-4 grid grid-cols-3">
                            <div class="font-medium text-gray-700">Appointment Date:</div>
                            <div class="col-span-2">{{ $appointment->formatDate($appointment->meeting_date) }}</div>
                        </div>
                        <div class="mb-4 grid grid-cols-3">
                            <div class="font-medium text-gray-700">Branch:</div>
                            <div class="col-span-2">{{ $appointment->branch->nama_cabang }}</div>
                        </div>
                        <div class="mb-4 grid grid-cols-3">
                            <div class="font-medium text-gray-700">Status:</div>
                            <div class="col-span-2">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $appointment->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                                      ($appointment->status == 'approved' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') }}">
                                    {{ ucfirst($appointment->status) }}
                                </span>
                            </div>
                        </div>
                        <div class="mb-4 grid grid-cols-3">
                            <div class="font-medium text-gray-700">Created At:</div>
                            <div class="col-span-2">{{ $appointment->created_at->format('d M Y, H:i') }}</div>
                        </div>
                        <div class="mb-4 grid grid-cols-3">
                            <div class="font-medium text-gray-700">Updated At:</div>
                            <div class="col-span-2">{{ $appointment->updated_at->format('d M Y, H:i') }}</div>
                        </div>
                    </div>
                </div>
                
                <div class="mb-6">
                    <h5 class="text-lg font-medium text-gray-700 border-b pb-2 mb-4">Complaint</h5>
                    <p class="text-gray-900">{{ $appointment->complaint }}</p>
                </div>
                
                <!-- Status Update Form -->
                <div class="p-4 bg-gray-50 rounded-lg border">
                    <h5 class="text-lg font-medium text-gray-700 mb-4">Update Appointment Status</h5>
                    
                    <form action="{{ route('terapis.appointments.update-status', $appointment->id) }}" method="POST" class="flex items-end space-x-4">
                        @csrf
                        <div class="flex-1">
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                            <select id="status" name="status" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                <option value="pending" {{ $appointment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="approved" {{ $appointment->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="rejected" {{ $appointment->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </div>
                        <div>
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded">
                                Update Status
                            </button>
                        </div>
                    </form>
                </div>
                
                <div class="flex justify-between mt-6">
                    <a href="{{ route('terapis.appointments.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded">
                        <i class="fas fa-arrow-left mr-2"></i> Back to List
                    </a>
                    <a href="{{ route('terapis.appointments.edit', $appointment->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded">
                        <i class="fas fa-edit mr-2"></i> Edit Appointment
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection