<?php

namespace App\Filament\Clusters\Coupons\Pages;

use App\Filament\Clusters\Coupons;
use App\Models\Coupon;
use App\Services\Stripe\StripeService;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;

class ManageCoupons extends Page implements HasForms, HasTable
{
    use InteractsWithTable;
    
    public StripeService $stripeService;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.clusters.coupons.pages.manage-coupons';

    protected static ?string $cluster = Coupons::class;

    public function table(Table $table): Table
    {
        return $table
            ->query(Coupon::query())
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('percent_off'),
                TextColumn::make('amount_off'), 
                TextColumn::make('duration'),
                TextColumn::make('redeem_by'),
                TextColumn::make('redeem_by_count'),
                TextColumn::make('times_redeemed')
            ]);
    }
}
