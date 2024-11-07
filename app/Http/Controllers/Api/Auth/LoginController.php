<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Hash;
use Log;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        try {
            $user = User::where('email', $request->email)->first();

            if (!$user) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid email or password.',
                ], 422);
            }

            if ($user->status != '0') {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Your account is inactive. Please contact support.',
                ], 422);
            }

            if (!Hash::check($request->password, $user->password)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid email or password.',
                ], 401);
            }

            // Create a new access token
            $token = $user->createToken('user_token')->plainTextToken;

            return response()->json([
                'status' => 'success',
                'message' => 'Login successful',
                'data' => [
                    'user' => $user->only(['id', 'name', 'username', 'email', 'bio' ,'profile_image']), // Limit sensitive data
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                ],
            ], 200);

        } catch (\Exception $e) {
            Log::error('Login failed: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while processing your request.',
            ], 500);
        }
    }
}
