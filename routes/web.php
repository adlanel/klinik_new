<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BcryptController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Redirect /dashboard to /admin for backward compatibility
Route::get('/dashboard', function() {
    return redirect('/admin');
});

// About Us Route
Route::get('/tentang-kami', [App\Http\Controllers\TentangKamiController::class, 'index'])->name('about.index');

// Layanan & Fasilitas Route
Route::get('/layanan-fasilitas', [App\Http\Controllers\LayananFasilitasController::class, 'index'])->name('layanan-fasilitas.index');

// Service Routes
Route::get('/layanan/{slug}', [App\Http\Controllers\ServiceController::class, 'show'])->name('service.show');

// News Routes
Route::get('/berita', [App\Http\Controllers\NewsController::class, 'index'])->name('news.index');
Route::get('/berita/{slug}', [App\Http\Controllers\NewsController::class, 'show'])->name('news.show');

// Branch & Contact Route
Route::get('/cabang-kontak', [App\Http\Controllers\CabangController::class, 'index'])->name('cabang-kontak.index');

// Appointment Route
Route::get('/buat-janji', [App\Http\Controllers\AppointmentController::class, 'index'])->name('appointment.index');

// Consultation Route
Route::post('/consultation', [App\Http\Controllers\ConsultationController::class, 'store'])->name('consultation.store');

Route::get('/test-tailwind', function () {
    return view('test');
});

