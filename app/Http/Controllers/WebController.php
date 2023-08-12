<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification; //notification 的modal

class WebController extends Controller
{

    public $notifications = [];

    //在執行下列func會先執行
    public function __construct()
    {
        $user = User::find(2);
        $this->notifications = $user->notifications ?? [];
    }

    //首頁
    public function index(){
        \Log::alert(123);
        $products =  Product::all();
        return view('web.index', [
            'products' => $products,
            'notifications' => $this->notifications
        ]);
    }
    //聯絡我們
    public function contactUs(){
        return view('web.contact_us', [
            'notifications' => $this->notifications
        ]);
    }
    // update read_at已讀
    public function readNotification(Request $request){
        $id = $request->all()['id'];
        //找到前端傳的id 押上 read_at 時間
        DatabaseNotification::find($id)->markAsRead();
        return response(['result' => true]);
    }


}
