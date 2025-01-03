<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(10)->create();
        User::create([
            'name' => 'Admin User',
            'email' => 'admin1@bookKeeper.com',
            'password' => bcrypt('admin123'),
            'role' => 1,
        ]);
        User::create([
            'name' => 'Nuwan',
            'email' => 'Nuwan1@gmail.com',
            'password' => bcrypt('nuwan123'),
            'role'=> 0,

        ]);
    }
}
