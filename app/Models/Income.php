<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;

    protected $fillable = [
        'income_id',
        'item_id',
        'item_name',
        'quantity',
        'price',
        'income_date',
        'supplier_article',
        'warehouse',
        'status'
    ];
}
