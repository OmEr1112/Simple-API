<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Http\Resources\Tag as TagRes;
use App\Lesson;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($lessonId = null)
    {
      try {
        $limit = request()->input('limit') ?: 10;
        $tags = $lessonId ? Lesson::findOrFail($lessonId)->tags : Tag::paginate($limit);
        return TagRes::collection($tags);

      } catch (\Exception $e) {
        return $this->respondWithError('Resource Not Found');
      }
    }

    private function respondWithError($message, $statusCode = 404) {
      return $this->respond([
        'error' => [
          'message' => $message,
          'status_code' => $statusCode
        ]
        ], $statusCode);
    }

    private function respond($data, $statusCode, $headers = ['Accept' => 'application/json']) {
      //return response($data, $this->getStatusCode())->withHeaders($headers);
      return response()->json($data, $statusCode, $headers);
    }
}
