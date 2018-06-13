<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lesson;
use Illuminate\Support\Facades\Response;
use App\Http\Resources\Lesson as LessonRes;
use App\Http\Resources\LessonCollection;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\ApiController;

class LessonsController extends ApiController
{

    public function __construct()
    {
      $this->middleware('auth')->only(['store']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $limit = request()->input('limit') ?: 5;
      if ($limit > 20) {
        $limit = 20;
      }
      $lessons = Lesson::with('tags')->paginate($limit);
      //dd($lessons->tags);
      //dd($lessons->getCollection()[1]->relations);
      return LessonRes::collection($lessons);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      if (! $request->input('title') || ! $request->input('body') || ! $request->input('some_bool')) {
        //dd(is_numeric($request->input('some_bool')));
          return $this->paramsValidationFailed('Parameters failed validation for a lesson.');
      } else {
        if (! is_numeric($request->input('some_bool'))) {
          return $this->paramsValidationFailed('Please enter 0 for false or 1 for true.');
        }
        Lesson::create($request->all());

        return $this->respondCreated('Lesson successfully created.');
    }}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $lesson = Lesson::find($id);

      if(! $lesson) {
        return $this->reponseNotFound('Lesson does not exist.');
      }

      return new LessonRes($lesson);
      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
