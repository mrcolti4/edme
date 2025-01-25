<?php

namespace App\Filament\Clusters\Coupons\Resources\CouponResource\Pages;

use App\DTOs\UpdateCouponCommand;
use App\Filament\Clusters\Coupons\Resources\CouponResource;
use App\Models\Coupon;
use App\Services\Stripe\StripeService;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCoupon extends EditRecord
{
    protected StripeService $stripeService;
    protected static string $resource = CouponResource::class;

    public function __construct()
    {
        $this->stripeService = app(StripeService::class);
    }

    protected function beforeSave(): void
    {
        $coupon = Coupon::find($this->data['id']);
        $command = new UpdateCouponCommand(
            id: $coupon->stripe_id,
            name: $this->data['name'],
        );

        $this->stripeService->updateCoupon($command);
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
