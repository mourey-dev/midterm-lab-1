<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = "orders";
    protected $primarykey = "order_id";

    protected $hidden = [
        "order_id",
        "status"
    ];

    public function getStateAttribute() {
        switch($this->status) {
            case 0: return "Cancelled";
            case 1: return "Served";
            case 2: return "Ready to serve";
            case 3: return "Pending";
            default: return "";
        }
    }
    
}
