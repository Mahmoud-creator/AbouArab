<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $imageDirectoryPath = public_path('storage/images');
        $imageFiles = File::files($imageDirectoryPath);
        $randomImage = $imageFiles[array_rand($imageFiles)];
        $randomImageName = $randomImage->getFilename();

        return [
            'name' => $this->faker->firstNameMale(),
            'description' => $this->faker->sentence(8),
            'price' => $this->faker->numberBetween(1, 100),
            'image' => 'storage/images/' . $randomImageName
        ];
    }
}
