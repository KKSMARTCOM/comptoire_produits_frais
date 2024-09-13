<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_no',
        'lastname',
        'firstname',
        'phone',
        'company_name',
        'address',
        'country',
        'city',
        'district',
        'note',
        'status',
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_no', 'order_no');
    }

    public function getFullnameAttribute()
    {
        return $this->lastname . ' ' . $this->firstname;
    }
}
