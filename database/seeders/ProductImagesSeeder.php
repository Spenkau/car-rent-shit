<?php

namespace Database\Seeders;

use App\Models\ProductImage;
use Illuminate\Database\Seeder;

class ProductImagesSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $images = [
            ['id' => 1, 'product_id' => 1, 'path' => 'images/cars/tesla-model-3-01.jpeg'],
            ['id' => 2, 'product_id' => 1, 'path' => 'images/cars/tesla-model-3-02.jpeg'],
            ['id' => 3, 'product_id' => 1, 'path' => 'images/cars/tesla-model-3-03.jpeg'],
            ['id' => 4, 'product_id' => 2, 'path' => 'images/cars/ford-mustang-01.jpg'],
            ['id' => 5, 'product_id' => 2, 'path' => 'images/cars/ford-mustang-02.jpg'],
            ['id' => 6, 'product_id' => 2, 'path' => 'images/cars/ford-mustang-03.jpg'],
            ['id' => 7, 'product_id' => 3, 'path' => 'images/cars/bmw-m4-01.jpeg'],
            ['id' => 8, 'product_id' => 3, 'path' => 'images/cars/bmw-m4-02.jpeg'],
            ['id' => 9, 'product_id' => 3, 'path' => 'images/cars/bmw-m4-03.jpeg'],
            ['id' => 10, 'product_id' => 4, 'path' => 'images/cars/toyota-supra-01.jpg'],
            ['id' => 11, 'product_id' => 4, 'path' => 'images/cars/toyota-supra-02.jpg'],
            ['id' => 12, 'product_id' => 4, 'path' => 'images/cars/toyota-supra-03.jpg'],
            ['id' => 13, 'product_id' => 5, 'path' => 'images/cars/porsche-911-01.jpg'],
            ['id' => 14, 'product_id' => 5, 'path' => 'images/cars/porsche-911-02.jpg'],
            ['id' => 15, 'product_id' => 5, 'path' => 'images/cars/porsche-911-03.jpg'],
        ];

        foreach ($images as $image) {
            ProductImage::query()->updateOrCreate(
                ['id' => $image['id']],
                [
                    'product_id' => $image['product_id'],
                    'path' => $image['path'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
