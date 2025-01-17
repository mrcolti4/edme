<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Coupon extends Model
{
    protected $table = "coupons";

    protected $guarded = [];

    public function promotionCodes(): HasMany
    {
        return $this->hasMany(PromotionCode::class);
    }
}