

<?php $__env->startSection('title', 'Edit Fasilitas'); ?>

<?php $__env->startSection('content'); ?>
<div class="container px-6 py-8 mx-auto">
    <div class="flex justify-between items-center">
        <h3 class="text-3xl font-medium text-gray-700">Edit Fasilitas</h3>
        <a href="<?php echo e(route('admin.content.fasilitas.index')); ?>" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 transition">
            <i class="fas fa-arrow-left mr-2"></i>Kembali
        </a>
    </div>
    
    <div class="mt-8">
        <?php echo $__env->make('layouts.admin.messages', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        
        <div class="bg-white p-6 rounded-md shadow">
            <form action="<?php echo e(route('admin.content.fasilitas.update', $fasilitas->id)); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            
                <div class="mb-6">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Judul Fasilitas</label>
                    <input type="text" name="title" id="title" value="<?php echo e(old('title', $fasilitas->title)); ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200" required>
                    <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                
                <div class="mb-6">
                    <label for="short_description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Singkat</label>
                    <textarea name="short_description" id="short_description" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200"><?php echo e(old('short_description', $fasilitas->short_description)); ?></textarea>
                    <?php $__errorArgs = ['short_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                
                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Lengkap</label>
                    <textarea name="description" id="description" rows="10" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200"><?php echo e(old('description', $fasilitas->description)); ?></textarea>
                    <p class="text-xs text-gray-500 mt-1">HTML tags seperti &lt;b&gt;, &lt;i&gt;, &lt;ul&gt;, &lt;li&gt;, dll diperbolehkan.</p>
                    <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                <p class="text-xs text-gray-500 mt-1">Anda dapat menggunakan tag HTML untuk memformat teks</p>
            </div>
            
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Saat Ini</label>
                    <div class="mb-4">
                        <img src="<?php echo e($fasilitas->image_url); ?>" alt="Current Image" class="h-40 object-contain border rounded">
                    </div>
                    
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Upload Gambar Baru (Opsional)</label>
                    <div class="flex items-center justify-center w-full">
                        <label class="flex flex-col w-full h-32 border-2 border-dashed border-gray-300 rounded-lg hover:bg-gray-50 hover:border-gray-400 cursor-pointer">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6" id="image-preview-section">
                                <i class="fas fa-cloud-upload-alt text-2xl text-gray-400 mb-2"></i>
                                <p class="text-sm text-gray-500">Klik untuk upload gambar baru</p>
                                <p class="text-xs text-gray-400 mt-1">PNG, JPG, GIF, WEBP up to 2MB</p>
                            </div>
                            <input type="file" name="image" id="image" class="hidden" accept="image/*">
                        </label>
                    </div>
                    <div id="image-preview" class="mt-3 hidden">
                        <img src="" alt="Preview" class="h-40 object-contain">
                    </div>
                    <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                
                <div class="mb-6">
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select name="status" id="status" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200">
                        <option value="active" <?php echo e(old('status', $fasilitas->status) == 'active' ? 'selected' : ''); ?>>Active</option>
                        <option value="inactive" <?php echo e(old('status', $fasilitas->status) == 'inactive' ? 'selected' : ''); ?>>Inactive</option>
                    </select>
                    <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                
                <div class="flex justify-end">
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                        Update
                    </button>
                </div>
        </form>
        </div>
    </div>
</div>

<?php $__env->startSection('scripts'); ?>
<script>
    // Image preview functionality
    document.addEventListener('DOMContentLoaded', function() {
        const imageInput = document.getElementById('image');
        const imagePreview = document.getElementById('image-preview');
        const previewImg = imagePreview.querySelector('img');
        const previewSection = document.getElementById('image-preview-section');
        
        imageInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    previewImg.setAttribute('src', e.target.result);
                    imagePreview.classList.remove('hidden');
                    previewSection.classList.add('hidden');
                };
                
                reader.readAsDataURL(this.files[0]);
            }
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\klinik\resources\views/admin/fasilitas/edit.blade.php ENDPATH**/ ?>