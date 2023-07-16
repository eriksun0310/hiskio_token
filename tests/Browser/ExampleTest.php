<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Support\Facades\Artisan;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;




class ExampleTest extends DuskTestCase
{
    //洗掉 migration 
    use DatabaseMigrations;
    /**
     * A basic browser test example.
     */


    protected function setup():void{
        parent::setUp();
        User::factory()->create([
            'email' => 'qq@gmail.com'
        ]);
        //去執行 ProductSeeder
        Artisan::call('db:seed', ['--class' => 'ProductSeeder']);
    }




    protected function driver(): RemoteWebDriver
    {
        $options = (new ChromeOptions)->addArguments([
            // '--disabled-gpu'
            // '--headless'
        ]);

        return RemoteWebDriver::create(
            'http://localhost:9515',
            DesiredCapabilities::chrome()->setCapability(
                ChromeOptions::CAPABILITY, $options
            )
        );
    }




    
    public function testBasicExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    // ->assertSee('Laravel');
                    ->with('.special-text', function($text){
                        $text->assertSee('固定資料');
                    });
            //暫停
            // eval(\Psy\sh());


            $browser->click('.check_product')
                    ->waitForDialog(5) // 5秒內彈出視窗(就算通過)
                    ->assertDialogOpened('商品數量充足')
                    ->acceptDialog();//確認btn
        });
    }

    public function testFillForm(){
        $this->browse(function (Browser $browser) {
            $browser->visit('contact_us')
                    ->value('[name="name"]', 'cool')
                    ->select('[name="product"]', '食物')
                    ->press('送出')
                    ->assertQueryStringHas('product', '食物');
            //暫停
            eval(\Psy\sh());
        });
    }
}
