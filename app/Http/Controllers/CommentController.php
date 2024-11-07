<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function saveComment(Request $request) {
        $request->validate([
            'comment' => 'required|string',
        ]);

        $comment = new Comment();

        if ($request->has('slider_id')) {
            $comment->slider_id = $request->input('slider_id');
        }

        if ($request->has('news_id')) {
            $comment->news_id = $request->input('news_id');
        }

        $comment->user_id = $request->input('user_id');
        $comment->comment = $request->input('comment');

        $comment->save();

        return redirect()->back()->with('success', 'Comment saved successfully.');
    }

}
