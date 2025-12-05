<?php

use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Posts as PostsController;
use App\Services\NasaApodService;
use App\Models\Posts;
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

Route::get('/posts/comments', function () {
    $comments = \App\Models\Comments::all();
    return view('posts.comments.index', ['comments' => $comments]);
});
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
Route::post('/posts/comments', [\App\Http\Controllers\CommentsController::class, 'store']);
Route::put('/post/{id}', [PostsController::class, 'update']);
Route::delete('/post/{id}', [PostsController::class, 'destroy']);
Route::get('/post', function () {
    $posts = \App\Models\Posts::all();
    $nasaImg = app(NasaApodService::class)->getImageUrl();
    return view('posts.index', compact('posts', 'nasaImg'));
});
Route::get('/posts/{id}/comments', function ($id) {
    $comments = \App\Models\Comments::where('post_id', $id)->get();
    return view('posts.comments.create', ['comments' => $comments, 'post_id' => $id]);
});

Route::get('/posts/{id}/comments/show', function ($id) {
    // Get the post
    $post = \App\Models\Posts::find($id);
    
    if (!$post) {
        return redirect()->back()->with('error', 'Post not found');
    }
    
    // Get comments for this specific post
    $comments = \App\Models\Comments::where('post_id', $id)->get();
    
    // Debug: Check what we're getting
    // dd([
    //     'Post ID from URL' => $id,
    //     'Post Found' => $post ? $post->title : 'No post',
    //     'Comments Count' => $comments->count(),
    //     'First Comment' => $comments->first(),
    // ]);
    
    return view('posts.comments.index', [
        'comments' => $comments,  // Collection of comments
        'post' => $post,          // Single post object
        'post_id' => $id          // Post ID from URL
    ]);
})->name('posts.comments.show');
});