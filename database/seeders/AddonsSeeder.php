<?php

namespace Database\Seeders;

use App\Models\Addons;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AddonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed some example addons
        $addons = [
            ['name' => 'Extra Cheese', 'price' => 1.50, 'slug' => Str::slug('Extra Cheese')],
            ['name' => 'Bacon Bits', 'price' => 2.00, 'slug' => Str::slug('Bacon Bits')],
            ['name' => 'Guacamole', 'price' => 1.75, 'slug' => Str::slug('Guacamole')],
            ['name' => 'Jalapenos', 'price' => 1.25, 'slug' => Str::slug('Jalapenos')],
            ['name' => 'Mushrooms', 'price' => 1.50, 'slug' => Str::slug('Mushrooms')],
            ['name' => 'Sour Cream', 'price' => 1.20, 'slug' => Str::slug('Sour Cream')],
        ];

        // Insert data into the addons table
        foreach ($addons as $addon) {
            Addons::create($addon);
        }
    }
}
