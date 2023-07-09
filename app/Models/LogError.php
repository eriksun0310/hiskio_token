<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogError extends Model
{
    use HasFactory;
    protected $guarded = [''];
    
    //casts 在被使用時,會被當作什麼樣的資料格式
    protected $casts = [
        'trace' => 'array',
        'params' => 'array',
        'header' => 'array',
    ];

}
