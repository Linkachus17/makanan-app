<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Makanan;

class MakananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Makanan::create([
            'name' => 'Nasi Goreng',
            'price' => 15000,
            'image_url' => 'https://example.com/nasi-goreng.jpg',
        ]);
        Makanan::create([
            'name' => 'Sate Ayam',
            'price' => 20000,
            'image_url' => 'https://example.com/sate-ayam.jpg',
        ]);
        // Add more items as needed
    }
}
