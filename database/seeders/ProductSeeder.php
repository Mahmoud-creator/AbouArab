<?php

namespace Database\Seeders;

use App\Models\Addons;
use App\Models\Product;
use App\Models\ProductAddon;
use Database\Factories\ProductFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        Product::factory(46)->create();
        $faker = Faker::create();

        $imageDirectoryPath = public_path('storage/images');
        $imageFiles = File::files($imageDirectoryPath);
        $images = [];

        for($i=0;$i<46;$i++){
            $randomImage = $imageFiles[array_rand($imageFiles)];
            $randomImageName = $randomImage->getFilename();

            while(in_array($randomImageName, $images)){
                $randomImage = $imageFiles[array_rand($imageFiles)];
                $randomImageName = $randomImage->getFilename();
            }

            $images[] = $randomImageName;

            Product::create([
                'name' => $faker->firstNameMale(),
                'description' => $faker->sentence(8),
                'price' => $faker->numberBetween(1, 100),
                'image' => 'storage/images/' . $randomImageName
            ]);
        }
    }
}
