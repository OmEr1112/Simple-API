<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Lesson;
use App\Tag;

class LessonTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
      $lessonIds = Lesson::all()->pluck('id')->toArray();
      $tagIds = Tag::all()->pluck('id')->toArray();

      foreach (range(1, 30) as $index) {
        DB::table('lesson_tag')->insert([
          'lesson_id' => $faker->randomElement($lessonIds),
          'tag_id' => $faker->randomElement($tagIds)
        ]);
      }
    }
}
