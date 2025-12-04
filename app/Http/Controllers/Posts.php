<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Posts as PostModel;

class Posts extends Controller
{
    /**
     * List all posts.
     */
    public function index()
    {
        return response()->json(PostModel::all());
    }

    /**
     * Show a single post.
     */
    public function show($id)
    {
        $post = PostModel::find($id);
        if (! $post) {
            return response()->json(['message' => 'Post not found'], 404);
        }
        return response()->json($post);
    }

    /**
     * Create a new post.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post = PostModel::create($data);

        if ($request->expectsJson()) {
            return response()->json($post, 201);
        }
        return redirect('/post')->with('success', 'Post created successfully!');
    }

    /**
     * Update an existing post.
     */
    public function update(Request $request, $id)
    {
        $post = PostModel::find($id);
        if (! $post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        $data = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'content' => 'sometimes|required|string',
        ]);

        $post->update($data);

        return redirect('/post')->with('success', 'Post updated successfully!');
    }

    /**
     * Delete a post.
     */
    public function destroy($id)
    {
        $post = PostModel::find($id);
        if (! $post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        $post->delete();

        return redirect('/post')->with('success', 'Post deleted successfully!');
    }
}
