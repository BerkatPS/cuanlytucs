<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Category::create([
            'name' => 'Belanja',
            'description' => 'Kategori untuk pengeluaran belanja',
        ]);

        Category::create([
            'name' => 'Pendapatan',
            'description' => 'Kategori untuk pendapatan atau pemasukan',
        ]);
    }
}
