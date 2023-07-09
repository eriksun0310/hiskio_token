<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;
    
    protected $guarded =[''];
    
    public function cartItems(){
        //hasMany():出來的資料是複數
        return $this->hasMany(CartItem::class);
    }

    public function orderItems(){
        return $this->hasMany(OrderItem::class);
    }
    //取得favorites 跟 user 的關聯
    public function favorite_users(){
        return $this->belongsToMany(User::class, 'favorites');
    }

    //檢查商品數量
    public function checkQuantity($quantity){
        //db的數量 < 前端傳來的數量
        if($this->quantity < $quantity){
            return false;
        }
        return true;
    }


    //product去找對應的image
    public function images(){
        //morphMany()建立多型關聯的函式:取得Image關聯 拿attachable
        return $this->morphMany(Image::class , 'attachable');
    }

    //讀取存在db的 image url (建立一個假屬性)
    public function getImageUrlAttribute(){
        $images = $this->images;
        if($images->isNotEmpty()){
            return Storage::url($images->last()->path);
        }
    }

}
