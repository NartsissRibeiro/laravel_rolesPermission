<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DefaultUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'teste@gmail.com',
            'password' => Hash::make('teste123')
        ]);
        $superAdmin->assignRole('Super Admin');

        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123')
        ]);
        $admin->assignRole('Admin');

        $productManager = User::create([
            'name' => 'Product Manager User',
            'email' => 'product@gmail.com',
            'password' => Hash::make('product123')
        ]);
        $productManager->assignRole('Product Manager');

        $user = User::create([
            'name' => 'Regular User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('user123')
        ]);
        $user->assignRole('User');
    }
}
