<?php

namespace Database\Seeders;


use App\Http\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        factory(Product::class, 50)->create();
    }
}