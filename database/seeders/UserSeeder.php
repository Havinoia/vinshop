<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Buat akun admin
        User::create([
            'name'     => 'Admin VinShop',
            'email'    => 'admin@vinshop.com',
            'password' => Hash::make('password'),
            'role'     => 'admin',
            'phone'    => '081234567890',
            'address'  => 'Jl. Admin No. 1, Jakarta',
        ]);

        // Buat akun customer untuk testing
        User::create([
            'name'     => 'Customer Test',
            'email'    => 'customer@vinshop.com',
            'password' => Hash::make('password'),
            'role'     => 'customer',
            'phone'    => '089876543210',
            'address'  => 'Jl. Customer No. 2, Surabaya',
        ]);
    }
}