<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with('settings');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Название'),
                TextInput::make('slug')
                    ->label('Слаг')
                    ->unique(table: 'products', column: 'slug'),
                Textarea::make('description')
                    ->label('Описание'),

                Section::make('Настройки продукта')->relationship('settings')->schema([
                    TextInput::make('settings.release_year')->label('Год выпуска')->numeric(),
                    Select::make('settings.gearbox_type')->label('Тип коробки передач')->options([
                        1 => 'Механика',
                        2 => 'Автомат',
                        3 => 'Вариатор',
                    ]),
                    TextInput::make('settings.engine_volume')->label('Объем двигателя')->numeric()->nullable(),
                    Select::make('settings.engine_type')->label('Тип двигателя')->options([
                        1 => 'Бензин',
                        2 => 'Дизель',
                        3 => 'Электро',
                        4 => 'Гибрид',
                    ])->nullable(),
                    Select::make('settings.drive_type')->label('Тип привода')->options([
                        1 => 'Передний',
                        2 => 'Задний',
                        3 => 'Полный',
                    ])->nullable(),
                    TextInput::make('settings.power')->label('Мощность (л.с.)')->numeric()->nullable(),
                    TextInput::make('settings.mileage')->label('Пробег (км)')->numeric()->nullable(),
                    TextInput::make('settings.doors_count')->label('Количество дверей')->numeric()->nullable(),
                    TextInput::make('settings.seats_count')->label('Количество мест')->numeric()->nullable(),
                    TextInput::make('settings.color')->label('Цвет')->nullable(),
                    TextInput::make('settings.vin')->label('VIN')->nullable(),
                    TextInput::make('settings.price')->label('Цена (в РУБ)')->numeric()->nullable(),
                    FileUpload::make('settings.model_3d')->label('3D модель')->nullable(),
                    FileUpload::make('settings.image')
                        ->directory('images/cars')
                        ->label('Изображение')
                        ->nullable(),
                ])->columns(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Название')
                    ->searchable(),
                TextColumn::make('slug')->label('Слаг'),
                TextColumn::make('created_at')
                    ->label('Дата создания')
                    ->dateTime(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->after(function ($record, array $data) {
                        Log::debug('product data: ', [$record, $data]);
                }),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }

    public static function getNavigationLabel(): string
    {
        return 'Автомобили';
    }

    public static function getPluralLabel(): string
    {
        return 'Автомобили';
    }

    public static function getModelLabel(): string
    {
        return 'Автомобиль';
    }

    public static function getCreateFormTitle(): string
    {
        return 'Создать Автомобиль';
    }

    public static function getEditFormTitle(): string
    {
        return 'Редактировать Автомобиль';
    }
}
