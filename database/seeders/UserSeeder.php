<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Admin Sweet Shop',
            'email' => 'admin@sweetshop.com',
            'password' => Hash::make('Admin123!'),
            'money' => 1000000,
            'is_admin' => true,
        ]);

        // Create Test Customer
        User::create([
            'name' => 'John Customer',
            'email' => 'customer@example.com',
            'password' => Hash::make('Customer123!'),
            'money' => 500000,
            'is_admin' => false,
        ]);

        // Create another test customer
        User::create([
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'password' => Hash::make('Password123!'),
            'money' => 300000,
            'is_admin' => false,
        ]);
    }
}