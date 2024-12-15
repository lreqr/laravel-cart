<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        User::factory()->create([
            'name' => 'Test User 2',
            'email' => 'test2@example.com',
        ]);

        Product::factory(40)->create()->each(function ($product){
            $name = fake()->words(3, true);
            $description = fake()->paragraph();

            $product->translations()->create([
                'locale' => 'en',
                'name' => $name,
                'description' => $description,
            ]);
            $product->translations()->create([
                'locale' => 'ru',
                'name' => transliterateToRussian($name),
                'description' => transliterateToRussian($description),
            ]);
        });


    }
}
