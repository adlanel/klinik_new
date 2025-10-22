

<?php $__env->startSection('title', 'Detail Jadwal Tugas - Terapis'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Detail Jadwal Tugas</h1>
            <p class="text-gray-600 mt-1">Informasi lengkap jadwal tugas terapi</p>
        </div>
        <div class="flex space-x-3">
            <a href="<?php echo e(route('terapis.jadwal-tugas.edit', $jadwalTugas->id)); ?>" 
               class="inline-flex items-center px-4 py-2 bg-yellow-600 text-white rounded-md hover:bg-yellow-700 transition-colors">
                <i class="fas fa-edit mr-2"></i>
                Edit
            </a>
            <a href="<?php echo e(route('terapis.jadwal-tugas.pdf', $jadwalTugas->id)); ?>" 
               class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors"
               target="_blank">
                <i class="fas fa-file-pdf mr-2"></i>
                Download PDF
            </a>
            <a href="<?php echo e(route('terapis.jadwal-tugas.index')); ?>" 
               class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali
            </a>
        </div>
    </div>

    <!-- Alert Messages -->
    <?php if(session('success')): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Informasi Jadwal -->
        <div class="bg-white rounded-lg shadow-sm border p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-calendar-alt text-blue-600 mr-2"></i>
                Informasi Jadwal
            </h2>
            
            <div class="space-y-4">
                <div class="flex justify-between py-2 border-b border-gray-100">
                    <span class="font-medium text-gray-600">Tanggal Terapi:</span>
                    <span class="text-gray-800"><?php echo e(\Carbon\Carbon::parse($jadwalTugas->tanggal_terapi)->format('d/m/Y')); ?></span>
                </div>
                
                <div class="flex justify-between py-2 border-b border-gray-100">
                    <span class="font-medium text-gray-600">Jam Sesi:</span>
                    <span class="text-gray-800"><?php echo e($jadwalTugas->jam_sesi); ?></span>
                </div>
                
                <div class="flex justify-between py-2 border-b border-gray-100">
                    <span class="font-medium text-gray-600">Status:</span>
                    <span>
                        <?php if($jadwalTugas->status == 'Sudah Dikerjakan'): ?>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <i class="fas fa-check-circle mr-1"></i>
                                Selesai
                            </span>
                        <?php elseif($jadwalTugas->status == 'Belum Dikerjakan'): ?>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                <i class="fas fa-clock mr-1"></i>
                                Menunggu
                            </span>
                        <?php elseif($jadwalTugas->status == 'Cancelled'): ?>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                <i class="fas fa-times-circle mr-1"></i>
                                Batal
                            </span>
                        <?php else: ?>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                <?php echo e($jadwalTugas->status ?? 'Unknown'); ?>

                            </span>
                        <?php endif; ?>
                    </span>
                </div>
                
                <div class="flex justify-between py-2 border-b border-gray-100">
                    <span class="font-medium text-gray-600">Jenis Paket:</span>
                    <span class="text-gray-800">
                        <?php if($jadwalTugas->jenis_paket): ?>
                            <span class="capitalize"><?php echo e(str_replace('_', ' ', $jadwalTugas->jenis_paket)); ?></span>
                        <?php else: ?>
                            <span class="text-gray-400">-</span>
                        <?php endif; ?>
                    </span>
                </div>
                
                <div class="flex justify-between py-2 border-b border-gray-100">
                    <span class="font-medium text-gray-600">Layanan:</span>
                    <span class="text-gray-800"><?php echo e($jadwalTugas->nama_layanan); ?></span>
                </div>
                
                <div class="flex justify-between py-2">
                    <span class="font-medium text-gray-600">Cabang:</span>
                    <span class="text-gray-800"><?php echo e($jadwalTugas->nama_cabang); ?></span>
                </div>
            </div>
        </div>

        <!-- Informasi Pasien -->
        <div class="bg-white rounded-lg shadow-sm border p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-user-injured text-green-600 mr-2"></i>
                Informasi Pasien
            </h2>
            
            <div class="space-y-4">
                <div class="flex justify-between py-2 border-b border-gray-100">
                    <span class="font-medium text-gray-600">Nama Anak:</span>
                    <span class="text-gray-800 font-medium"><?php echo e($jadwalTugas->nama_pasien); ?></span>
                </div>
                
                <?php if($jadwalTugas->nama_orang_tua): ?>
                <div class="flex justify-between py-2 border-b border-gray-100">
                    <span class="font-medium text-gray-600">Nama Orang Tua:</span>
                    <span class="text-gray-800"><?php echo e($jadwalTugas->nama_orang_tua); ?></span>
                </div>
                <?php endif; ?>
                
                <?php if($jadwalTugas->telepon): ?>
                <div class="flex justify-between py-2 border-b border-gray-100">
                    <span class="font-medium text-gray-600">Telepon:</span>
                    <span class="text-gray-800"><?php echo e($jadwalTugas->telepon); ?></span>
                </div>
                <?php endif; ?>
                
                <?php if($jadwalTugas->alamat): ?>
                <div class="py-2">
                    <span class="font-medium text-gray-600 block mb-2">Alamat:</span>
                    <span class="text-gray-800"><?php echo e($jadwalTugas->alamat); ?></span>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Catatan Terapi -->
    <div class="mt-6 bg-white rounded-lg shadow-sm border p-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
            <i class="fas fa-sticky-note text-purple-600 mr-2"></i>
            Catatan Terapi
        </h2>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div>
                <h3 class="font-medium text-gray-600 mb-2">Notes:</h3>
                <div class="bg-gray-50 rounded-md p-4 min-h-24">
                    <?php if($jadwalTugas->notes): ?>
                        <p class="text-gray-800 whitespace-pre-wrap"><?php echo e($jadwalTugas->notes); ?></p>
                    <?php else: ?>
                        <p class="text-gray-400 italic">Belum ada catatan</p>
                    <?php endif; ?>
                </div>
            </div>
            
            <div>
                <h3 class="font-medium text-gray-600 mb-2">Saran di Rumah:</h3>
                <div class="bg-gray-50 rounded-md p-4 min-h-24">
                    <?php if($jadwalTugas->saran_dirumah): ?>
                        <p class="text-gray-800 whitespace-pre-wrap"><?php echo e($jadwalTugas->saran_dirumah); ?></p>
                    <?php else: ?>
                        <p class="text-gray-400 italic">Belum ada saran</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="mt-6 flex justify-center space-x-4">
        <a href="<?php echo e(route('terapis.jadwal-tugas.edit', $jadwalTugas->id)); ?>" 
           class="inline-flex items-center px-8 py-3 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition-colors shadow-lg">
            <i class="fas fa-edit mr-2"></i>
            Edit Status & Catatan
        </a>
        <a href="<?php echo e(route('terapis.jadwal-tugas.pdf', $jadwalTugas->id)); ?>" 
           class="inline-flex items-center px-8 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors shadow-lg"
           target="_blank">
            <i class="fas fa-file-pdf mr-2"></i>
            Download PDF
        </a>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.terapis.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\klinik\resources\views/pages/terapis/jadwal-tugas/show.blade.php ENDPATH**/ ?>