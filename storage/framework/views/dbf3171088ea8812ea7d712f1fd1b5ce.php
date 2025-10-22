

<?php $__env->startSection('title', 'Jadwal Terapi'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-3">
    <!-- Header -->
    <div class="bg-white rounded-lg shadow-md p-3">
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-2">
            <div>
                <h1 class="text-lg font-bold text-gray-800">Jadwal Terapi - 30 Hari</h1>
                <p class="text-gray-600 text-sm">Lihat jadwal terapi untuk 30 hari ke depan</p>
            </div>
            
            <!-- Summary Stats -->
            <div class="flex gap-2">
                <div class="bg-blue-50 p-2 rounded text-center">
                    <div class="text-lg font-bold text-blue-600"><?php echo e($totalSesi); ?></div>
                    <div class="text-xs text-blue-500">Sesi</div>
                </div>
                <div class="bg-green-50 p-2 rounded text-center">
                    <div class="text-lg font-bold text-green-600"><?php echo e($totalPasien); ?></div>
                    <div class="text-xs text-green-500">Pasien</div>
                </div>
                <div class="bg-purple-50 p-2 rounded text-center">
                    <div class="text-lg font-bold text-purple-600"><?php echo e($totalTerapis); ?></div>
                    <div class="text-xs text-purple-500">Terapis</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Month Navigation & Filters -->
    <div class="bg-white rounded-lg shadow-md p-3">
        <!-- Month Navigation -->
        <div class="mb-3">
            <div class="flex justify-between items-center mb-2">
                <h3 class="text-base font-semibold text-gray-800">
                    <?php echo e($carbonDate->locale('id')->translatedFormat('F Y')); ?>

                </h3>
                <div class="flex gap-1">
                    <a href="<?php echo e(route('admin.jadwal.index', ['tanggal' => $carbonDate->copy()->subMonth()->format('Y-m-d')])); ?>" 
                       class="p-1.5 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded text-sm">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                    <a href="<?php echo e(route('admin.jadwal.index', ['tanggal' => Carbon\Carbon::today()->format('Y-m-d')])); ?>" 
                       class="px-2 py-1.5 text-xs bg-blue-100 text-blue-700 rounded hover:bg-blue-200">
                        Bulan Ini
                    </a>
                    <a href="<?php echo e(route('admin.jadwal.index', ['tanggal' => $carbonDate->copy()->addMonth()->format('Y-m-d')])); ?>" 
                       class="p-1.5 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded text-sm">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Search & Filter -->
        <div class="border-t pt-3">
            <form method="GET" action="<?php echo e(route('admin.jadwal.index')); ?>" class="flex gap-2">
                <input type="hidden" name="tanggal" value="<?php echo e($tanggal); ?>">
                
                <div class="flex-1">
                    <input type="text" 
                           name="search" 
                           value="<?php echo e($search); ?>" 
                           placeholder="Cari pasien, terapis, atau layanan..."
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-sm py-1.5">
                </div>
                
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1.5 rounded-md transition-colors text-sm">
                    <i class="fas fa-search mr-1"></i>Cari
                </button>
                
                <?php if($search): ?>
                    <a href="<?php echo e(route('admin.jadwal.index', ['tanggal' => $tanggal])); ?>" 
                       class="bg-gray-500 hover:bg-gray-600 text-white px-2 py-1.5 rounded-md transition-colors text-sm">
                        Reset
                    </a>
                <?php endif; ?>
            </form>
        </div>
    </div>

    <!-- 30-Day Schedule Display -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="p-2 bg-gray-50 border-b">
            <h3 class="text-base font-semibold text-gray-800">
                Jadwal 30 Hari - <?php echo e($monthDates[0]['carbonDate']->locale('id')->translatedFormat('d F')); ?> - <?php echo e($monthDates[29]['carbonDate']->locale('id')->translatedFormat('d F Y')); ?>

            </h3>
        </div>

        <!-- Top Scrollbar -->
        <div class="overflow-x-auto" id="top-scroll" style="height: 20px;">
            <div style="width: calc(80px + (30 * 256px)); height: 1px;"></div>
        </div>

        <!-- Horizontal Scrollable Schedule -->
        <div class="overflow-x-auto relative" id="main-scroll">
            <!-- Header with dates -->
            <div class="flex bg-gray-100 border-b sticky top-0 z-10" style="min-width: max-content;">
                <!-- Time column header - FIXED -->
                <div class="w-20 flex-shrink-0 p-2 border-r bg-gray-200 font-semibold text-xs text-center sticky left-0 z-20">
                    Jam
                </div>
                
                <!-- Date headers - SCROLLABLE -->
                <?php $__currentLoopData = $monthDates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dateInfo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $dayMapping = [
                            'Monday' => 'Sen',
                            'Tuesday' => 'Sel', 
                            'Wednesday' => 'Rab',
                            'Thursday' => 'Kam',
                            'Friday' => 'Jum',
                            'Saturday' => 'Sab',
                            'Sunday' => 'Min'
                        ];
                        $englishDay = $dateInfo['carbonDate']->format('l');
                        $indonesianDay = $dayMapping[$englishDay] ?? $englishDay;
                    ?>
                    <div class="w-64 flex-shrink-0 p-2 border-r text-center <?php echo e($dateInfo['isToday'] ? 'bg-blue-100 text-blue-700' : ($dateInfo['isSelected'] ? 'bg-blue-200 text-blue-800' : '')); ?>">
                        <div class="text-xs font-medium whitespace-nowrap">
                            <?php echo e($indonesianDay); ?> <?php echo e($dateInfo['dayNumber']); ?>

                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <!-- Schedule rows -->
            <?php $__currentLoopData = $jamSesi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="flex border-b hover:bg-gray-50" style="min-width: max-content;">
                    <!-- Time column - FIXED -->
                    <div class="w-20 flex-shrink-0 p-1 border-r bg-blue-50 text-blue-800 text-xs font-medium text-center flex items-center justify-center sticky left-0 z-10">
                        <?php echo e($jam); ?>

                    </div>
                    
                    <!-- Day columns - SCROLLABLE -->
                    <?php $__currentLoopData = $monthDates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dateInfo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="w-64 flex-shrink-0 p-1 border-r min-h-8 <?php echo e($dateInfo['isToday'] ? 'bg-blue-25' : ''); ?>">
                            <?php if(isset($jadwalTerstruktur[$dateInfo['date']][$jam]) && $jadwalTerstruktur[$dateInfo['date']][$jam]->count() > 0): ?>
                                <?php $__currentLoopData = $jadwalTerstruktur[$dateInfo['date']][$jam]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sesi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded px-2 py-0.5 mb-0.5 text-xs hover:shadow-md hover:bg-blue-100 transition-all cursor-pointer" 
                                         onclick="editSession(<?php echo e($sesi->id); ?>)">
                                        <!-- Single line format: Patient, Therapist, Service, Status -->
                                        <div class="text-xs whitespace-nowrap overflow-hidden">
                                            <span class="font-semibold text-gray-800"><?php echo e($sesi->nama_pasien); ?></span>, 
                                            <span class="text-gray-600"><?php echo e($sesi->nama_terapis ?? 'Belum ditentukan'); ?></span>, 
                                            <span class="text-purple-600"><?php echo e($sesi->nama_layanan); ?></span>, 
                                            <?php if($sesi->status == 'Sudah Dikerjakan'): ?>
                                                <span class="text-green-600 font-medium">Selesai</span>
                                            <?php elseif($sesi->status == 'Belum Dikerjakan'): ?>
                                                <span class="text-yellow-600 font-medium">Menunggu</span>
                                            <?php elseif($sesi->status == 'Cancelled'): ?>
                                                <span class="text-red-600 font-medium">Batal</span>
                                            <?php else: ?>
                                                <span class="text-gray-600 font-medium"><?php echo e($sesi->status ?? 'Unknown'); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <div class="text-gray-300 text-xs italic h-8 flex items-center justify-center hover:bg-gray-100 hover:text-gray-600 transition-all cursor-pointer border border-transparent hover:border-gray-300 rounded" 
                                     onclick="addSession('<?php echo e($dateInfo['date']); ?>', '<?php echo e($jam); ?>')">
                                    + Tambah Sesi
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            
            <!-- Footer with dates and days -->
            <div class="flex bg-gray-100 border-t-2 border-gray-300" style="min-width: max-content;">
                <!-- Time column footer - FIXED -->
                <div class="w-20 flex-shrink-0 p-2 border-r bg-gray-200 font-semibold text-xs text-center sticky left-0 z-10">
                    Jam
                </div>
                
                <!-- Date footers - SCROLLABLE -->
                <?php $__currentLoopData = $monthDates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dateInfo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $dayMapping = [
                            'Monday' => 'Sen',
                            'Tuesday' => 'Sel', 
                            'Wednesday' => 'Rab',
                            'Thursday' => 'Kam',
                            'Friday' => 'Jum',
                            'Saturday' => 'Sab',
                            'Sunday' => 'Min'
                        ];
                        $englishDay = $dateInfo['carbonDate']->format('l');
                        $indonesianDay = $dayMapping[$englishDay] ?? $englishDay;
                    ?>
                    <div class="w-64 flex-shrink-0 p-2 border-r text-center <?php echo e($dateInfo['isToday'] ? 'bg-blue-100 text-blue-700' : ($dateInfo['isSelected'] ? 'bg-blue-200 text-blue-800' : '')); ?>">
                        <div class="text-xs font-medium whitespace-nowrap">
                            <?php echo e($indonesianDay); ?> <?php echo e($dateInfo['dayNumber']); ?>

                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>

    <!-- Legend -->
    <div class="bg-white rounded-lg shadow-md p-3">
        <h4 class="text-sm font-semibold text-gray-800 mb-2">Format Display: Nama Pasien, Terapis, Layanan, Status</h4>
        <div class="flex gap-4 text-xs">
            <div class="flex items-center gap-1">
                <span class="text-green-600 font-medium">Selesai</span>
                <span class="text-gray-500">- Terapi sudah dikerjakan</span>
            </div>
            <div class="flex items-center gap-1">
                <span class="text-yellow-600 font-medium">Menunggu</span>
                <span class="text-gray-500">- Belum dikerjakan</span>
            </div>
            <div class="flex items-center gap-1">
                <span class="text-red-600 font-medium">Batal</span>
                <span class="text-gray-500">- Dibatalkan</span>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Edit/Add Session -->
<div id="sessionModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <!-- Modal Header -->
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold text-gray-900" id="modalTitle">Edit Sesi Terapi</h3>
                <button type="button" class="text-gray-400 hover:text-gray-600" onclick="closeModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- Modal Form -->
            <form id="sessionForm" method="POST">
                <?php echo csrf_field(); ?>
                <input type="hidden" id="sessionId" name="id">
                <input type="hidden" id="methodField" name="_method" value="PUT">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Patient Selection -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Pasien</label>
                        <select id="id_pasien" name="id_pasien" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200">
                            <option value="">Pilih Pasien</option>
                            <!-- Will be populated via AJAX -->
                        </select>
                    </div>

                    <!-- Therapist Selection -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Terapis</label>
                        <select id="id_terapis" name="id_terapis" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200">
                            <option value="">Pilih Terapis</option>
                            <!-- Will be populated via AJAX -->
                        </select>
                    </div>

                    <!-- Service Selection -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Layanan</label>
                        <select id="id_layanan" name="id_layanan" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200">
                            <option value="">Pilih Layanan</option>
                            <!-- Will be populated via AJAX -->
                        </select>
                    </div>

                    <!-- Branch Selection -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Cabang</label>
                        <select id="id_cabang" name="id_cabang" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200">
                            <option value="">Pilih Cabang</option>
                            <!-- Will be populated via AJAX -->
                        </select>
                    </div>

                    <!-- Date -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Terapi</label>
                        <input type="date" id="tanggal_terapi" name="tanggal_terapi" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200">
                    </div>

                    <!-- Time Session -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jam Sesi</label>
                        <select id="jam_sesi" name="jam_sesi" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200">
                            <option value="08.00-08.45">08.00-08.45</option>
                            <option value="08.45-09.30">08.45-09.30</option>
                            <option value="09.30-10.15">09.30-10.15</option>
                            <option value="10.15-11.00">10.15-11.00</option>
                            <option value="11.00-11.45">11.00-11.45</option>
                            <option value="11.45-12.30">11.45-12.30</option>
                            <option value="12.30-13.15">12.30-13.15</option>
                            <option value="13.15-14.00">13.15-14.00</option>
                            <option value="14.00-14.45">14.00-14.45</option>
                            <option value="14.45-15.30">14.45-15.30</option>
                            <option value="15.30-16.15">15.30-16.15</option>
                            <option value="16.15-17.00">16.15-17.00</option>
                            <option value="17.00-17.45">17.00-17.45</option>
                            <option value="17.45-18.30">17.45-18.30</option>
                        </select>
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select id="status" name="status" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200">
                            <option value="Belum Dikerjakan">Belum Dikerjakan</option>
                            <option value="Sudah Dikerjakan">Sudah Dikerjakan</option>
                            <option value="Cancelled">Cancelled</option>
                        </select>
                    </div>

                    <!-- Package Type -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Paket</label>
                        <select id="jenis_paket" name="jenis_paket" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200">
                            <option value="">Pilih Jenis Paket</option>
                            <option value="reguler_weekday">Reguler Weekday</option>
                            <option value="reguler_weekend">Reguler Weekend</option>
                            <option value="paket_weekday">Paket Weekday</option>
                            <option value="paket_weekend">Paket Weekend</option>
                        </select>
                    </div>
                </div>

                <!-- Notes -->
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Notes</label>
                    <textarea id="notes" name="notes" rows="3" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200" placeholder="Catatan terapi (opsional)"></textarea>
                </div>

                <!-- Home Advice -->
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Saran di Rumah</label>
                    <textarea id="saran_dirumah" name="saran_dirumah" rows="3" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200" placeholder="Saran untuk dilakukan di rumah (opsional)"></textarea>
                </div>

                <!-- Modal Actions -->
                <div class="flex justify-between items-center mt-6">
                    <button type="button" id="deleteBtn" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md transition-colors hidden">
                        <i class="fas fa-trash mr-2"></i>Hapus
                    </button>
                    <div class="flex gap-2">
                        <button type="button" onclick="closeModal()" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md transition-colors">
                            Batal
                        </button>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md transition-colors">
                            <i class="fas fa-save mr-2"></i>Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $__env->startPush('styles'); ?>
<style>
    .bg-blue-25 {
        background-color: rgba(219, 234, 254, 0.3);
    }
    
    /* Custom scrollbar for horizontal scroll */
    .overflow-x-auto::-webkit-scrollbar {
        height: 8px;
    }
    
    .overflow-x-auto::-webkit-scrollbar-track {
        background: #f1f5f9;
    }
    
    .overflow-x-auto::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 4px;
    }
    
    .overflow-x-auto::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
    
    /* Ensure minimum width for proper display */
    .overflow-x-auto {
        min-width: 100%;
    }
    
    /* Fix sticky positioning */
    .sticky-time-column {
        position: sticky !important;
        left: 0 !important;
        background: inherit !important;
        box-shadow: 2px 0 4px rgba(0,0,0,0.1);
    }
    
    /* Ensure table has proper width calculation */
    .schedule-table {
        width: calc(80px + (30 * 256px)); /* Time column + 30 day columns */
        min-width: calc(80px + (30 * 256px));
    }
    
    /* Top scrollbar styling */
    #top-scroll {
        border-bottom: 1px solid #e5e7eb;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
