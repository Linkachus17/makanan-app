<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Makanan;
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
            'name' => 'Pancake',
            'price' => 10000,
            'image' => '1.jpg'
        ]);
        Makanan::create([
            'name' => 'Mixed Fruit',
            'price' => 15000,
            'image' => '2.jpg'
        ]);
        Makanan::create([
            'name' => 'Noodle',
            'price' => 20000,
            'image' => '3.jpg'
        ]);

        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
