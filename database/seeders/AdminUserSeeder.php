<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if admin user already exists
        $existingUser = User::where('email', 'admin@klinik.com')->first();
        
        if ($existingUser) {
            $this->command->info('Admin user already exists: admin@klinik.com');
            return;
        }

        // Create admin user with bcrypt password
        $user = User::create([
            'name' => 'Admin Klinik',
            'email' => 'admin@klinik.com',
            'phone' => '081234567890',
            'password' => Hash::make('admin123'), // Using bcrypt
            'email_verified_at' => now(),
        ]);

        $this->command->info('Admin user created successfully!');
        $this->command->info('Email: admin@klinik.com');
        $this->command->info('Password: admin123');
        $this->command->info('Hash: ' . $user->password);
    }
}