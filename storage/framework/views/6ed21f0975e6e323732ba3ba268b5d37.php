

<?php $__env->startSection('title', 'Jadwal Tugas - Terapis'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Jadwal Tugas</h1>
            <p class="text-gray-600 mt-1">Daftar pasien yang ditangani oleh <?php echo e(auth()->user()->name); ?></p>
        </div>
    </div>

    <!-- Alert Messages -->
    <?php if(session('success')): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            <i class="fas fa-check-circle mr-2"></i>
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <i class="fas fa-exclamation-circle mr-2"></i>
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    <!-- Filter Section -->
    <div class="bg-white rounded-lg shadow-sm border p-4 mb-6">
        <form method="GET" action="<?php echo e(route('terapis.jadwal-tugas.index')); ?>" class="flex flex-wrap gap-4 items-end">
            <!-- Search -->
            <div class="flex-1 min-w-64">
                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Cari Pasien</label>
                <input type="text" id="search" name="search" value="<?php echo e(request('search')); ?>" 
                       placeholder="Nama pasien..." 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Date Filter -->
            <div>
                <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                <input type="date" id="tanggal" name="tanggal" value="<?php echo e(request('tanggal')); ?>" 
                       class="px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Status Filter -->
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select id="status" name="status" 
                        class="px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Semua Status</option>
                    <option value="Belum Dikerjakan" <?php echo e(request('status') == 'Belum Dikerjakan' ? 'selected' : ''); ?>>Belum Dikerjakan</option>
                    <option value="Sudah Dikerjakan" <?php echo e(request('status') == 'Sudah Dikerjakan' ? 'selected' : ''); ?>>Sudah Dikerjakan</option>
                    <option value="Cancelled" <?php echo e(request('status') == 'Cancelled' ? 'selected' : ''); ?>>Cancelled</option>
                </select>
            </div>

            <!-- Buttons -->
            <div class="flex gap-2">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                    <i class="fas fa-search mr-1"></i> Filter
                </button>
                <a href="<?php echo e(route('terapis.jadwal-tugas.index')); ?>" 
                   class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition-colors">
                    <i class="fas fa-times mr-1"></i> Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-calendar-alt text-blue-600 text-xl"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-blue-600">Total Sesi</p>
                    <p class="text-lg font-semibold text-blue-800"><?php echo e($jadwalTugas->count()); ?></p>
                </div>
            </div>
        </div>

        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-clock text-yellow-600 text-xl"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-yellow-600">Belum Dikerjakan</p>
                    <p class="text-lg font-semibold text-yellow-800">
                        <?php echo e($jadwalTugas->where('status', 'Belum Dikerjakan')->count()); ?>

                    </p>
                </div>
            </div>
        </div>

        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-check-circle text-green-600 text-xl"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-600">Sudah Dikerjakan</p>
                    <p class="text-lg font-semibold text-green-800">
                        <?php echo e($jadwalTugas->where('status', 'Sudah Dikerjakan')->count()); ?>

                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Jadwal Tugas Table -->
    <div class="bg-white rounded-lg shadow-sm border overflow-hidden">
        <?php if($jadwalTugas->count() > 0): ?>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal & Jam
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Pasien
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Layanan
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Cabang
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Jenis Paket
                            </th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php $__currentLoopData = $jadwalTugas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tugas): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        <?php echo e(\Carbon\Carbon::parse($tugas->tanggal_terapi)->format('d/m/Y')); ?>

                                    </div>
                                    <div class="text-sm text-gray-500">
                                        <?php echo e($tugas->jam_sesi); ?>

                                    </div>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        <?php echo e($tugas->nama_pasien); ?>

                                    </div>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        <?php echo e($tugas->nama_layanan); ?>

                                    </div>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        <?php echo e($tugas->nama_cabang); ?>

                                    </div>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <?php if($tugas->status == 'Sudah Dikerjakan'): ?>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <i class="fas fa-check-circle mr-1"></i>
                                            Selesai
                                        </span>
                                    <?php elseif($tugas->status == 'Belum Dikerjakan'): ?>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            <i class="fas fa-clock mr-1"></i>
                                            Menunggu
                                        </span>
                                    <?php elseif($tugas->status == 'Cancelled'): ?>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            <i class="fas fa-times-circle mr-1"></i>
                                            Batal
                                        </span>
                                    <?php else: ?>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            <?php echo e($tugas->status ?? 'Unknown'); ?>

                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        <?php if($tugas->jenis_paket): ?>
                                            <span class="capitalize"><?php echo e(str_replace('_', ' ', $tugas->jenis_paket)); ?></span>
                                        <?php else: ?>
                                            <span class="text-gray-400">-</span>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <!-- View Button -->
                                        <a href="<?php echo e(route('terapis.jadwal-tugas.show', $tugas->id)); ?>" 
                                           class="inline-flex items-center px-3 py-1 bg-blue-100 hover:bg-blue-200 text-blue-700 text-xs font-medium rounded transition-colors"
                                           title="Lihat Detail">
                                            <i class="fas fa-eye mr-1"></i>
                                            Detail
                                        </a>
                                        
                                        <!-- Edit Button -->
                                        <a href="<?php echo e(route('terapis.jadwal-tugas.edit', $tugas->id)); ?>" 
                                           class="inline-flex items-center px-3 py-1 bg-yellow-100 hover:bg-yellow-200 text-yellow-700 text-xs font-medium rounded transition-colors"
                                           title="Edit Status & Catatan">
                                            <i class="fas fa-edit mr-1"></i>
                                            Edit
                                        </a>

                                        <!-- Download PDF Button -->
                                        <a href="<?php echo e(route('terapis.jadwal-tugas.pdf', $tugas->id)); ?>" 
                                           class="inline-flex items-center px-3 py-1 bg-red-100 hover:bg-red-200 text-red-700 text-xs font-medium rounded transition-colors"
                                           title="Download PDF"
                                           target="_blank">
                                            <i class="fas fa-file-pdf mr-1"></i>
                                            PDF
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="p-8 text-center">
                <i class="fas fa-calendar-times text-gray-400 text-4xl mb-4"></i>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada jadwal tugas</h3>
                <p class="text-gray-500">
                    <?php if(request()->hasAny(['search', 'tanggal', 'status'])): ?>
                        Tidak ada jadwal yang cocok dengan filter yang dipilih.
                    <?php else: ?>
                        Belum ada jadwal tugas yang tersedia untuk Anda.
                    <?php endif; ?>
                </p>
                <?php if(request()->hasAny(['search', 'tanggal', 'status'])): ?>
                    <a href="<?php echo e(route('terapis.jadwal-tugas.index')); ?>" 
                       class="inline-flex items-center px-4 py-2 mt-4 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                        <i class="fas fa-times mr-2"></i>
                        Hapus Filter
                    </a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.terapis.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\klinik\resources\views/pages/terapis/jadwal-tugas/index.blade.php ENDPATH**/ ?>