<?php

namespace App\Filament\Clusters\Coupons\Resources\PromotionCodeResource\Pages;

use App\DTOs\CreatePromoCodeCommand;
use App\Filament\Clusters\Coupons\Resources\PromotionCodeResource;
use App\Models\Coupon;
use App\Services\Stripe\StripeService;
use Filament\Resources\Pages\CreateRecord;

class CreatePromotionCode extends CreateRecord
{
    protected StripeService $stripeService;
    protected static string $resource = PromotionCodeResource::class;

    public function __construct()
    {
        $this->stripeService = app(StripeService::class);
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $coupon = Coupon::find($data['coupon']);
        
        $command = new CreatePromoCodeCommand(
            couponId: $coupon->stripe_id,
            code: $data['code'],
            expiresAt: $data['expires_at'] ? new \DateTimeImmutable($data['expires_at']) : null,
            maxRedemptions: $data['max_redemptions'],
            firstTimeTransaction: $data['first_time_transaction'],
            isActive: $data['is_active'],
            minimumAmount: $data['minimum_amount']
        );

        $promoCode = $this->stripeService->createPromotionCode($command);

        $data['coupon_id'] = $data['coupon'];
        $data['stripe_id'] = $promoCode->id;
        
        return $data;
    }
}
