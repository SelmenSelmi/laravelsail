<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Posts as PostsController;

Route::get('/posts', [PostsController::class, 'index']);
Route::get('/posts/{id}', [PostsController::class, 'show']);
Route::post('/posts', [PostsController::class, 'store']);
Route::put('/posts/{id}', [PostsController::class, 'update']);
Route::delete('/posts/{id}', [PostsController::class, 'destroy']);
