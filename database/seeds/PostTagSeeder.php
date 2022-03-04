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
        //Metodo funzionale ma non perfetto, necessita di più controlli sugli accompiamenti di id, dato che possono uscire PrimaryKey Doppie.
        $posts = Post::all();
        // $tags = Tag::all();
        foreach ($posts as $post) {
            $randomNum = random_int(1, 4);
            for ($i = 0; $i < $randomNum; $i++) {
                $randomTag = Tag::inRandomOrder()->first()->id;
                $post->tags()->attach($randomTag);
            }
        }
    }
}
