<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'localization'], function(){

  Route::post('/register', 'API\UserController@register');
  Route::post('/login', 'API\UserController@login');
  Route::post('/resellerlogin', 'API\UserController@resellerlogin');
  Route::post('/forgotPassword', 'API\UserController@forgotPassword');
  Route::post('/socialRegister', 'API\UserController@socialRegister');
  Route::post('/testNotification', 'API\UserController@testNotification');
  Route::post('/upload_photo', 'API\UserController@upload_photo');
  Route::post('cmspages', 'API\UserController@cmsPages');
  Route::post('getFAQ', 'API\UserController@FAQ');

	Route::group(['middleware' => 'auth:api'], function(){
    Route::post('/logout', 'API\UserController@logout');
    Route::post('/changePassword', 'API\UserController@changePassword');
    Route::post('/updateProfile','API\UserController@updateProfile');
    Route::post('getProfile', 'API\UserController@getProfile');
  });
});