<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use App\Models\Product;
use App\Models\ProductSetting;
use Doctrine\DBAL\Schema\View;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function beforeSave(): void
    {
        if (!empty($this->data['settings']) && !empty($this->data['id'])) {
            $settings = array_filter($this->data['settings']);

            if (isset($settings['image'])) {
                $imagePath = array_pop($settings['image']);
                unset($settings['image']);

                $this->record->images()->create([
                    'product_id' => $this->record->id,
                    'path' => $imagePath
                ]);
            }

            ProductSetting::query()->where('product_id', '=', $this->data['id'])->update($settings);
        }
    }
}
