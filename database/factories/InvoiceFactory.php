<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'number' => rand(10, 100),
            'customer_id' => rand(10, 20),
            'date' => $this->faker->date,
            'due_date' => $this->faker->date,
            'reference_code' => 'REF-' . rand(10, 100),
            'terms_and_conditions' => $this->faker->paragraph(2),
            'sub_total' => mt_rand(100, 1000),
            'discount' => rand(10, 50),
            'total' => rand(100, 1000),
        ];
    }
}
