<?php

namespace App\Filament\Clusters\Coupons\Resources\CouponResource\Pages;

use App\DTOs\CreateCouponCommand;
use App\Enums\Stripe\CouponAmountType;
use App\Enums\Stripe\CouponDuration;
use App\Filament\Clusters\Coupons\Resources\CouponResource;
use App\Services\Stripe\StripeService;
use Filament\Resources\Pages\CreateRecord;

class CreateCoupon extends CreateRecord
{
    protected StripeService $stripeService;
    protected static string $resource = CouponResource::class;

    public function __construct()
    {
        $this->stripeService = app(StripeService::class);
    }
    protected function beforeCreate(): void
    {
        $command = new CreateCouponCommand(
            name: $this->data['name'],
            duration: CouponDuration::from($this->data['duration']),
            amountType: CouponAmountType::from($this->data['type']),
            amountValue: $this->data['amount'],
            redeemByDate: $this->data['redeem_by'] ? new \DateTimeImmutable($this->data['redeem_by']) : null,
            redeemByCount: $this->data['redeem_count']
        );

        $this->stripeService->createCoupon($command);
    }
}
