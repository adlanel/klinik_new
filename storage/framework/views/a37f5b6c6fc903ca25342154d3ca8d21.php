<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="container px-6 py-8 mx-auto max-w-8xl">
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-semibold text-gray-800">Dashboard</h1>
            <p class="text-gray-600 mt-2">Selamat datang, <?php echo e(Auth::user()->name); ?></p>
        </div>
        <div class="text-right">
            <p class="text-sm text-gray-500"><?php echo e(now()->format('l, d F Y')); ?></p>
            <p class="text-xs text-gray-400">Terakhir diperbarui: <?php echo e(now()->format('H:i')); ?></p>
        </div>
    </div>

    <!-- Main Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Appointments Card -->
        <div class="bg-white overflow-hidden rounded-lg shadow-lg border-l-4 border-blue-500">
            <div class="p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Konsultasi</p>
                        <p class="text-3xl font-bold text-gray-800 mt-1"><?php echo e($totalAppointments); ?></p>
                    </div>
                    <div class="bg-blue-100 rounded-full p-3">
                        <i class="fas fa-calendar-check text-xl text-blue-600"></i>
                    </div>
                </div>
                <div class="mt-5">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <span class="<?php echo e($percentageChange >= 0 ? 'text-green-600' : 'text-red-600'); ?> flex items-center font-medium">
                                <i class="fas fa-<?php echo e($percentageChange >= 0 ? 'arrow-up' : 'arrow-down'); ?> mr-1"></i>
                                <?php echo e(abs(round($percentageChange))); ?>%
                            </span>
                            <span class="ml-2 text-xs text-gray-500">dari bulan lalu</span>
                        </div>
                        <a href="<?php echo e(route('admin.appointments.index')); ?>" class="text-xs text-blue-600 hover:text-blue-800 font-medium">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-6 py-2">
                <div class="h-2 w-full bg-gray-200 rounded-full overflow-hidden">
                    <div class="h-full bg-blue-500 rounded-full" style="width: <?php echo e(min(100, max(5, abs(round($percentageChange))))); ?>%"></div>
                </div>
            </div>
        </div>
        
        <!-- Patients Card -->
        <div class="bg-white overflow-hidden rounded-lg shadow-lg border-l-4 border-green-500">
            <div class="p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Pasien</p>
                        <p class="text-3xl font-bold text-gray-800 mt-1"><?php echo e($totalPatients); ?></p>
                    </div>
                    <div class="bg-green-100 rounded-full p-3">
                        <i class="fas fa-user-injured text-xl text-green-600"></i>
                    </div>
                </div>
                <div class="mt-5">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <span class="text-gray-500 text-sm">Data Pasien </span>
                        </div>
                        <a href="<?php echo e(route('admin.patients.index')); ?>" class="text-xs text-green-600 hover:text-green-800 font-medium">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-6 py-2">
                <div class="h-2 w-full bg-gray-200 rounded-full overflow-hidden">
                    <div class="h-full bg-green-500 rounded-full" style="width: 100%"></div>
                </div>
            </div>
        </div>

        <!-- News Card -->
        <div class="bg-white overflow-hidden rounded-lg shadow-lg border-l-4 border-purple-500">
            <div class="p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Berita & Artikel</p>
                        <p class="text-3xl font-bold text-gray-800 mt-1"><?php echo e($totalNews); ?></p>
                    </div>
                    <div class="bg-purple-100 rounded-full p-3">
                        <i class="fas fa-newspaper text-xl text-purple-600"></i>
                    </div>
                </div>
                <div class="mt-5">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <span class="flex items-center font-medium text-green-600">
                                <i class="fas fa-check-circle mr-1"></i>
                                <?php echo e($publishedNews); ?>

                            </span>
                            <span class="ml-1 text-xs text-gray-500">Artikel Aktif</span>
                        </div>
                        <a href="<?php echo e(route('admin.content.news.index')); ?>" class="text-xs text-purple-600 hover:text-purple-800 font-medium">
                            Kelola
                        </a>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-6 py-2">
                <div class="h-2 w-full bg-gray-200 rounded-full overflow-hidden">
                    <div class="h-full bg-purple-500 rounded-full" style="width: 100%"></div>
                </div>
            </div>
        </div>

        <!-- Cabang Card -->
        <div class="bg-white overflow-hidden rounded-lg shadow-lg border-l-4 border-yellow-500">
            <div class="p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Cabang</p>
                        <p class="text-3xl font-bold text-gray-800 mt-1"><?php echo e($totalCabang); ?></p>
                    </div>
                    <div class="bg-yellow-100 rounded-full p-3">
                        <i class="fas fa-hospital-alt text-xl text-yellow-600"></i>
                    </div>
                </div>
                <div class="mt-5">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <span class="flex items-center font-medium text-yellow-600">
                                <i class="fas fa-map-marker-alt mr-1"></i>
                                <?php echo e($totalCabang); ?>

                            </span>
                            <span class="ml-2 text-xs text-gray-500">Lokasi Tersedia</span>
                        </div>
                        <a href="<?php echo e(route('admin.content.branches.index')); ?>" class="text-xs text-yellow-600 hover:text-yellow-800 font-medium">
                            Kelola
                        </a>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-6 py-2">
                <div class="h-2 w-full bg-gray-200 rounded-full overflow-hidden">
                    <div class="h-full bg-yellow-500 rounded-full" style="width: 100%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Secondary Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Active Patients -->
        <div class="bg-white rounded-lg shadow-md p-6 border-t-4 border-green-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Pasien Aktif</p>
                    <p class="text-xl font-bold text-gray-800"><?php echo e($activePatients); ?></p>
                </div>
                <div class="text-green-500">
                    <i class="fas fa-user-check text-xl"></i>
                </div>
            </div>
            <div class="mt-4 text-sm font-medium text-gray-500">
                <?php echo e(round(($activePatients/$totalPatients) * 100)); ?>% dari total pasien
            </div>
        </div>

        <!-- Pending Appointments -->
        <div class="bg-white rounded-lg shadow-md p-6 border-t-4 border-yellow-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Konsultasi Pending</p>
                    <p class="text-xl font-bold text-gray-800"><?php echo e($pendingAppointments); ?></p>
                </div>
                <div class="text-yellow-500">
                    <i class="fas fa-clock text-xl"></i>
                </div>
            </div>
            <div class="mt-4 text-sm font-medium text-gray-500">
                <?php echo e($pendingAppointments > 0 ? 'Perlu ditinjau' : 'Tidak ada yang pending'); ?>

            </div>
        </div>

        <!-- Layanan Count -->
        <div class="bg-white rounded-lg shadow-md p-6 border-t-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Layanan</p>
                    <p class="text-xl font-bold text-gray-800"><?php echo e($totalLayanan); ?></p>
                </div>
                <div class="text-blue-500">
                    <i class="fas fa-hands-helping text-xl"></i>
                </div>
            </div>
            <div class="mt-4 text-sm font-medium text-gray-500">
                Layanan tersedia
            </div>
        </div>

        <!-- Fasilitas Count -->
        <div class="bg-white rounded-lg shadow-md p-6 border-t-4 border-indigo-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Fasilitas</p>
                    <p class="text-xl font-bold text-gray-800"><?php echo e($totalFasilitas); ?></p>
                </div>
                <div class="text-indigo-500">
                    <i class="fas fa-building text-xl"></i>
                </div>
            </div>
            <div class="mt-4 text-sm font-medium text-gray-500">
                Fasilitas tersedia
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 mb-8">
        <!-- Recent Appointments -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                <h2 class="text-lg font-semibold text-gray-800">Konsultasi Terbaru</h2>
                <div>
                    <a href="<?php echo e(route('admin.appointments.index')); ?>" class="text-blue-600 hover:text-blue-800 text-sm font-medium inline-flex items-center">
                        <span>Semua Konsultasi</span>
                        <i class="fas fa-chevron-right ml-1 text-xs"></i>
                    </a>
                </div>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pasien</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cabang</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php $__empty_1 = true; $__currentLoopData = $recentAppointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900"><?php echo e($appointment->patient_name); ?></div>
                                    <div class="text-sm text-gray-500"><?php echo e($appointment->phone); ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900"><?php echo e($appointment->cabang ? $appointment->cabang->nama_cabang : 'N/A'); ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900"><?php echo e(\Carbon\Carbon::parse($appointment->meeting_date)->format('d M Y')); ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php if($appointment->status == 'pending'): ?>
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            Pending
                                        </span>
                                    <?php elseif($appointment->status == 'approved'): ?>
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Approved
                                        </span>
                                    <?php else: ?>
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Rejected
                                        </span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">
                                    Tidak ada data konsultasi
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            
           
        </div>
    </div>
    
    <div class="grid grid-cols-1 gap-6">
        <!-- Branch Statistics -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-semibold text-gray-800">Statistik Cabang</h2>
                <a href="<?php echo e(route('admin.content.branches.index')); ?>" class="text-blue-500 text-sm hover:underline flex items-center">
                    <span>Kelola Cabang</span>
                    <i class="fas fa-chevron-right ml-1 text-xs"></i>
                </a>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cabang</th>
                            <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pasien</th>
                            <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Konsultasi</th>
                            <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php $__empty_1 = true; $__currentLoopData = $branchStatistics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="px-3 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900"><?php echo e($branch->nama_cabang); ?></div>
                            </td>
                            <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo e($branch->patients_count ?? 0); ?></td>
                            <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo e($branch->consultations_count ?? 0); ?></td>
                            <td class="px-3 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Aktif
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="4" class="px-3 py-4 text-center text-sm text-gray-500">
                                Tidak ada data cabang
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php if(isset($section) && $section == 'appointments'): ?>
    <div class="mt-8 bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold mb-6 text-gray-800">Manajemen Janji Konsultasi</h2>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Pasien</th>
                        <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cabang</th>
                        <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Kelamin</th>
                        <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keluhan</th>
                        <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <!-- Data janji konsultasi akan ditampilkan di sini -->
                    <?php for($i = 0; $i < 5; $i++): ?>
                    <tr>
                        <td class="px-3 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">adlan el</div>
                            <div class="text-xs text-gray-500">081386607778</div>
                        </td>
                        <td class="px-3 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">15 Okt 2025</div>
                        </td>
                        <td class="px-3 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">Cabang Bogor</div>
                        </td>
                        <td class="px-3 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">Laki-laki</div>
                        </td>
                        <td class="px-3 py-4 whitespace-nowrap max-w-xs overflow-hidden">
                            <div class="text-sm text-gray-900 truncate">Belum Bisa Bicara</div>
                        </td>
                        <td class="px-3 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                Pending
                            </span>
                        </td>
                        <td class="px-3 py-4 whitespace-nowrap text-sm">
                            <a href="#" class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                            <a href="#" class="text-red-600 hover:text-red-900">Hapus</a>
                        </td>
                    </tr>
                    <?php endfor; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php endif; ?>

