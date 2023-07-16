<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //faker->randomDigit:隨機單數
        return [
            'id' => $this->faker->randomDigit,
            'title' => '測試產品',
            'content' =>$this->faker->word,
            'price' => $this->faker->numberBetween(100, 1000),
            'quantity' => $this->faker->numberBetween(10,100),
        ];
    }

    //建立一個less 把數量變成 1
    public function less(){
        return $this->state(function (array  $attributes){
            return [
                'quantity' => 1
            ];
        });
    }
}
