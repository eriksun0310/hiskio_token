<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Controller;
use App\Jobs\UpdateProductPrice;
use App\Models\Product;

class ToolController extends Controller
{
    

    public function updateProductPrice(){
        $products = Product::all();
        foreach($products as $product){
            //跑job(隨機產生價錢更新db)
            UpdateProductPrice::dispatch($product)->onQueue('tool');
        }
    }

    //將product 資料設置在Redis
    public function createProductRedis(){
        Redis::set('products'. json_encode(Product::all()));
    }
}
