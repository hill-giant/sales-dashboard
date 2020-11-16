<?php

namespace Database\Factories;

use App\Models\OrderItem;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $orders = Order::pluck('id')->toArray();
        return [
            'order_id' => $this->faker->randomElement($orders),
            'EAN' => $this->faker->ean13,
            'quantity' => $this->faker->numberBetween(1,10),
            'price' => $this->faker->numberBetween(1,1000),
        ];
    }
}
