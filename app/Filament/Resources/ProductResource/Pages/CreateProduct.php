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

    protected function afterSave(): void
    {
        if (!empty($this->data['settings'])) {
            $settings = array_filter($this->data['settings']);

            if (isset($settings['image'])) {
                $settings['image'] = array_pop($settings['image']);
            }

            $this->record->settings()->create($settings);
        }
    }
}
