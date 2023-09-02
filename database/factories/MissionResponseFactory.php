<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Freelance;
use App\Models\Mission;
use App\Models\MissionResponse;

class MissionResponseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MissionResponse::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'freelance_id' => Freelance::factory(),
            'mission_id' => Mission::factory(),
            'content' => $this->faker->paragraphs(3, true),
            'budget' => $this->faker->randomFloat(2, 0, 999999.99),
            'status' => $this->faker->randomElement(["pending","approved","rejected"]),
            'is_paid' => $this->faker->dateTime(),
        ];
    }
}
