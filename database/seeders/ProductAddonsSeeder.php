<?php

namespace Database\Seeders;

use App\Models\Addons;
use App\Models\Product;
use App\Models\ProductAddon;
use Illuminate\Database\Seeder;

class ProductAddonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach(Product::all() as $product){
            // create new product
            foreach(Addons::all() as $addon){
                ProductAddon::create([
                    'product_id' => $product->id,
                    'addon_id' => $addon->id
                ]);
            }
        }
    }
}
