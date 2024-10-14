<?php

namespace Database\Seeders;

use App\Models\Order;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            Order::create([
                'transaction_no' => str_pad($i, 5, '0', STR_PAD_LEFT),
                'customer_name' => 'Customer ' . $i,
                'order_status' => rand(0, 1),
            ]);
        }

    }
}
