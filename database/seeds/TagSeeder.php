<?php

use Illuminate\Database\Seeder;

use App\Model\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            'Technology',
            'Business',
            'Cinema',
            'Geography',
            'Videogame',
            'Math',
            'Travel',
            'Animal',
        ];

        foreach ($tags as $tag) {
            
            $newTag = new Tag();
            $newTag->name = $tag;
            $newTag->save();
        }
    }
}
