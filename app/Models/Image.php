<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    
    protected $guarded =[''];
    // images 要去對應到的不同表的資料
    public function attachable(){
        //morphTo():會對應到不同的關聯
        return $this->morphTo();
    }
}
