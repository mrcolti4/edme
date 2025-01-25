<?php

namespace App\Enums\Stripe;

enum CouponAmountType: string
{
    case PERCENTAGE = 'percent_off';
    case FIXED = 'amount_off';
}