<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => "Kaaek",
            'image' => "storage/icons/burger.svg",
            'white_image' => "storage/icons/burger-white.svg",
        ]);
        Category::create([
            'name' => "Double/Triple Cheese",
            'image' => "storage/icons/burger.svg",
            'white_image' => "storage/icons/burger-white.svg",
        ]);
        Category::create([
            'name' => "Pizza",
            'image' => "storage/icons/burger.svg",
            'white_image' => "storage/icons/burger-white.svg",
        ]);
        Category::create([
            'name' => "Beverages",
            'image' => "storage/icons/burger.svg",
            'white_image' => "storage/icons/burger-white.svg",
        ]);
        Category::create([
            'name' => "Deserts",
            'image' => "storage/icons/burger.svg",
            'white_image' => "storage/icons/burger-white.svg",
        ]);
    }
}
