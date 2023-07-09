<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Notifications\OrderDelivery;

class OrderController extends Controller
{
    public function index(Request $request){

        //總共資料筆數
        $orderCount = Order::whereHas('orderItems')->count();

        //每頁有幾筆資料
        $dataPerPage = 2;

        //資料總共有幾頁  ceil():無條件進位 | round():四捨五入 | floor():無條件捨去
        $orderPages = ceil($orderCount / $dataPerPage);

        //現在user切到的頁數
        $currentPage = isset($request->all()['page']) ? $request->all()['page'] : 1;

        //with():先去撈取關聯的資料(減少下query的行數)
        //product是在orderItem關聯裡面
        $orders = Order::with(['user', 'orderItems.product'])
        ->orderBy('created_at','desc')
        ->offset($dataPerPage * ($currentPage - 1 )) //取資料起始點
        ->limit( $dataPerPage )//限制資料筆數
        ->whereHas('orderItems') //如果有orderItems這張的關聯 在去執行
        ->get();
        return view('admin.orders.index', [
            'orders' => $orders,
            'orderCount' => $orderCount,
            'orderPages' => $orderPages
        ]);
    }

    //推播功能
    public function delivery($id){
        $order = Order::find($id);
        if($order->is_shipped){
            return response(['result' => false]);
        }else{
            $order->update(['is_shipped' => true]);
            //指定給user 一個推播
            $order->user->notify(new OrderDelivery);
            return response(['result' => true]);
        }
    }
}
