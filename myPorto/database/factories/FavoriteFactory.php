<?php

namespace Database\Factories;
use App\Models\Favorite;


use Illuminate\Database\Eloquent\Factories\Factory;

class FavoriteFactory extends Factory
{
    protected $model = Favorite::class;
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
