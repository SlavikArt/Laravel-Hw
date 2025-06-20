<?php

use App\Exceptions\MySuperException;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\TagController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('tags', TagController::class);
Route::apiResource('posts', PostController::class);
Route::apiResource('comments', CommentController::class);
Route::apiResource('likes', LikeController::class);

Route::put('/posts/{post}/publish', [PostController::class, 'publish']);

Route::get('/test-exception', function () {
    throw new MySuperException('Це тестова супер помилка для API!', 418);
});
