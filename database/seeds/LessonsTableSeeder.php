<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class LessonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
      factory('App\Lesson', 30)->create();
      
      // foreach(range(1, 30) as $index) {
      //   DB::table('lessons')->insert([
      //     'title' => $faker->sentence(5),
      //     'body' => $faker->paragraph(4)
      //   ]);
      // }
    }
}
