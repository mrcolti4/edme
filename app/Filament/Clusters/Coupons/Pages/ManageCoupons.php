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
    use InteractsWithForms;
    use InteractsWithTable;
    
    public StripeService $stripeService;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.clusters.coupons.pages.manage-coupons';

    protected static ?string $cluster = Coupons::class;
    
    public function getFormSchema(): array
    {
        return [
            TextInput::make('name')->label('Name')->required(),
            TextInput::make('code')->label('Code')->required(),
        ];
    }

    public function getFormActions(): array
    {
        return [
            Action::make('greet')
            ->action(function () {
                Notification::make()
                    ->title(__('Hello ' . $this->name))
                    ->success()
                    ->send();
            }),        
        ];
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(Coupon::query())
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('code'),
            ]);
    }
}
