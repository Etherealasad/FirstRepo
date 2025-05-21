<?php

use App\Http\Controllers\API\postController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//User controller routes
Route::post('signup', [UserController::class, 'signup']);
Route::post('login',[UserController::class,'login']);
Route::post('logout',[UserController::class,'logout']);


//auth:sanctum routes
Route::middleware('auth:sanctum')->group(function()
{

    Route::post('logout',[UserController::class,'logout']);

    Route::apiResource('posts',postController::class);


});


                    