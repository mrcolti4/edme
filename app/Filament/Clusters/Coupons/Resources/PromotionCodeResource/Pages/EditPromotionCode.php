<?php

namespace App\Filament\Clusters\Coupons\Resources\PromotionCodeResource\Pages;

use App\DTOs\UpdatePromoCodeCommand;
use App\Filament\Clusters\Coupons\Resources\PromotionCodeResource;
use App\Models\PromotionCode;
use App\Services\Stripe\StripeService;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPromotionCode extends EditRecord
{
    protected StripeService $stripeService;
    protected static string $resource = PromotionCodeResource::class;

    public function __construct()
    {
        $this->stripeService = app(StripeService::class);
    }

    protected function beforeSave(): void
    {
        $promoCode = PromotionCode::find($this->data['id']);
        $command = new UpdatePromoCodeCommand(
            id: $promoCode->stripe_id,
            isActive: $this->data['is_active'],
        );

        $this->stripeService->updatePromotionCode($command);
    }
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
