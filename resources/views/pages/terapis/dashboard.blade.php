@extends('layouts.terapis.app')

@section('title', 'Terapis Dashboard')

@section('content')
    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Dashboard</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Stats Card - Patients (for terapis focus) -->
            <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-lg shadow-md p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium opacity-75">Total Patients</p>
                        <p class="text-2xl font-bold">534</p>
                    </div>
                    <div class="bg-green-400 bg-opacity-30 rounded-full p-3">
                        <i class="fas fa-user-injured text-xl"></i>
                    </div>
                </div>
                <div class="mt-4 text-sm font-medium">
                    <span class="text-green-300">
                        <i class="fas fa-arrow-up mr-1"></i>18%
                    </span>
                    <span class="opacity-75 ml-2">Since last month</span>
                </div>
            </div>
            
            <!-- Stats Card - Appointments -->
            <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-lg shadow-md p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium opacity-75">Appointments</p>
                        <p class="text-2xl font-bold">89</p>
                    </div>
                    <div class="bg-yellow-400 bg-opacity-30 rounded-full p-3">
                        <i class="fas fa-calendar-check text-xl"></i>
                    </div>
                </div>
                <div class="mt-4 text-sm font-medium">
                    <span class="text-green-300">
                        <i class="fas fa-arrow-up mr-1"></i>5%
                    </span>
                    <span class="opacity-75 ml-2">Since last week</span>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 lg:col-span-2">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold text-gray-800">Recent Activity</h2>
                    <a href="#" class="text-blue-500 text-sm hover:underline">View All</a>
                </div>
                
                <div class="space-y-4">
                    <div class="flex items-center gap-4 pb-4 border-b">
                        <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-800">New patient registered</p>
                            <p class="text-xs text-gray-500">Budi Santoso registered as a new patient</p>
                        </div>
                        <span class="text-xs text-gray-400">2 hours ago</span>
                    </div>
                    
                    <div class="flex items-center gap-4 pb-4 border-b">
                        <div class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center text-green-600">
                            <i class="fas fa-calendar-plus"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-800">Appointment scheduled</p>
                            <p class="text-xs text-gray-500">You have a new appointment with Siti</p>
                        </div>
                        <span class="text-xs text-gray-400">3 hours ago</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection