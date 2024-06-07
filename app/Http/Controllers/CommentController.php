<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{
    public function addComment(Request $request)
    {
        // Validasi request
        $request->validate([
            'comment' => 'required|min:2|max:255',
            'movie_id' => 'required|exists:movies,id',
        ]);

        // Dapatkan ID pengguna yang sedang login
        $userId = Auth::id();
        Log::info('Authenticated user ID: ' . $userId);

        // Periksa apakah ID pengguna valid
        if (!$userId) {
            return redirect()->back()->withErrors(['User is not authenticated']);
        }

        // Buat komentar baru
        Comment::create([
            'movie_id' => $request->movie_id,
            'user_id' => $userId,
            'comment' => $request->comment,
            'tanggal' => now()
        ]);

        // Redirect ke halaman film
        return redirect('/' . $request->movie_id);
    }

    public function deleteComment($id)
    {
        $comment = Comment::find($id);

        if (!$comment) {
            return redirect()->back()->withErrors(['Comment not found']);
        }

        $comment->delete();

        return redirect()->back();
    }
}
