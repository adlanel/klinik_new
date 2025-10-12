<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index(Request $request)
    {
        $query = User::query();
        
        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Role filter
        if ($request->has('role') && !empty($request->role) && $request->role != 'all') {
            $query->where('role', $request->role);
        }

        // Get paginated results
        $users = $query->orderBy('created_at', 'desc')->paginate(10);
        
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,terapis,kepala_terapis',
            'phone' => 'required|string|max:15',
            'pendidikan' => 'nullable|string|max:100',
            'bidang' => 'nullable|string|max:100',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'phone' => $request->phone,
            'pendidikan' => $request->pendidikan,
            'bidang' => $request->bidang,
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        // Prevent terapis from editing admin or kepala_terapis
        if (Auth::user()->role === 'terapis' && in_array($user->role, ['admin', 'kepala_terapis'])) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Anda tidak memiliki izin untuk mengubah data ini');
        }

        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        // Prevent terapis from updating admin or kepala_terapis
        if (Auth::user()->role === 'terapis' && in_array($user->role, ['admin', 'kepala_terapis'])) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Anda tidak memiliki izin untuk mengubah data ini');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'role' => 'required|in:admin,terapis,kepala_terapis',
            'phone' => 'required|string|max:15',
            'pendidikan' => 'nullable|string|max:100',
            'bidang' => 'nullable|string|max:100',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'phone' => $request->phone,
            'pendidikan' => $request->pendidikan,
            'bidang' => $request->bidang,
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'Data user berhasil diperbarui');
    }

    /**
     * Show form for changing user password
     */
    public function changePassword(User $user)
    {
        // Prevent terapis from changing admin or kepala_terapis password
        if (Auth::user()->role === 'terapis' && in_array($user->role, ['admin', 'kepala_terapis'])) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Anda tidak memiliki izin untuk mengubah password pengguna ini');
        }

        return view('admin.users.change-password', compact('user'));
    }

    /**
     * Update the user's password
     */
    public function updatePassword(Request $request, User $user)
    {
        // Prevent terapis from changing admin or kepala_terapis password
        if (Auth::user()->role === 'terapis' && in_array($user->role, ['admin', 'kepala_terapis'])) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Anda tidak memiliki izin untuk mengubah password pengguna ini');
        }

        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'Password berhasil diperbarui');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        // Prevent deleting admin if current user is terapis
        if (Auth::user()->role === 'terapis' && in_array($user->role, ['admin', 'kepala_terapis'])) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Anda tidak memiliki izin untuk menghapus pengguna ini');
        }

        // Prevent deleting self
        if ($user->id === Auth::id()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Anda tidak dapat menghapus akun sendiri');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil dihapus');
    }
}