

<?php $__env->startSection('title', 'Tambah Data Pasien Baru'); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Tambah Data Pasien Baru</h1>
            <p class="text-gray-600 mt-1">Isi formulir di bawah ini untuk menambahkan data pasien baru</p>
        </div>
        <div>
            <a href="<?php echo e(route('admin.patients.index')); ?>" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>
    </div>
    
    <?php if($errors->any()): ?>
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
            <p class="font-bold">Terjadi kesalahan:</p>
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>
    
    <form action="<?php echo e(route('admin.patients.store')); ?>" method="POST" class="space-y-6">
        <?php echo csrf_field(); ?>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Nama Anak -->
            <div>
                <label for="nama_anak" class="block text-sm font-medium text-gray-700 mb-1">Nama Anak <span class="text-red-500">*</span></label>
                <input type="text" name="nama_anak" id="nama_anak" required value="<?php echo e(old('nama_anak')); ?>" 
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
            </div>
            
            <!-- Jenis Kelamin -->
            <div>
                <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin <span class="text-red-500">*</span></label>
                <select name="jenis_kelamin" id="jenis_kelamin" required 
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    <option value="Laki-laki" <?php echo e(old('jenis_kelamin') == 'Laki-laki' ? 'selected' : ''); ?>>Laki-laki</option>
                    <option value="Perempuan" <?php echo e(old('jenis_kelamin') == 'Perempuan' ? 'selected' : ''); ?>>Perempuan</option>
                </select>
            </div>
            
            <!-- Tempat Lahir -->
            <div>
                <label for="tempat_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" id="tempat_lahir" value="<?php echo e(old('tempat_lahir')); ?>" 
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
            </div>
            
            <!-- Tanggal Lahir -->
            <div>
                <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="<?php echo e(old('tanggal_lahir')); ?>" 
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
            </div>
            
            <!-- Nama Orang Tua -->
            <div>
                <label for="nama_orang_tua" class="block text-sm font-medium text-gray-700 mb-1">Nama Orang Tua</label>
                <input type="text" name="nama_orang_tua" id="nama_orang_tua" value="<?php echo e(old('nama_orang_tua')); ?>" 
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
            </div>
            
            <!-- Telepon -->
            <div>
                <label for="telepon" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                <input type="text" name="telepon" id="telepon" value="<?php echo e(old('telepon')); ?>" 
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
            </div>
            
            <!-- Cabang -->
            <div>
                <label for="id_cabang" class="block text-sm font-medium text-gray-700 mb-1">Cabang <span class="text-red-500">*</span></label>
                <select name="id_cabang" id="id_cabang" required 
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    <option value="">Pilih Cabang</option>
                    <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($branch->id); ?>" <?php echo e(old('id_cabang') == $branch->id ? 'selected' : ''); ?>><?php echo e($branch->nama_cabang); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            
            <!-- Jenis Terapi -->
            <div>
                <label for="jenis_terapi" class="block text-sm font-medium text-gray-700 mb-1">Jenis Terapi</label>
                <select name="jenis_terapi" id="jenis_terapi" 
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    <option value="">Pilih Jenis Terapi</option>
                    <option value="Terapi Wicara" <?php echo e(old('jenis_terapi') == 'Terapi Wicara' ? 'selected' : ''); ?>>Terapi Wicara</option>
                    <option value="Terapi Okupasi" <?php echo e(old('jenis_terapi') == 'Terapi Okupasi' ? 'selected' : ''); ?>>Terapi Okupasi</option>
                    <option value="Fisioterapi Anak" <?php echo e(old('jenis_terapi') == 'Fisioterapi Anak' ? 'selected' : ''); ?>>Fisioterapi Anak</option>
                    <option value="Terapi Perilaku" <?php echo e(old('jenis_terapi') == 'Terapi Perilaku' ? 'selected' : ''); ?>>Terapi Perilaku</option>
                    <option value="Terapi Edukasi" <?php echo e(old('jenis_terapi') == 'Terapi Edukasi' ? 'selected' : ''); ?>>Terapi Edukasi</option>
                    <option value="Terapi Sensori Integrasi" <?php echo e(old('jenis_terapi') == 'Terapi Sensori Integrasi' ? 'selected' : ''); ?>>Terapi Sensori Integrasi</option>
                </select>
            </div>
            
            <!-- Status Pasien -->
            <div>
                <label for="status_pasien" class="block text-sm font-medium text-gray-700 mb-1">Status Pasien <span class="text-red-500">*</span></label>
                <select name="status_pasien" id="status_pasien" required 
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    <option value="Aktif" <?php echo e(old('status_pasien') == 'Aktif' ? 'selected' : ''); ?>>Aktif</option>
                    <option value="Tidak Aktif" <?php echo e(old('status_pasien') == 'Tidak Aktif' ? 'selected' : ''); ?>>Tidak Aktif</option>
                </select>
            </div>
            
            <!-- Terakhir Konsultasi -->
            <div>
                <label for="terakhir_konsultasi" class="block text-sm font-medium text-gray-700 mb-1">Terakhir Konsultasi</label>
                <input type="date" name="terakhir_konsultasi" id="terakhir_konsultasi" value="<?php echo e(old('terakhir_konsultasi')); ?>" 
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
            </div>
        </div>
        
        <!-- Alamat -->
        <div>
            <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
            <textarea name="alamat" id="alamat" rows="3" 
                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"><?php echo e(old('alamat')); ?></textarea>
        </div>
        
        <!-- Keluhan Awal -->
        <div>
            <label for="keluhan_awal" class="block text-sm font-medium text-gray-700 mb-1">Keluhan Awal</label>
            <textarea name="keluhan_awal" id="keluhan_awal" rows="3" 
                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"><?php echo e(old('keluhan_awal')); ?></textarea>
        </div>
        
        <!-- Hasil Follow Up -->
        <div>
            <label for="hasil_follow_up" class="block text-sm font-medium text-gray-700 mb-1">Hasil Follow Up</label>
            <textarea name="hasil_follow_up" id="hasil_follow_up" rows="3" 
                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"><?php echo e(old('hasil_follow_up')); ?></textarea>
        </div>
        
        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">
                Simpan Data Pasien
            </button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\klinik\resources\views/admin/patients/create.blade.php ENDPATH**/ ?>