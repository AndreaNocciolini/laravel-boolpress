<?php
use App\Model\Post;
use App\Model\Tag;
use Illuminate\Database\Seeder;



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
        // $tags = Tag::all();
        foreach ($posts as $post) {
            $randomNum = random_int(1,4);
            $tags = Tag::inRandomOrder()->limit($randomNum)->get();
            $post->tags()->attach($tags);
        }
    }
}
