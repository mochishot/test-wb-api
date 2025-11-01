<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'item_id',
        'item_name',
        'quantity',
        'price',
        'order_date',
        'delivery_date',
        'supplier_article',
        'warehouse',
        'status'
    ];
}
