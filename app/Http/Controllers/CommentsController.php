<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comments;

class CommentsController extends Controller
{
    //
    public function index()
    {
        //
        $comments = Comments::all();
        return redirect('/posts/comments');
        
    }
    public function show($id)
    {
        //
        $comments = Comments::find($id);
        return redirect('/post/'.$comments->post_id);
    }
    public function store(Request $request)
    {
        //
        $comments = new Comments();
        $data = $request -> validate(
            [
            'post_id' => 'required|integer',
            'user_id' => 'required|integer',
            'content' => 'required|string|max:1000',
            ]            
            );
            $comments -> fill($data);
            $comments -> save();
            error_log('Comment created: ' . $comments->id);
            return redirect('/post');
    }

    public function update(Request $request, $id)
    {
        //
        $comments = Comments::find($id);
        $data = $request -> validate(
            [
            'post_id' => 'sometimes|required|integer',
            'user_id' => 'sometimes|required|integer',
            'content' => 'sometimes|required|string|max:1000',
            ]            
            );
            $comments -> fill($data);
            $comments -> save();
    }
}
