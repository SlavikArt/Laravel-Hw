<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            ['name' => 'Laptop', 'price' => 999.99],
            ['name' => 'Smartphone', 'price' => 599.99],
            ['name' => 'Headphones', 'price' => 149.99],
            ['name' => 'Tablet', 'price' => 399.99],
            ['name' => 'Keyboard', 'price' => 79.99],
            ['name' => 'Mouse', 'price' => 29.99],
            ['name' => 'Monitor', 'price' => 299.99],
            ['name' => 'Webcam', 'price' => 89.99],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
