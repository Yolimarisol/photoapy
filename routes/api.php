<?php

use App\Http\Controllers\PasswordController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\SessionUserController;
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
});
