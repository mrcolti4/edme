<?php

namespace App\Filament\Clusters\Coupons\Pages;

use App\Filament\Clusters\Coupons;
use Filament\Pages\Page;

class ManageCoupons extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.clusters.coupons.pages.manage-coupons';

    protected static ?string $cluster = Coupons::class;
}
