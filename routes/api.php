<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AgenceController;
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
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/user/edit/name', [UserController::class, 'updateName']);
    Route::post('/user/edit/email', [UserController::class, 'updateEmail']);
    Route::post('/user/edit/password', [UserController::class, 'updatePassword']);
    Route::post('/user/delete', [UserController::class, 'delete']);
    Route::get('/user',[UserController::class, 'getUser']);

    Route::get('/agence/all',[AgenceController::class , 'index']);
    Route::get('/agence/{id}',[AgenceController::class , 'show']);
    Route::post('/agence/create',[AgenceController::class , 'store']);
    Route::post('/agence/update',[AgenceController::class , 'update']);
    Route::delete('/agence/delete/{id}',[AgenceController::class , 'destroy']);
});