// Define base URL for API calls
const API_BASE_URL = '<?php echo e(url('/')); ?>';

document.addEventListener('DOMContentLoaded', function() {
    const topScroll = document.getElementById('top-scroll');
    const mainScroll = document.getElementById('main-scroll');
    
    // Sync main scroll to top scroll
    topScroll.addEventListener('scroll', function() {
        mainScroll.scrollLeft = topScroll.scrollLeft;
    });
    
    // Sync top scroll to main scroll
    mainScroll.addEventListener('scroll', function() {
        topScroll.scrollLeft = mainScroll.scrollLeft;
    });

    // Load dropdown data
    loadDropdownData();
});

// Load dropdown data for form - ASYNC VERSION TO PREVENT RACE CONDITION
async function loadDropdownData() {
    console.log('Loading dropdown data...');
    
    try {
        // Load all dropdowns in parallel
        const [patientsResponse, therapistsResponse, servicesResponse, branchesResponse] = await Promise.all([
            fetch(`${API_BASE_URL}/api/get-patients`),
            fetch(`${API_BASE_URL}/api/get-therapists`),
            fetch(`${API_BASE_URL}/api/get-services`),
            fetch(`${API_BASE_URL}/api/get-branches`)
        ]);

        // Process patients
        const patientsData = await patientsResponse.json();
        const patientsSelect = document.getElementById('id_pasien');
        patientsSelect.innerHTML = '<option value="">Pilih Pasien</option>';
        if (patientsData && Array.isArray(patientsData) && patientsData.length > 0) {
            patientsData.forEach(patient => {
                patientsSelect.innerHTML += `<option value="${patient.id_pasien}">${patient.nama_anak}</option>`;
            });
            console.log('✅ Loaded', patientsData.length, 'patients');
        } else {
            patientsSelect.innerHTML += '<option value="">Tidak ada pasien aktif</option>';
        }

        // Process therapists
        const therapistsData = await therapistsResponse.json();
        const therapistsSelect = document.getElementById('id_terapis');
        therapistsSelect.innerHTML = '<option value="">Pilih Terapis</option>';
        if (therapistsData && Array.isArray(therapistsData) && therapistsData.length > 0) {
            therapistsData.forEach(therapist => {
                therapistsSelect.innerHTML += `<option value="${therapist.id}">${therapist.name}</option>`;
            });
            console.log('✅ Loaded', therapistsData.length, 'therapists');
        } else {
            therapistsSelect.innerHTML += '<option value="">Tidak ada terapis</option>';
        }

        // Process services
        const servicesData = await servicesResponse.json();
        const servicesSelect = document.getElementById('id_layanan');
        servicesSelect.innerHTML = '<option value="">Pilih Layanan</option>';
        if (servicesData && Array.isArray(servicesData) && servicesData.length > 0) {
            servicesData.forEach(service => {
                servicesSelect.innerHTML += `<option value="${service.id}">${service.title}</option>`;
            });
            console.log('✅ Loaded', servicesData.length, 'services');
        } else {
            servicesSelect.innerHTML += '<option value="">Tidak ada layanan aktif</option>';
        }

        // Process branches
        const branchesData = await branchesResponse.json();
        const branchesSelect = document.getElementById('id_cabang');
        branchesSelect.innerHTML = '<option value="">Pilih Cabang</option>';
        if (branchesData && Array.isArray(branchesData) && branchesData.length > 0) {
            branchesData.forEach(branch => {
                branchesSelect.innerHTML += `<option value="${branch.id}">${branch.nama_cabang}</option>`;
            });
            console.log('✅ Loaded', branchesData.length, 'branches');
        } else {
            branchesSelect.innerHTML += '<option value="">Tidak ada cabang</option>';
        }

        console.log('🎉 All dropdown data loaded successfully!');
        return true; // Signal that loading is complete
        
    } catch (error) {
        console.error('❌ Error loading dropdown data:', error);
        
        // Set error messages in dropdowns
        ['id_pasien', 'id_terapis', 'id_layanan', 'id_cabang'].forEach(id => {
            const select = document.getElementById(id);
            if (select) {
                select.innerHTML = '<option value="">Error loading data</option>';
            }
        });
        return false;
    }
}

