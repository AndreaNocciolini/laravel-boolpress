<?php

use Faker\Generator as Faker;

use App\Model\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 20; $i++) {
            $newCategory = new Category();
            $newCategory->name = $faker->jobTitle();
            $slug = "$newCategory->name-$i";
            $newCategory->slug = Str::slug($slug, '-');

            $newCategory->save();
        }
    }
}
