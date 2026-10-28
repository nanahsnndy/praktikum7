<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;

class PostTableSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            Post::create([
                'title' => 'Post Judul Ke-' . $i,
                'description' => 'Deskripsi untuk post judul ke-' . $i,
            ]);
        }
    }
}
