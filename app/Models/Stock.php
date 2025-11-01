<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'item_name',
        'quantity',
        'warehouse',
        'supplier_article',
        'barcode',
        'price',
        'brand',
        'category'
    ];
}
