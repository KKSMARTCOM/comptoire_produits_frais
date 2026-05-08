<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponUsage extends Model
{
    use HasFactory;

    protected $table = 'coupon_usage';

    protected $fillable = [
        'promotion_id',
        'session_id',
        'client_ip',
        'client_fingerprint',
        'order_id'
    ];

    // Relation avec Promotion
    public function promotion()
    {
        return $this->belongsTo(Promotion::class);
    }

    // Relation avec Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
