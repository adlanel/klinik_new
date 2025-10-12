@extends('layouts.admin.app')

@section('title', 'Appointment Details')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Appointment Details</h1>
        <div class="flex text-sm text-gray-600 mt-2">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-blue-500">Dashboard</a>
            <span class="mx-2">/</span>
            <a href="{{ route('admin.appointments.index') }}" class="hover:text-blue-500">Appointments</a>
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
                        </div>
                        
                        <div>
                            <h5 class="text-lg font-medium text-gray-700 border-b pb-2 mb-4">Contact Information</h5>
                            <div class="mb-4 grid grid-cols-3">
                                <div class="font-medium text-gray-700">Email:</div>
                                <div class="col-span-2">{{ $appointment->email }}</div>
                            </div>
                            <div class="mb-4 grid grid-cols-3">
                                <div class="font-medium text-gray-700">Phone:</div>
                                <div class="col-span-2">{{ $appointment->phone }}</div>
                            </div>
                            <div class="mb-4 grid grid-cols-3">
                                <div class="font-medium text-gray-700">Address:</div>
                                <div class="col-span-2">{{ $appointment->alamat }}</div>
                            </div>
                            <div class="mb-4 grid grid-cols-3">
                                <div class="font-medium text-gray-700">Branch:</div>
                                <div class="col-span-2">
                                    @if($appointment->cabang_id && $appointment->cabang)
                                        {{ $appointment->cabang->nama_cabang }}
                                    @else
                                        Not specified
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-6">
                        <h5 class="text-lg font-medium text-gray-700 border-b pb-2 mb-4">Appointment Details</h5>
                        <div class="mb-4 grid grid-cols-1 md:grid-cols-6">
                            <div class="font-medium text-gray-700 md:col-span-1">Meeting Date:</div>
                            <div class="md:col-span-5">{{ $appointment->formatDate($appointment->meeting_date) }}</div>
                        </div>
                        <div class="mb-4 grid grid-cols-1 md:grid-cols-6">
                            <div class="font-medium text-gray-700 md:col-span-1">Complaint/Request:</div>
                            <div class="md:col-span-5">
                                <div class="bg-gray-50 border border-gray-200 rounded-md p-4">
                                    {{ $appointment->complaint }}
                                </div>
                            </div>
                        </div>
                        <div class="mb-4 grid grid-cols-1 md:grid-cols-6">
                            <div class="font-medium text-gray-700 md:col-span-1">Created At:</div>
                            <div class="md:col-span-5">{{ $appointment->created_at->format('d M Y, H:i:s') }}</div>
                        </div>
                        <div class="mb-4 grid grid-cols-1 md:grid-cols-6">
                            <div class="font-medium text-gray-700 md:col-span-1">Last Updated:</div>
                            <div class="md:col-span-5">{{ $appointment->updated_at->format('d M Y, H:i:s') }}</div>
                        </div>
                    </div>
                    
                    <div class="flex justify-between">
                        <div>
                            <a href="{{ route('admin.appointments.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white py-2 px-4 rounded-md flex items-center">
                                <i class="fas fa-arrow-left mr-2"></i> Back to List
                            </a>
                        </div>
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.appointments.edit', $appointment->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white py-2 px-4 rounded-md flex items-center">
                                <i class="fas fa-edit mr-2"></i> Edit
                            </a>
                            
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-md flex items-center">
                                    <i class="fas fa-tasks mr-2"></i> Change Status
                                    <i class="fas fa-chevron-down ml-2"></i>
                                </button>
                                <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-50" 
                                    style="display: none;"
                                    :class="{'!bottom-full !top-auto !mt-0 !mb-1': $el.getBoundingClientRect().bottom + 150 > window.innerHeight}">
                                    <form action="{{ route('admin.appointments.update-status', $appointment->id) }}" method="POST" class="update-status-form">
                                        @csrf
                                        <input type="hidden" name="status" value="approved">
                                        <button type="submit" class="block px-4 py-2 text-sm text-green-700 hover:bg-green-100 w-full text-left cursor-pointer">
                                            <i class="fas fa-check mr-2"></i> Approve
                                        </button>
                                    </form>
                                    
                                    <form action="{{ route('admin.appointments.update-status', $appointment->id) }}" method="POST" class="update-status-form">
                                        @csrf
                                        <input type="hidden" name="status" value="rejected">
                                        <button type="submit" class="block px-4 py-2 text-sm text-red-700 hover:bg-red-100 w-full text-left cursor-pointer">
                                            <i class="fas fa-times mr-2"></i> Reject
                                        </button>
                                    </form>
                                    
                                    <form action="{{ route('admin.appointments.update-status', $appointment->id) }}" method="POST" class="update-status-form">
                                        @csrf
                                        <input type="hidden" name="status" value="pending">
                                        <button type="submit" class="block px-4 py-2 text-sm text-yellow-700 hover:bg-yellow-100 w-full text-left cursor-pointer">
                                            <i class="fas fa-clock mr-2"></i> Mark as Pending
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Detail page loaded');
        
        // Simple Alpine.js loading
        if (typeof Alpine === 'undefined') {
            console.log('Loading Alpine.js');
            const alpineScript = document.createElement('script');
            alpineScript.src = 'https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js';
            alpineScript.defer = true;
            document.head.appendChild(alpineScript);
        }
    });
</script>
@endsection