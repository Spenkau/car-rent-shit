<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use App\Models\Product;
use App\Models\ProductSetting;
use Exception;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    protected function afterCreate(): void
    {
        $product = $this->record;

        if (! $product instanceof Product) {
            return;
        }

        $settings = array_filter(data_get($this->data, 'settings'));

        if (isset($settings['image'])) {
            $imagePath = array_pop($settings['image']);
            unset($settings['image']);

            $product->images()->create([
                'path' => $imagePath
            ]);
        }

        $product->settings()->create($settings);
    }
}
