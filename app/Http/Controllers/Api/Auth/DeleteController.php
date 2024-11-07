<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\NewsFavorite;
use App\Models\SliderFavorite;
use App\Models\Comment;

class DeleteController extends Controller
{
    public function delete($id) {
    $user = User::find($id);

    if ($user) {
        NewsFavorite::where('user_id', $id)->delete();
        SliderFavorite::where('user_id', $id)->delete();
        Comment::where('user_id', $id)->delete();

        if ($user->profile_image && file_exists(public_path($user->profile_image))) {
            unlink(public_path($user->profile_image));
        }

        $user->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'User profile deleted successfully',
        ], 200);
    } else {
        return response()->json([
            'status' => 'error',
            'message' => 'User not found',
        ], 404);
    }
}

}
