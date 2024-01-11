<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = new Product([
            'name' => 'product1',
            'category_id' => '1',
            'description' => 'description1',
            'price' => 12,
            'photo' => 'https://images-na.ssl-images-amazon.com/images/I/31b4K-hFH-L._SX395_BO1,204,203,200_.jpg'
        ]);
        $product->save();

        $product = new Product([
            'name' => 'product2',
            'category_id' => '2',
            'description' => 'description2',
            'price' => 12,
            'photo' => 'https://images-na.ssl-images-amazon.com/images/I/31b4K-hFH-L._SX395_BO1,204,203,200_.jpg'
        ]);
        $product->save();

        $product = new Product([
            'name' => 'product3',
            'category_id' => '2',
            'description' => 'description3',
            'price' => 12,
            'photo' => 'https://images-na.ssl-images-amazon.com/images/I/31b4K-hFH-L._SX395_BO1,204,203,200_.jpg'
        ]);
        $product->save();

        $product = new Product([
            'name' => 'product4',
            'category_id' => '3',
            'description' => 'description4',
            'price' => 12,
            'photo' => 'https://images-na.ssl-images-amazon.com/images/I/31b4K-hFH-L._SX395_BO1,204,203,200_.jpg'
        ]);
        $product->save();
    }
}