// Open modal for editing existing session - FIXED RACE CONDITION
async function editSession(sessionId) {
    console.log('🔄 Starting edit session for ID:', sessionId);
    
    // Set modal configuration first
    document.getElementById('modalTitle').textContent = 'Edit Sesi Terapi';
    document.getElementById('methodField').value = 'PUT';
    document.getElementById('sessionForm').action = `${API_BASE_URL}/admin/jadwal/${sessionId}`;
    document.getElementById('deleteBtn').classList.remove('hidden');
    
    // Show modal first with loading state
    document.getElementById('sessionModal').classList.remove('hidden');
    
    try {
        // Step 1: Load dropdown data and WAIT for it to complete
        console.log('📥 Loading dropdown data first...');
        const dropdownLoaded = await loadDropdownData();
        
        if (!dropdownLoaded) {
            throw new Error('Failed to load dropdown data');
        }
        
        // Step 2: Now load session data (after dropdown is ready)
        console.log('📋 Loading session data for ID:', sessionId);
        const response = await fetch(`${API_BASE_URL}/api/get-session/${sessionId}`);
        
        if (!response.ok) {
            throw new Error(`HTTP ${response.status}: ${response.statusText}`);
        }
        
        const data = await response.json();
        console.log('Session data received:', data);
        
        if (data && !data.error) {
            // Step 3: Populate form fields (dropdowns are already loaded)
            document.getElementById('sessionId').value = data.id || '';
            document.getElementById('id_pasien').value = data.id_pasien || '';
            document.getElementById('id_terapis').value = data.id_terapis || '';
            document.getElementById('id_layanan').value = data.id_layanan || '';
            document.getElementById('id_cabang').value = data.id_cabang || '';
            document.getElementById('tanggal_terapi').value = data.tanggal_terapi || '';
            document.getElementById('jam_sesi').value = data.jam_sesi || '';
            document.getElementById('status').value = data.status || 'Belum Dikerjakan';
            document.getElementById('jenis_paket').value = data.jenis_paket || '';
            document.getElementById('notes').value = data.notes || '';
            document.getElementById('saran_dirumah').value = data.saran_dirumah || '';
            
            console.log('✅ Session data loaded and form populated successfully!');
        } else {
            throw new Error(data.error || 'Invalid session data received');
        }
        
    } catch (error) {
        console.error('❌ Error in editSession:', error);
        alert('Gagal memuat data sesi: ' + error.message);
        
        // Don't close modal, user can still manually fill the form
        console.log('Modal remains open for manual data entry');
    }
}

