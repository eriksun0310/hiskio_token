<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //upsert([array], [主鍵],[update]):會根據主鍵(id)去搜尋資料,若無(id)就建立資料,若有(id)就去更新 price、quantity
        Product::upsert([
            ['id' => 17 ,
            'title' => '固定資料',
            'content' => '固定內容',
            'price' => rand(0,100), 
            'quantity' => 7],
            ['id' => 18 ,
            'title' => '固定資料2',
            'content' => '固定內容2',
            'price' => rand(0,100), 
            'quantity' => 8],
        ],['id'], ['price', 'quantity']);
    }
}
