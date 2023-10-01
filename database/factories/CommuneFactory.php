<?php

namespace Database\Factories;

use App\Models\Localisation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Commune>
 */
class CommuneFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'commune'=>$this->faker->city,
            'localisation_id'=> Localisation::inRandomOrder()->first()->id
        ];
    }
}
