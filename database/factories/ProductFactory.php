<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Store;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'store_id' => Store::all()->random(),
            'name' => fake()->name(),
            'value' => fake()->numberBetween(1, 9999),
            'active' => fake()->boolean(50),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
