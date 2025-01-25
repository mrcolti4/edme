<?php

namespace App\Enums\Stripe;

enum CouponDuration: string
{
    case ONCE = 'once';
    case FOREVER = 'forever';
}