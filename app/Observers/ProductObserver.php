<?php

namespace App\Observers;

use App\Models\Product;
use App\Notifications\ProductReplenish;

//Observer觀察者:跟Product 的model綁定, 如果Product edit、delete、add 就要去做什麼事
class ProductObserver
{
    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        //有改變
        $changes = $product->getChanges();
        //原本
        $original = $product->getOriginal();
        //如果有補貨
        if(isset($changes['quantity']) && $product->quantity > 0 && $original['quantity'] == 0){
            foreach($product->favorite_users as $user){
                $user->notify(new ProductReplenish($product));
            }
        }
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "restored" event.
     */
    public function restored(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     */
    public function forceDeleted(Product $product): void
    {
        //
    }
}
