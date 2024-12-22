<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
    public function definition(): array
    {
        return [
            'name' => 'Tile',
            'item_code' => 'IC-100' . rand(50, 100),
            'description' => 'Best Product in world',
            'unit_price' => mt_rand(100, 1000),
            'stoke_count' => rand(10, 30)

        ];
    }
}
