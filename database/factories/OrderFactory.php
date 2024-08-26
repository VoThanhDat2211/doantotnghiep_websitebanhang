<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderLine;
use App\Models\Pay;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_code' => $this->faker->unique()->bothify('ORD###???'), 
            'customer_id' => Customer::inRandomOrder()->first(), 
            'status' => $this->faker->randomElement([1, 2, 3, 4, 5]),
            'total_amount' => $this->faker->randomFloat(2, 20, 500),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Order $order) {
            $orderLine = OrderLine::factory()->count(1)->create([
                'order_id' => $order->id
            ]);

            $pay = Pay::factory()->count(1)->create([
                'order_id' => $order->id
            ]);
        });
    }
}