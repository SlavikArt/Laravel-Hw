<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
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
        // Create 10 users
        $users = User::factory(10)->create();

        // For each user, create 1-5 posts
        foreach ($users as $user) {
            $posts = Post::factory(rand(1, 5))->create([
                'user_id' => $user->id
            ]);

            // For each post, create 2-10 comments
            foreach ($posts as $post) {
                Comment::factory(rand(2, 10))->create([
                    'post_id' => $post->id,
                    'user_id' => $users->random()->id
                ]);
            }
        }
    }
}
