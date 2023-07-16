<?php

namespace Tests\Feature;

use App\Models\CartItem;
use App\Models\Cart;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use Laravel\Passport\Passport;

class CartItemControllerTest extends TestCase
{
    //在執行測試程式前會先把資料庫清空
    use RefreshDatabase;
    
    private $fakeUser;
    
    //設置
    protected function setup():void{
        parent::setUp();
        $this->fakeUser = User::create([
            'name' => 'ww',
            'email' => 'ww@gmail.com',
            'password' => 12345678,
        ]);
        Passport::actingAs($this->fakeUser);
    }


    /**
     * A basic test example.
     */
    //創造購物車
    public function testStore(): void
    {
        $cart = Cart::factory()->create();
        // $product = Product::factory()->make(); // make():只會建一個class出來,不會存進db裡
        $product = Product::factory()->create(); //create():會存進db中

        //route
        $response = $this->call(
            'POST',
            'cart_items',
            ['cart_id' => $cart->id, 'product_id'=> $product->id,'quantity'=> 2 ]
        );
        $response->assertOk();


        //建立一個少數量的(把10 -> 1)
        $product = Product::factory()->less()->create();

        //route
        $response = $this->call(
            'POST',
            'cart_items',
            ['cart_id' => $cart->id, 'product_id'=> $product->id,'quantity'=> 10 ]
        );
        $this->assertEquals($product->title.'數量不足', $response->getContent());




        $response = $this->call(
            'POST',
            'cart_items',
            ['cart_id' => $cart->id,
            'product_id'=> $product->id,
            'quantity'=> 55555
        ]);
        $response->assertStatus(400);
    }

    //更新
    public function testUpdate(){
        $cartItem = CartItem::factory()->create();
        //route
        $response = $this->call(
            'PUT',
            'cart_items/'.$cartItem->id,
            ['quantity' => 1]
        );
        //assertEquals( , ):期待前者和後者是一樣的
        $this->assertEquals('true', $response->getContent());

        //refresh():重新取modal資料庫出來(會拿到更新後的資料)
        $cartItem->refresh();
        //檢查有沒有更新到db
        $this->assertEquals(1, $cartItem->quantity);
    }

    //刪除
    public function testDestroy(){
        $cart = Cart::factory()->make();
        $product = Product::factory()->make();
        $cartItem = $cart->cartItems()->create([
            'product_id' => $product->id,
            'quantity' => 10,
        ]);
        //route
        $response = $this->call(
            'DELETE',
            'cart_items/'.$cartItem->id,
            ['quantity' => 1],
        );
        $response->assertOk();
        //檢查是否有被刪除的成功
        $cartItem = CartItem::find($cartItem->id);
        $this->assertNull($cartItem); 
    }
}