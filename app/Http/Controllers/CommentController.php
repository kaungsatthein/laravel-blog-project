<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construst () {
        $this->middleware('auth');
    }
    public function create (Request $request) {
        $request->validate(['content' => 'required']);

        $comment = new comment;
        $comment->content = $request->content;
        $comment->article_id = $request->article_id;
        $comment->user_id = auth()->user()->id;
        $comment->save();
        return back()->with('info', 'Created a comment');
    }
    public function delete($id) {
        $comment = Comment::find($id);

        if (Gate::allows('delete-comment', $comment)) {
            $comment->delete();
            return back()->with('info', 'Deleted a comment');
        }
        return back()->with('info', 'Cannot delete a comment');
    }

}
