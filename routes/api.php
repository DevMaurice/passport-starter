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

Route::group(['namespace' => 'Api'], function () {
    Route::post('/register', 'UserController@register'); //http://localhost:8000/api/register
    Route::group(['middleware' =>['auth:api']], function () {
        Route::post('/logout', 'UserController@logout'); //http://localhost:8000/api/logout
    });
});