// Open modal for adding new session
// Open modal for adding new session - ASYNC VERSION
async function addSession(date, time) {
    console.log('🆕 Adding new session for:', date, time);
    
    // Set modal configuration
    document.getElementById('modalTitle').textContent = 'Tambah Sesi Terapi Baru';
    document.getElementById('methodField').value = 'POST';
    document.getElementById('sessionForm').action = `${API_BASE_URL}/admin/jadwal`;
    document.getElementById('deleteBtn').classList.add('hidden');
    
    // Reset form first
    document.getElementById('sessionForm').reset();
    document.getElementById('sessionId').value = '';
    
    // Show modal
    document.getElementById('sessionModal').classList.remove('hidden');
    
    try {
        // Load dropdown data first
        console.log('📥 Loading dropdown data...');
        const dropdownLoaded = await loadDropdownData();
        
        if (!dropdownLoaded) {
            throw new Error('Failed to load dropdown data');
        }
        
        // Set default values after dropdowns are loaded
        document.getElementById('tanggal_terapi').value = date;
        document.getElementById('jam_sesi').value = time;
        document.getElementById('status').value = 'Belum Dikerjakan';
        document.getElementById('notes').value = '';
        document.getElementById('saran_dirumah').value = '';
        
        console.log('✅ New session form ready!');
        
    } catch (error) {
        console.error('❌ Error in addSession:', error);
        alert('Gagal memuat data dropdown: ' + error.message);
        // Keep modal open for manual entry
    }
}

// Close modal
function closeModal() {
    document.getElementById('sessionModal').classList.add('hidden');
}

// Handle form submission
document.getElementById('sessionForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const method = document.getElementById('methodField').value;
    
    fetch(this.action, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
            closeModal();
            location.reload(); // Refresh page to show updated data
        } else {
            alert(data.message || 'Terjadi kesalahan');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat menyimpan data');
    });
});

// Handle delete button
document.getElementById('deleteBtn').addEventListener('click', function() {
    if (confirm('Apakah Anda yakin ingin menghapus sesi terapi ini?')) {
        const sessionId = document.getElementById('sessionId').value;
        
        fetch(`/admin/jadwal/${sessionId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                closeModal();
                location.reload(); // Refresh page to show updated data
            } else {
                alert(data.message || 'Terjadi kesalahan');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menghapus data');
        });
    }
});

// Close modal when clicking outside
document.getElementById('sessionModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeModal();
    }
});
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\klinik\resources\views/admin/jadwal/index.blade.php ENDPATH**/ ?>