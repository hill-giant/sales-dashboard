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
        $order = $this->faker->randomElement(Order::select('id','purchase_date')->get()->toArray());
        return [
            'order_id' => $order["id"],
            'EAN' => $this->faker->ean13,
            'quantity' => $this->faker->numberBetween(1,5),
            'price' => $this->faker->numberBetween(1,5),
            'created_at' => $order["purchase_date"],
        ];
    }
}
