<?php

namespace Database\Seeders;


use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = new \App\Models\Product([
            'name' => 'product1',
            'description' => 'description1',
            'price' => 12,
            'photo' => 'https://images-na.ssl-images-amazon.com/images/I/31b4K-hFH-L._SX395_BO1,204,203,200_.jpg'
        ]);
        $product->save(); $product = new \App\Models\Product([
            'name' => 'product1',
            'description' => 'description1',
            'price' => 12,
            'photo' => '...'
        ]);
        $product->save(); $product = new \App\Models\Product([
            'name' => 'product1',
            'description' => 'description1',
            'price' => 12,
            'photo' => '...'
        ]);
        $product->save(); $product = new \App\Models\Product([
            'name' => 'product1',
            'description' => 'description1',
            'price' => 12,
            'photo' => '...'
        ]);
        $product->save();
        $product = new \App\Models\Product([
            'name' => 'product1',
            'description' => 'description1',
            'price' => 12,
            'photo' => '...'
        ]);
        $product->save();
    }
}