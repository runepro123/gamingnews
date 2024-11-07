<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Log;
use Illuminate\Validation\Rule;
use Validator;

class UserController extends Controller
{
    public function updateUserInfo(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'username' => [
                    'required',
                    'string',
                    Rule::unique('users', 'username')->ignore(Auth::id()),
                ],
                'name' => 'required|string',
                'bio' => 'required|string',
                'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 400);
            }

            $existingUser = Auth::user();

            // Check if the file is uploaded
            if ($request->hasFile('profile_image')) {
                if($existingUser->profile_image && file_exists(public_path($existingUser->profile_image))) {
                    $filePath = public_path($existingUser->profile_image);
                    unlink($filePath);
                }
                $image = $request->file('profile_image');
                $imageName = $image->getClientOriginalName();
                $timestamp = now()->timestamp;
                $directory = 'backend/uploads/user-images/';
                $imageUrl = $directory . $timestamp . '_' . $imageName;
                $image->move(public_path($directory), $timestamp . '_' . $imageName);
                $existingUser->profile_image = $imageUrl;
            }

            $existingUser->username = $request->username;
            $existingUser->name = $request->name;
            $existingUser->bio = $request->bio;
            $existingUser->country = $request->country;
            $existingUser->save();

            return response()->json([
                'status' => 'success',
                'message' => 'User information updated successfully.',
            ], 200);
        } catch (\Exception $e) {
            Log::error('User update failed: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while processing your request.',
            ], 500);
        }
    }

    public function getUser()
    {
        try {
            $user = Auth::user();

            if ($user) {
                return response()->json([
                    'status' => 'success',
                    'data' => [
                        'user' => $user->only(['id', 'name', 'username', 'email', 'bio', 'country', 'profile_image']), // Limit sensitive data
                    ],
                ], 200);

            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'User not found',
                ], 404);
            }
            
        } catch (\Exception $e) {
            Log::error('User retrieval failed: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while processing your request.',
            ], 500);
        }
    }
}
