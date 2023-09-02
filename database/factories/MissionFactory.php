<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Mission;
use App\Models\Transaction;
use App\Models\User;

class MissionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Mission::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(4),
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
            'sub_category' => '{}',
            'description' => $this->faker->text,
            'files' => '{}',
            'budget' => $this->faker->randomFloat(2, 0, 999999.99),
            'begin_mission' => $this->faker->date(),
            'end_mission' => $this->faker->date(),
            'progress' => $this->faker->numberBetween(-10000, 10000),
            'transaction_id' => Transaction::factory(),
            'is_paid' => $this->faker->dateTime(),
            'status' => $this->faker->randomElement(["active","inactive","completed"]),
        ];
    }
}
