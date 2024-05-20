<?php

namespace App\Http\Controllers;
use App\Models\Comment;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function addComment(Request $request)
    {
        $request->validate([
            'comment' => 'required|min:2|max:255',
            'movie_id' => 'required|exists:movies,id',
        ]);

        Comment::create([
            'comment' => $request->comment,
            'movie_id' => $request->movie_id,
            'tanggal' => now()
        ]);

        return redirect('/' . $request->movie_id);
    }
    public function deleteComment(Request $request)
    {
        Comment::where('comment_id', $request->id)->delete();
        return redirect()->back();
    }
}