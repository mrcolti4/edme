<?php

namespace App\DTOs;

use App\Enums\Stripe\CouponAmountType;
use App\Enums\Stripe\CouponDuration;

class CreateCouponCommand
{
    public function __construct(
        public readonly string $name,
        public readonly CouponDuration $duration,
        public readonly CouponAmountType $amountType,
        public readonly float $amountValue,
        public readonly ?\DateTimeImmutable $redeemByDate,
        public readonly ?int $redeemByCount,
    ) {}
}