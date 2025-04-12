<?php

namespace Database\Seeders;

// database/seeders/TransactionSeeder.php
use Illuminate\Database\Seeder;
use App\Models\Transaction;
use App\Models\Category;

class TransactionSeeder extends Seeder
{
    public function run()
    {
        $categories = Category::all(); // Ambil semua kategori
        
        foreach ($categories as $category) {
            Transaction::create([
                'category_id' => $category->id,
                'amount' => rand(10000, 100000), // Angka acak untuk amount
                'type' => 'income', // Tipe transaksi,
                'date' => now(),
            ]);
        }
    }
}

