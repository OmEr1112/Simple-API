<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
  protected $fillable = ['title', 'body', 'some_bool'];

  public function tags() {
    return $this->belongsToMany('App\Tag');
  }

  public static function tagsNames($id) {
    $tagsArr = self::find($id)->tags->pluck('name');

    
    $tags = "";
    foreach($tagsArr as $key => $value) {
      $tags .= ", " . $value;
    }

    return trim($tags, ", ");
  }
}
