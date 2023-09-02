<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Order;
use App\Models\Service;
use App\Models\User;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'order_numero' => $this->faker->word,
            'user_id' => User::factory(),
            'service_id' => Service::factory(),
            'type' => $this->faker->word,
            'total_amount' => $this->faker->randomFloat(2, 0, 999999.99),
            'quantity' => $this->faker->word,
            'transaction_id' => $this->faker->word,
            'progress' => $this->faker->numberBetween(-10000, 10000),
            'is_paid' => $this->faker->dateTime(),
            'status' => $this->faker->randomElement(["pending","completed","failed"]),
        ];
    }
}
