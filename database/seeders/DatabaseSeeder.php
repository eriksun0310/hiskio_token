<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Product::create([
            'title'=>'test1',
            'content'=>'testContent',
            'price'=>rand(0,300),
            'quantity'=>30,
        ]);
        Product::create([
            'title'=>'test2',
            'content'=>'testContent',
            'price'=>rand(0,300),
            'quantity'=>30,
        ]);
        Product::create([
            'title'=>'test3',
            'content'=>'testContent',
            'price'=>rand(0,300),
            'quantity'=>30,
        ]);
        $this->call(ProductSeeder::class);
        $this->command->info('產生固定product 資料');
    }
}
