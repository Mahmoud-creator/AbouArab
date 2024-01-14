<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Factory::create();

        for ($i = 0; $i < 500; $i++) {
            $date = Carbon::create(2024, rand(1, 12), rand(1, 28), 0, 0, 0);
            DB::table('orders')->insert([
                'user_id' => rand(7, 37),
                'name' => $faker->name,
                'email' => $faker->email,
                'phone' => $faker->phoneNumber,
                'region' => $faker->state,
                'address' => $faker->address,
                'amount' => $faker->randomFloat(2, 10, 1000),
                'note' => $faker->sentence,
                'paid' => $faker->boolean,
                'created_at' => $date,
                'updated_at' => $date
            ]);
        }
    }
}
