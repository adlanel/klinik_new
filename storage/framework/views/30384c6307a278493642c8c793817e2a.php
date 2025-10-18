

<?php $__env->startSection('title', 'Appointments Management'); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Data Appointment</h1>
            <p class="text-gray-600 mt-1">Kelola janji temu pasien klinik</p>
        </div>
        <div class="mt-4 md:mt-0">
            <a href="<?php echo e(route('admin.appointments.create')); ?>" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                <i class="fas fa-plus mr-2"></i>Tambah Appointment
            </a>
        </div>
    </div>
    
    <?php if(session('success')): ?>
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
        <p><?php echo e(session('success')); ?></p>
    </div>
    <?php endif; ?>
    
    <!-- Search and Filter -->
    <div class="bg-gray-50 p-4 rounded-lg border mb-6">
        <form action="<?php echo e(route('admin.appointments.index')); ?>" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Cari Appointment</label>
                <input type="text" name="search" id="search" placeholder="Nama/Telepon" 
                    value="<?php echo e(request('search')); ?>" 
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
            </div>
            
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" id="status" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    <option value="">Semua Status</option>
                    <option value="pending" <?php echo e(request('status') == 'pending' ? 'selected' : ''); ?>>Pending</option>
                    <option value="approved" <?php echo e(request('status') == 'approved' ? 'selected' : ''); ?>>Approved</option>
                    <option value="rejected" <?php echo e(request('status') == 'rejected' ? 'selected' : ''); ?>>Rejected</option>
                </select>
            </div>
            
            <div>
                <label for="meeting_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Janji</label>
                <input type="date" name="meeting_date" id="meeting_date" value="<?php echo e(request('meeting_date')); ?>" 
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
            </div>
            
            <div class="flex items-end">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">
                    <i class="fas fa-search mr-2"></i>Filter
                </button>
                <a href="<?php echo e(route('admin.appointments.index')); ?>" class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded ml-2">
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
                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created At</th>
                    <th scope="col" class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php $__empty_1 = true; $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo e($appointments->firstItem() + $key); ?></td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo e($appointment->patient_name); ?></td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo e($appointment->phone); ?></td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo e($appointment->formatDate($appointment->meeting_date)); ?></td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    <?php echo e($appointment->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                                      ($appointment->status == 'approved' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800')); ?>">
                                    <?php echo e(ucfirst($appointment->status)); ?>

                                </span>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo e($appointment->created_at->format('d M Y, H:i')); ?></td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                <div class="flex justify-center space-x-2">
                                    <a href="<?php echo e(route('admin.appointments.show', $appointment->id)); ?>" class="text-blue-600 hover:text-blue-900">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="<?php echo e(route('admin.appointments.edit', $appointment->id)); ?>" class="text-green-600 hover:text-green-900">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="text-red-600 hover:text-red-900"
                                        onclick="confirmDelete('<?php echo e($appointment->id); ?>', '<?php echo e($appointment->patient_name); ?>')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <div class="relative" x-data="{ open: false }">
                                        <button @click="open = !open" class="text-gray-600 hover:text-gray-900">
                                            <i class="fas fa-cog"></i>
                                        </button>
                                        <div x-show="open" @click.away="open = false" class="absolute right-0 w-48 py-1 mt-1 bg-white rounded-md shadow-lg z-50" 
                                            style="display: none;" 
                                            :class="{'!bottom-full !top-auto !mt-0 !mb-1': $el.getBoundingClientRect().bottom + 150 > window.innerHeight}">
                                            <form action="<?php echo e(route('admin.appointments.update-status', $appointment->id)); ?>" method="POST" class="update-status-form">
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" name="status" value="approved">
                                                <button type="submit" class="block px-4 py-2 text-sm text-green-700 hover:bg-green-100 w-full text-left cursor-pointer">
                                                    <i class="fas fa-check mr-2"></i> Approve
                                                </button>
                                            </form>
                                            
                                            <form action="<?php echo e(route('admin.appointments.update-status', $appointment->id)); ?>" method="POST" class="update-status-form">
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" name="status" value="rejected">
                                                <button type="submit" class="block px-4 py-2 text-sm text-red-700 hover:bg-red-100 w-full text-left cursor-pointer">
                                                    <i class="fas fa-times mr-2"></i> Reject
                                                </button>
                                            </form>
                                            
                                            <form action="<?php echo e(route('admin.appointments.update-status', $appointment->id)); ?>" method="POST" class="update-status-form">
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" name="status" value="pending">
                                                <button type="submit" class="block px-4 py-2 text-sm text-yellow-700 hover:bg-yellow-100 w-full text-left cursor-pointer">
                                                    <i class="fas fa-clock mr-2"></i> Mark as Pending
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <form id="delete-form-<?php echo e($appointment->id); ?>" action="<?php echo e(route('admin.appointments.destroy', $appointment->id)); ?>" method="POST" class="hidden">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="px-4 py-4 text-center text-gray-500">Tidak ada data appointment yang ditemukan.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="mt-4">
                <?php echo e($appointments->withQueryString()->links()); ?>

            </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden" id="deleteModal">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <div class="bg-red-100 p-2 rounded-full mx-auto flex items-center justify-center w-14 h-14">
                <svg class="h-8 w-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
            </div>
            <h3 class="text-lg leading-6 font-medium text-gray-900 mt-2">Confirm Delete</h3>
            <div class="mt-2 px-7 py-3">
                <p class="text-sm text-gray-500">
                    Are you sure you want to delete the appointment for <strong id="appointmentName"></strong>?
                </p>
                <p class="text-sm text-red-500 mt-2">This action cannot be undone.</p>
            </div>
            <div class="flex justify-center space-x-4 mt-4">
                <button type="button" id="closeDeleteModal" class="px-4 py-2 bg-gray-300 text-gray-700 text-base font-medium rounded-md shadow-sm hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300">
                    Cancel
                </button>
                <button type="button" id="confirmDeleteBtn" class="px-4 py-2 bg-red-600 text-white text-base font-medium rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                    Delete
                </button>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    // Simple direct DOM manipulation approach
    document.addEventListener('DOMContentLoaded', function() {
        console.log('DOM fully loaded');

    // Delete confirmation
    function confirmDelete(id, name) {
        document.getElementById('appointmentName').textContent = name;
        const modal = document.getElementById('deleteModal');
        modal.classList.remove('hidden');
        
        // Close modal
        document.getElementById('closeDeleteModal').addEventListener('click', function() {
            modal.classList.add('hidden');
        });
        
        // Confirm delete
        document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
            document.getElementById('delete-form-' + id).submit();
        });
    }
    
    // Add styling for the forms in dropdown menu
    document.querySelectorAll('.update-status-form').forEach(form => {
        form.style.margin = '0';
        form.style.padding = '0';
    });
    
    // Alpine.js loading
    if (typeof Alpine === 'undefined') {
        console.log('Loading Alpine.js');
        const alpineScript = document.createElement('script');
        alpineScript.src = 'https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js';
        alpineScript.defer = true;
        document.head.appendChild(alpineScript);
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\klinik\resources\views/admin/appointments/index.blade.php ENDPATH**/ ?>