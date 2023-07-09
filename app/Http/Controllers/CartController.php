<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     * 獲取購物車
     */
    public function index()
    {
        // $cart = DB::table('carts')->get()->first();
        // if(empty($cart)){
        //     DB::table('carts')->insert(['created_at'=>now(),'updated_at'=>now()]);
        //     $cart = DB::table('carts')->get()->first();
        // }
        // $cartItem = DB::table('cart_items')->where('cart_id',$cart->id)->get();
        // $cart = collect($cart);
        // $cart['items']=collect($cartItem);

        //拿到現在驗證通過的user
        $user = auth()->user();

        $cart = Cart::with('cartItems')->where('user_id', $user->id)
        ->where('checkouted', false)
        ->firstOrCreate(['user_id' => $user->id]);

        return response($cart);
    }


    //結帳
    public function checkout(){
        //登入後的user
        $user = auth()->user();

        //找出沒被結帳的
        $cart = $user->carts()->where('checkouted', false)->with('cartItems')->first();
        //沒被結帳的話
        if($cart){
            $result = $cart->checkout();
            return response($result);
        }else{
            //已結完帳
            return response('沒有購物車',400);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
