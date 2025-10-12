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

// Login Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    // Patient Management Routes
    Route::resource('patients', App\Http\Controllers\Admin\PatientController::class);
    
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

        // Terapis profile
        Route::get('profile', [App\Http\Controllers\Terapis\ProfileController::class, 'show'])->name('profile.show');
        Route::put('profile', [App\Http\Controllers\Terapis\ProfileController::class, 'update'])->name('profile.update');
        Route::get('profile/password', [App\Http\Controllers\Terapis\ProfileController::class, 'showChangePasswordForm'])->name('profile.password.edit');
        Route::put('profile/password', [App\Http\Controllers\Terapis\ProfileController::class, 'updatePassword'])->name('profile.password.update');
    });
});

