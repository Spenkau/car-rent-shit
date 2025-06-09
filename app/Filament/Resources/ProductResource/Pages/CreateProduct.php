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

    /**
     * @throws Exception
     */
    protected function handleRecordCreation(array $data): Product
    {
        $product = Product::query()->create([
            'name' => $data['name'],
            'slug' => $data['slug'],
            'description' => $data['description'] ?? null,
        ]);

        if (isset($data['settings']) && !empty($data['settings'])) {
            $settingsData = $data['settings'];
            $settingsData['product_id'] = $product->id;

            if (empty($settingsData['release_year'])) {
                throw new Exception('Год выпуска обязателен.');
            }

            ProductSetting::query()->create($settingsData);
        } else {
            throw new Exception('Данные настроек продукта отсутствуют или не заполнены.');
        }

        return $product;
    }
}
