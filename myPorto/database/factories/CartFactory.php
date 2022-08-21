<?php

namespace Database\Factories;
use App\Models\Cart;

use Illuminate\Database\Eloquent\Factories\Factory;

class CartFactory extends Factory
{
    protected $model = Cart::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1,10),
            'product_id' => $this->faker->numberBetween(1,10),
        ];
    }
}
