<?php

namespace Database\Factories;

use App\Models\Travel;
use Illuminate\Database\Eloquent\Factories\Factory;

class TravelFactory extends Factory
{
    protected $model = Travel::class;

    public function definition()
    {
        return [
            'name' => $this->faker->sentence(3),
            'slug' => $this->faker->slug,
            'description' => $this->faker->paragraph,
            'number_of_days' => $this->faker->numberBetween(1, 30),
            'is_public' => $this->faker->boolean,
        ];
    }
}  