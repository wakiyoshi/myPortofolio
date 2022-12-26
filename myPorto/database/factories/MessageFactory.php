<?php

namespace Database\Factories;
use App\Models\Message;

use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    protected $model = Message::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1,10),
            'admin_id' => $this->faker->numberBetween(1,10),
            'admin_message' => null,
            'user_message' => $this->faker->realText(30),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
    }
}
