<?php

use Illuminate\Database\Seeder;

use App\Model\Post;
use App\Model\Tag;

class PostTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = Post::all();
        $tags = Tag::all();
        foreach ($posts as $post) {
            $randomTag = Tag::inRandomOrder()->first()->id;
            $post->tags()->attach($randomTag);
            
        
        }
    }
}
