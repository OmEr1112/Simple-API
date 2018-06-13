<?php

use Illuminate\Database\Seeder;
use App\Lesson;
use App\Tag;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * @var array
     */
    private $tables = [
      'lessons',
      'tags',
      'users',
      'lesson_tag'
    ];

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      $this->cleanDatabase();

      Model::unguard();

      $this->call(LessonsTableSeeder::class);
      $this->call(UsersTableSeeder::class);
      $this->call(TagsTableSeeder::class);
      $this->call(LessonTagTableSeeder::class);
    }

    private function cleanDatabase() {
      DB::statement('SET FOREIGN_KEY_CHECKS=0');

      foreach ($this->tables as $tableName) {
        DB::table($tableName)->truncate();
      }
      
      DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
