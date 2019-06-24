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
Route::get('/monitoring/{id}', 'ApiController@monitoring');
Route::prefix('v1')->group(function () {
  Route::get('/monitoring/ask/{id}', 'ApiController@monitoringASK');
  Route::get('/monitoring/taksi/{id}', 'ApiController@monitoringTaksi');
  Route::get('/jatuhtempo', 'ApiController@jatuhtempo');
  Route::get('/lewatjatuhtempo', 'ApiController@lewatjatuhtempo');

  Route::middleware('auth:api')->get('/user', function (Request $request) {
      return $request->user();
  });
});
