<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function show(Request $request) {
        $keyword = $request->keyword;
        $orders = Order::where("transaction_no", "like", "%".$keyword."%")
                  ->orWhere("customer_name", "like", "%".$keyword."%")->get();
        return view("search_result", compact("orders"));
    }
}
