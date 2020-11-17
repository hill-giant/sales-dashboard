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
        $orders = Order::all();
        $order = $this->faker->randomElement($orders->ToArray());
        return [
            'order_id' => $order["id"],
            'EAN' => $this->faker->ean13,
            'quantity' => $this->faker->numberBetween(1,10),
            'price' => $this->faker->numberBetween(1,20),
            'created_at' => $order["purchase_date"],
        ];
    }
}
