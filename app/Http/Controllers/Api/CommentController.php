<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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

        return response()->json([
            'status' => 'success',
            'message' => 'comment saved successfully',
        ], 200);
    }
}
