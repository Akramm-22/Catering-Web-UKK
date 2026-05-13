<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::updateOrCreate(
            ['email' => 'admin@splitbill.id'],
            [
                'name' => 'Admin Utama',
                'email' => 'admin@splitbill.id',
                'password' => Hash::make('admin123'),
                'is_admin' => true,
                'email_verified_at' => now(),
            ]
        );

        // Demo User
        User::updateOrCreate(
            ['email' => 'user@splitbill.id'],
            [
                'name' => 'Demo User',
                'email' => 'user@splitbill.id',
                'password' => Hash::make('user123'),
                'is_admin' => false,
                'email_verified_at' => now(),
            ]
        );
    }
}
