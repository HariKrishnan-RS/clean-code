<?php

use App\Http\Controllers\Api\V1\CommentController;
use App\Http\Controllers\Api\V1\LoginController;
use App\Http\Controllers\Api\V1\PostController;
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


Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1'], function () {
    Route::apiResource('login', LoginController::class)
        ->names(['index' => 'login']); //put request
    Route::apiResource('blog', PostController::class)
        ->middleware('auth:api');// if not authorised it redirect to a LoginController index function... the index function should have the name "login".. I dont know why
    Route::apiResource('blog/{id}/comment', CommentController::class)
        ->middleware('auth:api');
    Route::apiResource('blog/edit/{id}', PostController::class)
        ->middleware('auth:api');
});
