<?php

namespace App\Filament\Clusters\Coupons\Resources\CouponResource\Pages;

use App\DTOs\CreateCouponCommand;
use App\Enums\Stripe\CouponAmountType;
use App\Enums\Stripe\CouponDuration;
use App\Filament\Clusters\Coupons\Resources\CouponResource;
use App\Services\Stripe\StripeService;
use Filament\Forms\Components\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreateCoupon extends CreateRecord
{
    protected StripeService $stripeService;
    protected static string $resource = CouponResource::class;

    public function __construct()
    {
        $this->stripeService = app(StripeService::class);
    }
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data[CouponAmountType::from($this->data['type'])->value] = $this->data['amount'];

        $command = new CreateCouponCommand(
            name: $this->data['name'],
            duration: CouponDuration::from($this->data['duration']),
            amountType: CouponAmountType::from($this->data['type']),
            amountValue: $this->data['amount'],
            redeemByDate: $this->data['redeem_by'] ? new \DateTimeImmutable($this->data['redeem_by']) : null,
            redeemByCount: $this->data['redeem_by_count']
        );

        $coupon = $this->stripeService->createCoupon($command);
        $data['stripe_id'] = $coupon->id;
        
        return $data;
    }

    public static function createOptionAction(Action $action) {
        $action->mutateFormDataUsing(function (array $data) {
            $data[CouponAmountType::from($data['type'])->value] = $data['amount'];
            $command = new CreateCouponCommand(
                name: $data['name'],
                duration: CouponDuration::from($data['duration']),
                amountType: CouponAmountType::from($data['type']),
                amountValue: $data['amount'],
                redeemByDate: isset($data['redeem_by']) ? new \DateTimeImmutable($data['redeem_by']) : null,
                redeemByCount: $data['redeem_by_count'] ?? null
            );

            $stripeService = app(StripeService::class);
            $coupon = $stripeService->createCoupon($command);
            $data['stripe_id'] = $coupon->id;

            $data = array_diff_key($data, ['redeem' => true, 'type' => true, 'amount' => true]);

            return $data;
        });
    }
}
