

<?php $__env->startSection('title', 'Detail Pasien'); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Detail Pasien</h1>
            <p class="text-gray-600 mt-1">Informasi lengkap pasien: <?php echo e($patient->nama_anak); ?></p>
        </div>
        <div class="flex space-x-2">
            <a href="<?php echo e(route('admin.patients.edit', $patient->id_pasien)); ?>" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                <i class="fas fa-edit mr-2"></i>Edit
            </a>
            <a href="<?php echo e(route('admin.patients.index')); ?>" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>
    </div>
    
    <?php if(session('success')): ?>
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
            <p><?php echo e(session('success')); ?></p>
        </div>
    <?php endif; ?>
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Personal Information -->
        <div class="lg:col-span-2">
            <div class="bg-white border rounded-lg overflow-hidden">
                <div class="px-6 py-4 bg-gray-50 border-b">
                    <h2 class="text-lg font-semibold text-gray-800">Informasi Pribadi</h2>
                </div>
                <div class="p-6 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Nama Lengkap</h3>
                            <p class="text-base text-gray-900"><?php echo e($patient->nama_anak); ?></p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">ID Pasien</h3>
                            <p class="text-base text-gray-900"><?php echo e($patient->id_pasien); ?></p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Jenis Kelamin</h3>
                            <p class="text-base text-gray-900"><?php echo e($patient->jenis_kelamin); ?></p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Usia</h3>
                            <p class="text-base text-gray-900">
                                <?php if($patient->tanggal_lahir): ?>
                                    <?php echo e(\Carbon\Carbon::parse($patient->tanggal_lahir)->age); ?> tahun
                                    (<?php echo e(\Carbon\Carbon::parse($patient->tanggal_lahir)->format('d M Y')); ?>)
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Tempat Lahir</h3>
                            <p class="text-base text-gray-900"><?php echo e($patient->tempat_lahir ?? '-'); ?></p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Nama Orang Tua</h3>
                            <p class="text-base text-gray-900"><?php echo e($patient->nama_orang_tua ?? '-'); ?></p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Telepon</h3>
                            <p class="text-base text-gray-900"><?php echo e($patient->telepon ?? '-'); ?></p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Cabang</h3>
                            <p class="text-base text-gray-900"><?php echo e($patient->cabang->nama_cabang ?? '-'); ?></p>
                        </div>
                        <div class="md:col-span-2">
                            <h3 class="text-sm font-medium text-gray-500">Alamat</h3>
                            <p class="text-base text-gray-900"><?php echo e($patient->alamat ?? '-'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Medical Information -->
            <div class="bg-white border rounded-lg overflow-hidden mt-6">
                <div class="px-6 py-4 bg-gray-50 border-b">
                    <h2 class="text-lg font-semibold text-gray-800">Informasi Medis</h2>
                </div>
                <div class="p-6 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Jenis Terapi</h3>
                            <p class="text-base text-gray-900"><?php echo e($patient->jenis_terapi ?? '-'); ?></p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Status Pasien</h3>
                            <p class="text-base text-gray-900">
                                <?php if($patient->status_pasien == 'Aktif'): ?>
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                        Aktif
                                    </span>
                                <?php else: ?>
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                        Tidak Aktif
                                    </span>
                                <?php endif; ?>
                            </p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Terakhir Konsultasi</h3>
                            <p class="text-base text-gray-900">
                                <?php echo e($patient->terakhir_konsultasi ? \Carbon\Carbon::parse($patient->terakhir_konsultasi)->format('d M Y') : '-'); ?>

                            </p>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <h3 class="text-sm font-medium text-gray-500 mb-2">Keluhan Awal</h3>
                        <div class="bg-gray-50 p-4 rounded border">
                            <p class="text-base text-gray-900"><?php echo e($patient->keluhan_awal ?? 'Tidak ada keluhan awal tercatat.'); ?></p>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <h3 class="text-sm font-medium text-gray-500 mb-2">Hasil Follow Up</h3>
                        <div class="bg-gray-50 p-4 rounded border">
                            <p class="text-base text-gray-900"><?php echo e($patient->hasil_follow_up ?? 'Belum ada hasil follow up tercatat.'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Side Panel -->
        <div>
            <div class="bg-white border rounded-lg overflow-hidden">
                <div class="px-6 py-4 bg-gray-50 border-b">
                    <h2 class="text-lg font-semibold text-gray-800">Informasi Tambahan</h2>
                </div>
                <div class="p-6 space-y-6">
                    <div class="flex items-center space-x-4 p-4 bg-blue-50 rounded-lg border border-blue-100">
                        <div class="flex-shrink-0 h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center">
                            <i class="fas fa-calendar-check text-blue-600"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900">Riwayat Konsultasi</p>
                            <p class="text-sm text-gray-500">Lihat semua riwayat konsultasi pasien</p>
                            <a href="#" class="text-sm text-blue-600 hover:text-blue-800 mt-1 inline-block">Lihat Detail</a>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-4 p-4 bg-green-50 rounded-lg border border-green-100">
                        <div class="flex-shrink-0 h-12 w-12 rounded-full bg-green-100 flex items-center justify-center">
                            <i class="fas fa-chart-line text-green-600"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900">Perkembangan Terapi</p>
                            <p class="text-sm text-gray-500">Lihat progres terapi pasien</p>
                            <a href="#" class="text-sm text-green-600 hover:text-green-800 mt-1 inline-block">Lihat Progres</a>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-4 p-4 bg-purple-50 rounded-lg border border-purple-100">
                        <div class="flex-shrink-0 h-12 w-12 rounded-full bg-purple-100 flex items-center justify-center">
                            <i class="fas fa-file-medical-alt text-purple-600"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900">Catatan Medis</p>
                            <p class="text-sm text-gray-500">Kelola catatan medis pasien</p>
                            <a href="#" class="text-sm text-purple-600 hover:text-purple-800 mt-1 inline-block">Lihat Catatan</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Actions -->
            <div class="bg-white border rounded-lg overflow-hidden mt-6">
                <div class="px-6 py-4 bg-gray-50 border-b">
                    <h2 class="text-lg font-semibold text-gray-800">Aksi</h2>
                </div>
                <div class="p-6">
                    <div class="space-y-3">
                        <a href="<?php echo e(route('admin.patients.edit', $patient->id_pasien)); ?>" class="flex items-center w-full px-4 py-2 bg-blue-50 hover:bg-blue-100 text-blue-700 rounded-md">
                            <i class="fas fa-edit mr-2"></i>
                            <span>Edit Data Pasien</span>
                        </a>
                        <a href="#" class="flex items-center w-full px-4 py-2 bg-green-50 hover:bg-green-100 text-green-700 rounded-md">
                            <i class="fas fa-calendar-plus mr-2"></i>
                            <span>Jadwalkan Konsultasi</span>
                        </a>
                        <form action="<?php echo e(route('admin.patients.destroy', $patient->id_pasien)); ?>" method="POST" 
                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pasien ini?');">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="flex items-center w-full px-4 py-2 bg-red-50 hover:bg-red-100 text-red-700 rounded-md">
                                <i class="fas fa-trash-alt mr-2"></i>
                                <span>Hapus Data Pasien</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\klinik\resources\views/admin/patients/show.blade.php ENDPATH**/ ?>