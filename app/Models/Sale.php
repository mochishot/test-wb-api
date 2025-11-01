<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'sale_id',
        'item_id',
        'item_name',
        'quantity',
        'price',
        'total_price',
        'sale_date',
        'supplier_article',
        'warehouse',
        'order_id'
    ];
}
