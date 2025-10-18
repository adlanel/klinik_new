<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Tailwind v3</title>
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
</head>
<body class="bg-gray-100">

    <!-- Include Navbar -->
    <?php echo $__env->make('components.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white shadow-lg rounded-xl p-8 text-center">
            <h1 class="text-3xl font-bold text-blue-600">Hello, Tailwind v3!</h1>
            <p class="mt-4 text-gray-700">Ini halaman untuk cek Tailwind di Laravel dengan Navbar dinamis.</p>
            <button class="mt-6 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                Klik Saya
            </button>
            
            <!-- Test Logo Info -->
            <div class="mt-8 p-4 bg-gray-50 rounded-lg">
                <h3 class="text-lg font-semibold mb-2">Logo Info:</h3>
                <?php if($currentLogo): ?>
                    <p class="text-green-600">✅ Logo ditemukan: <?php echo e($currentLogo->path); ?></p>
                    <p class="text-sm text-gray-600">Path: <?php echo e(asset('storage/logo/' . $currentLogo->path)); ?></p>
                <?php else: ?>
                    <p class="text-red-600">❌ Logo tidak ditemukan</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\klinik\resources\views/test.blade.php ENDPATH**/ ?>