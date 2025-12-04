<?php

namespace Database\Seeders;

use App\Models\Posts;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;
class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 10 posts with random human-like title and content
        $faker = FakerFactory::create();
        for ($i = 0; $i < 10; $i++) {
            Posts::create([
                'title' => $faker->sentence(rand(3, 7)),
                'content' => $faker->paragraph(rand(2, 5)),
            ]);
        }

    }
}
