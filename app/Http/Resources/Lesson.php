<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Response;
use App\Lesson as LessonModel;
use App\Tag;

class Lesson extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
      //return parent::toArray($request);
      return [
        'title' => $this->title,
        'body' => $this->body,
        'tags' => $this->tagsFormating(),
        'active' => (boolean) $this->some_bool
      ];
    }

    private function tagsFormating() {
      $removeBrackets = trim($this->tags->pluck('name'), '[]');
      $removeDoubleQoutes = str_replace('"', "", $removeBrackets);
      $addSpace = str_replace(',', ', ', $removeDoubleQoutes);
      return $addSpace;
    }

    

}
