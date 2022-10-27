<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = \App\Models\User::factory(10)->create();
        $posts = \App\Models\Post::factory(10)->create();
        $categories = \App\Models\Category::factory(10)->create();

        foreach ($posts as $post) {
            $post->author()->associate($users->random())->save();
            $post->categories()->sync(
                $categories->random(3)
            );
        }
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',s
        //     'email' => 'test@example.com',
        // ]);
    }
}
