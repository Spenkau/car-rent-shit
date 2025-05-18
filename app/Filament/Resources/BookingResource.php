<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Filament\Resources\BookingResource\RelationManagers;
use App\Models\Booking;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label('Пользователь')
                    ->required(),
                Forms\Components\Select::make('product_id')
                    ->relationship('product', 'name')
                    ->label('Товар')
                    ->required(),
                Forms\Components\DatePicker::make('start_date')
                    ->label('Дата начала аренды')
                    ->required(),
                Forms\Components\DatePicker::make('end_date')
                    ->label('Дата конца аренды')
                    ->required(),
                Forms\Components\Select::make('status')
                    ->label('Статус')
                    ->options([
                        0 => 'В ожидании',
                        1 => 'Подтверждено',
                        2 => 'Завершено',
                    ])
                    ->required(),
                Forms\Components\Select::make('payment_status')
                    ->label('Статус платежа')
                    ->options([
                        0 => 'Не оплачено',
                        1 => 'Оплачено'
                    ])
                    ->required(),
                Forms\Components\TextInput::make('rating')->label('Оценка')->numeric()->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
                Tables\Columns\TextColumn::make('user.name')->label('Пользователь'),
                Tables\Columns\TextColumn::make('product.name')->label('Товар'),
                Tables\Columns\TextColumn::make('start_date')->label('Дата начала аренды'),
                Tables\Columns\TextColumn::make('end_date')->label('Дата конца аренды'),
                Tables\Columns\SelectColumn::make('status')->options([
                    0 => 'В ожидании',
                    1 => 'Подтверждено',
                    2 => 'Завершено'
                ])->label('Статус'),
                Tables\Columns\SelectColumn::make('payment_status')->options([
                    0 => 'Не оплачено',
                    1 => 'Оплачено'
                ])->label('Статус платежа'),
                Tables\Columns\TextInputColumn::make('rating')->label('Оценка')
            ])
            ->filters([

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
            'index' => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
            'edit' => Pages\EditBooking::route('/{record}/edit'),
        ];
    }

    public static function getNavigationLabel(): string
    {
        return 'Заказы';
    }

    public static function getPluralLabel(): string
    {
        return 'Заказы';
    }

    public static function getModelLabel(): string
    {
        return 'Заказ';
    }

    public static function getEditFormTitle(): string
    {
        return 'Редактировать заказ';
    }
}
