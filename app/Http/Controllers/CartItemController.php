<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UpdateCartItem;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;

class CartItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * 建立carte cart_items資料
     */
    public function store(Request $request)
    {

        $messages = [
            'required' =>':attribute 是必填的',
            'between' => ':attribute 必須介於:min~:max'
        ];
        //資料驗證
        $validator = Validator::make($request->all(),[
            'cart_id' => 'required | integer',
            'product_id' =>'required | integer',
            'quantity' => 'required | integer | between:1,10',
        ], $messages);

        //資料驗證失敗
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        //資料驗證成功
        $validatorData = $validator->validate();

        //檢查商品數量
        $product = Product::find($validatorData['product_id']);
        if(!$product->checkQuantity($validatorData['quantity'])){
            return response($product->title.'數量不足', 400);
        }

        $cart = Cart::find($validatorData['cart_id']); 

        $result = $cart->cartItems()->create([
            'product_id'=> $product->id,
            'quantity'=> $validatorData['quantity'],
        ]);
        return response()->json($result);
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
     * UpdateCartItem:檢查quantity 有沒有在範圍內
     */
    public function update(UpdateCartItem $request, string $id)
    {



        $form = $request->validated();

        $cartItem = CartItem::find($id);

        $cartItem->update([
            'quantity' => $form['quantity'],
        ]);

        return response()->json(true);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        CartItem::find($id)->delete();
        return response()->json(true);
    }
}
