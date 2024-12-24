<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Makanan;
use App\Models\Role;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Makanan::create([
            'name'  => 'Pancake',
            'price' => 10000,
            'image' => 'http://localhost:8000/storage/img/pancake.jpg'
        ]);
        Makanan::create([
            'name'  => 'Mixed Fruit',
            'price' => 15000,
            'image' => 'http://localhost:8000/storage/img/mixed_fruits.jpg'
        ]);
        Makanan::create([
            'name'  => 'Noodle',
            'price' => 20000,
            'image' => 'http://localhost:8000/storage/img/noodles.jpg'
        ]);
        Role::create([
            'role' => 'Operator'
        ]);
        Role::create([
            'role' => 'Admin'
        ]);
        User::create([
            'name'      => 'Nixie',
            'email'     => 'nixie@gmail.com',
            'password'  => bcrypt('1234'),
            'role_id'   => 1
        ]);
        User::create([
            'name'      => 'Lorion',
            'email'     => 'lorion@gmail.com',
            'password'  => bcrypt('1234'),
            'role_id'   => 2
        ]);

        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
