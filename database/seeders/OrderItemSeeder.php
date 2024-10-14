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
        for ($orderId = 1; $orderId <= 10; $orderId++) {
            // Number of items to add per order (random between 1 and 5 items)
            $itemsPerOrder = rand(1, 5);
        
            for ($i = 1; $i <= $itemsPerOrder; $i++) {
                // Randomly select an item
                $itemId = rand(1, 10); // Assuming there are 10 items
                $quantity = rand(1, 5);
                $item = Item::find($itemId); // Get the item details
                
                if ($item) { // Check if the item exists
                    OrderItem::create([
                        'order_id' => $orderId,
                        'item_id' => $itemId,
                        'quantity' => $quantity,
                        'unit_price' => $item->price, // Use the item's price
                    ]);
                }
            }
        }        
    }
}
