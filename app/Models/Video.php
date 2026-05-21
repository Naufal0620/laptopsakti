<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'video_path',
        'thumbnail_path',
        'status',
    ];

    /**
     * Get the product that owns the video.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
