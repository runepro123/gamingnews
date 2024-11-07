<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request) 
    {  
        try {
            $user = User::create([
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            // Create a new access token
            $token = $user->createToken('user_token')->plainTextToken;

            return response()->json([
                'status' => 'success',
                'message' => 'Register successful',
                'data' => [
                    'user' => $user->only(['id', 'email']), // Limit sensitive data
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                ],
            ], 200);

        } catch (\Exception $e) {
            Log::error('Register failed: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while processing your request ...',
            ], 500);
        }
    }
}
