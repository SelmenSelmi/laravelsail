<?php

use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Posts as PostsController;
use App\Services\NasaApodService;

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/', function () {
    return view('welcome');
});
Route::post('/logout', [LoginController::class, 'logout']);


Route::get('/post/create', function () {
    return view('posts.create');
});
Route::get('/register', function () {
    return view('register');
});
Route::middleware('auth:sanctum')->group(function () {
Route::post('/register', [RegisterController::class, 'registerWeb'])->name('register');

Route::get('/post/{id}', function ($id) {
    $post = \App\Models\Posts::find($id);
    if (! $post) {
        abort(404);
    }
    return view('posts.show', ['post' => $post]);
});


Route::get('/edit/{id}', function ($id) {
    $post = \App\Models\Posts::find($id);
    if (! $post) {
        abort(404);
    }
    return view('posts.edit', ['post' => $post]);
});
Route::post('/post', [PostsController::class, 'store']);
Route::put('/post/{id}', [PostsController::class, 'update']);
Route::delete('/post/{id}', [PostsController::class, 'destroy']);
Route::get('/post', function () {
    $posts = \App\Models\Posts::all();
    $nasaImg = app(NasaApodService::class)->getImageUrl();
    return view('posts.index', compact('posts', 'nasaImg'));
});
});