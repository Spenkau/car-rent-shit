<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cars = [
            [
                'product' => [
                    'name' => 'Tesla Model 3',
                    'description' => 'Современный электрический седан с автопилотом и высокой производительностью.',
                    'slug' => 'tesla-model-3',
                ],
                'settings' => [
                    'release_year' => 2022,
                    'gearbox_type' => 'автомат',
                    'engine_volume' => null,
                    'engine_type' => 'электрический',
                    'drive_type' => 'полный',
                    'power' => 450,
                    'mileage' => 15000,
                    'doors_count' => 4,
                    'seats_count' => 5,
                    'color' => 'черный',
                    'vin' => '5YJ3E1EA0NF123456',
                    'is_customs_cleared' => true,
                    'is_crashed' => false,
                    'is_on_credit' => false,
                    'price' => 90.00,
                    'model_3d' => 'models/tesla-model-3.glb',
                    'image' => 'images/cars/tesla-model-3.png',
                ],
            ],
            [
                'product' => [
                    'name' => 'Ford Mustang',
                    'description' => 'Классический американский маслкар с мощным двигателем и агрессивным дизайном.',
                    'slug' => 'ford-mustang',
                ],
                'settings' => [
                    'release_year' => 1965,
                    'gearbox_type' => 'механика',
                    'engine_volume' => 4.7,
                    'engine_type' => 'бензин',
                    'drive_type' => 'задний',
                    'power' => 271,
                    'mileage' => 50000,
                    'doors_count' => 2,
                    'seats_count' => 4,
                    'color' => 'красный',
                    'vin' => '1FA6P8TH0F5123456',
                    'is_customs_cleared' => true,
                    'is_crashed' => false,
                    'is_on_credit' => false,
                    'price' => 120.00,
                    'model_3d' => 'models/ford-mustang.glb',
                    'image' => 'images/cars/ford-mustang.png',
                ],
            ],
            [
                'product' => [
                    'name' => 'BMW M4',
                    'description' => 'Спортивное купе с выдающейся динамикой и премиальным интерьером.',
                    'slug' => 'bmw-m4',
                ],
                'settings' => [
                    'release_year' => 2021,
                    'gearbox_type' => 'автомат',
                    'engine_volume' => 3.0,
                    'engine_type' => 'бензин',
                    'drive_type' => 'задний',
                    'power' => 503,
                    'mileage' => 20000,
                    'doors_count' => 2,
                    'seats_count' => 4,
                    'color' => 'синий',
                    'vin' => 'WBS4Y9C0XMF123456',
                    'is_customs_cleared' => true,
                    'is_crashed' => false,
                    'is_on_credit' => false,
                    'price' => 100.00,
                    'model_3d' => 'models/bmw-m4.glb',
                    'image' => 'images/cars/bmw-m4.png',
                ],
            ],
            [
                'product' => [
                    'name' => 'Toyota Supra',
                    'description' => 'Легендарный спортивный автомобиль с отличной управляемостью.',
                    'slug' => 'toyota-supra',
                ],
                'settings' => [
                    'release_year' => 1998,
                    'gearbox_type' => 'механика',
                    'engine_volume' => 3.0,
                    'engine_type' => 'бензин',
                    'drive_type' => 'задний',
                    'power' => 320,
                    'mileage' => 80000,
                    'doors_count' => 2,
                    'seats_count' => 4,
                    'color' => 'серебристый',
                    'vin' => 'JT2DE82A0W0123456',
                    'is_customs_cleared' => true,
                    'is_crashed' => false,
                    'is_on_credit' => false,
                    'price' => 80.00,
                    'model_3d' => 'models/toyota-supra.glb',
                    'image' => 'images/cars/toyota-supra.png',
                ],
            ],
            [
                'product' => [
                    'name' => 'Porsche 911',
                    'description' => 'Иконический спортивный автомобиль с непревзойденным дизайном и производительностью.',
                    'slug' => 'porsche-911',
                ],
                'settings' => [
                    'release_year' => 2020,
                    'gearbox_type' => 'автомат',
                    'engine_volume' => 3.0,
                    'engine_type' => 'бензин',
                    'drive_type' => 'полный',
                    'power' => 443,
                    'mileage' => 10000,
                    'doors_count' => 2,
                    'seats_count' => 4,
                    'color' => 'белый',
                    'vin' => 'WP0AA2A0XLL123456',
                    'is_customs_cleared' => true,
                    'is_crashed' => false,
                    'is_on_credit' => false,
                    'price' => 150.00,
                    'model_3d' => 'models/porsche-911.glb',
                    'image' => 'images/cars/porsche-911.png',
                ],
            ],
        ];

        foreach ($cars as $car) {
            $product = Product::query()->create($car['product']);
            $product->settings()->create($car['settings']);
        }
    }
}
