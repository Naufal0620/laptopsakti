<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'type',
        'value',
        'max_discount',
        'min_order',
        'start_date',
        'end_date',
        'usage_limit',
        'limit_per_user',
        'is_active',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'is_active' => 'boolean',
    ];

    /**
     * Check if the coupon is valid for a given total price.
     */
    public function isValid($totalPrice)
    {
        if (!$this->is_active) return false;
        if ($this->start_date && $this->start_date->isFuture()) return false;
        if ($this->end_date && $this->end_date->isPast()) return false;
        if ($this->min_order > $totalPrice) return false;
        if ($this->usage_limit !== null && $this->orders()->count() >= $this->usage_limit) return false;
        
        if ($this->limit_per_user !== null) {
            $userUsage = $this->orders()->where('user_id', auth()->id())->count();
            if ($userUsage >= $this->limit_per_user) return false;
        }

        return true;
    }

    /**
     * Calculate discount amount for a given total price.
     */
    public function calculateDiscount($totalPrice)
    {
        $discount = 0;
        if ($this->type === 'percentage') {
            $discount = ($totalPrice * $this->value / 100);
            if ($this->max_discount !== null) {
                $discount = min($discount, $this->max_discount);
            }
        } elseif ($this->type === 'fixed') {
            $discount = $this->value;
        }

        return min($discount, $totalPrice);
    }

    /**
     * Get the orders for the coupon.
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
