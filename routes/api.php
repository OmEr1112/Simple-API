<?php

use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::middleware('auth:api')->get('/lessons', function (Request $request) {
//     return $request->user();
// });

// Route::group(['prefix' => 'v1', 'middleware' => 'auth:api'], function(){
//   Route::get('/lessons','LessonsController@index');
//   Route::post('/lessons', 'LessonsController@store');
//   Route::get('/lessons/{lesson}', 'LessonsController@show');
// });

// \DB::listen(function ($query) {

//   var_dump($query->sql);
// });

Route::group(['prefix' => '/v1'], function() {  //'middleware' => 'auth:api'
  
  Route::get('lessons/{id}/tags', 'TagsController@index');
  
  Route::apiResource('/lessons', 'LessonsController');
  
  Route::apiResource('/tags', 'TagsController', ['only' => ['index', 'show']]);
});
