<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Imports\ProductsImport;
use App\Models\Product;
use App\Notifications\ProductDelivery;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    public function index(Request $request){

        //總共資料筆數
        $productCount = Product::count();

        //每頁有幾筆資料
        $dataPerPage = 2;

        //資料總共有幾頁  ceil():無條件進位 | round():四捨五入 | floor():無條件捨去
        $productPages = ceil($productCount / $dataPerPage);

        //現在user切到的頁數
        $currentPage = isset($request->all()['page']) ? $request->all()['page'] : 1;

        //with():先去撈取關聯的資料(減少下query的行數)
        //product是在productItem關聯裡面
        $products = Product::orderBy('created_at','desc')
        ->offset($dataPerPage * ($currentPage - 1 )) //取資料起始點
        ->limit( $dataPerPage )//限制資料筆數
        ->get();
        return view('admin.products.index', [
            'products' => $products,
            'productCount' => $productCount,
            'productPages' => $productPages
        ]);
    }

    //上傳圖片
    public function uploadImage(Request $request){
        $file = $request->file('product_image');
        $productId = $request->input('product_id');

        if(is_null($productId)){
            return redirect()->back()->withErrors(['msg'=>'參數錯誤']);
        }
        $product = Product::find($productId);
        //在路徑下儲存圖片
        $path = $file->store('public/images');
        $product->images()->create([
            'filename' => $file->getClientOriginalName(),
            'path' => $path
        ]);
        return redirect()->back();

    }

    //import Excel 
    public function import (Request $request){
        $file = $request->file('excel');
        Excel::import(new ProductsImport, $file);
        return redirect()->back();
    }
}
