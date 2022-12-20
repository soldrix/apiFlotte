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
Route::post('/register', 'AuthController@register');
Route::post('/login', 'AuthController@login');
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', 'AuthController@logout');
    Route::post('/user/edit/name', 'AuthController@updateName');
    Route::post('/user/edit/email', 'AuthController@updateEmail');
    Route::post('/user/edit/password', 'AuthController@updatePassword');
    Route::post('/user/delete', 'AuthController@delete');
    Route::get('/user','AuthController@getUser');
});
