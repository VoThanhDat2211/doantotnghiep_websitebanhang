<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderLine>
 */
class OrderLineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $productVariant = ProductVariant::inRandomOrder()->first();
        return [
            'quantity' => $this->faker->numberBetween(1, 10),
            'price' => $this->faker->numberBetween(3000000, 40000000),
            'product_variant_id' => $productVariant->id, 
        ];
    }
}