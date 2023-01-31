<?php

namespace Database\Factories;

use App\Enums\Advert\AdvertPlacementType;
use App\Enums\Advert\AdvertType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Advert>
 */
class AdvertFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::all()->random()->id,
            'type' => AdvertType::cases()[array_rand(AdvertType::cases())]->name,
            'placement_type' => AdvertPlacementType::cases()[array_rand(AdvertPlacementType::cases())]->name,
            'address' => fake()->address(),
            'description' => fake()->text(),
            'payment' => rand(1, 100000),
            'square' => rand(10, 200)
        ];
    }
}
