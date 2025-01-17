<?php

namespace App\Filament\Clusters\Coupons\Resources\PromotionCodeResource\Pages;

use App\Filament\Clusters\Coupons\Resources\PromotionCodeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePromotionCode extends CreateRecord
{
    protected static string $resource = PromotionCodeResource::class;
}
