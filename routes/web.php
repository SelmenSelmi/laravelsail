<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/post', function () {
    return view('posts.index',['posts'=> \App\Models\Posts::all()]);
});
Route::get('/post/{id}', function ($id) {
    $post = \App\Models\Posts::find($id);
    if (! $post) {
        abort(404);
    }
    return view('posts.show', ['post' => $post]);
});