

<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Dashboard</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Stats Card - Users -->
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg shadow-md p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium opacity-75">Total Users</p>
                        <p class="text-2xl font-bold">125</p>
                    </div>
                    <div class="bg-blue-400 bg-opacity-30 rounded-full p-3">
                        <i class="fas fa-users text-xl"></i>
                    </div>
                </div>
                <div class="mt-4 text-sm font-medium">
                    <span class="text-green-300">
                        <i class="fas fa-arrow-up mr-1"></i>12%
                    </span>
                    <span class="opacity-75 ml-2">Since last month</span>
                </div>
            </div>
            
            <!-- Stats Card - Patients -->
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
            
            <!-- Stats Card - Revenue -->
            <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg shadow-md p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium opacity-75">Monthly Revenue</p>
                        <p class="text-2xl font-bold">Rp 24.5M</p>
                    </div>
                    <div class="bg-purple-400 bg-opacity-30 rounded-full p-3">
                        <i class="fas fa-money-bill-wave text-xl"></i>
                    </div>
                </div>
                <div class="mt-4 text-sm font-medium">
                    <span class="text-green-300">
                        <i class="fas fa-arrow-up mr-1"></i>8%
                    </span>
                    <span class="opacity-75 ml-2">Since last month</span>
                </div>
            </div>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Recent Activity -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
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
                            <p class="text-xs text-gray-500">Dr. Widya has a new appointment with Siti</p>
                        </div>
                        <span class="text-xs text-gray-400">3 hours ago</span>
                    </div>
                    
                    <div class="flex items-center gap-4 pb-4 border-b">
                        <div class="h-10 w-10 rounded-full bg-yellow-100 flex items-center justify-center text-yellow-600">
                            <i class="fas fa-file-medical"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-800">Medical record updated</p>
                            <p class="text-xs text-gray-500">Dr. Rahman updated Joko's medical record</p>
                        </div>
                        <span class="text-xs text-gray-400">5 hours ago</span>
                    </div>
                    
                    <div class="flex items-center gap-4">
                        <div class="h-10 w-10 rounded-full bg-red-100 flex items-center justify-center text-red-600">
                            <i class="fas fa-calendar-times"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-800">Appointment cancelled</p>
                            <p class="text-xs text-gray-500">Rini cancelled her appointment with Dr. Aditya</p>
                        </div>
                        <span class="text-xs text-gray-400">Yesterday</span>
                    </div>
                </div>
            </div>
            
            <!-- Upcoming Appointments -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold text-gray-800">Upcoming Appointments</h2>
                    <a href="#" class="text-blue-500 text-sm hover:underline">View All</a>
                </div>
                
                <div class="space-y-4">
                    <div class="p-4 rounded-lg border border-gray-200 bg-gray-50">
                        <div class="flex justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-800">Agus Hermawan</p>
                                <p class="text-xs text-gray-500">General Checkup</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-medium text-blue-600">09:00 AM</p>
                                <p class="text-xs text-gray-500">Today</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-4 rounded-lg border border-gray-200 bg-gray-50">
                        <div class="flex justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-800">Dewi Lestari</p>
                                <p class="text-xs text-gray-500">Dental Consultation</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-medium text-blue-600">11:30 AM</p>
                                <p class="text-xs text-gray-500">Today</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-4 rounded-lg border border-gray-200 bg-gray-50">
                        <div class="flex justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-800">Rizki Pratama</p>
                                <p class="text-xs text-gray-500">Lab Results Review</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-medium text-blue-600">02:15 PM</p>
                                <p class="text-xs text-gray-500">Today</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-4 rounded-lg border border-gray-200 bg-gray-50">
                        <div class="flex justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-800">Sari Indah</p>
                                <p class="text-xs text-gray-500">Prenatal Checkup</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-medium text-blue-600">10:00 AM</p>
                                <p class="text-xs text-gray-500">Tomorrow</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\klinik\resources\views/pages/admin/dashboard.blade.php ENDPATH**/ ?>