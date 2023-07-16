<?php

namespace App\Exports\Sheets;

use App\Models\Order;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle; //活頁名稱

//獲取有幾個活頁
class OrderByShippedSheer implements FromCollection, WithHeadings, WithTitle 
{
    public $isShipped;
    public function __construct($isShipped)
    {   
        $this->isShipped = $isShipped;
    }

    /**
    * @return \Illuminate\Support\Collection
    * 要匯出的excel資料
    */
    public function collection()
    {
        return Order::where('is_shipped', $this->isShipped)->get();
    }

    //獲取excel上方欄位
    public function headings():array{
        return Schema::getColumnListing('orders');// table名稱
    }

    //設定的活頁名稱
    public function title():string{
        return $this->isShipped ? '已運送': '尚未運送';
    }
}
