<?php

namespace Database\Factories;
use App\Models\Product;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'category_id' => $this->faker->numberBetween(1,9),
            'information' =>  $this->faker->realText(30),
            'price' => $this->faker->numberBetween(1500,30000),
            'quantity' =>  $this->faker->numberBetween(1,10),
            'material' =>  $this->faker->word(),
            'image1' =>  $this->faker->randomElement($array = ['sofa.png','chair.png','interior.png','daily-necessities.png','storage.png','kitchen.png','cushion.png','bed.png','clock.png']),
            'image2' =>  $this->faker->randomElement($array = ['sofa.png','chair.png','interior.png','daily-necessities.png','storage.png','kitchen.png','cushion.png','bed.png','clock.png']),
            'image3' =>  $this->faker->randomElement($array = ['sofa.png','chair.png','interior.png','daily-necessities.png','storage.png','kitchen.png','cushion.png','bed.png','clock.png']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
