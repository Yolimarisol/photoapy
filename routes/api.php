<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\SessionUserController;
use App\Http\Controllers\CollectionController;
use Illuminate\Auth\Events\Logout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('user/register',[RegisterUserController::class,'register']);
Route::post('user/login',[SessionUserController::class,'login']);

Route::post('user/forgot-password',[PasswordController::class,'sendResetLinkResponse']);
Route::post('user/reset-password',[PasswordController::class,'sendResetResponse']);

Route::middleware('auth:sanctum')->group(function(){
    Route::get('user/logout',[SessionUserController::class,'logout']);

    Route::post('image/store',[ImageController::class,'store']);
    Route::get('image/index',[ImageController::class,'index']);
    Route::get('image/show/{id}',[ImageController::class,'show']);
    Route::put('image/update/{id}',[ImageController::class,'update']);
    Route::delete('image/delete/{id}',[ImageController::class,'delete']);

    Route::post('collection/create',[CollectionController::class,'create']);
    Route::get('collection/index',[CollectionController::class,'index']);
    Route::get('collection/show',[CollectionController::class,'show']);
    Route::put('collection/update/{id}',[CollectionController::class,'update']);
    Route::delete('collection/delete/{id}',[CollectionController::class,'delete']);
    Route::post('collection/image/{id}',[CollectionController::class,'addImage']);
    Route::get('activities/list',[ActivityLogController::class,'listmyactivities']);
});
