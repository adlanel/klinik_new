<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class BcryptController extends Controller
{
    /**
     * Show bcrypt generator page
     */
    public function index()
    {
        return view('bcrpyt');
    }

    /**
     * Generate bcrypt hash
     */
    public function generate(Request $request)
    {
        $request->validate([
            'password' => 'required|min:1|max:255',
            'rounds' => 'required|integer|min:4|max:20'
        ]);

        $password = $request->input('password');
        $rounds = $request->input('rounds');

        try {
            // Set bcrypt rounds temporarily
            config(['hashing.bcrypt.rounds' => $rounds]);
            
            // Generate hash using Laravel's Hash facade
            $hash = Hash::make($password);
            
            // Get hash info
            $hashInfo = password_get_info($hash);
            
            return view('bcrpyt', [
                'hash' => $hash,
                'original_password' => $password,
                'cost' => $rounds,
                'hash_info' => $hashInfo
            ]);

        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Error generating hash: ' . $e->getMessage());
        }
    }

    /**
     * Test bcrypt verification
     */
    public function test(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'hash' => 'required'
        ]);

        $password = $request->input('password');
        $hash = $request->input('hash');

        $isValid = Hash::check($password, $hash);
        $hashInfo = password_get_info($hash);

        return response()->json([
            'password' => $password,
            'hash' => $hash,
            'is_valid' => $isValid,
            'hash_info' => $hashInfo,
            'message' => $isValid ? 'Password cocok!' : 'Password tidak cocok!'
        ]);
    }

    /**
     * Fix existing user password
     */
    public function fixUserPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'new_password' => 'required|min:6'
        ]);

        $email = $request->input('email');
        $newPassword = $request->input('new_password');

        try {
            $user = \App\Models\User::where('email', $email)->first();
            
            if (!$user) {
                return response()->json(['error' => 'User tidak ditemukan']);
            }

            // Generate new hash with proper bcrypt
            $newHash = Hash::make($newPassword);
            
            // Update user password
            $user->update(['password' => $newHash]);

            return response()->json([
                'success' => true,
                'message' => 'Password berhasil diperbaiki',
                'user' => [
                    'email' => $user->email,
                    'name' => $user->name
                ],
                'new_credentials' => [
                    'email' => $email,
                    'password' => $newPassword
                ],
                'hash_info' => [
                    'old_hash_length' => 'N/A',
                    'new_hash' => $newHash,
                    'new_hash_length' => strlen($newHash),
                    'algorithm' => password_get_info($newHash)['algoName'] ?? 'bcrypt'
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
}