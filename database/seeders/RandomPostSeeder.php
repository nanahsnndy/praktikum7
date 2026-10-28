<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;

class RandomPostSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 25; $i++) {
            Post::create([
                'title' => 'Post Acak ' . fake()->words(3, true),
                'description' => fake()->paragraph(),
            ]);
        }
    }
}
