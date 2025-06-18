<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        
        if ($user) {
            Post::create([
                'title' => 'First Post',
                'content' => 'This is the content of the first post. It demonstrates how posts work in our application.',
                'user_id' => $user->id
            ]);
            
            Post::create([
                'title' => 'Second Post',
                'content' => 'This is another post to show multiple posts in the system.',
                'user_id' => $user->id
            ]);
        }
    }
}
