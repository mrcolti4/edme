<?php

namespace App\Enums\Booking;

enum Status: string
{
    case PENDING = 'pending';
    case EXPIRED = 'expired';
    case PAID = 'paid';
    case CANCELLED = 'cancelled';
}
