<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_no',
        'product_id',
        'pack_id',
        'name',
        'price',
        'quantity',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function pack()
    {
        return $this->belongsTo(Pack::class, 'pack_id');
    }
}
