<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $customers = Customer::pluck('id')->toArray();
        return [
            'customer_id' => $this->faker->randomElement($customers),
            'purchase_date' => $this->faker->dateTimeBetween('-1 year', 'now', null),
            'country' => $this->faker->country,
            'device' => $this->faker->randomElement(['computer', 'mobile']),
        ];
    }
}
