<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Posts as PostsController;
use App\Http\Controllers\RegisterController;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

// Registration endpoint (no auth required)
Route::post('/register', [RegisterController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
	Route::get('/posts', [PostsController::class, 'index']);
	Route::get('/posts/{id}', [PostsController::class, 'show']);
	Route::post('/posts', [PostsController::class, 'store']);
	Route::put('/post/{id}', [PostsController::class, 'update']);
	Route::delete('/posts/{id}', [PostsController::class, 'destroy']);
});
Route::post('/post', [PostsController::class, 'store']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/sanctum/token', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = \App\Models\User::where('email', $request->email)->first();

    if (! $user || ! \Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'The provided credentials are incorrect.'], 401);
    }

    $token = $user->createToken($request->device_name)->plainTextToken;

    return response()->json(['token' => $token], 201);
});
// (Removed closure-based /register route; use controller for API JSON response)