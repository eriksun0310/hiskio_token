<?php

namespace Tests\Feature;

use App\Http\Services\ShortUrlService;
use App\Http\Services\AuthService;
use App\Models\CartItem;
use App\Models\Cart;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use Laravel\Passport\Passport;

class ProductControllerTest extends TestCase
{
    //在執行測試程式前會先把資料庫清空
    use RefreshDatabase;
    
    private $fakeUser;
    
    //設置
    protected function setup():void{
        parent::setUp();
    }

    //mock():不想執行該函式
    public function testSharedUrl(){

        $product = Product::factory()->create();
        $id = $product->id;

        //mock():不想執行該函式
        $this->mock(ShortUrlService::class, function($mock) use ($id){
            $mock->shouldReceive('makeShortUrl')
                ->with("http://localhost:3000/products/$id")
                ->andReturn('fakeUrl');
        });

        //mock():不想執行該函式
        $this->mock(AuthService::class, function($mock){
            $mock->shouldReceive('fakeReturn');
        });

        $response = $this->call(
            'GET',
            'products/'.$id.'/shared-url'
        );
        $response->assertOk();
        $response = json_decode($response->getContent(), true);
        $this->assertEquals($response['url'], 'fakeUrl');
    }
}