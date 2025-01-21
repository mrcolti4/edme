<?php

namespace App\Filament\Clusters\Coupons\Resources;

use App\DTOs\CreateCouponCommand;
use App\Enums\Stripe\{CouponAmountType, CouponDuration};
use App\Filament\Clusters\Coupons;
use App\Filament\Clusters\Coupons\Resources\CouponResource\Pages\CreateCoupon;
use App\Filament\Clusters\Coupons\Resources\PromotionCodeResource\Pages;
use App\Models\{Coupon, PromotionCode};
use App\Services\Stripe\StripeService;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\{Checkbox, Select, TextInput, DatePicker, Fieldset};
use Filament\Forms\{Form, Get, Set};
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Log;

class PromotionCodeResource extends Resource
{
    protected StripeService $stripeService;

    protected static ?string $model = PromotionCode::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $cluster = Coupons::class;

    public function __construct()
    {
        $this->stripeService = app(StripeService::class);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('coupon')
                    ->relationship('coupon', 'name')
                    ->createOptionForm(function () {
                        return CouponResource::getCouponFormSchema();
                    })
                    ->createOptionAction(
                        fn (Action $action) => CreateCoupon::createOptionAction($action)
                    )
                    ->required(),
                TextInput::make('code')
                    ->label('Code')
                    ->required(),
                DatePicker::make('expires_at')
                    ->label('Expires at'),
                TextInput::make('max_redemptions')
                    ->label('Max redemptions'),
                Fieldset::make('Restritions')
                    ->schema([
                        Checkbox::make('first_time_transaction')
                            ->label('First time transaction'),
                        TextInput::make('minimum_amount')
                            ->label('Minimum amount'),
                    ])
                    ->columns(1)
                    ->columnSpan(1),
                Checkbox::make('is_active')
                    ->label('Whether the promotion code is currently active.')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code'),
                TextColumn::make('expires_at'),
                TextColumn::make('max_redemptions'),
                TextColumn::make('first_time_transaction'),
                TextColumn::make('minimum_amount'),
                TextColumn::make('is_active'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPromotionCodes::route('/'),
            'create' => Pages\CreatePromotionCode::route('/create'),
            'edit' => Pages\EditPromotionCode::route('/{record}/edit'),
        ];
    }
}
