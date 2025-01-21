<?php

declare(strict_types=1);

namespace App\DTOs;

class CreatePromoCodeCommand
{
    public function __construct(
        public readonly string $couponId,
        public readonly string $code,
        public readonly ?\DateTimeImmutable $expiresAt,
        public readonly ?int $maxRedemptions,
        public readonly ?bool $firstTimeTransaction,
        public readonly bool $isActive,
        public readonly ?int $minimumAmount,
    ) {}

    public function toArray(): array
    {
        return [
            'coupon' => $this->couponId,
            'code' => $this->code,
            'expires_at' => $this->expiresAt?->getTimestamp(),
            'max_redemptions' => $this->maxRedemptions,
            'active' => $this->isActive,
            'restrictions' => [
                'first_time_transaction' => $this->firstTimeTransaction,
                'minimum_amount' => $this->minimumAmount,
                'minimum_amount_currency' => $this->minimumAmount ? 'USD' : null,
            ]
        ];
    }
}