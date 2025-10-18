<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Al-Fatih Center - Pusat Tumbuh Kembang Anak dengan berbagai layanan terapi profesional">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Al-Fatih Center'); ?></title>
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo e(asset('favicon.ico')); ?>" type="image/x-icon">
    
    <!-- CSS -->
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
    
    <!-- Additional styles -->
    <?php echo $__env->yieldPushContent('styles'); ?>
    
    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="flex flex-col min-h-screen bg-gray-50">
    <!-- Include the existing navbar -->
    <?php echo $__env->make('components.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!-- Main Content -->
    <main class="flex-grow">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <!-- Footer -->
    <?php echo $__env->make('components.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!-- Scripts -->
    
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html><?php /**PATH C:\xampp\htdocs\klinik\resources\views/layouts/app.blade.php ENDPATH**/ ?>