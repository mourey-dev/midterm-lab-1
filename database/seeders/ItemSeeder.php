<?php

namespace Database\Seeders;

use App\Models\Item;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            Item::create([
                'item_name' => 'Item ' . $i,
                'price' => rand(100, 1000) / 10,
                'quantity' => rand(1, 50),
                'is_active' => rand(0, 1),
            ]);
        }
    }
}
