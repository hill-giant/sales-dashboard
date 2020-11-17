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
                    ->times(1000)
                    ->has(Order::factory()->count(rand(1,2)))
                    ->create();
    }
}
