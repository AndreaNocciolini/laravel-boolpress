<?php

Use Faker\Generator as Faker;

use Illuminate\Support\Facades\Hash;

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 60; $i++) {
            $newUser = new User();
            $newUser->name = $faker->name();
            $newUser->email = $faker->email();


            $fakePassword = 'fake23Password!!';

            $newUser->password = Hash::make($fakePassword);
            $newUser->save();
        }
    }
}
