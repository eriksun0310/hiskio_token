<?php

namespace App\Exports;

use App\Models\Order;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Concerns\FromCollection; 
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents; //當excel做出來才發生的事件
use Maatwebsite\Excel\Events\AfterSheet;

//匯出excel 檔案
class OrdersExport implements FromCollection, WithHeadings, WithColumnFormatting, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    * 要匯出的table
    */
    public $dataCount; //紀錄資料有幾筆
    public function collection()
    {

        //$orders = 組合多張table
        $orders = Order::with(['user','cart.cartItems.product'])->get();
        $orders = $orders->map(function($order){
            return [
                $order->id,
                $order->user->name,
                $order->is_shipped,
                $order->cart->cartItems->sum(function ($cartItem) {
                    return $cartItem->product->price * $cartItem->quantity;
                }),
                //轉換excel的時間格式 
                Date::dateTimeToExcel($order->created_at)
            ];
        });
        $this->dataCount = $orders->count();
        return $orders;
    }

    public function headings():array{
        return ['編號', '購買者', '是否運送', '總價', '建立時間'];
    }

    //設定excel  欄位格式
    public function columnFormats():array{
        return [
            'B'=> NumberFormat::FORMAT_TEXT,
            'D'=> NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'E'=> NumberFormat::FORMAT_DATE_YYYYMMDD,
        ];
    }

    //設定excel 欄位style
    public function registerEvents():array{
        return [
            AfterSheet::class => function (AfterSheet $event){

                //設定A欄位的寬度
                $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(50);
                
                //設定每一列的資料欄位高度
                for ($i=0; $i < $this->dataCount ; $i++) { 
                    $event->sheet->getDelegate()->getRowDimension($i)->setRowHeight(50);
                }
                //設定欄位置中
                $event->sheet->getDelegate()->getStyle('A1:B'.$this->dataCount)->getAlignment()->setVertical('center');
                $event->sheet->getDelegate()->getStyle('A1:B'.$this->dataCount)->applyFromArray([
                    'font'=>[
                        'name' => 'Arial',
                        'bold' => true,
                        'italic' => true,
                        'color'=>[
                            'rgb' =>'78a1c4'
                        ],
                        'fill'=>[
                            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                            'startColor' => [
                                'rgb' => 'c4b478',
                            ],
                            'endColor' => [
                                'rgb' => 'c4b478',
                            ],
                        ]
                    ]
                ]);
                $event->sheet->getDelegate()->mergeCells('G1:H1');
            }
        ];
    }

}
