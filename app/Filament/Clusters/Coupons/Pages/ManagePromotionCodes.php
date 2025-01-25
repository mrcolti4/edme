<?php

namespace App\Filament\Clusters\Coupons\Pages;

use App\Filament\Clusters\Coupons;
use Filament\Pages\Page;

class ManagePromotionCodes extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.clusters.coupons.pages.manage-promotion-codes';

    protected static ?string $cluster = Coupons::class;
}
