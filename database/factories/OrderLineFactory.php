<?php

namespace Database\Factories;

use App\Models\Product;
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
        $product = Product::inRandomOrder()->first();
        $productVariant = $product->productVariants()->inRandomOrder()->first(); 
        return [
            'quantity' => $this->faker->numberBetween(1, 10),
            'price' => $this->faker->numberBetween(3000000, 40000000),
            'product_id' => $product->id,
            'product_variant_id' => $productVariant ? $productVariant->id : null, 
        ];
    }
}