<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AgenceController;
use App\Http\Controllers\VoitureController;
use App\Http\Controllers\AssuranceController;
use App\Http\Controllers\ConsommationController;
use App\Http\Controllers\EntretienController;
use App\Http\Controllers\ReparationController;
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

    Route::get('/agences',[AgenceController::class , 'index']);
    Route::get('/agence/{id}',[AgenceController::class , 'show']);
    Route::post('/agence/create',[AgenceController::class , 'store']);
    Route::post('/agence/update',[AgenceController::class , 'update']);
    Route::delete('/agence/delete/{id}',[AgenceController::class , 'destroy']);

    Route::post('/voiture/create', [VoitureController::class, 'store']);
    Route::get('/voiture/{id}', [VoitureController::class, 'show'])->where('path', '.*');
    Route::get('/voitures',[VoitureController::class, 'index']);
    Route::post('/voiture/update',[VoitureController::class, 'update']);
    Route::delete('/voiture/delete/{id}',[VoitureController::class, 'destroy']);

    Route::post('/assurance/create',[AssuranceController::class, 'store']);
    Route::get('/assurances', [AssuranceController::class, "index"]);
    Route::get('/assurance/{id}', [AssuranceController::class, "show"]);
    Route::post('/assurance/update', [AssuranceController::class, "update"]);
    Route::delete('/assurance/delete/{id}',[AssuranceController::class, 'destroy']);

    Route::post('/consommation/create',[ConsommationController::class, 'store']);
    Route::get('/consommations', [ConsommationController::class, "index"]);
    Route::get('/consommation/{id}', [ConsommationController::class, "show"]);
    Route::post('/consommation/update', [ConsommationController::class, "update"]);
    Route::delete('/consommation/delete/{id}',[ConsommationController::class, 'destroy']);

    Route::post('/entretien/create',[EntretienController::class, 'store']);
    Route::get('/entretiens', [EntretienController::class, "index"]);
    Route::get('/entretien/{id}', [EntretienController::class, "show"]);
    Route::post('/entretien/update', [EntretienController::class, "update"]);
    Route::delete('/entretien/delete/{id}',[EntretienController::class, 'destroy']);

    Route::post('/reparation/create',[ReparationController::class, 'store']);
    Route::get('/reparations', [ReparationController::class, "index"]);
    Route::get('/reparation/{id}', [ReparationController::class, "show"]);
    Route::post('/reparation/update', [ReparationController::class, "update"]);
    Route::delete('/reparation/delete/{id}',[ReparationController::class, 'destroy']);
});
