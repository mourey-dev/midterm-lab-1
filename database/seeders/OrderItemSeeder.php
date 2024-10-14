<?php

namespace Database\Seeders;

use App\Models\OrderItem;
use App\Models\Item;
use App\Models\Order;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            // Randomly select an order and an item
            $orderId = rand(1, 10);
            $itemId = rand(1, 10);
            $quantity = rand(1, 5);
            $item = Item::find($itemId);
            
            OrderItem::create([
                'order_id' => $orderId,
                'item_id' => $itemId,
                'quantity' => $quantity,
                'unit_price' => $item->price,
            ]);
        }
    }
}
