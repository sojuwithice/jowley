<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'username' => 'adminUser',
            'email' => 'admin@example.com',
            'phone' => '1234567890',
            'password' => Hash::make('adminpassword'),
            'is_admin' => 1,
        ]);
    }
}
