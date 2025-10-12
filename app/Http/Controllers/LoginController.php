<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class LoginController extends Controller
{
    /**
     * Show the login form
     */
    public function showLoginForm()
    {
        return view('login');
    }

    /**
     * Process login request
     */
    public function login(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 6 karakter',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput($request->only('email'));
        }

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        // Debug login attempt
        \Log::info('Login attempt', [
            'email' => $credentials['email'],
            'remember' => $remember
        ]);

        // Attempt to log the user in
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            
            $user = Auth::user();
            
            // Debug after login
            \Log::info('Login successful', [
                'user_id' => $user->id,
                'user_role' => $user->role,
                'remember_token' => $user->remember_token
            ]);
            
            // Redirect berdasarkan role
            $redirectUrl = $this->getRedirectUrlByRole($user->role);
            
            return redirect()->intended($redirectUrl)
                ->with('success', 'Login berhasil! Selamat datang, ' . $user->name . ' (' . ucfirst($user->role) . ')');
        }

        // Login failed
        return back()
            ->withErrors(['email' => 'Email atau password tidak valid'])
            ->withInput($request->only('email'))
            ->with('error', 'Login gagal. Silakan periksa email dan password Anda.');
    }

    /**
     * Get redirect URL based on user role
     */
    private function getRedirectUrlByRole($role)
    {
        switch ($role) {
            case 'admin':
                return '/admin'; // Admin dashboard
            case 'kepala_terapis':
                return '/kepala-terapis/dashboard'; // Kepala terapis dashboard
            case 'terapis':
                return '/terapis/dashboard'; // Terapis dashboard
            default:
                return '/'; // Default ke beranda
        }
    }

    /**
     * Log the user out
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')
            ->with('success', 'Anda telah berhasil logout.');
    }

    /**
     * Create demo user with bcrypt password
     * Only for testing purposes
     */
    public function createDemoUser()
    {
        // Check if demo user already exists
        $existingUser = User::where('email', 'admin@klinik.com')->first();
        
        if ($existingUser) {
            return response()->json([
                'message' => 'Demo user sudah ada',
                'email' => 'admin@klinik.com',
                'password' => 'password123'
            ]);
        }

        // Create demo user with bcrypt password
        $user = User::create([
            'name' => 'Admin Klinik',
            'email' => 'admin@klinik.com',
            'password' => Hash::make('password123'), // Using bcrypt with cost 12
            'email_verified_at' => now(),
        ]);

        return response()->json([
            'message' => 'Demo user berhasil dibuat',
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
                'password_plain' => 'password123',
                'password_hash' => $user->password,
                'hash_info' => password_get_info($user->password)
            ]
        ]);
    }

    /**
     * Test bcrypt verification
     */
    public function testBcrypt(Request $request)
    {
        $plainPassword = $request->input('password', 'password123');
        $user = User::where('email', 'admin@klinik.com')->first();
        
        if (!$user) {
            return response()->json([
                'error' => 'Demo user tidak ditemukan. Buat demo user terlebih dahulu.'
            ]);
        }

        $isValid = Hash::check($plainPassword, $user->password);
        
        return response()->json([
            'plain_password' => $plainPassword,
            'stored_hash' => $user->password,
            'is_valid' => $isValid,
            'hash_info' => password_get_info($user->password),
            'message' => $isValid ? 'Password cocok!' : 'Password tidak cocok!'
        ]);
    }
}