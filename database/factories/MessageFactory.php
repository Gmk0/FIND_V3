<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\Order;
use App\Models\Service;
use App\Models\User;

class MessageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Message::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'sender_id' => User::factory(),
            'receiver_id' => User::factory(),
            'conversation_id' => Conversation::factory(),
            'body' => $this->faker->text,
            'is_read' => $this->faker->randomElement(["0","1"]),
            'type' => $this->faker->word,
            'service_id' => Service::factory(),
            'order_id' => Order::factory(),
        ];
    }
}
