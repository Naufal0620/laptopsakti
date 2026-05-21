<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'courier_id',
        'coupon_id',
        'delivery_address',
        'delivery_lat',
        'delivery_lng',
        'distance_km',
        'total_price',
        'shipping_cost',
        'discount_amount',
        'grand_total',
        'status',
        'proof_of_delivery',
        'expected_ready_date',
    ];

    protected $casts = [
        'expected_ready_date' => 'datetime',
        'delivery_lat' => 'float',
        'delivery_lng' => 'float',
        'distance_km' => 'float',
    ];

    /**
     * Get the customer that placed the order.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the courier assigned to the order.
     */
    public function courier(): BelongsTo
    {
        return $this->belongsTo(User::class, 'courier_id');
    }

    /**
     * Get the coupon used for the order.
     */
    public function coupon(): BelongsTo
    {
        return $this->belongsTo(Coupon::class);
    }

    /**
     * Get the items for the order.
     */
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
