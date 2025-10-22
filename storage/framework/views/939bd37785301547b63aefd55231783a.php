

<?php $__env->startSection('title', 'Edit Jadwal Tugas - Terapis'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Edit Jadwal Tugas</h1>
            <p class="text-gray-600 mt-1">Update status dan catatan terapi</p>
        </div>
        <a href="<?php echo e(route('terapis.jadwal-tugas.show', $jadwalTugas->id)); ?>" 
           class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 transition-colors">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali
        </a>
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

    <?php if($errors->any()): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Informasi Jadwal (Read Only) -->
        <div class="bg-white rounded-lg shadow-sm border p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-info-circle text-blue-600 mr-2"></i>
                Informasi Jadwal
            </h2>
            
            <div class="space-y-4">
                <div class="flex justify-between py-2 border-b border-gray-100">
                    <span class="font-medium text-gray-600">Pasien:</span>
                    <span class="text-gray-800 font-medium"><?php echo e($jadwalTugas->nama_pasien); ?></span>
                </div>
                
                <div class="flex justify-between py-2 border-b border-gray-100">
                    <span class="font-medium text-gray-600">Tanggal:</span>
                    <span class="text-gray-800"><?php echo e(\Carbon\Carbon::parse($jadwalTugas->tanggal_terapi)->format('d/m/Y')); ?></span>
                </div>
                
                <div class="flex justify-between py-2 border-b border-gray-100">
                    <span class="font-medium text-gray-600">Jam:</span>
                    <span class="text-gray-800"><?php echo e($jadwalTugas->jam_sesi); ?></span>
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

        <!-- Form Edit -->
        <div class="bg-white rounded-lg shadow-sm border p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-edit text-yellow-600 mr-2"></i>
                Edit Status & Catatan
            </h2>
            
            <form action="<?php echo e(route('terapis.jadwal-tugas.update', $jadwalTugas->id)); ?>" method="POST" class="space-y-4">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                
                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <select id="status" name="status" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <option value="">Pilih Status</option>
                        <option value="Belum Dikerjakan" <?php echo e($jadwalTugas->status == 'Belum Dikerjakan' ? 'selected' : ''); ?>>
                            Belum Dikerjakan
                        </option>
                        <option value="Sudah Dikerjakan" <?php echo e($jadwalTugas->status == 'Sudah Dikerjakan' ? 'selected' : ''); ?>>
                            Sudah Dikerjakan
                        </option>
                        <option value="Cancelled" <?php echo e($jadwalTugas->status == 'Cancelled' ? 'selected' : ''); ?>>
                            Cancelled
                        </option>
                    </select>
                    <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Notes -->
                <div>
                    <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                        Notes Terapi
                    </label>
                    <textarea id="notes" name="notes" rows="4" placeholder="Catatan hasil terapi, progress pasien, dll..."
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 <?php $__errorArgs = ['notes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"><?php echo e(old('notes', $jadwalTugas->notes)); ?></textarea>
                    <?php $__errorArgs = ['notes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Saran di Rumah -->
                <div>
                    <label for="saran_dirumah" class="block text-sm font-medium text-gray-700 mb-2">
                        Saran di Rumah
                    </label>
                    <textarea id="saran_dirumah" name="saran_dirumah" rows="4" placeholder="Saran latihan atau kegiatan yang bisa dilakukan di rumah..."
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 <?php $__errorArgs = ['saran_dirumah'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"><?php echo e(old('saran_dirumah', $jadwalTugas->saran_dirumah)); ?></textarea>
                    <?php $__errorArgs = ['saran_dirumah'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Buttons -->
                <div class="flex justify-end space-x-3 pt-4">
                    <a href="<?php echo e(route('terapis.jadwal-tugas.show', $jadwalTugas->id)); ?>" 
                       class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition-colors">
                        Batal
                    </a>
                    <button type="submit" 
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                        <i class="fas fa-save mr-2"></i>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.terapis.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\klinik\resources\views/pages/terapis/jadwal-tugas/edit.blade.php ENDPATH**/ ?>