<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'discount_type',
        'discount_value',
        'pre_order_days',
        'is_active',
    ];

    /**
     * Get the discounted price of the product.
     */
    public function getDiscountedPriceAttribute()
    {
        if ($this->discount_type === 'percentage') {
            return $this->price - ($this->price * $this->discount_value / 100);
        } elseif ($this->discount_type === 'fixed') {
            return max(0, $this->price - $this->discount_value);
        }

        return $this->price;
    }

    /**
     * Get the images for the product.
     */
    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    /**
     * Get the primary image for the product.
     */
    public function primaryImage()
    {
        return $this->hasOne(ProductImage::class)->where('is_primary', true);
    }

    /**
     * Get the videos for the product.
     */
    public function videos(): HasMany
    {
        return $this->hasMany(Video::class);
    }

    /**
     * Get the order items for the product.
     */
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
