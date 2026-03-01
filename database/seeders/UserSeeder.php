<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@vinshop.com'],
            [
                'name'     => 'Admin VinShop',
                'password' => Hash::make('password'),
                'role'     => 'admin',
                'phone'    => '081234567890',
                'address'  => 'Jl. Admin No. 1, Jakarta',
            ]
        );

        User::firstOrCreate(
            ['email' => 'customer@vinshop.com'],
            [
                'name'     => 'Customer Test',
                'password' => Hash::make('password'),
                'role'     => 'customer',
                'phone'    => '089876543210',
                'address'  => 'Jl. Customer No. 2, Surabaya',
            ]
        );
    }
}