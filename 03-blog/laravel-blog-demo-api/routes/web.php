<?php

use App\Exceptions\MySuperException;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('posts', PostController::class);
Route::resource('comments', CommentController::class);
Route::resource('tags', TagController::class);
Route::resource('likes', LikeController::class);

Route::get('/test-exception', function () {
    throw new MySuperException('Це тестова супер помилка!', 418);
});
