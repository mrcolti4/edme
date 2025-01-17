<?php

namespace App\Filament\Clusters\Coupons\Resources;

use App\Filament\Clusters\Coupons;
use App\Filament\Clusters\Coupons\Resources\CouponResource\Pages;
use App\Models\Coupon;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Log;

class CouponResource extends Resource
{
    protected static ?string $model = Coupon::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $cluster = Coupons::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->label('Name')->required(),
                Radio::make('type')
                    ->options([
                        'percent_off' => 'Percentage discount',
                        'amount_off' => 'Fixed amount discount',
                    ])->label('Type')->required(),
                TextInput::make('amount')->label('Amount')->required(),
                Select::make('duration')
                    ->options([
                        'forever' => 'Forever',
                        'once' => 'Once',
                    ])->label('Duration')->required(),
                CheckboxList::make('redeem')
                    ->options([
                        'date' => 'Date',
                        'count' => 'Count',
                    ])
                    ->descriptions([
                        'date' => 'Limit the date range when customers can redeem this coupon',
                        'count' => 'Limit the total number of times this coupon can be redeemed',
                    ])
                    ->label('Redeem by')
                    ->required()
                    ->live(),
                DatePicker::make('redeem_by')
                    ->label('Redeem by date')
                    ->hidden(fn (Get $get) => ! in_array('date', $get('redeem')))
                    ->required(),
                TextInput::make('redeem_count')
                    ->label('Redeem by count')
                    ->hidden(fn (Get $get) => ! in_array('count', $get('redeem')))
                    ->required(),
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListCoupons::route('/'),
            'create' => Pages\CreateCoupon::route('/create'),
            'edit' => Pages\EditCoupon::route('/{record}/edit'),
        ];
    }
}
