<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function show(Request $request) {
        $keyword = $request->keyword;
        $orders = Order::where("transaction_no", "like", "%".$keyword."%")
                  ->orWhere("customer_name", "like", "%".$keyword."%")->get();
        return view("search_result", compact("orders"));
    }

    public function getOrderItems($id)
    {
        // Use a join query to get order items along with their related items
        $items = DB::table('order_items')
            ->join('items', 'order_items.item_id', '=', 'items.item_id')
            ->join('orders', 'order_items.order_id', '=', 'orders.order_id')
            ->where('order_items.order_id', $id)
            ->select(
                'items.item_name as name',        // Item Name
                'order_items.quantity',           // Quantity ordered
                'order_items.unit_price',         // Unit price of the item in the order
                DB::raw('order_items.quantity * order_items.unit_price as total_price')  // Total price calculation
            )
            ->get();
    
        // If no items are found, return an error
        if ($items->isEmpty()) {
            return response()->json(['error' => 'Order not found'], 404);
        }
    
        return response()->json([
            'items' => $items,
        ]);
    }
    
}