<?php if(isset($section) && $section == 'patients'): ?>
    <div class="mt-8 bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold mb-6 text-gray-800">Manajemen Data Pasien</h2>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Anak</th>
                        <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Orang Tua</th>
                        <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Kelamin</th>
                        <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Usia</th>
                        <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cabang</th>
                        <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Terapi</th>
                        <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <!-- Data pasien akan ditampilkan di sini -->
                    <tr>
                        <td class="px-3 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">Alya Putri</div>
                        </td>
                        <td class="px-3 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">Budi Santoso</div>
                            <div class="text-xs text-gray-500">081234567890</div>
                        </td>
                        <td class="px-3 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">Perempuan</div>
                        </td>
                        <td class="px-3 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">8 tahun</div>
                        </td>
                        <td class="px-3 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">Cabang Ceger</div>
                        </td>
                        <td class="px-3 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">Terapi Wicara</div>
                        </td>
                        <td class="px-3 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Aktif
                            </span>
                        </td>
                        <td class="px-3 py-4 whitespace-nowrap text-sm">
                            <a href="#" class="text-blue-600 hover:text-blue-900 mr-3">Detail</a>
                            <a href="#" class="text-green-600 hover:text-green-900">Edit</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
<?php endif; ?>

<?php if(isset($section) && $section == 'users'): ?>
    <div class="mt-8 bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold mb-6 text-gray-800">Manajemen Pengguna</h2>
        
        <div class="mb-6 flex justify-between items-center">
            <div class="w-1/3">
                <input type="text" placeholder="Cari pengguna..." class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
            </div>
            
            <a href="#" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                <i class="fas fa-plus mr-2"></i>Tambah Pengguna
            </a>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                        <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Telepon</th>
                        <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Peran</th>
                        <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pendidikan</th>
                        <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bidang</th>
                        <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <!-- Data pengguna akan ditampilkan di sini -->
                    <tr>
                        <td class="px-3 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">adlan</div>
                        </td>
                        <td class="px-3 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">adlanel441@gmail.com</div>
                        </td>
                        <td class="px-3 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">081386697778</div>
                        </td>
                        <td class="px-3 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                Admin
                            </span>
                        </td>
                        <td class="px-3 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">S1 Kedokteran</div>
                        </td>
                        <td class="px-3 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">Non Terapis</div>
                        </td>
                        <td class="px-3 py-4 whitespace-nowrap text-sm">
                            <a href="#" class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                            <a href="#" class="text-red-600 hover:text-red-900">Hapus</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp2\htdocs\klinik\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>