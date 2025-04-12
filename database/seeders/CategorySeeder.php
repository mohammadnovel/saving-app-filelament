<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::create(['name' => 'Food']);
        Category::create(['name' => 'Transport']);
        Category::create(['name' => 'Entertainment']);
    }
}