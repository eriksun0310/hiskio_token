<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;
    
    // protected $fillable = ['quantity']; //白名單(可被修改)
    protected $guarded = [''];//黑名單(不可修改), '':全部都可以被修改
    // protected $hidden = ['']; //隱藏

    protected $addends = ['current_price']; //新增欄位

    //用$appends 固定的命名function方式
    public function getCurrentPriceAttribute(){
        return $this->quantity*10; 
    }

    //belongTos 去尋找對應的表(modal)
    public function product (){
        return $this->belongsTo(Product::class);
    }

    public function cart (){
        return $this->belongsTo(Cart::class);
    }

}
