<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = "order_items";
    protected $primarykey = "oi_id";

    protected $hidden = [
        "oi_id"
    ];
    
}
