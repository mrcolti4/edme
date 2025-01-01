<?php

namespace App\Enums;

enum FilterBookings: string
{
    case CREATED_AT = 'created_at';
    case PRICE = 'price';
    case STATUS = 'status';
}
