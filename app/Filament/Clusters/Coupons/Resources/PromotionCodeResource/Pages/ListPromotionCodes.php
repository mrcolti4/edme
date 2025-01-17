<?php

namespace App\Filament\Clusters\Coupons\Resources\PromotionCodeResource\Pages;

use App\Filament\Clusters\Coupons\Resources\PromotionCodeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPromotionCodes extends ListRecords
{
    protected static string $resource = PromotionCodeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
