<?php

namespace App\Filament\Clusters\Coupons\Resources;

use App\Filament\Clusters\Coupons;
use App\Filament\Clusters\Coupons\Resources\PromotionCodeResource\Pages;
use App\Filament\Clusters\Coupons\Resources\PromotionCodeResource\RelationManagers;
use App\Models\PromotionCode;
use Filament\Forms;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PromotionCodeResource extends Resource
{
    protected static ?string $model = PromotionCode::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $cluster = Coupons::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('coupon')
                    ->relationship('coupon', 'id')
            ]);
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
            'index' => Pages\ListPromotionCodes::route('/'),
            'create' => Pages\CreatePromotionCode::route('/create'),
            'edit' => Pages\EditPromotionCode::route('/{record}/edit'),
        ];
    }
}
