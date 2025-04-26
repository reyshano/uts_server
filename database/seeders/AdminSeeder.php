<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        Admin::create([
            'username' => 'admin1',
            'password' => Hash::make('password123'),
            'email' => 'admin1@example.com',
        ]);

        Admin::create([
            'username' => 'admin2',
            'password' => Hash::make('password123'),
            'email' => 'admin2@example.com',
        ]);
    }
}