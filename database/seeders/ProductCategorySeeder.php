<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cat = 1;
        $catNum = 0;
        for ($i=31;$i<=60;$i++){
            ProductCategory::create([
                'product_id' => $i,
                'category_id' => $cat
            ]);
            $catNum++;
            if ($catNum % 5 == 0) {
                $catNum = 0;
                $cat++;
            }
        }
    }
}
