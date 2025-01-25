<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PromotionCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'stripe_id',
        'code',
        'expires_at',
        'max_redemptions',
        'times_redeemed',
        'coupon_id',
        'is_active',
    ];

    public function coupon(): BelongsTo
    {
        return $this->belongsTo(Coupon::class);
    }
}