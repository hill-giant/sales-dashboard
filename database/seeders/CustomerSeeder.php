<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::factory()
            ->count(800)
            ->create()
            ->each(function($customer) {
                $customer->orders()->saveMany(Order::factory()->count(rand(1,3))->make())
                ->each(function($order) {
                    $order->orderItems()->saveMany(OrderItem::factory()->count(1,10)->make());
                });
            });
    }
}
