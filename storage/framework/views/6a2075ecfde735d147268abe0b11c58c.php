

<?php $__env->startSection('title', 'Tambah Pasien Baru'); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Tambah Pasien Baru</h1>
            <p class="text-gray-600 mt-1">Isi form berikut untuk menambahkan data pasien baru</p>
        </div>
        <div class="mt-4 md:mt-0">
            <a href="<?php echo e(route('terapis.patients.index')); ?>" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>
    </div>
    
    <?php if($errors->any()): ?>
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        <strong class="font-bold">Error!</strong>
        <span class="block sm:inline">Please check the form for errors.</span>
        <ul class="mt-2 list-disc list-inside">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
    <?php endif; ?>
    
    <form action="<?php echo e(route('terapis.patients.store')); ?>" method="POST" class="space-y-6">
        <?php echo csrf_field(); ?>
        
        <div class="bg-white rounded-lg border overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b">
                <h2 class="text-lg font-semibold text-gray-800">Informasi Pribadi</h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="nama_anak" class="block text-sm font-medium text-gray-700 mb-1">Nama Anak <span class="text-red-500">*</span></label>
                        <input type="text" id="nama_anak" name="nama_anak" value="<?php echo e(old('nama_anak')); ?>" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                    </div>
                    
                    <div>
                        <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin <span class="text-red-500">*</span></label>
                        <select id="jenis_kelamin" name="jenis_kelamin" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="Laki-laki" <?php echo e(old('jenis_kelamin') == 'Laki-laki' ? 'selected' : ''); ?>>Laki-laki</option>
                            <option value="Perempuan" <?php echo e(old('jenis_kelamin') == 'Perempuan' ? 'selected' : ''); ?>>Perempuan</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="tempat_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir</label>
                        <input type="text" id="tempat_lahir" name="tempat_lahir" value="<?php echo e(old('tempat_lahir')); ?>" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                    </div>
                    
                    <div>
                        <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                        <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="<?php echo e(old('tanggal_lahir')); ?>" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                    </div>
                    
                    <div>
                        <label for="nama_orang_tua" class="block text-sm font-medium text-gray-700 mb-1">Nama Orang Tua</label>
                        <input type="text" id="nama_orang_tua" name="nama_orang_tua" value="<?php echo e(old('nama_orang_tua')); ?>" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                    </div>
                    
                    <div>
                        <label for="telepon" class="block text-sm font-medium text-gray-700 mb-1">Telepon</label>
                        <input type="text" id="telepon" name="telepon" value="<?php echo e(old('telepon')); ?>" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                    </div>
                </div>
                
                <div class="mt-6">
                    <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                    <textarea id="alamat" name="alamat" rows="3" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"><?php echo e(old('alamat')); ?></textarea>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg border overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b">
                <h2 class="text-lg font-semibold text-gray-800">Informasi Terapi</h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="id_cabang" class="block text-sm font-medium text-gray-700 mb-1">Cabang <span class="text-red-500">*</span></label>
                        <select id="id_cabang" name="id_cabang" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                            <option value="">Pilih Cabang</option>
                            <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($branch->id); ?>" <?php echo e(old('id_cabang') == $branch->id ? 'selected' : ''); ?>>
                                    <?php echo e($branch->nama_cabang); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    
                    <div>
                        <label for="jenis_terapi" class="block text-sm font-medium text-gray-700 mb-1">Jenis Terapi</label>
                        <input type="text" id="jenis_terapi" name="jenis_terapi" value="<?php echo e(old('jenis_terapi')); ?>" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                    </div>
                    
                    <div>
                        <label for="status_pasien" class="block text-sm font-medium text-gray-700 mb-1">Status Pasien <span class="text-red-500">*</span></label>
                        <select id="status_pasien" name="status_pasien" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                            <option value="">Pilih Status</option>
                            <option value="Aktif" <?php echo e(old('status_pasien', 'Aktif') == 'Aktif' ? 'selected' : ''); ?>>Aktif</option>
                            <option value="Tidak Aktif" <?php echo e(old('status_pasien') == 'Tidak Aktif' ? 'selected' : ''); ?>>Tidak Aktif</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="terakhir_konsultasi" class="block text-sm font-medium text-gray-700 mb-1">Terakhir Konsultasi</label>
                        <input type="date" id="terakhir_konsultasi" name="terakhir_konsultasi" value="<?php echo e(old('terakhir_konsultasi')); ?>" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                    </div>
                </div>
                
                <div class="mt-6">
                    <label for="keluhan_awal" class="block text-sm font-medium text-gray-700 mb-1">Keluhan Awal</label>
                    <textarea id="keluhan_awal" name="keluhan_awal" rows="3" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"><?php echo e(old('keluhan_awal')); ?></textarea>
                </div>
            </div>
        </div>
        
        <div class="flex justify-between">
            <a href="<?php echo e(route('terapis.patients.index')); ?>" class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded">
                <i class="fas fa-arrow-left mr-2"></i> Cancel
            </a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded">
                <i class="fas fa-save mr-2"></i> Simpan Data Pasien
            </button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.terapis.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\klinik\resources\views/pages/terapis/patients/create.blade.php ENDPATH**/ ?>