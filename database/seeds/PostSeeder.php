<?php

use Faker\Generator as Faker;
use App\Model\Post;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 120; $i++) { 
            $newPost = new Post();
            $newPost->title = $faker->words(9, true);
            $newPost->content = $faker->paragraph(5, true);
            $newPost->slug = Str::slug($newPost->title . "-$i", '-');

            $newPost->save();
        }
    }
}
