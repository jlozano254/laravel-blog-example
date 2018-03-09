<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::whereEmail('admin@example.com')->first();

        factory(Post::class, 20)->create([
            'user_id' => $user->id,
        ]);
    }
}