// Simple working API routes without authentication
Route::get('/api/get-patients', function() {
    try {
        $patients = \DB::table('data_pasien')
            ->select('id_pasien', 'nama_anak', 'status_pasien')
            ->where('status_pasien', 'Aktif')
            ->orderBy('nama_anak')
            ->get();
        return response()->json($patients);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
});

Route::get('/api/get-therapists', function() {
    try {
        $therapists = \DB::table('users')
            ->select('id', 'name')
            ->where('role', 'terapis')
            ->orderBy('name')
            ->get();
        return response()->json($therapists);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
});

Route::get('/api/get-services', function() {
    try {
        $services = \DB::table('layanan')
            ->select('id', 'title')
            ->where('status', 'active')
            ->orderBy('title')
            ->get();
        return response()->json($services);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
});

Route::get('/api/get-branches', function() {
    try {
        $branches = \DB::table('cabang')
            ->select('id', 'nama_cabang')
            ->orderBy('nama_cabang')
            ->get();
        return response()->json($branches);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
});

Route::get('/api/get-session/{id}', function($id) {
    try {
        $session = \DB::table('history_terapi')
            ->where('id', $id)
            ->first();
        
        if (!$session) {
            return response()->json(['error' => 'Session not found'], 404);
        }
        
        return response()->json($session);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
});

// Debug route untuk test data
Route::get('/api/debug-data', function() {
    return response()->json([
        'patients_count' => \DB::table('data_pasien')->count(),
        'active_patients_count' => \DB::table('data_pasien')->where('status_pasien', 'Aktif')->count(),
        'therapists_count' => \DB::table('users')->where('role', 'terapis')->count(),
        'services_count' => \DB::table('layanan')->where('status', 'active')->count(),
        'branches_count' => \DB::table('cabang')->count(),
        'sessions_count' => \DB::table('history_terapi')->count(),
        'sample_patient' => \DB::table('data_pasien')->where('status_pasien', 'Aktif')->first(),
        'sample_therapist' => \DB::table('users')->where('role', 'terapis')->first(),
        'sample_service' => \DB::table('layanan')->where('status', 'active')->first(),
        'sample_branch' => \DB::table('cabang')->first()
    ]);
});

// Login Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Test API Routes (temporary - remove these later)
Route::get('/test-api/patients', function() {
    try {
        $patients = DB::table('data_pasien')
            ->select('id_pasien', 'nama_anak')
            ->orderBy('nama_anak')
            ->get();
        return response()->json($patients);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
});
Route::get('/test-api/therapists', function() {
    try {
        $therapists = DB::table('users')
            ->select('id', 'name')
            ->where('role', 'terapis')
            ->orderBy('name')
            ->get();
        return response()->json($therapists);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
});
Route::get('/test-api/services', function() {
    try {
        $services = DB::table('layanan')
            ->select('id', 'title')
            ->orderBy('title')
            ->get();
        return response()->json($services);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
});
Route::get('/test-api/branches', function() {
    try {
        $branches = DB::table('cabang')
            ->select('id', 'nama_cabang')
            ->orderBy('nama_cabang')
            ->get();
        return response()->json($branches);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
});
Route::get('/test-api/jadwal/{id}/edit', function($id) {
    try {
        $session = DB::table('history_terapi')
            ->where('id', $id)
            ->first();
        
        if (!$session) {
            return response()->json(['error' => 'Session not found'], 404);
        }
        
        return response()->json($session);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
});

// Simple test routes
Route::get('/test-simple', function() {
    return response()->json(['message' => 'Test route works']);
});
Route::get('/test-services', function() {
    try {
        $services = DB::table('layanan')->select('id', 'title')->get();
        return response()->json($services);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
});
Route::get('/test-branches', function() {
    try {
        $branches = DB::table('cabang')->select('id', 'nama_cabang')->get();
        return response()->json($branches);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
});
Route::get('/test-debug', function() {
    return response()->json([
        'patients_count' => DB::table('data_pasien')->count(),
        'therapists_count' => DB::table('users')->where('role', 'terapis')->count(),
        'services_count' => DB::table('layanan')->count(),
        'branches_count' => DB::table('cabang')->count()
    ]);
});

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    // Patient Management Routes
    Route::resource('patients', App\Http\Controllers\Admin\PatientController::class);
    Route::get('patients/{id}/history', [App\Http\Controllers\Admin\PatientController::class, 'showHistory'])->name('patients.history');
    Route::get('patients/{patient}/history/{history}/detail', [App\Http\Controllers\Admin\PatientController::class, 'showHistoryDetail'])->name('patients.history.detail');
    Route::get('patients/{patient}/history/{history}/pdf', [App\Http\Controllers\Admin\PatientController::class, 'downloadHistoryPDF'])->name('patients.history.pdf');
    
    // Jadwal Routes
    Route::get('jadwal', [App\Http\Controllers\Admin\JadwalController::class, 'index'])->name('jadwal.index');
    Route::post('jadwal', [App\Http\Controllers\Admin\JadwalController::class, 'store'])->name('jadwal.store');
    Route::get('jadwal/{id}/edit', [App\Http\Controllers\Admin\JadwalController::class, 'edit'])->name('jadwal.edit');
    Route::put('jadwal/{id}', [App\Http\Controllers\Admin\JadwalController::class, 'update'])->name('jadwal.update');
    Route::delete('jadwal/{id}', [App\Http\Controllers\Admin\JadwalController::class, 'destroy'])->name('jadwal.destroy');
    
    // API Routes for dropdown data
    Route::get('api/patients', [App\Http\Controllers\Admin\JadwalController::class, 'getPatients'])->name('api.patients');
    Route::get('api/therapists', [App\Http\Controllers\Admin\JadwalController::class, 'getTherapists'])->name('api.therapists');
    Route::get('api/services', [App\Http\Controllers\Admin\JadwalController::class, 'getServices'])->name('api.services');
    Route::get('api/branches', [App\Http\Controllers\Admin\JadwalController::class, 'getBranches'])->name('api.branches');
    
    // Appointment Management Routes
    Route::resource('appointments', App\Http\Controllers\Admin\AppointmentController::class);
    Route::post('appointments/{id}/status', [App\Http\Controllers\Admin\AppointmentController::class, 'updateStatus'])
        ->name('appointments.update-status'); // Route name matches what we use in views
    
    // Profile Routes
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'show'])->name('show');
        Route::put('/', [ProfileController::class, 'update'])->name('update');
        Route::get('/password', [ProfileController::class, 'showChangePasswordForm'])->name('password.edit');
        Route::put('/password', [ProfileController::class, 'updatePassword'])->name('password.update');
    });
    
    // Image Upload Route for CKEditor
    Route::post('upload-image', [App\Http\Controllers\Admin\UploadController::class, 'uploadImage'])->name('upload.image');
    
    // Content Management Routes
    Route::prefix('content')->name('content.')->group(function () {
        Route::get('/', function () {
            return view('admin.content.index');
        })->name('index');
        
        // Logo Management Routes
        Route::resource('logos', App\Http\Controllers\Admin\LogoController::class)->except(['show', 'edit', 'update']);
        
        // Banner Management Routes
        Route::resource('banners', App\Http\Controllers\Admin\BannerController::class);
        Route::post('banners/update-order', [App\Http\Controllers\Admin\BannerController::class, 'updateOrder'])->name('banners.update-order');
        
        // About Us Management Routes
        Route::get('aboutus', [App\Http\Controllers\Admin\AboutUsController::class, 'index'])->name('aboutus.index');
        Route::post('aboutus', [App\Http\Controllers\Admin\AboutUsController::class, 'update'])->name('aboutus.update');
        
        // Layanan Management Routes
        Route::resource('layanan', App\Http\Controllers\Admin\LayananController::class);
        
        // Fasilitas Management Routes
        Route::resource('fasilitas', App\Http\Controllers\Admin\FasilitasController::class);
        
        // News Management Routes
        Route::resource('news', App\Http\Controllers\Admin\NewsController::class);
        
        // Branch Management Routes
        Route::resource('branches', App\Http\Controllers\Admin\BranchController::class);
    });
    
    // User Management Routes
    Route::middleware(['admin'])->group(function () {
        Route::resource('users', App\Http\Controllers\Admin\UserController::class);
        Route::get('users/{user}/change-password', [App\Http\Controllers\Admin\UserController::class, 'changePassword'])
            ->name('users.change-password');
        Route::put('users/{user}/update-password', [App\Http\Controllers\Admin\UserController::class, 'updatePassword'])
            ->name('users.update-password');
    });
    
    // Settings Routes
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', function () {
            return view('admin.settings.index');
        })->name('index');
    });
});

// Bcrypt generator routes
Route::get('/bcrypt', [BcryptController::class, 'index'])->name('bcrypt.form');
Route::post('/bcrypt', [BcryptController::class, 'generate'])->name('bcrypt.generate');

// Protected Routes (require authentication)
Route::middleware('auth')->group(function () {
    // Admin only routes
    Route::middleware('admin')->group(function () {
        // This route is redundant since we have the admin.dashboard route
        // Route::get('/dashboard', function () {
        //     return view('pages.admin.dashboard');
        // })->name('dashboard');
        
        Route::get('/admin/settings', function () {
            return view('pages.admin.settings');
        })->name('admin.settings');
    });
    
    // Routes for other roles (akan dibuat nanti)
    Route::get('/kepala-terapis/dashboard', function () {
        return view('pages.kepala-terapis.dashboard');
    })->name('kepala-terapis.dashboard');
    
    Route::get('/terapis/dashboard', function () {
        return view('pages.terapis.dashboard');
    })->name('terapis.dashboard');

    // Terapis routes: map to terapis-specific pages
    Route::prefix('terapis')->name('terapis.')->group(function () {
        // Dashboard main page
        Route::get('/', function () {
            return view('pages.terapis.dashboard');
        })->name('dashboard');

        // Jadwal Tugas - menampilkan history_terapi sesuai terapis yang login
        Route::get('jadwal-tugas', function (Illuminate\Http\Request $request) {
            $therapistId = auth()->id();
            
            $query = \DB::table('history_terapi')
                ->leftJoin('data_pasien', 'history_terapi.id_pasien', '=', 'data_pasien.id_pasien')
                ->leftJoin('layanan', 'history_terapi.id_layanan', '=', 'layanan.id')
                ->leftJoin('cabang', 'history_terapi.id_cabang', '=', 'cabang.id')
                ->leftJoin('users', 'history_terapi.id_terapis', '=', 'users.id')
                ->select(
                    'history_terapi.*',
                    'data_pasien.nama_anak as nama_pasien',
                    'layanan.title as nama_layanan',
                    'cabang.nama_cabang',
                    'users.name as nama_terapis'
                )
                ->where('history_terapi.id_terapis', $therapistId);
            
            // Filter by date
            if ($request->has('tanggal') && $request->tanggal != '') {
                $query->whereDate('history_terapi.tanggal_terapi', $request->tanggal);
            }
            
            // Filter by status
            if ($request->has('status') && $request->status != '') {
                $query->where('history_terapi.status', $request->status);
            }
            
            // Search by patient name
            if ($request->has('search') && $request->search != '') {
                $search = $request->search;
                $query->where('data_pasien.nama_anak', 'like', "%{$search}%");
            }
            
            // Order by date and time
            $query->orderBy('history_terapi.tanggal_terapi', 'desc')
                  ->orderBy('history_terapi.jam_sesi', 'asc');
            
            $jadwalTugas = collect($query->get());
            
            return view('pages.terapis.jadwal-tugas.index', compact('jadwalTugas'));
        })->name('jadwal-tugas.index');

        // Jadwal Tugas CRUD routes (tanpa delete untuk menjaga integritas data medis)
        Route::get('jadwal-tugas/{id}', [App\Http\Controllers\Terapis\JadwalTugasController::class, 'show'])->name('jadwal-tugas.show');
        Route::get('jadwal-tugas/{id}/edit', [App\Http\Controllers\Terapis\JadwalTugasController::class, 'edit'])->name('jadwal-tugas.edit');
        Route::put('jadwal-tugas/{id}', [App\Http\Controllers\Terapis\JadwalTugasController::class, 'update'])->name('jadwal-tugas.update');
        Route::get('jadwal-tugas/{id}/pdf', [App\Http\Controllers\Terapis\JadwalTugasController::class, 'downloadPDF'])->name('jadwal-tugas.pdf');

        // Appointment management routes
        Route::get('appointments', function (Illuminate\Http\Request $request) {
            $query = App\Models\Consultation::query();
            
            // Filter by status
            if ($request->has('status') && $request->status != '') {
                $query->where('status', $request->status);
            }
            
            // Filter by date
            if ($request->has('meeting_date') && $request->meeting_date != '') {
                $query->whereDate('meeting_date', $request->meeting_date);
            }
            
            // Search by patient name or phone
            if ($request->has('search') && $request->search != '') {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('patient_name', 'like', "%{$search}%")
                      ->orWhere('phone', 'like', "%{$search}%");
                });
            }
            
            // Filter by branch
            if ($request->has('cabang_id') && $request->cabang_id != '') {
                $query->where('cabang_id', $request->cabang_id);
            }
            
            // Sort by date
            $query->orderBy('meeting_date', $request->has('sort') ? $request->sort : 'desc');
            
            $appointments = $query->paginate(10);
            
            return view('pages.terapis.appointments.index', compact('appointments'));
        })->name('appointments.index');

        Route::get('appointments/create', function () {
            $branches = App\Models\Cabang::all();
            return view('pages.terapis.appointments.create', compact('branches'));
        })->name('appointments.create');

        Route::post('appointments', [App\Http\Controllers\Terapis\AppointmentController::class, 'store'])
            ->name('appointments.store');

        Route::get('appointments/{id}', function ($id) {
            $appointment = App\Models\Consultation::findOrFail($id);
            return view('pages.terapis.appointments.show', compact('appointment'));
        })->name('appointments.show');

        Route::get('appointments/{id}/edit', function ($id) {
            $appointment = App\Models\Consultation::findOrFail($id);
            $branches = App\Models\Cabang::all();
            return view('pages.terapis.appointments.edit', compact('appointment', 'branches'));
        })->name('appointments.edit');

        Route::put('appointments/{id}', [App\Http\Controllers\Terapis\AppointmentController::class, 'update'])
            ->name('appointments.update');

        Route::delete('appointments/{id}', [App\Http\Controllers\Terapis\AppointmentController::class, 'destroy'])
            ->name('appointments.destroy');

        Route::post('appointments/{id}/status', [App\Http\Controllers\Terapis\AppointmentController::class, 'updateStatus'])
            ->name('appointments.update-status');

        // Patient management routes
        Route::get('patients', function (Illuminate\Http\Request $request) {
            $query = App\Models\DataPasien::query();
            
            // Search functionality
            if ($request->has('search')) {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('nama_anak', 'like', "%{$search}%")
                      ->orWhere('nama_orang_tua', 'like', "%{$search}%")
                      ->orWhere('telepon', 'like', "%{$search}%");
                });
            }
            
            // Filter by status
            if ($request->has('status') && $request->status != 'all') {
                $query->where('status_pasien', $request->status);
            }
            
            // Filter by branch
            if ($request->has('cabang') && $request->cabang != 'all') {
                $query->where('id_cabang', $request->cabang);
            }
            
            // Order by
            $query->orderBy('nama_anak', 'asc');
            
            $patients = $query->paginate(10);
            $branches = App\Models\Cabang::all();
            
            return view('pages.terapis.patients.index', compact('patients', 'branches'));
        })->name('patients.index');
        
        Route::get('patients/create', function () {
            $branches = App\Models\Cabang::all();
            return view('pages.terapis.patients.create', compact('branches'));
        })->name('patients.create');

        Route::post('patients', [App\Http\Controllers\Terapis\PatientController::class, 'store'])
            ->name('patients.store');

        Route::get('patients/{id}', function ($id) {
            $patient = App\Models\DataPasien::with('cabang')->findOrFail($id);
            return view('pages.terapis.patients.show', compact('patient'));
        })->name('patients.show');

        Route::get('patients/{id}/edit', function ($id) {
            $patient = App\Models\DataPasien::findOrFail($id);
            $branches = App\Models\Cabang::all();
            return view('pages.terapis.patients.edit', compact('patient', 'branches'));
        })->name('patients.edit');

        Route::put('patients/{id}', [App\Http\Controllers\Terapis\PatientController::class, 'update'])
            ->name('patients.update');

        Route::delete('patients/{id}', [App\Http\Controllers\Terapis\PatientController::class, 'destroy'])
            ->name('patients.destroy');

        Route::get('patients/{id}/history', [App\Http\Controllers\Terapis\PatientController::class, 'showHistory'])->name('patients.history');
        Route::get('patients/{patient}/history/{history}/detail', [App\Http\Controllers\Terapis\PatientController::class, 'showHistoryDetail'])->name('patients.history.detail');
        Route::get('patients/{patient}/history/{history}/pdf', [App\Http\Controllers\Terapis\PatientController::class, 'downloadHistoryPDF'])->name('patients.history.pdf');

        // Terapis profile
        Route::get('profile', [App\Http\Controllers\Terapis\ProfileController::class, 'show'])->name('profile.show');
        Route::put('profile', [App\Http\Controllers\Terapis\ProfileController::class, 'update'])->name('profile.update');
        Route::get('profile/password', [App\Http\Controllers\Terapis\ProfileController::class, 'showChangePasswordForm'])->name('profile.password.edit');
        Route::put('profile/password', [App\Http\Controllers\Terapis\ProfileController::class, 'updatePassword'])->name('profile.password.update');
    });
});

