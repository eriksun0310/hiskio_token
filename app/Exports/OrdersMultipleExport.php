<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Exports\Sheets\OrderByShippedSheer;

//匯出excel 檔案
class OrdersMultipleExport implements WithMultipleSheets
{
    /**
    * @return \Illuminate\Support\Collection
    * 
    */

    public function sheets():array {
        $sheets = [];
        foreach([true, false] as $isShipped){
            // 得到幾個活頁,就塞回$sheets
            $sheets[] = new OrderByShippedSheer($isShipped);
        }
        return $sheets;
    }
}
